<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Stay 主题专用插件
 *
 * @package Stay
 * @author MaiCong
 * @version 1.1.3
 * @link https://maicong.me
 */

class Stay_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        // 压缩页面代码
        Typecho_Plugin::factory('index.php')->begin = array('Stay_Plugin', 'minifyStart');
        Typecho_Plugin::factory('index.php')->end = array('Stay_Plugin', 'minifyEnd');

        // 回复
        Typecho_Plugin::factory('Widget_Comments_Archive')->reply = array('Stay_Plugin', 'reply');

        // 头像
        Typecho_Plugin::factory('Widget_Abstract_Comments')->gravatar = array('Stay_Plugin', 'gravatar');

        // 评论后（未保存到数据库）
        Typecho_Plugin::factory('Widget_Feedback')->comment = array('Stay_Plugin', 'afterComment');

        // 评论后（已保存到数据库）页面评论
        Typecho_Plugin::factory('Widget_Feedback')->finishComment = array('Stay_Plugin', 'finishComment');

        // 评论后（已保存到数据库）后台编辑
        Typecho_Plugin::factory('Widget_Comments_Edit')->finishComment = array('Stay_Plugin', 'finishComment');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $mcMinify = new Typecho_Widget_Helper_Form_Element_Radio(
            'mcMinify',
            array(
                '1' => _t('启用'),
                '0' => _t('禁用')
            ),
            '0',
            _t('页面代码压缩'),
            _t('使用 PHP 压缩，对 TTFB 有轻微影响，酌情使用')
        );
        $mcFilter = new Typecho_Widget_Helper_Form_Element_Radio(
            'mcFilter',
            array(
                '1' => _t('启用'),
                '0' => _t('禁用')
            ),
            '1',
            _t('评论内容过滤'),
            _t('如果你的 PHP 依赖的 PCRE 版本过旧，此功能可能无法正常使用')
        );
        $mcCheckMail = new Typecho_Widget_Helper_Form_Element_Radio(
            'mcCheckMail',
            array(
                '1' => _t('启用'),
                '0' => _t('禁用')
            ),
            '1',
            _t('评论邮箱验证'),
            _t('如果你的 PHP 依赖的 PCRE 版本过旧，此功能可能无法正常使用')
        );
        $mcMailer = new Typecho_Widget_Helper_Form_Element_Radio(
            'mcMailer',
            array(
                '1' => _t('启用'),
                '0' => _t('禁用')
            ),
            '0',
            _t('评论邮件发送'),
            _t('向被评论者发送邮件反馈')
        );
        $mcSmtpHost = new Typecho_Widget_Helper_Form_Element_Text(
            'mcSmtpHost',
            NULL,
            '',
            _t('SMTP 地址'),
            _t('用于评论邮件发送，例如: smtp.qq.com')
        );
        $mcSmtpPort = new Typecho_Widget_Helper_Form_Element_Text(
            'mcSmtpPort',
            NULL,
            '',
            _t('SMTP 端口'),
            _t('用于评论邮件发送，例如: 465')
        );
        $mcSmtpUser = new Typecho_Widget_Helper_Form_Element_Text(
            'mcSmtpUser',
            NULL,
            '',
            _t('SMTP 用户名'),
            _t('发送邮件的用户名，例如: 123456@qq.com')
        );
        $mcSmtpPwd = new Typecho_Widget_Helper_Form_Element_Text(
            'mcSmtpPwd',
            NULL,
            '',
            _t('SMTP 密码'),
            _t('发送邮件的用户密码，不能为空')
        );
        $mcAdminMail = new Typecho_Widget_Helper_Form_Element_Text(
            'mcAdminMail',
            NULL,
            '',
            _t('管理员邮箱'),
            _t('用于接收评论通知的管理员邮箱')
        );
        $form->addInput($mcMinify);
        $form->addInput($mcFilter);
        $form->addInput($mcCheckMail);
        $form->addInput($mcMailer);
        $form->addInput($mcSmtpHost);
        $form->addInput($mcSmtpPort);
        $form->addInput($mcSmtpUser);
        $form->addInput($mcSmtpPwd);
        $form->addInput($mcAdminMail);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 压缩前
     *
     * @access public
     * @return void
     */
    public static function minifyStart()
    {
        if (Helper::options()->plugin('Stay')->mcMinify) {
            ob_start('self::minifyBuffer');
        }
    }

    /**
     * 压缩后
     *
     * @access public
     * @return void
     */
    public static function minifyEnd()
    {
        if (Helper::options()->plugin('Stay')->mcMinify) {
            ob_end_flush();
        }
    }

    /**
     * 压缩 buffer
     *
     * @access public
     * @return void
     */
    protected static function minifyBuffer($buffer)
    {
        require_once __DIR__ . '/class/Minify_HTML.php';
        return Minify_HTML::minify($buffer);
    }

    /**
     * 评论回复链接
     *
     * @access public
     * @return void
     */
    public static function reply($word, $self)
    {
        $href = substr($self->permalink, 0, - strlen($self->theId) - 1) . '?replyTo=' . $self->coid;
        echo '<a class="comment__reply" href="' . $href . '#comments" rel="nofollow">' . $word . '</a>';
    }

    /**
     * 调用gravatar输出用户头像
     *
     * @access public
     * @return void
     */
    public static function gravatar($size, $rating, $default, $self)
    {
        $lazyImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P8+vXrfwAJpgPg8gE+iwAAAABJRU5ErkJggg==';

        $url = Typecho_Common::gravatarUrl(
            $self->mail, $size, $rating, $default, $self->request->isSecure()
        );

        echo '<img class="avatar" src="'. $lazyImg . '" data-original="' . $url . '" alt="' . $self->author . '" width="' . $size . '" height="' . $size . '" />';
    }

    /**
     * 评论插件接口
     *
     * @access public
     * @return void
     */
    public static function afterComment($comment, $self)
    {
        if ($self->widget('Widget_User')->pass('administrator', true)) {
            return $comment;
        }
        if (intval(PCRE_VERSION) < 7) {
            return $comment;
        }
        if (Helper::options()->plugin('Stay')->mcFilter) {
            if (preg_match('/\p{Cyrillic}+/iu', $comment['text'])) {
                throw new Typecho_Widget_Exception('Cпасибо', 403);
            }

            if (!preg_match('/\p{Han}+/iu', $comment['text'])) {
                throw new Typecho_Widget_Exception('请输入至少一个汉字', 403);
            }

            if (preg_match('/禁止此消息?/iu', $comment['text'])) {
                throw new Typecho_Widget_Exception('您输入的方式有误', 403);
            }
        }
        if (Helper::options()->plugin('Stay')->mcCheckMail) {
            require_once __DIR__ . '/class/class.email-validate.php';
            $validator = new SMTP_Validate_Email($comment['mail']);
            if (!$validator->validate()[$comment['mail']]) {
              $msgArr = array(
                  '您的邮箱怕是收不到邮件哦',
                  '讲真，这个邮箱真的收不到',
                  '不存在的邮箱地址啦'
              );
              throw new Typecho_Widget_Exception($msgArr[array_rand($msgArr)], 403);
            }
        }
        return $comment;
    }

    /**
     * 评论完成接口
     *
     * @access public
     * @return void
     */
    public static function finishComment($self)
    {
        if (Helper::options()->plugin('Stay')->mcMailer) {
            $sendAdminMail = true;
            $adminMail = Helper::options()->plugin('Stay')->mcAdminMail;
            $user = $self->widget('Widget_User');
            $title = Typecho_Common::subStr($self->title, 0, 30, '...');
            $comment = $self->widget('Widget_Feedback');
            $thisData = self::getCommentData(array(
                'author' => $comment->author,
                'mail' => $comment->mail,
                'url' => $comment->url,
                'text' => $comment->text,
                'created' => $comment->created
            ), $self);

            if ($comment->status === 'approved' && !empty($comment->parent)) {
                $db = Typecho_Db::get();
                $parent = $db->fetchRow(
                    $db
                    ->select('author', 'mail', 'text', 'url', 'created')
                    ->from('table.comments')
                    ->where('coid = ? AND status = ?', $comment->parent, 'approved')
                    ->limit(1)
                );

                if ($parent) {
                    if ($parent['mail'] === $adminMail) {
                        $sendAdminMail = false;
                    }
                    $thisHtml = self::renderHTML($thisData, array(
                        'before' => '<div class="children">',
                        'style' => false,
                        'sign' => false
                    ));
                    $parentData = self::getCommentData($parent, $self);
                    $parentHtml = self::renderHTML($parentData, array(
                        'after' => "{$thisHtml}</div>"
                    ));

                    $address = [$parentData['author'] => $parentData['email']];
                    $subject = "您在 [{$title}] 的评论有了新的回复";

                    @self::sendMail($self, $address, $subject, $parentHtml);
                }
            }

            if ((!$user->mail || $user->mail !== $adminMail) && $sendAdminMail) {
                $subjectAdmin = "[{$title}] 有了新的评论";
                $contentAdmin = self::renderHTML($thisData);
                @self::sendMail($self, ['管理员' => $adminMail], $subjectAdmin, $contentAdmin);
            }
        }

        if ($self->request->isAjax() && function_exists('threadedComments')) {
            threadedComments($self, null);
            exit;
        }
    }

    /**
     * 获取评论内容
     *
     * @access public
     * @return void
     */
    protected static function getCommentData($comment, $self)
    {
        $default = array(
            'author' => '',
            'mail' => '',
            'url' => '',
            'text' => '',
            'created' => ''
        );

        $comment = array_merge($default, $comment);

        $author = $comment['author'];
        $email = $comment['mail'];
        $url = $comment['url'];
        $text = $comment['text'];
        $created = $comment['created'];

        $dateFormat = Helper::options()->commentDateFormat;
        $allowTag = Helper::options()->commentsHTMLTagAllowed;
        $text = Helper::options()->commentsMarkdown ? $self->markdown($text) : $self->autoP($text);

        $time = date($dateFormat, $created);
        $content = Typecho_Common::stripTags($text, '<p><br>' . $allowTag);
        $avatar = Typecho_Common::gravatarUrl($email, 84, 'G', 'retro');

        return array(
            'author' => $author,
            'avatar' => $avatar,
            'content' => $content,
            'email' => $email,
            'time' => $time,
            'url' => $url
        );
    }

    /**
     * 渲染 HTML
     *
     * @access public
     * @return void
     */
    protected static function renderHTML($data = array(), $options = array())
    {
        $default = array(
            'author' => '',
            'avatar' => '',
            'content' => '',
            'time' => '',
            'url' => ''
        );
        $options = array_merge(
            array(
                'before' => '<div class="mail-comment">',
                'after' => '</div>',
                'style' => true,
                'sign' => true
            ),
            $options
        );

        $data = array_merge($default, $data);

        $css = file_get_contents(__DIR__ . "/assets/mail.css");
        $tmpl = file_get_contents(__DIR__ . "/assets/tmpl.html");
        $sign = file_get_contents(__DIR__ . "/assets/sign.html");

        if ($options['sign']) {
            $options['sign'] = $sign;
        }

        $html = str_replace(
            array(
                '{{author}}',
                '{{avatar}}',
                '{{content}}',
                '{{time}}',
                '{{url}}'
            ),
            array(
                $data['author'],
                $data['avatar'],
                $data['content'],
                $data['time'],
                $data['url']
            ),
            $tmpl
        );

        $html = "{$options['before']}{$html}{$options['after']}{$options['sign']}";

        return $options['style'] ? "<style>{$css}</style>{$html}" : $html;
    }

    /**
     * 发送邮件
     *
     * @access public
     * @return void
     */
    protected static function sendMail($self, $address, $subject, $content)
    {
        require_once __DIR__ . '/class/class.phpmailer.php';
        require_once __DIR__ . '/class/class.smtp.php';

        $serverName = $self->request->getServer('SERVER_NAME');
        $form = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($serverName));

        $Mailer = new PHPMailer();
        $Mailer->isSMTP();
        $Mailer->isHTML(true);
        $Mailer->SMTPAuth = true;
        $Mailer->SMTPDebug = 0;
        $Mailer->Debugoutput = 'error_log';
		$Mailer->SMTPSecure = 'ssl';
        $Mailer->XMailer = 'mcMailer';
        $Mailer->Encoding = 'base64';
        $Mailer->From = $form;
        $Mailer->Hostname = $serverName;
        $Mailer->CharSet = Helper::options()->charset;
        $Mailer->FromName = Helper::options()->title;
        $Mailer->Host = Helper::options()->plugin('Stay')->mcSmtpHost;
        $Mailer->Port = Helper::options()->plugin('Stay')->mcSmtpPort;
        $Mailer->Username = Helper::options()->plugin('Stay')->mcSmtpUser;
        $Mailer->Password = Helper::options()->plugin('Stay')->mcSmtpPwd;

        if (is_array($address)) {
            foreach ($address as $key => $val) {
                $key = is_string($key) ? $key : '';
                $Mailer->addAddress($val, $key);
            }
        } elseif (is_string($address)) {
            $Mailer->addAddress($address);
        } else {
            return false;
        }

        $Mailer->Subject = $subject;
        $Mailer->Body = $content;

        return $Mailer->send();
    }
}
