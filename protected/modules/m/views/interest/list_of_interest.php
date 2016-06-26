<li>
	<div class="blog-list">
		<div class="text text-interest">
			<div style="width:100%;">
			<label class="label-switch pull-right">
				<input type="checkbox" class="interest-switch" <?php echo ($data->isInterested) ? 'checked="checked"' : ""  ?> id="chek-interest-<?php echo $data->id_interest?>">
				<div class="checkbox"></div>
			</label>
			</div>
			<h4 class="title mt-5 mb-0"><?php echo $data->interest_name?></h4>
			<p><?php echo $data->idGroup->interest_name ." , ".$data->idSubgroup->name?>
			</p>
		</div>
	</div>
</li>