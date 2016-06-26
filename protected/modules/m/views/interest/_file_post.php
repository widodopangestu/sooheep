<div class="file download-file">
    <?php echo CHtml::link('<p style="color:#bc5228;"><span class="fa fa-file"></span> ' . $data->feedsAttributes->file_name ."</p>", Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->feedsAttributes->description, array("onclick" => "window.location.href = '" . Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->feedsAttributes->description . "';")); ?>

</div>
<div class="text">
    <small><?php echo $data->user->fullName ?> at <?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
</div>