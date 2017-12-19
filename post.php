<?php
/**
 *
 * 文章
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
        <article class="card post single" itemscope itemtype="http://schema.org/BlogPosting">
            <div id="post-content" class="post__content" itemprop="articleBody">
                <?php getContent($this->content);?>
            </div>
            <div class="post__tags" itemprop="keywords"><?php $this->tags(' ', true, ''); ?></div>
        </article>
        <section class="near">
            <div class="near__prev"><?php $this->thePrev('<span>&laquo;</span> %s','&laquo; 没有了'); ?></div>
            <div class="near__next"><?php $this->theNext('%s &raquo;','没有了 <span>&raquo;</span>'); ?></div>
        </section>
        <?php $this->need('comments.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>
