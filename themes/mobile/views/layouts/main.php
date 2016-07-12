<html>
    <?php
    $baseUrl = Yii::app()->theme->baseUrl . "/";
    $user = $this->getProfile();
    $feed = new Feeds;
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <title>Soheep</title>

        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/css/video-js.css" id="theme-style">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>bower_components/framework7/dist/css/framework7.ios.min.css">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>bower_components/swipebox/src/css/swipebox.css">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>bower_components/jquery/dist/jquery.fileupload.css">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/css/gallery.css" id="theme-style">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/css/jquery.mentionsInput.css" id="theme-style">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/css/app.css">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/css/uploadfile.css">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>assets/themes/town/style.css" id="theme-style">
        <!--<link rel="stylesheet" href="" id="theme-style">-->
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                height: 100%;
            }
            .controls {
                margin-top: 10px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }

            #pac-input {
                background-color: #fff;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 0 11px 0 13px;
                text-overflow: ellipsis;
                width: 300px;
            }

            #pac-input:focus {
                border-color: #4d90fe;
            }

            .pac-container {
                font-family: Roboto;
            }

            #type-selector {
                color: #fff;
                background-color: #4d90fe;
                padding: 5px 11px 0px 11px;
            }

            #type-selector label {
                font-family: Roboto;
                font-size: 13px;
                font-weight: 300;
            }
        </style>
    </head>
    <body>

        <div class="statusbar-overlay"></div>
        <div class="panel-overlay"></div>

        <?php include 'left_menu.php'; ?>

        <?php include 'right_bar.php'; ?>
        <!-- Views -->
        <div class="views">
            <div class="view view-main">
                <div class="navbar navbar-clear">
                    <div class="navbar-inner">
                        <div class="left">
                            <a href="#" class="link icon-only open-panel">
                                <span class="kkicon icon-menu"></span>
                            </a>
                        </div>
                        <div class="left sliding"><img src="<?php echo $baseUrl . "/" ?>assets/img/logo1.png" style="height:27px;width:auto;"></div>
                        <div class="right">
                            <a href="#" class="link icon-only" data-panel="right">
                                <span class="kkicon icon-alarm"></span>
                                <span class="notif notification"></span>
                            </a>
                            <a href="#" class="link icon-only" data-panel="right">
                                <span class="fa fa-weixin"></span>
                                <span class="notif">1</span>
                            </a>
                            <a href="#" class="link icon-only open-panel" data-panel="right">
                                <span class="kkicon icon-users2"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php echo $content; ?>


                <div class="toolbar" style="background-color:#B7461A !important;opacity:0.6;">
                    <div class="toolbar-inner">
                        <?php if ($this->interest != null || $this->community != null) : ?>
                            <a data-popup=".popup-poll" class="link open-popup" href="#">
                                <span class="fa fa-list-alt"></span>
                            </a>
                        <?php endif; ?>
                        <a data-popup=".popup-map"  class="link open-popup" href="#">
                            <span class="fa fa-map-marker"></span>
                        </a> 
                        <a data-popup=".popup-file" class="link open-popup" href="#">
                            <span class="fa fa-file"></span>
                        </a> 
                        <a data-popup=".popup-audio" class="link open-popup" href="#">
                            <span class="fa fa-music"></span>
                        </a> 
                        <a data-popup=".popup-video" class="link open-popup" href="#">
                            <span class="fa fa-video-camera"></span>
                        </a> 
                        <a data-popup=".popup-image" class="link open-popup" href="#">
                            <span class="fa fa-picture-o"></span>
                        </a>

                        <a class="open-picker link" data-picker=".picker-social" href="#">
                            <span class="icon-pencil-line"></span>
                        </a> 
                    </div>
                </div>
            </div>
        </div>

        <div class="popup popup-change-profile">
            <div class="content-block">
                <a href="#" class="close-popup">
                    Close <i class="fa fa-close"></i>
                </a>

                <div class="forms">
                    <h3>Change Profile </h3>

                    <div class="img-post-pp text-center mt-10">
                    </div> 
                    <input type="file" name="images_profile" id="Images_profile">
                </div>	

            </div>
        </div>

        <div class="popup popup-change-background">
            <div class="content-block">
                <a href="#" class="close-popup">
                    Close <i class="fa fa-close"></i>
                </a>

                <div class="forms">
                    <h3>Change Background Cover </h3>

                    <div class="img-post-bg text-center mt-10">
                    </div> 
                    <input type="file" name="images_background" id="Images_background">
                </div>	

            </div>
        </div>

        <div class="popup popup-map">
            <div class="content-block">
                <a href="#" class="close-popup">
                    Close <i class="fa fa-close"></i>
                </a>
                <div class="img-post text-center mt-10">

                </div>

                <div class="forms">
                    <h3>What do you heep?</h3>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'feeds-location',
                        'type' => 'horizontal',
                        'action' => CController::createUrl('/m/feeds/setFeed'),
                        'htmlOptions' => array(
                            //'enctype'=>'multipart/form-data'
                            'class' => 'js-validate'
                        )
                    ));
                    ?>

                    <div class="form-row">
                        <div class="input-text">
                            <?php
                            if ($this->interest != null) {
                                echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                                echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                            }
                            if ($this->community != null) {
                                echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                                echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                            }
                            echo $form->hiddenField($feed, 'jsonMention');
                            echo $form->hiddenField($feed, 'location');
                            echo $form->hiddenField($feed, 'filePath');
                            echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_LOCATION_POST));
                            echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                            ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <input id="pac-input" class="controls" type="text"
                               placeholder="Enter a location">
                        <div id="type-selector" class="controls">
                            <input type="radio" name="type" id="changetype-all" checked="checked">
                            <label for="changetype-all">All</label>

                            <input type="radio" name="type" id="changetype-establishment">
                            <label for="changetype-establishment">Establishments</label>

                            <input type="radio" name="type" id="changetype-address">
                            <label for="changetype-address">Addresses</label>

                            <input type="radio" name="type" id="changetype-geocode">
                            <label for="changetype-geocode">Geocodes</label>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>

    <div class="popup popup-file">
        <div class="content-block">
            <a href="#" class="close-popup">
                Close <i class="fa fa-close"></i>
            </a>
            <div class="img-post text-center mt-10">

            </div>

            <div class="forms">
                <h3>What do you heep?</h3>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'feeds-file',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('/m/feeds/setFeed'),
                    'htmlOptions' => array(
                        //'enctype'=>'multipart/form-data'
                        'class' => 'js-validate'
                    )
                ));
                ?>

                <div class="form-row">
                    <div class="input-text">
                        <?php
                        if ($this->interest != null) {
                            echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                        }
                        if ($this->community != null) {
                            echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                        }
                        echo $form->hiddenField($feed, 'jsonMention');
                        echo $form->hiddenField($feed, 'fileName');
                        echo $form->hiddenField($feed, 'filePath');
                        echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_FILE_POST));
                        echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-text">
                        <div id="fileuploader-file">Upload</div>
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>

    <div class="popup popup-audio">
        <div class="content-block">
            <a href="#" class="close-popup">
                Close <i class="fa fa-close"></i>
            </a>
            <div class="img-post text-center mt-10">

            </div>

            <div class="forms">
                <h3>What do you heep?</h3>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'feeds-audio',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('/m/feeds/setFeed'),
                    'htmlOptions' => array(
                        //'enctype'=>'multipart/form-data'
                        'class' => 'js-validate'
                    )
                ));
                ?>

                <div class="form-row">
                    <div class="input-text">
                        <?php
                        if ($this->interest != null) {
                            echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                        }
                        if ($this->community != null) {
                            echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                        }
                        echo $form->hiddenField($feed, 'jsonMention');
                        echo $form->hiddenField($feed, 'fileName');
                        echo $form->hiddenField($feed, 'filePath');
                        echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_MUSIC_POST));
                        echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-text">
                        <div id="fileuploader-audio">Upload</div>
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>

    <div class="popup popup-video">
        <div class="content-block">
            <a href="#" class="close-popup">
                Close <i class="fa fa-close"></i>
            </a>
            <div class="img-post text-center mt-10">

            </div>

            <div class="forms">
                <h3>What do you heep?</h3>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'feeds-video',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('/m/feeds/setFeed'),
                    'htmlOptions' => array(
                        //'enctype'=>'multipart/form-data'
                        'class' => 'js-validate'
                    )
                ));
                ?>

                <div class="form-row">
                    <div class="input-text">
                        <?php
                        if ($this->interest != null) {
                            echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                        }
                        if ($this->community != null) {
                            echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                        }
                        echo $form->hiddenField($feed, 'jsonMention');
                        echo $form->hiddenField($feed, 'fileName');
                        echo $form->hiddenField($feed, 'filePath');
                        echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_VIDEO_POST));
                        echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-text">
                        <div id="fileuploader-video">Upload</div>
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>

    <div class="popup popup-image">
        <div class="content-block">
            <a href="#" class="close-popup">
                Close <i class="fa fa-close"></i>
            </a>
            <div class="img-post text-center mt-10">

            </div>

            <div class="forms">
                <h3>What do you heep?</h3>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'feeds-image',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('/m/feeds/setFeed'),
                    'htmlOptions' => array(
                        //'enctype'=>'multipart/form-data'
                        'class' => 'js-validate'
                    )
                ));
                ?>
                <div class="form-row">
                    <div class="input-text">
                        <?php
                        if ($this->interest != null) {
                            echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                        }
                        if ($this->community != null) {
                            echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                        }
                        echo $form->hiddenField($feed, 'jsonMention');
                        echo $form->hiddenField($feed, 'fileName');
                        echo $form->hiddenField($feed, 'filePath');
                        echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_IMAGE_POST));
                        echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-text">
                        <div id="fileuploader-image">Upload</div>
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>
    <div class="popup popup-repost">
        <div class="content-block">
            <a href="#" class="close-popup">
                Close <i class="fa fa-close"></i>
            </a>
            <div class="img-post text-center mt-10">

            </div>

            <div class="forms">
                <h3>What do you heep?</h3>
                <?php
                $feed = new Feeds();
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'feeds-repost',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('/m/feeds/setFeed'),
                    'htmlOptions' => array(
                        //'enctype'=>'multipart/form-data'
                        'class' => 'js-validate'
                    )
                ));
                ?>
                <div class="form-row">
                    <div class="input-text">
                        <?php
                        if ($this->interest != null) {
                            echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                        }
                        if ($this->community != null) {
                            echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                        }
                        echo $form->hiddenField($feed, 'jsonMention');
                        echo $form->hiddenField($feed, 'repost_id');
                        echo $form->hiddenField($feed, 'fileName');
                        echo $form->hiddenField($feed, 'filePath');
                        echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_REPOST_POST));
                        echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                        ?>
                    </div>
                </div>
                <div class="feeds-repost-content"style="
                     background: #fff;
                     padding: 10px;
                     border-radius: 5px;
                     "></div>
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>
    <div class="popup popup-poll">
        <div class="content-block">
            <a href="#" class="close-popup">
                Close <i class="fa fa-close"></i>
            </a>
            <div class="img-post text-center mt-10">

            </div>

            <div class="forms">
                <h3>What do you heep?</h3>
                <?php
                $feed = new Feeds();
                $poll = new Poll;
                $choices = array();
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'feeds-poll',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('/m/feeds/setFeed'),
                    'htmlOptions' => array(
                        //'enctype'=>'multipart/form-data'
                        'class' => 'js-validate'
                    )
                ));
                ?>
                <div class="form-row">
                    <div class="input-text">
                        <?php
                        if ($this->interest != null) {
                            echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                        }
                        if ($this->community != null) {
                            echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                            echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                        }
                        echo $form->hiddenField($feed, 'jsonMention');
                        echo $form->hiddenField($feed, 'poll_id');
                        echo $form->hiddenField($feed, 'fileName');
                        echo $form->hiddenField($feed, 'filePath');
                        echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_POLL_POST));
                        echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                        ?>
                    </div>
                </div>
                <div class="feeds-poll-content"style="
                     background: #fff;
                     padding: 10px;
                     border-radius: 5px;
                     ">
                    <table border="0">
                        <tr>
                            <td><?php echo $form->labelEx($poll, 'title'); ?></td>
                            <td><?php echo $form->textField($poll, 'title', array('size' => 60, 'maxlength' => 255)); ?></td>
                            <td><?php echo $form->error($poll, 'title'); ?></td>
                        </tr>
                        <tr>
                            <td valign="top"><?php echo $form->labelEx($poll, 'description'); ?></td>
                            <td><?php echo $form->textArea($poll, 'description', array('rows' => 6, 'cols' => 50)); ?></td>
                            <td><?php echo $form->error($poll, 'description'); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $form->labelEx($poll, 'status'); ?></td>
                            <td><?php echo $form->dropDownList($poll, 'status', $poll->statusLabels()); ?></td>
                            <td><?php echo $form->error($poll, 'status'); ?></td>
                        </tr>
                    </table>
                    <h3>Choices</h3>

                    <table id="poll-choices">
                        <thead>
                        <th>Weight/Sort</th>
                        <th>Label</th>
                        <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            $newChoiceCount = 0;
                            foreach ($choices as $choice) {
                                $this->renderPartial('/pollchoice/_formChoice', array(
                                    'id' => isset($choice->id) ? $choice->id : 'new' . ++$newChoiceCount,
                                    'choice' => $choice,
                                ));
                            }
                            ++$newChoiceCount; // Increase once more for Ajax additions
                            ?>
                            <tr id="add-pollchoice-row">
                                <td class="weight"></td>
                                <td class="label">
                                    <?php echo CHtml::textField('add_choice', '', array('size' => 50, 'id' => 'add_choice')); ?>
                                    <div class="errorMessage" style="display:none">You must enter a label.</div>
                                </td>
                                <td class="actions">
                                    <a href="#" id="add-pollchoice">Add Choice</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                    $callback = Yii::app()->createUrl('/poll/pollchoice/ajaxcreate');
                    $js = <<<JS
