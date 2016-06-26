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
<div class="item-blank">
 	<div class="container" style="background:#fff;margin-top:50px;">
 	<div class="col-sm-12">
 	<?php
 				$formReg = new RegisterForm;
				$form2 = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			        'id' => 'login-form2',
					'action' => Yii::app()->createUrl('/new/step2'),
        			'type' => 'horizontal',
				));

				?>
				<div class="row">
					<div class="col-sm-12 text-center">
						<h4 class=" text-center ">What Your Interests</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
						<?php 
						Yii::app()->clientScript->registerScript('cek-interest','
							$(".check_interest").change(function() {
							    var urlP = "";
								if(this.checked) {
							    	urlP = "'.Yii::app()->createUrl("/new/setSessionInterest/cek/TRUE").'";
							    }else{
							    	urlP = "'.Yii::app()->createUrl("/new/setSessionInterest/cek/FALSE").'";
							    }
							    $.ajax({
						       		type:"POST",
						       		url:urlP,
						       		dataType:"html",
						       		data:{
						       			id : $(this).val()
						       		},
						       		success:function(data){
									    $(".hiddenVal").html(data);
						       		}
						       });
							});
						');
						echo $form2->textField($formReg,'typeInterest', array(
								'onkeyup'=>CHtml::ajax(array(
									'type'=>'GET', 
									'dataType'=>'html',
	                                'url'=>Yii::app()->createUrl('/new/getinterest'),
	                                'data'=>array('term'=>'js:this.value'),
	                                'beforeSend' => 'function(){
	                                    var loading=$("<span>")
	                                        .attr("class", "ui-autocomplete-loading loading-remove")
	                                        .html("&nbsp;&nbsp;&nbsp;&nbsp;")
	                                        $(".list").after($(loading));
	                                    }',
	                                'success'=>'function(data){
	                                    $(".list").empty();
	                                    $(".list").append(data);
	                                    $(".check_interest").change(function() {
										    var urlP = "";
											if(this.checked) {
										    	urlP = "'.Yii::app()->createUrl("/new/setSessionInterest/cek/TRUE").'";
										    }else{
										    	urlP = "'.Yii::app()->createUrl("/new/setSessionInterest/cek/FALSE").'";
										    }
										    $.ajax({
									       		type:"POST",
									       		url:urlP,
									       		dataType:"html",
									       		data:{
									       			id : $(this).val()
									       		},
									       		success:function(data){
									       			$(".hiddenVal").html(data);
									       		}
									       });
										});
	                                }',
	                                'complete' => 'function(){
	                                    $(".loading-remove").remove();
	                                }',
								)),
				               'class'=>"form-control form-effect",
				               'placeholder'=>'type your interests',
					  ));
					  ?>
					  </div>
						<div class="row">
						<div class="list" style="max-height: 435px; overflow-y: scroll; padding: 0px 15px;margin-top:10px;">
						<?php 
						$group = InterestGroup::model()->findAll(array(
						 	'order'=>'interest_name'
						 ));
						 foreach ($group as $g){
						 	$model = Interest::model()->findAll(array(
							 	'condition' => "id_group = :idGroup",
							 	'params' => array(':idGroup'=>$g->id),
							 	'order'=>'interest_name',
							 	//'limit' => 20
							 ));
							if($model != null){
								echo '<div class="row">';
							 	echo "<h4>".$g->interest_name."</h4><hr>";
							 	echo CHtml::checkBoxList('RegisterForm[item_interest][]', $this->setIdSessionChecked(),CHtml::listData($model,'id_interest','interest_name'),
							 		array(
							 			'template'=>'<div class="col-sm-4">{input}&nbsp;{label}</div>',
							 			'separator'=>'',
			 							'class'=>'check_interest'
							 		)
							 	);
							 	echo "</div>";
							}	
						 }
						 echo "<div class='hiddenVal'>";
						 if(count($this->setIdSessionChecked()) > 0){
					 		foreach ($this->setIdSessionChecked() as $val){
					 			echo CHtml::hiddenField('RegisterForm[interest][]',$val);
					 		}
					 		}
					 	 echo "</div>";	
						?>
						</div>
						</div>
					</div>
				</div>
				<?php echo CHtml::link('Close',Yii::app()->createUrl('/timeline'),array('class'=>'btn btn-info btn-fill pull-right'));?>
				&nbsp;&nbsp;
				<?php echo CHtml::submitButton('Save',array('class'=>'btn btn-info btn-fill pull-right'));?>
			<?php $this->endWidget(); ?>
		</div>			
 	</div>
 </div>
<div class="shadow">
<?php echo $content;?>
</div>
</body>
</html>