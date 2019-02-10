<div class="contact-wrap" style="position: absolute;right: 16px; bottom: -20px;z-index: 1">
    <?php if ($this->options->ftGithub): ?>
    <a href="https://github.com/<?php echo urlencode($this->options->ftGithub) ?>" target="_blank"
       class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"
       id="contact-ft-github"><img style="width: 24px;height: 24px;"
                                   src="<?php $this->options->themeUrl('image/icon/github.png'); ?>"></a>
    <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-github">Github</span>
    <?php endif; ?>
    <?php if ($this->options->ftWeibo): ?>
    <a href="<?php $this->options->ftWeibo(); ?>" target="_blank"
       class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"
       id="contact-ft-Weibo">
        <img src="<?php $this->options->themeUrl('image/icon/weibo.png'); ?>">
    </a>
    <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-Weibo">Weibo</span>
    <?php endif; ?>
    <?php if ($this->options->ftQQ): ?>
    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo urlencode($this->options->ftQQ) ?>&amp;site=qq&amp;menu=yes"
       target="_blank"
       class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"
       id="contact-ft-qq">
        <img src="<?php $this->options->themeUrl('image/icon/qq.png'); ?>">
    </a>
    <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-qq">QQ</span>
    <?php endif; ?>
    <?php if ($this->options->ftEmail): ?>
    <a href="" target="_self"
       onclick="window.open('mailto:<?php echo urlencode($this->options->Email) ?>','_self'); return false;"
       class="mdl-button mdl-js-button mdl-button--fab hover--margin-top-1px hover-shadow--6dp mdl-button--mini-fab mdl-js-ripple-effect"
       id="contact-ft-email">
        <img src="<?php $this->options->themeUrl('image/icon/mail.png'); ?>">
    </a>
    <span class="mdl-tooltip mdl-tooltip--top" for="contact-ft-email">Email</span>
    <?php endif; ?>
    <!--TODO 如果你需要其他图标, 可以到这下载: https://www.iconfont.cn/-->
</div>