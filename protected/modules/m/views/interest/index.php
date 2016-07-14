<?php
Yii::app()->clientScript->registerScript('find-interest', '
		$(".navbar").removeClass("navbar-clear");
		$("#InterestCommunity_community_name").keyup(function(){
			var words = $(this).val();
			$.fn.yiiListView.update("sub-group", {
		        data: $("#search-group-interst").serialize()
		    });
		});
		$("#search-group-interst").submit(function(){
			return false;
		});
	');
?>
<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="sub-group-interest" class="page group-interest">
        <div class="page-content">
            <div class="content-block mt-0 mb-0">
                <div class="forms">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'search-group-interst',
                        'type' => 'horizontal',
                    ));
                    ?>	
                    <div class="form-row">
                        <div class="input-text">
                            <?php
                            echo $form->textField($interest, 'name', array('placeholder' => 'What Your Interest?'));
                            ?>
                            <span class="search-icon"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
            <div class="list-block mt-0 blog-box">
                <div style="text-align:center; margin-bottom:10px; display:none;" id="loading-list-view" class="">
                    <div style="text-align: center" class="preloader"></div>
                </div>
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $interest->searchMobile(),
                    'template' => "{items}{pager}",
                    'itemView' => 'list_of_group',
                    'id' => 'sub-group',
                    'summaryText' => false,
                    'itemsTagName' => 'ul',
                    'emptyTagName' => 'li',
                    'emptyText' => '<div class="item-inner blog-list"><div class="text text-interest"> Keyword not Found </div></div>',
                    'beforeAjaxUpdate' => 'function(id) { $("#loading-list-view").show() }',
                    'afterAjaxUpdate' => 'function(id) { $("#loading-list-view").hide() }'
                ));
                ?>
            </div>
        </div>
    </div>
</div>        
