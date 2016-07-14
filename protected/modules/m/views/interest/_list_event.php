<h3>All Event on "<?php echo $date; ?>"</h3>
<a data-popup=".popup-event" class="link open-popup" href="#">
    <span class="fa fa-calendar"> Create Event</span>
</a>
<?php if ($events): ?>
    <?php foreach ($events as $event): ?>
        <h4><?php echo $event->title; ?></h4>
        <span style="font-size: 60%;"><?php echo $event->date; ?></span>
        <p><?php echo $event->description; ?></p> on <b><?php echo $event->place; ?></b> <br/>
        <?php
        if (!$event->isAttend)
            echo CHtml::button(
                    'Attend', array(
                'onclick' => 'attend(' . $event->id . ')',
                'id' => 'btn-attend-' . $event->id
                    )
            );
        else {
            echo '<div id="btn-unattend-' . $event->id . '"><b>You will attend this event.</b> or ' . CHtml::button(
                    'Cancel Attend', array(
                'onclick' => 'unattend(' . $event->id . ')'
                    )
            ) . '</div>';
        }
        ?>
        <hr/>
    <?php endforeach; ?>
<?php else: ?>
    <h3>No Event</h3>    
<?php endif; ?>
