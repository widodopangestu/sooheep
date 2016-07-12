<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'comment-form-' . $id_feeds,
    'enableAjaxValidation' => true,
        ));
?>
<li>
    <div class="swipeout-actions-left">
        <a href="#" class="action-red">
            <?php echo $this->getProfilePicture('', '', Yii::app()->user->id['id']) ?>
        </a>
    </div>
    <div class="" style="margin-left: 60px; padding: 10px;">
        <?php echo $form->textArea($model, 'comment', array('rows' => 2, 'cols' => 40, 'style' => 'background:#fff; padding:5px;')); ?>
        <?php
        echo CHtml::button("Send", array('onclick' => 'addComment('.$id_feeds.')', 'style' => 'margin: 10px 0;'));
        ?>
    </div>
</li>
<?php $this->endWidget(); ?>