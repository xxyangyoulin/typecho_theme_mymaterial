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
    <div class="post-card mdl-card mdl-cell  mdl-shadow--2dp hover-shadow--4dp menu-dialog-visible mdl-cell--12-col">
        <?php $cardImage = $this->fields->card_image;
        $postThumb = getPostThumb($this);
        if ($cardImage): ?>
        <div class="mdl-card__title has-image" style="background-image: url('<?php echo $cardImage; ?>')">
            <?php elseif ($postThumb): ?>
            <div class="mdl-card__title has-image" style="background-image: url('<?php echo $postThumb; ?>')">
                <?php else: ?>
                <div class="mdl-card__title">
                    <?php endif; ?>

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

        <div class="mdl-card__supporting-text color-text-block-primary ">
            <div class="article-content" id="article-content">
                <?php $this->allContent() ?>
            </div>
            <div class="tag-wrapper">
                <?php foreach ($this->tags as $tag): ?>
                    <a class="mdl-button mdl-js-button least-button mdl-button--primary hover--margin-top-1px mdl-shadow--2dp hover-shadow--3dp translation-all-3"
                       href="<?php echo $tag['permalink']; ?>">#<?php echo $tag['name']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="mdl-card__actions mdl-card--border" style="background: #EEEEEE;">
            <?php $this->need('comments.php'); ?>
        </div><!--mdl-card__actions-->
    </div>

    <ul class="post-near ">
        <?php $this->theNext('<li class=""><i class="material-icons">arrow_back</i>%s</li>', '没有了'); ?>
        <div class="mdl-layout-spacer"></div>
        <?php $this->thePrev('<li class="right"><i class="material-icons">arrow_forward</i>%s</li>', '没有了'); ?>
    </ul>
</div>

<?php if (!$this->fields->rmTree && $treeMenu): ?>
    <div id="article-index-w"
         class="article-title-list-w mdl-cell--3-col mdl-cell--hide-phone mdl-cell--2-col-tablet">
        <div class="article-title-list">
            <?php echo $treeMenu; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!$this->request->isAjax()) {
    $this->need('footer.php');
} ?>






