<?php 
$user = $this->getProfile($data->id_user);
?>
<div class="col-md-6 col-lg-3 item people-user">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="media">
				<div class="pull-left">
					<?php echo $user->getProfilePicture("media-object img-circle","height:50px;"); ?>
				</div>
				<div class="media-body">
					<h4 class="media-heading margin-v-5">
						<a href="#"><?php echo $data->firstname?></a>
					</h4>
					<div class="profile-icons">
						<span><i class="fa fa-users"></i> 372</span> <span><i
							class="fa fa-photo"></i> 43</span> <span><i
							class="fa fa-video-camera"></i> 3</span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<p class="common-friends">Heap List</p>
			<div class="user-friend-list">
				<a href="#"> 
					<img class="img-circle" alt="people" src="<?php echo Yii::app()->theme->baseUrl."/"?>images/people/50/guy-3.jpg"> 
				</a> 
				<a href="#"> 
					<img class="img-circle" alt="people" src="<?php echo Yii::app()->theme->baseUrl."/"?>images/people/50/guy-6.jpg"> 
				</a>
				<a href="#"> 
					<img class="img-circle" alt="people" src="<?php echo Yii::app()->theme->baseUrl."/"?>images/people/50/woman-8.jpg"> 
				</a> 
				<a href="#"> 
					<img class="img-circle" alt="people" src="<?php echo Yii::app()->theme->baseUrl."/"?>images/people/50/woman-5.jpg">
				</a>
			</div>
		</div>
		<div class="panel-footer">
			<?php echo $data->buttonaddfriend?>
		</div>
	</div>
</div>
