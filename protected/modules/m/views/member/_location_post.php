<?php
switch ($data->post_type) {
    case Feeds::POST_COMMUNITY :
        $into = "" . $data->communityFeed->community_name;
        break;
    case Feeds::POST_GROUP :
        $into = $data->interest->interest_name;
        break;
    default:
        $into = "timeline";
        break;
}
?>
<div class="text">
    <small><?php echo $data->user->fullName ?> heap on <?php echo $into; ?> <br><?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
    <div style="font-size: 13px;background: #f7f7f8;padding: 15px;border-radius: 5px;">
        <?php $coordinate = explode(',', $data->feedsAttributes->description); ?>
        <iframe id="frame-map" name="frame-map" src="<?php echo CController::createUrl('/m/interest/showMap', array('lat' => $coordinate[0], 'lng' => $coordinate[1])); ?>" width="100%" height="400px" frameBorder="0">
        </iframe>
    </div>
</div>