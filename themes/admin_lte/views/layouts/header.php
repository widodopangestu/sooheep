
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo Yii::app()->request->baseUrl?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b></b><i class="fa fa-search"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Electronic City</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <a href="#" role="button" class="sidebar-toggle2" >
            <i class="fa fa-cloud"></i> Corporate
          </a>
          <a href="#" role="button" class="sidebar-toggle2" >
            <i class="fa fa-shopping-cart"></i> Online Store
          </a>
              
         <?php 
           if (!Yii::app()->user->isGuest):
         ?>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i> Admin Menu
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Admin Menu</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="<?php echo Yii::app()->createUrl("/employee/create")?>">
                          <div class="pull-left">
                            <i class="fa fa-plus"></i>
                            <i class="fa fa-users"></i>
                          </div>
                          <h4>
                            Create Employee
                          </h4>
                          <p>Create new employe</p>
                        </a>
                      </li><!-- end message -->
                      
                      <li><!-- start message -->
                        <a href="<?php echo Yii::app()->createUrl("/employee/admin")?>">
                          <div class="pull-left">
                            <i class="fa fa-table"></i>
                            <i class="fa fa-users"></i>
                          </div>
                          <h4>
                            All Employee
                          </h4>
                          <p>Show all employe data</p>
                        </a>
                      </li><!-- end message -->
                      
                      <li><!-- start message -->
                        <a href="<?php echo Yii::app()->createUrl("/article/create")?>">
                          <div class="pull-left">
                            <i class="fa fa-plus"></i>
                            <i class="fa fa-file-text"></i>
                          </div>
                          <h4>
                            Create Article
                          </h4>
                          <p>Create new article</p>
                        </a>
                      </li><!-- end message -->
                      
                      <li><!-- start message -->
                        <a href="<?php echo Yii::app()->createUrl("/article/admin")?>">
                          <div class="pull-left">
                            <i class="fa fa-table"></i>
                            <i class="fa fa-file-text"></i>
                          </div>
                          <h4>
                            All Article
                          </h4>
                          <p>Show all article data</p>
                        </a>
                      </li><!-- end message -->
                      
                      <li><!-- start message -->
                        <a href="<?php echo Yii::app()->createUrl("/user/create")?>">
                          <div class="pull-left">
                            <i class="fa fa-plus"></i>
                            <i class="fa fa-user"></i>
                          </div>
                          <h4>
                            Create User
                          </h4>
                          <p>Create new user</p>
                        </a>
                      </li><!-- end message -->
                      
                      <li><!-- start message -->
                        <a href="<?php echo Yii::app()->createUrl("/user/admin")?>">
                          <div class="pull-left">
                            <i class="fa fa-table"></i>
                            <i class="fa fa-user"></i>
                          </div>
                          <h4>
                            All user
                          </h4>
                          <p>Show all article data</p>
                        </a>
                      </li><!-- end message -->
                      
                    </ul>
                  </li>
                </ul>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"> <i class="fa fa-gear"></i></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      <?php echo Yii::app()->user->name?>
                       <small></small> 
                    </p>
                  </li>
                  
                  <!-- Menu Body -->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?php echo Yii::app()->createUrl('/site/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        <?php 
		else:
		?>
		<div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="<?php echo Yii::app()->createUrl('/site/login')?>" class="dropdown-toggle">
                  <i class="fa fa-sign-in"></i> Sign In
                </a>
               </li>
              </ul>
        </div>        
		<?php 
        endif;
        ?>
        </nav>
      </header>