<?php

class FindController extends Controller
{
	public $layout = '//layouts/timeline';
	
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
				'actions'=>array('index','search','addfriends','confirmfriends'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionAddfriends($hash)
	{
		$cekFren = Users::model()->findByAttributes(array('hash'=>$hash));
		if($cekFren != null){
			$cekAgain = Friend::model()->findByAttributes(array('id_user'=>$cekFren->id_user,'id_user_friend'=>Yii::app()->user->id['id']));
			$cekAgain2 = Friend::model()->findByAttributes(array('id_user_friend'=>$cekFren->id_user,'id_user'=>Yii::app()->user->id['id']));
			if($cekAgain == null && $cekAgain2 == null){
				$fren = new Friend;
				$fren->id_user =  Yii::app()->user->id['id'];
				$fren->id_user_friend =  $cekFren->id_user;
				$fren->approval =  0;
				$fren->heap =  1;
				$fren->request_date =  date("Y-m-d H:i:s");
				
				if($fren->save()){
					$this->setNotif($fren->id_user_friend ,Notification::TYPE_ADD_FRIEND,Yii::app()->createUrl('/friends/find/confirmfriends',array('hash'=>Yii::app()->user->id['hash'])),Yii::app()->user->id['id']);
					Yii::app()->user->setFlash('berhasil-addfren',"Wait your friend confirm.");
					$this->redirect(array('index'));
				}
			}else{
				Yii::app()->user->setFlash('berhasil-addfren',"You has been friend");
				$this->redirect(array('index'));
			} 
		}
	}
	
	public function actionConfirmfriends($hash)
	{
		$user = Users::model()->findByAttributes(array('hash'=>$hash));
		$fren = Friend::model()->findByAttributes(array('id_user_friend'=>$user->id_user));
		$fren->approval = 1;
		if($fren->save())
			$this->redirect(array('index'));
		else {
			echo "<script>alert('gagal')</script>";
			$this->redirect(array('index'));
		}
			
	}
	
	public function actionIndex($mode = null)
	{
		$alluser = new Profile;
		$alluser->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile'])){
			$alluser->attributes=$_GET['Profile'];
			$alluser->globalSearch = $_GET['Profile']['globalSearch'];
		}	

		if($mode == null){	
			$this->render('index',array(
				'alluser' => $alluser,
			));
		}else{
			$this->renderPartial('friends',array(
				'alluser' => $alluser,
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