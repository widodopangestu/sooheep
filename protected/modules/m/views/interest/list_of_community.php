<li>
    <div class="blog-list">
        <div class="text text-interest">
            <div style="width:100%;">
                <label class="label-switch pull-right">
                    <input type="checkbox" class="interest-switch" <?php echo ($data->isInterested) ? 'checked="checked"' : "" ?> id="chek-interest-<?php echo $data->id ?>">
                    <div class="checkbox"></div>
                </label>
            </div>
            <h4 class="title mt-5 mb-0"><?php echo $data->community_name ?></h4>
            <p><?php echo $data->community_name; ?>
            </p>
        </div>
    </div>
</li>