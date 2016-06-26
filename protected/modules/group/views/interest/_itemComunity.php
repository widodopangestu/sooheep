<div class="col-sm-6"  style="border-radius: 4px; padding: 10px; border: 1px solid #ccc;">
<div>
<div class="col-sm-9"><?php echo CHtml::link($data->community_name,Yii::app()->createUrl('/group/interest/community',array('id'=>$data->community_hash)))?></div>
<div class="col-sm-"><?php echo $data->tombolJoin?></div>
</div>
</div>