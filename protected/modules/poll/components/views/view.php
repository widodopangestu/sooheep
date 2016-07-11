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

<?php $this->render('results', array('model' => $model)); ?>

<?php if ($userVote->id): ?>
    <p id="pollvote-<?php echo $userVote->id ?>">
        You voted: <strong><?php echo $userChoice->label ?></strong>.
        <?php
        if ($userCanCancel) {
            echo CHtml::ajaxLink(
                    'Cancel Vote', array('/poll/pollvote/delete', 'id' => $userVote->id, 'ajax' => TRUE), array(
                'type' => 'POST',
                'success' => 'js:function(){window.location.reload();}',
                    ), array(
                'class' => 'cancel-vote button button-fill',
                'confirm' => 'Are you sure you want to cancel your vote?'
                    )
            );
        }
        ?>
    </p>
<?php endif; ?>