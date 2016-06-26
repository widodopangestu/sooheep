<?php 
Yii::app()->clientScript->registerScript('find-friend','
	$("#Profile_globalSearch").keyup(function(){
		$.ajax({
			url:"'.CController::createUrl('/friends/find/index/mode/ajax').'",
			data:$("#search-friend").serialize(),
			dataType:"html",
			success:function(data){
				$(".all-friends").html(data);				
			},
		});
	});
	$("#search-friend").submit(function(){
		$.ajax({
			url:"'.CController::createUrl('/friends/find/index/mode/ajax').'",
			data:$(this).serialize(),
			dataType:"html",
			success:function(data){
				$(".all-friends").html(data);				
			},
		});
		return false;
	});
');
?>
<div class="row">
	<div class="panel panel-body">
	<?php 
	 echo Yii::app()->user->getFlash('berhasil-addfren');
	 $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	        'id' => 'search-friend',
        	'type' => 'horizontal',
        	'action' => CController::createUrl('/friends/find/index'),
	    ));
	?>
	<div class="col-sm-12">
		<div class="input-group">
			<?php echo $form->textField($alluser,'globalSearch',array('class'=>'form-control','placeholder'=>'type your friend name or email'))?>
			<span class="input-group-btn">
				<button type="submit" class="btn btn-inverse">Search</button> 
			</span>
		</div>
	</div>
	<?php $this->endWidget(); ?>
	</div>
</div>

<div class="row">
<div class="all-friends">
<?php 
$this->renderPartial('friends',array(
				'alluser' => $alluser,
			)); 
?>
</div>
</div>