<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $LeftImage = new Typecho_Widget_Helper_Form_Element_Text('leftImageUrl', NULL, NULL,
        _t('站点 左边大图 地址'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($LeftImage);
    $rightImage = new Typecho_Widget_Helper_Form_Element_Text('rightImageUrl', NULL, NULL,
        _t('站点 右边小图 地址'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($rightImage);
    $drawerImage = new Typecho_Widget_Helper_Form_Element_Text('drawerImageUrl', NULL, NULL,
        _t('站点 侧拉栏头图 地址'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($drawerImage);

    $drawerBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('drawerBlock',
        array('ShowPages' => _t('显示页面'),
            'ShowCategory' => _t('显示分类'),
            'ShowArchive' => _t('显示归档')),
        array('ShowPages', 'ShowCategory', 'ShowArchive'), _t('抽屉显示'));

    $form->addInput($drawerBlock->multiMode());

    $homeType = new Typecho_Widget_Helper_Form_Element_Radio('homeType',
        array('type1' => '简洁模式', 'type2' => '一般模式'), array('type2'), _t('首页风格'));
    $form->addInput($homeType);
}


function themeFields($layout)
{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('card_image',
        NULL, NULL,
        _t('文章顶部图片'),
        _t('在这里填入一个图片URL地址, 以在文章标题后加上背景图片'));
    $layout->addItem($logoUrl);
}

// 设置时区
date_default_timezone_set('Asia/Shanghai');
/**
 * 秒转时间，格式 年 月 日 时 分 秒
 *
 * @author Roogle
 * @return html
 */
function getBuildTime()
{
// 在下面按格式输入本站创建的时间
    $site_create_time = strtotime('2017-05-10 00:00:00');
    $time = time() - $site_create_time;
    if (is_numeric($time)) {
        $value = array(
            "years" => 0, "days" => 0, "hours" => 0,
            "minutes" => 0, "seconds" => 0,
        );
        if ($time >= 31556926) {
            $value["years"] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 86400) {
            $value["days"] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value["hours"] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value["minutes"] = floor($time / 60);
            $time = ($time % 60);
        }
        $value["seconds"] = floor($time);

        echo '<span class="btime">' . $value['years'] . '年' . $value['days'] . '天' . $value['hours'] . '小时' . $value['minutes'] . '分</span>';
    } else {
        echo '';
    }
}

function getStartTime()
{
    return '2029-01-19 00:00:00';
}

function drawerMenuPages()
{
    return array('about', 'links', 'board');
}

//评论添加回复标记
function getCommentReply($parent)
{

    $db = Typecho_Db::get();
//    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
//        ->where('coid = ? AND status = ?', $coid, 'approved'));
//    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));

        if ($arow && $arow['author']) {
            echo "<a  href=\"#comment-{$parent}\" class=\"reply-author mdl-color-text--primary\">@<b>{$arow['author']}</b></a>";
        }
    }
}

function randomMaterialColor($index = NULL)
{
    if ($index == NULL) {
        $index = rand(0, 20);
    } else if ($index < 0) {
        $index = 6;
    }
    $mdColors = array('#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3',
        '#03a9f4', '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39', '#ffeb3b',
        '#ffc107', '#ff9800', '#ff5722', '#795548', '#9e9e9e', '#607d8b');
    echo $mdColors[$index % count($mdColors)];
}

function debug_print($obj)
{
    echo '<div style="border: 1px red solid;position:fixed; top: 0; left: 0; z-index: 10000;font-size: 12px;font-style: unset;
overflow: auto;background-color: black;color: gainsboro;height: 100%;width: 100%"><pre>'
        . print_r($obj, true)
        . '</pre></div>';
}


