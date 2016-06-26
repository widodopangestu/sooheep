<html>
<?php 
$baseUrl = Yii::app()->theme->baseUrl."/";
$user = $this->getProfile();
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

    <link rel="stylesheet" href="<?php echo $baseUrl?>assets/css/app.css">
    <link rel="stylesheet" href="<?php echo $baseUrl?>assets/themes/town/style.css" id="theme-style">
    <!--<link rel="stylesheet" href="" id="theme-style">-->
</head>
<body>

<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>

<!-- Views -->
<div class="views">
    <div class="view view-main">
		<?php echo $content;?>
	</div>
</div>


<script type="text/javascript" src="<?php echo $baseUrl?>bower_components/jquery/dist/jquery.min.js"></script>
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