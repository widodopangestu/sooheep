<?php

Yii::import("application.extensions.thumbnailer.ThumbLib_inc", true);

class FeedsController extends Controller {

    public $layout = '//layouts/main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'setFeed', 'uploadimage', 'checknotif', 'uploadfile', 'upload', 'get_mention', 'ajaxListComments', 'ajaxNewComment', 'ajaxDeleteComment', 'ajaxLoadComments'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $user = Yii::app()->user->id;
        $interest = UserInterest::model()->findAllByAttributes(array('id_user' => $user['id']));
        $userS = Users::model()->findByPk($user['id']);
        $feed = new Feeds();

        $interests = new InterestSubgroup('searchMobile');
        $interests->unsetAttributes();

        $crtIs = new CDbCriteria();
        $crtIs->addInCondition('id', $userS->idInterest['subgroup']);

        $interests->setDbCriteria($crtIs);
        if (isset($_GET['InterestSubgroup'])) {
            $interests->attributes = $_GET['InterestSubgroup'];
        }

        $subinterest = new Interest('searchMobile');
        $subinterest->unsetAttributes();
        $crtI = new CDbCriteria();
        $crtI->addInCondition('id_interest', $userS->idInterest['interest']);

        $subinterest->setDbCriteria($crtI);
        if (isset($_GET['Interest'])) {
            $subinterest->attributes = $_GET['Interest'];
//            $subinterest->id_subgroup = $q;
        }

