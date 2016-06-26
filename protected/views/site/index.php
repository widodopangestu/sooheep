<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name." - Pengumuman";
?>
<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$article,
	'itemView'=>'_viewArticle',
)); ?>
