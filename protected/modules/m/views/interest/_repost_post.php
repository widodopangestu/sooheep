<div class="text">
    <small><?php echo $data->user->fullName ?> repost at <?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
</div>
<?php if ($data->repost_id !== null): ?>
    <div class="box-repost" style="background: #e8e8e8; padding-left: 20px;">
        <?php
        $repost = $data->repost;
        switch ($repost->feedsAttributes->type) {
            case Feeds::TYPE_FILE_POST:
                $this->renderPartial('_file_post', array('data' => $repost));
                break;
            case Feeds::TYPE_MUSIC_POST:
                $this->renderPartial('_audio_post', array('data' => $repost));
                break;
            case Feeds::TYPE_VIDEO_POST:
                $this->renderPartial('_video_post', array('data' => $repost));
                break;
            case Feeds::TYPE_IMAGE_POST:
                $this->renderPartial('_img_post', array('data' => $repost));
                break;
            case Feeds::TYPE_TAG_POST:
                $this->renderPartial('_tag_post', array('data' => $repost));
                break;
            case Feeds::TYPE_REPOST_POST:
                $this->renderPartial('_repost_post', array('data' => $repost));
                break;
            case Feeds::TYPE_POLL_POST:
                $this->renderPartial('_poll_post', array('data' => $repost));
                break;
            default:
                $this->renderPartial('_text_post', array('data' => $repost));
                break;
        }
        ?>
    </div>
<?php endif; ?>