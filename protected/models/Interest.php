<?php

/**
 * This is the model class for table "interest".
 *
 * The followings are the available columns in table 'interest':
 * @property integer $id_interest
 * @property integer $id_group
 * @property integer $id_subgroup
 * @property string $interest_name
 *
 * The followings are the available model relations:
 * @property InterestGroup $idGroup
 * @property InterestSubgroup $idSubgroup
 */
class Interest extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'interest';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_group, id_subgroup, interest_name', 'required'),
            array('id_group, id_subgroup', 'numerical', 'integerOnly' => true),
            array('interest_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_interest, id_group, id_subgroup, interest_name', 'safe', 'on' => 'search'),
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
            'idGroup' => array(self::BELONGS_TO, 'InterestGroup', 'id_group'),
            'idSubgroup' => array(self::BELONGS_TO, 'InterestSubgroup', 'id_subgroup'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_interest' => 'Id Interest',
            'id_group' => 'Id Group',
            'id_subgroup' => 'Id Subgroup',
            'interest_name' => 'Interest Name',
        );
    }

    public function getIsInterested()
    {
        $model = UserInterest::model()->findByAttributes(array(
            'id_user' => Yii::app()->user->id['id'],
            'id_interest' => $this->id_interest
        ));

        if ($model != null)
            return true;
        else
            return false;
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

        $criteria->compare('id_interest', $this->id_interest);
        $criteria->compare('id_group', $this->id_group);
        $criteria->compare('id_subgroup', $this->id_subgroup);
        $criteria->compare('interest_name', $this->interest_name, true);
        $criteria->order = 'interest_name ASC';
        $criteria->limit = 50;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchMobile()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_interest', $this->id_interest);
        $criteria->compare('id_group', $this->id_group);
        $criteria->compare('id_subgroup', $this->id_subgroup);
        $criteria->compare('interest_name', $this->interest_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Interest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
