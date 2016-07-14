<?php
Yii::app()->clientScript->registerScript('group-feeds', '
		$(".navbar").removeClass("navbar-clear");
	');
$baseUrl = Yii::app()->theme->baseUrl;
$user = $this->getProfile();
?>

<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="feeds-community" class="page user-profile">
        <div class="page-content">

            <div class="banner">
                <div class="ava-box pp">
                </div>
                <div class="balance">
                    <div><?php echo $group->community_name ?></div>
                </div>
                <div class="row row-bottom banner-bottom">
                    <div class="col">
                        <small class="mb-5">
                            <?php
                            $member = InterestCommunityMember::model()->countByAttributes(array('id_interest_community' => $interest));
                            ?>
                        </small>
                    </div>
                    <div class="col text-right badges">
                        <small class="mb-5 text-right">
                            <?php
                            echo "There's " . $member . " People joined";
                            ?>
                        </small>
                    </div>
                </div>
            </div>
            <div class="list-block mt-0 blog-box tab">

                <div class="color-box sales-count">
                    <div class="row no-gutter">
                        <a class="tab-link col-auto text-center" href="#tab1" style="font-size:13px;">
                            Feeds
                        </a>
                        <a class="tab-link col-auto text-center" href="#tab2" style="font-size:13px;">
                            Image Gallery
                        </a>
                        <a class="tab-link col-auto text-center" href="#tab3" style="font-size:13px;">
                            Video Gallery
                        </a>
                        <a class="tab-link col-auto text-center" href="#tab4" style="font-size:13px;">
                            File Gallery
                        </a>
                        <a class="tab-link col-auto text-center" href="#tab5" style="font-size:13px;">
                            Music Gallery
                        </a>
                        <a class="tab-link col-auto text-center" href="#tab6" style="font-size:13px;">
                            Polling
                        </a>
                        <a class="tab-link col-auto text-center" href="#tab7" style="font-size:13px;">
                            Event Calendar
                        </a>
                    </div>
                </div>

                <div class="tabs-animated-wrap" style="height:auto;">
                    <div class="tabs" style="height:auto;">

                        <div class="list-block mt-0 blog-box tab" id="tab1">
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $feed->getAllCommunityFeeds($interest),
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

                        <div class="list-block mt-0 blog-box tab" id="tab2">
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $feed->getAllCommunityFeeds($interest, Feeds::TYPE_IMAGE_POST),
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
                        <div class="list-block mt-0 blog-box tab" id="tab3">
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $feed->getAllCommunityFeeds($interest, Feeds::TYPE_VIDEO_POST),
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
                        <div class="list-block mt-0 blog-box tab" id="tab4">
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $feed->getAllCommunityFeeds($interest, Feeds::TYPE_FILE_POST),
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
                        <div class="list-block mt-0 blog-box tab" id="tab5">
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $feed->getAllCommunityFeeds($interest, Feeds::TYPE_MUSIC_POST),
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
                        <div class="list-block mt-0 blog-box tab" id="tab6">
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $feed->getAllCommunityFeeds($interest, Feeds::TYPE_POLL_POST),
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
                        <div class="list-block mt-0 blog-box tab" id="tab7">
                            <?php
                            $this->widget('ecalendarview.ECalendarView', array(
                                    'itemView' => '_view_cal',
                            ));
                            ?>
                            <div id="list-event">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

