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
        	var img = '<img src=\"'+data.result.thumb+'\" class=\"profile-photo img-rounded show-in-modal\">'
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
        	$('.bp').css('background-image', 'url(' + data.result.best + ')');
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

<!-- Navigation bar -->
<div id="navbar-full">
<div id="navbar">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
					<span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"> 
					<img class="app-logo" src="<?php echo $baseUrl?>/img/logo4.png">
					<b>Soheep</b>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#" data-toggle="search" class="hidden-xs search-icon">
							<i class="fa fa-search"></i>
						</a>
					</li>
				</ul>
				<form class="navbar-form navbar-left navbar-search-form" role="search">
				<div class="form-group">
					<input type="text" value="" class="form-control" placeholder="Search..."></div>
				</form>
				
				<ul class="nav navbar-nav navbar-right navbar-opts">
					<li class="active"><a href="<?php echo CController::createUrl('/timeline')?>"><i class="fa fa-tasks fa-2x_"></i>Timeline</a></li>
					<li><a href="<?php echo CController::createUrl('/profile/about')?>"><i class="fa fa-info-circle fa-2x_"></i>About</a></li>
					<li><a href="<?php echo CController::createUrl('/friends')?>"><i class="fa fa-users fa-2x_"></i>Friends</a></li>
					<li><a href="<?php echo CController::createUrl('/profile/galleries')?>"><i class="fa fa-file-image-o fa-2x_"></i>Photos</a></li>
					<li><a href="#"><i class="fa fa-comment fa-2x_"></i>Notification</a></li>
					<li><a href="<?php echo CController::createUrl('/new/logout')?>"><i class="fa fa-sign-out fa-2x_"></i>Logout</a></li>
				</ul>
			</div> 
		</div>
	</nav>
	<div class="blurred-container">
		<div id="cover-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-indicators pull-right">
				<a id="upload-image" class="fileinput-button text-center edit-image-background" href="#">
					<i class="fa fa-pencil-square-o"></i>
					<input type="file" multiple="" name="images_background" id="Images_background">
					</a> 
			</div>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<div class="img-src bp" style="background-image: url('<?php echo $this->getBackgroundPicture(true);?>')">
					</div>
				</div>
			</div>
		</div>
		<div style="display:none;height:3px !important;" class="back-progress-load progress-bar progress-bar-success"></div>
	</div>
</div>
</div>
<!-- End Navigation bar -->
 

<!-- Content Section -->
<div class="main">
	<!-- Profile info -->
	<h4 class="text-center user-name hidden-xs"><?php echo $this->interest->interest_name?></h4>
	<div class="section-gray">
		<div class="container">
			<div class="row">
				<div class="col-md-12 profile-opts">
				<a href="<?php echo Yii::app()->createUrl('/group/interest/createComunity/id/'.$this->interest->id_interest)?>" class="btn btn-info btn-fill pull-right">
					<i class="fa fa-user-plus"></i> 
					<span class="hidden-xs">Add Comunity</span>
				</a>
				<button type="button" class="btn btn-info btn-fill pull-right">
					<i class="fa fa-envelope"></i> 
					<span class="hidden-xs">Send message</span>
				</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Profile info -->
	
	<div class="container container-timeline animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<?php echo $content;?>
			</div>
		<div class="col-md-12 col-sm-12"><footer class="footer">
		<P>&copy; Company 2015</P>
		</footer></div>
		</div>
	</div>
<div class="space"></div>
</div>
<!-- End Content section -->

<?php $this->endContent(); ?>