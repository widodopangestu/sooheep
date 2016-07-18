<!-- Left panel -->
<div class="panel panel-left panel-reveal">
    <!--<div class="user-banner" style=" background: transparent url('<?php //echo $this->getBackgroundPicture(true);        ?>') no-repeat scroll center top / cover ;">-->
    <div class="user-banner">
        <span class="ava-box">
            <?php echo $this->getProfilePicture(); ?>
        </span>
    </div>

    <div class="welcome-msg">
        <h3>Hello <strong><?php echo $user->firstname ?></strong>!</h3>
        <!-- <h4>How is your day going?</h4> -->
    </div>

    <div class="list-block mt-15">
        <div class="list-group">
            <nav>
                <ul>
                    <li>
                        <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/feeds/index'); ?>';" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Feeds</div>
                            </div>
                        </a>
                    </li>
                    <li class="divider">
                        About Me
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/m/member/profile/q/' . $user->idUser->hash); ?>" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Profile</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/m/member/setting/'); ?>" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-cog"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Settings</div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/m/member/gallery/'); ?>" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Gallery</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/member/logout') ?>';" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-sign-out"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Logout</div>
                            </div>
                        </a>
                    </li>

                    <li class="divider">
                        My Interest
                    </li>

                    <li>
                        <a href="#" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="item-inner">
                                <?php $interest = UserInterest::model()->findAllByAttributes(array('id_user' => Yii::app()->user->id['id'])); ?>
                                <div class="item-title mylist">Insterest</div>
                                <div class="item-after">
                                    <span class="badge badge-primary"><?php echo count($interest) ?></span>
                                </div>
                            </div>
                        </a>
                        <?php if ($interest != null): ?>
                            <a href="#" class="js-toggle-menu"><span class="icon-chevron-down"></span></a>
                            <ul>
                                <?php foreach ($interest as $group): ?>
                                    <li>
                                        <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/interest/group/q/' . $group->id_interest) ?>';" class="item-link close-panel item-content">
                                            <div class="item-media">
                                                <i class="fa fa-caret-right"></i>
                                            </div>
                                            <div class="item-inner">
                                                <div class="item-title mylist"><?php echo $group->idInterest->interest_name ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>

                    <li>
                        <a class="item-link close-panel item-content" href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/interest/addInterest') ?>';">
                            <div class="item-media">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Add Interest</div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-object-group"></i>
                            </div>
                            <div class="item-inner">
                                <?php $comm = InterestCommunityMember::model()->findAllByAttributes(array('id_user' => Yii::app()->user->id['id'])); ?>
                                <div class="item-title mylist">Community</div>
                                <div class="item-after">
                                    <span class="badge badge-primary"><?php echo count($comm) ?></span>
                                </div>
                            </div>
                        </a>
                        <?php if ($comm != null): ?>
                            <a href="#" class="js-toggle-menu"><span class="icon-chevron-down"></span></a>
                            <ul>
                                <?php foreach ($comm as $community): ?>
                                    <li>
                                        <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/interest/community/q/' . $community->id_interest_community) ?>';" class="item-link close-panel item-content">
                                            <div class="item-media">
                                                <i class="fa fa-caret-right"></i>
                                            </div>
                                            <div class="item-inner">
                                                <div class="item-title mylist"><?php echo $community->idInterestComunity->community_name ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>

                    <li>
                        <a class="item-link close-panel item-content" href="#"  onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/interest/listCommunity') ?>';">
                            <div class="item-media">
                                <i class="fa fa-dot-circle-o"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Join Community</div>
                            </div>
                        </a>
                    </li>

                    <li class="divider">
                        Social
                    </li>
                    <li>
                        <a href="#" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-weixin"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Group Chat</div>
                                <div class="item-after">
                                    <span class="badge badge-secondary"><?php echo count($user->idUser->listGroupChats);?></span>
                                </div>
                            </div>
                        </a>
                        <?php if ($user->idUser->listGroupChats > 0): ?>
                            <a href="#" class="js-toggle-menu"><span class="icon-chevron-down"></span></a>
                            <ul id="mjmChatRooms">
                                <?php foreach ($user->idUser->listGroupChats as $roomKey => $roomValue): ?>
                                    <li title="<?php echo $roomKey; ?>">
                                        <a href="#" class="item-link close-panel item-content">
                                            <div class="item-media">
                                                <i class="fa fa-caret-right"></i>
                                            </div>
                                            <div class="item-inner">
                                                <div class="item-title mylist"><?php echo $roomValue; ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                    <li>
                        <a href="#" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-weixin"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Community Chat</div>
                                <div class="item-after">
                                    <span class="badge badge-secondary"><?php echo count($user->idUser->listCommunityChats);?></span>
                                </div>
                            </div>
                        </a>
                        <?php if ($user->idUser->listCommunityChats > 0): ?>
                            <a href="#" class="js-toggle-menu"><span class="icon-chevron-down"></span></a>
                            <ul id="mjmChatRooms">
                                <?php foreach ($user->idUser->listCommunityChats as $roomKey => $roomValue): ?>
                                    <li title="<?php echo $roomKey; ?>">
                                        <a href="#" class="item-link close-panel item-content">
                                            <div class="item-media">
                                                <i class="fa fa-caret-right"></i>
                                            </div>
                                            <div class="item-inner">
                                                <div class="item-title mylist"><?php echo $roomValue; ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                    <li>
                        <a href="#" class="item-link close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-weixin"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title mylist">Personal Chat</div>
                                <div class="item-after">
                                    <span class="badge badge-secondary"><?php echo count($user->idUser->listFriendChats);?></span>
                                </div>
                            </div>
                        </a>
                        <?php if ($user->idUser->listFriendChats > 0): ?>
                            <a href="#" class="js-toggle-menu"><span class="icon-chevron-down"></span></a>
                            <ul id="mjmChatRooms">
                                <?php foreach ($user->idUser->listFriendChats as $roomKey => $roomValue): ?>
                                    <li title="<?php echo $roomKey; ?>">
                                        <a href="#" class="item-link close-panel item-content">
                                            <div class="item-media">
                                                <i class="fa fa-caret-right"></i>
                                            </div>
                                            <div class="item-inner">
                                                <div class="item-title mylist"><?php echo $roomValue; ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
