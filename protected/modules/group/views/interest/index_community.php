<div class="col-md-12">
	<?php  
		$baseUrl = Yii::app()->theme->baseUrl;
		Yii::app()->clientScript->registerScript('upload-feed',"
		 $('#Feeds_images').fileupload({
	        url: '".Yii::app()->createUrl('/group/interest/uploadimageComunity/id/'.$community->id)."',
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
		<div class="col-md-4 col-sm-5 col-xs-12 col-left col-md-offset-1">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default panel-friends">
						<div class="panel-heading">
							<a href="<?php echo Yii::app()->createUrl('/group/member')?>" class="pull-right">View all&nbsp;
								<i class="fa fa-share-square-o"></i></a>
								<h3 class="panel-title">
									<i class="fa fa-users"></i>&nbsp; Member
								</h3>
						</div>
						<div class="panel-body text-center">
						<ul class="friends">
							<?php 
							$fren = $this->getFriendsCommunity(9,$commuity->id);
								if($fren != null){
									foreach ($fren as $f){
										$idF = $f->id_user;
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
							<?php $fotos = $this->getCommunityFotos($commuity->id,15);
							if($fotos != null){
								foreach ($fotos as $fot){
									$src = Yii::app()->request->baseUrl.$fot->description;
									$alt = "foto-group-".Yii::app()->user->id['id'];
									echo '<li><a href="#"><img src="'.$src.'" alt="'.$alt.'" class="img-responsive show-in-modal"></a></li>';
								}
									
							}
							
							?>
						</ul>
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
						'id' => 'feeds-group',
						'type' => 'horizontal',
						/*'enableAjaxValidation' => true,
						 'clientOptions' => array(
						 		'validateOnSubmit' => true,
						 ),*/
						'action' => CController::createUrl('/group/interest/setFeedCommunity/id/'.$commuity->id),
						//'htmlOptions' => array(
						//'enctype'=>'multipart/form-data'
						//)
				));
				?>
				<ul class="list-inline" id='list_PostActions'>
					<li class='active'>
						<i class="fa fa-edit"></i>
						<span class="hidden-xs">Heep to your community</span>
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
		            'dataProvider' =>  $feed->getAllCommunityFeeds($commuity->id),
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