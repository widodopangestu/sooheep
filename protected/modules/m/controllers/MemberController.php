<?php

use yii\web\User;

class MemberController extends Controller {

    public $layout = '//layouts/main';

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
                'actions' => array('login', 'signup', 'logout', 'searchfriend', 'updateAllUser'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'profile', 'confirmfriends', 'gallery', 'addfriends', 'changeprofile', 'changeBackgroundprofile', 'notification'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {

        $this->layout = '//layouts/login';
        $formLog = new LoginForm;
        if (isset($_POST['LoginForm'])) {

            $formLog->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($formLog->validate() && $formLog->login())
                $this->redirect(Yii::app()->createUrl('/m/feeds/index'));
        }
        $path = Yii::getPathOfAlias('ext.HybridAuth');
        require_once $path . '/hybridauth-2.7.0/hybridauth/Hybrid/Auth.php';  //path to the Auth php file within HybridAuth folder
        require_once $path . '/hybridauth-2.7.0/hybridauth/Hybrid/Endpoint.php';  //path to the Endpoint php file within HybridAuth folder
        $config = $path . '/hybridauth-2.7.0/hybridauth/config.php';

        if (isset($_REQUEST['provider'])) {

            $provider_name = $_REQUEST["provider"];

            try {
                // initialize Hybrid_Auth class with the config file
                $hybridauth = new Hybrid_Auth($config);
                // try to authenticate with the selected provider
                $adapter = $hybridauth->authenticate($provider_name);

                // then grab the user profile
                $user_profile = $adapter->getUserProfile();

                /*
                 * $user_profile->webSiteURL
                 * $user_profile->profileURL
                 * $user_profile->photoURL
                 * $user_profile->displayName
                 * $user_profile->description
                 * $user_profile->firstName
                 * $user_profile->gender => "male"
                 * $user_profile->language => "id_ID"
                 * $user_profile->email
                 * $user_profile->emailVerified
                 * $user_profile->region
                 * $user_profile->username
                 * $user_profile->convertInfoURL
                 * 
                 */
                $user = Users::model()->getUserByProviderAndId($provider_name, $user_profile->identifier);
                //if user not registered yet by sso.
                if ($user == null && !empty($user_profile->email)) {
                    $user = Users::model()->getUserByEmail($user_profile->email);
                    $user->hybridauth_provider_name = $provider_name;
                    $user->hybridauth_provider_uid = $user_profile->identifier;
                    $user->save(false);
                    //if user not registered yet by email 
                    if ($user == null) {
                        $formReg = new RegisterForm("step1");
                        $formReg->email = $user_profile->email;
                        $formReg->password = sha1($user_profile->email);
                        $formReg->retypePassword = sha1($user_profile->email);
                        $formReg->firstName = $user_profile->firstName;
                        $formReg->lastName = $user_profile->lastName;
                        $formReg->gender = strtoupper($user_profile->gender);
                        $formReg->birthDate = 1970 - 01 - 01;
                        $formReg->country = 107; //indonesia
                        $formReg->city = 162; // jakarta
                        $formReg->hybridauth_provider_name = $provider_name;
                        $formReg->hybridauth_provider_uid = $user_profile->identifier;
                        if ($formReg->validate()) {
                            $formReg->saveProfile();
                            $user = Users::model()->getUserByProviderAndId($provider_name, $user_profile->identifier);
                        }
                    }
                }
                if ($user !== null) {
                    //login user
                    $formLog = new LoginForm;
                    $formLog->username = $user->email;
                    $formLog->password = $user->password;
                    $formLog->hybridauth_provider_name = $provider_name;
                    $formLog->hybridauth_provider_uid = $user_profile->identifier;
                    if ($formLog->loginSso()) {
                        $this->redirect(Yii::app()->createUrl('/m/feeds/index'));
                    }
                }
            }// something went wrong?
            catch (Exception $e) {
                Yii::app()->session->destroy();
                $this->redirect('/');
            }
        }
        if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done'])) {
            Hybrid_Endpoint::process();
        }
        $this->render('login', array(
            'formLog' => $formLog
        ));
    }

    public function actionSocialLogin() {
        Yii::import('application.components.HybridAuthIdentity');
        $path = Yii::getPathOfAlias('ext.HybridAuth');
        require_once $path . '/hybridauth-' . HybridAuthIdentity::VERSION . '/hybridauth/index.php';
    }

    public function actionSignup() {
        $this->layout = '//layouts/login';
        $formLog = new LoginForm;
        $formReg = new RegisterForm("step1");
        if (isset($_POST['step1'])) {
            if (isset($_POST['RegisterForm'])) {
                $formReg->attributes = $_POST['RegisterForm'];

                //$this->performAjaxValidation($formReg);
                if ($formReg->validate()) {
                    if ($formReg->saveProfile()) {
                        $formLog->username = $formReg->email;
                        $formLog->password = $formReg->password;
                        if ($formLog->validate() && $formLog->login())
                            $this->redirect(Yii::app()->createUrl('/m/feeds/index'));
                    }
                    //Yii::app()->session['step1'] = $_POST['RegisterForm'];
                    //$render = 'step2';
                    //$this->redirect(array('step2'));
                }
            }
        }

        $this->render('register', array(
            'formReg' => $formReg
        ));
    }

