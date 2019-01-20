<?php
/**
 * My Material 主题
 *
 * @package My Material Theme
 * @author xxyangyoulin
 * @version 1.0
 * @link http://typecho.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<?php //debug_print($this->getCurrentPage()) ?>

<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>


<?php if ($this->is('index') && $this->getCurrentPage() == 1): ?>
    <div class="head-card-left translation-all-3 mdl-card mdl-cell mdl-shadow--2dp hover-shadow--4dp
            mdl-cell--8-col mdl-cell--5-col-tablet menu-dialog-visible">
        <div class="has-image mdl-card__title"
             style="background-image: url('<?php $this->options->themeUrl('image/left.jpg'); ?>') ">
            <div class="card-text-wrapper">

                <h2 class="mdl-card__title-text color-text-white-primary">
                    <?php $this->options->title() ?>
                </h2>
                <div class="mdl-card__subtitle-text color-text-white-second">
                    <?php $this->options->description() ?>
                </div>
            </div>
        </div>

        <div class="mdl-card__actions ">
            <div class="avator-wrapper">
                <?php echo $this->author->gravatar(40); ?>

                <span class="author-text color-text-block-primary">
                <?php $this->author('screenName'); ?>
            </span>
                <div class="mdl-layout-spacer"></div>

                <div class="action-wrapper">
                    <button id="right-card-pages-phone" style="margin-left: auto;"
                            class="mdl-button mdl-js-button mdl-button--icon
                                     mdl-cell--hide-desktop mdl-cell--hide-tablet">
                        <i class="material-icons">short_text</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="right-card-pages-phone">

                        <?php while ($pages->next()): ?>
                            <li class="mdl-menu__item">
                                <a<?php if ($this->is('page', $pages->slug)): ?>
                                    class="current"<?php endif; ?>
                                        href="<?php $pages->permalink(); ?>"
                                        title="<?php $pages->title(); ?>">
                                    <?php $pages->title(); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                    <button id="right-card-menu-phone" style="margin-left: auto;"
                            class="mdl-button mdl-js-button mdl-button--icon
                                     mdl-cell--hide-desktop mdl-cell--hide-tablet">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="right-card-menu-phone">
                        <li class="mdl-menu__item">文章 RSS</li>
                        <li class="mdl-menu__item">分享到 Twitter</li>
                        <li class="mdl-menu__item">分享到 Fackbook</li>
                        <li class="mdl-menu__item">分享到 新浪微博</li>
                        <li class="mdl-menu__item">分享到 QQ空间</li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--head-card-left-->


    <div class="head-card-right translation-all-3 mdl-card mdl-cell mdl-shadow--2dp mdl-cell--4-col hover-shadow--4dp
            mdl-cell--3-col-tablet menu-dialog-visible mdl-cell--hide-phone mdl-js-ripple-effect">
        <div class="mdl-card__title"
             style="background-image: url('<?php $this->options->themeUrl('image/right.jpg'); ?>');">
            <!--<h2 class="mdl-card__title-text">Welcome</h2>-->
        </div>

        <div class="mdl-card__actions">
            <div class="action-wrapper">
                <div class="mdl-layout-spacer"></div>
                <button id="right-card-pages" style="margin-left: auto;"
                        class="mdl-button mdl-js-button mdl-button--icon">
                    <i class="material-icons">short_text</i>
                </button>
                <button id="right-card-menu" style="margin-left: auto;"
                        class="mdl-button mdl-js-button mdl-button--icon">
                    <i class="material-icons">more_vert</i>
                </button>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    for="right-card-pages">
                    <?php while ($pages->next()): ?>
                        <li class="mdl-menu__item">
                            <a<?php if ($this->is('page', $pages->slug)): ?>
                                class="current"<?php endif; ?>
                                    href="<?php $pages->permalink(); ?>"
                                    title="<?php $pages->title(); ?>">
                                <?php $pages->title(); ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    for="right-card-menu">
                    <li class="mdl-menu__item">文章 RSS</li>
                    <li class="mdl-menu__item">分享到 Twitter</li>
                    <li class="mdl-menu__item">分享到 Fackbook</li>
                    <li class="mdl-menu__item">分享到 新浪微博</li>
                    <li class="mdl-menu__item">分享到 QQ空间</li>
                </ul>
            </div>
        </div>

        <div class="mdl-card__menu">
            <div class="label-item">
                <div class="label-item-number mdl-typography--font-bold">
                    <?php $stat->publishedPostsNum() ?>
                </div>
                <div class="label-item-desc mdl-typography--body-1">文章</div>
            </div>

            <div id="label_comment_count" class="label-item">
                <div class="label-item-number mdl-typography--font-bold">
                    <?php $stat->publishedCommentsNum() ?>
                </div>
                <div class="label-item-desc mdl-typography--body-1">评论</div>
            </div>

        </div>
    </div><!--head-card-right-->
<?php endif; ?>

<?php if (!$this->is('index') || $this->getCurrentPage() != 1): ?>
    <div class="breadcrumb mdl-cell mdl-cell--12-col">
        <a class="mdl-color-text--primary" href="<?php $this->options->siteUrl(); ?>">
            <i class="material-icons">home</i>
            首页
        </a>
        <?php if (!$this->is('index')): ?>
            <a>
                <?php $this->archiveTitle(array(
                    'category' => _t('分类 %s'),
                    'search' => _t('包含关键字 %s'),
                    'tag' => _t('标签 %s'),
                    'author' => _t('%s')
                ), '', ''); ?>
            </a>
        <?php endif; ?>
        <?php if ($this->getCurrentPage() != 1): ?>
            <a>第<?php echo $this->getCurrentPage() ?>页</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php while ($this->next()): ?>
    <div class="post-card mdl-card mdl-cell mdl-shadow--2dp mdl-cell--12-col hover-shadow--4dp">

        <div class="mdl-card__title">
            <!--
            style="background-image: url('<?php /*$this->options->themeUrl('image/left.jpg'); */ ?>') "-->
            <div class="card-text-wrapper">
                <h2 class="mdl-card__title-text mdl-typography--font-bold">
                    <a class="a-none anim-line "
                       href="<?php $this->permalink() ?>"><?php $this->title() ?>
                    </a>
                </h2>
                <time
                        datetime="<?php $this->date('c'); ?>" itemprop="datePublished">
                    <?php $this->date('Y/m/d'); ?>
                </time>
            </div>
        </div>

        <div class="mdl-card__supporting-text">
            <div class="article-content">
                <?php $this->content(); ?>
            </div>
        </div>

        <div class="mdl-card__actions mdl-card--border">
            <div class="action-wrapper mdl-color-text--primary inner-a-color-inherit a-none">
                <a href="<?php $this->permalink() ?>">
                    <span>继续阅读</span>
                </a>
                <div class="mdl-layout-spacer"></div>
                <?php $this->category(','); ?>

                <a itemprop="discussionUrl"
                   href="<?php $this->permalink() ?>#comments">
                    <?php $this->commentsNum('评论', '1 评论', '%d 评论'); ?>
                </a>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php $this->pageNav('<i class="material-icons">navigate_before</i>',
    '<i class="material-icons">navigate_next</i>'); ?>

<?php $this->need('footer.php'); ?>
