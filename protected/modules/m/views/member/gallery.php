<div class="pages">
    <div class="page no-toolbar" data-page="gallery-3">
        <div class="page-content ">
            <div class="color-box sales-count">
                <div class="buttons-row">
                    <a href="#tab1" class="tab-link active button">Pictures</a>
                    <a href="#tab2" class="tab-link button">Videos</a>
                    <a href="#tab3" class="tab-link button">Musics</a>
                    <a href="#tab4" class="tab-link button">Files</a>
                </div>
            </div>
            <div class="tabs-animated-wrap">
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <ul class="gallery-list gallery-3col">
                            <?php
                            if ($feedImages != null):
                                foreach ($feedImages as $data):
                                    ?>
                                    <li>
                                        <a rel="picture" href="<?php echo Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->description ?>" class="zoom" title="<?php echo $data->file_name; ?>"> 
                                            <img src="<?php echo Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . "thumb_" . $data->description ?>" alt="image" />
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>

                    <div id="tab2" class="tab">
                        <ul class="gallery-list gallery-3col">   
                            <?php
                            if ($feedVideos != null):
                                foreach ($feedVideos as $data):
                                    ?>
                                    <li>
                                        <a rel="video" href="<?php echo Yii::app()->request->baseUrl ?>/m/default/player?swipeboxVideo=1&v=<?php echo $data->description ?>" class="zoom" title="<?php echo $data->file_name ?>"> 
                                            <div id="box">
                                                <div id="overlay">
                                                    <span id="plus"><?php echo $data->idFeeds->text_caption ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>

                    <div id="tab3" class="tab">
                        <table class="sortable">
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Heap</th>
                                    <th class="">Play</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($feedMusics != null):
                                    foreach ($feedMusics as $data):
                                        $fileMusic = Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->description;
                                        ?>
                                        <tr class="audio">
                                            <td><a href="<?php echo $fileMusic ?>"><?php echo $data->file_name ?></a></td>
                                            <td><?php echo $data->idFeeds->text_caption ?></td>
                                            <td><audio controls>
                                                    <source src="<?php echo $fileMusic ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab4" class="tab">
                        <table class="sortable">
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Heap</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php
                                if ($feedFiles != null):
                                    foreach ($feedFiles as $data):
                                        $file = Yii::app()->request->baseUrl . Yii::app()->params['timeline'] . $data->description;
                                        ?>
                                        <tr class="file">
                                            <td><a href="<?php echo $file ?>"><?php echo $data->file_name ?></a></td>
                                            <td><?php echo $data->idFeeds->text_caption ?></td>  
                                            <td><a onclick="window.location.href = '<?php echo $file ?>';" href="<?php echo $file ?>" >Download</a></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>