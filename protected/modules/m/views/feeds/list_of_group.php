<li>
    <a href="#" onclick="hidegrup(<?php echo $data->id ?>);" class="item-link item-content">
        <div class="item-inner blog-list">
            <div class="text text-interest">
                <h4 class="title mt-5 mb-0"><?php echo $data->name ?></h4>
                <p><?php echo $data->group->interest_name ?></p>
            </div>
        </div>
    </a>
</li>