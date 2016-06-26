<?php

class FeedsController extends Controller
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
				'actions'=>array('index','setFeed','uploadimage','comments','deleteInterest'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionDeleteInterest(){
		if(isset($_POST['id_interst'])){
			$post = UserInterest::model()->findByPk($_POST['id_interst']);
			$oldId = $post->id_user_interst;
			$oldName = $post->idInterest->interest_name; 
			if($post->delete()){
				echo CJSON::encode(array( 
					'id' => $oldId,
					'name' => $oldName 
				));
			}else{
				throw new CHttpException(404,'The specified post cannot be found.');
			}
		}
	}
	
	public function actionSetFeed(){
		if(isset($_POST['Feeds'])){
			$feed = new Feeds;
			$feed->attributes = $_POST['Feeds'];
			$feed->imagesUrl = $_POST['Feeds']['imagesUrl'];
			//$this->performAjaxValidation($feed);
			if($feed->save()){
				$this->redirect(array('index'));
			}else{
				var_dump($feed->getErrors());break;
				$this->redirect(array('index'));
			}
		}
	}
	
	public function actionComments(){
		if(isset($_POST['comment'])){
			//id_user, id_feeds, comment, comment_date
			$coment = new FeedsComments;
			$coment->id_user = $_POST['id_user'];
			$coment->id_feeds = $_POST['id_feeds'];
			$coment->comment = $_POST['comment'];
			$coment->comment_date = date("Y-m-d H:i:s");
			if($coment->save()){
				$this->renderPartial('_comments',array('data'=>$coment->idFeeds));
			}else{
				echo '
				<li clas="media">
					<div class="media-body">
						<span>Be First to heap this Momment</span>
					</div>
				</li>
				';
			}
		}
	}
	
	public function actionIndex()
	{
		$user = Yii::app()->user->id;
		$interest = UserInterest::model()->findAllByAttributes(array('id_user'=>$user['id']));
		$userS = Users::model()->findByPk($user['id']);
		$feed = new Feeds();
		if($userS->activation == 0){
			if($userS->interest == null)
				$this->layout = '//layouts/timeline_noaction';
			else 
				$this->layout = '//layouts/timeline_noactive';
			$this->render('index_notactivate',array(
				'interest' => $interest,
				'feed' => $feed
			));
		}else 
			$this->render('index',array(
				'interest' => $interest,
				'feed' => $feed
			));
	}  
	public function actionUploadimage(){
		if(isset($_POST['Feeds'])){
			$ImageHandler = new ImageHandler();
			$model = new Feeds;
			$model->attributes = $_POST['Feeds']; 
	        $images = CUploadedFile::getInstanceByName('images');
	        //var_dump($images);break;
			$user = Yii::app()->user->id;
	        $hash = strval(time()).strval($user['id']);
			$model->hash = sha1($hash);
			
			if (!empty($images)) {
	            $dirProd = $ImageHandler->CreateDirProdImage($model->hash);
                $dirImage = $ImageHandler->bothFileIsExist($dirProd, $images->name);
                $ImageHandler->saveFileAs($images->tempName, $dirImage);
                 	echo CJSON::encode(array(
                 		'status' => 'ok',
                   		'thumb' => "/".$ImageHandler->getImageThumb($dirImage),
                   		'best' =>"/".$ImageHandler->getImageBest($dirImage),
                  	));
                
            } else {
               	echo CJSON::encode(array(
                    		'status' => 'failed',
                    		'message' => "Image not available"
                    	));
            }
		}	
            
	}
	protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form2') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
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

?>