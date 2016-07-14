<?php

/**
 * This is the model class for table "interest_community".
 *
 * The followings are the available columns in table 'interest_community':
 * @property integer $id
 * @property integer $id_interest_group
 * @property string $community_name
 * @property string $community_hash
 * @property integer $isActive
 * @property integer $isPrivate
 * @property string $start_date
 *
 * The followings are the available model relations:
 * @property FeedsCommunity[] $feedsCommunities
 */
class InterestCommunity extends CActiveRecord
{

    public $userId;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'interest_community';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_interest_group, community_name, community_hash, isActive, isPrivate, start_date', 'required'),
            array('id_interest_group, isActive, isPrivate', 'numerical', 'integerOnly' => true),
            array('community_hash, community_name', 'length', 'max' => 255),
            array('userId', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_interest_group, community_name, community_hash, isActive, isPrivate, start_date, userId', 'safe', 'on' => 'search'),
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
            'feedsCommunities' => array(self::HAS_MANY, 'FeedsCommunity', 'id_interst_community'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_interest_group' => 'Id Interest Group',
            'community_name' => 'Community Name',
            'community_hash' => 'Community Hash',
            'isActive' => 'Is Active',
            'isPrivate' => 'Is Private',
            'start_date' => 'Start Date',
        );
    }

    public function getIsInterested()
    {
        $model = InterestCommunityMember::model()->findByAttributes(array(
            'id_user' => Yii::app()->user->id['id'],
            'id_interest_community' => $this->id
        ));

        return ($model !== null);
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_interest_group', $this->id_interest_group);
        $criteria->compare('community_name', $this->community_name, true);
        $criteria->compare('community_hash', $this->community_hash, true);
        $criteria->compare('isActive', $this->isActive);
        $criteria->compare('isPrivate', $this->isPrivate);
        $criteria->compare('start_date', $this->start_date, true);
        if (isset($this->userId)) {
            $idInterest = UserInterest::model()->findAll(array(
                'select' => 'id_interest',
                'where' => 'id_user=:userId',
                'params' => array(':userId' => $this->userId)
            ));
            $criteria->addInCondition('id_interest_group', $idInterest);
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchGroup($id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_interest_group', $id);
        $criteria->compare('community_name', $this->community_name);
        $criteria->compare('community_hash', $this->community_hash, true);
        $criteria->compare('isActive', $this->isActive);
        $criteria->compare('isPrivate', $this->isPrivate);
        $criteria->compare('start_date', $this->start_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTombolJoin()
    {
        $cek = InterestCommunityMember::model()->findAllByAttributes(array('id_user' => Yii::app()->user->id['id']));
        if ($cek != NULL)
            return CHtml::link('Visit', Yii::app()->createUrl('/group/interest/community', array('id' => $this->community_hash)), array('class' => 'btn btn-info btn-fill pull-right'));
        else
            return CHtml::link('Join Now', Yii::app()->createUrl('/group/interest/join', array('id' => $this->community_hash)), array('class' => 'btn btn-info btn-fill pull-right'));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InterestCommunity the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