var PollChoice = function(o) {
  this.target = o;
  this.label  = jQuery(".label input", o);
  this.weight = jQuery(".weight select", o);
  this.errorMessage = jQuery(".errorMessage", o);

  var pc = this;

  pc.label.blur(function() {
    pc.validate();
  });
}
PollChoice.prototype.validate = function() {
  var valid = true;

  if (this.label.val() == "") {
    valid = false;
    this.errorMessage.fadeIn();
  }
  else {
    this.errorMessage.fadeOut();
  }

  return valid;
}

var newChoiceCount = {$newChoiceCount};
var addPollChoice = new PollChoice(jQuery("#add-pollchoice-row"));

jQuery("tr", "#poll-choices tbody").each(function() {
  new PollChoice(jQuery(this));
});

jQuery("#add-pollchoice").click(function() {
  if (addPollChoice.validate()) {
    jQuery.ajax({
      url: "{$callback}",
      type: "POST",
      dataType: "json",
      data: {
        id: "new"+ newChoiceCount,
        label: addPollChoice.label.val()
      },
      success: function(data) {
        addPollChoice.target.before(data.html);
        addPollChoice.label.val('');
        new PollChoice(jQuery('#'+ data.id));
      }
    });

    newChoiceCount += 1;
  }

  return false;
});
JS;

                    Yii::app()->clientScript->registerScript('pollHelp', $js, CClientScript::POS_END);
                    ?>
