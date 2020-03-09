<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
<!--    <meta http-equiv="Content-Type" content="text/html; charset=--><?php //$this->options->charset(); ?><!--" />-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->need('siteTitle.php'); ?>
    <link rel="shortcut icon" href="<?php $this->options->siteUrl() ?>favicon.ico"/>
    <link rel="bookmark" href="<?php $this->options->siteUrl() ?>favicon.ico"/>

    <link rel="stylesheet" href="<?php $this->options->themeUrl('material/material.blue.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('js/fancybox/jquery.fancybox.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.min.css'); ?>">
    <?php if (getOS() == 'mac'): ?>
        <style>
            .article-content,
            .article-content * {
                font-size: 16px;
            }
        </style>
    <?php endif; ?>

    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php $this->header(); ?>

    <script>
        <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
        var typechoConf = [];
        typechoConf.siteUrl = '<?php $this->options->siteUrl() ?>';
        typechoConf.pageSize = '<?php $this->options->pageSize() ?>';
        typechoConf.pageTotalSize = '<?php $stat->publishedPostsNum() ?>';
        typechoConf.musicAutoPlay = <?php echo ($this->options->musicCtrl && in_array('auto', $this->options->musicCtrl)) ? 'true' : 'false' ?>;
        typechoConf.musicAutoNext = <?php echo ($this->options->musicCtrl && in_array('autoNext', $this->options->musicCtrl)) ? 'true' : 'false' ?>;
    </script>
</head>
<body style="">
<!--[if lt IE 8]>
<div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a
        href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.
</div>
<![endif]-->

<div class="mdl-layout mdl-js-layout">
    <header class="mdl-color-text--grey-700">
        <div aria-expanded="false" role="button" tabindex="0"
             class="mdl-layout__drawer-button" style="display: none">
            <i class="material-icons"></i></div>
        <div role="button" tabindex="0" class="my-drawer-button">
            <i class="material-icons"></i></div>
        <!-- Top row, always visible -->

        <div class="mdl-layout-spacer"></div>

        <!-- Title -->
        <form id="search" method="get" action="<?php $this->options->siteUrl(); ?>" role="search">
            <div class="mdl-cell--hide-phone mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
                <label class="mdl-button mdl-js-button mdl-button--icon"
                       for="waterfall-exp">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" name="s"
                           id="waterfall-exp">
                </div>
            </div>
        </form>
        <?php
        if (class_exists("MaterialPlayer_Plugin")){
            MaterialPlayer_Plugin::insert("margin-left:15px");
        }
        ?>

        <button class="mdl-button mdl-js-button mdl-button--icon no-pjax mdl-cell--hide-desktop mdl-cell--hide-tablet"
                id="index-button" style="margin-left: 8px;">
            <i class="material-icons">view_list</i>
        </button>

        <a href="<?php $this->options->adminUrl(); ?>" id="show-login-dialog" target="_blank"
           class="mdl-cell--hide-phone mdl-button mdl-js-button mdl-button--icon no-pjax" style="margin-left: 16px;">
            <i class="material-icons">person</i>
        </a>
    </header>
    <!--drawer-->
    <?php $this->need('drawer.php'); ?>

    <main class="mdl-layout__content" id="mdl-layout-content"
          style="background-image: url('<?php $this->options->themeUrl('css/style.css'); ?>');">
        <div id="page-content"
             class="page-content mdl-grid <?php if (($this->options->homeType && $this->options->homeType == 'type1')):echo ' page-content-type1';endif; ?>">

    
