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
		
		$(".interest-switch").change(function(){
			if($(this).is(":checked")){
				var idInterest = $(this).attr("id");
				var idAwal = idInterest;
				idInterest = parseInt(idInterest.replace("chek-interest-", ""));
				$.ajax({
					url:"' . CController::createUrl('/m/interest/join/q/join') . '",
					type:"post",
					data:{
						id : idInterest
					},
					dataType:"json",
					success:function(data){
						if(data.sukses == "yes"){
							$("#"+idAwal).prop("checked", true);
							myApp.alert("That\'s added", "");
						}else{
							$("#"+idAwal).prop("checked", false);
							 myApp.alert(data.errmsg, "");
						}				
					},
					error:function(){
						$("#"+idAwal).prop("checked", false);
					}
				});
			}else{
				var idInterest = $(this).attr("id");
				var idAwal = idInterest; 
				idInterest = parseInt(idInterest.replace("chek-interest-", ""));
				myApp.confirm("Are you sure to remove this one?", function(){
					 $.ajax({
						url:"' . CController::createUrl('/m/interest/join/q/removed') . '",
						type:"post",
						data:{
							id : idInterest
						},
						dataType:"json",
						success:function(data){
							if(data.sukses == "yes"){
								$("#"+idAwal).prop("checked", false);
								myApp.alert("That\'s removed", "");
							}else{
								$("#"+idAwal).prop("checked", true);
								myApp.alert(data.errmsg, "");
							}				
						},
						error:function(){
							$("#"+idAwal).prop("checked", true);
						}
					});
					
				},function(){
					$("#"+idAwal).prop("checked", true);
					myApp.alert("Cancel removed", "");
				});
					
			}	
		});
	');
?>
<div class="pages navbar-fixed toolbar-fixed">
    <div data-page="sub-group-interest" class="page group-interest">
        <div class="page-content">
            <div class="content-block mt-0 mb-0">
                <div class="left">
                    <a class="link button" onclick="window.location.href = '<?php echo Yii::app()->createUrl('/m/interest/addInterest') ?>';" href="#">
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
                            echo $form->textField($community, 'community_name', array('placeholder' => 'What Your Interest?'));
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
                    'dataProvider' => $community->search(),
                    'template' => "{items}{pager}",
                    'itemView' => 'list_of_community',
                    'id' => 'interest-list',
                    'summaryText' => false,
                    'itemsTagName' => 'ul',
                    'emptyTagName' => 'li',
                    'emptyText' => '<div class="blog-list"><div class="text text-interest"> Keyword not Found </div></div>',
                    'beforeAjaxUpdate' => 'function(id) { $("#loading-list-view").show() }',
                    'afterAjaxUpdate' => 'function(id) { 
        					$("#loading-list-view").hide(); 
                                                    $(".interest-switch").change(function(){
                                                    if($(this).is(":checked")){
                                                        var idInterest = $(this).attr("id");
                                                        var idAwal = idInterest;
                                                        idInterest = parseInt(idInterest.replace("chek-interest-", ""));
                                                        $.ajax({
                                                            url:"' . CController::createUrl('/m/interest/join/q/join') . '",
                                                            type:"post",
                                                            data:{
                                                                id : idInterest
                                                            },
                                                            dataType:"json",
                                                            success:function(data){
                                                                if(data.sukses == "yes"){
                                                                        $("#"+idAwal).prop("checked", true);
                                                                        myApp.alert("That\'s added", "");
                                                                }else{
                                                                        $("#"+idAwal).prop("checked", false);
                                                                         myApp.alert(data.errmsg, "");
                                                                }				
                                                            },
                                                            error:function(){
                                                                $("#"+idAwal).prop("checked", false);
                                                            }
                                                        });
                                                    }else{
                                                        var idInterest = $(this).attr("id");
                                                        var idAwal = idInterest; 
                                                        idInterest = parseInt(idInterest.replace("chek-interest-", ""));
                                                        myApp.confirm("Are you sure to remove this one?", function(){
                                                        $.ajax({
                                                           url:"' . CController::createUrl('/m/interest/join/q/removed') . '",
                                                           type:"post",
                                                           data:{
                                                                   id : idInterest
                                                           },
                                                           dataType:"json",
                                                           success:function(data){
                                                               if(data.sukses == "yes"){
                                                                   $("#"+idAwal).prop("checked", false);
                                                                   myApp.alert("That\'s removed", "");
                                                               }else{
                                                                   $("#"+idAwal).prop("checked", true);
                                                                   myApp.alert(data.errmsg, "");
                                                               }				
                                                           },
                                                           error:function(){
                                                                   $("#"+idAwal).prop("checked", true);
                                                           }
                                                        });

                                                        },function(){
                                                            $("#"+idAwal).prop("checked", true);
                                                            myApp.alert("Cancel removed", "");
                                                        });

                                                    }	
						});
						}'
                        //'loadingCssClass' => 'preloader'
                ));
                ?>
            </div>
        </div>
    </div>
</div>        
