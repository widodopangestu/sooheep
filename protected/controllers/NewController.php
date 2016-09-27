<?php

class NewController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/beforeLogin';
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionSetSessionInterest($cek="FALSE"){
		if(isset($_POST['id'])){
			if($cek=="FALSE"){
				if(isset(Yii::app()->session['setInterst'])){
					$arr = Yii::app()->session['setInterst'];
					unset($arr[$_POST['id']]);
					Yii::app()->session['setInterst'] = $arr;
				}else
					Yii::app()->session['setInterst'] = array($_POST['id'] => $_POST['id']);
			}else{
				if(isset(Yii::app()->session['setInterst'])){
					$arr = Yii::app()->session['setInterst'];
					if(!in_array($_POST['id'], $arr))
						$arr[$_POST['id']] = $_POST['id'];
						
					Yii::app()->session['setInterst'] = $arr;
				}else
					Yii::app()->session['setInterst'] = array($_POST['id'] => $_POST['id']);
			}
			if(count($this->setIdSessionChecked()) > 0){
		 		foreach ($this->setIdSessionChecked() as $val){
		 			echo CHtml::hiddenField('RegisterForm[interest][]',$val);
		 		}
		 	}
		}
	}
	
	public function actionGetinterest(){
		 $fromModel = new RegisterForm;
		 $group = InterestGroup::model()->findAll(array(
		 		'condition' => "interest_name LIKE :term",
			 	'params' => array(':term'=>'%'.$_GET['term'].'%'),
			 	'order'=>'interest_name'
		 ));
		 if($group == null){
		 	$group = InterestGroup::model()->findAll(array(
			 	'order'=>'interest_name'
			 ));
			 $cek = 1;
		 }else 
		 	$cek = 0;
		 foreach ($group as $g){
		 	if($cek == 1){
			 	$model = Interest::model()->findAll(array(
				 	'condition' => "interest_name LIKE :term AND id_group = :idGroup",
				 	'params' => array(':term'=>'%'.$_GET['term'].'%',':idGroup'=>$g->id),
				 	'order'=>'interest_name',
				 	//'limit' => 20
				 ));
		 	}else{
		 		$model = Interest::model()->findAll(array(
				 	'condition' => "id_group = :idGroup",
				 	'params' => array(':idGroup'=>$g->id),
				 	'order'=>'interest_name',
				 	//'limit' => 20
				 ));
		 	}
		 	
			if($model != null){
				echo '<div class="row">';
			 	echo "<h4>".$g->interest_name."</h4><hr>";
			 	echo CHtml::checkBoxList('RegisterForm[item_interest][]', $this->setIdSessionChecked(),CHtml::listData($model,'id_interest','interest_name'),
			 		array(
			 			'template'=>'<div class="col-sm-4">{input}&nbsp;{label}</div>',
			 			'separator'=>'',
			 			'class'=>'check_interest',
			 			'keyup'
			 		)
			 	);
			 	echo "</div>";
			}	
		 }
		if(count($this->setIdSessionChecked()) > 0){
	 		foreach ($this->setIdSessionChecked() as $val){
	 			echo CHtml::hiddenField('RegisterForm[interest][]',$val);
	 		}
	 	}
		 
	}
	
	public function actionIndex()
	{
		$formReg = new RegisterForm;
		$formLog = new LoginForm;
		$render = 'index';
		
		if(isset($_POST['LoginForm'])){
		
			$formLog->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($formLog->validate() && $formLog->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		if(isset(Yii::app()->session['step1'])){
			$formReg = new RegisterForm("step1");
			$formReg->attributes = Yii::app()->session['step1'];
		}
		
		if(isset($_POST['step1'])){	
			if(isset($_POST['RegisterForm'])){
				$formReg = new RegisterForm("step1");
				$formReg->attributes = $_POST['RegisterForm'];
				
				$this->performAjaxValidation($formReg);
				if($formReg->validate()){
					if($formReg->saveProfile()){
						$formLog->username = $formReg->email;
						$formLog->password = $formReg->password;
						if($formLog->validate() && $formLog->login())
							$this->redirect(Yii::app()->user->returnUrl);
					}
					//Yii::app()->session['step1'] = $_POST['RegisterForm'];
					//$render = 'step2';
					//$this->redirect(array('step2'));
				} 
			}
		}
			
		
		$this->render($render,array(
			'formReg' => $formReg,
			'formLog' => $formLog
		));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionStep2(){
		$formReg = new RegisterForm("step2");
		
		if(isset($_POST['RegisterForm'])){
			$formReg->attributes = $_POST['RegisterForm'];
			//var_dump($formReg->interest);break;
			if($formReg->validate()){
				if($formReg->saveInterst()){
					$this->redirect(Yii::app()->createUrl('/timeline/feeds'));
				}
			}
		}
		
		
		$this->render($render,array(
			'formReg' => $formReg,
			'formLog' => $formLog
		));
	}
	
	public function actionFeed(){
		Yii::app()->theme = 'member';
		$this->layout='//maintemplate';
		$this->render('feed');
	}
	
	public function actionGetstate(){
		if(isset($_POST['RegisterForm']['country'])){
			$data = CHtml::listData(MasterState::model()->findAll(array(
				'condition'=>'state_country_id = :parent_id',
				'params' =>array(':parent_id'=>intval($_POST['RegisterForm']['country']))
			)),'state_id','state_name');
		    foreach($data as $value=>$name)
		    {
		        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
		    }
		}
	}
	
	public function actionGetcity(){
		if(isset($_POST['RegisterForm']['country'])){
			$data = CHtml::listData(MasterCity::model()->findAll(array(
				'condition'=>'city_country_id = :parent_id',
				'order' => 'trim(city_name) ASC',
				'params' =>array(':parent_id'=>intval($_POST['RegisterForm']['country'])),
				
			)),'city_id','city_name');
 
		    foreach($data as $value=>$name)
		    {
		        echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		    }
		}
	}
	public function actionGetcity2(){
		if(isset($_POST['Profile']['id_country'])){
			$data = CHtml::listData(MasterCity::model()->findAll(array(
				'condition'=>'city_country_id = :parent_id',
				'order' => 'trim(city_name) ASC',
				'params' =>array(':parent_id'=>intval($_POST['Profile']['id_country'])),
				
			)),'city_id','city_name');
 
		    foreach($data as $value=>$name)
		    {
		        echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		    }
		}
	}
		
	protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form2') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionFbconnect(){
    	Yii::import("application.vendor.opauth.Opauth"); 
    	$config = array(
				'path' => '/',
				'callback_url' => '/new/callback',
                'security_salt' => 'c52854a4a6a77bf0b1caaf5b9cb1c1d7',
                'Strategy' => array(
                    'Facebook' => array(
                        'app_id' => '1053399674701092',
                        'app_secret' => '0a5612bf89a697c3a79993e3d583c81c',
                    )
                ),
            );
    	$oauth =  new Opauth($config);
    	var_dump($oauth);
    	//$oauth->run();
    }
    public function actionCallback(){
    	var_dump($_POST);
		var_dump(Yii::app()->user);
    } 
	
}	