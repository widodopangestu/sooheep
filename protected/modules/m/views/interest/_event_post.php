<div class="text">
    <small><?php echo $data->user->fullName ?> create Event at <?php echo $this->getFullDateTime($data->created_date) ?></small>
    <p><?php echo $data->text_caption ?></p>
    <?php if ($data->event_id !== null): ?>
        <div style="font-size: 13px;background: #f7f7f8;padding: 15px;border-radius: 5px;">
            Title : <?php echo $data->event->title; ?><br/>
            Date : <?php echo $data->event->date; ?><br/>
            Description : <?php echo $data->event->description; ?><br/>
            Place : <?php echo $data->event->place; ?><br/>
            <?php
            if (!$data->event->isAttend)
                echo CHtml::button(
                        'Attend', array(
                    'onclick' => 'attend(' . $data->event->id . ')',
                    'id' => 'btn-attend-' . $data->event->id
                        )
                );
            else {
                echo '<div id="btn-unattend-' . $data->event->id . '"><b>You will attend this event.</b> or ' . CHtml::button(
                        'Cancel Attend', array(
                    'onclick' => 'unattend(' . $data->event->id . ')'
                        )
                ) . '</div>';
            }
            ?>
        </div>
    <?php endif; ?>
</div>