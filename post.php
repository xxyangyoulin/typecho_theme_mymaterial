<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="mdl-cell--9-col mdl-cell--6-col-tablet">

<div class="breadcrumb mdl-cell mdl-cell--12-col mdl-shadow--2dp hover-shadow--4dp">
    <a class="mdl-color-text--primary" href="#" onclick="window.history.back();return false;">
        <i class="material-icons">arrow_back</i>返回</a>
    <a><?php $this->title() ?></a>
</div>

<div class="post-card mdl-card mdl-cell mdl-shadow--2dp hover-shadow--4dp
             mdl-cell--12-col">

    <?php $cardImage = $this->fields->card_image;
    if ($cardImage): ?>
    <div class="mdl-card__title has-image" style="background-image: url('<?php echo $cardImage ?>')">
        <?php else: ?>
            <div class="mdl-card__title""><?php endif; ?>

        <div class="card-text-wrapper">
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

                <span class="inner-a-color-inherit a-none" id="yyl-post-author">
                 |&nbsp;<a itemprop="name" href="<?php $this->author->permalink(); ?>"
                           rel="author"><?php $this->author(); ?></a></span>
                <div class="mdl-tooltip" for="yyl-post-author">作者</div>
                <span class="inner-a-color-inherit a-none">
                 |&nbsp;<?php $this->category(','); ?></span>

                <span class="inner-a-color-inherit a-none">
                 |&nbsp;<a itemprop="discussionUrl"
                           href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 评论', '%d 评论'); ?></a></span>
            </div>
        </div>
    </div>


    <div class="post-meta color-text-block-second ">
        <div class="avator-wrapper">
            <?php echo $this->author->gravatar(40); ?>
        </div>

        <div style="margin-left: auto;">
            <a href="<?php $this->permalink() ?>#comments" id="post-comment-btn" style="margin-left: auto;"
               class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">chat</i>
            </a>
            <button id="post-share-btn" style="margin-left: auto;" class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">share</i>
            </button>


            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="post-share-btn">
                <li class="mdl-menu__item">分享到 Twitter</li>
                <li class="mdl-menu__item">分享到 Fackbook</li>
                <li class="mdl-menu__item">分享到 新浪微博</li>
                <li class="mdl-menu__item">分享到 QQ空间</li>
            </ul>
        </div>
    </div>

    <div class="mdl-card__supporting-text color-text-block-primary">
        <div class="article-content">
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


        <ul class="post-near ">
            <li class="">
                <i class="material-icons">arrow_back</i>
                <?php $this->theNext('%s', '没有了'); ?>
            </li>
            <div class="mdl-layout-spacer"></div>

            <li class="right">
                <i class="material-icons">arrow_forward</i>
                <?php $this->thePrev('%s', '没有了'); ?>
            </li>
        </ul>

        <?php $this->need('comments.php'); ?>

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






