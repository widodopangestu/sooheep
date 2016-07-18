<?php if ($data->id_user != $data->tag->id_user): ?>
    <li class="post">
        <div class="swipeout-actions-left">
            <a href="#" class="action-red js-add-to-fav">
                <?php echo $data->user->profiles->getProfilePicture(); ?>
            </a>
        </div>

        <div class="swipeout-content">
            <div class="item-content no-padding">
                <div class="item-inner blog-list">
                    <?php
                    $user = Users::model()->findByPk(Yii::app()->user->id['id']);
                    ?>
                    <?php if (in_array($data->user->id_user, $user->friendsId) || $data->user->id_user == $user->id_user): ?>

                        <div class="feeds-content-<?php echo $data->id_feeds ?>">
                            <?php
                            switch ($data->feedsAttributes->type) {
                                case Feeds::TYPE_LOCATION_POST:
                                    $this->renderPartial('_location_post', array('data' => $data));
                                    break;
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
                                case Feeds::TYPE_POLL_POST:
                                    $this->renderPartial('_poll_post', array('data' => $data));
                                    break;
                                case Feeds::TYPE_EVENT_POST:
                                    $this->renderPartial('_event_post', array('data' => $data));
                                    break;
                                default:
                                    $this->renderPartial('_text_post', array('data' => $data));
                                    break;
                            }
                            ?>
                        </div>
                        <a data-popup=".popup-repost" onclick="loadFeeds($(this));" class="link open-popup text" href="#" id="<?php echo $data->id_feeds ?>">
                            <span class="fa fa-retweet"style="color: #bc5228;"> <?php echo $data->countRepost; ?> repost(s)</span>
                        </a> 
                        <a class="link text" href="#" id="<?php echo $data->id_feeds ?>">
                            <span class="fa fa-comment"style="color: #bc5228;"> <span id="comment-count-<?php echo $data->id_feeds ?>"><?php echo $data->feedsCommentCount; ?></span> comment(s)</span>
                        </a> 
                        <div id="comments-<?php echo $data->id_feeds ?>" style="
                             margin-left: 80px;
                             margin-right: 10px;
                             background: #f7f7f8;
                             ">
                                 <?php if ($data->feedsCommentCount > 3): ?>
                                <a data-popup=".popup-comments" onclick="loadComments(<?php echo $data->id_feeds ?>);" class="link open-popup" href="#">
                                    <span style="color: #bc5228;">Load more comments ...</span>
                                </a> 
                            <?php endif; ?>
                            <ul style="padding-left: 0;" id="list-comment-<?php echo $data->id_feeds ?>">
                                <?php if ($data->feedsCommentCount >= 1): ?>
                                    <?php
                                    $cr = new CDbCriteria();
                                    $cr->limit = 3;
                                    $this->renderPartial('/comments/_comments', array(
                                        'comments' => $data->feedsComment($cr),
                                    ));
                                    ?>
                                <?php endif; ?>
                            </ul>
                            <div class="form-comment">
                                <?php
                                $this->renderPartial('/comments/_comment_form', array(
                                    'model' => new FeedsComments(),
                                    'id_feeds' => $data->id_feeds
                                ));
                                ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text">
                            <?php
                            switch ($data->post_type) {
                                case Feeds::POST_COMMUNITY :
                                    $into = "" . $data->communityFeed->linkName;
                                    break;
                                case Feeds::POST_GROUP :
                                    $into = $data->interest->linkName;
                                    break;
                                default:
                                    $into = "timeline";
                                    break;
                            }
                            ?>
                            <small><?php echo $data->user->linkFullName ?> have posted <?php echo $data->feedsAttributes->typeText ?> in <?php echo $into; ?> <a href='#' id='hideshow-<?php echo $data->id_feeds ?>'><span style="color:#bc5228; text-decoration: underline;">See More ></span></a></small>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery('#hideshow-<?php echo $data->id_feeds ?>').live('click', function (event) {
                                        jQuery('#show-more-<?php echo $data->id_feeds ?>').toggle('show');
                                        jQuery(this).hide();
                                    });
                                });
                            </script>
                            <div id="show-more-<?php echo $data->id_feeds ?>" style="display: none;">                        
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
                                        case Feeds::TYPE_POLL_POST:
                                            $this->renderPartial('_poll_post', array('data' => $data));
                                            break;
                                        case Feeds::TYPE_EVENT_POST:
                                            $this->renderPartial('_event_post', array('data' => $data));
                                            break;
                                        default:
                                            $this->renderPartial('_text_post', array('data' => $data));
                                            break;
                                    }
                                    ?>
                                </div>
                                <a data-popup=".popup-repost" onclick="loadFeeds($(this));" class="link open-popup text" href="#" id="<?php echo $data->id_feeds ?>">
                                    <span class="fa fa-retweet"style="color: #bc5228;"> <?php echo $data->countRepost; ?> repost(s)</span>
                                </a> 
                                <a class="link text" href="#" id="<?php echo $data->id_feeds ?>">
                                    <span class="fa fa-comment"style="color: #bc5228;"> <span id="comment-count-<?php echo $data->id_feeds ?>"><?php echo $data->feedsCommentCount; ?></span> comment(s)</span>
                                </a> 
                                <div id="comments-<?php echo $data->id_feeds ?>" style="
                                     margin-left: 80px;
                                     margin-right: 10px;
                                     background: #f7f7f8;
                                     ">
                                    <ul style="padding-left: 0;" id="list-comment-<?php echo $data->id_feeds ?>">
                                        <?php if ($data->feedsCommentCount >= 1): ?>
                                            <?php
                                            $this->renderPartial('/comments/_comments', array(
                                                'comments' => $data->feedsComment,
                                            ));
                                            ?>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="form-comment">
                                        <?php
                                        $this->renderPartial('/comments/_comment_form', array(
                                            'model' => new FeedsComments(),
                                            'id_feeds' => $data->id_feeds
                                        ));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </li>
<?php endif; ?>