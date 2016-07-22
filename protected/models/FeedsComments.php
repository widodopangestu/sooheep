<?php

/**
 * This is the model class for table "feeds_comments".
 *
 * The followings are the available columns in table 'feeds_comments':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_feeds
 * @property string $comment
 * @property string $comment_date
 * @property integer $comment_deleted
 * @property string $delete_date
 * @property integer $blocked
 * @property integer $blocked_date
 *
 * The followings are the available model relations:
 * @property Feeds $idUser
 */
class FeedsComments extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'feeds_comments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, id_feeds, comment', 'required'),
            array('id_user, id_feeds, comment_deleted, blocked, blocked_date', 'numerical', 'integerOnly' => true),
            array('delete_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_user, id_feeds, comment, comment_date, comment_deleted, delete_date, blocked, blocked_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
            'idFeeds' => array(self::BELONGS_TO, 'Feeds', 'id_feeds'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_feeds' => 'Id Feeds',
            'comment' => 'Comment',
            'comment_date' => 'Comment Date',
            'comment_deleted' => 'Comment Deleted',
            'delete_date' => 'Delete Date',
            'blocked' => 'Blocked',
            'blocked_date' => 'Blocked Date',
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
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('id_feeds', $this->id_feeds);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('comment_date', $this->comment_date, true);
        $criteria->compare('comment_deleted', $this->comment_deleted);
        $criteria->compare('delete_date', $this->delete_date, true);
        $criteria->compare('blocked', $this->blocked);
        $criteria->compare('blocked_date', $this->blocked_date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getProfileuser() {
        $data = $this->idUser;
        $user = $data;
        if ($user != null) {
            $profile = $user->profiles;
            return $profile;
        } else {
            return null;
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FeedsComments the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'comment_date',
                'updateAttribute' => null,
                'timestampExpression' => new CDbExpression('NOW()'),
                'setUpdateOnCreate' => true,
            ),
        );
    }

    protected function afterSave()
    {
        $model = new Notification();
        if ($this->id_user != $this->idFeeds->user->id_user) {
            $user = Users::model()->findByPk($this->id_user);
            $name = $user->profiles->firstname . " " . $user->profiles->lastname;
            $model->type = Notification::TYPE_COMMENT_POST;
            $model->id_user = $this->idFeeds->user->id_user;
            $model->referation_link = Yii::app()->createUrl('m/feeds/feed', array('q' => $this->idFeeds->hash));
            $model->word = str_replace("{friend}", $name, $model->getDescription($model->type));
        } 
        $model->read = 0;
        $model->save(false);
        parent::afterSave();
    }
}
