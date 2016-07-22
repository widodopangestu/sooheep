<div class="text">
    <small><?php echo $this->getFullDateTime($data->date_create) ?></small>
    <?php echo CHtml::link('<p style="color:#bc5228;"><span class="fa fa-tag"></span> ' . $data->word . "</p>", $data->referation_link, array("onclick" => "window.location.href = '" . $data->referation_link . "';")); ?>
</div>