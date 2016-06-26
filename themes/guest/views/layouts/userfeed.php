<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Soheep -->
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo Yii::app()->theme->baseUrl."/" ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl."/" ?>css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->theme->baseUrl."/" ?>css/lightbox.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Poppins:400,600,700,500,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,900italic,900,700italic,700,400italic,500,500italic,300,100italic,100,300italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
<header class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 ">
				<div class="navbar-header">
					    <button type="button" class="navbar-toggle menu-button" data-toggle="collapse" data-target="#myNavbar">
					        <span class="glyphicon glyphicon-align-justify"></span>
					    </button>
      					<!-- 
      					<a class="navbar-brand logo" href="#">
      						<span style="color:#38ADB7;">S</span>
      						<span style="color:#E0311A;">o</span>
      						<span style="color:#009AED;">h</span>
      						<span style="color:#E810B9;">e</span>
      						<span style="color:#19FCFC;">e</span>
      						<span style="color:#F6FF00;">P</span>
      					</a>
      					 -->
    			</div>
			</div>

			<div class="col-md-8">
				<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
			    <div class="col-sm-2 no-padding pull-right">
			    <?php echo CHtml::link('Sign Out','',array('class'=>'link-button btn btn-default btneff'))?>
			    </div>
				</nav>
			</div>
		</div>
	</div>
</header>

<div class="main-content">
<?php 
echo $content;
?>
</div>

<div class="container-fluid notes">

  	<div class="row">

   		<div class="col-md-12 col-sm-12 col-xs-12 notes-bg">

    		<div class="container">

    			<div class="col-md-8 col-sm-8 col-xs-12">

     				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

    			</div>

    			<div class="col-md-offset-1 col-md-2 col-md-offset-1 col-sm-offset-1 col-sm-2 col-sm-offset-1 col-xs-12">

     				<button type="button" class="btn btn-default btneff">Read More</button>

    			</div>

   			</div>

   		</div>

  	</div> 

</div>







<div class="container-fluid footer">

	<div class="row">

		<div class="col-md-12">

			<p>Copyright &copy; Sooheeb 2015</p>

		</div>

	</div>

</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="<?php echo Yii::app()->theme->baseUrl."/" ?>js/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="<?php echo Yii::app()->theme->baseUrl."/" ?>js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl."/" ?>js/jquery.countTo.js"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl."/" ?>js/jquery.waypoints.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl."/" ?>js/lightbox.min.js"></script>
    <script>
	/*
      function initialize() {

        var mapCanvas = document.getElementById('map-canvas');

        var mapOptions = {

          center: new google.maps.LatLng(26.802100, 75.822739),

          zoom: 8,

          mapTypeId: google.maps.MapTypeId.ROADMAP

        }

        var map = new google.maps.Map(mapCanvas, mapOptions)

      }

      google.maps.event.addDomListener(window, 'load', initialize);
	*/
    </script>

    <script>

	$(document).ready(function () {

		$(document).on("scroll", onScroll);

 

		$('a[href^="#"]').on('click', function (e) {

			e.preventDefault();

			$(document).off("scroll");

 

			$('a').each(function () {

				$(this).removeClass('active');

			})

			$(this).addClass('active');

 

			var target = this.hash;

			$target = $(target);

			$('html, body').stop().animate({

				'scrollTop': $target.offset().top

			}, 500, 'swing', function () {

				window.location.hash = target;

				$(document).on("scroll", onScroll);

			});

		});

	});

 

	function onScroll(event){

		var scrollPosition = $(document).scrollTop();

		$('nav a').each(function () {

			var currentLink = $(this);

			var refElement = $(currentLink.attr("href"));

			if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {

				$('nav ul li a').removeClass("active");

				currentLink.addClass("active");

			}

			else{

				currentLink.removeClass("active");

			}

		});

	}

	</script>

	<script type="text/javascript">

    jQuery(function ($) {

      // custom formatting example

      $('.timer').data('countToOptions', {

        formatter: function (value, options) {

          return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');

        }

      });

 

      // start all the timers

      $('#starts').waypoint(function() {

    $('.timer').each(count);

	});

 

      function count(options) {

        var $this = $(this);

        options = $.extend({}, options || {}, $this.data('countToOptions') || {});

        $this.countTo(options);

      }

    });

  	</script>

</body>


<!-- Mirrored from www.html5layouts.com/wp-content/uploads/templates/Ravalic/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Aug 2015 03:21:38 GMT -->
</html>

