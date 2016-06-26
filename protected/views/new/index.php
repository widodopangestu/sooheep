<?php 
Yii::app()->clientScript->registerScript('form','
$("#login-form2").submit(function(e){

			var pageUrl = $(this).attr("action");
			$.ajax({
				url:$(this).attr("action"),
				success: function(data){
					$(window).html(data);
				}
			});
			
			if(pageurl!=window.location){
				window.history.pushState({path:pageurl},"",pageurl);	
			}
			return false;  
		});
');
?>
<div class="container-fluid main" id="page-top">
	<div class="row">
		<div class="col-md-12 backg">
			<div class="col-md-4 col-md-offset-7 inner col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
				<div class="text-box">
					<p class="intro">Let's Join Us</p>
						<div class="row text-center">
						<?php $this->widget('application.modules.hybridauth.widgets.renderProviders'); ?>
						</div>
						<?php
					    $form2 = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					        'id' => 'login-form2',
		        			'type' => 'horizontal',
        					'enableAjaxValidation' => true,
					        'clientOptions' => array(
					            'validateOnSubmit' => true,
					        ),
			        		'action' => CController::createUrl('new/index')
					    ));
					    
					    echo $form2->errorSummary($formReg);
					    ?>
					    <div class="row">
					    <div class="col-sm-4 text-right">
					    <label> Email </label>
					    </div>
					    <div class="col-sm-8">
                        <?php echo $form2->textField($formReg,'email',array('class'=>"form-control form-effect ",'placeholder'=>'Type Your Email'))?>
                        <?php echo $form2->error($formReg, 'email'); ?>
                        </div>
                        </div>
					    <div class="row">
					    <div class="col-sm-4 text-right">
					    <label> Password </label>
					    </div>
					    <div class="col-sm-8">
                        <?php echo $form2->passwordField($formReg,'password',array('class'=>"form-control form-effect ",'placeholder'=>'Type Your Password'))?>
                        <?php echo $form2->error($formReg, 'password'); ?>
                        </div>
                        </div>
					    <div class="row">
					    <div class="col-sm-4 text-right">
					    <label> Retype Your Password </label>
					    </div>
					    <div class="col-sm-8">
                        <?php echo $form2->passwordField($formReg,'retypePassword',array('class'=>"form-control form-effect ",'placeholder'=>'Retype Your Password'))?>
                        <?php echo $form2->error($formReg, 'retypePassword'); ?>
                        </div>
                        </div>
                        <div class="row">
					    <div class="col-sm-4 text-right">
					    <label class="text-right">Your Name</label>
					    </div>
					    <div class="col-sm-8 no-padding">
					    <div class="col-sm-6">
                        <?php echo $form2->textField($formReg,'firstName',array('class'=>"form-control form-effect",'placeholder'=>'First Name'))?>
                        </div>
					    <div class="col-sm-6 no-padding-left">
	                        <?php echo $form2->textField($formReg,'lastName',array('class'=>"form-control form-effect ",'placeholder'=>'Last Name'))?>
                        </div>
                        <?php echo $form2->error($formReg, 'firstName'); ?>
                        <?php echo $form2->error($formReg, 'lastName'); ?>
                        </div>
	                     </div>
                        <div class="row">
                        <div class="col-sm-4 text-right">
					    	<label class="text-right">Gender</label>
					    </div>
					    <div class="col-sm-8">
	                        <?php echo $form2->dropDownList($formReg,'gender',$formReg->getDataGender(),array('class'=>"form-control form-effect"))?>
	                        </div>
                        </div>
                        <div class="row">
					    <div class="col-sm-4 text-right">
					    <label class="text-right">Birth Date</label>
					    </div>
					    <div class="col-sm-2 no-padding-right">
	                        <?php echo $form2->dropDownList($formReg,'dayOf',$formReg->getDate(),array('class'=>"form-control form-effect append-left"))?>
	                        </div>
					    <div class="col-sm-3  no-padding-left  no-padding-right">
	                        <?php echo $form2->dropDownList($formReg,'monthOf',$formReg->getMonth(),array('class'=>"form-control form-effect append-left append-right"))?>
	                        </div>
					    <div class="col-sm-3 no-padding-left">
	                        <?php echo $form2->dropDownList($formReg,'yearOf',$formReg->getYear(10),array('class'=>"form-control form-effect append-right"))?>
	                        </div>
	                    </div>
	                    <div class="row">
				    <div class="col-sm-4 text-right">
				    <label class="text-right"> Country </label>
				    </div>
				    <div class="col-sm-8">
                        <?php echo $form2->dropDownList($formReg,'country',$formReg->getCountry(),array(
                        'class'=>"form-control form-effect ",
                        'empty'=>'Chose Country',
						'ajax' => array(
							'type'=>'POST', //request type
							'url'=>CController::createUrl('/new/getcity'), //url to call.
							'update'=>"#RegisterForm_city", //selector to update
						)
                        ));
                        
                        ?>
					</div>
					</div>
				    
				    <div class="row">
				    <div class="col-sm-4 text-right">
				    <label class="text-right"> City </label>
				    </div>
				    <div class="col-sm-8">
                        <?php  
                        if(isset($formReg->city) && $formReg->city != null){
                        $dataCity = CHtml::listData(MasterCity::model()->findAll(array(
										'condition'=>'city_country_id = :parent_id',
										'params' =>array(':parent_id'=>intval($formReg->country))
									)),'city_id','city_name');
                        }else 
                        $dataCity = array();
                        
                        echo $form2->dropDownList($formReg,'city',$dataCity,array(
                        'class'=>"form-control form-effect ",
                        'empty'=>'Chose City',
                        ))?>
					</div>
					</div>
					    <div class="row">
					    <?php echo CHtml::hiddenField('step1','yeah')?>
					    <?php echo CHtml::htmlButton('Yeah I Want to Join',array('type'=>'submit', 'class'=>'link-button'))?>
					    </div>
                        <?php $this->endWidget(); ?>
					<p>
						By continuing, you're confirming that you've read and agree to our 
						<span><a target="_blank" href="#">Terms and Conditions</a></span>, 
						<span><a target="_blank" href="#">Privacy Policy</a></span> and 
						<span><a target="_blank" href="#">Cookie Policy</a></span>
					</p>
				</div>
			</div>
		</div>
		
		<!--<div class="col-md-12 some-notes">
			<div class="title">
				<h2>Welcome To Ravalic</h2>
			</div>
		
			<div class="desc">
				<p>
					Ravelic is a free responsive html5 templates released by <a
						href="http://www.html5templates/">HTML5 Layouts</a>. You can use
					this template for personal as well as commercial purpose but you have
					to give us a credit link in footer.
				</p>
			</div>
		</div>
	--></div>
