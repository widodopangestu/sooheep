<div class="audio">
    <audio controls>
        <source src="<?php echo Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->feedsAttributes->description ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</div>
<div class="text">
    <small><?php echo $data->user->fullName ?> at <?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
</div>