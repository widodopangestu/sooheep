<html lang="en">
<head>
<?php $baseUrl = Yii::app()->theme->baseUrl;?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="bootstrap social network template">
<meta name="author" content="">
<link rel="icon" href="<?php echo $baseUrl?>/img/logo.png">
<title>Soheep</title>
<link href="<?php echo $baseUrl?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $baseUrl?>/css/font-awesome.min.css"
	rel="stylesheet">
<link href="<?php echo $baseUrl?>/css/get-shit-done.css" rel="stylesheet" />
<link href="<?php echo $baseUrl?>/css/demo.css" rel="stylesheet" />
<link href="<?php echo $baseUrl?>/css/animate.min.css" rel="stylesheet" />
<link href="<?php echo $baseUrl?>/css/timeline.css" rel="stylesheet" />
<link href="<?php echo $baseUrl?>/css/rotating-card.css" rel="stylesheet" />
<link href="<?php echo $baseUrl?>/css/jquery.fileupload.css" rel="stylesheet">


<?php 
	Yii::app()->clientScript->registerCoreScript("jquery");
	//Yii::app()->clientScript->registerCoreScript("jquery.ui");
?>
<script src="<?php echo $baseUrl?>/js/jquery.min.js"></script> 
<script src="<?php echo $baseUrl?>/js/jquery.ui.widget.js"></script> 
<script src="<?php echo $baseUrl?>/js/jquery.iframe-transport.js"></script> 
<script src="<?php echo $baseUrl?>/js/jquery.fileupload.js"></script> 
<script src="<?php echo $baseUrl?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl?>/js/gsdk-bootstrapswitch.js"></script>
<script src="<?php echo $baseUrl?>/js/get-shit-done.js"></script>
<script src="<?php echo $baseUrl?>/js/jquery.scrollstop.min.js"></script>
<script src="<?php echo $baseUrl?>/js/custom.js"></script>

</head>
<body>
<?php echo $content;?>
</body>
</html>