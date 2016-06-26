    <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <?php 
          	$searchEm = new Employee;
          	if(isset($_GET['Employee'])){
          		$searchEm->attributes=$_GET['Employee'];
          	}
          	
			Yii::app()->clientScript->registerScript('search', "
			$('#search-employee-depan').submit(function(){
				$.fn.yiiListView.update('data-employee-depan', {
					data: $(this).serialize()
				});
				return false;
			});
			
			/*$('.view-employee').click(function(){
				$.ajax({
					url:$(this).attr('href'),
					dataType:'html',
					success:function(data){
						$('.data-result').html(data);
					}
				});
				return false;
			});*/
			");
			$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id' => 'search-employee-depan',
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
				'htmlOptions' => array(
					'class' => 'sidebar-form'
				)
			));
			echo '<div class="input-group">';
			echo $form->textField($searchEm,'nama',array('class'=>'form-control','placeholder'=>"Search..."));
			echo '<span class="input-group-btn">';
			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'label'=>'<i class="fa fa-search"></i>',
				'encodeLabel' => false,
				'htmlOptions'=>array(
					'class' => 'btn btn-flat',
					'id' => 'search-btn'
				)
			)); 
			echo '</span>';
			echo '</div>';
			$this->endWidget();
			?>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php 
          $this->widget('bootstrap.widgets.TbListView',array(
          		'id' => 'data-employee-depan',
				'dataProvider'=>$searchEm->searchDepan(),
				'itemView'=>'/site/_view',
          		'template'=>'{items}',
          		'itemsTagName' => 'ul',
          		'itemsCssClass' => 'sidebar-menu',
          		'emptyTagName' => 'li',
			)); 
		?>
		<!-- 
          <ul class="sidebar-menu">
            <li class="header">SCBD (HO)</li>
           	<li>
              <a href="<?php echo Yii::app()->createUrl('/emarket/client/order');?>">
                <i class="fa fa-circle-o text-red"></i> <span>Indra lesmana</span> <small class="label pull-right">Supervisor</small>
              </a>
            </li>
           	<li class="header">Pondok Indah</li>
            <li><a href="#"><i class="fa fa-circle-o text-green"></i> <span>About</span></a></li>
          </ul>
          --> 
        </section>
        <!-- /.sidebar -->
      </aside>