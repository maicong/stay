<?php
/**
 *
 * 页头
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.4.3
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 页码
$page_title = ($this->_currentPage > 1 && !$this->is('single')) ? sprintf(' - 第 %s 页', $this->_currentPage) : ($this->parameter->type === 'comment_page' ? sprintf(' - 评论第 %s 页', $this->request->commentPage) : '');
?>
<!DOCTYPE html>
<html prefix="og:http://ogp.me/ns#">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('搜索: %s'),
            'tag'       =>  _t('标签: %s'),
            'author'    =>  _t('作者: %s')
        ), '', ' - '); ?><?php $this->options->title(); ?><?php echo $page_title; ?></title>
    <meta name="keywords" content="<?php _e($this->_keywords); ?>">
    <meta name="description" content="<?php echo $this->is('index') ? $this->options->description : getExcerpt($this->content, 200); ?>">
    <meta name="author" content="MaiCong (maicong.me)">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="application-name" content="<?php $this->options->title() ?>">
    <meta name="apple-mobile-web-app-title" content="<?php $this->options->title() ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="respond-hash" content="<?php echo $this->security->getToken($this->request->getRequestUrl()); ?>">
<?php if ($this->is('post')): ?>
    <meta property="og:type" content="blog">
    <meta property="og:site_name" content="<?php echo parse_url($this->options->siteUrl)['host']; ?>">
    <meta property="og:title" content="<?php $this->title(); ?> - <?php $this->options->title(); ?>">
    <meta property="og:url" content="<?php $this->permalink(); ?>">
    <meta property="og:description" content="<?php echo getExcerpt($this->content, 200); ?>">
    <meta property="og:author" content="<?php $this->author(); ?>">
    <meta property="og:image" content="<?php echo getFields($this, 'thumbnail'); ?>">
    <meta property="og:release_date" content="<?php $this->date('c'); ?>">
    <meta property="article:published_time" content="<?php $this->date('c'); ?>">
    <meta property="article:author" content="<?php $this->author(); ?>">
    <meta property="article:published_first" content="<?php $this->permalink(); ?>">
    <meta itemprop="name" content="<?php $this->title(); ?> - <?php $this->options->title(); ?>">
    <meta itemprop="description" content="<?php echo getExcerpt($this->content, 200); ?>">
    <meta itemprop="image" content="<?php echo getFields($this, 'thumbnail'); ?>">
    <meta itemprop="url" content="<?php $this->permalink(); ?>">
    <link rel="canonical" href="<?php $this->permalink(); ?>">
<?php endif; ?>
    <link rel="stylesheet" href="<?php getBuildFile('css'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php _e($this->_feedUrl); ?>">
    <link rel="alternate" type="application/rdf+xml" title="RSS 1.0" href="<?php _e($this->_feedRssUrl); ?>">
    <link rel="alternate" type="application/atom+xml" title="ATOM 1.0" href="<?php _e($this->_feedAtomUrl); ?>">
    <?php if ($this->options->customHead): ?>
    <?php $this->options->customHead(); ?>
    <?php endif; ?>
</head>
<body<?php if ($this->options->siteStyle): echo " class=\"stay-{$this->options->siteStyle}\""; endif; ?>>
<!--[if lte IE 9]>
    <script type="text/javascript">
        document.body.innerHTML='';
        document.body.style.fontSize='22px';
        document.body.style.background='#000';
        alert('\u4e0d\u652f\u6301\u7684\u6d4f\u89c8\u5668\u7248\u672c\uff01\u518d\u89c1\uff01');
        window.open('','_self','');
        window.close();
    </script>
<![endif]-->

<header class="header" <?php if ($this->options->headBgUrl): echo "style=\"background-image:url({$this->options->headBgUrl})\""; endif; ?>>
    <div class="container" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="header__title" itemprop="name headline">
            <?php if ($this->is('index')): ?>
                <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
            <?php elseif ($this->is('archive')): ?>
                <?php $this->archiveTitle(array(
                    'category'  =>  _t('%s'),
                    'search'    =>  _t('搜索: %s'),
                    'tag'       =>  _t('标签: %s'),
                    'author'    =>  _t('作者: %s')
                ), '', ''); ?>
            <?php else: ?>
                <a href="<?php $this->permalink() ?>" itemtype="url"><?php $this->title() ?></a>
            <?php endif; ?>
        </h1>
        <?php if ($this->is('post')): ?>
            <div class="header__meta">
                <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                <span>/</span>
                <?php $this->category(','); ?>
                <span>/</span>
                <a href="<?php $this->author->permalink(); ?>" itemprop="name author" itemscope itemtype="http://schema.org/Person"><?php $this->author(); ?></a>
                <span>/</span>
                <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></a>
            </div>
        <?php else: ?>
            <nav class="header__nav" role="navigation">
                <a<?php if ($this->is('index')): ?> class="on"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>">首页</a>
                <?php if ($this->options->navCategory): ?>
                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                <?php while($category->next()): ?>
                <?php if (in_array($category->mid, $this->options->navCategory)): ?>
                <a<?php if($this->is('category', $category->slug)): ?> class="on"<?php endif; ?> href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a>
                <?php endif; ?>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                <a<?php if($this->is('page', $pages->slug)): ?> class="on"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                <?php endwhile; ?>
            </nav>
        <?php endif; ?>
        <?php if (!$this->is('index')): ?>
        <a class="header__back" href="<?php $this->options->siteUrl(); ?>" title="回到首页"></a>
        <?php endif; ?>
    </div>
</header>
