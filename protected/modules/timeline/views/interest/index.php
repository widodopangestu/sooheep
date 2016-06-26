<div class="col-xs-12 col-md-6 col-lg-4 item">
	<div class="timeline-block">
		<?php  
		Yii::app()->clientScript->registerScript('upload',"
		 $('#Feeds_images').fileupload({
	        url: '".Yii::app()->createUrl('/timeline/feeds/uploadimage')."',
	        dataType: 'json',
	        done: function (e, data) {
	        	var img = '<img class=\"img-responsive\" style=\"width:100%\" src=\"'+data.result.thumb+'\">'
	        	$('.img-post').html(img);
	        	$('#Feeds_imagesUrl').val(data.result.best);
	        	$('.progress-bar').hide();
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('.progress-bar').show();
	            $('.progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        }
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		",CClientScript::POS_END);
		
	    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	        'id' => 'feeds',
        	'type' => 'horizontal',
	    	/*'enableAjaxValidation' => true,
	        'clientOptions' => array(
	            'validateOnSubmit' => true,
	        ),*/
        	'action' => CController::createUrl('/timeline/feeds/setFeed'),
	    	//'htmlOptions' => array(
	    		//'enctype'=>'multipart/form-data'
	    	//)
	    ));
		?>
		<div class="panel panel-default share clearfix-xs">
			<div class="panel-heading panel-heading-gray title">What&acute;s new heep
			</div>
			<div class="img-post"></div>
			<div class="progress-bar progress-bar-success" style="display:none;height:3px !important;"></div>
			<div class="panel-body">
			<?php
			echo $form->hiddenField($feed,'imagesUrl');
		    echo $form->textArea($feed,'text_caption',array('class'=>"form-control share-text",'placeholder'=>'Share your heep...'));
		    ?>
			</div>
			<div class="panel-footer share-buttons">
				<a href="#" class="fileinput-button text-center" id="upload-image" style="float:left"><i class="fa fa-photo"></i> 
				<input type="file" multiple="" name="images" id="Feeds_images">
				<?php //echo $form->fileField($feed, 'images', array('multiple'=>"")); ?>
				</a> 
				<a href="#" class="text-center" id="location"><i class="fa fa-map-marker"></i> </a> 
				<!-- <a href="#" id="upload-image"><i class="fa fa-video-camera"></i></a> -->
				<?php echo $form->error($feed, 'text_caption'); ?>
				<button type="submit" class="btn btn-primary btn-xs pull-right display-block" href="#">Post</button>
			</div>
		</div>
		<?php 
		echo $form->errorSummary($feed);
		$this->endWidget(); ?>
	</div>
	<div class="timeline-block">
		<div class="panel panel-default profile-card clearfix-xs">
			<div class="panel-body">
				<div class="profile-card-icon">
					<i class="fa fa-heart"></i>
				</div>
				<h4 class="text-center">Interest</h4>
				<div class="row">
				<?php 
				if($interest != null){
					Yii::app()->clientScript->registerScript('del-interst','
						$(".del-interest").click(function(){
							if(confirm("Are you sure?")){
								$.ajax({
									url:"'.Yii::app()->createUrl('/timeline/feeds/deleteInterest').'",
									type:"POST",
									data:{
										id_interst : $(this).attr("data-id"),
									},
									dataType:"json",
									success:function(data){
										$("#btn-interst-"+data.id).fadeOut();
										alert(data.name+" has been delete");
									},
									failure:function(){	
										alert("Can\'t delete your interest");
									}
								});
							}
						});
					');
					foreach ($interest as $dataInterst){
						?>
						<div class="btn-group" style="margin-bottom:5px;" id="btn-interst-<?php echo $dataInterst->id_user_interst?>">
					      <a href="<?php echo Yii::app()->createUrl("/group/interest/index/id/".$dataInterst->id_interest)?>" type="button" class="btn btn-success btn-xs"><?php echo $dataInterst->idInterest->interest_name?></a>
					      <button type="button" class="btn btn-success btn-xs del-interest" data-id="<?php echo $dataInterst->id_user_interst?>">
					      	<span style="padding: 1px;"><i class="fa fa fa-times"></i></span>
					      </button>
					    </div>
				<?php 
					}
				?> 
				<?php 
				}?>
				</div>
				<div class="row">
					<a href="<?php echo Yii::app()->createUrl('/timeline/interest')?>" class="btn btn-primary pull-right"> Add Your Interest </a>
				</div>	
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12 col-md-6 col-lg-8 item" style="margin-top: -10px !important">
	<?php 
		$this->widget('bootstrap.widgets.TbListView', array(
	            'dataProvider' => $feed->allHomeFeeds,
	            'template' => "{items}{pager}",
	            'itemView' => 'post',
	            'ajaxUpdate' => false,
	            'id' => 'prd_listv',
				'summaryText'=>false,
				//'pagerCssClass'=>'pagination',
				'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.post', 
                    'listViewId' => 'prd_listv', 
                    'pagerSelector'=>'.pagination',
                    'header' => '',
                    'loaderText'=>'Please Wait...',
                    'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),
				),
			));		
	?>
</div>