</div><!--

<div class="container-fluid features" id="section2">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center features-text">Features</h2>
				<div class="col-md-6 col-sm-12 col-xs-12 icon-box">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div class="iconing">
							<i class="glyphicon glyphicon-pencil"></i>
						</div>
					</div>
					<div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12 icon-text-box">
                    	<h4>Modern Design</h4>
                    	<p>Lorem ipsum dolor sit amet, consectetur elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12 icon-box">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div class="iconing">
							<i class="glyphicon glyphicon-cog"></i>
						</div>
					</div>

					<div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12 icon-text-box">
                    	<h4>Easy To Customize</h4>
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				</div>

				<div class="col-md-6 col-sm-12 col-xs-12 icon-box">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div class="iconing">
							<i class="glyphicon glyphicon-time"></i>
						</div>
					</div>

					<div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12 icon-text-box">
                    	<h4>Save Time</h4>
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, adipiscing elit.</p>
					</div>
				</div>

				<div class="col-md-6 col-sm-12 col-xs-12 icon-box">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div class="iconing">
							<i class="glyphicon glyphicon-briefcase"></i>
						</div>
					</div>

					<div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12 icon-text-box">
                    	<h4>Professional Work</h4>
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
					</div>

				</div>

				<div class="col-md-6 col-sm-12 col-xs-12 icon-box">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div class="iconing">
							<i class="glyphicon glyphicon-user"></i>
						</div>
					</div>

					<div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12 icon-text-box">
                    	<h4>User-friendly Interface</h4>
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
					</div>

				</div>

				<div class="col-md-6 col-sm-12 col-xs-12 icon-box">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<div class="iconing">
							<i class="glyphicon glyphicon-heart"></i>
						</div>

					</div>

					<div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12 icon-text-box">
                    	<h4>Made With Love</h4>
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container-fluid work" id="work">
	<div class="container">
		<div class="row" id="starts">
			<div class="col-md-12 col-sm-12 col-xs-12 work-list">
				<h2 class="text-center portfolio-text">Portfolio</h2>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="images/story1.png" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="<?php echo Yii::app()->theme->baseUrl."/" ?>images/story1.png"/>
                		</div>

                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>

                		<h3>Amazing Beauty</h3>
                	</a>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="images/story2.png" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="<?php echo Yii::app()->theme->baseUrl."/" ?>images/story2.png"/>
                		</div>

                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Mind Blowing</h3>
                	</a>

				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="images/story3.png" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="<?php echo Yii::app()->theme->baseUrl."/" ?>images/story3.png"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>

                		<h3>Perfect Shot</h3>

                	</a>

				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="images/story2.png" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="<?php echo Yii::app()->theme->baseUrl."/" ?>images/story2.png"/>
                		</div>

                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>

                		<h3>Creative thoughts</h3>
                	</a>

				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="images/story3.png" data-lightbox="image-1">

                		<div class="featured-img">

                			<img src="<?php echo Yii::app()->theme->baseUrl."/" ?>images/story3.png"/>

                		</div>

                		<div class="image-hover">

                			<i class="glyphicon glyphicon-eye-open"></i>

						 </div>

                		<h3>Beautiful Picture</h3>

                	</a>

				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 work-space">

					<a href="images/story1.png" data-lightbox="image-1">

                		<div class="featured-img">

                			<img src="<?php echo Yii::app()->theme->baseUrl."/" ?>images/story1.png"/>

                		</div>

                		<div class="image-hover">

                			<i class="glyphicon glyphicon-eye-open"></i>

						 </div>

                		<h3>heart Touching</h3>

                	</a>

				</div>

			</div>

		</div>

	</div>

