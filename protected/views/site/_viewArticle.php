<div class="box-header ui-sortable-handle" style="cursor: move;">
<i class="fa fa-file"></i>
<h3 class="box-title"><?php echo CHtml::link($data->title,Yii::app()->createUrl('/site/article/id/'.$data->id.'/slug/'.str_replace(" ", "-", $data->title)))?></h3>
<!-- tools box -->
</div>
<div class="box-body">
<?php 
preg_match_all('/<img[^>]+>/i',$data->body, $result); 
if(count($result) > 0){
	$img = array();
	foreach( $result as $key=>$img_tag)
	{	
		if(count($img_tag) > 0){
			foreach ($img_tag as $i){
	    		preg_match_all('/(alt|title|src)=("[^"]*")/i',$i, $img[$key]);
			}
			
		}else{
			preg_match_all('/(alt|title|src)=("[^"]*")/i',$img_tag, $img[$key]);
		}
	}
	$image_thumb = (file_exists(str_replace(array('"',"'"),"",$img[0][2][0]))) ? CHtml::image(str_replace(array('"',"'"),"",$img[0][2][0]),'',array('style'=>'width:100%')) : null;
	//var_dump(file_exists(str_replace(array('"',"'"), "", $img[0][2][0])));
	//if($image_thumb != null){
		echo '<div class="col-sm-2">'.CHtml::image(str_replace(array('"',"'"),"",$img[0][2][0]),'',array('style'=>'width:100%')).'</div>';
		echo '<div class="col-sm-10">'.$data->summary.'</div>';
	//}else{
		//echo '<div class="col-sm-12">'.$data->summary.'</div>';
	//}
	
}else{
	echo '<div class="col-sm-12">'.$data->summary.'</div>';
}

?>
</div>