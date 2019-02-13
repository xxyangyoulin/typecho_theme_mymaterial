<?php if (!$this->have()): ?>
    <div id="no-more" class="post-card mdl-card mdl-cell mdl-cell--12-col shadow--1dp hover-shadow--4dp empty-content">
        没有了...
    </div>
<?php elseif ($this->getTotalPage() == $this->getCurrentPage()): ?>
<span id="tag-no-more"></span>
<?php endif; ?>

<?php while ($this->next()): ?>
    <div class="post-card mdl-card mdl-cell mdl-cell--12-col  shadow--1dp hover-shadow--3dp menu-dialog-visible translation-all-3">

    <?php $postThumb = getPostThumb($this);
    if (!$postThumb):$postThumb = $this->fields->card_image; endif; ?>
    <?php if ($postThumb): ?>
    <div class="mdl-card__title has-image">
    <a href="<?php $this->permalink() ?>" class="has-image-img"><img alt="" src="<?php echo $postThumb; ?>"></a>
    <?php else: ?>
    <div class="mdl-card__title">
<?php endif; ?>

    <div class="card-text-wrapper">
        <h2 class="mdl-card__title-text "><a class="a-none anim-line "
                                             href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
        <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->dateWord(); ?></time>
    </div>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="article-content markdown">
            <?php $this->simpleContent() ?>
        </div>
    </div>

    <div class="mdl-card__actions mdl-card--border font-ant">
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