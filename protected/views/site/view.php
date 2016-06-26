<?php
$this->breadcrumbs=array(
	$model->nama,
);

?>

<div class="box-header ui-sortable-handle" style="cursor: move;">
<i class="fa fa-user"></i>
<h3 class="box-title">View Employee (<?php echo $model->nama; ?>)</h3>
<!-- tools box -->
</div>
<div class="box-body">
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nama',
		'posisi',
		'lokasi',
		'email',
		'voip',
		'extension',
		'phone',
		array(
			'label' => 'Active',
			'value' => ($model->active == 1) ? 'Actived' : 'Inactive'
		)
	),
)); ?>
</div>
