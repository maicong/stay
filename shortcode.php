<?php
/**
 *
 * 注册短代码
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.2.1
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once __DIR__ . '/lib/shortcode.php';

// 项目面板
function shortcode_panel_task( $atts, $content = '' ) {
    return '<div class="mc-panel p-task clearfix">' . $content . '</div>';
}
add_shortcode( 'task' , 'shortcode_panel_task' );

// 禁止面板
function shortcode_panel_noway( $atts, $content = '' ) {
    return '<div class="mc-panel p-noway clearfix">' . $content . '</div>';
}
add_shortcode( 'noway' , 'shortcode_panel_noway' );

// 警告面板
function shortcode_panel_warning( $atts, $content = '' ) {
    return '<div class="mc-panel p-warning clearfix">' . $content . '</div>';
}
add_shortcode( 'warning' , 'shortcode_panel_warning' );

// 购买面板
function shortcode_panel_buy( $atts, $content = '' ) {
    return '<div class="mc-panel p-buy clearfix">' . $content . '</div>';
}
add_shortcode( 'buy' , 'shortcode_panel_buy' );

// 下载面板
function shortcode_panel_down( $atts, $content = '' ) {
    return '<div class="mc-panel p-down clearfix">' . $content . '</div>';
}
add_shortcode( 'down' , 'shortcode_panel_down' );

// 文本按钮
function shortcode_button_text( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-text" href="' .  $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btntext' , 'shortcode_button_text' );

// 文档按钮
function shortcode_button_document( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-document" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btndocument' , 'shortcode_button_document' );

// 爱心按钮
function shortcode_button_heart( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-heart" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnheart' , 'shortcode_button_heart' );

// 盒子按钮
function shortcode_button_box( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-box" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnbox' , 'shortcode_button_box' );

// 搜索按钮
function shortcode_button_search( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-search" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnsearch' , 'shortcode_button_search' );

// 链接按钮
function shortcode_button_link( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-link" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnlink' , 'shortcode_button_link' );

// 下载按钮
function shortcode_button_down( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-down" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btndown' , 'shortcode_button_down' );

// 箭头按钮
function shortcode_button_next( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-next" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnnext' , 'shortcode_button_next' );

// 音频按钮
function shortcode_button_audio( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-audio" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnaudio' , 'shortcode_button_audio' );

// 视频按钮
function shortcode_button_video( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-video" href="' . $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a>';
}
add_shortcode( 'btnvideo' , 'shortcode_button_video' );

// 音频播放
function shortcode_audio( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'src'      => '',
        'preload'  => 'metadata'
    ), $atts );
    $attr_strings = array();
    foreach ( $args as $k => $v ) {
        $attr_strings[] = $k . '="' . htmlspecialchars( $v, ENT_QUOTES, 'UTF-8' ) . '"';
    }
    return sprintf( '<audio class="mc-audio" %s controls></audio>', join( ' ', $attr_strings ) );
}
add_shortcode( 'audio' , 'shortcode_audio' );

// 视频播放
function shortcode_video( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'src'      => '',
        'preload'  => 'metadata',
        'width'    => 640,
        'height'   => 360,
    ), $atts );
    $attr_strings = array();
    foreach ( $args as $k => $v ) {
        $attr_strings[] = $k . '="' . htmlspecialchars( $v, ENT_QUOTES, 'UTF-8' ) . '"';
    }
    return sprintf( '<video class="mc-video" %s controls></video>', join( ' ', $attr_strings ) );
}
add_shortcode( 'video' , 'shortcode_video' );

// SWF播放器
function shortcode_swf( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'width' => '500',
        'height' => '300',
    ), $atts );
    return "<embed src=\"{$content}\" width=\"{$args['width']}\" height=\"{$args['height']}\" type=\"application/x-shockwave-flash\" allowScriptAccess=\"sameDomain\" allowfullscreen=\"true\" wmode=\"opaque\" quality=\"high\" />";
}
add_shortcode( 'swf', 'shortcode_swf' );

// 音乐搜索器
function shortcode_music( $atts, $content = '' ) {
    /**
     * [music key="xxx" filter="id" type="netease"]25906124[/music]
     *
     * key:    apikey，请联系麦葱获取
     * filter: 过滤类型
     *      id         => 音乐ID
     *      name       => 音乐名称
     *      url        => 音乐链接
     * type:   站点类型
     *      netease    => 网易,
     *      qq         => ＱＱ,
     *      kugou      => 酷狗,
     *      kuwo       => 酷我,
     *      xiami      => 虾米,
     *      baidu      => 百度,
     *      1ting      => 一听,
     *      migu       => 咪咕,
     *      lizhi      => 荔枝,
     *      qingting   => 蜻蜓,
     *      ximalaya   => 喜马拉雅,
     *      kg         => 全民K歌,
     *      5singyc    => 5sing原创,
     *      5singfc    => 5sing翻唱,
     *      soundcloud => SoundCloud
     */
    $args = shortcode_atts( array(
        'key' => '',
        'filter' => 'id',
        'type' => 'netease',
        'autoplay' => 'autoplay',
        'controls' => 'controls'
    ), $atts );
    $client = Typecho_Http_Client::get();
    if ($client) {
        $client->setHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36')
        ->setHeader('Referer', Helper::options()->siteUrl)
        ->setTimeout(10)
        ->send("http://music.2333.me/api?apikey={$args['key']}&type={$args['type']}&filter={$args['filter']}&query={$content}&result=url");
        $result = $client->getResponseBody();
        if ($result) {
            $data = json_decode($result, true);
            return sprintf( '<audio class="mc-audio" src="%s" %s %s></audio>', $data['data'], $args['autoplay'], $args['controls']);
        }
    }
    return;
}
add_shortcode( 'music', 'shortcode_music' );

// 收缩栏
function shortcode_toggle( $atts, $content = '' ){
    $args = shortcode_atts( array(
        'title' => '',
    ), $atts );
    return '<div class="mc-toggle"><div class="toggle-title not-select">' . $args['title'] . '</div><div class="toggle-content transition3">' . $content . '</div></div>';
}
add_shortcode( 'toggle', 'shortcode_toggle' );

// 选项卡
function shortcode_tabs( $atts, $content = '' ) {
    if ( !preg_match_all( "/(.?)\[(item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/item\])?(.?)/s", $content, $matches ) ) {
        return do_shortcode( $content );
    } else {
        for ($i = 0; $i < count($matches[0]); $i++) {
            $matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
        }
        $out = '<div class="mc-tabs">';
        $out .= '<ul class="tabs-title">';
        for ($i = 0; $i < count($matches[0]); $i++) {
            $out .= '<li';
            if ( $i === 0 ) {
                $out .= ' class="active"';
            }
            $out .= '><a href="#mc-tab-' . $i . '">'. $matches[3][$i]['title'] . '</a></li>';
        }
        $out .= '</ul>';
        $out .= '<div class="tabs-container">';
        for ($i = 0; $i < count($matches[0]); $i++) {
            $out .= '<div id="mc-tab-' . $i . '"';
            $active = ( $i === 0 ) ? ' active' : '';
            $out .= ' class="tabs-content' . $active . '">' . autop( do_shortcode( trim( $matches[5][$i] ) ) ) . '</div>';
        }
        $out .= '</div>';
        $out .= '</div>';
        return $out;
    }
}
add_shortcode( 'tabs', 'shortcode_tabs' );
