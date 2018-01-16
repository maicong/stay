<?php
/**
 *
 * 评论
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.4.2
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<section id="comments" class="card comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')): ?>
        <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" class="form" role="form">
            <div class="form__text">
                <div class="form__textarea">
                    <textarea name="text" id="form-textarea" class="textarea" placeholder="真知灼见，金玉良言 *" tabindex="1"><?php $this->remember('text'); ?></textarea>
                    <div id="form-face" class="form__face">
                        <div id="form-face-hold" class="form__face__hold"></div>
                        <div id="form-face-list" class="form__face__list">
                            <?php getFaces('html'); ?>
                        </div>
                    </div>
                    <div id="form-error" class="form__error"></div>
                </div>
                <button type="submit" class="submit" tabindex="5">发表<br>评论</button>
            </div>
            <?php if ($this->user->hasLogin()): ?>
                <div class="form__tip">
                    将以 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> 的身份发表评论. <a href="<?php $this->options->logoutUrl(); ?>" title="注销当前身份">退出</a>
                </div>
            <?php else: ?>
                <div id="form-user" class="form__user<?php if ($this->remember('author', true)): ?> form__user__hide<?php endif; ?>">
                    <div class="form__input">
                        <input type="text" name="author" class="text" placeholder="昵称/QQ *" value="<?php $this->remember('author'); ?>" tabindex="2">
                    </div>
                    <div class="form__input form__clear">
                        <input type="email" name="mail" class="text" placeholder="邮箱 *" value="<?php $this->remember('mail'); ?>" tabindex="3">
                    </div>
                    <div class="form__input">
                        <input type="url" name="url" class="text" placeholder="网址" value="<?php $this->remember('url'); ?>" tabindex="4">
                    </div>
                </div>
                <?php if ($this->remember('author', true)): ?>
                    <div class="form__tip">
                        将以 <a href="<?php $this->remember('url'); ?>" rel="external nofollow" target="_blank"><?php $this->remember('author'); ?></a> 的身份发表评论. <a id="form-user-edit" href="###" title="更改身份信息">更改</a>
                    </div>
                <?php else: ?>
                    <div class="form__tip">当昵称为 QQ 时将自动匹配对应昵称和邮箱</div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="form__tip">带符号 * 的表示必填项</div>
        </form>
    <?php else: ?>
        <p class="comment-tip">本页禁止评论，如有疑问请前往 <a href="<?php $this->options->siteUrl('msg'); ?>">留言板</a></p>
    <?php endif; ?>
        <div id="comment-list">
        <?php if ($comments->have()): ?>
            <?php if ($this->request->commentPage > 1): ?>
                <div id="__newpage"></div>
            <?php endif; ?>
            <?php $comments->listComments(); ?>
            <section id="load__more" class="post__more" data-type="comments">
                <?php getCommentsPage('加载更多', 'next'); ?>
            </section>
        <?php endif; ?>
        </div>
</section>
