<html class="st-layout ls-top-navbar ls-bottom-footer hide-sidebar sidebar-r2" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title></title>

  <!-- Vendor CSS BUNDLE
    Includes styling for all of the 3rd party libraries used with this module, such as Bootstrap, Font Awesome and others.
    TIP: Using bundles will improve performance by reducing the number of network requests the client needs to make when loading the page. -->
  <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/all.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/jquery.fileupload.css" rel="stylesheet">

  <!-- Vendor CSS Standalone Libraries
        NOTE: Some of these may have been customized (for example, Bootstrap).
        See: src/less/themes/{theme_name}/vendor/ directory -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/bootstrap.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/font-awesome.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/picto.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/material-design-iconic-font.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/datepicker3.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/jquery.minicolors.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/bootstrap-slider.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/railscasts.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/jquery-jvectormap.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/owl.carousel.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/slick.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/morris.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/ui.fancytree.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/daterangepicker-bs3.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/jquery.bootstrap-touchspin.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/vendor/select2.css" rel="stylesheet"> -->

  <!-- APP CSS BUNDLE [<?php echo Yii::app()->theme->baseUrl?>/css/app/app.css]
INCLUDES:
    - The APP CSS CORE styling required by the "social-3" module, also available with main.css - see below;
    - The APP CSS STANDALONE modules required by the "social-3" module;
NOTE:
    - This bundle may NOT include ALL of the available APP CSS STANDALONE modules;
      It was optimised to load only what is actually used by the "social-3" module;
      Other APP CSS STANDALONE modules may be available in addition to what's included with this bundle.
      See src/less/themes/social-3/app.less
TIP:
    - Using bundles will improve performance by greatly reducing the number of network requests the client needs to make when loading the page. -->
  <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/app.css" rel="stylesheet">

  <!-- App CSS CORE
