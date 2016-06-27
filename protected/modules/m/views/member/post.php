<li class="post">
    <div class="swipeout-actions-left">
        <a href="#" class="action-red js-add-to-fav">            
            <?php echo $data->user->profiles->getProfilePicture(); ?>
        </a>
    </div>

    <div class="swipeout-content">
        <div class="item-content no-padding">
            <div class="item-inner blog-list">
                <div class="feeds-content-<?php echo $data->id_feeds ?>">
                    <?php
                    switch ($data->feedsAttributes->type) {
                        case Feeds::TYPE_FILE_POST:
                            $this->renderPartial('_file_post', array('data' => $data));
                            break;
                        case Feeds::TYPE_MUSIC_POST:
                            $this->renderPartial('_audio_post', array('data' => $data));
                            break;
                        case Feeds::TYPE_VIDEO_POST:
                            $this->renderPartial('_video_post', array('data' => $data));
                            break;
                        case Feeds::TYPE_IMAGE_POST:
                            $this->renderPartial('_img_post', array('data' => $data));
                            break;
                        case Feeds::TYPE_TAG_POST:
                            $this->renderPartial('_tag_post', array('data' => $data));
                            break;
                        case Feeds::TYPE_REPOST_POST:
                            $this->renderPartial('_repost_post', array('data' => $data));
                            break;
                        default:
                            $this->renderPartial('_text_post', array('data' => $data));
                            break;
                    }
                    ?>
                </div>
                <a data-popup=".popup-repost" onclick="loadFeeds($(this));" class="link open-popup text" href="#" id="<?php echo $data->id_feeds ?>">
                    <span class="fa fa-retweet"style="color: #bc5228;"></span>
                </a> 
            </div>
        </div>
    </div>

</li>