    public function actionUpdateAllUser() {
        $user = Users::model()->findAll();
        foreach ($user as $u) {
            $u->email = strtolower($u->email);
            $u->hash = sha1($u->email);

            if ($u->save()) {
                echo "sukses<br>";
            } else {
                echo "Gagal => " . $u->id_user;
            }
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('login'));
    }

    public function actionSearchfriend($mode = null) {
        $alluser = new Profile;
        $alluser->unsetAttributes();  // clear any default values
        if (isset($_GET['Profile'])) {
            $alluser->attributes = $_GET['Profile'];
            $alluser->globalSearch = $_GET['Profile']['globalSearch'];
        }

        if ($mode == null) {
            $this->render('index', array(
                'alluser' => $alluser,
            ));
        } else {
            $this->renderPartial('friends', array(
                'alluser' => $alluser,
            ));
        }
    }

    public function actionProfile($q) {
        $user = Users::model()->findByAttributes(array('hash' => $q));
        $feed = new Feeds();

        $criteria = new CDbCriteria;
        $criteria->condition = 't.id_user = :id';
        $criteria->order = "t.created_date DESC";
        $criteria->params = array(
            ':id' => $user->id_user,
        );

        $total = Feeds::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);
        $posts = Feeds::model()->findAll($criteria);


