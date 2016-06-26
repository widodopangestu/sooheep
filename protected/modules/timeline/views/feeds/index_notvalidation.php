<div class="col-xs-12 col-md-6 col-lg-4 item">
	<div class="timeline-block">
		<?php  
		Yii::app()->clientScript->registerScript('upload',"
		 $('#Feeds_images').fileupload({
	        url: '#',
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
		
		?>
		<div class="panel panel-default share clearfix-xs">
			<div class="panel-heading panel-heading-gray title">What&acute;s new heep
			</div>
			<div class="img-post"></div>
			<div class="progress-bar progress-bar-success" style="display:none;height:3px !important;"></div>
			<div class="panel-body">
			<?php
		    echo CHtml::textArea('text_caption','',array('class'=>"form-control share-text",'placeholder'=>'Share your heep...'));
		    ?>
			</div>
			<div class="panel-footer share-buttons">
				<a href="#" class="fileinput-button text-center" id="upload-image" style="float:left"><i class="fa fa-photo"></i> 
				<input type="file" multiple="" name="images" id="Feeds_images">
				<?php //echo $form->fileField($feed, 'images', array('multiple'=>"")); ?>
				</a> 
				<a href="#" class="text-center" id="location"><i class="fa fa-map-marker"></i> </a> 
				<!-- <a href="#" id="upload-image"><i class="fa fa-video-camera"></i></a> -->
				<button type="submit" class="btn btn-primary btn-xs pull-right display-block" href="#">Post</button>
			</div>
		</div>
	</div>
	<div class="timeline-block">
		<div class="panel panel-default profile-card clearfix-xs">
			<div class="panel-body">
				<div class="profile-card-icon">
					<i class="fa fa-heart"></i>
				</div>
				<h4 class="text-center">Interest</h4>
				<?php if($interest != null){
					foreach ($interest as $dataInterst){
						?>
				<button class="btn btn-success btn-xs">
				<?php echo $dataInterst->idInterest->interest_name?>
					<i class="fa fa fa-times"></i>
				</button>
				<?php 
					}
				}?>
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
