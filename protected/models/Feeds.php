<?php

/**
 * This is the model class for table "feeds".
 *
 * The followings are the available columns in table 'feeds':
 * @property integer $id_feeds
 * @property integer $id_user
 * @property string $text_caption
 * @property string $hash
 * @property string $created_date
 * @property string $update_date
 * @property integer $isDeleted
 * @property string $deleted_date
 * @property integer $post_type
 * @property integer $post_interest_id
 * @property integer $post_community_id
 * @property integer $tag_id
 * @property integer $repost_id
 * @property integer $poll_id
 * @property integer $event_id
 *
 * The followings are the available model relations:
 * @property Feeds $tag
 * @property Feeds[] $feeds
 * @property Feeds $repost
 * @property Feeds[] $feeds1
 * @property Poll $poll
 * @property Event $event
 * @property FeedsAttributes[] $feedsAttributes
 * @property FeedsComments[] $feedsComments
 * @property FeedsCommunity[] $feedsCommunities
 */
class Feeds extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public $location;
    public $type;
    public $idUsers;
    public $file;
    public $fileName = "";
    public $filePath = "";
    public $link = "";
    public $jsonMention = "";

    const TYPE_TEXT_POST = 1;
    const TYPE_IMAGE_POST = 2;
    const TYPE_LINK_POST = 3;
    const TYPE_VIDEO_POST = 4;
    const TYPE_ACTIVITY_POST = 5;
    const TYPE_MUSIC_POST = 6;
    const TYPE_LOCATION_POST = 7;
    const TYPE_FILE_POST = 8;
    const TYPE_TAG_POST = 9;
    const TYPE_REPOST_POST = 10;
    const TYPE_POLL_POST = 11;
    const TYPE_EVENT_POST = 12;
    const POST_USER = 1;
    const POST_GROUP = 2;
    const POST_COMMUNITY = 3;

    public function tableName()
    {
        return 'feeds';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, text_caption, hash', 'required'),
            //array('images','file','types'=>'jpg,jpeg,gif,png','maxSize'=>10*1024*1024, 'on' => 'uploadImg'),
            array('id_user, isDeleted, tag_id, repost_id, poll_id, event_id', 'numerical', 'integerOnly' => true),
            array('update_date, hash, deleted_date, post_type, post_interest_id, post_community_id, type, filePath, fileName, location, tag_id, repost_id, jsonMention', 'safe'),
            array('file', 'file', 'types' => 'pdf, xls, xlsx, doc, docx, ppt, pptx, odt, ods, odp, zip, rar, txt, mp4, mp3, png, jpg, jpeg', 'allowEmpty' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_feeds, id_user, text_caption, hash, created_date, update_date, isDeleted, deleted_date', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'id_user'),
            'tag' => array(self::BELONGS_TO, 'Feeds', 'tag_id'),
            'tagFeeds' => array(self::HAS_MANY, 'Feeds', 'tag_id'),
            'repost' => array(self::BELONGS_TO, 'Feeds', 'repost_id'),
            'repostFeeds' => array(self::HAS_MANY, 'Feeds', 'repost_id'),
            'poll' => array(self::BELONGS_TO, 'Poll', 'poll_id'),
            'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
            'feedsAttributes' => array(self::HAS_ONE, 'FeedsAttributes', 'id_feeds'),
            'feedsCommunities' => array(self::HAS_MANY, 'FeedsCommunity', 'id_feeds'),
            'feedsComment' => array(self::HAS_MANY, 'FeedsComments', 'id_feeds', 'condition' => 'comment_deleted IS NULL AND blocked IS NULL'),
            'feedsCommentCount' => array(self::STAT, 'FeedsComments', 'id_feeds', 'condition' => 'comment_deleted IS NULL AND blocked IS NULL'),
        );
    }

    public function beforeValidate()
    {
        if ($this->type !== Feeds::TYPE_TAG_POST) {
            $user = Yii::app()->user->id;
            $this->id_user = $user['id'];
            $hash = strval(time()) . strval($user['id']);
            $this->hash = sha1($hash);
        }
        return true;
    }

    public function behaviors()
    {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_date',
                'updateAttribute' => 'update_date',
                'timestampExpression' => new CDbExpression('NOW()'),
                'setUpdateOnCreate' => true,
            ),
        );
    }

    public function afterSave()
    {
        $attributes = new FeedsAttributes;
        $attributes->id_feeds = $this->id_feeds;
        $attributes->type = $this->type;
        $attributes->description = $this->getDescription();
        $attributes->file_name = $this->fileName;
        if (!$attributes->save()) {
            throw new CDbException("Error Save : " . print_r($attributes->getErrors(), TRUE));
        }
        if ($this->jsonMention !== "")
            $this->generateFeedTags($this);
    }

    public function getDescription()
    {
        $description = "Text";
        switch ($this->type) {
            case self::TYPE_ACTIVITY_POST:
                $description = "Activity";
                break;
            case self::TYPE_LINK_POST:
                $description = "Link";
                break;
            case self::TYPE_TEXT_POST:
                $description = $this->text_caption;
                break;
            case self::TYPE_MUSIC_POST:
            case self::TYPE_FILE_POST:
            case self::TYPE_IMAGE_POST:
            case self::TYPE_VIDEO_POST:
                $description = $this->filePath;
                break;
            case self::TYPE_LOCATION_POST:
                $description = $this->location;
                break;
            case self::TYPE_TAG_POST:
                $description = "Tag";
                break;
            case self::TYPE_REPOST_POST:
                $description = "Repost";
                break;
            case self::TYPE_POLL_POST:
                $description = "Poll";
                break;
            case self::TYPE_EVENT_POST:
                $description = "Event";
                break;
        }
        return $description;
    }

    public function getAllHomeFeeds($me = FALSE, $id = NULL)
    {
        $criteria = new CDbCriteria;
        if ($me) {
            $id_user = intval(Yii::app()->user->id['id']);
            $criteria->condition = 't.id_user = :id';
        } else {
            if ($id == NULL) {
                $id_user = intval(Yii::app()->user->id['id']);
                $user = Users::model()->findByPk($id_user);
                $community = implode(',', $user->idCommunity);
                $interest = implode(',', $user->idInterest['interest']);
                $fried = implode(',', $user->friendsId);
                count($user->idCommunity) ? $whereCom = ' OR t.post_community_id IN (' . $community . ')' : $whereCom = '';
                count($user->idInterest['interest']) ? $whereInt = ' OR t.post_interest_id IN (' . $interest . ')' : $whereInt = '';
                count($user->friendsId) ? $whereFr = ' OR t.id_user IN (' . $fried . ') ' : $whereFr = '';
                $criteria->condition = 't.id_user = :id' . $whereFr . $whereCom . $whereInt;
            } else {
                $id_user = intval($id);
                $criteria->condition = 't.id_user = :id';
            }
        }

        $criteria->order = "t.created_date DESC";
        $criteria->params = array(
            ':id' => $id_user,
                //':typePost' => self::POST_USER
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getAllCommunityfeedsHome()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '(t.id_user IN (SELECT friend.id_user_friend FROM friend WHERE friend.id_user = :id AND block = 0) OR t.id_user = :id) AND t.post_community_id IS NOT NULL';
        $criteria->order = "t.created_date DESC";
        $criteria->params = array(
            ':id' => Yii::app()->user->id['id'],
            ':typePost' => self::POST_USER
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getAllGroupFeeds($interest, $type = null)
    {
        $criteria = new CDbCriteria;
        $whereType = '';
        if ($type != null) {
            $criteria->join = 'join feeds_attributes fa on (t.id_feeds = fa.id_feeds)';
            $whereType = ' AND fa.type = :type';
        }
        $criteria->condition = '(t.id_user IN (SELECT friend.id_user_friend FROM friend WHERE friend.id_user = :id AND block = 0) OR t.id_user = :id OR t.id_user IN (SELECT user_interest.id_user FROM user_interest WHERE user_interest.id_interest = :idInterest)) AND t.post_type = :typePost AND t.post_interest_id = :idInterest' . $whereType;
        $criteria->order = "t.created_date DESC";
        $criteria->params = array(
            ':id' => Yii::app()->user->id['id'],
            ':idInterest' => $interest,
            ':typePost' => self::POST_GROUP,
            ':type' => $type
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getAllCommunityFeeds($interest, $type = null)
    {
        $criteria = new CDbCriteria;
        $whereType = '';
        if ($type != null) {
            $criteria->join = 'join feeds_attributes fa on (t.id_feeds = fa.id_feeds)';
            $whereType = ' AND fa.type = :type';
        }
        $criteria->condition = '(t.id_user IN (SELECT friend.id_user_friend FROM friend WHERE friend.id_user = :id AND block = 0) OR t.id_user = :id OR t.id_user IN (SELECT interest_community_member.id_user FROM interest_community_member WHERE interest_community_member.id_interest_community = :idInterest)) AND t.post_type = :typePost AND t.post_community_id = :idInterest' . $whereType;
        $criteria->order = "t.created_date DESC";
        $criteria->params = array(
            ':id' => Yii::app()->user->id['id'],
            ':idInterest' => $interest,
            ':typePost' => self::POST_COMMUNITY,
            ':type' => $type
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getInterest()
    {
        return Interest::model()->findByPk($this->post_interest_id);
    }

    public function getCommunityFeed()
    {
        return InterestCommunity::model()->findByPk($this->post_community_id);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_feeds' => 'Id Feeds',
            'id_user' => 'Id User',
            'text_caption' => 'Text Caption',
            'hash' => 'Hash',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
            'isDeleted' => 'Is Deleted',
            'deleted_date' => 'Deleted Date',
        );
    }

    public function getComments()
    {
        $id = $this->id_feeds;
        $model = FeedsComments::model()->findAll(array(
            'condition' => 'id_feeds = :idFeeds',
            'params' => array(
                ':idFeeds' => $id
            ),
            'order' => 'comment_date ASC'
        ));
        return $model;
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

        $criteria->compare('id_feeds', $this->id_feeds);
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('text_caption', $this->text_caption, true);
        $criteria->compare('hash', $this->hash);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('isDeleted', $this->isDeleted);
        $criteria->compare('deleted_date', $this->deleted_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feeds the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function generateFeedTags($feed)
    {
        $mentions = CJSON::decode($feed->jsonMention);
        foreach ($mentions as $mention) {
            $model = new Feeds;
            if ($mention['type'] == "user") {
                $model->id_user = $mention['id'];
                $notif = new Notification();
                $user = Users::model()->findByPk($feed->id_user);
                $name = $user->profiles->firstname . " " . $user->profiles->lastname;
                $notif->type = Notification::TYPE_TAGGING;
                $notif->id_user = $model->id_user;
                $notif->referation_link = Yii::app()->createUrl('m/feeds/feed', array('q' => $feed->hash));
                $notif->word = str_replace("{friend}", $name, $notif->getDescription($notif->type));
                $notif->read = 0;
                $notif->save(false);
            } else if ($mention['type'] == "interest") {
                $model->post_interest_id = $mention['id'];
                $model->post_type = Feeds::POST_GROUP;
                $model->id_user = $feed->id_user;
            }
            $model->text_caption = "-"; //$feed->text_caption
            $model->hash = $feed->hash;
            $model->tag_id = $feed->id_feeds;
            $model->type = Feeds::TYPE_TAG_POST;
            $model->save();
        }
    }

    public function getCountRepost()
    {
        $sql = "SELECT count(id_feeds) as total FROM feeds WHERE repost_id ='" . $this->id_feeds . "'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $res = 0;
        if ($result) {
            $res = $result['total'];
        }
        return $res;
    }

}
