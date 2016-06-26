<?php

/**
 * This is the model class for table "image_profile".
 *
 * The followings are the available columns in table 'image_profile':
 * @property integer $id_image_profile
 * @property integer $id_user
 * @property integer $image_type
 * @property string $image_path
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Users $idUser
 */
class ImageProfile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	const TYPE_PROFILE_PICTURE = 1;
	const TYPE_BACKGROUND_PICTURE = 2;
	const TYPE_GROUP_PROFILE_PICTURE = 3;
	const TYPE_GROUP_BACKGROUND_PICTURE = 4;
	
	public function tableName()
	{
		return 'image_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, image_type, image_path, created_date', 'required'),
			array('id_user, image_type', 'numerical', 'integerOnly'=>true),
			array('image_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_image_profile, id_user, image_type, image_path, created_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_image_profile' => 'Id Image Profile',
			'id_user' => 'Id User',
			'image_type' => 'Image Type',
			'image_path' => 'Image Path',
			'created_date' => 'Created Date',
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

		$criteria->compare('id_image_profile',$this->id_image_profile);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('image_type',$this->image_type);
		$criteria->compare('image_path',$this->image_path,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImageProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
