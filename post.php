<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="mdl-cell--9-col mdl-cell--6-col-tablet">
    <?php if (!empty($this->options->homeCard) && in_array('showBreadcrumb', $this->options->homeCard)): ?>
        <div class="breadcrumb mdl-cell mdl-cell--12-col mdl-shadow--2dp hover-shadow--4dp">
            <a class="mdl-color-text--primary" href="#" onclick="window.history.back();return false;">
                <i class="material-icons">arrow_back</i>返回</a>
            <a><?php $this->title() ?></a>

            <div class="right-box">
            </div>
        </div>
    <?php endif; ?>
    <div class="post-card mdl-card mdl-cell mdl-shadow--2dp hover-shadow--4dp menu-dialog-visible
             mdl-cell--12-col">

        <?php $cardImage = $this->fields->card_image;
        if ($cardImage): ?>
        <div class="mdl-card__title has-image" style="background-image: url('<?php echo $cardImage ?>')">
            <?php else: ?>
                <div class="mdl-card__title""><?php endif; ?>

            <div class="card-text-wrapper inner-a-color-inherit">
                <h2 class="mdl-card__title-text mdl-typography--font-bold">
                    <a class="a-none anim-line"
                       href="<?php $this->permalink() ?>"><?php $this->title() ?>
                    </a>
                </h2>
                <div class="post-meta2">


                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished">
                        <?php $this->date('Y/m/d'); ?>
                    </time>

                    <a itemprop="name" class="a-none"
                       href="<?php $this->author->permalink(); ?>"
                       rel="author"><?php $this->author(); ?></a>

                    <span class="inner-a-color-inherit a-none">
                 <?php $this->category(','); ?></span>

                    <span class="inner-a-color-inherit a-none">
                 &nbsp;<a itemprop="discussionUrl" onclick="$.gotoAnchorSmooth($('#comments'));return false;"
                          href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1评论', '%d评论'); ?></a></span>
                </div>
            </div>
        </div>

        <button style="position: absolute;top: 16px;right: 16px;" id="post-share-btn"
                class="mdl-button mdl-js-button mdl-button--icon mdl-color-text--grey-600">
            <i class="material-icons">share</i>
        </button>
        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
            for="post-share-btn">
            <li class="mdl-menu__item">
                <a class="no-pjax" onclick="shareWeibo(
                        '<?php urlencode($this->title()) ?>',
                        '<?php urlencode($this->permalink()) ?>',
                        '<?php urlencode($this->fields->card_image()) ?>')">分享到 微博</a>
            </li>
        </ul>

        <div class="mdl-card__supporting-text color-text-block-primary ">
            <div class="article-content" id="article-content">
                <?php $this->content(); ?>
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

            <ul class="post-near ">
                <?php $this->theNext('<li class=""><i class="material-icons">arrow_back</i>%s</li>', '没有了'); ?>
                <div class="mdl-layout-spacer"></div>
                <?php $this->thePrev('<li class="right"><i class="material-icons">arrow_forward</i>%s</li>', '没有了'); ?>
            </ul>
        </div><!--mdl-card__actions-->

    </div>
</div>


<div class="article-title-list-w mdl-cell--3-col mdl-cell--hide-phone
            mdl-cell--2-col-tablet">
    <div class="article-title-list">
        <?php
        if (!$this->fields->rmTree):$this->treeMenu();endif;
        ?>
    </div>
</div><!--article-title-list-->

<?php $this->need('footer.php'); ?>






