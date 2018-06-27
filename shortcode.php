<?php
/**
 *
 * 注册短代码
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.5.7
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
    return '<a class="mc-button b-text" href="' .  $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-text"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btntext' , 'shortcode_button_text' );

// 文档按钮
function shortcode_button_document( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-document" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-help"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btndocument' , 'shortcode_button_document' );

// 爱心按钮
function shortcode_button_heart( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-heart" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-fav"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnheart' , 'shortcode_button_heart' );

// 盒子按钮
function shortcode_button_box( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-box" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-box"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnbox' , 'shortcode_button_box' );

// 搜索按钮
function shortcode_button_search( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-search" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-search"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnsearch' , 'shortcode_button_search' );

// 链接按钮
function shortcode_button_link( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-link" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-link"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnlink' , 'shortcode_button_link' );

// 下载按钮
function shortcode_button_down( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-down" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-download"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btndown' , 'shortcode_button_down' );

// 箭头按钮
function shortcode_button_next( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-next" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-skip"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnnext' , 'shortcode_button_next' );

// 音频按钮
function shortcode_button_audio( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-audio" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-remind"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnaudio' , 'shortcode_button_audio' );

// 视频按钮
function shortcode_button_video( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    return '<a class="mc-button b-video" href="' . $args['href'] . '" target="' . $args['target'] . '"><i class="icon icon-video"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btnvideo' , 'shortcode_button_video' );

// 随机色彩按钮
function shortcode_button_color( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank'
    ), $atts );
    $colors = array(
        '#c53929', '#3367d6', '#0b8043', '#f09300', '#616161', '#d32f2f', '#d50000', '#c2185b', '#c51162', '#7b1fa2', '#512da8', '#6200ea', '#303f9f', '#304ffe', '#1976d2', '#2962ff', '#0288d1', '#0091ea', '#0097a7', '#00b8d4', '#00796b', '#00bfa5', '#388e3c', '#00c853', '#689f38', '#afb42b', '#fbc02d', '#ffa000', '#f57c00', '#ff6500', '#e64a19', '#dd2c00', '#5d4037', '#455a64'
    );
    $color = $colors[array_rand($colors, 1)];
    return '<a class="mc-button b-color" href="' . $args['href'] . '" target="' . $args['target'] . '" style="background: ' . $color . '"><i class="icon icon-light"></i><span>' . $content . '</span></a>';
}
add_shortcode( 'btncolor' , 'shortcode_button_color' );

// 音频播放
function shortcode_audio( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'src' => '',
        'preload' => 'metadata'
    ), $atts );
    if (!empty($atts['autoplay'])) {
        $args['autoplay'] = 'autoplay';
    }
    if (!empty($atts['loop'])) {
        $args['loop'] = 'loop';
    }
    $attr_strings = array();
    foreach ( $args as $k => $v ) {
        $attr_strings[] = $k . '="' . htmlspecialchars( $v, ENT_QUOTES, 'UTF-8' ) . '"';
    }
    $audio = sprintf( '<audio class="mc-audio__source" %s controls>%s</audio>', join( ' ', $attr_strings ), $content );
    return "<div class=\"mc-audio\"><div class=\"mc-audio__bar\"></div><div class=\"mc-audio__ctl\"><div class=\"mc-audio__ctl-btn\"></div><div class=\"mc-audio__ctl-time\"></div></div>{$audio}</div>";
}
add_shortcode( 'audio' , 'shortcode_audio' );

// 视频播放
function shortcode_video( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'src'      => '',
        'preload'  => 'metadata'
    ), $atts );
    if (!empty($atts['autoplay'])) {
        $args['autoplay'] = 'autoplay';
    }
    if (!empty($atts['loop'])) {
        $args['loop'] = 'loop';
    }
    if (!empty($atts['width'])) {
        $args['width'] = $atts['width'];
    }
    if (!empty($atts['height'])) {
        $args['height'] = $atts['height'];
    }
    $attr_strings = array();
    foreach ( $args as $k => $v ) {
        $attr_strings[] = $k . '="' . htmlspecialchars( $v, ENT_QUOTES, 'UTF-8' ) . '"';
    }
    return sprintf( '<video class="mc-video" %s controls>%s</video>', join( ' ', $attr_strings ), $content );
}
add_shortcode( 'video' , 'shortcode_video' );

// SWF播放器
function shortcode_swf( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'allowScriptAccess' => 'sameDomain',
        'allowfullscreen' => 'true',
        'wmode' => 'opaque',
        'quality' => 'high'
    ), $atts );
    $attr_strings = array();
    foreach ( $args as $k => $v ) {
        $attr_strings[] = $k . '="' . htmlspecialchars( $v, ENT_QUOTES, 'UTF-8' ) . '"';
    }
    return sprintf( '<embed src="%s" %s type="application/x-shockwave-flash"/>', $content, join( ' ', $attr_strings ) );
}
add_shortcode( 'swf', 'shortcode_swf' );

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

// 友情链接
function shortcode_link( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'http://',
        'target' => '_blank',
        'title' => ''
    ), $atts );
    return '<a class="mc-link" href="' . $args['href'] . '" target="' . $args['target'] . '"><span class="mc-link__name">' . $content . '</span><span class="mc-link__title">' . $args['title'] . '</span></a>';
}
add_shortcode( 'link' , 'shortcode_link' );

function shortcode_friends( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'random' => 'true'
    ), $atts );
    if ( !preg_match_all( "/\[(link)\b(.*?)(?:(\/))?\](?:(.+?)\[\/link\])/s", $content, $matches, PREG_SET_ORDER ) ) {
        return do_shortcode( $content );
    } else {
        if ($args['random'] === 'true') {
            shuffle($matches);
        }
        $out = '<div class="mc-friends">';
        foreach($matches as $key => $val) {
            $out .= '<div class="mc-friends__item">' . do_shortcode($val[0]) . '</div>';
        }
        $out .= '</div>';
        return $out;
    }
}
add_shortcode( 'friends', 'shortcode_friends' );
