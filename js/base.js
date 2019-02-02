/**js太菜,只会面向过程写...*/
var colorBuilder = {
    hslToRgb: function (H, S, L) {
        var R, G, B;
        if (+S === 0) {
            R = G = B = L; // 饱和度为0 为灰色
        } else {
            var hue2Rgb = function (p, q, t) {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1 / 6) return p + (q - p) * 6 * t;
                if (t < 1 / 2) return q;
                if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
                return p;
            };
            var Q = L < 0.5 ? L * (1 + S) : L + S - L * S;
            var P = 2 * L - Q;
            R = hue2Rgb(P, Q, H + 1 / 3);
            G = hue2Rgb(P, Q, H);
            B = hue2Rgb(P, Q, H - 1 / 3);
        }
        return [Math.round(R * 255), Math.round(G * 255), Math.round(B * 255)];
    },

    // 获取随机HSL
    randomHsl: function () {
        var H = Math.random();
        var S = Math.random();
        var L = Math.random();
        return [H, S, L];
    },

    // 获取HSL数组
    getHslArray: function (hslLength) {
        var HSL = [];
        // var hslLength = 16; // 获取数量
        for (var i = 0; i < hslLength; i++) {
            var ret = this.randomHsl();

            // 颜色相邻颜色差异须大于 0.25
            if (i > 0 && Math.abs(ret[0] - HSL[i - 1][0]) < 0.25) {
                i--;
                continue; // 重新获取随机色
            }
            ret[1] = 0.7 + (ret[1] * 0.2); // [0.7 - 0.9] 排除过灰颜色
            ret[2] = 0.4 + (ret[2] * 0.4); // [0.4 - 0.8] 排除过亮过暗色

            // 数据转化到小数点后两位
            ret = ret.map(function (item) {
                return parseFloat(item.toFixed(2));
            });

            HSL.push(ret);
        }
        return HSL;
    }
};

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

    $.showSnackbar = function (msg) {
        var snackbarContainer = document.querySelector('#demo-snackbar-example');
        var data = {
            message: msg,
            timeout: 2000,
        };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
    };

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

    function titleTreeType() {
        if ($('#article-index-w').length) {
            if ($(document).width() < 480) {
                $('#index-button').show();
                $('#article-index-w')
                    .removeClass('article-title-list-w mdl-cell--3-col mdl-cell--hide-phone mdl-cell--2-col-tablet')
                    .addClass('index-card mdl-card mdl-shadow--2dp mdl-cell--hide-desktop mdl-cell--hide-tablet');

                $('.index-card').on('click', function (e) {
                    e.stopPropagation();
                });
                $(document).on('click', function () {
                    $('.index-card').slideUp(200);
                })
            } else {
                $('#index-button').hide();
                $('#article-index-w')
                    .removeClass('index-card mdl-card mdl-shadow--2dp mdl-cell--hide-desktop mdl-cell--hide-tablet')
                    .addClass('article-title-list-w mdl-cell--3-col mdl-cell--hide-phone mdl-cell--2-col-tablet');
            }
        } else {
            $('#index-button').hide();
        }
    }

    function articleTitleTree() {

        titleTreeType();

        var articleTitleList = $('.article-title-list');
        if (articleTitleList.length === 0) return;
        resizeMenuTreeHeight();

        $.titleScrollEnabled = true;
        var innerList = $('.index-menu-list .index-menu-list');
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
            if (!$.titleScrollEnabled) return;
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

        var enabledTimeOut = null;
        $('.index-menu-link').on('click', function (e) {
            e.preventDefault();
            var t = $(this);
            $.titleScrollEnabled = false;
            clearTimeout(enabledTimeOut);

            rmCurrent();
            t.addClass('current');

            innerList.removeClass('open');
            t.parents('.index-menu-list').addClass('open');
            t.parent('.index-menu-item').children('.index-menu-list')
                .addClass('open').stop(false, true).slideDown();
            innerList.not('.open').stop(false, true).slideUp();

            var id = t.attr('href');
            $.gotoAnchorSmooth($(id));
            enabledTimeOut = setTimeout(function () {
                $.titleScrollEnabled = true;
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

    (function () {
        $('#show-image').on('click', function () {
            var $t = $(this);
            $t.animate({'opacity': 0}, 200, function () {
                $t.find('.inner-flex').html('')
                $t.hide();
            })
        })
    })();

    function articleImage() {
        /**zoom article image*/
        $('.article-content img').on('click', function () {
            $('#show-image').css('opacity', '0.0').show();
            $('#show-image .inner-flex').html($(this).clone());
            $('#show-image').animate({'opacity': 1}, 200)
        });
    }

    function articleContentReplace() {
        $('.article-content').each(function () {
            var $t = $(this);
            /**删除文章出现的多余空行*/
            $t.html($t.html().replace(/(<br>){2,}/ig, "<br>"));
            /**a标签block打开*/
            $t.find('a').attr('target', '_block');
            /**包裹table*/
            $t.find('table').wrap('<div class="scroll-bar table-wrap"></div>')
        });
    }

    /**访客地图*/
    function revolvermaps() {
        var revo = $('#revolvermaps');
        if (revo.length && revo.css('display') != 'none') {
            var maps = revo.find('.maps-w');
            if (revo.find('script').length == 0) {// Script is eaten by pjax, fuck...
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = maps.data('src') + '?_dc=' + new Date().getTime();
                script.async = true;
                maps.html(script);
            }

            maps.css('height', revo.width());
        }
    }

    /**index button 按钮事件*/
    (function () {
        $('#index-button').on('click', function (e) {
            var card = $('.index-card');
            if (!card.length) return;
            if (card.css('display') === 'none') {
                card.slideDown(200);
            } else {
                card.slideUp(200);
            }

            e.stopPropagation();
        })
    })();

    /**tag随机颜色*/
    var inittagColor = function () {
        var tagA = $('.tag-wrapper a');
        if (tagA.length) {
            var ca = colorBuilder.getHslArray(tagA.length);
            tagA.each(function (i) {
                var color = 'rgb(' + colorBuilder.hslToRgb(ca[i][0], ca[i][1], ca[i][2]).toString() + ')';
                $(this).css('color', 'white').css('background-color', color);
            });
        }

        tagA = $('.tag-cloud a');
        if (tagA.length) {
            var ca = colorBuilder.getHslArray(tagA.length);
            tagA.each(function (i) {
                var color = 'rgb(' + colorBuilder.hslToRgb(ca[i][0], ca[i][1], ca[i][2]).toString() + ')';
                $(this).css('color', 'white').css('background-color', color);
            });
        }
    };
    inittagColor();

    /**页面resize*/
    $(window).resize(function () {
        resizeMenuTreeHeight();
        revolvermaps();
        titleTreeType();
    });

    headerStatus();
    drawer();
    toTop();
    revolvermaps();

    $mdl_content.niceScroll({
        cursorcolor: "#d0d0d0",
        horizrailenabled: false,
    });

    $('.page-content').bind('resize', function () {
        $mdl_content.getNiceScroll().resize();
        updateMenuIndexTags();
    });

    $.completePjax = function () {
        inittagColor();
    };

    $.afterPjax = function () {
        articleContentReplace();
        articleTitleTree();
        articleImage();
        $.postNear();
        $.pageNav();
        $.commentsAjax();
        revolvermaps();

        $mdl_content.getNiceScroll().resize();

        $('.post-card').bind('resize', function () {
            $mdl_content.getNiceScroll().resize();
        });
    };
    $.afterPjax();

    /**music*/
    (function () {
        var autoOpenList = true;
        var panListWidth = '250px';
        var musicPanelW = $('.music-panel-w');
        var album = $('#music-album');
        var hidePanel = $('.hide-panel');
        var play = $('#music-play');
        var next = $('#music-next');
        var prev = $('#music-prev');
        var volume = $('#music-volume');
        var btnList = $('#music-list');
        var panList = $('.list-panel');
        var listItems = panList.find('li');

        if (listItems.length) {
            $(listItems[0]).addClass('current');
        } else {
            $('#music-panel').hide(300);//没有歌曲,不用初始化,隐藏播放按钮
            return;
        }

        var music = new Audio();
        music.addEventListener('ended', function () {
            toPause();
            if (musicAutoNext) {
                toNext();
            }
        }, false);

        volume.on('click', function () {
            changeVolume();
        });

        play.on('click', function () {
            if (!music.src) {
                music.src = $(listItems[0]).data('src');
                $(listItems[0]).addClass('current');
            }
            music.paused ? toPlay() : toPause();
        });

        next.on('click', function () {
            toNext();
        });
        prev.on('click', function () {
            toPrev();
        });

        listItems.on('click', function () {
            var src = $(this).data('src');
            if (src) {
                music.src = src;
                toPlay();
                listItems.removeClass('current');
                $(this).addClass('current')
            }
        });

        btnList.on('click', function (e) {
            if (panList.css('display') != 'none') {
                panList.animate({'width': '0px'}, 200, function () {
                    panList.hide();
                });
                autoOpenList = true;
            } else {
                panList.show().animate({'width': panListWidth}, 200);
                autoOpenList = false;
            }
        });


        album.on('click', function (e) {
            if (musicPanelW.hasClass('open')) {
                closeMusicPanel();
            } else {
                openMusicPanel();
            }

            //点击其他地方关闭播放板
            $(document).one("click", function () {
                closeMusicPanel();
            });
            musicPanelW.on('click', function (e) {
                e.stopPropagation();
            })
        });

        var changeVolume = function () {
            if (music.muted) {
                music.muted = false;
                volume.find('i').html('volume_up')
            } else {
                music.muted = true;
                volume.find('i').html('volume_off')
            }
        };

        var toPlay = function () {
            if (!music.src) return;
            music.play();
            if (music.paused) return;
            playing(true);
            play.find('i').html('pause_circle_filled');
        };

        var toPause = function () {
            music.pause();
            playing(false);
            play.find('i').html('play_circle_filled');
        };

        var toNext = function () {
            if (listItems.length == 0) {
                $.showSnackbar('没有歌曲 !');
                return;
            }
            var current = $('.list-panel .current');
            if (current.length) {
                var next = current.next('li');
                if (next.length) {
                    toPlayItem(next);
                    return;
                }
            }
            toPlayItem($(listItems[0]))
        };

        var toPrev = function () {
            if (listItems.length == 0) {
                $.showSnackbar('没有歌曲 !');
                return;
            }
            var current = $('.list-panel .current');
            if (current.length) {
                var prev = current.prev('li');
                if (prev.length) {
                    toPlayItem(prev);
                    return;
                }
            }
            toPlayItem($(listItems[listItems.length - 1]))
        };

        var toPlayItem = function ($item) {
            listItems.removeClass('current');
            $item.addClass('current');
            music.src = $item.data('src');
            toPlay();
        };

        var closeMusicPanel = function () {
            if (panList.css('display') != 'none') {
                panList.animate({'width': '0px'}, 200, function () {
                    panList.hide();
                    closeHidePanel();
                })
            } else {
                closeHidePanel();
            }
        };

        var openMusicPanel = function () {
            musicPanelW.addClass('mdl-shadow--2dp open');
            hidePanel.slideDown(200, function () {
                if (!autoOpenList) {
                    panList.show().animate({'width': panListWidth}, 200);
                }
            });
        };

        var closeHidePanel = function () {
            hidePanel.slideUp(200, function () {
                musicPanelW.removeClass('mdl-shadow--2dp open');
            });
        };

        var playing = function (isPlaying) {
            if (isPlaying) album.addClass('playing');
            else album.removeClass('playing');
        };

        /**自动播放*/
        if (musicAutoPlay) {
            setTimeout(function () {
                play.trigger('click')
            }, 5000) //延迟加载
        }
    })();
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