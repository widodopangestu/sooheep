<?php 
$comment = $data->comments;
if($comment == null):
?>
<li clas="media">
	<div class="media-body">
		<span>Be First to heap this Momment</span>
	</div>
</li>
<?php 
else :
foreach ($comment as $com){
	$user = $com->profileuser;
?>	

<li clas="media">
	<div class="media-left">
		<a href="#"> 
		<?php echo $user->getProfilePicture($class = "media-object",$style = "height:50px;");?>
		</a>
	</div>
	<div class="media-body">
		<div data-show-hover="li" class="pull-right dropdown">
			<?php 
			if($com->id_user == Yii::app()->user->id['id']) {
			?>
			<a class="toggle-button" data-toggle="dropdown-<?php echo $com->id?>" href="#"> 
				<i class="fa fa-pencil"></i> </a>
			<ul role="menu" class="dropdown-menu" id="dropdown-<?php echo $com->id?>">
				<li><a href="#">Edit</a>
				</li>
				<li><a href="#">Delete</a>
				</li>
			</ul>
			<?php }?>
		</div>
		<a class="comment-author" href="#"><?php echo ($user != null) ? $user->firstname : ""?></a> <span><?php echo $com->comment?></span>
		<div class="comment-date">2 days</div>
	</div>
</li>
<?php 	
}
?>
<?php 
endif;
?>