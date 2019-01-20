<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <!--    <link rel="stylesheet" href="-->
    <?php //$this->options->themeUrl('material/material.indigo-pink.min.css'); ?><!--">-->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('material/material.blue.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('material/material.font.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('material/dialog-polyfill.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>">

    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
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
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
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
        <button id="show-login-dialog" class="mdl-cell--hide-phone mdl-button mdl-js-button mdl-button--icon" style="margin-left: 16px;">
            <i class="material-icons">person</i>
        </button>
    </header>
    <!--drawer-->
    <?php $this->need('drawer.php'); ?>

    <main class="mdl-layout__content">
        <div class="bg mdl-color--primary-dark"></div>
        <div class="page-content mdl-grid">


    
