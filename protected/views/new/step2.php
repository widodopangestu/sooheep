<div class="container-fluid main" id="page-top">
	<div class="row">
		<div class="col-md-12 backg">
			<div class="col-md-8 col-md-offset-2 inner col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
				<div class="text-box">
				<?php
				$form2 = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			        'id' => 'login-form2',
        			'type' => 'horizontal',
			        'clientOptions' => array(
			            'validateOnSubmit' => true,
				),
			        'htmlOptions' => array(
			        	'action' => Yii::app()->createUrl('/new/index')
				)
				));

				echo $form2->errorSummary($formReg);
				?>
				
				<div class="row">
				<div class="col-sm-6">
				    <div class="row">
				    <div class="col-sm-4 text-left">
				    <label class="text-right">Birth Date</label>
				    </div>
				    <div class="col-sm-2 no-padding-right">
                        <?php echo $form2->dropDownList($formReg,'dayOf',$formReg->getDate(),array('class'=>"form-control form-effect append-left"))?>
                        </div>
				    <div class="col-sm-3  no-padding-left  no-padding-right">
                        <?php echo $form2->dropDownList($formReg,'monthOf',$formReg->getMonth(),array('class'=>"form-control form-effect append-left"))?>
                        </div>
				    <div class="col-sm-3 no-padding-left">
                        <?php echo $form2->dropDownList($formReg,'yearOf',$formReg->getYear(10),array('class'=>"form-control form-effect append-left"))?>
                        </div>
                        </div>
				    <div class="row">
				    <div class="col-sm-4 text-left">
				    <label class="text-right"> Country </label>
				    </div>
				    <div class="col-sm-8">
                        <?php echo $form2->dropDownList($formReg,'country',$formReg->getCountry(),array(
                        'class'=>"form-control form-effect ",
                        'empty'=>'Chose Country',
						'ajax' => array(
							'type'=>'POST', //request type
							'url'=>CController::createUrl('new/getcity'), //url to call.
							'update'=>"#RegisterForm_city", //selector to update
						)
                        ));
                        
                        ?>
					</div>
					</div>
				    
				    <div class="row">
				    <div class="col-sm-4 text-left">
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
					</div>
					<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12 text-center">
							<label>What Your Interests</label>
						</div>
					</div>
					<div class="row">	
						<div class="col-sm-12">
						<?php $this->widget('ext.multicomplete.MultiComplete', array(
					          'model'=>$formReg,
					          'attribute'=>'interest',
					          'splitter'=>',',
					          'sourceUrl'=>Yii::app()->createUrl('/new/getinterest'),
					          'options'=>array(
					               'minLength'=>'2',
					          ),
					          'htmlOptions'=>array(
					               'class'=>"form-control form-effect",
					               'placeholder'=>'type your interests'
					          ),
					  ));
					  ?>
						</div>
					</div>
					</div>
					</div>
					<div class="row">
						<?php echo CHtml::hiddenField('step2','yeah')?>
						<div class="col-sm-6 text-right pull-right">
						<?php echo CHtml::htmlButton('Yeah, That\'s my interest',array('type'=>'submit', 'class'=>'link-button'))?>
						</div>
						<div class="col-sm-6 text-left pull-left">
						<?php 
						echo CHtml::link('Back',Yii::app()->createUrl('/new/index'),array('class'=>'link-button'))
						?>
						</div>
					</div>
					<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</div>
</div>
			