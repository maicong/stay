<?php
/**
 *
 * 文章
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.5.7
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 获取音频地址
if ($this->request->isAjax() && $this->request->is('do=getSpeech')) {
    $this->response->throwJson([
        'data' => text2speech($this->cid)
    ]);
}

$halfyear = 3600 * 24 * 30 * 6;
$lostTime = time() - $this->modified;

$this->need('header.php');
?>
<main class="main" role="main">
    <div class="container">
        <article class="card post single" itemscope itemtype="http://schema.org/BlogPosting">
            <?php if (time() - $this->modified > $halfyear): ?>
            <div class="post-warning">
                <p>这篇文章距离上次修改已过半年，其中的信息可能已经有所发展或是发生改变。</p>
            </div>
            <?php endif; ?>
            <?php if ($this->options->text2speech): ?>
            <div id="post-text2speech" class="post__text2speech">
                <i class="speechicon"></i>
                <span id="post-text2speech-text" class="text">转换为语音并朗读全文</span>
                <span id="post-text2speech-time" class="time">00:00 / 00:00</span>
                <span id="post-text2speech-progress" class="progress"></span>
            </div>
            <?php endif; ?>
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
