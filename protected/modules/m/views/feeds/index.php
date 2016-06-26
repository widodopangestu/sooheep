<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $user = $this->getProfile();
?>

<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="feeds" class="page user-profile">
        <div class="page-content">

            <div class="banner" style=" background: transparent url('<?php echo $this->getBackgroundPicture(true);?>') no-repeat scroll center top / cover ;">
                <div class="ava-box pp">
                	<?php echo $this->getProfilePicture("ava"); ?>
                </div>

                <div class="balance">
                    <div><?php echo $user->firstname." ".$user->lastname?></div>
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
                	<a class="tab-link col-50 text-center active" href="#tab1-2" style="font-size:13px;">
                        All
                    </a>
                    
                    <a class="tab-link col-50 text-center" href="#tab2-2" style="font-size:13px;">
                        Community
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
									'summaryText'=>false,
									'itemsTagName' => 'ul',
									'itemsCssClass'=>'',
									'pagerCssClass'=>'pagination',
									'pager' => array(
					                    'class' => 'ext.infiniteScroll.IasPager', 
					                    'rowSelector'=>'.post', 
					                    'listViewId' => 'prd_listv1', 
					                    'pagerSelector'=>'.pagination',
					                    'header' => '',
					                    'loaderText'=>'Please Wait...',
					                    'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),
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
								'summaryText'=>false,
								'itemsTagName' => 'ul',
								'itemsCssClass'=>'',
								'pagerCssClass'=>'pagination2',
								'pager' => array(
				                    'class' => 'ext.infiniteScroll.IasPager', 
				                    'rowSelector'=>'.post', 
				                    'listViewId' => 'prd_listv2', 
				                    'pagerSelector'=>'.pagination2',
				                    'header' => '',
				                    'loaderText'=>'Please Wait...',
				                    'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),
								),
							));		
					?>
                </div>
            
            	</div>
            </div>	
            
        </div>
    </div>
</div>