<?php
$baseUrl = Yii::app()->theme->baseUrl;
$user = $this->getProfile();
?>

<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="feeds" class="page user-profile">
        <div class="page-content">

            <div class="banner" style=" background: transparent url('<?php echo $this->getBackgroundPicture(true); ?>') no-repeat scroll center top / cover ;">
                <div class="ava-box pp">
                    <?php echo $this->getProfilePicture("ava"); ?>
                </div>

                <div class="balance">
                    <div><?php echo $user->firstname . " " . $user->lastname ?></div>
                    <small>Be My self</small>
                </div>

                <div class="row row-bottom banner-bottom">
                    <div class="col">
                        <small class="mb-5">
                            <a href="#" data-popup=".popup-change-profile" class="link open-popup" style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;">
                                Change Profile Picture
                            </a>
                        </small>
                    </div>
                    <div class="col text-right badges">
                        <small class="mb-5 text-right">
                            <a href="#" data-popup=".popup-change-background" class="link open-popup"  style="padding: 5px; background-color: rgb(255, 255, 255); border-radius: 5px;">
                                Change Cover Picture
                            </a>
                        </small>
                    </div>
                </div>
            </div>

            <div class="color-box sales-count">
                <div class="row no-gutter">
                    <a class="tab-link col-33 text-center active" href="#tab1-2" style="font-size:13px;">
                        All
                    </a>

                    <a class="tab-link col-33 text-center" href="#tab2-2" style="font-size:13px;">
                        Community
                    </a>

                    <a class="tab-link col-33 text-center" href="#tab3-2" style="font-size:13px;">
                        Group
                    </a>
                </div>
            </div>

            <div class="tabs-animated-wrap" style="height:auto;">
                <div class="tabs" style="height:auto;">

                    <div class="list-block mt-0 blog-box tab" id="tab1-2">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $feed->getAllHomeFeeds(),
                            'template' => "{items}{pager}",
                            'itemView' => 'post',
                            'ajaxUpdate' => false,
                            'id' => 'prd_listv1',
                            'summaryText' => false,
                            'itemsTagName' => 'ul',
                            'itemsCssClass' => '',
                            'pagerCssClass' => 'pagination',
                            'pager' => array(
                                'class' => 'ext.infiniteScroll.IasPager',
                                'rowSelector' => '.post',
                                'listViewId' => 'prd_listv1',
                                'pagerSelector' => '.pagination',
                                'header' => '',
                                'loaderText' => 'Please Wait...',
                                'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger' => 'Load more'),
                            ),
                        ));
                        ?>
                    </div>

                    <div class="list-block mt-0 blog-box tab" id="tab2-2">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $feed->allCommunityfeedsHome,
                            'template' => "{items}{pager}",
                            'itemView' => 'post',
                            'ajaxUpdate' => false,
                            'id' => 'prd_listv2',
                            'summaryText' => false,
                            'itemsTagName' => 'ul',
                            'itemsCssClass' => '',
                            'pagerCssClass' => 'pagination2',
                            'pager' => array(
                                'class' => 'ext.infiniteScroll.IasPager',
                                'rowSelector' => '.post',
                                'listViewId' => 'prd_listv2',
                                'pagerSelector' => '.pagination2',
                                'header' => '',
                                'loaderText' => 'Please Wait...',
                                'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger' => 'Load more'),
                            ),
                        ));
                        ?>
                    </div>
                    <div class="list-block mt-0 blog-box tab" id="tab3-2">
                        <script type="text/javascript">
                            function hidegrup(id) {
                                $("#Interest_id_subgroup").val(id);
                                $.fn.yiiListView.update("interest-list", {
                                    data: $("#search-interest").serialize()
                                });
                                $('#grup').hide();
                                $('#subgrup').show();
                            }
                            function hidesubgrup() {
                                $('#grup').show();
                                $('#subgrup').hide();
                            }
                        </script>
                        <div id="grup">
                            <?php
                            Yii::app()->clientScript->registerScript('find-interest', '
		$(".navbar").removeClass("navbar-clear");
		$("#InterestSubgroup_name").keyup(function(){
			var words = $(this).val();
			$.fn.yiiListView.update("sub-group", {
		        data: $("#search-group-intersts").serialize()
		    });
		});
		$("#search-group-intersts").submit(function(){
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
                                                    'id' => 'search-group-intersts',
                                                    'type' => 'horizontal',
                                                ));
                                                ?>	
                                                <div class="form-row">
                                                    <div class="input-text">
                                                        <?php
                                                        echo $form->textField($interests, 'name', array('placeholder' => 'What Your Interest?'));
                                                        ?>
                                                        <!--<span class="search-icon"><i class="fa fa-search"></i></span>-->
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
                                                'dataProvider' => $interests->searchMobile(),
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

                        </div>
                        <div id="subgrup" style="display: none;">
                            <?php
                            Yii::app()->clientScript->registerScript('find-list-interest', '
		$(".navbar").removeClass("navbar-clear");
		$("#Interest_interest_name").keyup(function(){
			var words = $(this).val();
			$.fn.yiiListView.update("interest-list", {
		        data: $("#search-interest").serialize()
		    });
		});
		
		$("#search-interest").submit(function(){
			return false;
		});
		
	');
                            ?>
                            <div class="pages navbar-fixed toolbar-fixed">
                                <div data-page="sub-group-interest" class="page group-interest">
                                    <div class="page-content">
                                        <div class="content-block mt-0 mb-0">
                                            <div class="left">
                                                <a class="link button" onclick="hidesubgrup()" href="#">
                                                    <span class="icon-chevron-left"></span> <span>Back</span>
                                                </a>
                                            </div><br><br>
                                            <div class="forms">
                                                <?php
                                                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                                    'id' => 'search-interest',
                                                    'type' => 'horizontal',
                                                ));
                                                ?>	
                                                <div class="form-row">
                                                    <div class="input-text">
                                                        <?php
                                                        echo $form->textField($subinterest, 'interest_name', array('placeholder' => 'What Your Interest?'));
                                                        echo $form->hiddenField($subinterest, 'id_subgroup');
                                                        ?>
                                                        <!--<span class="search-icon"><i class="fa fa-search"></i></span>-->
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
                                                'dataProvider' => $subinterest->searchMobile(),
                                                'template' => "{items}{pager}",
                                                'itemView' => 'list_of_interest',
                                                'id' => 'interest-list',
                                                'summaryText' => false,
                                                'itemsTagName' => 'ul',
                                                'emptyTagName' => 'li',
                                                'emptyText' => '<div class="blog-list"><div class="text text-interest"> Keyword not Found </div></div>',
                                                'beforeAjaxUpdate' => 'function(id) { $("#loading-list-view").show(); }',
                                                'afterAjaxUpdate' => 'function(id) { $("#loading-list-view").hide(); }'
                                                    //'loadingCssClass' => 'preloader'
                                            ));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>