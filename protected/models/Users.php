<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id_user
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $hash
 * @property integer $id_roles
 * @property integer $activation
 *
 * The followings are the available model relations:
 * @property Profile[] $profiles
 * @property Role $idRoles
 */
class Users extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, hash, id_roles', 'required'),
            array('id_roles', 'numerical', 'integerOnly' => true),
            array('email, username, password, hash', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_user, email, username, password, hash, id_roles, activation', 'safe'),
            array('id_user, email, username, password, hash, id_roles, activation', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profiles' => array(self::HAS_ONE, 'Profile', 'id_user'),
            'idRoles' => array(self::BELONGS_TO, 'Role', 'id_roles'),
            'userInterests' => array(self::HAS_MANY, 'UserInterest', 'id_user'),
            'userCommunities' => array(self::HAS_MANY, 'InterestCommunityMember', 'id_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_user' => 'Id User',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'hash' => 'Hash',
            'id_roles' => 'Id Roles',
            'activation' => 'Is Activation',
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

        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('hash', $this->hash, true);
        $criteria->compare('id_roles', $this->id_roles);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getInterest() {
        return $interst = UserInterest::model()->findAllByAttributes(array('id_user' => $this->id_user));
    }

    public function getFullName() {
        return $this->profiles->firstname . " " . $this->profiles->lastname;
    }

    public function getPictureUrl() {
        $profile = ImageProfile::model()->find(array(
            'condition' => 'image_type = :tipe AND id_user = :idUser',
            'params' => array(
                ':tipe' => ImageProfile::TYPE_PROFILE_PICTURE,
                ':idUser' => $this->id_user,
            ),
            'order' => 'created_date DESC'
        ));
        if ($profile == null)
            return Yii::app()->theme->baseUrl . "/images/baby-ant.png";
        else
            return str_replace('best', 'thumb', Yii::app()->request->baseUrl . $profile->image_path);
    }

    public function getIdInterest() {
        $group = array();
        $subgroup = array();
        $interest = array();
        foreach ($this->userInterests as $userInterest) {
            $int = $userInterest->idInterest;
            $group[] = $int->id_group;
            $subgroup[] = $int->id_subgroup;
            $interest[] = $int->id_interest;
        }
        return array('group' => $group, 'subgroup' => $subgroup, 'interest' => $interest);
    }

    public function getIdCommunity() {
        $com = array();
        foreach ($this->userCommunities as $userCommunity) {
            $com[] = $userCommunity->id_interest_community;
        }
        return $com;
    }

    public function getFriendsId() {
        $sql = "SELECT friend.id_user_friend , friend.id_user FROM friend WHERE (friend.id_user = $this->id_user OR friend.id_user_friend = $this->id_user) AND block = 0";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $fr = array();
        foreach ($result as $res) {
            if(!in_array($res['id_user_friend'], $fr))
                $fr[] = $res['id_user_friend'];
            if(!in_array($res['id_user'], $fr))
                $fr[] = $res['id_user'];
        }
        return $fr;
    }

    public function getLinkFullName() {
        return CHtml::link('<span style="color:#bc5228;">' . $this->profiles->firstname . ' ' . $this->profiles->lastname . '</span>', array('member/profile', 'q' => $this->hash));
    }

}
