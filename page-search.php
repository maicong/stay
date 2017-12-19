<?php
/**
 *
 * 搜索
 *
 * @package custom
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.0.0
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="main" role="main">
    <div class="container">
        <form class="card page__search" method="post" action="./" role="search">
            <input type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" pattern=".+" required />
            <button type="submit" class="submit"><?php _e('搜索'); ?></button>
        </form>
    </div>
</main>
<?php $this->need('footer.php'); ?>
