<?php
$user = $user->profiles;
if (Yii::app()->user->hasFlash("pesan-add-sukses")) {
    Yii::app()->clientScript->registerScript("pesan", '
		webApp.alert("' . Yii::app()->user->getFlash("pesan-add-sukses") . '");		
	');
}
?>
<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="profile" class="page user-profile">
        <div class="page-content">

            <div class="banner" style=" background: transparent url('<?php echo $this->getBackgroundPicture(true, $user->id_user); ?>') no-repeat scroll center top / cover ;">
                <div class="ava-box">
                    <?php echo $user->getProfilePicture("ava", "", $user->id_user); ?>
                </div>

                <div class="balance">
                    <div><?php echo $user->firstname . " " . $user->lastname ?></div>
                    <small>Be My self</small>
                </div>
                <?php
                if ($user->id_user != Yii::app()->user->id['id']) {
                    ?>
                    <div class="row row-bottom banner-bottom">
                        <div class="col text-right badges">
                            <small class="mb-5 text-right">
                                <?php echo $user->buttonaddfriendm ?>
                            </small>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row row-bottom banner-bottom">
                        <div class="col">
                            <small class="mb-5">
                                <a href="#" data-popup=".popup-change-profile" class="link open-popup" style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;">
                                    Change Profile Picture
                                </a>
                            </small>
                        </div>
                        <div class="col text-right badges">
                            <small class="mb-5 text-right">
                                <a href="#" data-popup=".popup-change-background" class="link open-popup"  style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;">
                                    Change Cover Picture
                                </a>
                            </small>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php // if ($user->isFriend || $user->id_user == Yii::app()->user->id['id']): ?>
            <div class="list-block mt-0 blog-box">
                <ul id="#feed-<?php echo $user->id_user ?>" class="postingan infinite-scroll" data-url="<?php echo Yii::app()->createUrl('/m/member/q/' . $user->idUser->hash . "/") ?>">
                    <li class="swipeout post">
                        <div class="swipeout-actions-left">
                            <a href="#" class="action-red js-add-to-fav">
                                <?php echo $user->getProfilePicture(); ?>
                            </a>
                        </div>

                        <div class="swipeout-content">
                            <div class="item-content no-padding">
                                <div class="item-inner blog-list">
                                    <div class="feeds-content-<?php echo $feed->id_feeds ?>">
                                        <?php
                                        switch ($feed->feedsAttributes->type) {
                                            case Feeds::TYPE_LOCATION_POST:
                                                $this->renderPartial('_location_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_FILE_POST:
                                                $this->renderPartial('_file_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_MUSIC_POST:
                                                $this->renderPartial('_audio_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_VIDEO_POST:
                                                $this->renderPartial('_video_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_IMAGE_POST:
                                                $this->renderPartial('_img_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_TAG_POST:
                                                $this->renderPartial('_tag_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_REPOST_POST:
                                                $this->renderPartial('_repost_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_POLL_POST:
                                                $this->renderPartial('_poll_post', array('data' => $feed));
                                                break;
                                            case Feeds::TYPE_EVENT_POST:
                                                $this->renderPartial('_event_post', array('data' => $feed));
                                                break;
                                            default:
                                                $this->renderPartial('_text_post', array('data' => $feed));
                                                break;
                                        }
                                        ?>
                                    </div>
                                    <a data-popup=".popup-repost" onclick="loadFeeds($(this));" class="link open-popup text" href="#" id="<?php echo $feed->id_feeds ?>">
                                        <span class="fa fa-retweet"style="color: #bc5228;"> <?php echo $feed->countRepost; ?> repost(s)</span>
                                    </a> 
                                    <a class="link text" href="#" id="<?php echo $feed->id_feeds ?>">
                                        <span class="fa fa-comment"style="color: #bc5228;"> <span id="comment-count-<?php echo $feed->id_feeds ?>"><?php echo $feed->feedsCommentCount; ?></span> comment(s)</span>
                                    </a> 
                                    <div id="comments-<?php echo $feed->id_feeds ?>" style="
                                         margin-left: 80px;
                                         margin-right: 10px;
                                         background: #f7f7f8;
                                         "><?php if ($feed->feedsCommentCount > 3): ?>
                                            <a data-popup=".popup-comments" onclick="loadComments(<?php echo $feed->id_feeds ?>);" class="link open-popup" href="#">
                                                <span style="color: #bc5228;">Load more comments ...</span>
                                            </a> 
                                        <?php endif; ?>
                                        <ul style="padding-left: 0;" id="list-comment-<?php echo $feed->id_feeds ?>">
                                            <?php if ($feed->feedsCommentCount >= 1): ?>
                                                <?php
                                                $cr = new CDbCriteria();
                                                $cr->limit = 3;
                                                $this->renderPartial('/comments/_comments', array(
                                                    'comments' => $feed->feedsComment($cr),
                                                ));
                                                ?>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="form-comment">
                                            <?php
                                            $this->renderPartial('/comments/_comment_form', array(
                                                'model' => new FeedsComments(),
                                                'id_feeds' => $feed->id_feeds
                                            ));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <?php // endif; ?>
        </div>
    </div>
</div>