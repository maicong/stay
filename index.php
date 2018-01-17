<?php
/**
 * 麦葱以 Typecho 为平台打造的一款响应式主题
 * 　
 * <b>最新版本: </b>
 * <a href="https://github.com/maicong/stay/releases"><img src="https://img.shields.io/github/release/maicong/stay.svg?style=flat-square"></a>
 *
 * @package Stay
 * @author MaiCong
 * @version 1.4.3
 * @link http://maicong.me
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="main" role="main">
    <div id="post-list" class="container">
        <?php if ($this->_currentPage > 1): ?>
            <div id="__newpage"></div>
        <?php endif; ?>
        <?php if ($this->have()): ?>
        <?php while($this->next()): ?>
        <article class="card post" itemscope itemtype="http://schema.org/BlogPosting">
            <header class="card post__header<?php if (!getFields($this, 'thumbnail')): ?> post__no__thumb<?php endif; ?>">
                <?php if (getFields($this, 'thumbnail')): ?>
                    <a href="<?php $this->permalink(); ?>" class="post__thumb">
                    <img src="<?php echo __LAZYIMG__; ?>" data-original="<?php echo getFields($this, 'thumbnail'); ?>" alt="<?php $this->title(); ?>">
                    </a>
                <?php endif; ?>
                <div class="post__header__warpper">
                    <div class="post__meta">
                        <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                        <span>/</span>
                        <?php $this->category(','); ?>
                        <span>/</span>
                        <a href="<?php $this->author->permalink(); ?>" itemprop="name author" itemscope itemtype="http://schema.org/Person"><?php $this->author(); ?></a>
                        <span>/</span>
                        <a href="<?php $this->permalink() ?>#comments" itemprop="interactionCount discussionUrl"><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></a>
                    </div>
                    <div class="post__title" itemprop="name headline">
                        <a href="<?php $this->permalink() ?>" itemtype="url">
                            <?php $this->title() ?>
                        </a>
                    </div>
                </div>
            </header>
            <div class="post__content" itemprop="articleBody">
                <p class="summary"><?php echo getExcerpt($this->excerpt); ?></p>
            </div>
        </article>
        <?php endwhile; ?>
        <?php else: ?>
        <article class="card post no-post">
            <h2 class="post-title">此页文章还在娘胎中，请等候些许时日</h2>
        </article>
        <?php endif; ?>
        <section id="load__more" class="post__more" data-type="posts">
            <?php $this->pageLink('加载更多', 'next'); ?>
        </section>
    </div>
</main>
<?php $this->need('footer.php'); ?>
