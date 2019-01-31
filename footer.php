<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>


<footer id="footer">
    <div class="footer-w">
        <div class="footer-left">
            <?php if ($this->options->ftGithub): ?>
                <a href="https://github.com/<?php echo urlencode($this->options->ftGithub) ?>" target="_blank"
                   class="mdl-button mdl-js-button mdl-button--icon" id="ft-github">
                    <img src="<?php $this->options->themeUrl('image/icon/github.png'); ?>">
                </a>
                <span class="mdl-tooltip mdl-tooltip--top" for="ft-github">Github</span>
            <?php endif; ?>

            <?php if ($this->options->ftQQ): ?>
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo urlencode($this->options->ftQQ) ?>&amp;site=qq&amp;menu=yes"
                   target="_blank"
                   class="mdl-button mdl-js-button mdl-button--icon" id="ft-qq">
                    <img src="<?php $this->options->themeUrl('image/icon/qq.png'); ?>">
                </a>
                <span class="mdl-tooltip mdl-tooltip--top" for="ft-qq">QQ</span>
            <?php endif; ?>

            <?php if ($this->options->ftWeibo): ?>
                <a href="<?php $this->options->ftWeibo(); ?>" target="_blank"
                   class="mdl-button mdl-js-button mdl-button--icon" id="ft-Weibo">
                    <img src="<?php $this->options->themeUrl('image/icon/weibo.png'); ?>">
                </a>
                <span class="mdl-tooltip mdl-tooltip--top" for="ft-Weibo">Weibo</span>
            <?php endif; ?>

            <?php if ($this->options->ftEmail): ?>
                <a href="" target="_self"
                   onclick="window.open('mailto:<?php echo urlencode($this->options->Email) ?>','_self'); return false;"
                   class="mdl-button mdl-js-button mdl-button--icon" id="ft-email">
                    <img src="<?php $this->options->themeUrl('image/icon/mail.png'); ?>">
                </a>
                <span class="mdl-tooltip mdl-tooltip--top" for="ft-email">Email</span>
            <?php endif; ?>
            <!--TODO 如果你需要其他图标, 可以到这下载: https://www.iconfont.cn/-->
        </div>

        <div class="footer-center" style="text-align: center">
            <?php if ($this->options->siteTime): ?>
                本站已生存了 <span id="build-time"></span><br>
            <?php endif; ?>
            <div>
                Copyright © <?php if ($this->options->siteTime):
                    echo substr($this->options->siteTime, 0, 4) . ' - ';
                endif; ?><?php echo date('Y'); ?>
                <a class="mdl-color-text--primary anim-line" style="opacity: 0.9"
                   href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> All rights reserved.
                <?php if ($this->options->customFooter): ?>
                    <br><?php $this->options->customFooter() ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer-right" style="text-align: end">
            Theme <a class="mdl-color-text--primary   anim-line" style="opacity: 0.9"
                     target="_blank" href="https://github.com/mnnyang/typecho_theme_mymaterial">My Material</a><br>
            <?php _e('<a class="mdl-color-text--primary  anim-line" style="opacity:0.9"  
                    target="_blank" href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.
        </div>
    </div>

    <button id="to_top"
            class="mdl-button mdl-js-button mdl-button--mini-fab mdl-button--fab mdl-js-ripple-effect mdl-button--primary hover-shadow--6dp hover--margin-top-1px">
        <i class="material-icons">arrow_upward</i>
    </button>
</footer>
</main>
</div>

<div id="demo-snackbar-example" style="z-index: 1111111" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div><!--snackbar-->

<div id="show-image" style="">
    <div class="inner-flex"></div>
</div>
</body>

<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('material/material.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/jquery.nicescroll.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/jquery.pjax.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/nprogress.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/base.js'); ?>"></script>
<script>

    $(function () {
        <?php if ($this->options->siteTime): ?>
        startTime('<?php $this->options->siteTime();?>');
        <?php endif; ?>

        // $.pjax.defaults.maxCacheLength = 0;
        $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], .no-pjax, .comment-reply a, .cancel-comment-reply-link)', {
            container: '#page-content',
            // fragment: '#page-content',
            timeout: 10000
        });

        $(document).on('submit', '#search,#drawer-search', function (event) {
            event.preventDefault();

            var value = $(this).find('input[name=s]').val();
            value = trim(value);
            if (!value) {
                $.showSnackbar('请输入搜索关键字');
                return;
            }
            $.pjax.submit(event, '#page-content', {timeout: 10000});
        });

        $(document).on('pjax:send', function () {
            NProgress.start();
        });

        $(document).on('pjax:complete', function () {
            NProgress.done();
            $('#mdl-layout-content').scrollTop(0);
        });


        $(document).on('pjax:end', function () {
            $.afterPjax();// 需要第一个执行
            reUpgradePageDem();
            scrollToHash();

            try {
                Prism.highlightAll();
            } catch (e) {
            }
        });

        var scrollToHash = function () {
            if (window.location.hash) {
                var id = window.location.hash.replace('#', "");
                $.gotoAnchorSmooth($('#' + id), 0, 0)
            }
        }
    });

</script>
<script>

</script>

<?php //$this->need('loginDialog.php'); ?>
<?php $this->footer(); ?>
</html>
