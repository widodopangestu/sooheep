<?php 
$this->widget('bootstrap.widgets.TbListView', array(
	            'dataProvider' => $alluser->getFindall(),
	            'template' => "{items}{pager}",
	            'itemView' => '_itemOfFriend',
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