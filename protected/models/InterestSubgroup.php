<?php

/**
 * This is the model class for table "interest_subgroup".
 *
 * The followings are the available columns in table 'interest_subgroup':
 * @property integer $id
 * @property integer $id_interest_group
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Interest[] $interests
 */
class InterestSubgroup extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'interest_subgroup';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_interest_group, name', 'required'),
            array('id_interest_group', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_interest_group, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'interests' => array(self::HAS_MANY, 'Interest', 'id_subgroup'),
            'group' => array(self::BELONGS_TO, 'InterestGroup', 'id_interest_group'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_interest_group' => 'Id Interest Group',
            'name' => 'Name',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_interest_group', $this->id_interest_group);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchMobile() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_interest_group', $this->id_interest_group);
        $criteria->compare('name', $this->name, true);
        $criteria->order = 'name ASC';
        $criteria->limit = 50;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InterestSubgroup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
