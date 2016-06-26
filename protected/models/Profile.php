<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property double $id_profile
 * @property integer $id_user
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $gender
 * @property string $phone_number
 * @property string $birth_date
 * @property integer $id_country
 * @property integer $id_state
 * @property integer $id_city
 * @property string $uniqueid
 *
 * The followings are the available model relations:
 * @property Users $idUser
 * @property MasterCountry $idCountry
 * @property MasterCity $idCity
 * @property MasterState $idState
 */
class Profile extends CActiveRecord
{
	public $globalSearch = NULL;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, firstname, lastname, gender', 'required'),
			array('birth_date, id_country, id_city', 'required', 'on' => 'interststep'), 
			array('id_user, id_country, id_state, id_city', 'numerical', 'integerOnly'=>true),
			array('firstname, middlename, lastname, uniqueid', 'length', 'max'=>255),
			array('gender', 'length', 'max'=>6),
			array('phone_number', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_profile, id_user, firstname, middlename, lastname, gender, phone_number, birth_date, id_country, id_state, id_city, uniqueid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'idCountry' => array(self::BELONGS_TO, 'MasterCountry', 'id_country'),
			'idCity' => array(self::BELONGS_TO, 'MasterCity', 'id_city'),
			'idState' => array(self::BELONGS_TO, 'MasterState', 'id_state'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_profile' => 'Id Profile',
			'id_user' => 'Id User',
			'firstname' => 'Firstname',
			'middlename' => 'Middlename',
			'lastname' => 'Lastname',
			'gender' => 'Gender',
			'phone_number' => 'Phone Number',
			'birth_date' => 'Birth Date',
			'id_country' => 'Id Country',
			'id_state' => 'Id State',
			'id_city' => 'Id City',
			'uniqueid' => 'Uniqueid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_profile',$this->id_profile);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('id_country',$this->id_country);
		$criteria->compare('id_state',$this->id_state);
		$criteria->compare('id_city',$this->id_city);
		$criteria->compare('uniqueid',$this->uniqueid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getProfilePicture($class = "",$style = ""){
		$profile = ImageProfile::model()->find(array(
			'condition' => 'image_type = :tipe AND id_user = :idUser',
			'params' => array(
				':tipe' => ImageProfile::TYPE_PROFILE_PICTURE,
				':idUser' => $this->id_user,
			),
			'order' => 'created_date DESC'
		));
		if($profile == null)
			return CHtml::image(Yii::app()->theme->baseUrl."/images/baby-ant.png",'profile',array('class'=>$class,'style'=>$style));
		else 
			return CHtml::image(str_replace('best','thumb',Yii::app()->request->baseUrl.$profile->image_path),'profile',array('class'=>$class,'style'=>$style));
	}
	
	public function getFindall(){
		$criteria=new CDbCriteria;
		$criteria->with = array('idUser', 'idCity');
        $criteria->together = TRUE; 
		$criteria->condition = "idUser.id_user != :myid";
		
		if($this->globalSearch != null){
			$criteria->condition .= '
			AND (t.firstname LIKE :keyword
			OR t.middlename LIKE :keyword
			OR t.lastname LIKE :keyword
			OR idUser.email LIKE :keyword
			OR idCity.city_name LIKE :keyword) ';
			
			$criteria->params = array(
				':keyword' => "%".$this->globalSearch."%",
				':myid' => Yii::app()->user->id['id'] 
			);
		}else{
			$criteria->params = array(
				//':keyword' => "%".$this->globalSearch."%",
				':myid' => Yii::app()->user->id['id'] 
			);
		}
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		)); 
	}
	

	public function getButtonaddfriend(){
		$cek = Friend::model()->findByAttributes(array('id_user'=>Yii::app()->user->id['id'],'id_user_friend'=>$this->id_user));
		$cek2 = Friend::model()->findByAttributes(array('id_user_friend'=>Yii::app()->user->id['id'],'id_user'=>$this->id_user));
		if($cek == null && $cek2 == null){
			$tombol = '<a class="btn btn-default btn-sm" href="'.CController::createUrl('/friends/find/addfriends',array('hash'=>$this->idUser->hash)).'"><i class="fa fa-plus"></i>
				Add Friend
			</a>';
		}elseif($cek != null && $cek2 == null){
			$tombol = '<div class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i>
				Waiting your friend confirm
			</div>';
		}elseif($cek == null && $cek2 != null){
			$tombol = '<a class="btn btn-default btn-sm" href="'.CController::createUrl('/friends/find/confirmfriends',array('hash'=>$this->idUser->hash)).'"><i class="fa fa-plus"></i>
				Confirm
			</a>';
		}
		return $tombol;
	}

	public function getButtonaddfriendm(){
		$cek = Friend::model()->findByAttributes(array('id_user'=>Yii::app()->user->id['id'],'id_user_friend'=>$this->id_user));
		$cek2 = Friend::model()->findByAttributes(array('id_user_friend'=>Yii::app()->user->id['id'],'id_user'=>$this->id_user));
		if($cek == null && $cek2 == null){
			$tombol = '<a style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;" href="'.CController::createUrl('/m/member/addfriends',array('q'=>$this->idUser->hash)).'"><i class="fa fa-plus"></i>
				Add Friend
			</a>';
		}elseif($cek != null && $cek2 == null){
			if($cek->approval == 0)
				$tombol = '<div style="padding: 5px; color: #bc5228; background-color: rgb(255, 255, 255); border-radius: 5px;"><i class="fa fa-clock-o"></i>
					Waiting your friend confirm
				</div>';
				else {
					/* $tombol = '<a style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;" href="'.CController::createUrl('/m/member/profile/',array('q'=>$this->idUser->hash)).'"><i class="fa fa-plus"></i>
						See and Heap
						</a>'; */
					$tombol = '';
				}
		}elseif($cek == null && $cek2 != null){
			if($cek2->approval == 0)
				$tombol = '<a style="padding: 5px; color: #bc5228; background-color: rgb(255, 255, 255); border-radius: 5px;" href="'.CController::createUrl('/m/member/confirmfriends',array('q'=>$this->idUser->hash)).'"><i class="fa fa-eye"></i>
					Confirm
				</a>';
				else {
					/* $tombol = '<a style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;" href="'.CController::createUrl('/m/member/profile/',array('q'=>$this->idUser->hash)).'"><i class="fa fa-plus"></i>
						See and Heap
						</a>'; */
					$tombol = '';
				}
		}
		return $tombol;
	}
	
	public function getIsFriend(){
		$cek = Friend::model()->findByAttributes(array('id_user'=>Yii::app()->user->id['id'],'id_user_friend'=>$this->id_user));
		$cek2 = Friend::model()->findByAttributes(array('id_user_friend'=>Yii::app()->user->id['id'],'id_user'=>$this->id_user));
		if($cek == null && $cek2 == null){
			return false;
		}elseif($cek != null && $cek2 == null){
			if($cek->approval == 0)
				return false;
			else {
				return true;
			}	
		}elseif($cek == null && $cek2 != null){
			if($cek2->approval == 0)
				return false;
			else {
				return true;
			}
		}
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