        if ($userS->interest == null) {
            $this->redirect(Yii::app()->createUrl('/m/interest/addInterest'));
        } else {
            $this->render('index', array(
                'interest' => $interest,
                'interests' => $interests,
                'subinterest' => $subinterest,
                'feed' => $feed
            ));
        }
    }

    public function actionChecknotif() {
        $return = Notification::model()->count(array(
            'condition' => 't.id_user = ' . Yii::app()->user->id['id'] . ' AND t.read = 0',
        ));

        echo CJSON::encode(array('jumlah' => ($return == 0) ? "" : $return));
    }

    public function actionSetFeed() {
        if (isset($_POST['Feeds'])) {
            $errors = array();
            $feed = new Feeds;
            if ($this->interest != null) {
                $feed->post_interest_id = $this->interest->id_interest;
                $feed->post_type = Feeds::POST_GROUP;
            }
            if ($this->community != null) {
                $feed->post_community_id = $this->community->id;
                $feed->post_type = Feeds::POST_COMMUNITY;
            }

            $feed->attributes = $_POST['Feeds'];
            //$this->performAjaxValidation($feed);

            if (isset($_POST['Feeds']['post_interest_id'])) {
                $feed->post_interest_id = $_POST['Feeds']['post_interest_id'];
            }

            if (isset($_POST['Feeds']['post_community_id'])) {
                $feed->post_community_id = $_POST['Feeds']['post_community_id'];
            }

            $poll = new Poll;
            $choices = array();
            if (isset($_POST['Poll'])) {
                $poll->attributes = $_POST['Poll'];

                // Setup poll choices
                if (isset($_POST['PollChoice'])) {
                    foreach ($_POST['PollChoice'] as $id => $choice) {
                        $pollChoice = new PollChoice;
                        $pollChoice->attributes = $choice;
                        $choices[$id] = $pollChoice;
                    }
                }

                if ($poll->save()) {
                    $feed->poll_id = $poll->id;
                    // Save any poll choices too
                    foreach ($choices as $choice) {
                        $choice->poll_id = $poll->id;
                        $choice->save();
                    }
                } else {
                    foreach ($poll->getErrors() as $key => $error)
                        $errors[$key] = $error[0];
                }
            }

            $event = new Event;
            if (isset($_POST['Event'])) {
                $event->attributes = $_POST['Event'];
                if ($event->save()) {
                    $feed->event_id = $event->id;
                } else {
                    foreach ($event->getErrors() as $key => $error)
                        $errors[$key] = $error[0];
                }
            }
            if ($feed->save()) {
                if ($feed->post_interest_id != null) {
                    $this->redirect(Yii::app()->createUrl("/m/interest/group/q/" . $feed->post_interest_id));
                } elseif ($feed->post_community_id != null) {
                    $this->redirect(Yii::app()->createUrl("/m/interest/community/q/" . $feed->post_community_id));
                } else {
                    $this->redirect(array('index'));
                }
            } else {
                foreach ($feed->getErrors() as $key => $error)
                    $errors[$key] = $error[0];
            }
            if (count($errors) > 0)
                echo "<pre>";
            print_r($errors);
        }
    }

    public function actionUploadimage() {
        if (isset($_POST['Feeds'])) {
            $ImageHandler = new ImageHandler();
            $model = new Feeds;
            $model->attributes = $_POST['Feeds'];
            $images = CUploadedFile::getInstanceByName('images');
            //var_dump($images);break;
            $user = Yii::app()->user->id;
            $hash = strval(time()) . strval($user['id']);
            $model->hash = sha1($hash);

            if (!empty($images)) {
                $dirProd = $ImageHandler->CreateDirProdImage($model->hash);
                $dirImage = $ImageHandler->bothFileIsExist($dirProd, $images->name);
                $ImageHandler->saveFileAs($images->tempName, $dirImage);
                echo CJSON::encode(array(
                    'status' => 'ok',
                    'thumb' => "/" . $ImageHandler->getImageThumb($dirImage),
                    'best' => "/" . $ImageHandler->getImageBest($dirImage),
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => 'failed',
                    'message' => "Image not available"
                ));
            }
        }
    }

    public function actionUpload() {
        if (isset($_FILES["file"])) {
            $dir = Yii::getPathOfAlias('webroot') . Yii::app()->params['timeline'];
            $file = CUploadedFile::getInstanceByName('file');
            $return = array();
            if ($file !== null) {
                $hash = sha1(strval(time()) . strval(Yii::app()->user->id));
                $file_path = $hash . "." . $file->getExtensionName();
                $file_name = $file->getName();
                $file->saveAs($dir . $file_path);
                if (in_array($file->getExtensionName(), array('jpg', 'png', 'gif'))) {
                    $PhpThumbFactory = new PhpThumbFactory();
                    $PhpThumbFactory->create($dir . $file_path)->Resize(361, 300)->save($dir . "thumb_" . $file_path);
                }
                $return = array('file_name' => $file_name, 'file_path' => $file_path);
            }

            echo CJSON::encode($return);
            exit();
        }
    }

    public function actionUploadfile() {
        echo "test gan";
        if (isset($_POST['Feeds'])) {
            $imageHandler = new ImageHandler();
            $model = new Feeds;
            $model->attributes = $_POST['Feeds'];
            $model->file = CUploadedFile::getInstanceByName('file');
            $user = Yii::app()->user->id;
            $hash = strval(time()) . strval($user['id']);
            $model->hash = sha1($hash);

            if (!empty($model->file)) {
                $dirProd = $imageHandler->CreateDirProdImage($model->hash);
                $dirImage = $imageHandler->bothFileIsExist($dirProd, $model->file->name);
                $imageHandler->saveFileAs($model->file->tempName, $dirImage);
                echo CJSON::encode(array(
                    'status' => 'ok',
                    'file' => "/" . $imageHandler->getImageBest($dirImage),
                    'type' => $model->type
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => 'failed',
                    'message' => "Image not available"
                ));
            }
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
    public function actionGet_mention() {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $friends = Friend::model()->findAll(array(
            'condition' => '(id_user = :idUser OR id_user_friend = :idUser) AND approval = 1',
            'params' => array(
                ':idUser' => Yii::app()->user->id['id']
            ),
            'order' => 'request_date DESC',
            'limit' => 200
        ));
        $interests = UserInterest::model()->findAllByAttributes(array('id_user' => Yii::app()->user->id['id']));
        $data = array();
        foreach ($friends as $friend) {
            $data[] = array(
                "id" => $friend->idUserFriend->id_user,
                "name" => $friend->idUserFriend->fullName,
                "avatar" => $friend->idUserFriend->pictureUrl,
                "type" => "user"
            );
        }
        foreach ($interests as $interest) {
            $data[] = array(
                "id" => $interest->idInterest->id_interest,
                "name" => $interest->idInterest->interest_name,
                "avatar" => Yii::app()->theme->baseUrl . "/images/interest-logo.png",
                "type" => "interest"
            );
        }
        header('Content-type: application/json');
        echo CJSON::encode($data);
        Yii::app()->end();
    }

    public function actionAjaxNewComment($id) {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $comment = new FeedsComments();
        $comment->id_feeds = $id;
        $comment->id_user = Yii::app()->user->id['id'];

        if (isset($_POST['FeedsComments'])) {
            $comment->attributes = $_POST['FeedsComments'];
            if ($comment->save()) {
                $count = $comment->idFeeds->feedsCommentCount;
                $html = $this->renderPartial('/comments/_comment', array(
                        'comment' => $comment,
                    ),true);
                echo CJSON::encode(array(
                    'html' =>$html,
                    'count' => $count));
            }
        }
    }

    public function actionAjaxDeleteComment($id, $type) {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $comment = FeedsComments::model()->findByPk($id);
        if ($comment !== null) {
            if ($type == 'd') {
                $comment->comment_deleted = 1;
                $comment->delete_date = date("Y-m-d h:i:s");
            } else {
                $comment->blocked = 1;
                $comment->blocked_date = date("Y-m-d h:i:s");
            }
            $comment->save(false);
            $count = $comment->idFeeds->feedsCommentCount;
            echo CJSON::encode(array('id_feeds' => $comment->id_feeds, 'count' => $count));
        }
    }

    public function actionAjaxLoadComments($id) {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $feed = Feeds::model()->findByPk($id);

        if ($feed != null) {
            $this->renderPartial('/comments/_comments_popup', array(
                'comments' => $feed->feedsComment,
            ));
        }
    }

}
