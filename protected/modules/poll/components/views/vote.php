<?php
if (Yii::app()->user->id['id'] == $model->feed->id_user) {
    if ($model->status == Poll::STATUS_OPEN) {
        echo CHtml::ajaxLink(
                'Close Poll', array('/poll/poll/close', 'id' => $model->id, 'ajax' => TRUE), array(
            'type' => 'POST',
            'success' => 'js:function(){window.location.reload();}',
                ), array(
            'class' => 'close-poll-status',
            'confirm' => 'Are you sure you want to close your poll?'
                )
        );
    } else {
        echo CHtml::ajaxLink(
                'Open Poll', array('/poll/poll/open', 'id' => $model->id, 'ajax' => TRUE), array(
            'type' => 'POST',
            'success' => 'js:function(){window.location.reload();}',
                ), array(
            'class' => 'open-poll-status',
            'confirm' => 'Are you sure you want to open your poll?'
                )
        );
    }
}
?>
<div class="form-row">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'portlet-poll-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="input-text">
        <?php echo $form->labelEx($userVote, 'choice_id'); ?>
        <?php $template = '<div class="row-choice clearfix"><div class="form-radio">{input}</div><div class="form-label">{label}</div></div>'; ?>
        <?php
        echo $form->radioButtonList($userVote, 'choice_id', $choices, array(
            'template' => $template,
            'separator' => '',
            'name' => 'PortletPollVote_choice_id'));
        ?>
        <?php echo $form->error($userVote, 'choice_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Vote'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->