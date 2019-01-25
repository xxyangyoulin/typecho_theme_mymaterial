(function ($, h, c) {
    var a = $([]),
        e = $.resize = $.extend($.resize, {}),
        i,
        k = "setTimeout",
        j = "resize",
        d = j + "-special-event",
        b = "delay",
        f = "throttleWindow";
    e[b] = 250;
    e[f] = true;
    $.event.special[j] = {
        setup: function () {
            if (!e[f] && this[k]) {
                return false;
            }
            var l = $(this);
            a = a.add(l);
            $.data(this, d, {
                w: l.width(),
                h: l.height()
            });
            if (a.length === 1) {
                g();
            }
        },
        teardown: function () {
            if (!e[f] && this[k]) {
                return false;
            }
            var l = $(this);
            a = a.not(l);
            l.removeData(d);
            if (!a.length) {
                clearTimeout(i);
            }
        },
        add: function (l) {
            if (!e[f] && this[k]) {
                return false;
            }
            var n;

            function m(s, o, p) {
                var q = $(this),
                    r = $.data(this, d);
                r.w = o !== c ? o : q.width();
                r.h = p !== c ? p : q.height();
                n.apply(this, arguments);
            }

            if ($.isFunction(l)) {
                n = l;
                return m;
            } else {
                n = l.handler;
                l.handler = m;
            }
        }
    };

    function g() {
        i = h[k](function () {
                a.each(function () {
                    var n = $(this),
                        m = n.width(),
                        l = n.height(),
                        o = $.data(this, d);
                    if (m !== o.w || l !== o.h) {
                        n.trigger(j, [o.w = m, o.h = l]);
                    }
                });
                g();
            },
            e[b]);
    }
})(jQuery, this);

function trim(str) {
    if (str == null) {
        str = "";
    }
    return str.replace(/(^\s*)|(\s*$)/g, "");
}

var shareWeibo = function (title, url, pics = '') {
    var share_str = 'http://v.t.sina.com.cn/share/share.php?' +
        'title=' + title
        + '&url=' + url
        + '&content=utf-8' +
        '&sourceUrl=' + url
        + '&pic=' + pics;

    window.open(share_str, 'newwindow', 'height=400,width=400,top=100,left=100');
};

var buildTimeout, startTimeV;

function startTime(time = '2010-01-01') {
    startTimeV = time;
    var $time = new Date().getTime() - new Date(startTimeV);
    if ($time < 0) return '0秒';

    let result = '';
    if ($time >= 365 * 86400000) {
        result += parseInt($time / (365 * 86400000)) + '年';
        $time = ($time % (365 * 86400000));
    }
    if ($time >= 86400000) {
        result += parseInt($time / 86400000) + '天';
        $time = ($time % 86400000);
    }
    if ($time >= 3600000) {
        result += parseInt($time / 3600000) + '小时';
        $time = ($time % 3600000);
    }
    if ($time >= 60000) {
        result += parseInt($time / 60000) + '分';
        $time = ($time % 60000);
    }
    result += parseInt($time / 1000) + '秒';
    $('#build-time').html(result);
    buildTimeout = setTimeout('startTime(startTimeV)', 1000)
}

function resizeMenuTreeHeight() {
    $('.article-title-list').css('max-height', ($(window).height() - 200) + 'px');
}

