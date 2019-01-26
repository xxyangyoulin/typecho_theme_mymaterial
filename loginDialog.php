<?php Typecho_Widget::widget('Widget_Options')->to($options);
Typecho_Widget::widget('Widget_User')->to($user);
$request = $options->request;

?>

<?php $rememberName = htmlspecialchars(Typecho_Cookie::get('__typecho_remember_name'));
Typecho_Cookie::delete('__typecho_remember_name');
?>


<dialog class="mdl-dialog" style="width: 100%;max-width: 360px;">
    <h4 class="mdl-dialog__title">用户</h4>
    <div class="mdl-dialog__content a-none anim-line-inner-a" style="font-size: 16px;line-height: 24px">
        <?php if ($this->user->hasLogin()): ?>
            <a target="_blank" href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?>
                (<?php $this->user->screenName(); ?>)
            </a><br>
            <a class="no-pjax" href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a>
        <?php else: ?>
            <a target="_blank" href="<?php $this->options->adminUrl('login.php'); ?>">
                <?php _e('前往后台登录'); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button close">关闭</button>
    </div>
</dialog>

<script src="<?php $this->options->themeUrl('material/dialog-polyfill.js'); ?>"></script>
<script>
    $(function () {
        var dialog = document.querySelector('dialog');
        var showDialogButton = document.querySelector('#show-login-dialog');
        if (!dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        showDialogButton.addEventListener('click', function () {
            dialog.showModal();
        });
        dialog.querySelector('.close').addEventListener('click', function () {
            dialog.close();
        });
    })
</script>

