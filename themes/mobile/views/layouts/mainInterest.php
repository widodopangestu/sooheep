<html>
<?php 
$baseUrl = Yii::app()->theme->baseUrl."/";
$user = $this->getProfile();
$feed = new Feeds;
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>Soheep</title>

    <link rel="stylesheet" href="<?php echo $baseUrl?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $baseUrl?>bower_components/framework7/dist/css/framework7.ios.min.css">
    <link rel="stylesheet" href="<?php echo $baseUrl?>bower_components/swipebox/src/css/swipebox.css">
	<link rel="stylesheet" href="<?php echo $baseUrl?>bower_components/jquery/dist/jquery.fileupload.css">

    <link rel="stylesheet" href="<?php echo $baseUrl?>assets/css/app.css">
    <link rel="stylesheet" href="<?php echo $baseUrl?>assets/themes/town/style.css" id="theme-style">
    <!--<link rel="stylesheet" href="" id="theme-style">-->
</head>
<body>

<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>

<?php include 'left_menu.php';?>

<?php include 'right_bar.php';?>
<!-- Views -->
<div class="views">
    <div class="view view-main">
		<div class="navbar navbar-clear">
		    <div class="navbar-inner">
		        <div class="left">
		            <a href="#" class="link icon-only open-panel">
		                <span class="kkicon icon-menu"></span>
		            </a>
		        </div>
		        <div class="left sliding"><img src="<?php echo $baseUrl."/"?>assets/img/logo1.png" style="height:27px;width:auto;"></div>
		        <div class="right">
		            <a href="#" class="link icon-only" data-panel="right">
		                <span class="kkicon icon-alarm"></span>
		                <span class="notif notification"></span>
		            </a>
		            <a href="#" class="link icon-only" data-panel="right">
		                <span class="fa fa-weixin"></span>
		                <span class="notif">1</span>
		            </a>
		            <a href="#" class="link icon-only open-panel" data-panel="right">
		                <span class="kkicon icon-users2"></span>
		            </a>
		        </div>
		    </div>
		</div>
				
		<?php echo $content;?>


			<div class="toolbar" style="background-color:#B7461A !important;opacity:0.6;">
				<div class="toolbar-inner">
					<a class="link" href="<?php Yii::app()->createUrl('/m/member/chat')?>"> 
						<span class="fa fa-music"></span>
					</a> 
					<!-- <a data-popup=".popup-splash" class="link open-popup" href="#"> -->
					<a class="link" href="#">
						<span class="fa fa-map-marker"></span>
					</a> 
					<a data-popup=".popup-login" class="link open-popup" href="#">
						<span class="fa fa-picture-o"></span>
					</a>
					
					<a class="open-picker link" data-picker=".picker-social" href="#">
						<span class="icon-pencil-line"></span>
					</a> 
				</div>
			</div>
		</div>
</div>


<div class="popup popup-login">
    <div class="content-block">
        <a href="#" class="close-popup">
            Close <i class="fa fa-close"></i>
        </a>
			<div class="img-post text-center mt-10">
	        	
	        </div>
			
  			<div class="forms">
            <h3>What do you heep?</h3>
			<?php 
			Yii::app()->clientScript->registerScript('upload-feed',"
				 $('#Feeds_images').fileupload({
			        url: '".Yii::app()->createUrl('/m/feeds/uploadimage')."',
			        dataType: 'json',
			        done: function (e, data) {
			        	var img = '<img class=\"img-responsive\" style=\"width:100%\" src=\"".Yii::app()->request->baseUrl."'+data.result.thumb+'\">'
			        	$('.img-post').html(img);
			        	$('#Feeds_imagesUrl').val(data.result.best);
			        	$('.progress-bar').hide();
			        },
			        progressall: function (e, data) {
			            var progress = parseInt(data.loaded / data.total * 100, 10);
			            $('.progress-bar').show();
			            $('.progress-bar').css(
			                'width',
			                progress + '%'
			            );
			        }
			    }).prop('disabled', !$.support.fileInput)
			        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		 	",CClientScript::POS_END);
			
				$form2 = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'feeds-images',
						'type' => 'horizontal',
						'action' => CController::createUrl('/m/interest/setFeedGroup'),
						'htmlOptions' => array(
						//'enctype'=>'multipart/form-data'
							'class' => 'js-validate'
						)
				));
				?>

                <div class="form-row">
                    <div class="input-text">
                    <?php 
                    	echo $form2->hiddenField($feed,'imagesUrl');
			    		echo $form2->textArea($feed,'text_caption',array('class'=>"form-control share-text",'placeholder'=>'Share your heep...')); 
			    	?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-text">
	                    	<input type="file" multiple="" name="images" id="Feeds_images">
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
				<?php $this->endWidget(); ?>
			</div>	

    </div>
