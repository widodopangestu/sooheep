<!DOCTYPE html>
<html>
    <head>
        <title>Video</title>     
        <?php
        $baseUrl = Yii::app()->theme->baseUrl . "/";
        ?>

        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/css/video-js.css" id="theme-style">
        <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/video.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/videojs-ie8.min.js"></script>
        <style type="text/css">
            #container { 
                height: 10em;
            }

            #player { 
                margin: 0;
                position: absolute;
                top: 50%;
                left: 50%;
                margin-right: -50%;
                transform: translate(-50%, -50%)
            }
        </style>
    </head>
    <body>
        <div id="container">
            <video id="player" class="video-js vjs-default-skin" controls preload="none"  width="640" height="264" poster="http://vjs.zencdn.net/v/oceans.png" data-setup="{}">
                <source src="<?php echo $videoUrl ?>" type="<?php echo $videoType ?>">
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
            </video>
        </div>
    </body>
</html>