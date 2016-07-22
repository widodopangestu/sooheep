<?php

/**
 * This is the model class for table "friend".
 *
 * The followings are the available columns in table 'friend':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_user_friend
 * @property integer $approval
 * @property integer $heap
 * @property string $request_date
 * @property string $approval_date
 * @property integer $block
 * @property string $block_date
 *
 * The followings are the available model relations:
 * @property Users $idUser
 * @property Users $idUserFriend
 */
class Friend extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'friend';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, id_user_friend, approval, heap, request_date', 'required'),
            array('id_user, id_user_friend, approval, heap, block', 'numerical', 'integerOnly' => true),
            array('approval_date, block_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_user, id_user_friend, approval, heap, request_date, approval_date, block, block_date', 'safe', 'on' => 'search'),
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
            'idUserFriend' => array(self::BELONGS_TO, 'Users', 'id_user_friend'),
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
            'id_user_friend' => 'Id User Friend',
            'approval' => 'Approval',
            'heap' => 'Heap',
            'request_date' => 'Request Date',
            'approval_date' => 'Approval Date',
            'block' => 'Block',
            'block_date' => 'Block Date',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('id_user_friend', $this->id_user_friend);
        $criteria->compare('approval', $this->approval);
        $criteria->compare('heap', $this->heap);
        $criteria->compare('request_date', $this->request_date, true);
        $criteria->compare('approval_date', $this->approval_date, true);
        $criteria->compare('block', $this->block);
        $criteria->compare('block_date', $this->block_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Friend the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function afterSave()
    {
        $model = new Notification();
        if ($this->approval == 0) {
            $user = Users::model()->findByPk($this->id_user);
            $name = $user->profiles->firstname . " " . $user->profiles->lastname;
            $model->type = Notification::TYPE_ADD_FRIEND;
            $model->id_user = $this->id_user_friend;
            $model->referation_link = Yii::app()->createUrl('/m/member/profile', array('q' => $user->hash));
            $model->word = str_replace("{friend}", $name, $model->getDescription($model->type));
        } else {
            $user = Users::model()->findByPk($this->id_user_friend);
            $name = $user->profiles->firstname . " " . $user->profiles->lastname;
            $model->type = Notification::TYPE_ACCEPT_FRIEND;
            $model->id_user = $this->id_user;
            $model->referation_link = Yii::app()->createUrl('/m/member/profile', array('q' => $user->hash));
            $model->word = str_replace("{friend}", $name, $model->getDescription($model->type));
        }
        $model->read = 0;
        $model->save(false);
        parent::afterSave();
    }

}
