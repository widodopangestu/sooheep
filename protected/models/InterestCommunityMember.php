<?php

/**
 * This is the model class for table "interest_community_member".
 *
 * The followings are the available columns in table 'interest_community_member':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_interest_community
 * @property integer $id_interest
 * @property string $join_date
 * @property integer $active
 * @property string $date
 */
class InterestCommunityMember extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'interest_community_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_interest_community, id_interest, join_date, active, date', 'required'),
			array('id_user, id_interest_community, id_interest, active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_interest_community, id_interest, join_date, active, date', 'safe', 'on'=>'search'),
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
			'idInterestComunity' => array(self::BELONGS_TO, 'InterestCommunity', 'id_interest_community'),
			'idInterest' => array(self::BELONGS_TO, 'Interest', 'id_interest'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_interest_community' => 'Id Interest Community',
			'id_interest' => 'Id Interest',
			'join_date' => 'Join Date',
			'active' => 'Active',
			'date' => 'Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_interest_community',$this->id_interest_community);
		$criteria->compare('id_interest',$this->id_interest);
		$criteria->compare('join_date',$this->join_date,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InterestCommunityMember the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
