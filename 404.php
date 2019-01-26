<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!$this->request->isAjax()) {
    $this->need('header.php');
} else {
    $this->need('siteTitle.php');
} ?>

<div class="post-card mdl-card mdl-cell mdl-shadow--2dp mdl-cell--12-col hover-shadow--4dp menu-dialog-visible">
    <div style="width: 100%;text-align: center;padding: 80px 16px;box-sizing: border-box">
        <h2 style="font-size: 128px;line-height: 100px;">404</h2>
        <div style="padding-top: 16px; word-break: break-all;overflow: hidden;box-sizing: border-box;line-height: 22px;">
            很抱歉, 你要找的东西可能被删除了呢?😀 <br><b>尝试搜索看看</b>...
        </div>
        <a style="margin-top: 8px;" href="<?php $this->options->siteUrl(); ?>"
           class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">返回首页</a>
    </div>
</div>
<?php if (!$this->request->isAjax()) {
    $this->need('footer.php');
} ?>
