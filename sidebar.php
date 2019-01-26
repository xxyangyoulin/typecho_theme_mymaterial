<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>

<div class="mdl-cell--4-col mdl-cell--3-col-tablet menu-dialog-visible"
     style="max-width: 280px;">

    <?php if (!empty($this->options->homeCard) && in_array('showRight', $this->options->homeCard)): ?>
        <div class="head-card-right translation-all-3 mdl-card mdl-cell mdl-shadow--2dp mdl-cell--4-col hover-shadow--4dp
             mdl-cell--12-col menu-dialog-visible">
            <div class="mdl-card__title"
                 style="background-image: url('<?php if ($this->options->rightImageUrl): $this->options->rightImageUrl(); else:$this->options->themeUrl('image/right.jpg'); endif; ?>'">
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
                                    '<?php urlencode($this->options->title() . ',' . $this->options->description()) ?>',
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

    <?php if (!empty($this->options->homeCard) && in_array('showComment', $this->options->homeCard)): ?>
        <div class="translation-all-3 mdl-card mdl-cell mdl-shadow--2dp mdl-cell--4-col hover-shadow--4dp
             mdl-cell--12-col">
            <div class="mdl-card__title" style="border-bottom: 1px solid gainsboro">
                <h2 style="font-size: 16px"
                    class="mdl-card__title-text mdl-typography--font-bold color-text-block-second">
                    最近回复</h2>
            </div>
            <ul class="comment-recent">
                <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                <?php while ($comments->next()): ?>
                    <li>
                        <a href="<?php $comments->url(); ?>">
                            <?php $comments->gravatar('40', ''); ?>
                        </a>
                        <a href="<?php $comments->permalink(); ?>" style="margin-left: 16px;">
                            <div style="color:rgba(0,0,0,0.54) "><?php $comments->author(false); ?></div>
                            <?php $comments->excerpt(35, '...'); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div><!--最近回复-->
    <?php endif; ?>

    <?php if (!empty($this->options->homeCard) && in_array('showNewest', $this->options->homeCard)): ?>
        <div class="translation-all-3 mdl-card mdl-cell mdl-shadow--2dp mdl-cell--4-col hover-shadow--4dp
             mdl-cell--12-col">
            <div class="mdl-card__title" style="border-bottom: 1px solid gainsboro">
                <h2 style="font-size: 16px"
                    class="mdl-card__title-text mdl-typography--font-bold color-text-block-second">
                    最新发布</h2>
            </div>


            <ul class="comment-recent">
                <?php $this->widget('Widget_Contents_Post_Recent')
                    ->parse('<li><a style="color: rgba(0,0,0,0.54);overflow: hidden;font-size: 16px"  href="{permalink}">{title}<div 
style="overflow: hidden;white-space: nowrap;font-size: 14px;
    text-overflow: ellipsis;color: rgba(0,0,0,0.45);">{description}</div></a></li>'); ?>
            </ul>
        </div><!--最新发布-->
    <?php endif; ?>

    <?php if (!empty($this->options->homeCard) && in_array('showTagCloud', $this->options->homeCard)): ?>
        <div class="translation-all-3 mdl-card mdl-cell mdl-shadow--2dp mdl-cell--4-col hover-shadow--4dp
             mdl-cell--12-col menu-dialog-visible">
            <div class="mdl-card__title" style="border-bottom: 1px solid gainsboro">
                <h2 style="font-size: 16px"
                    class="mdl-card__title-text mdl-typography--font-bold color-text-block-second">
                    标签云</h2>
            </div>

            <ul class="tag-cloud">
                <!--            --><?php //$this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
                <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); ?>
                <?php if ($tags->have()): ?>
                    <?php while ($tags->next()): ?>

                        <li><a id="tag-cloud-item-<?php $tags->name() ?>"
                               style="padding 2px 4px; background-color:#b0bec5"
                               href="<?php $tags->permalink(); ?>"
                               rel="tag"><?php $tags->name(); ?></a></li>
                        <span class="mdl-tooltip mdl-tooltip--top" for="tag-cloud-item-<?php $tags->name() ?>">
                        该标签下有<?php $tags->count(); ?>个话题
                    </span>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li><?php _e('还没有任何标签呢'); ?></li>
                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
        </div><!--标签云-->
    <?php endif; ?>
</div>