This variant is to be used when loading the separate styling modules -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/main.css" rel="stylesheet"> -->

  <!-- App CSS Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->

  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/essentials.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/layout.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/sidebar.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/sidebar-skins.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/navbar.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/media.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/player.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/timeline.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/cover.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/chat.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/charts.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/maps.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/colors-alerts.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/colors-background.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/colors-buttons.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/colors-calendar.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/colors-progress-bars.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/colors-text.css" rel="stylesheet" /> -->
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl?>/css/app/ui.css" rel="stylesheet" /> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- Fixed navbar -->
    <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#sidebar-chat" data-toggle="sidebar-menu" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
          <a class="navbar-brand" href="<?php echo Yii::app()->request->getBaseUrl(true)?>">Soheep</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
          <!-- 
          <ul class="nav navbar-nav">
            <li><a href="http://themekit.aws.ipv4.ro/index.html">Themes</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">Public User Pages</li>
                <li><a href="user-public-timeline.html">Timeline</a></li>
                <li><a href="user-public-profile.html">About</a></li>
                <li><a href="user-public-users.html">Friends</a></li>
                <li class="dropdown-header">Private User Pages</li>
                <li><a href="user-private-messages.html">Messages</a></li>
                <li><a href="user-private-profile.html">Profile</a></li>
                <li class="active"><a href="index-2.html">Timeline</a></li>
                <li><a href="user-private-users.html">Friends</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">UI Components <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="essential-buttons.html"><i class="fa fa-th"></i> Buttons</a></li>
                <li><a href="essential-icons.html"><i class="fa fa-paint-brush"></i> Icons</a></li>
                <li><a href="essential-progress.html"><i class="fa fa-tasks"></i> Progress</a></li>
                <li><a href="essential-grid.html"><i class="fa fa-columns"></i> Grid</a></li>
                <li><a href="essential-forms.html"><i class="fa fa-sliders"></i> Forms</a></li>
                <li><a href="essential-tables.html"><i class="fa fa-table"></i> Tables</a></li>
                <li><a href="essential-tabs.html"><i class="fa fa-circle-o"></i> Tabs</a></li>
              </ul>
            </li>
          </ul>
          -->
          <ul class="nav navbar-nav navbar-right">
            <li class="hidden-xs">
              <a href="#sidebar-chat" data-toggle="sidebar-menu">
                <i class="fa fa-comments"></i>
              </a>
            </li>
            <!-- User -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
              	<?php 
                  	echo $this->getProfilePicture("img-circle");
	  				$user = $this->getProfile();
	  				echo $user->firstname;
                  	?>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="user-private-profile.html">Profile</a></li>
                <li><a href="user-private-messages.html">Messages</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('new/logout')?>">Logout</a></li>
              </ul>
            </li>

          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </div>

    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <div class="sidebar sidebar-chat right sidebar-size-2 sidebar-offset-0 chat-skin-dark sidebar-visible-mobile" id=sidebar-chat>
      <div class="split-vertical">
        <div class="chat-search">
          <input type="text" class="form-control" placeholder="Search" />
        </div>

        <ul class="chat-filter nav nav-pills ">
          <li class="active"><a href="#" data-target="li">All</a></li>
          <li><a href="#" data-target=".online">Online</a></li>
          <li><a href="#" data-target=".offline">Offline</a></li>
        </ul>
        <div class="split-vertical-body">
          <div class="split-vertical-cell">
            <div data-scrollable>
              <ul class="chat-contacts">
                <li class="online" data-user-id="1">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-6.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">

                        <div class="contact-name">Jonathan S.</div>
                        <small>"Free Today"</small>
                      </div>
                    </div>
                  </a>
                </li>

                <li class="online away" data-user-id="2">
                  <a href="#">

                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-5.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Mary A.</div>
                        <small>"Feeling Groovy"</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="online" data-user-id="3">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left ">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-3.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Adrian D.</div>
                        <small>Busy</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="offline" data-user-id="4">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-6.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Michelle S.</div>
                        <small>Offline</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="offline" data-user-id="5">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-7.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Daniele A.</div>
                        <small>Offline</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="online" data-user-id="6">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-4.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Jake F.</div>
                        <small>Busy</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="online away" data-user-id="7">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-6.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Jane A.</div>
                        <small>"Custom Status"</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="offline" data-user-id="8">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-8.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Sabine J.</div>
                        <small>"Offline right now"</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="online away" data-user-id="9">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-9.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Danny B.</div>
                        <small>Be Right Back</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="online" data-user-id="10">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/woman-8.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">Elise J.</div>
                        <small>My Status</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="online" data-user-id="11">
                  <a href="#">
                    <div class="media">
                      <div class="pull-left">
                        <span class="status"></span>
                        <img src="<?php echo Yii::app()->theme->baseUrl?>/images/people/110/guy-3.jpg" width="40" class="img-circle" />
                      </div>
                      <div class="media-body">
                        <div class="contact-name">John J.</div>
                        <small>My Status #1</small>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script id="chat-window-template" type="text/x-handlebars-template">

      <div class="panel panel-default">
        <div class="panel-heading" data-toggle="chat-collapse" data-target="#chat-bill">
          <a href="#" class="close"><i class="fa fa-times"></i></a>
          <a href="#">
            <span class="pull-left">
                    <img src="{{ user_image }}" width="40">
                </span>
            <span class="contact-name">{{user}}</span>
          </a>
        </div>
        <div class="panel-body" id="chat-bill">
          <div class="media">
            <div class="media-left">
              <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
            </div>
            <div class="media-body">
              <span class="message">Feeling Groovy?</span>
            </div>
          </div>
          <div class="media">
            <div class="media-left">
              <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
            </div>
            <div class="media-body">
              <span class="message">Yep.</span>
            </div>
          </div>
          <div class="media">
            <div class="media-left">
              <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
            </div>
            <div class="media-body">
              <span class="message">This chat window looks amazing.</span>
            </div>
          </div>
          <div class="media">
            <div class="media-left">
              <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
            </div>
            <div class="media-body">
              <span class="message">Thanks!</span>
            </div>
          </div>
        </div>
        <input type="text" class="form-control" placeholder="Type message..." />
      </div>
    </script>

    <div class="chat-window-container"></div>

    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">
		<?php echo $content;?>
      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
    <footer class="footer">
      <strong>Soheep</strong> &copy; Copyright 2015
    </footer>
    <!-- // Footer -->

  </div>
  <!-- /st-container -->

  <!-- Inline Script for colors and config objects; used by various external scripts; -->
  <script>
    var colors = {
      "danger-color": "#e74c3c",
      "success-color": "#81b53e",
      "warning-color": "#f0ad4e",
      "inverse-color": "#2c3e50",
      "info-color": "#2d7cb5",
      "default-color": "#6e7882",
      "default-light-color": "#cfd9db",
      "purple-color": "#9D8AC7",
      "mustard-color": "#d4d171",
      "lightred-color": "#e15258",
      "body-bg": "#f6f6f6"
    };
    var config = {
      theme: "social-3",
      skins: {
        "default": {
          "primary-color": "#e74c3c"
        },
        "green": {
          "primary-color": "#16ae9f"
        },
        "blue": {
          "primary-color": "#4687ce"
        },
        "purple": {
          "primary-color": "#af86b9"
        },
        "brown": {
          "primary-color": "#c3a961"
        },
        "default-nav-inverse": {
          "color-block": "#242424"
        }
      }
    };
  </script>
	<?php 
		Yii::app()->clientScript->registerCoreScript("jquery",CClientScript::POS_END);
	?>
  <!-- Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->

  <!-- Vendor Scripts Standalone Libraries -->
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/bootstrap.min.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/breakpoints.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery.nicescroll.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery.fileupload.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/isotope.pkgd.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/packery-mode.pkgd.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery.grid-a-licious.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery.cookie.js"></script> 
  <!-- <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery-ui.custom.js"></script> --> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery.hotkeys.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/handlebars.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/load_image.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/core/jquery.debouncedresize.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/tables/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/forms/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/media/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/charts/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/charts/flot/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/charts/easy-pie/jquery.easypiechart.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/charts/morris/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/charts/sparkline/all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/tree/jquery.fancytree-all.js"></script> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/vendor/nestable/jquery.nestable.js"></script> 

  <!-- App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->

  <!-- App Scripts Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->

  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/app/media.js"></script> 
  <!--<script src="<?php echo Yii::app()->theme->baseUrl?>/js/app/player.js"></script>--> 
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/app/timeline.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/app/chat.js"></script>

  <!-- App Scripts CORE [social-3]:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        app.js already includes main.js so this should be loaded
        ONLY when using the standalone modules; -->
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/app/main.js"></script> 

</body>
</html>