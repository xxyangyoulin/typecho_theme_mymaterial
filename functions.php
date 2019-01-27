<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $homeType = new Typecho_Widget_Helper_Form_Element_Radio('homeType',
        array('type1' => '简洁模式', 'type2' => '一般模式'), array('type2'), _t('首页风格'));
    $form->addInput($homeType);

    $homeCard = new Typecho_Widget_Helper_Form_Element_Checkbox('homeCard',
        array('showLeft' => _t('显示首页左边大图Card'),
            'showRight' => _t('显示首页右边大图Card'),
            'showComment' => _t('显示最新回复 (一般模式下有效)'),
            'showNewest' => _t('显示最新发布 (一般模式下有效)'),
            'showTagCloud' => _t('显示标签云 (一般模式下有效)'),
            'showBreadcrumb' => _t('显示面包屑导航条')),
        array('showLeft', 'showRight', 'showComment', 'showNewest', 'showTagCloud', 'showBreadcrumb',),
        _t('首页功能'),
        _t('简洁模式只能全显示或全隐藏 (默认情况全部显示)'));
    $form->addInput($homeCard->multiMode());

    $LeftImage = new Typecho_Widget_Helper_Form_Element_Text('leftImageUrl', NULL, NULL,
        _t('站点 左边Card背景图'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($LeftImage);
    $rightImage = new Typecho_Widget_Helper_Form_Element_Text('rightImageUrl', NULL, NULL,
        _t('站点 右边Card背景图'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($rightImage);

    $drawerImage = new Typecho_Widget_Helper_Form_Element_Text('drawerImageUrl', NULL, NULL,
        _t('站点 侧拉图的背景图'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($drawerImage);

    $drawerBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('drawerBlock',
        array('ShowPages' => _t('显示页面'),
            'ShowCategory' => _t('显示分类'),
            'ShowArchive' => _t('显示归档')),
        array('ShowPages', 'ShowCategory', 'ShowArchive'), _t('抽屉显示'));
    $form->addInput($drawerBlock->multiMode());

    $musicList = new Typecho_Widget_Helper_Form_Element_Textarea('musicList', NULL, NULL,
        _t('背景音乐列表'),
        _t('格式:<span style="color: darkred">歌曲url或者网易云id (空格)曲名 (空格)歌手,(歌手可省略, 逗号必须, 写完一条可以换一行)</span><br>例如:<br>448065 孤独な巡礼 川井憲次,<br>http://music.163.com/song/media/outer/url?id=2177197.mp3 Moon_River Audrey_Hepburn<br>没错就是这样😄,<i style="color: darkred">歌曲或者歌手名字有空格就用下划线代替吧,懒得适配了..</i> '));
    $form->addInput($musicList);

    $musicCtrl = new Typecho_Widget_Helper_Form_Element_Checkbox('musicCtrl',
        array('auto' => _t('自动播放'),
            'autoNext' => _t('自动播放下一曲')),
        array('auto', 'autoNext'), _t('音乐播放控制'),_t('谷歌浏览器可能会自动播放失败 (浏览器原因)'));
    $form->addInput($musicCtrl->multiMode());

    $siteTime = new Typecho_Widget_Helper_Form_Element_Text('siteTime', NULL, '2019-01-01',
        _t('网站出生时间'), _t('填入日期, 例如 (2019-01-01 00:00:00)'));
    $form->addInput($siteTime);

    $customFooter = new Typecho_Widget_Helper_Form_Element_Text('customFooter', NULL, NULL,
        _t('网站脚自定义文字'), _t('填入一些东西(备案之类的信息..), 也可写入html..\(^o^)/'));
    $form->addInput($customFooter);

    $ftGithub = new Typecho_Widget_Helper_Form_Element_Text('ftGithub', NULL, NULL,
        _t('网站脚联系方式: GitHub'), _t('填入github登录用户名'));
    $form->addInput($ftGithub);

    $ftQQ = new Typecho_Widget_Helper_Form_Element_Text('ftQQ', NULL, NULL,
        _t('网站脚联系方式: QQ'), _t('填入QQ号码'));
    $form->addInput($ftQQ);

    $ftWeibo = new Typecho_Widget_Helper_Form_Element_Text('ftWeibo', NULL, NULL,
        _t('网站脚联系方式: Weibo'), _t('填入微博主页网址Url'));
    $form->addInput($ftWeibo);

    $ftEmail = new Typecho_Widget_Helper_Form_Element_Text('ftEmail', NULL, NULL,
        _t('网站脚联系方式: Email'), _t('填入邮箱'));
    $form->addInput($ftEmail);
}

function themeFields($layout)
{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('card_image',
        NULL, NULL,
        _t('文章顶部图片'),
        _t('在这里填入一个图片URL地址, 以在文章标题后加上背景图片'));
    $layout->addItem($logoUrl);
}

function musicList($list_str)
{
    $result = [];

    $list_str = trim($list_str);
    if (empty($list_str)) {
        return $result;
    }

    $list_arr = explode(',', $list_str);
    foreach ($list_arr as $list_item) {
        $list_item = trim($list_item);
        if (!$list_item) {
            continue;
        }
        $item_info = explode(' ', $list_item);
        if (count($item_info) < 2) {
            continue;
        }

        $result_item['src'] = trim($item_info[0]);
        if (is_numeric($result_item['src'])) {
            $result_item['src'] = 'http://music.163.com/song/media/outer/url?id='.$result_item['src'];
        }
        $result_item['name'] = trim($item_info[1]);
        if (count($item_info) >= 2) {
            $result_item['singer'] = trim($item_info[2]);
        }
        $result[] = $result_item;
    }
    return $result;
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