</div>


<?php 
			Yii::app()->clientScript->registerScript('changeprofile',"
				 $('#Images_profile').fileupload({
			        url: '".Yii::app()->createUrl('/m/member/changeprofile')."',
			        dataType: 'json',
			        done: function (e, data) {
			        	var img = '<img src=\"'+data.result.thumb+'\" class=\"ava\">';
			        	$('.pp').html(img);
						$('.img-post-pp').html(img);
						$('.close-popup').trigger('click');
			        	//$('.progress-load').hide();
			        },
			        progressall: function (e, data) {
			            var progress = parseInt(data.loaded / data.total * 100, 10);
			            //$('.progress-load').show();
			        }
			    }).prop('disabled', !$.support.fileInput)
			        .parent().addClass($.support.fileInput ? undefined : 'disabled');
			        
				 $('#Images_background').fileupload({
			        url: '".Yii::app()->createUrl('/m/member/changeBackgroundprofile')."',
			        dataType: 'json',
			        done: function (e, data) {
			        	var img = '<img src=\"'+data.result.best+'\">'
			        	$('.banner').css('background', 'transparent url(' + data.result.best + ') no-repeat scroll center top / cover');
						$('.img-post-bg').html(img);
						$('.close-popup').trigger('click');
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
<div class="popup popup-change-profile">
    <div class="content-block">
        <a href="#" class="close-popup">
            Close <i class="fa fa-close"></i>
        </a>
			
  			<div class="forms">
            <h3>Change Profile </h3>
			
				<div class="img-post-pp text-center mt-10">
	        	</div> 
	        	<input type="file" name="images_profile" id="Images_profile">
			</div>	

    </div>
</div>

<div class="popup popup-change-background">
    <div class="content-block">
        <a href="#" class="close-popup">
            Close <i class="fa fa-close"></i>
        </a>
			
  			<div class="forms">
            <h3>Change Background Cover </h3>
			
				<div class="img-post-bg text-center mt-10">
	        	</div> 
	        	<input type="file" name="images_background" id="Images_background">
			</div>	

    </div>
</div>


<!-- Picker -->
<div class="picker-modal picker-social">
    <div class="toolbar">
        <div class="toolbar-inner">
            <div class="left"></div>
            <div class="right"><a href="#" class="close-picker">Done</a></div>
        </div>
    </div>
    <div class="picker-modal-inner">
        <div class="content-block mt-15 mb-10">
            <div class="forms">
            <h3>What do you heep?</h3>
			<?php 
				$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'feeds',
						'type' => 'horizontal',
						'action' => CController::createUrl('/m/feeds/setFeed'),
						'htmlOptions' => array(
						//'enctype'=>'multipart/form-data'
							'class' => 'js-validate'
						)
				));
				?>

                <div class="form-row">
                    <div class="input-text">
                    <?php 
                    	echo $form->hiddenField($feed,'imagesUrl');
			    		echo $form->textArea($feed,'text_caption',array('class'=>"form-control share-text",'placeholder'=>'Share your heep...')); 
			    	?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
				<?php $this->endWidget(); ?>
			</div>	
        </div>
    </div>
</div>

<?php 
Yii::app()->clientScript->registerCoreScript('jquery',CClientScript::POS_END);
Yii::app()->clientScript->registerCoreScript('jquery-ui',CClientScript::POS_END);

Yii::app()->clientScript->registerScript('realtime-notif','
	window.setInterval(function(){
	  $.ajax({
		url:"'.Yii::app()->createUrl('/m/feeds/checknotif').'",
		dataType:"json",
		success:function(data){
			$(".notification").html(data.jumlah);
		}
	  });
	}, 5000);
',CClientScript::POS_END);


?>

<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/jquery/dist/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/jquery/dist/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/framework7/dist/js/framework7.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/swipebox/src/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/Tweetie/tweetie.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/chartjs/Chart.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>assets/js/jflickrfeed.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>assets/js/min/app.js"></script>
</body>

<!-- Mirrored from themes.krzysztof-furtak.pl/themes/malpha2/malpha2/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Dec 2015 06:22:35 GMT -->
</html>