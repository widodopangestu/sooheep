<?php

class DefaultController extends Controller {

    public $layout = '//layouts/main';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionPlayer() {
        $videoUrl = "";
        if (isset($_GET['v'])) {
            $videoUrl = Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $_GET['v'];
        }
        $this->renderPartial('player', array(
            'videoUrl' => $videoUrl,
            'videoType' => 'video/mp4'
                ), false, true);
    }

}
