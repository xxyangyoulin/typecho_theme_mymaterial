<?php if (!$this->have()): ?>
    <div class="post-card mdl-card mdl-cell mdl-cell--12-col shadow--1dp hover-shadow--4dp empty-content">好像没发现东西...</div>
<?php endif; ?>

<?php while ($this->next()): ?>
    <div class="post-card mdl-card mdl-cell mdl-cell--12-col  shadow--1dp hover-shadow--3dp menu-dialog-visible translation-all-3">

    <?php $cardImage = $this->fields->card_image;
if ($cardImage): ?>
    <div class="mdl-card__title has-image" style="background-image: url('<?php echo $cardImage ?>')">
    <?php else: ?>
    <div class="mdl-card__title"><?php endif; ?>
    <div class="card-text-wrapper">
        <h2 class="mdl-card__title-text "><a class="a-none anim-line "
                                             href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
        <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->dateWord(); ?></time>
    </div>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="article-content">
            <?php $this->content() ?>
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