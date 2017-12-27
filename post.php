<?php
/**
 *
 * 文章
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.3.0
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="main" role="main">
    <div class="container">
        <article class="card post single" itemscope itemtype="http://schema.org/BlogPosting">
            <div id="post-content" class="post__content" itemprop="articleBody">
                <?php echo getContent($this->content); ?>
            </div>
            <?php if ($this->options->openDonate): ?>
            <div class="post__donate">
                <button id="post-donate-btn" class="post__donate__btn">打赏/DONATE</button>
                <div id="post-donate-list" class="post__donate__list">
                    <?php if ($this->options->donateTips): ?>
                    <p class="tips"><?php $this->options->donateTips(); ?></p>
                    <?php endif; ?>
                    <div class="qrcode">
                        <?php if ($this->options->donateWeixin): ?>
                        <div class="qrcode__item">
                            <img class="card" src="<?php $this->options->donateWeixin(); ?>" alt="微信">
                            <p>微信</p>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->options->donateAlipay): ?>
                        <div class="qrcode__item">
                            <img class="card" src="<?php $this->options->donateAlipay(); ?>" alt="支付宝">
                            <p>支付宝</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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
