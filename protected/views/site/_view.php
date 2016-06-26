<?php 
$active = ($data->active == 0) ? "text-red" : "text-green";
$url = (isset($_GET['Employee'])) ? Yii::app()->createUrl('/site/view/id/'.$data->id."?Employee[nama]=".$_GET['Employee']['nama']) : Yii::app()->createUrl('/site/view/id/'.$data->id);
?>
<li>
<a class="view-employee" href="<?php echo $url;?>">
<i class="fa fa-circle-o <?php echo $active?>"></i> 
<span><?php echo $data->nama?></span>
<small class="label pull-right"><?php echo $data->posisi?></small><br> 
<small class="label pull-right" style="font-size:9px !important;margin:9px;"><?php echo $data->lokasi?></small> 
</a>
</li>