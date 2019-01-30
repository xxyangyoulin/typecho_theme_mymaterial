<?php
/**
 * 友链
 *
 * @package custom
 *
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!$this->request->isAjax()) {
    $this->need('header.php');
} else {
    $this->need('siteTitle.php');
} ?>
<div class="mdl-cell--9-col mdl-cell--6-col-tablet">
<!--    --><?php //if (!empty($this->options->homeCard) && in_array('showBreadcrumb', $this->options->homeCard)): ?>
    <!--        <div class="breadcrumb mdl-cell mdl-cell--12-col mdl-shadow--2dp hover-shadow--4dp">-->
    <!--            <a class="mdl-color-text--primary" href="--><?php //$this->options->siteUrl(); ?><!--">-->
    <!--                <i class="material-icons">home</i>-->
    <!--                首页-->
    <!--            </a>-->
    <!--            <a>--><?php //$this->title() ?><!--</a>-->
    <!---->
    <!--            <div class="right-box">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    --><?php //endif; ?>

    <div class="post-card mdl-card mdl-cell mdl-shadow--2dp hover-shadow--4dp
             mdl-cell--12-col">

        <?php $cardImage = $this->fields->card_image;
        if ($cardImage): ?>
            <div class="mdl-card__title has-image" style="background-image: url('<?php echo $cardImage ?>')"></div>
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

                <ul class="links-ul">
                    <?php Links_Plugin::output("SHOW_MD"); ?>
                    <div class="clearfix"></div>
                </ul>

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

<?php if (!$this->request->isAjax()) {
    $this->need('footer.php');
} ?>







