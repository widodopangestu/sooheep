<?php 
$comment = $data->comments;
if($comment == null):
?>
<li class="comment">
	<div class="comment-body">
		<p>Be First to heap this Momment</p>
	</div>
</li>
<?php 
else :
foreach ($comment as $com){
	$user = $com->profileuser;
?>	
<li class="comment">
	<a href="#" class="pull-left"> 
		<?php echo $user->getProfilePicture($class = "avatar");?>
	</a>
	<div class="comment-body">
		<div class="comment-heading">
			<h4 class="comment-user-name"><a href="#"><?php echo ($user != null) ? $user->firstname : ""?></a></h4>
			<h5 class="time"><?php echo $this->getFullDateTime($com->comment_date) ?></h5>
			<?php 
			if($com->id_user == Yii::app()->user->id['id']) {
			?>
				<a class="toggle-button pull-right" data-toggle="dropdown-<?php echo $com->id?>" href="#"> 
					<i class="fa fa-pencil"></i> 
				</a>
			<?php 
				}
			?>	
		</div>
		<p><?php echo $com->comment?></p>
	</div>
</li>
<?php 	
}
?>
<?php 
endif;
?>
