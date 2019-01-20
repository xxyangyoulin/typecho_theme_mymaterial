<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="mdl-layout__drawer" id="drawer">
    <div class="nav-header"
         style="background-image: url('<?php if ($this->options->drawerImageUrl): $this->options->drawerImageUrl(); else:$this->options->themeUrl('image/drawer.jpg'); endif; ?>');">

        <?php echo $this->author->gravatar(50); ?>

        <div class="author">
            <?php $this->author('screenName'); ?>
        </div>
        <div class="desc">
            <?php $this->options->description() ?>
        </div>

        <button class="mdl-button mdl-js-button mdl-button--icon mdl-color-text--white"
                id="close-drawer" onclick="closeDrawer()">
            <i class="material-icons">clear_all</i>
        </button>
    </div>

    <div class="menu-list">
        <ul>
            <li>
                <form class="mdl-cell--hide-desktop mdl-cell--hide-tablet mdl-color-text--grey-600"
                      action="<?php $this->options->siteUrl(); ?>"
                      style="padding: 0px 16px;">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="s" type="text" id="drawer-search"
                               style="padding: 6px 0">
                        <label class="mdl-textfield__label" for="drawer-search">Search...</label>
                    </div>
                </form>
            </li><!--search-->

            <li><a href="<?php $this->options->siteUrl(); ?>">
                    <i class="material-icons">home</i><?php _e('首页'); ?>
                </a>
            </li><!--home-->

            <hr class="menu-divider"/>

            <li>
                <a class="menu-switch">
                    <i class="material-icons">dashboard</i>归档
                </a>
                <ul class="menu-sub-list">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
                        ->parse('<li><a href="{permalink}"><i class="material-icons"></i>{date}<span class="count">{count}</span></a></li>'); ?>
                </ul>
            </li><!--归档-->
            <li>
                <a class="menu-switch">
                    <i class="material-icons">dashboard</i>分类
                </a>
                <ul class="menu-sub-list">
                    <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
                        ->parse('<li><a href="{permalink}"><i class="material-icons"></i>{date}<span class="count">{count}</span></a></li>'); ?>
                </ul>
            </li>


            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while ($pages->next()): ?>
                <li><a<?php if ($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?>
                            href="<?php $pages->permalink(); ?>"
                            title="<?php $pages->title(); ?>">
                        <i class="material-icons">person</i><?php $pages->title(); ?>
                    </a></li>
            <?php endwhile; ?>


            <li><a href="#"><i class="material-icons">sms</i>留言</a></li>
            <li><a href="#"><i class="material-icons">group</i>友情链接</a></li>
            <li><a href="#"><i class="material-icons">person</i>关于</a></li>
            <hr class="menu-divider"/>

            <?php if ($this->user->hasLogin()): ?>
                <li><a target="_blank" href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?>
                        (<?php $this->user->screenName(); ?>)</a></li>
                <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
            <?php else: ?>
                <li><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
        </ul>
    </div>
</div>
