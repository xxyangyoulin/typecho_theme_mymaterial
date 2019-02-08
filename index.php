<?php
/**
 * My Material 主题
 *
 * @package My Material Theme
 * @author xxyangyoulin
 * @version 1.0
 * @link https://github.com/mnnyang/typecho_theme_mymaterial
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

if (!$this->request->isAjax()) {
    $this->need('header.php');
} else {
    $this->need('siteTitle.php');
}

if ($this->request->isAjax() && $this->request->get('page') > 1) {
    //ajax load more
    $this->need('postCard.php');

} else {
    if ($this->options->homeType && $this->options->homeType == 'type1') {
        $this->need('home1.php');
    } else {
        $this->need('home2.php');
        $this->need('sidebar.php');
    }
}

if (!$this->request->isAjax()) {
    $this->need('footer.php');
}
