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
        <div class="page__404">
            <h2 class="not__title">404</h2>
            <p class="not__content">没错，你要查看的页面被我吃了</p>
        </div>
    </div>
</main>
<?php $this->need('footer.php'); ?>
