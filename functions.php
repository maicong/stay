<?php
/**
 *
 * 函数申明
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.0.1
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define('__LAZYIMG__', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P8+vXrfwAJpgPg8gE+iwAAAABJRU5ErkJggg==');

// 获取自定义字段
function getFields($post, $key) {
    $value = $post->fields->{$key};
    if ($value) {
        return $value;
    }
}

// 获取摘要
function getExcerpt($content, $length = 300, $trim = ' ......', $return = false) {
    $content = getContent($content, true);
    $content = Typecho_Common::subStr(strip_tags($content), 0, $length, $trim);
    if ($return) return $content;
    echo $content;
}

// 获取内容
function getContent($content, $return = false) {
    $options = Typecho_Widget::widget('Widget_Options');
    if ($options->shortcode) {
        $content = preg_replace(
            '/<p>(<div(.+?)<\/div>)<\/p>/',
            '$1',
            do_shortcode($content)
        );
    }
    $content = preg_replace(
        '/<img(.+?)src="/',
        '<img$1src="' . __LAZYIMG__ . '" data-original="',
        $content
    );
    if ($return) return $content;
    echo $content;
}

// 获取评论页链接
function commentsPageLink ($word = '&laquo; Previous Entries', $page = 'prev') {
    $options = Typecho_Widget::widget('Widget_Options');
    $comments = Typecho_Widget::widget('Widget_Comments_Archive');
    $total = $comments->parameter->parentContent['commentsNum'];
    if (
        'last' == $options->commentsPageDisplay &&
        !$comments->parameter->commentPage
    ) {
        $currentPage = ceil($total / $options->commentsPageSize);
    } else {
        $currentPage = $comments->parameter->commentPage ?
        $comments->parameter->commentPage :
        1;
    }
    if (
        $options->commentsPageBreak &&
        $total > $options->commentsPageSize
    ) {
        if (empty($comments->_pageNav)) {
            $pageRow = $comments->parameter->parentContent;
            $pageRow['permalink'] = $pageRow['pathinfo'];
            $query = Typecho_Router::url(
                'comment_page',
                $pageRow,
                $options->index
            );
            /** 使用盒状分页 */
            $comments->_pageNav = new Typecho_Widget_Helper_PageNavigator_Classic(
                $total,
                $currentPage,
                $options->commentsPageSize,
                $query
            );
            $comments->_pageNav->setPageHolder('commentPage');
            $comments->_pageNav->setAnchor('comments');
        }
        $comments->_pageNav->{$page}($word);
    }
}

// 获取打包的资源文件
function buildFile($type) {
    $file = __DIR__.'/assets/build/manifest.php';
    $manifest = null;
    if (file_exists($file)) {
        require_once(__DIR__.'/assets/build/manifest.php');
        $options = Typecho_Widget::widget('Widget_Options');
        $manifest = new WebpackManifest();
        switch ($type) {
            case 'css':
                $options->themeUrl($manifest::$cssFiles[0]);
            break;
            case 'js':
                $options->themeUrl($manifest::$jsFiles[0]);
            break;
        }
    } else {
        echo '资源不存在，请先运行打包命令';
        exit;
    }
}

// 主题设置
function themeConfig($form) {
    $shortcode = new Typecho_Widget_Helper_Form_Element_Radio(
        'shortcode',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('短代码支持'),
        _t('是否启用短代码支持，移植的 WordPress 功能')
    );
    $gravatarUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'gravatarUrl',
        NULL,
        NULL,
        _t('Gravatar 代理地址'),
        _t('填入 Gravatar 代理地址，例如 https://v2ex.assets.uxengine.net/gravatar/')
    );
    $customHead = new Typecho_Widget_Helper_Form_Element_Textarea(
        'customHead',
        NULL,
        NULL,
        _t('自定义头部信息'),
        _t('HTML 代码，可以是 meta 或者 link 等')
    );
    $analyticsCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'analyticsCode',
        NULL,
        NULL,
        _t('统计代码'),
        _t('网站统计代码，隐藏于页脚')
    );
    $form->addInput($shortcode);
    $form->addInput($gravatarUrl);
    $form->addInput($customHead);
    $form->addInput($analyticsCode);
}

// 主题加载
function themeInit($self) {
    if (!defined('__TYPECHO_EXCEPTION_FILE__')) {
      define('__TYPECHO_EXCEPTION_FILE__', __DIR__ . '/exception.php');
    }
    $options = $self->widget('Widget_Options');
    if ($options->gravatarUrl && !defined('__TYPECHO_GRAVATAR_PREFIX__')) {
        define('__TYPECHO_GRAVATAR_PREFIX__', $options->gravatarUrl);
    }
    if ($options->shortcode) {
        require_once __DIR__ . '/shortcode.php';
    }
}

// 添加缩略图字段
function themeFields($layout) {
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text(
        'thumbnail',
        NULL,
        NULL,
        _t('缩略图'),
        _t('一个有效图片地址，推荐尺寸 900x425')
    );
    $layout->addItem($thumbnail);
}

// 评论层
function threadedComments($comments, $options) {
    $commentClass = '';
    $user_type = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' author';
        } else {
            $commentClass .= ' user';
        }
    }
    switch ($comments->authorId) {
        case '1':
            $user_type = '<i class="identity">博主</i>';
            break;
        default:
            if ('waiting' == $comments->status) {
                $user_type = '<i class="pending">评论待审核</i>';
            }
    }
?>
<li id="li-<?php $comments->theId(); ?>" class="comment">
    <div id="<?php $comments->theId(); ?>" class="comment-block">
        <div class="comment__vcard">
            <div class="comment__avatar">
                <?php $comments->gravatar(80, 'retro', true); ?>
            </div>
            <div class="comment__meta">
                <cite class="comment__author"><?php $comments->author(); ?><?php echo $user_type; ?></cite>
                <time class="comment__time" datetime="<?php $comments->date('c'); ?>"><?php $comments->date(); ?></time>
            </div>
        </div>
        <div id="comment-content" class="comment__content">
            <?php $comments->content(); ?>
        </div>
        <?php $comments->reply(); ?>
    </div>
    <?php if ($comments->children) { ?>
        <div class="children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php }
