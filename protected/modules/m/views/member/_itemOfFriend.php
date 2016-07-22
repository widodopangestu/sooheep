<?php if (in_array(Yii::app()->user->id['id'], $data->idUser->friendsId)): ?>
        <li class="people-user">
            <?php $img = $this->getProfilePicture("", "", $data->id_user); ?>
        <!-- <a class="act-fren" href=""><i class="fa fa-comment"></i></a>  -->
        <!-- <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/member/profile/q/' . $data->idUser->hash); ?>';" id="<?php echo $data->idUser->hash ?>" class="fren-link item-link close-panel item-content"> -->
            <a href="#<?php // echo Yii::app()->createUrl('/m/member/profile/q/'.$data->idUser->hash);  ?>" id="<?php echo $data->idUser->hash ?>" class="fren-link item-link close-panel item-content">
                <div class="item-media">
                    <div class="fren-box">
                        <?php echo $img; ?>
                    </div>
                </div>
                <div onclick="openChat();" class="item-inner">
                    <div <?php echo 'title="' . $data->idUser->chatId . '" '; ?>class="item-title mylist"><?php echo $data->firstname ?></div>
                </div>
            </a>
        </li>
<?php else : ?>
    <li class="people-user">
        <?php $img = $this->getProfilePicture("", "", $data->id_user); ?>
    <!-- <a class="act-fren" href=""><i class="fa fa-comment"></i></a>  -->
    <!-- <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/member/profile/q/' . $data->idUser->hash); ?>';" id="<?php echo $data->idUser->hash ?>" class="fren-link item-link close-panel item-content"> -->
        <a href="<?php echo Yii::app()->createUrl('/m/member/profile/q/' . $data->idUser->hash); ?>" id="<?php echo $data->idUser->hash ?>" class="fren-link item-link close-panel item-content">
            <div class="item-media">
                <div class="fren-box">
                    <?php echo $img; ?>
                </div>
            </div>
            <div class="item-inner">
                <div class="item-title mylist"><?php echo $data->firstname ?></div>
            </div>
            <?php echo $data->buttonChat ?> 
        </a>
    </li>

<?php endif; ?>