</div>



<div class="container-fluid countspace">

	<div class="container">

	<div class="row">

		<div class="col-md-12 countbg">

			<div class="col-xs-12 col-sm-3 col-md-3">

                <div class="counter-item">

                    <i class="glyphicon glyphicon-cloud"></i>

                    <div class="timer" data-from="0" data-to="100" data-speed="5000" data-refresh-interval="50"></div>

                    <h5>Files uploaded</h5>                               

                </div>

            </div>  

            <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="counter-item">

                    <i class="glyphicon glyphicon-check"></i>

                    <div class="timer" data-from="0" data-to="88" data-speed="5000" data-refresh-interval="50"></div>

                    <h5>Projects completed</h5>                               

                </div>

            </div>

            <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="counter-item">

                    <i class="glyphicon glyphicon-console"></i>

                    <div class="timer" data-from="0" data-to="3297" data-speed="5000" data-refresh-interval="50"></div>

                    <h5>Lines of code written</h5>                                                   

                </div>

            </div>

            <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="counter-item">

                    <i class="glyphicon glyphicon-user"></i>

                    <div class="timer" data-from="0" data-to="86" data-speed="5000" data-refresh-interval="50"></div>

                    <h5>Happy clients</h5>                                                   

                </div>     

			</div>

		</div>

	</div>

</div>

</div>


--><!-- 
<div class="container-fluid contact" id="section4">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center portfolio-text">Let's To Join Us</h2>
			</div>
		</div>
	</div>
</div>
 -->
