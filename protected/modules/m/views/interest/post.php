<?php 
	$user = $this->getProfile($data->id_user);
?>
<li class="post">
	<div class="swipeout-actions-left">
		<a href="#" class="action-red js-add-to-fav">
			<?php echo $user->getProfilePicture(); ?>
		</a>
	</div>

	<div class="swipeout-content">
		<div class="item-content no-padding">
			<div class="item-inner blog-list">
				<?php 
				switch ($data->feedsAttributes->type) {
					case Feeds::TYPE_TEXT_POST:
						$this->renderPartial('_text_post',array('data'=>$data,'user'=>$user));
					break;
					case Feeds::TYPE_IMAGE_POST:
						$this->renderPartial('_img_post',array('data'=>$data,'user'=>$user));
					break;
					default:
						$this->renderPartial('_text_post',array('data'=>$data,'user'=>$user));
					break;
				}
				?>
			</div>
		</div>
	</div>

</li>