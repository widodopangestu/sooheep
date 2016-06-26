<?php 
	$user = $this->getProfile($data->id_user);
	
?>
<div class="col-md-12">
		<div class="panel panel-white post panel-shadow">
		<div class="post-heading">
			<div class="pull-left image">
				<?php echo $user->getProfilePicture("img-rounded avatar"); ?>
			</div>
			<div class="pull-left meta">
			<div class="title h5">
				<a href="#" class="post-user-name">
					<?php echo $user->firstname." ".$user->lastname?>
				</a> <!--uploaded a photo.-->
				<?php if($data->post_type == Feeds::POST_GROUP):
				?>
				<?php echo (($data->interest != NULL) ? "post on Group ".CHtml::link($data->interest->interest_name,'/group/interest/index/id/'.$data->post_interest_id).'</span>' : "")?>
				<?php endif;?>
			</div>
			<h6 class="text-muted time"><?php echo "on ".$this->getFullDateTime($data->created_date)?></h6> 
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
	
		<div class="post-footer">
		<div class="input-group">
		<input class="form-control" id="comment-<?php echo $data->id_feeds?>" placeholder="Add a comment" type="text"> 
		<span class="input-group-addon"> 
			<?php 
				echo CHtml::link(
					'<i class="fa fa-comment-o"></i>',
					'#',
					array(
						'class'=>'comment-o',
						'id'=>'comment-o-'.$data->id_feeds
					)
				);
				?>
		</span>
		</div>
		<ul class="comments-list" id="komentar-<?php echo $data->id_feeds?>">
			<?php 
				$this->renderPartial('_comments',array('data'=>$data));
			?>
		</ul>
		</div>
	</div>
</div>

