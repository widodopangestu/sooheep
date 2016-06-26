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
                  	<a href="#" class="fileinput-button text-center edit-image-background" id="upload-image">
                	<i class="fa fa-pencil"></i> 
					<input type="file" multiple="" name="images_background" id="Images_background">
					</a> 
                </div>
                <ul class="friends">
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-6.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-3.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-2.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-9.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-9.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-4.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-1.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-4.jpg" alt="people" class="img-responsive">
                    </a>
                  </li>
                  <li><a href="#" class="group"><i class="fa fa-group"></i></a></li>
                </ul>
              </div>
              <div class="cover-info container">
                <div class="avatar">
                	<div class="pp">
                  	<?php 
                  	echo $this->getProfilePicture();
                  	?>
                  	</div>
                	<form>
                	<a href="#" class="fileinput-button text-center edit-image" id="upload-image">
                	<i class="fa fa-pencil"></i> 
					<input type="file" name="images_profile" id="Images_profile">
					</a> 
					</form>
                </div>  
                <div class="name"><a href="#"><?php echo $user->firstname." ".$user->lastname?></a></div>
                <ul class="cover-nav">
                  <li><a href="<?php echo CController::createUrl('/timeline')?>"><i class="fa fa-fw icon-ship-wheel"></i> Timeline</a></li>
                  <li><a href="#"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                  <li><a href="<?php echo CController::createUrl('/friends')?>"><i class="fa fa-fw fa-users"></i> Friends</a></li>
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