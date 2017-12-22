<?php
/**
 *
 * 页面
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.1.0
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="main" role="main">
    <div class="container">
        <article class="card post single page-<?php $this->slug();?>" itemscope itemtype="http://schema.org/BlogPosting">
            <div id="post-content" class="post__content" itemprop="articleBody">
                <?php echo getContent($this->content); ?>
            </div>
        </article>
        <?php $this->need('comments.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>
