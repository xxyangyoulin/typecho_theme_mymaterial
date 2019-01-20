<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div class="post-card mdl-card mdl-cell mdl-shadow--2dp hover-shadow--4dp
             mdl-cell--9-col mdl-cell--6-col-tablet">
    <div class="card-head-img has-image"
         style="background-image: url('<?php $this->options->themeUrl('./image/left.jpg'); ?>')">
    </div>
    <div class="mdl-card__title color-text-block-primary">
        <h2 class="mdl-card__title-text">
            <a class="color-text-block-primary a-none anim-line"
               href="<?php $this->permalink() ?>">
                <?php $this->title() ?>
            </a>
        </h2>
    </div>
    <div class="article-create-time color-text-block-second">
        <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y/m/d'); ?></time>
    </div>
    <div class="mdl-card__supporting-text color-text-block-primary">
        <div class="article-content">
            <?php $this->content(); ?>
        </div>
    </div>
    <div class="tag-wrapper">
        <?php $this->tags('') ?>
        <div class="clearfix"></div>
    </div>

    <div class="mdl-card__actions mdl-card--border" style="background: whitesmoke;">
        <!--        <ul class="post-near ">-->
        <!--            <li>-->
        <!--                <i class="material-icons">arrow_back</i>-->
        <!--                --><?php //$this->thePrev('%s', '没有了'); ?>
        <!--            </li>-->
        <!--            <div class="mdl-layout-spacer"></div>-->
        <!--            <li class="right">-->
        <!--                <i class="material-icons">arrow_forward</i>-->
        <!--                --><?php //$this->theNext('%s', '没有了'); ?>
        <!--            </li>-->
        <!--        </ul>-->

        <?php $this->need('comments.php'); ?>
    </div><!--mdl-card__actions-->
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
