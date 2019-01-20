<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>


<footer id="footer">
    <div class="footer-w">
        <div class="footer-left">
            <button class="mdl-button mdl-js-button mdl-button--icon" id="ft-github">
                <img src="<?php $this->options->themeUrl('image/icon/github.png'); ?>">
            </button>
            <span class="mdl-tooltip mdl-tooltip--top" for="ft-github">Github</span>
            <button class="mdl-button mdl-js-button mdl-button--icon" id="ft-email">
                <img src="<?php $this->options->themeUrl('image/icon/mail.png'); ?>">
            </button>
            <span class="mdl-tooltip mdl-tooltip--top" for="ft-email">Email</span>
            <button class="mdl-button mdl-js-button mdl-button--icon" id="ft-weibo">
                <img src="<?php $this->options->themeUrl('image/icon/weibo.png'); ?>">
            </button>
            <span class="mdl-tooltip mdl-tooltip--top" for="ft-weibo">微博</span>
        </div>

        <div class="footer-center" style="text-align: center">
            本站已生存了 <span id="build-time"></span><br>
            <div>
                Copyright © <?php echo date('Y'); ?>
                <a class="mdl-color-text--primary anim-line"  style="opacity: 0.9"
                   href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> All rights reserved.
            </div>
        </div>

        <div class="footer-right" style="text-align: end">
            Theme <a class="mdl-color-text--primary   anim-line" style="opacity: 0.9"  href="#">My Material</a> <br>
            <?php _e('<a class="mdl-color-text--primary  anim-line" style="opacity: 0.9"  target="_blank" href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.
        </div>
    </div>

    <button id="to_top"
            class="mdl-button mdl-js-button mdl-button--mini-fab mdl-button--fab mdl-js-ripple-effect mdl-button--primary">
        <i class="material-icons">arrow_upward</i>
    </button>
</footer>
</main>
</div>
</body>

<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('material/material.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/jquery.nicescroll.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/base.js'); ?>"></script>
<script>
    $(function () {
        startTime(<?php getStartTime();?>);
    })
</script>

<?php $this->need('loginDialog.php'); ?>
<?php $this->footer(); ?>
</html>
