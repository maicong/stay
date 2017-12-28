<?php
/**
 *
 * 页脚
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.3.1
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer__copyright">
            &copy; <?php echo date('Y'); ?> v1.3.1 <a href="https://github.com/maicong/stay" target="_blank">Theme Stay</a> <small>@</small> <a href="https://maicong.me" target="_blank">MaiCong</a> <small>❤</small> <a href="http://www.typecho.org" target="_blank">Typecho</a>
        </div>
        <div id="footer-beaker" class="footer__beaker"><span></span></div>
    </div>
</footer>
<script src="<?php buildFile('js'); ?>"></script>
<?php if ($this->options->analyticsCode): ?>
<div style="display:none"><?php $this->options->analyticsCode(); ?></div>
<?php endif; ?>
<?php $this->footer(); ?>
</body>
</html>
