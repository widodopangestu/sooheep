<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id_notification
 * @property string $word
 * @property integer $type
 * @property integer $id_user
 * @property string $date_create
 * @property string $referation_link
 * @property integer $read
 *
 * The followings are the available model relations:
 * @property Users $idUser
 */
class Notification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const TYPE_COMMENT_POST = 1;
	const TYPE_TAGGING = 2;
	const TYPE_ADD_FRIEND = 3;
	const TYPE_MESSAGE = 4;
	const TYPE_SUGESTION = 5;
	const TYPE_HEAP_LEVEL = 6;
	const TYPE_INVITE = 7;
	
	public function getTypeDescription(){
		switch ($this->type) {
			case self::TYPE_COMMENT_POST:
				return "{friend} Commented your heap";
			break;
			case self::TYPE_TAGGING:
				return "{friend} Tagging you in his heap";
			break;
			case self::TYPE_ADD_FRIEND:
				return "{friend} Want to be your friend";
			break;
			case self::TYPE_MESSAGE:
				return "{friend} Send Message to you";
			break;
			case self::TYPE_SUGESTION:
				return "{friend} Suggestion You";
			break;	
			case self::TYPE_HEAP_LEVEL:
				return "{friend} Increase Your heap level";
			break;	
		}
	}
	
	public function tableName()
	{
		return 'notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('word, type, id_user, date_create, referation_link', 'required'),
			array('type, id_user', 'numerical', 'integerOnly'=>true),
			array('referation_link', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_notification, word, type, id_user, date_create, referation_link, read', 'safe'),
			array('id_notification, word, type, id_user, date_create, referation_link, read', 'safe', 'on'=>'search'),
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
			'id_notification' => 'Id Notification',
			'word' => 'Word',
			'type' => 'Type',
			'id_user' => 'Id User',
			'date_create' => 'Date Create',
			'referation_link' => 'Referation Link',
			'read' => 'Read',
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

		$criteria->compare('id_notification',$this->id_notification);
		$criteria->compare('word',$this->word,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('referation_link',$this->referation_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
