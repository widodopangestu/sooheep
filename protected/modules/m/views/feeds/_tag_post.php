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
    <small><?php echo $data->user->fullName ?> tag on <?php echo $into; ?> By: <?php echo $data->tag->user->fullName; ?><br><?php echo $this->getFullDateTime($data->created_date) ?></small>
</div>
<?php if ($data->tag_id !== null): ?>
    <div class="box-tag" style="background: #e8e8e8; padding-left: 20px;">
        <?php
        $tag = $data->tag;
        switch ($tag->feedsAttributes->type) {
            case Feeds::TYPE_FILE_POST:
                $this->renderPartial('_file_post', array('data' => $tag));
                break;
            case Feeds::TYPE_MUSIC_POST:
                $this->renderPartial('_audio_post', array('data' => $tag));
                break;
            case Feeds::TYPE_VIDEO_POST:
                $this->renderPartial('_video_post', array('data' => $tag));
                break;
            case Feeds::TYPE_IMAGE_POST:
                $this->renderPartial('_img_post', array('data' => $tag));
                break;
            case Feeds::TYPE_TAG_POST:
                $this->renderPartial('_tag_post', array('data' => $tag));
                break;
            case Feeds::TYPE_REPOST_POST:
                $this->renderPartial('_repost_post', array('data' => $tag));
                break;
            case Feeds::TYPE_POLL_POST:
                $this->renderPartial('_poll_post', array('data' => $tag));
                break;
            default:
                $this->renderPartial('_text_post', array('data' => $tag));
                break;
        }
        ?>
    </div>
<?php endif; ?>