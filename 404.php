<?php
/**
 *
 * 404 错误页
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.0.0
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="main">
    <div class="container">
        <div class="card page__404">
            <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
            </form>
        </div>
    </div>
</main>
<?php $this->need('footer.php'); ?>
