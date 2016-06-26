<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $interest;
	public $community;
	
	public function getProfile($uid = null){
		$uid = ($uid == null) ? Yii::app()->user->id['id'] : $uid;
		$user = Profile::model()->findByAttributes(array('id_user'=>$uid));
		return $user;
	}
	


	public function getProfilePicture($class = "",$style = "",$uid = null){
		$user = $this->getProfile($uid);
		$profile = ImageProfile::model()->find(array(
				'condition' => 'image_type = :tipe AND id_user = :idUser',
				'params' => array(
						':tipe' => ImageProfile::TYPE_PROFILE_PICTURE,
						':idUser' => $user->id_user,
				),
				'order' => 'created_date DESC'
		));
		if($profile == null)
			return CHtml::image(Yii::app()->theme->baseUrl."/images/baby-ant.png",'profile',array('class'=>$class,'style'=>$style));
			else
				return CHtml::image(str_replace('best','thumb',Yii::app()->request->baseUrl.$profile->image_path),'profile',array('class'=>$class,'style'=>$style));
	}

	public function getGroupFotos($id = null,$limit=0){
		$interest = Interest::model()->findByPk($id);
		$profile = FeedsAttributes::model()->findAll(array(
				'join' => 'JOIN feeds ON t.id_feeds = feeds.id_feeds',
				'condition' => 't.type = :tipe AND feeds.post_interest_id = :idInterest',
				'params' => array(
						':tipe' => Feeds::TYPE_IMAGE_POST,
						':idInterest' => $id,
				),
				'order' => 'created_date DESC',
				'limit' => ($limit > 0) ? $limit : FALSE
		));
	
		return $profile;
	}
	
	public function getCommunityFotos($id = null,$limit=0){
		$interest = Interest::model()->findByPk($id);
		$profile = FeedsAttributes::model()->findAll(array(
				'join' => 'JOIN feeds ON t.id_feeds = feeds.id_feeds',
				'condition' => 't.type = :tipe AND feeds.post_community_id = :idInterest',
				'params' => array(
						':tipe' => Feeds::TYPE_IMAGE_POST,
						':idInterest' => $id,
				),
				'order' => 'created_date DESC',
				'limit' => ($limit > 0) ? $limit : FALSE
		));
	
		return $profile;
	}

	public function getFeedFotos($uid = null,$limit=0){
		$user = $this->getProfile($uid);
		$profile = FeedsAttributes::model()->findAll(array(
				'join' => 'JOIN feeds ON t.id_feeds = feeds.id_feeds',
				'condition' => 't.type = :tipe AND feeds.id_user = :idUser',
				'params' => array(
						':tipe' => Feeds::TYPE_IMAGE_POST,
						':idUser' => $user->id_user,
				),
				'order' => 'created_date DESC',
				'limit' => ($limit > 0) ? $limit : FALSE
		));
	
		return $profile;
	}
	
	public function getBackgroundPicture($src = false,$idUser = NULL){
		if($idUser == NULL)
			$user = $this->getProfile();
		else 
			$user = $this->getProfile($idUser);
		
		$profile = ImageProfile::model()->find(array(
			'condition' => 'image_type = :tipe AND id_user = :idUser',
			'params' => array(
				':tipe' => ImageProfile::TYPE_BACKGROUND_PICTURE,
				':idUser' => $user->id_user,
			),
			'order' => 'created_date DESC'
		));
		if($profile == null)
			return ($src) ? Yii::app()->theme->baseUrl."/images/background-default.jpg" : Yii::app()->theme->baseUrl.CHtml::image(Yii::app()->theme->baseUrl."/images/background-default.jpg",'background');
		else 
			return ($src) ? Yii::app()->request->baseUrl.$profile->image_path : CHtml::image(Yii::app()->request->baseUrl.$profile->image_path);
	}
	
	public function getBulan($month,$format = "full"){
		if($format == "full")
			$bulan = array(1=>"January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December");
		else 
			$bulan = array(1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");
		return $bulan[$month];
	}
	
	public function getDate($date, $lang = "en"){
		switch ($date){
			case 1:
				return strval($date)."st";
			break;
			case 2:
				return strval($date)."nd";
			break;
			case 3:
				return strval($date)."rd";
			break;	
			default:
				return strval($date)."th";
			break;	
		}
	}
	
	public function getFullDateTime($date,$type = "full"){
		sscanf($date,"%d-%d-%d %s:%s:%s",$year,$month,$date,$hour,$minutes,$second);
		return $this->getDate($date)." ".$this->getBulan($month)." ".$year." ".$hour.":".$minutes; 
	}
	
	public function setNotif($idUser,$tipe,$referalLink, $idFriend = null, $mesage = null){
		$notif = new Notification;
		$notif->id_user = $idUser; //word, type, id_user, date_create, referation_link
		$notif->type = $tipe;
		if($mesage == null){
			if($idFriend != null){
				$fren = Profile::model()->findByAttributes(array('id_user'=>$idFriend));
				if($fren != null){
					$mesage = str_replace("{friend}",$fren->firstname,$notif->typeDescription);
				}
			}else{
				$mesage = str_replace("{friend}","Somebody",$notif->typeDescription);
			}
		}
		$notif->word = $mesage;
		$notif->date_create = date("Y-m-d");
		$notif->referation_link = $referalLink;
		if($notif->save()){
		
		}else{
			var_dump($notif->getErrors());
		}
	}
	
	public function readNotif($idNotif){
		$notif = Notification::model()->findByPk($idNotif);
		if($notif != null){
			$notif->read = 1;
			$notif->save();
		}
	}
	
	public function setIdSessionChecked(){
		if(isset(Yii::app()->session['setInterst']) && count(Yii::app()->session['setInterst']) > 0){
			$cek = UserInterest::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->id['id']));
			if($cek == null)
				$arr = array();
			else{
				$arr = array();
				foreach ($cek as $c){
					$arr[$c->id_interest] = $c->id_interest;
				}
			}
			return array_merge(Yii::app()->session['setInterst'],$arr);
		}else{
			$cek = UserInterest::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->id['id']));
			if($cek == null)
				return array();
			else{
				$arr = array();
				foreach ($cek as $c){
					$arr[$c->id_interest] = $c->id_interest;
				}
				return $arr;
			}
		}
	}
	
	public function getFriends($limit = 0){
		$friend = Friend::model()->findAll(array(
			'condition' => '(id_user = :idUser OR id_user_friend = :idUser) AND approval = 1',
			'params' => array(
				':idUser' => Yii::app()->user->id['id']
			),
			'order' => 'request_date DESC',
			'limit' => ($limit > 0) ? $limit : FALSE  
		));
		
		return $friend;
	}

	public function setInterestModel($model){
		$this->interest = $model;
	}
	
	public function setCommunityModel($model){
		$this->community = $model;
	}

	public function getFriendsGroup($limit = 0){
		$friend = UserInterest::model()->findAll(array(
				'condition' => '(id_interest = :idInterest)',
				'params' => array(
						':idInterest' => $this->interest->id_interest
				),
				'order' => 'id_user_interst DESC',
				'limit' => ($limit > 0) ? $limit : FALSE
		));
	
		return $friend;
	}
	
	public function getFriendsCommunity($limit = 0, $id){
		$friend = InterestCommunityMember::model()->findAll(array(
			'condition' => '(id_interest_community = :idInterest)',
			'params' => array(
				':idInterest' => $id
			),
			'order' => 'id_user DESC',
			'limit' => ($limit > 0) ? $limit : FALSE  
		));
		
		return $friend;
	}
	
	public function getNotificationUnread(){
		$model = Notification::model()->findByAttributes();
	
	}
	
	
	
}