$(function () {
    let $main_header = $('header');
    let $main_last_top = 0;
    let $mdl_content = $(".mdl-layout__content"), $drawer = $('#drawer');
    let drawVisibleClass = 'is-visible';
    let drawerMenu = $('.menu-list');
    let menuSwitch = $('.menu-switch');

    $.gotoAnchorSmooth = function ($target, offset = 0, time = 300) {
        if ($target instanceof $ && $target.length) {
            $mdl_content.animate({scrollTop: $target.offset().top + $mdl_content.scrollTop() + offset}, time);
        }
    };


    function scrollTopValue() {
        return $mdl_content.scrollTop();
    }

    $.closeDrawer = function () {
        $drawer.removeClass(drawVisibleClass);
        $('.mdl-layout__obfuscator').removeClass(drawVisibleClass)
    };

    function openDrawer() {
        $drawer.addClass(drawVisibleClass);
        $('.mdl-layout__obfuscator').addClass(drawVisibleClass)
    }

    function headerStatus() {
        $mdl_content.scroll(function () {
            let nScrollTop = $(this)[0].scrollTop;

            if (nScrollTop > 120 && nScrollTop > $main_last_top) {
                $main_header.addClass('main-header-close');

            } else if (nScrollTop < $main_last_top
                && $main_header.hasClass('main-header-close')) {
                $main_header.removeClass('main-header-close')
            } else if (nScrollTop <= 120) {
                $main_header.removeClass('main-header-close');
            }
            $main_last_top = nScrollTop;
        });

        $('.my-drawer-button').on('click', function () {
            if ($drawer.hasClass(drawVisibleClass)) {
                $.closeDrawer();
            } else {
                openDrawer();
            }
        });
    }

    let menu_index_tags;

    function updateMenuIndexTags() {
        // tags of article title
        menu_index_tags = $('.menu-target-fix');
        var topOffset = scrollTopValue();
        for (let i = 0; i < menu_index_tags.length; i++) {
            menu_index_tags[i].topHeight = $(menu_index_tags[i]).offset().top + topOffset;
            menu_index_tags[i].id = $(menu_index_tags[i]).attr('id');
        }
    }

    function search(start, end, findValue) {
        if (menu_index_tags.length === 0) return null;
        if (end - start <= 1) {
            if (menu_index_tags[end].topHeight < findValue) {
                return menu_index_tags[end];
            }
            return menu_index_tags[start];
        }

        if (start < end) {
            var middleIndex = parseInt((start + end) / 2);
            var middleValue = menu_index_tags[middleIndex].topHeight;
            if (findValue < middleValue) {
                end = middleIndex;
            } else if (findValue > middleValue) {
                start = middleIndex
            } else {
                return menu_index_tags[middleIndex];
            }
            return search(start, end, findValue)
        }
    }

    function articleTitleTree() {
        var articleTitleList = $('.article-title-list');
        if (articleTitleList.length === 0) return;
        resizeMenuTreeHeight();

        var enabled = true, innerList = $('.index-menu-list .index-menu-list');
        updateMenuIndexTags();

        function currentItem() {
            return articleTitleList.find('.current')
        }

        function rmCurrent() {
            let current = currentItem();
            if (current.length) {
                current.removeClass('current');
            }
        }

        $mdl_content.scroll(function () {
            if (!enabled) return;
            let res = search(0, menu_index_tags.length - 1, scrollTopValue());
            if (!res) return;
            rmCurrent();

            let current = articleTitleList.find('a[href="#' + res.id + '"]');
            //current is a elements
            if (!current.hasClass('current')) {
                current.addClass('current');
                innerList.removeClass('open');
                current.parents('.index-menu-list').addClass('open').slideDown();
                current.next('.index-menu-list').addClass('open').slideDown();
                innerList.not('.open').slideUp();
            }

            titleToShow(current.parent())
        });

        $('.index-menu-link').on('click', function () {
            var t = $(this);
            enabled = false;
            rmCurrent();
            t.addClass('current');

            innerList.removeClass('open');
            t.parents('.index-menu-list').addClass('open');
            t.parent('.index-menu-item').children('.index-menu-list')
                .addClass('open').stop(false, true).slideDown();
            innerList.not('.open').stop(false, true).slideUp();

            setTimeout(function () {
                enabled = true;
            }, 1000);
        });

        let firstItem = $(".index-menu  .index-menu-item")[0], indexMenu = $('.index-menu');

        function titleToShow($obj) {
            if (articleTitleList.height() >= indexMenu.height()) return;

            var currentTop = currentItem().parent()[0].getBoundingClientRect().top;
            var firstTop = firstItem.getBoundingClientRect().top;

            articleTitleList.stop().animate({scrollTop: currentTop - firstTop - $obj.height()}, 300);
        }
    }

    /**drawer menu control*/
    function drawer() {
        if (drawerMenu.length) {
            menuSwitch.on('click', function () {
                let $t = $(this).is('a') ? $(this) : $(this).parent('a');
                let pLi = $t.parent('li');
                let subList = $t.next('.menu-sub-list');

                menuSwitch.on('click', function (e) {
                    return false;
                });

                if (pLi.hasClass('open')) {
                    pLi.removeClass('open');
                    subList.stop(false, true).slideUp(200);
                } else {
                    drawerMenu.find('.open').not($t.parents('.open')[0]).removeClass('open')
                        .find(' .menu-sub-list').stop(false, true).slideUp(200);

                    pLi.addClass('open');
                    subList.stop(false, true).slideDown(200);
                }
            })
        }
        //close drawer
        $('.close-drawer').on('click', function () {
            $.closeDrawer();
        })
    }

    /**material color class*/
    $.pageNav = function () {
        let pageNavCur = $('.page-navigator .current a');
        if (pageNavCur.length) {
            pageNavCur.addClass('mdl-color--primary')
        }
        let pageNavItem = $('.page-navigator li:not(.current) a');
        if (pageNavItem) {
            pageNavItem.addClass('mdl-color-text--primary')
        }
    };

    /**to_top*/
    function toTop() {
        let toTop = $("#to_top"), footer = $('footer'), fixedBottom = 68;

        if (toTop.length) {
            toTop.click(function () {
                $mdl_content.animate({scrollTop: 0}, 200);
            });
            $mdl_content.scroll(function () {
                let footerBottom = footer.offset().top - $(window).height();

                if (-footerBottom > fixedBottom) {
                    toTop.removeClass('fixed')
                } else {
                    toTop.addClass('fixed')
                }
                init();
            });

            function init() {
                var scroll_top = $mdl_content.scrollTop();
                if (scroll_top > 300) {
                    toTop.removeClass('hide');
                } else {
                    toTop.addClass('hide')
                }
            }

            init();
        }
    }

    /**post-near 没找到 post-near 的直接打印链接地址的api，所以...*/
    $.postNear = function () {
        let $postNear = $('.post-near');
        if ($postNear.length) {
            let pls = $postNear.children('li');
            pls.each(function () {
                let t = $(this);
                let a = t.children('a');
                if (a.length) {
                    t.addClass('enabled');
                }
            })
        }
    };

    function articleImage() {
        /**zoom article image*/
        $('#article-content img').on('click', function () {
            let $t = $(this);
            $t.toggleClass('show')
        });
    }

    /**删除文章出现的多余空行*/
    function articleDelMoreBr() {
        $('.article-content').each(function () {
            $(this).html($(this).html().replace(/(<br>){2,}/ig, "<br>"));
        });
    }

    /**页面resize*/
    $(window).resize(function () {
        resizeMenuTreeHeight();
    });

    headerStatus();
    drawer();
    toTop();

    $mdl_content.niceScroll({
        cursorcolor: "#d0d0d0",
        horizrailenabled: false,
    });

    $('.page-content').bind('resize', function () {
        $mdl_content.getNiceScroll().resize();
        updateMenuIndexTags();
    });

    $.afterPjax = function () {
        $.postNear();
        $.pageNav();
        articleTitleTree();
        articleImage();
        articleDelMoreBr();
        $.commentsAjax();

        $mdl_content.getNiceScroll().resize();
    };

    $.afterPjax();
});


