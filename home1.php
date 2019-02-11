<?php
/**
 * My Material 主题 简单模式
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>


<?php if ($this->is('index') && $this->getCurrentPage() == 1): ?>
    <?php if (!empty($this->options->homeCard) && in_array('showLeft', $this->options->homeCard)): ?>
        <div class="head-card-left translation-all-3 mdl-card mdl-cell hover-shadow--3dp shadow--1dp translation-all-3
            <?php if (in_array('showRight', $this->options->homeCard)): ?> mdl-cell--8-col mdl-cell--5-col-tablet <?php else: ?> mdl-cell--12-col <?php endif; ?> menu-dialog-visible">
            <div class="has-image mdl-card__title">
                <a class="has-image-img"><img alt=""
                                              src="<?php if ($this->options->leftImageUrl): $this->options->leftImageUrl();
                                              else:$this->options->themeUrl('image/left.jpg'); endif; ?>"></a>
                <div class="card-text-wrapper">
                    <h2 class="mdl-card__title-text   mdl-color-text--white">
                        <?php $this->options->title() ?>
                    </h2>
                    <div class="mdl-card__subtitle-text color-text-white-second">
                        <?php $this->options->description() ?>
                    </div>
                </div>
            </div>

            <div class="mdl-card__actions ">
                <div class="avator-wrapper zoom-avator avatar-shadow">
                    <?php echo $this->author->gravatar(80); ?>

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
                            <li class="mdl-menu__item">
                                <a class="no-pjax" onclick="shareWeibo(
                                        '<?php urlencode($this->options->title() . '-' . $this->options->description()) ?>',
                                        '<?php urlencode($this->options->siteUrl()) ?>')">分享到 微博</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--head-card-left-->

        <?php if (!empty($this->options->homeCard) && in_array('showRight', $this->options->homeCard)): ?>
            <div class="head-card-right translation-all-3 mdl-card mdl-cell mdl-shadow--2dp mdl-cell--4-col hover-shadow--3dp shadow--1dp translation-all-3
            mdl-cell--3-col-tablet menu-dialog-visible mdl-cell--hide-phone mdl-js-ripple-effect">
                <div class="mdl-card__title has-image">
                    <a class="has-image-img">
                        <img src="<?php if ($this->options->rightImageUrl): $this->options->rightImageUrl(); else:$this->options->themeUrl('image/right.jpg'); endif; ?>"
                             alt=""></a>
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
                            <li class="mdl-menu__item">
                                <a class="no-pjax" onclick="shareWeibo(
                                        '<?php urlencode($this->options->title() . '-' . $this->options->description()) ?>',
                                        '<?php urlencode($this->options->siteUrl()) ?>')">分享到 微博</a>
                            </li>
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
    <?php endif; ?>
<?php endif; ?>

<?php if (!empty($this->options->homeCard) && in_array('showBreadcrumb', $this->options->homeCard)): ?>
    <?php if (!$this->is('index') || $this->getCurrentPage() != 1): ?>
        <div class="breadcrumb mdl-cell mdl-cell--12-col  hover-shadow--3dp shadow--1dp translation-all-3">
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
<?php endif; ?>
<div></div>
<?php $this->need('postCard.php') ?>

<?php //$this->pageNav('<i class="material-icons">navigate_before</i>', '<i class="material-icons">navigate_next</i>'); ?>
<div class="load-more-wrap" style="width: 100%;text-align: center">
    <a id="load-more"
       style="margin: 16px 0">
        <span class="description">加载更多</span>
    </a>
    <div id="load-more-anim">
        <div class="cube1"></div>
        <div class="cube2"></div>
    </div>
</div>
