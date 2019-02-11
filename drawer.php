<div class="mdl-layout__drawer" id="drawer">
    <div class="nav-header"
         style="background-image: url('<?php if ($this->options->drawerImageUrl): $this->options->drawerImageUrl(); else:$this->options->themeUrl('image/drawer.jpg'); endif; ?>');">

        <div class="drawer-avator zoom-avator avatar-shadow">
        <?php echo $this->author->gravatar(50); ?>
        </div>

        <div class="author">
            <?php $this->author('screenName'); ?>
        </div>
        <div class="desc">
            <?php $this->options->description() ?>
        </div>

        <button class="mdl-button mdl-js-button mdl-button--icon mdl-color-text--white"
                id="close-drawer" onclick="$.closeDrawer()">
            <i class="material-icons">clear_all</i>
        </button>
    </div>

    <div class="menu-list">
        <ul>
            <li>
                <form id="drawer-search" class="mdl-cell--hide-desktop mdl-cell--hide-tablet mdl-color-text--grey-600"
                      action="<?php $this->options->siteUrl(); ?>"
                      style="padding: 0px 16px;">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="s" type="text" id="drawer-search-input"
                               style="padding: 6px 0">
                        <label class="mdl-textfield__label" for="drawer-search-input">Search...</label>
                    </div>
                </form>
            </li><!--search-->

            <li><a class="close-drawer" href="<?php $this->options->siteUrl(); ?>">
                    <i class="material-icons">home</i><?php _e('首页'); ?>
                </a>
            </li><!--home-->

            <hr class="menu-divider"/>
            <?php if (!empty($this->options->drawerBlock) && in_array('ShowArchive', $this->options->drawerBlock)): ?>
                <li class="menu-archive">
                    <a class="menu-switch">
                        <i class="material-icons">access_time</i>归档
                        <div class="mdl-button mdl-button--icon menu-right-btn follow-p"><i class="material-icons">chevron_right</i>
                        </div>
                    </a>
                    <ul class="menu-sub-list">
                        <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
                            ->parse('<li class="menu-item"><a class="close-drawer" href="{permalink}"><i class="material-icons"></i>{date}<span class="count">{count}</span></a></li>'); ?>
                    </ul>
                </li><!--归档-->
            <?php endif; ?>

            <?php if (!empty($this->options->drawerBlock) && in_array('ShowCategory', $this->options->drawerBlock)): ?>
                <li class="menu-category">
                    <a class="menu-switch">
                        <i class="material-icons">dashboard</i>分类
                        <div class="mdl-button mdl-button--icon menu-right-btn follow-p">
                            <i class="material-icons">chevron_right</i>
                        </div>
                    </a>
                    <ul class="menu-sub-list">
                        <!--                    --><?php //$this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list&showCount=true&countTemplate=<span&nbsp;class="count">{%d}</span>'); ?>
                        <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                        <?php while ($categorys->next()): ?>
                            <?php if ($categorys->levels === 0): ?>
                                <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                                <?php if (empty($children)) { ?>
                                    <li class="menu-item" <?php if ($this->is('category', $categorys->slug)): ?> class="active"<?php endif; ?>>
                                        <a class="close-drawer" href="<?php $categorys->permalink(); ?>"
                                           title="<?php $categorys->name(); ?>"><i
                                                    class="material-icons"></i><?php $categorys->name(); ?>
                                            <span class="count"><?php $categorys->count(); ?></span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li class="menu-item">
                                        <a class="close-drawer" href="<?php $categorys->permalink(); ?>"
                                           title="<?php $categorys->name(); ?>"><i
                                                    class="material-icons"></i><?php $categorys->name(); ?>
                                            （<?php $categorys->count(); ?>）
                                            <div class="menu-switch mdl-button mdl-button--icon menu-right-btn">
                                                <i class="material-icons">chevron_right</i>
                                            </div>
                                        </a>
                                        <ul class="menu-sub-list">
                                            <?php foreach ($children as $mid) { ?>
                                                <?php $child = $categorys->getCategory($mid); ?>
                                                <li class="menu-item" <?php if ($this->is('category', $mid)): ?> class="active"<?php endif; ?>>
                                                    <a class="close-drawer" href="<?php echo $child['permalink'] ?>"
                                                       title="<?php echo $child['name']; ?>"><i
                                                                class="material-icons"></i>&nbsp;<?php echo $child['name']; ?>
                                                        <span class="count"><?php $categorys->count(); ?></span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (!empty($this->options->drawerBlock) && in_array('ShowPages', $this->options->drawerBlock)): ?>
                <li>
                    <a class="menu-switch">
                        <i class="material-icons">description</i>页面
                        <div class="mdl-button mdl-button--icon menu-right-btn follow-p">
                            <i class="material-icons">chevron_right</i>
                        </div>
                    </a>
                    <ul class="menu-sub-list">
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while ($pages->next()): ?>
                            <?php if (in_array($pages->slug, drawerMenuPages())):continue; endif; ?>
                            <li>
                                <a class="close-drawer <?php if ($this->is('page', $pages->slug)): ?> current<?php endif; ?> "
                                   href="<?php $pages->permalink(); ?>"
                                   title="<?php $pages->title(); ?>">
                                    <i class="material-icons"></i><?php $pages->title(); ?>
                                </a></li>
                        <?php endwhile; ?>
                    </ul>
                </li><!--页面-->
            <?php endif; ?>

            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while ($pages->next()): ?>
                <?php if (!in_array($pages->slug, drawerMenuPages())):continue; endif; ?>
                <li><a class="close-drawer <?php if ($this->is('page', $pages->slug)): ?>current<?php endif; ?>"
                       href="<?php $pages->permalink(); ?>"
                       title="<?php $pages->title(); ?>">
                        <i class="material-icons">
                            <?php if ($pages->slug == 'about'):echo 'person';
                            elseif ($pages->slug == 'links'):echo 'link';
                            elseif ($pages->slug == 'reading'):echo 'photo_album';
                            elseif ($pages->slug == 'board'):echo 'sms'; endif; ?>
                        </i><?php $pages->title(); ?>
                    </a></li>
            <?php endwhile; ?>

            <hr class="menu-divider"/>

            <?php if ($this->user->hasLogin()): ?>
                <li><a class="close-drawer" target="_blank"
                       href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?>
                        (<?php $this->user->screenName(); ?>)</a></li>
                <li><a class="close-drawer" href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
            <?php else: ?>
                <li><a class="close-drawer"
                       href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
            <?php endif; ?>
            <li><a class="close-drawer" href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
        </ul>
    </div>
</div>
