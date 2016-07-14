<li>
    <a href="#" onclick="window.location = '<?php echo Yii::app()->createUrl('/m/interest/group/q/' . $data->id_interest) ?>';" class="item-link item-content">
        <div class="blog-list">
            <div class="text text-interest">
                <h4 class="title mt-5 mb-0"><?php echo $data->interest_name ?></h4>
                <p><?php echo $data->idGroup->interest_name . " , " . $data->idSubgroup->name ?>
                </p>
            </div>
        </div>
    </a>
</li>