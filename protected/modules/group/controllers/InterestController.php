<?php

class InterestController extends Controller
{
	public $layout = '//layouts/group_timeline';
	
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
				'actions'=>array('index','setFeed','setFeedCommunity', 'uploadimage','uploadimageComunity', 'comments','deleteInterest','createComunity','community'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCreateComunity($id){
		$this->layout = '//layouts/comunity';
		$user = Yii::app()->user->id;
		$interest = UserInterest::model()->findAllByAttributes(array('id_user'=>$user['id']));
		$group = Interest::model()->findByAttributes(array('id_interest'=>$id));
		$this->setInterestModel($group);
		$comunity = new InterestCommunity;
		$allComunity = new InterestCommunity('searchGroup');
		if(isset($_POST['InterestCommunity'])){
			$comunity->attributes = $_POST['InterestCommunity'];
			$comunity->id_interest_group = $id;
			$comunity->community_hash = md5($comunity->community_name);
			$comunity->isActive = 1;
			$comunity->start_date = date("Y-m-d H:i:s");
			if($comunity->save()){
				if(isset($_POST['fren_invite'])){
					foreach ($_POST['fren_invite'] as $us){
						$fren = new InterestCommunityMember;
						$fren->id_user = $us;
						$fren->id_interest_community = $comunity->id;
						$fren->id_interest = $id;
						$fren->join_date = date("Y-m-d H:i:s");
						$fren->active = 0;
						$fren->date = date("Y-m-d H:i:s");
						if($fren->save()){
							$this->setNotif($fren->id_user,Notification::TYPE_INVITE,Yii::app()->createUrl('/group/interest/confirmcomunity',array('id'=>$comunity->id, 'hash'=>$fren->idUser->hash)),null,$comunity->community_name." has invited you to join");
						}
					}
				}
				$this->redirect(Yii::app()->createUrl('/group/interest/createComunity/id/'.$id));
			}
		}
		
		$this->render('create_comunity',array('comunity'=>$comunity,'allComunity'=>$allComunity));	
	}
	
	public function actionSetFeed($id){
		if(isset($_POST['Feeds'])){
			$feed = new Feeds;
			$feed->attributes = $_POST['Feeds'];
			$feed->post_type = Feeds::POST_GROUP;
			$feed->post_interest_id = $id; 
			$feed->imagesUrl = $_POST['Feeds']['imagesUrl'];
			//$this->performAjaxValidation($feed);
			if($feed->save()){
				$this->redirect(array('index','id'=>$id));
			}else{
				$this->redirect(array('index','id'=>$id));
			}
		}
	}
	
	public function actionSetFeedCommunity($id){
		if(isset($_POST['Feeds'])){
			$com = InterestCommunity::model()->findByPk($id);
			$feed = new Feeds;
			$feed->attributes = $_POST['Feeds'];
			$feed->post_type = Feeds::POST_COMMUNITY;
			$feed->post_community_id = $id;
			$feed->imagesUrl = $_POST['Feeds']['imagesUrl'];
			//$this->performAjaxValidation($feed);
			if($feed->save()){
				$this->redirect(array('community','id'=>$com->community_hash));
			}else{
				echo "gagal";
				$this->redirect(array('community','id'=>$com->community_hash));
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
	
	public function actionIndex($id)
	{
		$user = Yii::app()->user->id;
		$interest = UserInterest::model()->findAllByAttributes(array('id_user'=>$user['id']));
		$group = Interest::model()->findByAttributes(array('id_interest'=>$id));
		$this->setInterestModel($group);
		$userS = Users::model()->findByPk($user['id']);
		$feed = new Feeds();
		$community = InterestCommunity::model()->findAll(array(
			'condition' => 'id_interest_group = :idGroup',
			'order' => 'id DESC',	
			'limit' => 	20,
			'params' => array(
				':idGroup' => $id
			)	
		));
		
		
		$this->render('index',array(
			'interest' => $interest,
			'feed' => $feed,
			'group' => $group,
			'community'=>$community	
		));
	}
	
	public function actionCommunity($id){
		$this->layout = '//layouts/comunity';
		$commuity = InterestCommunity::model()->findByAttributes(array('community_hash'=>$id));
		$user = Yii::app()->user->id;
		$interest = UserInterest::model()->findAllByAttributes(array('id_user'=>$user['id']));
		$group = Interest::model()->findByAttributes(array('id_interest'=>$commuity->id_interest_group));
		$this->setInterestModel($group);
		$this->setCommunityModel($commuity);
		$userS = Users::model()->findByPk($user['id']);
		$feed = new Feeds();
		
		$this->render('index_community',array(
				'interest' => $interest,
				'feed' => $feed,
				'group' => $group,
				'commuity'=>$commuity
		));
	}

	public function actionUploadimage($id){
		if(isset($_POST['Feeds'])){
			$ImageHandler = new ImageHandler();
			$model = new Feeds;
			$model->attributes = $_POST['Feeds'];
			$model->post_type = Feeds::POST_GROUP;
			$model->post_interest_id = $id;
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
						'best' => "/".$ImageHandler->getImageBest($dirImage),
				));
	
			} else {
				echo CJSON::encode(array(
						'status' => 'failed',
						'message' => "Image not available"
				));
			}
		}
	
	}
	
	public function actionUploadimageComunity($id){
		if(isset($_POST['Feeds'])){
			$ImageHandler = new ImageHandler();
			$model = new Feeds;
			$model->attributes = $_POST['Feeds']; 
			$model->post_type = Feeds::POST_COMMUNITY; 
			$model->post_interest_id = $id; 
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
                   		'best' => "/".$ImageHandler->getImageBest($dirImage),
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
	
}	