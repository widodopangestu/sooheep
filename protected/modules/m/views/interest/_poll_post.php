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
        <?php
        $this->widget('EPoll', array('poll_id' => $data->poll_id));
        ?>
    </div>
</div>