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
<div class="file download-file">
    <?php echo CHtml::link('<p style="color:#bc5228;"><span class="fa fa-file"></span> ' . $data->feedsAttributes->file_name ."</p>", Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->feedsAttributes->description); ?>

</div>
<div class="text">
    <small><?php echo $user->firstname . " " . $user->lastname ?> heap on <?php echo $into; ?> <br><?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
</div>