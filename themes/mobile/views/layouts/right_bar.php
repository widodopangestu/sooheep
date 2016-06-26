<?php 
$alluser =  new Profile;
Yii::app()->clientScript->registerScript('find-friend','
	$("#Profile_globalSearch").keyup(function(){
		$.ajax({
			url:"'.CController::createUrl('/m/member/searchfriend/mode/ajax').'",
			data:$("#search-friend").serialize(),
			dataType:"html",
			success:function(data){
				$(".all-friends").html(data);				
			},
		});
	});
	$("#search-friend").submit(function(){
		$.ajax({
			url:"'.CController::createUrl('/m/member/searchfriend/mode/ajax').'",
			data:$(this).serialize(),
			dataType:"html",
			success:function(data){
				$(".all-friends").html(data);				
			},
		});
		return false;
	});
');
?>
<!-- Right panel -->
<div class="panel panel-right panel-reveal">
    <div class="content-block mt-0 mb-0">
		<div class="forms">
			<?php 
			 echo Yii::app()->user->getFlash('berhasil-addfren');
			 $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			        'id' => 'search-friend',
		        	'type' => 'horizontal',
		        	'action' => CController::createUrl('/m/member/searchfriend'),
			    ));
			?>
			<div class="form-row">
				<div class="input-text">
					<?php echo $form->textField($alluser,'globalSearch',array('placeholder'=>'Search name of your friends'))?>
					<span class="search-icon"><i class="fa fa-search"></i></span>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
    
    <div class="list-block mt-15">

        <div class="list-group">
            <nav>
                <ul class="all-friends">
                	<?php 
					$this->widget('bootstrap.widgets.TbListView', array(
						            'dataProvider' => $alluser->getFindall(),
						            'template' => "{items}{pager}",
						            'itemView' => 'application.modules.m.views.member._itemOfFriend',
						            'ajaxUpdate' => false,
						            'id' => 'friend_list',
									'summaryText'=>false,
									//'pagerCssClass'=>'pagination',
									'pager' => array(
					                    'class' => 'ext.infiniteScroll.IasPager', 
					                    'rowSelector'=>'.people-user', 
					                    'listViewId' => 'friend_list', 
					                    'pagerSelector'=>'.pagination',
					                    'header' => '',
					                    'loaderText'=>'Please Wait...',
					                    'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),
					),
					));
					?>
                </ul>
            </nav>
        </div>

      <!--  <div class="list-group mt-20">
            <nav>
                <ul>
                    <li>
                        <a href="#" class="item-link item-primary close-panel item-content">
                            <div class="item-media">
                                <i class="fa fa-info-circle"></i>
                            </div>
                            <div class="item-inner">
                                <div class="item-title">About APP/Website</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>  -->

    </div>

</div>

