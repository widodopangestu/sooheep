<div onclick='loadEvent(" <?php echo $data->date->format('Y-m-d h:i:s'); ?>")'>
    <?php if ($data->isRelevantDate): ?>
        <?php $events = $this->getEvent($data->date); ?>
        <span style="font-size: 60%;"><?php echo count($events); ?></span> <br/>
        <?php foreach ($events as $event): ?>
            <span style="font-size: 60%;"><?php echo $event->title; ?></span> <br/>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php echo $data->date->format('j'); ?>
</div>