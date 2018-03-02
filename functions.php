<?php
/**
 *
 * 函数申明
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.5.0
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define('__LAZYIMG__', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P8+vXrfwAJpgPg8gE+iwAAAABJRU5ErkJggg==');

// 主题设置
function themeConfig($form) {
    Typecho_Widget::widget('Widget_Metas_Category_List')->to($category);
    $listCate = [];
    foreach($category->stack as $cat) {
        $listCate[$cat['mid']] = $cat['name'];
    }
    $navCategory = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'navCategory',
        $listCate,
        NULL,
        _t('添加分类到导航'),
        _t('选择你要添加的分类，可以选择多个')
    );
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
    // $siteStyle = new Typecho_Widget_Helper_Form_Element_Radio(
    //     'siteStyle',
    //     array(
    //         'purple' => '沉稳紫',
    //         'green' => '清新绿',
    //         'pink' => '俏皮粉',
    //         'red' => '喜庆红',
    //         'yellow' => '灿烂黄',
    //         'blue' => '未来蓝',
    //         'black' => '暗夜黑',
    //         'white' => '冰雪白',
    //         'color' => '斑斓彩'
    //     ),
    //     'purple',
    //     _t('网站风格'),
    //     _t('不同的风格不同的态度')
    // );
    $headBgUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'headBgUrl',
        NULL,
        NULL,
        _t('页头背景图'),
        _t('填入有效的图片地址，可以为本地或远程 URL')
    );
    $text2speech = new Typecho_Widget_Helper_Form_Element_Radio(
        'text2speech',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('文章语音朗读'),
        _t('是否启用文章语音朗读功能')
    );
    $text2speechSex = new Typecho_Widget_Helper_Form_Element_Radio(
        'text2speechSex',
        array(
            '1' => '普通男声',
            '0' => '普通女声',
            '3' => '情感男声',
            '4' => '情感女声'
        ),
        '3',
        _t('语音朗读合成类型'),
        _t('喜欢男声还是女声？')
    );
    $text2speechSpeed = new Typecho_Widget_Helper_Form_Element_Radio(
        'text2speechSpeed',
        array(
            '1' => '超慢',
            '3' => '慢速',
            '5' => '正常',
            '7' => '快速',
            '12' => '超快'
        ),
        '5',
        _t('语音朗读语速'),
        _t('说的快还是慢？')
    );
    $text2speechLength = new Typecho_Widget_Helper_Form_Element_Text(
        'text2speechLength',
        NULL,
        '3000',
        _t('语音朗读分段字数'),
        _t('输入分段字数，最大为 5000 字，为防分段失败建议不要超过最大值，默认为 3000 字')
    );
    $text2speechBegin = new Typecho_Widget_Helper_Form_Element_Text(
        'text2speechBegin',
        NULL,
        '语音小助手为您服务~',
        _t('语音朗读开头内容'),
        _t('为语音配上一个欢迎词？')
    );
    $text2speechEnd = new Typecho_Widget_Helper_Form_Element_Text(
        'text2speechEnd',
        NULL,
        '朗读完毕~',
        _t('语音朗读结尾内容'),
        _t('为语音配上一个结束语？')
    );
    $baiduBDUSS = new Typecho_Widget_Helper_Form_Element_Text(
        'baiduBDUSS',
        NULL,
        NULL,
        _t('百度 BDUSS'),
        _t('百度 Cookie 中的 BDUSS，获取方法请看 <a href="https://github.com/maicong/stay/blob/master/README.md#%E7%99%BE%E5%BA%A6bduss">README.md</a>')
    );
    $openDonate = new Typecho_Widget_Helper_Form_Element_Radio(
        'openDonate',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('文章打赏'),
        _t('是否启用文章打赏功能')
    );
    $donateTips = new Typecho_Widget_Helper_Form_Element_Text(
        'donateTips',
        NULL,
        '扫描下面二维码，给我点动力吧~',
        _t('打赏提示文字'),
        _t('填入打赏提示文字')
    );
    $donateWeixin = new Typecho_Widget_Helper_Form_Element_Text(
        'donateWeixin',
        NULL,
        NULL,
        _t('微信收款二维码'),
        _t('填入微信收款二维码地址，建议保持一致尺寸，例如 200x200')
    );
    $donateAlipay = new Typecho_Widget_Helper_Form_Element_Text(
        'donateAlipay',
        NULL,
        NULL,
        _t('支付宝收款二维码'),
        _t('填入支付宝收款二维码地址，建议保持一致尺寸，例如 200x200')
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
        _t('HTML 代码，可以是 meta 或 link 等')
    );
    $customFoot = new Typecho_Widget_Helper_Form_Element_Textarea(
        'customFoot',
        NULL,
        NULL,
        _t('自定义页脚代码'),
        _t('HTML 代码，显示于页脚版权信息下一行')
    );
    $analyticsCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'analyticsCode',
        NULL,
        NULL,
        _t('统计代码'),
        _t('网站统计代码，隐藏于页脚')
    );
    $form->addInput($navCategory);
    $form->addInput($shortcode);
    // $form->addInput($siteStyle);
    $form->addInput($headBgUrl);
    $form->addInput($text2speech);
    $form->addInput($text2speechSex);
    $form->addInput($text2speechSpeed);
    $form->addInput($text2speechLength);
    $form->addInput($text2speechBegin);
    $form->addInput($text2speechEnd);
    $form->addInput($baiduBDUSS);
    $form->addInput($openDonate);
    $form->addInput($donateTips);
    $form->addInput($donateWeixin);
    $form->addInput($donateAlipay);
    $form->addInput($gravatarUrl);
    $form->addInput($customHead);
    $form->addInput($customFoot);
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

// 获取自定义字段
function getFields($post, $key) {
    $value = $post->fields->{$key};
    if ($value) {
        return $value;
    }
}

// 获取摘要
function getExcerpt($content, $length = 300, $trim = ' ......') {
    $content = getContent($content);
    $content = Typecho_Common::subStr(strip_tags($content), 0, $length, $trim);
    return trim($content);
}

// 获取内容
function getContent($content) {
    $options = Typecho_Widget::widget('Widget_Options');
    if ($options->shortcode) {
        $content = do_shortcode($content);
    }
    $content = preg_replace(
        ['/<p>(<div(.+?)<\/div>)<\/p>/', '/<img(.+?)src="/'],
        ['$1', '<img$1src="' . __LAZYIMG__ . '" data-original="'],
        $content
    );
    return $content;
}

// 获取打包的资源文件
function getBuildFile($type) {
    $file = __DIR__.'/assets/build/manifest.php';
    $manifest = null;
    if (file_exists($file)) {
        require_once(__DIR__.'/assets/build/manifest.php');
        $options = Typecho_Widget::widget('Widget_Options');
        $manifest = new WebpackManifest();
        switch ($type) {
            case 'css':
                $options->themeUrl($manifest::$cssFiles['stay']);
            break;
            case 'js':
                $options->themeUrl($manifest::$jsFiles['stay']);
            break;
        }
    } else {
        echo '资源不存在，请先运行打包命令';
        exit;
    }
}

// 获取表情
function getFaces ($type) {
    $faces = array(
        'hehe' => '[呵呵]',
        'haha' => '[哈哈]',
        'heihei' => '[嘿嘿]',
        'xixi' => '[嘻嘻]',
        'xiaoku' => '[笑哭]',
        'keai' => '[可爱]',
        'baibai' => '[拜拜]',
        'wa' => '[哇]',
        'pu' => '[噗]',
        'ku' => '[酷]',
        'nanshou' => '[难受]',
        'yi' => '[咦]',
        'emmm' => '[呃]',
        'heng' => '[哼]',
        'baiyan' => '[白眼]',
        'dai' => '[呆]',
        'cahan' => '[擦汗]',
        'ganga' => '[尴尬]',
        'yun' => '[晕]',
        'jiujie' => '[纠结]',
        'huaji' => '[滑稽]',
        'koubi' => '[抠鼻]',
        'sikao' => '[思考]',
        'bishi' => '[鄙视]',
        'tian' => '[舔]',
        'fendou' => '[奋斗]',
        'kun' => '[困]',
        'haixiu' => '[害羞]',
        'qaq' => '[QAQ]',
        'doge' => '[Doge]',
        'laowang' => '[老王]',
        'zhale' => '[炸了]',
        'gouyin' => '[勾引]',
        'niubi' => '[牛逼]',
        'ruoji' => '[弱鸡]',
        'woshou' => '[握手]',
        'gaoci' => '[告辞]',
        'ok' => '[OK]',
        'yaowan' => '[药丸]',
        'pig' => '[猪]'
    );
    if ($type === 'map') {
        return array_map(function ($val) {
            return "<i class=\"face face-{$val}\"></i>";
        }, array_flip($faces));
    }
    if ($type === 'html') {
        $html = '';
        foreach($faces as $key => $val) {
            $html .= "<i class=\"face face-{$key}\" data-tag=\"{$val}\"></i>";
        }
        echo $html;
    }
}

// 获取评论页
function getCommentsPage ($word = '&laquo; Previous Entries', $page = 'prev') {
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

// Http 请求
function mcFetch ($args = array()) {
    $args = array_merge(array(
        'method' => 'GET',
        'url' => null,
        'header' => array(),
        'data' => array()
    ), $args);

    $args['header'] = array_merge(array(
        'Referer' => 'https://www.google.co.uk',
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.39 Safari/537.36'
    ), $args['header']);

    if (!$args['url']) {
        return;
    }

    if ($client = Typecho_Http_Client::get()) {
        if (!empty($args['header'])) {
            foreach($args['header'] as $key => $val) {
                $client->setHeader($key, $val);
            }
        }
        if (!empty($args['data'])) {
            if ($args['method'] === 'GET') {
                $client->setQuery($args['data']);
            }
            if ($args['method'] === 'POST') {
                $client->setData($args['data']);
            }
        }
        $client->setTimeout(15);
        $client->send($args['url']);

        return $client->getResponseBody();
    }
}

// 获取音频地址
function getSpeech ($title, $content) {
    $options = Typecho_Widget::widget('Widget_Options');
    $result = mcFetch(array(
        'method' => 'POST',
        'url' => 'http://developer.baidu.com/vcast/getVcastInfo',
        'header' => array(
            'Referer' => 'http://developer.baidu.com/vcast',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With' => 'XMLHttpRequest',
            'Cookie' => 'BDUSS=' . $options->baiduBDUSS
        ),
        'data' => array(
            'title' => $title,
            'content' => $content,
            'sex' => $options->text2speechSex >= 0 ? $options->text2speechSex : 4,
            'speed' => $options->text2speechSpeed ? $options->text2speechSpeed : 5,
            'volumn' => 9,
            'pit' => 5,
            'method' => 'TRADIONAL'
        )
    ));
    if ($data = json_decode($result)) {
        if ($data) {
            return $data->bosUrl;
        }
    }
}

// 分割字符串
function mb_str_split($str, $length = 1) {
    if ($length < 1) return false;
    $result = array();
    for ($i = 0; $i < mb_strlen($str); $i += $length) {
        $result[] = mb_substr($str, $i, $length);
    }
    return $result;
}

// 文字转语音
function text2speech ($cid) {
    Typecho_Widget::widget('Widget_Archive', 'type=post&cid=' . $cid)->to($post);
    $options = Typecho_Widget::widget('Widget_Options');
    $content = $post->content;
    if ($options->shortcode) {
        $content = do_shortcode($content);
    }
    $content = strip_tags($content);
    $content = str_replace("</p><p>", "。", $content);
    $content = str_replace(
        array('“', '”', '"', '\'', '@', '#', '%', '&', '——', '…', '*'),
        ' ',
        $content
    );
    $speech = [];
    $length = $options->text2speechLength ? (int) $options->text2speechLength : 3000;
    $contentList = mb_str_split($content, $length);
    $contentLength = count($contentList);
    foreach ($contentList as $key => $val) {
        $title = $post->title;
        if ($key === 0) {
            $title = $options->text2speechBegin . '。文章标题：' . $title;
            $val = '。文章内容：' . $val ;
        } else {
            if ($contentLength > 1) {
                $title = mb_substr($val, 0, 2);
                $val = mb_substr($val, 2);
            }
        }
        if ($key === $contentLength - 1) {
            $val = $val . '。' . $options->text2speechEnd;
        }
        $speech[] = getSpeech($title, $val);
    }
    return $speech;
}

// 转换表情
function convertFaces ($content) {
    $faces = getFaces('map');
    return str_replace(array_keys($faces), array_values($faces), $content);
}

// 转换评论内容
function convertComments ($content) {
    $content = convertFaces($content);
    // 匹配链接
    $content = preg_replace('/(https?:\/\/[a-zA-Z0-9\/\-.=#?&%]+)/iu', '<a href="$1">$1</a>',$content);
    return $content;
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
                <?php $comments->gravatar(84, 'retro', true); ?>
            </div>
            <div class="comment__meta">
                <cite class="comment__author"><?php $comments->author(); ?><?php echo $user_type; ?></cite>
                <time class="comment__time" datetime="<?php $comments->date('c'); ?>"><?php $comments->date(); ?></time>
            </div>
        </div>
        <div id="comment-content" class="comment__content">
            <?php echo convertComments($comments->content); ?>
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
