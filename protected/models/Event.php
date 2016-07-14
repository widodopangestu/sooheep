<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $place
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class Event extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, date', 'required'),
            array('title', 'length', 'max' => 255),
            array('description, place', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, description, date, place', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::MANY_MANY, 'Users', 'users_attend(event_id, users_id_user)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'place' => 'Place',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('place', $this->place, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Event the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getIsAttend() {
        $model = UsersAttend::model()->findByAttributes(array(
        'event_id' => $this->id,
        'users_id_user' => Yii::app()->user->id['id']
        ));

        return ($model != null) ? true : false;
    }

}
