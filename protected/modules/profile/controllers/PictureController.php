<?php

class PictureController extends Controller
{
	public $layout = '/layouts/timeline';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','changeprofile','uploadimage','changeBackgroundprofile'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionChangeprofile(){
		$images = CUploadedFile::getInstanceByName('images_profile');
		if($images != null){
			$ImageHandler = new ImageHandler();
			$ImageHandler->dirProducts = "documents/users/";
			$ImageHandler->sizeThumb = array('x' => 110, 'y' => 110);
			$ImageHandler->sizeDefault = array('x' => 500, 'y' => 500);
			$user = Yii::app()->user->id;
	        $hash = strval(time()).strval($user['id']);
			$hash = sha1($hash);
			
			$dirProd = $ImageHandler->CreateDirProdImage($hash);
			$dirImage = $ImageHandler->bothFileIsExist($dirProd, $images->name);
			$ImageHandler->saveFileAs($images->tempName, $dirImage);
			$model = new ImageProfile;
			$model->id_user = $user['id'];
			$model->image_type = ImageProfile::TYPE_PROFILE_PICTURE;
			$model->image_path = "/".$ImageHandler->getImageBest($dirImage);
			$model->created_date = date("Y-m-d H:i:s");
			if($model->save()){
				echo CJSON::encode(array(
                 		'status' => 'ok',
                   		'thumb' => Yii::app()->request->baseUrl."/".$ImageHandler->getImageThumb($dirImage),
                   		'best' => Yii::app()->request->baseUrl."/".$ImageHandler->getImageBest($dirImage),
				));
			}else{
				echo CJSON::encode(array(
                 		'status' => 'failed',
                   		'message' => $model->getErrors(),
				));
			}
                
		}else {
			echo CJSON::encode(array(
                    		'status' => 'failed',
                    		'message' => "Image not available"
                    		));
		}
	}
	
	public function actionChangeBackgroundprofile(){
		$images = CUploadedFile::getInstanceByName('images_background');
		if($images != null){
			$ImageHandler = new ImageHandler();
			$ImageHandler->dirProducts = "documents/users/";
			$ImageHandler->sizeThumb = array('x' => 367, 'y' => 100);
			$ImageHandler->sizeDefault = array('x' => 1099, 'y' => 300);
			$user = Yii::app()->user->id;
	        $hash = strval(time()).strval($user['id']);
			$hash = sha1($hash);
			
			$dirProd = $ImageHandler->CreateDirProdImage($hash);
			$dirImage = $ImageHandler->bothFileIsExist($dirProd, $images->name);
			$ImageHandler->saveFileAs($images->tempName, $dirImage);
			$model = new ImageProfile;
			$model->id_user = $user['id'];
			$model->image_type = ImageProfile::TYPE_BACKGROUND_PICTURE;
			$model->image_path = "/".$ImageHandler->getImageBest($dirImage);
			$model->created_date = date("Y-m-d H:i:s");
			if($model->save()){
				echo CJSON::encode(array(
                 		'status' => 'ok',
                   		'thumb' => Yii::app()->request->baseUrl."/".$ImageHandler->getImageThumb($dirImage),
                   		'best' => Yii::app()->request->baseUrl."/".$ImageHandler->getImageBest($dirImage),
				));
			}else{
				echo CJSON::encode(array(
                 		'status' => 'failed',
                   		'message' => $model->getErrors(),
				));
			}
                
		}else {
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