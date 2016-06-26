<div class="text">
    <video id="player" class="video-js vjs-default-skin" controls preload="none"  width="640" height="264" poster="http://vjs.zencdn.net/v/oceans.png" data-setup="{}">
        <source src="<?php echo Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->feedsAttributes->description ?>" type="<?php echo $videoType ?>">
        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
    </video>
</div>
<div class="text">
    <small><?php echo $data->user->fullName ?> at <?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
</div>