        if ($user != null) {
            $this->render('profile', array(
                'user' => $user,
                'feed' => $feed,
                'posts' => $posts,
                'pages' => $pages
            ));
        } else {
            throw new Exception('Cannot find User');
        }
    }

    public function actionNotification() {
        $user = Users::model()->findByPk(Yii::app()->user->id['id']);

        if ($user != null) {
            Notification::model()->updateAll(array('read' => 1), "id_user=:idUser", array(':idUser' => $user->id_user));
            $criteria = new CDbCriteria;
            $criteria->condition = 't.id_user = :id';
            $criteria->order = "t.date_create DESC";
            $criteria->params = array(
                ':id' => $user->id_user,
            );

            $total = Notification::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize = 20;
            $pages->applyLimit($criteria);
            $notif = Notification::model()->findAll($criteria);
            $this->render('notification', array(
                'user' => $user,
                'notif' => $notif,
                'pages' => $pages
            ));
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionAddfriends($q) {
        $cekFren = Users::model()->findByAttributes(array('hash' => $q));
        if ($cekFren != null) {
            $cekAgain = Friend::model()->findByAttributes(array('id_user' => $cekFren->id_user, 'id_user_friend' => Yii::app()->user->id['id']));
            $cekAgain2 = Friend::model()->findByAttributes(array('id_user_friend' => $cekFren->id_user, 'id_user' => Yii::app()->user->id['id']));
            if ($cekAgain == null && $cekAgain2 == null) {
                $fren = new Friend;
                $fren->id_user = Yii::app()->user->id['id'];
                $fren->id_user_friend = $cekFren->id_user;
                $fren->approval = 0;
                $fren->heap = 1;
                $fren->request_date = date("Y-m-d H:i:s");

                if ($fren->save()) {
                    Yii::app()->user->setflash("pesan-add-sukses", "please wait for your friend to confirm");
                    $this->redirect(array('profile', 'q' => $q));
                }
            } else {
                $this->redirect(array('profile', 'q' => $q));
            }
        }
    }

    public function actionConfirmfriends($q) {
        $user = Users::model()->findByAttributes(array('hash' => $q));
        $fren = Friend::model()->findByAttributes(array('id_user' => $user->id_user, 'id_user_friend' => Yii::app()->user->id['id']));
        $fren->approval = 1;
        if ($fren->save())
            $this->redirect(array('profile', 'q' => $q));
        else {
            //echo "<script>myApp.alert('gagal')</script>";
            $this->redirect(array('index'));
        }
    }

    public function actionGallery($id = null) {
        $id_user = ($id == null) ? Yii::app()->user->id['id'] : $id;
        //images
        $crImage = new CDbCriteria;
        $crImage->condition = 't.type = ' . Feeds::TYPE_IMAGE_POST . ' AND t.id_feeds IN (SELECT m.id_feeds FROM feeds m WHERE m.id_user = ' . $id_user . ')';
        $crImage->order = "id DESC";

        $totalImages = FeedsAttributes::model()->count($crImage);
        $pageImages = new CPagination($totalImages);
        $pageImages->pageSize = 20;
        $pageImages->applyLimit($crImage);
        $feedImages = FeedsAttributes::model()->findAll($crImage);
        //video
        $crVideo = new CDbCriteria;
        $crVideo->condition = 't.type = ' . Feeds::TYPE_VIDEO_POST . ' AND t.id_feeds IN (SELECT m.id_feeds FROM feeds m WHERE m.id_user = ' . $id_user . ')';
        $crVideo->order = "id DESC";

        $totalVideos = FeedsAttributes::model()->count($crVideo);
        $pageVideos = new CPagination($totalVideos);
        $pageVideos->pageSize = 20;
        $pageVideos->applyLimit($crVideo);
        $feedVideos = FeedsAttributes::model()->findAll($crVideo);
        //music
        $crMusic = new CDbCriteria;
        $crMusic->condition = 't.type = ' . Feeds::TYPE_MUSIC_POST . ' AND t.id_feeds IN (SELECT m.id_feeds FROM feeds m WHERE m.id_user = ' . $id_user . ')';
        $crMusic->order = "id DESC";

        $totalMusics = FeedsAttributes::model()->count($crMusic);
        $pageMusics = new CPagination($totalMusics);
        $pageMusics->pageSize = 20;
        $pageMusics->applyLimit($crMusic);
        $feedMusics = FeedsAttributes::model()->findAll($crMusic);
        //file
        $crFile = new CDbCriteria;
        $crFile->condition = 't.type = ' . Feeds::TYPE_FILE_POST . ' AND t.id_feeds IN (SELECT m.id_feeds FROM feeds m WHERE m.id_user = ' . $id_user . ')';
        $crFile->order = "id DESC";

        $totalFiles = FeedsAttributes::model()->count($crFile);
        $pageFiles = new CPagination($totalFiles);
        $pageFiles->pageSize = 20;
        $pageFiles->applyLimit($crFile);
        $feedFiles = FeedsAttributes::model()->findAll($crFile);
        $this->render('gallery', array(
            'feedImages' => $feedImages,
            'pageImages' => $pageImages,
            'feedVideos' => $feedVideos,
            'pageVideos' => $pageVideos,
            'feedMusics' => $feedMusics,
            'pageMusics' => $pageMusics,
            'feedFiles' => $feedFiles,
            'pageFiles' => $pageFiles,
        ));
    }

    public function actionChangeprofile() {
        $images = CUploadedFile::getInstanceByName('images_profile');
        if ($images != null) {
            $ImageHandler = new ImageHandler();
            $ImageHandler->dirProducts = "documents/users/";
            $ImageHandler->sizeThumb = array('x' => 110, 'y' => 110);
            $ImageHandler->sizeDefault = array('x' => 500, 'y' => 500);
            $user = Yii::app()->user->id;
            $hash = strval(time()) . strval($user['id']);
            $hash = sha1($hash);

            $dirProd = $ImageHandler->CreateDirProdImage($hash);
            $dirImage = $ImageHandler->bothFileIsExist($dirProd, $images->name);
            $ImageHandler->saveFileAs($images->tempName, $dirImage);
            $model = new ImageProfile;
            $model->id_user = $user['id'];
            $model->image_type = ImageProfile::TYPE_PROFILE_PICTURE;
            $model->image_path = "/" . $ImageHandler->getImageBest($dirImage);
            $model->created_date = date("Y-m-d H:i:s");
            if ($model->save()) {
                echo CJSON::encode(array(
                    'status' => 'ok',
                    'thumb' => Yii::app()->request->baseUrl . "/" . $ImageHandler->getImageThumb($dirImage),
                    'best' => Yii::app()->request->baseUrl . "/" . $ImageHandler->getImageBest($dirImage),
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => 'failed',
                    'message' => $model->getErrors(),
                ));
            }
        } else {
            echo CJSON::encode(array(
                'status' => 'failed',
                'message' => "Image not available"
            ));
        }
    }

    public function actionChangeBackgroundprofile() {
        $images = CUploadedFile::getInstanceByName('images_background');
        if ($images != null) {
            $ImageHandler = new ImageHandler();
            $ImageHandler->dirProducts = "documents/users/";
            $ImageHandler->sizeThumb = array('x' => 367, 'y' => 100);
            $ImageHandler->sizeDefault = array('x' => 1099, 'y' => 300);
            $user = Yii::app()->user->id;
            $hash = strval(time()) . strval($user['id']);
            $hash = sha1($hash);

            $dirProd = $ImageHandler->CreateDirProdImage($hash);
            $dirImage = $ImageHandler->bothFileIsExist($dirProd, $images->name);
            $ImageHandler->saveFileAs($images->tempName, $dirImage);
            $model = new ImageProfile;
            $model->id_user = $user['id'];
            $model->image_type = ImageProfile::TYPE_BACKGROUND_PICTURE;
            $model->image_path = "/" . $ImageHandler->getImageBest($dirImage);
            $model->created_date = date("Y-m-d H:i:s");
            if ($model->save()) {
                echo CJSON::encode(array(
                    'status' => 'ok',
                    'thumb' => Yii::app()->request->baseUrl . "/" . $ImageHandler->getImageThumb($dirImage),
                    'best' => Yii::app()->request->baseUrl . "/" . $ImageHandler->getImageBest($dirImage),
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => 'failed',
                    'message' => $model->getErrors(),
                ));
            }
        } else {
            echo CJSON::encode(array(
                'status' => 'failed',
                'message' => "Image not available"
            ));
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
}
