<?php
/* Yii::app()->clientScript->registerScript('group-feeds','
  $(".navbar").removeClass("navbar-clear");
  '); */
$baseUrl = Yii::app()->theme->baseUrl;
$user = $this->getProfile();
?>

<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="feeds-group" class="page user-profile">
        <div class="page-content">

            <div class="banner">
                <div class="ava-box pp">
                </div>
                <div class="balance">
                    <div><?php echo $group->interest_name ?></div>
                </div>
                <div class="row row-bottom banner-bottom">
                    <div class="col">
                        <small class="mb-5">
                            <?php
                            $member = UserInterest::model()->countByAttributes(array('id_interest' => $interest));
                            $comminityCount = InterestCommunity::model()->countByAttributes(array('id_interest_group' => $interest));

                            echo $member . " people joined";
                            ?>
                        </small>
                    </div>
                    <div class="col text-right badges">
                        <small class="mb-5 text-right">
                            <?php
                            echo "There " . $comminityCount . " Communities created";
                            ?>
                        </small>
                    </div>
                </div>
            </div>
            <div class="color-box sales-count"></div>
            <div class="list-block mt-0 blog-box">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $feed->getAllGroupFeeds($interest),
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

        </div>
    </div>

</div>

