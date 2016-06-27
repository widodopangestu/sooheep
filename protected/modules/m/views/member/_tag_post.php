<div class="text">
    <small>Tag By: <?php echo $data->tag->user->fullName;?> at <?php echo $this->getFullDateTime($data->created_date) ?></small>
</div>
<?php if ($data->tag_id !== null): ?>
    <div class="swipeout-content">
        <div class="item-content no-padding">
            <div class="item-inner blog-list">
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
                    default:
                        $this->renderPartial('_text_post', array('data' => $tag));
                        break;
                }
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>