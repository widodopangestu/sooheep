<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="box-header ui-sortable-handle" style="cursor: move;">
<i class="fa fa-sign-in"></i>
<h3 class="box-title">Sign In</h3>
<!-- tools box -->
</div>
<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

		<div class="form-group">
		<?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>'username')); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="form-group">
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>'password')); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="form-group">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
		</div>
		<div class="box-footer clearfix">
			<?php echo CHtml::submitButton('Login',array(
				'class' => 'pull-right btn btn-default'
			)); ?>
		</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
