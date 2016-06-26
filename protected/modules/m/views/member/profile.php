<?php 
$user = $user->profiles;
if(Yii::app()->user->hasFlash("pesan-add-sukses")){
	Yii::app()->clientScript->registerScript("pesan",'
		webApp.alert("'.Yii::app()->user->getFlash("pesan-add-sukses").'");		
	');
}
?>
<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="profile" class="page user-profile">
        <div class="page-content">

            <div class="banner" style=" background: transparent url('<?php echo $this->getBackgroundPicture(true,$user->id_user);?>') no-repeat scroll center top / cover ;">
                <div class="ava-box">
                	<?php 
                	echo $user->getProfilePicture("ava","",$user->id_user); ?>
                </div>

                <div class="balance">
                    <div><?php echo $user->firstname." ".$user->lastname?></div>
                    <small>Be My self</small>
                </div>
				<?php 
				if($user->id_user != Yii::app()->user->id['id']){
				?>
                <div class="row row-bottom banner-bottom">
                    <div class="col text-right badges">
                        <small class="mb-5 text-right">
                        	<?php echo $user->buttonaddfriendm?>
                        </small>
                    </div>
                </div>
                <?php 
				}else{
				?>
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
				<?php 	
				}
                ?>
            </div>
            
            <?php 
            if($user->isFriend || $user->id_user == Yii::app()->user->id['id']):?>
             <div class="list-block mt-0 blog-box">
             		<ul id="#feed-<?php echo $user->id_user?>" class="postingan infinite-scroll" data-url="<?php echo Yii::app()->createUrl('/m/member/q/'.$user->idUser->hash."/")?>">
             		<?php foreach($posts as $data): ?>
             		<li class="swipeout post">
						<div class="swipeout-actions-left">
							<a href="#" class="action-red js-add-to-fav">
								<?php echo $user->getProfilePicture(); ?>
							</a>
						</div>
					
						<div class="swipeout-content">
							<div class="item-content no-padding">
								<div class="item-inner blog-list">
									<?php 
									switch ($data->feedsAttributes->type) {
										case Feeds::TYPE_TEXT_POST:
											$this->renderPartial('_text_post',array('data'=>$data,'user'=>$user));
										break;
										case Feeds::TYPE_IMAGE_POST:
											$this->renderPartial('_img_post',array('data'=>$data,'user'=>$user));
										break;
										default:
											$this->renderPartial('_text_post',array('data'=>$data,'user'=>$user));
										break;
									}
									?>
								</div>
							</div>
						</div>
					</li>
             		<?php endforeach; ?>
             		</ul>
             		<?php /* $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
					    'contentSelector' => '#feed-'.$user->id_user,
					    'itemSelector' => 'div.post',
					    'loadingText' => 'Loading...',
					    'donetext' => '',
					    'pages' => $pages,
					)); */ ?>
                      <?php 
						/* $this->widget('bootstrap.widgets.TbListView', array(
					            'dataProvider' => $feed->getAllHomeFeeds(false,$user->id_user),
					            'template' => "{items}{pager}",
					            'itemView' => 'post',
					            'ajaxUpdate' => false,
					            'id' => 'profile-'.$user->id_user,
								'summaryText'=>false,
								'itemsTagName' => 'ul',
								'itemsCssClass'=>'',
								'pagerCssClass'=>'pagination3',
								'pager' => array(
				                    'class' => 'ext.infiniteScroll.IasPager', 
				                    'rowSelector'=>'.post', 
				                    'listViewId' => 'profile-'.$data->id_user, 
				                    'pagerSelector'=>'.pagination3',
				                    'header' => '',
				                    'loaderText'=>'Please Wait...',
				                    'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),
								),
							));	 */	
					?>
					
	            	<div class="infinite-scroll-preloader" style="text-align: center">
					    <div class="preloader"  style="text-align: center"></div>
					</div>
                </div>
                <?php endif;?>
           </div>
     </div>
 </div>
            