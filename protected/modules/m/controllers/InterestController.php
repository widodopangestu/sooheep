<?php

class InterestController extends Controller {

    public $layout = '//layouts/main';
    public $defaultAction = 'addInterest';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('searchInterest'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'addInterest', 'listInterest', 'join', 'group', 'community', 'listCommunity'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAddInterest() {
        $interest = new InterestSubgroup('searchMobile');

        if (isset($_GET['InterestSubgroup'])) {
            $interest->unsetAttributes();
            $interest->attributes = $_GET['InterestSubgroup'];
        }

        $this->render('index', array(
            'interest' => $interest
        ));
    }

    public function actionGroup($q) {
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

    public function actionCommunity($q) {
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

    public function actionJoin($q) {
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

    public function actionListInterest($q) {
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

    public function actionListCommunity() {
        $community = new InterestCommunity('search');

        if (isset($_GET['InterestCommunity'])) {
            $community->unsetAttributes();
            $community->attributes = $_GET['InterestCommunity'];
        }

        $this->render('community', array(
            'community' => $community
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
