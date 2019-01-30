<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&antiSpam=0&atom'); ?>

<?php function threadedComments($comments, $options)
{

    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    ?>

    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
    ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment-author">
                <a target="_blank" class="ds-avatar comment-avatar-w" href="<?php $comments->url(); ?>">
                    <?php $comments->gravatar(100, ''); ?>
                </a>
                <div class="author-time-w">
                    <span class="fn inner-a-color-inherit a-none anim-line-inner-a mdl-color-text--black">
                        <?php $comments->author(); ?>
                        <?php try {
                            if (class_exists('CommentApprove_Plugin')) CommentApprove_Plugin::identify($comments->mail);
                        } catch (Exception $e) {
                        } ?>
                    </span>
                    <span class="comment-time" style="color: #616161">
                        <a class="no-pjax" href="<?php $comments->permalink(); ?>"><?php $comments->dateWord(); ?></a>
                    </span>
                </div>

            </div>

            <div class="comment-content ">
                <?php getCommentReply($comments->parent) ?>
                <?php $comments->content(); ?>

                <?php if ('waiting' == $comments->status) { ?>
                    <span id="comment-waiting-<?php $comments->theId(); ?>" class=""
                          style="background-color: #66bb6a	;color: white; padding: 4px 8px;border-radius: 12px;
                          cursor: pointer;outline: none;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;">
                    <?php $options->commentStatus(); ?>
                    </span>
                    <div class="mdl-tooltip" data-mdl-for="comment-waiting-<?php $comments->theId(); ?>">
                        只有通过审核之后，<br>别人才能看见！
                    </div>
                <?php } ?>
            </div>

            <span class="comment-reply  a-none inner-a-color-inherit mdl-color-text--grey-600">
                    <?php $comments->reply(); ?>
                </span>
        </div>

    </li>
    <?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
<?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
        <h4 class="margin-top: 32px;">
            <?php $this->commentsNum(_t('无评论'), _t('一条评论'), _t('%d 条评论')); ?>
        </h4>

        <?php $comments->listComments(); ?>


        <?php $comments->pageNav('<i class="material-icons">navigate_before</i>',
            '<i class="material-icons">navigate_next</i>'); ?>

    <?php endif; ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond" style="width: 100%">
            <div class="comment-form-title-w">
                <h4 id="response"><?php _e('新评论'); ?></h4>
                <div class="cancel-comment-reply a-none inner-a-color-inherit mdl-color-text--grey-600">
                    <?php $comments->cancelReply(); ?>
                </div>
            </div>

            <form class="comment-input-form" method="post" action="<?php $this->commentUrl() ?>" id="comment-form"
                  role="form">
                <div class="avator-bg"></div>
                <?php if ($this->user->hasLogin()): ?>
                    <p style="font-size: 15px">
                        <?php _e('登录身份: '); ?>
                        <a class="anim-line no-pjax mdl-color-text--primary"
                           href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>.
                        <a class="anim-line no-pjax mdl-color-text--primary" href="<?php $this->options->logoutUrl(); ?>"
                           title="Logout"> <?php _e('退出'); ?> </a>
                    </p>
                <?php else: ?>
                    <div class="input-group input-group-3">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="author"
                                   id="author" value="<?php $this->remember('author'); ?>">
                            <label class="mdl-textfield__label" for="author"><?php _e('名字*'); ?></label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="email" name="mail"
                                   id="mail" value="<?php $this->remember('mail'); ?>">
                            <label class="mdl-textfield__label" for="mail"><?php _e('Email*'); ?></label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="url" name="url"
                                   id="url" value="<?php $this->remember('url'); ?>">
                            <label class="mdl-textfield__label" for="url"><?php _e('网站'); ?></label>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="input-group">
                    <!--                     <div class="mdl-textfield mdl-js-textfield mdl-textfield&#45;&#45;floating-label"-->
                    <!--                          style="width: 100%;margin-right: 8px">-->
                    <!--                         <input class="mdl-textfield__input" type="text" name="text"-->
                    <!--                                id="comment-user-text" value="-->
                    <?php //$this->remember('text'); ?><!--">-->
                    <!--                         <label class="mdl-textfield__label" for="comment-user-text">-->
                    <?php //_e('内容'); ?><!--</label>-->
                    <!--                     </div>-->

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                         style="width: 100%;margin-right: 8px">
                                <textarea class="mdl-textfield__input" type="text" name="text" style="resize: none;"
                                          rows="3" id="comment-user-text"><?php $this->remember('text'); ?></textarea>
                        <label class="mdl-textfield__label" for="comment-user-text"><?php _e('内容*'); ?></label>
                    </div>

                    <button type="submit" class="submit mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp
                             mdl-button--mini-fab mdl-js-ripple-effect mdl-button--primary">
                        <i class="material-icons">check</i>
                    </button>
                </div>
                <div style="padding-right: 48px;">
                    <?php $comments->smilies(); ?>
                </div>

            </form><!--comment-input-form-->
        </div>
    <?php else: ?>
        <h4><?php _e('评论已关闭'); ?></h4>
    <?php endif; ?>
</div>
