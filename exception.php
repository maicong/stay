<?php
/**
 *
 * 异常处理
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.0.0
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$request = Typecho_Request::getInstance();
$response = Typecho_Response::getInstance();
if ($request->isAjax()) {
    $response->throwJson(array('code' => $code, 'message' => $message));
} else {
    echo
<<<EOF
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="{$charset}">
        <title>{$code}</title>
        <style>
            html {
                padding: 50px 10px;
                font-size: 16px;
                line-height: 1.4;
                color: #666;
                background: #F6F6F3;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            html,
            input { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
            body {
                max-width: 500px;
                _width: 500px;
                padding: 30px 20px;
                margin: 0 auto;
                background: #FFF;
            }
            ul {
                padding: 0 0 0 40px;
            }
            .container {
                max-width: 380px;
                _width: 380px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {$message}
        </div>
    </body>
</html>
EOF;
}