<!--                    <style type="text/css">
                  </style>
                  <iframe src="http://localhost/sooheep/poll/poll/create"  frameBorder="0" onload="resizeIframe(this)" style="overflow: scroll; width:100%;"></iframe>-->
                </div>
                <div class="form-row">
                    <div class="input-submit">
                        <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>	
        </div>
    </div>
    <!-- Picker -->
    <div class="picker-modal picker-social">
        <div class="toolbar">
            <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right"><a href="#" class="close-picker">Done</a></div>
            </div>
        </div>
        <div class="picker-modal-inner">
            <div class="content-block mt-15 mb-10">
                <div class="forms">
                    <h3>What do you heep?</h3>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'feeds-text',
                        'type' => 'horizontal',
                        'action' => CController::createUrl('/m/feeds/setFeed'),
                        'htmlOptions' => array(
                            'class' => 'js-validate'
                        )
                    ));
                    ?>

                    <div class="form-row">
                        <div class="input-text">
                            <?php
                            if ($this->interest != null) {
                                echo $form->hiddenField($feed, 'post_interest_id', array('value' => $this->interest->id_interest));
                                echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_GROUP));
                            }
                            if ($this->community != null) {
                                echo $form->hiddenField($feed, 'post_community_id', array('value' => $this->community->id));
                                echo $form->hiddenField($feed, 'post_type', array('value' => Feeds::POST_COMMUNITY));
                            }
                            echo $form->hiddenField($feed, 'jsonMention');
                            echo $form->hiddenField($feed, 'fileName');
                            echo $form->hiddenField($feed, 'filePath');
                            echo $form->hiddenField($feed, 'type', array('value' => Feeds::TYPE_TEXT_POST));
                            echo $form->textArea($feed, 'text_caption', array('class' => "form-control share-text", 'placeholder' => 'Share your heep...'));
                            ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-submit">
                            <button type="submit" class="button button-big js-form-submit button-fill pull-right button-primary">Send</button>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>	
            </div>
        </div>
    </div>

    <?php
    Yii::app()->clientScript->registerCoreScript('jquery', CClientScript::POS_END);
    Yii::app()->clientScript->registerCoreScript('jquery-ui', CClientScript::POS_END);

    Yii::app()->clientScript->registerScript('realtime-notif', '
	window.setInterval(function(){
	  $.ajax({
		url:"' . Yii::app()->createUrl('/m/feeds/checknotif') . '",
		dataType:"json",
		success:function(data){
			$(".notification").html(data.jumlah);
		}
	  });
	}, 5000);
        ', CClientScript::POS_END);

    Yii::app()->clientScript->registerScript('changeprofile', "
				 $('#Images_profile').fileupload({
			        url: '" . Yii::app()->createUrl('/m/member/changeprofile') . "',
			        dataType: 'json',
			        done: function (e, data) {
			        	var img = '<img src=\"'+data.result.thumb+'\" class=\"ava\">';
			        	$('.pp').html(img);
                                        $('.img-post-pp').html(img);
                                        $('.close-popup').trigger('click');
			        	//$('.progress-load').hide();
			        },
			        progressall: function (e, data) {
			            var progress = parseInt(data.loaded / data.total * 100, 10);
			            //$('.progress-load').show();
			        }
			    }).prop('disabled', !$.support.fileInput)
			        .parent().addClass($.support.fileInput ? undefined : 'disabled');
			        
				$('#Images_background').fileupload({
			        url: '" . Yii::app()->createUrl('/m/member/changeBackgroundprofile') . "',
			        dataType: 'json',
			        done: function (e, data) {
			        	var img = '<img src=\"'+data.result.best+'\">'
			        	$('.banner').css('background', 'transparent url(' + data.result.best + ') no-repeat scroll center top / cover');
						$('.img-post-bg').html(img);
						$('.close-popup').trigger('click');
						$('.back-progress-load').hide();
			        },
			        progressall: function (e, data) {
			            var progress = parseInt(data.loaded / data.total * 100, 10);
			            $('.back-progress-load').show();
			            $('.back-progress-load').css(
			                'width',
			                progress + '%'
			            );
			        }
			    }).prop('disabled', !$.support.fileInput)
			        .parent().addClass($.support.fileInput ? undefined : 'disabled');
				", CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('upload-test', "
                    $('#fileuploader-image').uploadFile({
                        url:'" . Yii::app()->createUrl('/m/feeds/upload') . "',
                        multiple:false,
                        dragDrop:true,
                        maxFileCount:1,
                        fileName:'file',
                        acceptFiles:'image/*',
                        showPreview:true,
                        previewHeight: '200px',
                        previewWidth: '200px',
                        onSuccess:function(files,data,xhr,pd){
                            data = JSON.parse(data);
                            $('#feeds-image input[name=\"Feeds[filePath]\"]').val(data.file_path);
                            $('#feeds-image input[name=\"Feeds[fileName]\"]').val(data.file_name);
                        },
                    });
                    $('#fileuploader-video').uploadFile({
                        url:'" . Yii::app()->createUrl('/m/feeds/upload') . "',
                        multiple:false,
                        dragDrop:true,
                        maxFileCount:1,
                        fileName:'file',
                        acceptFiles:'video/*',
                        onSuccess:function(files,data,xhr,pd){
                            data = JSON.parse(data);
                            $('#feeds-video input[name=\"Feeds[filePath]\"]').val(data.file_path);
                            $('#feeds-video input[name=\"Feeds[fileName]\"]').val(data.file_name);
                        },
                    });
                    $('#fileuploader-audio').uploadFile({
                        url:'" . Yii::app()->createUrl('/m/feeds/upload') . "',
                        multiple:false,
                        dragDrop:true,
                        maxFileCount:1,
                        fileName:'file',
                        acceptFiles:'audio/*',
                        onSuccess:function(files,data,xhr,pd){
                            data = JSON.parse(data);
                            $('#feeds-audio input[name=\"Feeds[filePath]\"]').val(data.file_path);
                            $('#feeds-audio input[name=\"Feeds[fileName]\"]').val(data.file_name);
                        },
                    });
                    $('#fileuploader-file').uploadFile({
                        url:'" . Yii::app()->createUrl('/m/feeds/upload') . "',
                        multiple:false,
                        dragDrop:true,
                        maxFileCount:1,
                        fileName:'file',
                        allowedTypes:'pdf,doc,docx,doc,xls,xlsx,ppt,pptx',
                        acceptFiles:'.doc, .docx, .xls, .xlsx, .ppt, pptx, .pdf',
                        onSuccess:function(files,data,xhr,pd){
                            data = JSON.parse(data);
                            $('#feeds-file input[name=\"Feeds[filePath]\"]').val(data.file_path);
                            $('#feeds-file input[name=\"Feeds[fileName]\"]').val(data.file_name);
                        },
                    });
            ", CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('mentions', "
        $(function () {
            $('textarea.share-text').mentionsInput({
                onDataRequest: function (mode, query, callback) {
                    $.getJSON('" . Yii::app()->baseUrl . "/m/feeds/get_mention', function (responseData) {
                        responseData = _.filter(responseData, function (item) {
                            return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1
                        });
                        callback.call(this, responseData);
                    });
                }

            });
            $('#feeds-text').submit(function () {
                $('#feeds-text textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-text input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));

                });
            });
            $('#feeds-file').submit(function () {
                $('#feeds-file textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-file input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));

                });
            });
            $('#feeds-location').submit(function () {
                $('#feeds-location textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-location input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));

                });
            });
            $('#feeds-audio').submit(function () {
                $('#feeds-audio textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-audio input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));

                });
            });
            $('#feeds-video').submit(function () {
                $('#feeds-video textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-video input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));

                });
            });
            $('#feeds-image').submit(function () {
                $('#feeds-image textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-image input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));

                });
            });
            $('#feeds-repost').submit(function () {
                $('#feeds-repost textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-repost input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));
                });
            });
            $('#feeds-poll').submit(function () {
                $('#feeds-poll textarea.share-text').mentionsInput('getMentions', function (data) {
                    $('#feeds-poll input[name=\"Feeds[jsonMention]\"]').val(JSON.stringify(data));
                });
            });
        });        
            ", CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('repost', "
        function loadFeeds(elm) {
            str = elm.prev().html();
            $('.feeds-repost-content').html(str);
            $('#feeds-repost input[name=\"Feeds[repost_id]\"]').val(elm.attr('id'));
        }    
            ", CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('poll', "
    function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body. scrollHeight + 'px';
  }
            ", CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('comment', "
    function deleteComment(id, s) {
            if (s == 'd')
                var r = confirm('Delete this comment?');
            else
                var r = confirm('Block this comment?');
            if (r == true) {
                jQuery.ajax({'type': 'POST', 'url': '" . Yii::app()->createUrl('/m/feeds/ajaxDeleteComment/id') . "/' + id + '/type/' + s, 'cache': false, 'success': function (html) {
                        jQuery('#comment-' + id).remove();
                        jQuery('#comment-count-' + html).html(jQuery('#list-comment-' + html + ' li').size());
                    }});
            }
            return false;
        }

        function addComment(id) {
            jQuery.ajax({'type': 'POST', 'data': $('#comment-form-' + id).serialize(), 'url': '" . Yii::app()->createUrl('/m/feeds/ajaxNewComment/id') . "/' + id, 'cache': false, 'success': function (html) {
                    jQuery('#list-comment-' + id).append(html);
                    jQuery('#comment-count-' + id).html(jQuery('#list-comment-' + id + ' li').size());
                    jQuery('#comment-form-' + id + ' textarea').val('');
                }});
            return false;
        }
            ", CClientScript::POS_END);
    ?>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/jquery/dist/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/jquery/dist/jquery.fileupload.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/framework7/dist/js/framework7.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/swipebox/src/js/jquery.swipebox.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/Tweetie/tweetie.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>bower_components/chartjs/Chart.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/jflickrfeed.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/min/app.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/jquery.form.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/jquery.uploadfile.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/video.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/videojs-ie8.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/jquery.events.input.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/jquery.elastic.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/underscore-min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>assets/js/jquery.mentionsInput.js"></script>
    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2195},
                zoom: 13
            });
            var input = /** @type {!HTMLInputElement} */(
                    document.getElementById('pac-input'));

            var types = document.getElementById('type-selector');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                var radioButton = document.getElementById(id);
                radioButton.addEventListener('click', function () {
                    autocomplete.setTypes(types);
                });
            }

            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvuOVVOP0Yzf7h-8v8P5WzkOu1-COX3Fs&libraries=places&callback=initMap"
    async defer></script>
</body>

<!-- Mirrored from themes.krzysztof-furtak.pl/themes/malpha2/malpha2/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Dec 2015 06:22:35 GMT -->
</html>