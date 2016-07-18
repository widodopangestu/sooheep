<?php foreach ($comments as $comment): ?>   
    <tr id="comment-t-<?php echo $comment->id; ?>">
        <td style="
    width: 180px;
">
            <a href="#" style="background: none;">
                <?php echo $this->getProfilePicture('', '', $comment->id_user) ?>
            </a>
        </td>
        <td>
            <div class="" style="padding: 10px;">
                <p><b><?php echo $comment->idUser->fullName; ?></b> <?php echo $comment->comment; ?></p>
                <div style="
                     display: block;
                     min-height: 20px;
                     ">
                         <?php
                         if ($comment->id_user == Yii::app()->user->id['id'])
                             echo CHtml::button("Delete", array('onclick' => 'deleteComment(' . $comment->id . ', "d")', 'style' => 'margin: 10px 0;'));
                         else if ($comment->idFeeds->id_user == Yii::app()->user->id['id'])
                             echo CHtml::button("Block", array('onclick' => 'deleteComment(' . $comment->id . ', "b")', 'style' => 'margin: 10px 0;'));
                         ?>
                    <small style="float: right;font-size: 11px;color: #aaa;"><?php echo date("d/m/Y h:i:s", strtotime($comment->comment_date)); ?></small>
                </div>
            </div>
        </td>
    </tr>
<?php endforeach; ?>