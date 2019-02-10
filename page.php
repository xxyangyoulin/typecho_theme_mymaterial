<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!$this->request->isAjax()) {
    $this->need('header.php');
} else {
    $this->need('siteTitle.php');
} ?>
<?php $treeMenu = $this->treeMenu;
if ($treeMenu == '<div class="index-menu"><ul class="index-menu-list"></ul></div>') $treeMenu = NULL;
?>

<div style="max-width: 900px;"
     class="translation-all-1_5 <?php if (!$this->fields->rmTree && $treeMenu): ?>mdl-cell--9-col mdl-cell--6-col-tablet<?php else: ?>mdl-cell--11-col mdl-cell--8-col-tablet<?php endif; ?>">
    <div class="post-card page-post-card mdl-card mdl-cell mdl-shadow--2dp hover-shadow--4dp
             mdl-cell--12-col">
        <?php $postThumb = getPostThumb($this);
        if (!$postThumb):$postThumb = $this->fields->card_image; endif; ?>
        <?php if ($postThumb): ?>
            <div class="mdl-card__title has-image">
                <a class="has-image-img"><img alt="" src="<?php echo $postThumb; ?>"></a>
                <!--about page [contact]-->
                <div class="contact-wrap" style="position: absolute;right: 16px; bottom: -20px;z-index: 1">
                    <?php if ($this->options->ftGithub): ?>
                        <a href="https://github.com/<?php echo urlencode($this->options->ftGithub) ?>" target="_blank"
                           class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"
                           id="contact-ft-github"><img style="width: 24px;height: 24px;" src="<?php $this->options->themeUrl('image/icon/github.png'); ?>"></a>
                        <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-github">Github</span>
                    <?php endif; ?>



                    <?php if ($this->options->ftWeibo): ?>
                        <a href="<?php $this->options->ftWeibo(); ?>" target="_blank"
                           class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"  id="contact-ft-Weibo">
                            <img src="<?php $this->options->themeUrl('image/icon/weibo.png'); ?>">
                        </a>
                        <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-Weibo">Weibo</span>
                    <?php endif; ?>
                    <?php if ($this->options->ftQQ): ?>
                        <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo urlencode($this->options->ftQQ) ?>&amp;site=qq&amp;menu=yes"
                           target="_blank"
                           class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"  id="contact-ft-qq">
                            <img src="<?php $this->options->themeUrl('image/icon/qq.png'); ?>">
                        </a>
                        <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-qq">QQ</span>
                    <?php endif; ?>
                    <?php if ($this->options->ftEmail): ?>
                        <a href="" target="_self"
                           onclick="window.open('mailto:<?php echo urlencode($this->options->Email) ?>','_self'); return false;"
                           class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"  id="contact-ft-email">
                            <img src="<?php $this->options->themeUrl('image/icon/mail.png'); ?>">
                        </a>
                        <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-email">Email</span>
                    <?php endif; ?>
                    <!--TODO 如果你需要其他图标, 可以到这下载: https://www.iconfont.cn/-->
                </div>
            </div>
        <?php else: ?>
            <div class="mdl-card__title"></div>
        <?php endif; ?>

        <div class="mdl-card__supporting-text color-text-block-primary">
            <div class="card-text-wrapper" style="margin: 0 0 16px 0;padding: 0;">
                <h2 class="mdl-card__title-text mdl-typography--font-bold">
                    <a class="a-none anim-line"
                       href="<?php $this->permalink() ?>"><?php $this->title() ?>
                    </a>
                </h2>
                <div class="post-meta2">
                    <time class=""
                          datetime="<?php $this->date('c'); ?>" itemprop="datePublished">
                        <?php $this->date('Y/m/d'); ?>
                    </time>
                </div>
            </div>

            <div class="article-content">
                <?php if ($this->is('page', 'links')): ?>
                    <ul class="links-ul">
                        <?php Links_Plugin::output("SHOW_MD"); /**插件：links*/ ?>
                        <div class="clearfix"></div>
                    </ul>
                <?php endif; ?>

                <?php if ($this->is('page', 'board')): ?>
                    <?php $this->avatars('span', 'friend-wall image-no-show');/**插件：http://www.yzmb.me/archives/net/avatars-for-typecho*/ ?>
                    <script>
                        if (typeof titleTooltip != 'undefined' && titleTooltip instanceof Function)
                            titleTooltip();
                    </script>
                <?php endif; ?>

                <?php $this->allContent(); ?>
            </div>

            <div class="tag-wrapper">
                <?php foreach ($this->tags as $tag): ?>
                    <a style="margin-right: 8px;" class="anim-line"
                       href="<?php echo $tag['permalink']; ?>">#<?php echo $tag['name']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mdl-card__actions mdl-card--border" style="background: #EEEEEE;">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</div>

<?php if (!$this->fields->rmTree && $treeMenu): ?>
    <div class="article-title-list-w mdl-cell--3-col mdl-cell--hide-phone
            mdl-cell--2-col-tablet">
        <div class="article-title-list">
            <?php echo $treeMenu; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!$this->request->isAjax()) {
    $this->need('footer.php');
} ?>






