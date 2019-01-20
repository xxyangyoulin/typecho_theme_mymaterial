var cookie = {
    set: function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },
    get: function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i].trim();
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    delete: function (key) {
    }
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


let closeDrawer, openDrawer;
$(function () {
    let $main_header = $('header');
    let $main_last_top = 0;
    let $mdl_content = $(".mdl-layout__content"), $drawer = $('#drawer');
    let drawVisibleClass = 'is-visible';
    let drawerMenu = $('.menu-list');
    let menuSwitch = $('.menu-switch');

    closeDrawer = function () {
        $drawer.removeClass(drawVisibleClass);
        $('.mdl-layout__obfuscator').removeClass(drawVisibleClass)
    };

    openDrawer = function () {
        $drawer.addClass(drawVisibleClass);
        $('.mdl-layout__obfuscator').addClass(drawVisibleClass)
    };

    $mdl_content.niceScroll({
        cursorcolor: "#bebebe",
    });

    $mdl_content.scroll(function () {
        // let nScrollHight = $(this)[0].scrollHeight;
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
            closeDrawer();
        } else {
            openDrawer();
        }
    });

    function scrollTopValue() {
        return $mdl_content.scrollTop();
    }

    let article_menu_l = $('.article-title-list');
    if (article_menu_l.length) {
        article_menu_l.css('max-height', ($(window).height() - 200) + 'px');

        let menu_index_tags = $('.menu-target-fix');

        for (let i = 0; i < menu_index_tags.length; i++) {
            menu_index_tags[i].topHeight = $(menu_index_tags[i]).offset().top;
            menu_index_tags[i].id = $(menu_index_tags[i]).attr('id');
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

        function rmCurrent() {
            let current = $('.article-title-list .current');
            if (current.length) {
                current.removeClass('current');
            }
        }

        let enabled = true;
        $mdl_content.scroll(function () {
            if (!enabled) return;
            let res = search(0, menu_index_tags.length - 1, scrollTopValue() + 200);
            if (!res) return;
            rmCurrent();

            let current = $('.article-title-list a[href="#' + res.id + '"]');

            if (!current.hasClass('current')) {
                current.addClass('current');
                $('.index-menu-list .index-menu-list').removeClass('open');
                current.parents('.index-menu-list').addClass('open').stop(false, true).slideDown();
                $('.index-menu-list .index-menu-list').not('.open').stop(false, true).slideUp();
            }
        });

        $('.index-menu-link').on('click', function () {
            var t = $(this);
            enabled = false;
            rmCurrent();
            t.addClass('current');

            $('.index-menu-list .index-menu-list').removeClass('open');
            t.parents('.index-menu-list').addClass('open');
            t.parent('.index-menu-item').children('.index-menu-list')
                .addClass('open').stop(false, true).slideDown();
            $('.index-menu-list .index-menu-list').not('.open').stop(false, true).slideUp();

            setTimeout(function () {
                enabled = true;
            }, 500);
        })
    }

    /**drawer menu control*/
    if (drawerMenu.length) {
        menuSwitch.on('click', function () {
            let $t = $(this), pLi = $t.parent('li');
            let subList = $t.next('.menu-sub-list');

            if (pLi.hasClass('open')) {
                pLi.removeClass('open');
                subList.slideUp(200);
            } else {
                drawerMenu.find('.open').removeClass('open').find(' .menu-sub-list').slideUp(200);
                pLi.addClass('open');
                subList.slideDown(200);
            }
        })
    }

    /**post-near 没找到 post-near 的直接打印链接地址的api，所以...*/
    let $postNear = $('.post-near');
    if ($postNear.length) {
        let pls = $postNear.children('li');
        console.log(pls);
        pls.each(function () {
            let t = $(this);
            let a = t.children('a');
            if (a.length) {

                t.addClass('enabled');
                a.click(function (e) {
                    e.stopPropagation();
                });

                t.on('click', function () {
                    a[0].click();
                });
            }
        })
    }

    /**material color class*/
    let pageNavCur = $('.page-navigator .current a');
    if (pageNavCur.length) {
        pageNavCur.addClass('mdl-color--primary')
    }
    let pageNavItem = $('.page-navigator li:not(.current) a');
    if (pageNavItem) {
        pageNavItem.addClass('mdl-color-text--primary')
    }

    /**to_top*/
    let toTop = $("#to_top"), footer = $('footer'), fixedBottom = 48 + 20;

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


});