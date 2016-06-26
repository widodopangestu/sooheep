<div class="image">
	<a href="#"> 
	<img src="<?php echo Yii::app()->request->baseUrl.$data->feedsAttributes->description ?>" alt="" /> 
	</a>
</div>
<div class="text">
	<small><?php echo $user->firstname." ".$user->lastname?> at <?php echo $this->getFullDateTime($data->created_date)?></small>
	<p><?php echo $data->text_caption?></p>
</div>