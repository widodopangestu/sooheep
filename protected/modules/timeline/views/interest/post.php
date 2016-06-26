<div class="col-xs-12 col-md-6 col-lg-6 item">
	<div class="timeline-block post">
		<div class="panel panel-default">
			<div class="panel-heading">
			<?php 
			$user = $this->getProfile($data->id_user);
			?>
				<div class="media">
					<div class="media-left">
						<a href="#"> 
						<?php echo $user->getProfilePicture("media-object","height:50px;"); ?>
						</a>
					</div>
					<div class="media-body">
						<a class="pull-right text-muted" href="#"><i
							class="icon-reply-all-fill fa fa-2x "></i>
						</a> <a href="#"><?php echo $user->firstname." ".$user->lastname?></a> 
						<span><?php echo "on ".$this->getFullDateTime($data->created_date)?></span>
					</div>
				</div>
			</div>
			
			<?php 
			switch ($data->feedsAttributes->type) {
				case Feeds::TYPE_TEXT_POST:
					$this->renderPartial('_text_post',array('data'=>$data));
				break;
				case Feeds::TYPE_IMAGE_POST:
					$this->renderPartial('_img_post',array('data'=>$data));
				break;
				default:
					$this->renderPartial('_text_post',array('data'=>$data));
				break;
			}
			?>
			<ul class="comments">
				<div id="komentar-<?php echo $data->id_feeds?>">
				<?php 
					$this->renderPartial('_comments',array('data'=>$data));
				?>
				</div>
				
				<li class="comment-form">
					<div class="input-group">
						<input type="text" class="form-control" id="comment-<?php echo $data->id_feeds?>"> 
						<span class="input-group-btn"> 
						<?php 
						echo CHtml::link(
							'<i class="fa fa-comment-o"></i>',
							'#',
							array(
								'class'=>'comment-o btn btn-default',
								'id'=>'comment-o-'.$data->id_feeds
							)
						);
						?>
						</span>
					</div>
				</li>
			</ul>
		</div>

	</div>
</div>
<?php Yii::app()->clientScript->registerScript("add-comment","
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
",CClientScript::POS_END);?>