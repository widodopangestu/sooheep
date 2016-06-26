<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $user = $this->getProfile();
?>
<?php 
Yii::app()->clientScript->registerScript('changeprofile',"
	 $('#Images_profile').fileupload({
        url: '".Yii::app()->createUrl('/profile/picture/changeprofile')."',
        dataType: 'json',
        done: function (e, data) {
        	var img = '<img src=\"'+data.result.thumb+'\">'
        	$('.pp').html(img);
        	//$('.progress-load').hide();
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            //$('.progress-load').show();
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
        
	 $('#Images_background').fileupload({
        url: '".Yii::app()->createUrl('/profile/picture/changeBackgroundprofile')."',
        dataType: 'json',
        done: function (e, data) {
        	var img = '<img src=\"'+data.result.best+'\">'
        	$('.bp').html(img);
        	$('.back-progress-load').hide();
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.back-progress-load').show();
            $('.back-progress-load').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	",CClientScript::POS_END);
?>
<?php $this->beginContent('//maintemplate'); ?>
        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">
		<div class="cover profile">
              <div class="wrapper">
                <div class="image">
                	<div style="display:none;height:3px !important;" class="back-progress-load progress-bar progress-bar-success"></div>
                	<div class="bp">
                	<?php 
                  	echo $this->getBackgroundPicture();
                  	?>
                  	</div>
                  	<!--
                  	<a href="#" class="fileinput-button text-center edit-image-background" id="upload-image">
                	<i class="fa fa-pencil"></i> 
					<input type="file" multiple="" name="images_background" id="Images_background">
					</a> 
                	-->
                </div>
                <ul class="friends">
                <?php 
                	$listOfGroup = $this->getFriendsGroup(8);
                	if($listOfGroup != null){
                		foreach ($listOfGroup as $friendList){
                ?>
                <li>
                    <a href="#">
                    <?php 
                    	echo $this->getProfilePicture($class = "img-responsive",$style = "height:110;",$friendList->id_user);
                    ?>
                    </a>
                </li>
                <?php 		
                		}
                	
                	}
                ?>
                  <li><a href="#" class="group"><i class="fa fa-group"></i></a></li>
                </ul>
              </div>
              <div class="cover-info container">
                <!--<div class="avatar">
                	<div class="pp">
                  	<?php 
                  	//echo $this->getProfilePicture();
                  	?>
                  	</div>
                	<form>
                	<a href="#" class="fileinput-button text-center edit-image" id="upload-image">
                	<i class="fa fa-pencil"></i> 
					<input type="file" name="images_profile" id="Images_profile">
					</a> 
					</form>
                </div>
                -->
                <div class="name" style="left:18px;bottom:7px;"><a href="#" style="font-size: 70px ! important;"><?php echo $this->interest->interest_name?></a></div>
                <ul class="cover-nav" style="left:0">
                  <li><a href="<?php echo CController::createUrl('/timeline')?>"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                  <li><a href="#"><i class="fa fa-fw fa-sitemap"></i> Community</a></li>
                </ul>
              </div>
            </div>
            
          <div class="container">
            <div class="timeline row" data-toggle="isotope">
            	<?php echo $content;?>
            </div>

          </div>

        </div>
        <!-- /st-content-inner -->

<?php $this->endContent(); ?>