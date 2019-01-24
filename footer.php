<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>


<footer id="footer">
    <div class="footer-w">
        <div class="footer-left">
            <a href="https://github.com/mnnyang" target="_blank"
               class="mdl-button mdl-js-button mdl-button--icon" id="ft-github">
                <img src="<?php $this->options->themeUrl('image/icon/github.png'); ?>">
            </a>

            <span class="mdl-tooltip mdl-tooltip--top" for="ft-github">Github</span>
            <a href="" target="_self" onclick="window.open('mailto:xxyangyoulin@gmail.com','_self'); return false;"
               class="mdl-button mdl-js-button mdl-button--icon" id="ft-email">
                <img src="<?php $this->options->themeUrl('image/icon/mail.png'); ?>">
            </a>

            <span class="mdl-tooltip mdl-tooltip--top" for="ft-email">Email</span>
<!--            <a href="" target="_blank" class="mdl-button mdl-js-button mdl-button--icon" id="ft-weibo">-->
<!--                <img src="--><?php //$this->options->themeUrl('image/icon/weibo.png'); ?><!--">-->
<!--            </a>-->
<!--            <span class="mdl-tooltip mdl-tooltip--top" for="ft-weibo">微博</span>-->
        </div>

        <div class="footer-center" style="text-align: center">
            本站已生存了 <span id="build-time"></span><br>
            <div>
                Copyright © <?php echo date('Y'); ?>
                <a class="mdl-color-text--primary anim-line" style="opacity: 0.9"
                   href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> All rights reserved.
            </div>
        </div>

        <div class="footer-right" style="text-align: end">
            Theme <a class="mdl-color-text--primary   anim-line" style="opacity: 0.9" href="#">My Material</a> <br>
            <?php _e('<a class="mdl-color-text--primary  anim-line" style="opacity: 0.9"  target="_blank" href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>
            .
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
</body>

<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('material/material.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/jquery.nicescroll.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/jquery.pjax.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/nprogress.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/base.js'); ?>"></script>
<script>

    $(function () {
        startTime(<?php getStartTime();?>);
    });

    // $.pjax.defaults.maxCacheLength = 0;
    $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], .no-pjax, .comment-reply a, .cancel-comment-reply-link)', {
        container: '#page-content',
        fragment: '#page-content',
        timeout: 8000
    });

    $(document).on('pjax:send', function () {
        NProgress.start();
    });

    $(document).on('pjax:complete', function () {
        NProgress.done();
        $('#mdl-layout-content').scrollTop(0);
    });

    $(document).on('pjax:end', function () {
        console.log("end");
        $.afterPjax();
        Prism.highlightAll();

        if (window.location.hash) {
            var id = window.location.hash.replace('#', "");
            $.gotoAnchorSmooth($('#' + id), 0, 0)
        }
    });

    setInterval(function () {
        componentHandler.upgradeDom();
    }, 1000);

</script>
<?php $this->need('loginDialog.php'); ?>
<?php $this->footer(); ?>
</html>
