<div class="image">
    <img src="<?php echo Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->feedsAttributes->description ?>" alt="" /> 
</div>
<div class="text">
    <small><?php echo $data->user->fullName ?> at <?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
</div>