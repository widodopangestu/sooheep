<?php

class InterestController extends Controller
{
	public $layout = '//layouts/timeline_noaction';
	
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
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$user = Yii::app()->user->id;
		$interest = UserInterest::model()->findAllByAttributes(array('id_user'=>$user['id']));
		$userS = Users::model()->findByPk($user['id']);
		$feed = new Feeds();
		
		$this->render('index_notactivate',array(
				'interest' => $interest,
				'feed' => $feed
			));
	}
	
}	