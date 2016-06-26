<!DOCTYPE html>
<html lang="en">
<head>
   	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Indra Lesmana, 08989114321">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <title><?php // echo CHtml::encode($this->getPageTitle()); ?> Electronic City Employee</title>
    <!-- Bootstrap -->
 <!--   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  -->
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/bootstrap/css/iconbootstrapgenerator.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
     <link href=" <?php echo Yii::app()->theme->baseUrl."/"?>css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	
<?php 
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
		Yii::app()->clientScript->registerCoreScript('jquery');
   ?>
  
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/raphael-min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/moment.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/knob/jquery.knob.js"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
     <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/dist/js/app.min.js"></script>
 
	<!--[if IE]>
	<script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/html5.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/respond.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl."/"?>js/css3-mediaqueries.js"></script>
    <![endif]-->    
</head>

<body class="skin-blue sidebar-mini" >
      <div class="wrapper">
	  <?php include 'header.php';?>
      <?php echo $content;?>
      </div>
	<!-- ./wrapper -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   
</body>
<!-- Mirrored from gohooey.com/demo/sidebar/bootstrapnavigation/hoedemo.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2015 02:59:58 GMT -->
</html>