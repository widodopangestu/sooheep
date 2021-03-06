<?php

class ChatController extends Controller
{

    public $layout = '//layouts/main';
    public $defaultAction = 'personal';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('personal', 'group', 'community'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionPersonal()
    {
        $fren = new Friend;
                $fren->id_user = 29;
                $fren->id_user_friend = 30;
                $fren->approval = 0;
                $fren->heap = 1;
                $fren->request_date = date("Y-m-d H:i:s");
                echo  'test gan';
                $fren->save();
                exit();
                        
        $this->render('personal', array());
    }

    public function actionGroup()
    {
        $this->render('personal', array());
    }

    public function actionCommunity($q)
    {
        $this->render('community', array());
    }

}
