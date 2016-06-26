<div class="navbar">
    <div class="navbar-inner">
    	<div class="left">
            <a class="link" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/member/login')?>';" href="#">
                <span class="icon-chevron-left"></span> <span>Back</span>
            </a>
        </div>
        <div class="center sliding">Lets Join Us</div>
        <div class="right">
        </div>
    </div>
</div>

<div class="pages navbar-fixed toolbar-fixed">
    <!-- Pages -->
    <div class="pages">
        <div class="page no-toolbar" data-page="settings">
            <div class="page-content">
				<?php //$this->widget('application.modules.hybridauth.widgets.renderProviders'); ?>
				
                <?php
					    $form2 = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					        'id' => 'login-form2',
		        			'type' => 'horizontal',
        					'enableAjaxValidation' => true,
					        'clientOptions' => array(
					            'validateOnSubmit' => true,
					        ),
			        		'action' => CController::createUrl('member/signup')
					    ));
					    
				?>
                
                                	<?php echo $form2->errorSummary($formReg); ?>
                <div class="list-block">
                    <ul>
                        <!-- Text inputs -->
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">E-mail</div>
                                    <div class="item-input">
                                    	<?php echo $form2->textField($formReg,'email',array('placeholder'=>'Type Your Email'))?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Password</div>
                                    <div class="item-input">
                                    	<?php echo $form2->passwordField($formReg,'password',array('placeholder'=>'Type Your Password'))?>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Retype Password</div>
                                    <div class="item-input">
                                    	<?php echo $form2->passwordField($formReg,'retypePassword',array('placeholder'=>'Retype Your Password'))?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">First Name</div>
                                    <div class="item-input">
                                    	<?php echo $form2->textField($formReg,'firstName',array('placeholder'=>'First Name'))?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Last Name</div>
                                    <div class="item-input">
                                    	<?php echo $form2->textField($formReg,'lastName',array('placeholder'=>'Last Name'))?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Select -->
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Gender</div>
                                    <div class="item-input">
                                        <?php echo $form2->dropDownList($formReg,'gender',$formReg->getDataGender())?>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Birth Date</div>
                                    <div class="item-input">
                                        <?php echo $form2->dropDownList($formReg,'dayOf',$formReg->getDate(),array('class'=>'date'))?>
                                        <?php echo $form2->dropDownList($formReg,'monthOf',$formReg->getMonth(),array('class'=>'month'))?>
                                        <?php echo $form2->dropDownList($formReg,'yearOf',$formReg->getYear(10),array('class'=>'year'))?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!-- Select -->
                        <li>
                        	<a href="#" class="item-link smart-select" data-searchbar="true" data-searchbar-placeholder="Search Country" data-open-in="popup">
                        	 <?php echo $form2->dropDownList($formReg,'country',$formReg->getCountry(),array(
						                        'class'=>"form-control form-effect ",
						                        'empty'=>'Chose Country',
                                        		//'onchange' => 'alert("test")',
												'ajax' => array(
													'type'=>'POST', //request type
													'url'=>CController::createUrl('/new/getcity'), //url to call.
													'update'=>"#RegisterForm_city", //selector to update
													'beforeSend' => 'function(){
													      myApp.showPreloader();
													}',
													'complete' => 'function(){
													      myApp.hidePreloader();
													}'
												)
				                        ));
				                        ?>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Country</div>
                                    <div class="item-after">
                                       Chose Country
                                       
                                    </div>
                                </div>
                            </div>
                            </a>
                        </li>
                        
                        <!-- Select -->
                        <li>
                        	<a href="#" class="item-link smart-select" data-searchbar="true" data-searchbar-placeholder="Search Country" data-open-in="popup" data-virtual-list="true" data-virtual-list-height="55">
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
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">City</div>
                                    <div class="item-after">
                                        Chose City
                                    </div>
                                </div>
                            </div>
                            </a>
                        </li>
                        
		                <?php echo CHtml::hiddenField('step1','yeah')?>
						<li>
							<div class="item-content">
								<div class="item-inner">
									<div class="input-submit pull-right">
						                <?php echo CHtml::htmlButton('Join',array('type'=>'submit', 'class'=>'button button-big js-form-submit button-fill button-primary'))?>
						            </div>
								</div>
							</div>
						</li>
                    </ul>
				</div>
                <?php $this->endWidget(); ?>
                
            </div>
        </div>
    </div>
</div>

