<div class="navbar navbar-clear">
    <div class="navbar-inner">
        <div class="center sliding"></div>
    </div>
</div>

<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="login" class="page page-bg">

        <div class="page-content">

            <div class="login-view-box">

                <div class="text-center">
                    <img src="<?php echo Yii::app()->theme->baseUrl."/"?>assets/img/logo4.png" alt="" class="logo"/>
                </div>

                <div class="list login-form-box">
                	<?php 
                	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                			'id' => 'login-form',
                			'clientOptions' => array(
                					'validateOnSubmit' => true,
                			),
                	));
                	?>
                        <label class="item item-input">
                        	<?php echo $form->textField($formLog,'username',array('placeholder'=>'Your email', 'ng-model' => "postData.login"))?>
                        </label>
                        <label class="item item-input">
                        	<?php echo $form->passwordField($formLog,'password',array('placeholder'=>'Password', 'ng-model '=> "postData.key" ))?>
                        </label>
                        <button type="submit" class="button button-block button-positive" id="login-button">
                            <i class="icon ion-loading-c" ng-show="loading"></i>
                            <span ng-hide="loading">Sign In</span>
                        </button>
			    	<?php $this->endWidget(); ?>
                </div>

                <div class="footer-link text-center" ng-show="showHelp">
                    <button  onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/member/signup')?>';" class="button button-block button-positive" id="login-button">
						<i class="icon ion-loading-c" ng-show="loading"></i> <span
							ng-hide="loading">Sign Up</span>
					</button>
                    <a href="#" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/member/signup')?>';">
                        I don't have an account
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>