$.commentsAjax = function () {
    restNoPjaxClass();
    $.doingSubmit = false;/*提交控制重置*/

    $('#comment-form').submit(function (event) {
        if (doing()) return false;

        event.preventDefault();
        var isReply = false, subData = $(this).serializeArray();

        $.each(subData, function (i, field) {
            if (field.name == 'parent') {
                isReply = true;
            }
        });

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: subData,
            error: function () {
                done();
                $.showSnackbar('提交失败！')
            },
            success: function (data) {
                done();

                if (!$('#comments', data).length) {
                    $.showSnackbar("提交失败,可能输入内容不符合规则！");
                    return false;
                }

                $.showSnackbar('评论成功!');

                var maxId = $('#comments', data).html().match(/id="?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) {
                    return a - b
                }).pop();

                if ($('.page-navigator li').length === 0 //没有分页
                    || $('.page-navigator .prev').length === 0 //在第一页
                    || isReply) {//是回复
                    $('#comments').html($('#comments', data).html());
                    reUpgradePageDem();/*评论区的内容全部替换了,所以刷洗一下MDL输入框组件*/
                    $.pageNav();
                    $.commentsAjax();

                    $('#mdl-layout-content').animate({
                        scrollTop: $('li[id=li-comment-' + maxId + ']').offset().top + $('#mdl-layout-content').scrollTop()
                    }, 300);

                    return;
                }

                //跳转到第一页 TODO 如果最新评论在最后一页需修改
                var firstPage = $('#comments .page-navigator .prev').next().find('a');
                firstPage.trigger('click');
            }
        });
    });

    function doing() {
        if ($.doingSubmit) return true;
        $.doingSubmit = true;
        $('#comment-form button[type=submit]').addClass('submit-loading')
            .find('.material-icons').html('toys');
        return false;
    }

    function done() {
        $.doingSubmit = false;
        $('#comment-form button[type=submit]').removeClass('submit-loading')
            .find('.material-icons').html('check');
    }
};

function restNoPjaxClass() {
    $('.comment-reply a, .cancel-comment-reply-link').addClass("no-pjax");
}

/**重新刷新pge-content下的mdl组件功能.*/
function reUpgradePageDem() {
    var page = $('#page-content');
    page.find('*[class^=mdl]').removeClass('is-upgraded').removeAttr("data-upgraded");
    page.find('.mdl-menu__item-ripple-container').remove();
    page.find('.mdl-js-ripple-effect--ignore-events').removeClass('mdl-js-ripple-effect--ignore-events');

    var mdl_menu_container = page.find('.mdl-menu__container');
    mdl_menu_container.each(function () {
        $(this).after($(this).html());
        $(this).remove()
    });

    componentHandler.upgradeDom();
}

$.showSnackbar = function (msg) {
    var snackbarContainer = document.querySelector('#demo-snackbar-example');
    var data = {
        message: msg,
        timeout: 2000,
    };
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
};