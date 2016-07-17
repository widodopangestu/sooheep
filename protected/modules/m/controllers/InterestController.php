<?php

class InterestController extends Controller
{

    public $layout = '//layouts/main';
    public $defaultAction = 'addInterest';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('searchInterest'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'addInterest', 'listInterest', 'join', 'joinCommunity', 'group', 'community', 'listCommunity', 'ajaxListEvent', 'attend', 'unattend', 'map', 'showMap'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAddInterest()
    {
        $interest = new InterestSubgroup('searchMobile');

        if (isset($_GET['InterestSubgroup'])) {
            $interest->unsetAttributes();
            $interest->attributes = $_GET['InterestSubgroup'];
        }

        $this->render('index', array(
            'interest' => $interest
        ));
    }

    public function actionGroup($q)
    {
        $user = Yii::app()->user->id;
        $userS = Users::model()->findByPk($user['id']);
        $feed = new Feeds();
        $group = Interest::model()->findByPk($q);
        $this->setInterestModel($group);
        $this->render('groupFeeds', array(
            'feed' => $feed,
            'interest' => $q,
            'group' => $group
        ));
    }

    public function actionCommunity($q)
    {
        $user = Yii::app()->user->id;
        $userS = Users::model()->findByPk($user['id']);
        $feed = new Feeds();
        $group = InterestCommunity::model()->findByPk($q);
        $this->setCommunityModel($group);
        $this->render('communityFeeds', array(
            'feed' => $feed,
            'interest' => $q,
            'group' => $group
        ));
    }

    public function actionJoin($q)
    {
        if (isset($_POST['id'])) {
            if ($q == "join") {
                $cek = UserInterest::model()->findByAttributes(array(
                    'id_user' => Yii::app()->user->id['id'],
                    'id_interest' => $_POST['id']
                ));
                if ($cek == null) {
                    $interest = new UserInterest;
                    $interest->id_user = Yii::app()->user->id['id'];
                    $interest->id_interest = $_POST['id'];
                    if ($interest->save()) {
                        echo CJSON::encode(array('sukses' => "yes"));
                    } else {
                        echo CJSON::encode(array('sukses' => "no", "errmsg" => "Invalid request"));
                    }
                } else {
                    echo CJSON::encode(array('sukses' => "no", "errmsg" => "You have already added this one"));
                }
            } else {
                $cek = UserInterest::model()->findByAttributes(array(
                    'id_user' => Yii::app()->user->id['id'],
                    'id_interest' => $_POST['id']
                ));
                if ($cek != null) {
                    if ($cek->delete()) {
                        echo CJSON::encode(array('sukses' => "yes"));
                    } else {
                        echo CJSON::encode(array('sukses' => "no", "errmsg" => "Invalid request"));
                    }
                } else {
                    echo CJSON::encode(array('sukses' => "no", "errmsg" => "You dont have this one"));
                }
            }
        } else {
            echo CJSON::encode(array('sukses' => "no", "errmsg" => "Invalid request"));
        }
    }

    public function actionJoinCommunity($q)
    {
        if (isset($_POST['id'])) {
            $ic = InterestCommunity::model()->findByPk($_POST['id']);
            if ($q == "join" && $ic !== null) {
                $cek = InterestCommunityMember::model()->findByAttributes(array(
                    'id_user' => Yii::app()->user->id['id'],
                    'id_interest_community' => $_POST['id']
                ));
                if ($cek == null) {
                    $interest = new InterestCommunityMember();
                    $interest->id_user = Yii::app()->user->id['id'];
                    $interest->id_interest_community = $_POST['id'];
                    $interest->id_interest = $ic->id_interest_group;
                    $interest->active = 1;
                    $interest->join_date = date('Y-m-d h:i:s');
                    $interest->date = date('Y-m-d');
                    if ($interest->save()) {
                        echo CJSON::encode(array('sukses' => "yes"));
                    } else {
                        echo CJSON::encode(array('sukses' => "no", "errmsg" => "Invalid request"));
                    }
                } else {
                    echo CJSON::encode(array('sukses' => "no", "errmsg" => "You have already added this one"));
                }
            } else {
                $cek = InterestCommunityMember::model()->findByAttributes(array(
                    'id_user' => Yii::app()->user->id['id'],
                    'id_interest_community' => $_POST['id']
                ));
                if ($cek != null) {
                    if ($cek->delete()) {
                        echo CJSON::encode(array('sukses' => "yes"));
                    } else {
                        echo CJSON::encode(array('sukses' => "no", "errmsg" => "Invalid request"));
                    }
                } else {
                    echo CJSON::encode(array('sukses' => "no", "errmsg" => "You dont have this one"));
                }
            }
        } else {
            echo CJSON::encode(array('sukses' => "no", "errmsg" => "Invalid request"));
        }
    }

    public function actionListInterest($q)
    {
        $interest = new Interest('searchMobile');
        $interest->id_subgroup = $q;

        if (isset($_GET['Interest'])) {
            $interest->unsetAttributes();
            $interest->attributes = $_GET['Interest'];
            $interest->id_subgroup = $q;
        }

        $this->render('interest', array(
            'interest' => $interest
        ));
    }

    public function actionListCommunity()
    {
        $community = new InterestCommunity('search');

        if (isset($_GET['InterestCommunity'])) {
            $community->unsetAttributes();
            $community->attributes = $_GET['InterestCommunity'];
        }

        $this->render('community', array(
            'community' => $community
        ));
    }

    public function actionAjaxListEvent($time)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $date = date('Y-m-d', strtotime($time));
        $events = Event::model()->findAll("date LIKE '%" . $date . "%'");
        $this->renderPartial('_list_event', array(
            'date' => $date,
            'events' => $events
        ));
    }

    public function actionAttend($id)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $model = new UsersAttend;
        $model->event_id = $id;
        $model->users_id_user = Yii::app()->user->id['id'];
        $model->save();
    }

    public function actionUnattend($id)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $model = UsersAttend::model()->findByAttributes(array(
            'event_id' => $id,
            'users_id_user' => Yii::app()->user->id['id']
        ));
        $model->delete();
    }

    public function getEvent($date)
    {
        $events = Event::model()->findAll("date LIKE '%" . $date->format('Y-m-d') . "%'");
        return $events;
    }

    public function actionMap()
    {
        $this->layout = '//layouts/map';
        $this->render('map');
    }

    public function actionShowMap($lat = -6.202393600000001, $lng = 106.65270989999999)
    {
        $this->layout = '//layouts/map';
        $this->render('showMap', array(
            'lat' => $lat,
            'lng' => $lng
        ));
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
}
