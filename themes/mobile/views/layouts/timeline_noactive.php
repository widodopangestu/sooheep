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
		            </a>
		            <a href="#" class="link icon-only" data-panel="right">
		                <span class="fa fa-weixin"></span>
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

<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/jquery/dist/jquery.min.js"></script>
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