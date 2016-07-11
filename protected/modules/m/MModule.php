<?php

class MModule extends CWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'm.models.*',
            'm.components.*',
            'poll.components.*',
            'poll.models.*',
        ));
        Yii::app()->theme = 'mobile';
        Yii::app()->setComponents(array(
            'user' => array(
                'class' => 'CWebUser',
                'loginRequiredAjaxResponse' => 'Your session expired, login and try again',
                'autoRenewCookie' => false,
                'allowAutoLogin' => false,
                'stateKeyPrefix' => 'user_',
                'loginUrl' => Yii::app()->createUrl('/m/member/login'),
            ),
                ), false);
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
