<div class="col-md-12">
	<?php  
		$baseUrl = Yii::app()->theme->baseUrl;
		Yii::app()->clientScript->registerScript('upload-feed',"
		 $('#Feeds_images').fileupload({
	        url: '".Yii::app()->createUrl('/timeline/feeds/uploadimage')."',
	        dataType: 'json',
	        done: function (e, data) {
	        	var img = '<img class=\"img-responsive\" style=\"width:100%\" src=\"".Yii::app()->request->baseUrl."'+data.result.thumb+'\">'
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
		
		Yii::app()->clientScript->registerScript("add-comment-feed","
			 $('.comment-o').click(function(){
			 	var comments = $(this).attr('id');
			 	var id_feeds = parseInt(comments.replace('comment-o-', ''));
			 	if( $('#comment-'+id_feeds).val() != ''){
			 	$.ajax({
			        url: '".Yii::app()->createUrl('/timeline/feeds/comments')."',
			        type:'post',
			        data:{
			        	id_feeds : id_feeds,
						id_user : ".Yii::app()->user->id['id']." ,
						comment : $('#comment-'+id_feeds).val(),
			        },
			        dataType: 'html',
			        success: function (data) {
			        	$('#komentar-'+id_feeds).html(data);
			        	$('#comment-'+id_feeds).val('');
			        },
			        failure: function () {
			            alert('fill your comment first');
			        }
		        });
		        }else{
		        	alert('fill your comment first');
		        }
		        return false;
		    })
		",CClientScript::POS_END); 
		?>
		<div class="col-md-3 col-sm-4 col-xs-12 col-left">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default panel-user-detail">
						<div class="panel-body">
						<ul class="list-unstyled">
							<li><i class="fa fa-suitcase"></i>Works at <a href="#">software development</a></li>
							<li><i class="fa fa-calendar"></i>Born on August 12, 1991</li>
							<li><i class="fa fa-rss"></i>Followed by <a href="#">51 People</a></li>
						</ul>
						</div>
						<div class="panel-footer text-center">
							<a href="#"><i class="fa fa-share"></i>Read more...</a>
						</div>
					</div>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default panel-friends">
						<div class="panel-heading">
							<a href="<?php echo Yii::app()->createUrl('/friends')?>" class="pull-right">View all&nbsp;<i class="fa fa-share-square-o"></i>
							</a>
								<h3 class="panel-title"><i class="fa fa-users"></i>&nbsp;Friends</h3>
						</div>
						<div class="panel-body text-center">
						<ul class="friends">
							<?php $fren = $this->getFriends(6);
								if($fren != null){
									foreach ($fren as $f){
										$idF = ($f->id_user == Yii::app()->user->id['id']) ? $f->id_user_friend : $f->id_user;
										$img = $this->getProfilePicture("img-responsive tip","",$idF);
										echo '<li><a href="#">'.$img.'</a></li>';
									}
									
								}
							?>
						</ul>
						</div>
					</div>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default panel-photos">
						<div class="panel-heading">
							<a href="#" class="pull-right">View all&nbsp;<i class="fa fa-share-square-o"></i></a>
							<h3 class="panel-title"><i class="fa fa-image"></i>&nbsp;Photos</h3>
						</div>
						<div class="panel-body text-center">
						<ul class="photos">
							<?php $fotos = $this->getFeedFotos(Yii::app()->user->id['id'],6);
							if($fotos != null){
								foreach ($fotos as $fot){
									$src = Yii::app()->request->baseUrl.$fot->description;
									$alt = "foto-".Yii::app()->user->id['id'];
									echo '<li><a href="#"><img src="'.$src.'" alt="'.$alt.'" class="img-responsive show-in-modal"></a></li>';
								}
									
							}
							
							?>
						</ul>
						</div>
					</div>
				</div>
			</div>
		
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default panel-groups">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-users"></i>&nbsp;Groups</h3>
					</div>
					<div class="panel-body">
						<ul class="list-group">
						<?php 
						if($interest != null){
							Yii::app()->clientScript->registerScript('del-interst','
								$(".del-interest").click(function(){
									if(confirm("Are you sure to remove this Interest?")){
										$.ajax({
											url:"'.Yii::app()->createUrl('/timeline/feeds/deleteInterest').'",
											type:"POST",
											data:{
												id_interst : $(this).attr("data-id"),
											},
											dataType:"json",
											success:function(data){
												$("#btn-interst-"+data.id).fadeOut();
												alert(data.name+" has been removed");
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
								<li class="list-group-item" id="btn-interst-<?php echo $dataInterst->id_user_interst?>">
								<div class="col-xs-9">
									<a href="<?php echo Yii::app()->createUrl("/group/interest/index/id/".$dataInterst->id_interest)?>">
									<span class="name"><?php echo $dataInterst->idInterest->interest_name?></span>
									</a>
								</div>
								<div class="col-xs-3">
									<button type="button" class="btn btn-xs del-interest" data-id="<?php echo $dataInterst->id_user_interst?>" title="Delete">
							      	<span style="padding: 1px;"><i class="fa fa fa-times"></i></span>
							      </button>
							     </div>
								<div class="clearfix"></div>
								</li>
						<?php 
							}
						?> 
						<?php 
						}?>
						</ul>
					</div>
					<div class="panel-footer text-center">
						<a href="<?php echo Yii::app()->createUrl('/timeline/interest')?>"><i class="fa fa-plus"></i> Add Your Interest</a>
					</div>
				</div>
				</div>
			</div>	
		</div>
					
		<div class="col-md-6 col-sm-7 col-xs-12 col-right">
			<div class="row">
			<div class="col-md-12 col-xs-12">
			<div class="well well-sm well-social-post">
				<?php 
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
				<ul class="list-inline" id='list_PostActions'>
					<li class='active'>
						<i class="fa fa-edit"></i>
						<span class="hidden-xs">What&acute;s new heep</span>
					</li>
				</ul>
				<div class="img-post"></div>
				<div class="progress-bar progress-bar-success" style="display:none;height:3px !important;"></div>
				<?php
				echo $form->hiddenField($feed,'imagesUrl');
			    echo $form->textArea($feed,'text_caption',array('class'=>"form-control share-text",'placeholder'=>'Share your heep...'));
			    ?>
				<ul class='list-inline post-actions'>
					<li><a href="#"  class="fileinput-button text-center" id="upload-image" ><span class="glyphicon glyphicon-camera"></span><input type="file" multiple="" name="images" id="Feeds_images"></a></li>
					<li><a href="#"><span class="glyphicon glyphicon-map-marker"></span></a></li>
					<li class='pull-right'>
						<button type="submit" class="btn btn-xs pull-right display-block btn-info btn-xs btn-fill" href="#">Post</button>
					</li>
				</ul>
				<?php $this->endWidget(); ?>
			</div>
			</div>
			</div>
			
			<div class="row">
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
			
			
		</div>	
		<div class="col-md-3 col-sm-4 col-xs-12 col-right">
			<div class="row">
			<h4 class="title">List Activity</h4>
			<?php 
			$this->widget('bootstrap.widgets.TbListView', array(
		            'dataProvider' => $feed->allCommunityfeedsHome,
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
		</div>
		
</div>