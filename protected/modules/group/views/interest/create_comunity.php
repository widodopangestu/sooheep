<?php 
	  $baseUrl = Yii::app()->theme->baseUrl;
?>
<div class="col-md-12">
	<div class="col-md-4 col-sm-4 col-xs-12 col-left">
		<div class="row">
			<div class="col-md-12">
				<?php 
				$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'create-comunity',
						'type' => 'horizontal',
				));
				?>
				<div class="panel panel-default panel-user-detail">
					<div class="panel-heading">
		              <h3 class="panel-title">Create Comunity Of <?php echo $this->interest->interest_name?></h3>
		            </div>
					<div class="panel-body">
					<div class="input-group">
						<?php echo $form->textField($comunity,"community_name",array('class'=>'form-control','placeholder' => 'Name Of Community'));?>
					<span class="input-group-addon"> 
					</span>
					</div>
					<div class="input-group">
						<?php echo $form->checkBox($comunity,'isPrivate')?>&nbsp;Do you want to set your comunity is <b>private</b>?
					</div>
					</div>
					<div class="panel-body">
		              <h3 class="panel-title">People to Invite</h3>
					<ul class="list-group">
	                  <!-- friend -->
	                  <li id="btn-friend-community" class="list-group-item">
	                  	<div class="input-group">
							<input type="text" placeholder="Type Your Friend Name" id="search-fren-comunity" class="form-control"> 
							<span class="input-group-addon"> 
							<i class="fa fa-search"></i>
							</span>
						</div>
	                  </li>
	                  
	                  <?php $fren = $this->getFriendsGroup(100);
						if($fren != null){
							
							foreach ($fren as $f){
								$idF = $f->id_user;
								$profile = $this->getProfile($idF);
								$img = $this->getProfilePicture("img-responsive tip","",$idF);
								?>
								<li id="btn-friend-community-<?php echo $idF?>" class="list-group-item fren-list">
										<div class="col-sm-1 no-padding">
											<div class="input-group">
												<input type="checkbox" name="fren_invite[]" value="<?php echo $idF?>"> 
											</div>
										</div>
										<div class="col-sm-2">
											<span class="name"><?php echo $img?></span>
										</div>
										<div class="col-sm-9 no-padding">
											<span class="name"><?php echo $profile->firstname." ".$profile->lastname?></span>
									     </div>
										<div class="clearfix"></div>
								</li>
								<?php 					
							}
						}
						?>
					</ul>	
					</div>
					<div class="panel-footer text-center">
						<?php echo CHtml::linkButton('<i class="fa fa-plus"></i>Create',array('onclick'=>'document.getElementById("create-comunity").submit()'))?>
					</div>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>	
	
	
	<div class="col-md-8 col-sm-4 col-xs-12 col-left">
		<div class="row">
			<div class="panel panel-default panel-friends">
            <div class="panel-heading">
              <h3 class="panel-title">Communities that you know</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-12">
					<?php 
					$this->widget('bootstrap.widgets.TbListView', array(
				            'dataProvider' => $allComunity->searchGroup($this->interest->id_interest),
				            'template' => "{items}{pager}",
				            'itemView' => '_itemComunity',
				            'ajaxUpdate' => false,
				            'id' => 'prd_listv',
							'summaryText'=>false,
							//'pagerCssClass'=>'pagination',
							'pager' => array(
			                    'class' => 'ext.infiniteScroll.IasPager', 
			                    'rowSelector'=>'.post', 
			                    'listViewId' => 'prd_listv', 
			                    'pagerSelector'=>'.pagination',
			                    'header' => '',
			                    'loaderText'=>'Please Wait...',
			                    'options' => array('history' => false, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),
							),
						));		
				?>
                </div>
              </div>
            </div>
            <!-- <div class="panel-footer">
              <button class="btn btn-block" type="button">
                <i class="fa fa-refresh"></i>
                Load more..
              </button>
            </div> -->
          </div>
          </div>
	</div>	
</div>