<?php $this->beginContent('//layouts/main'); ?>
<?php include 'left_menu.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	<?php echo $this->pageTitle?>
	</h1>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'tagName' => 'ol',
			'homeLink' => '<li class="active"><a href="'.Yii::app()->request->baseUrl.'"><i class="fa fa-dashboard"></i> Home</a></li>',
			'separator' => '',
			'htmlOptions' => array(
				'class' => 'breadcrumb'
			),
			'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
			'inactiveLinkTemplate' => '<li class="active"><a href="{url}">{label}</a></li>',
			
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	</section>

	<!-- Main content -->
	<section class="content"> <!-- Small boxes (Stat box) --> <?php // include 'top_content.php';?>
	<div class="row">
		<div class="col-xs-12">
			<section class="col-lg-5 connectedSortable">
			<div class="box box-info">
				<div class="box-header">
					<div class="box-body data-result">
					<?php echo $content;?>
					</div>
				</div>
			</div>
			</section>
		</div>
	</div>
	<br>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->endContent(); ?>