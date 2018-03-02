'use strict'

/**
 *
 * JS 入口
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.5.0
 *
 */

/* 加载 css */
import '../css/normal'
import '../css/prismjs'
import '../css/face'
import '../css/stay'
import './lib/lazyload'
import './lib/prism'

/* 加载 js */
import $ from 'zepto'
import animateScrollTo from 'animated-scroll-to'
import fastClick from 'fastclick'

/* 核心代码 */
$(function () {
  // 防止重复点击
  fastClick.attach(document.body)

  // 检查是否是本站域名
  const checkDomain = url => {
    const parser = document.createElement('a')
    parser.href = url
    return parser.hostname === document.domain
  }

  // 获取 URL 参数
  const getParam = (url, name) => {
    if (!url) return false
    name = name.replace(/[[\]]/g, '\\$&')
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)')
    const results = regex.exec(url)
    if (!results) return null
    if (!results[2]) return ''
    return decodeURIComponent(results[2].replace(/\+/g, ' '))
  }

  // 是否是 Mobile
  const isMobile = () => {
    return /(iPad|iPhone|iPod|Android|webOS|Mobile)/g.test(navigator.userAgent)
  }

  // 加入历史记录
  const pushState = (title, link) => {
    if (window.history && window.history.pushState) {
      window.history.pushState(null, title, link)
    }
  }

  // 图片延迟加载
  const imgLazyLoad = img => {
    $(img).lazyload({
      effect: 'fadeIn',
      placeholder_data_img:
        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P8+vXrfwAJpgPg8gE+iwAAAABJRU5ErkJggg=='
    })
  }

  // 转换秒为分钟
  const sec2minute = sec => {
    return [
      parseInt(sec / 60 % 60),
      parseInt(sec % 60)
    ].join(':').replace(/\b(\d)\b/g, '0$1')
  }

  // Ajax 翻页
  $('#post-list, #comment-list').on('click', '#load__more', function (e) {
    e.preventDefault()
    const $load = $(this)
    const type = $load.data('type')
    const link = $('.next', $load).attr('href')
    if (link && checkDomain(link)) {
      $load.html('<div class="loading"><span></span><span></span><span></span><div>')
      $('#__newpage').remove()
      $.get(link, r => {
        if (r) {
          const title = Array.from($(r))
            .find(v => $(v)[0].tagName === 'TITLE')
            .textContent
          const hash = Array.from($(r))
            .find(v => $(v)[0].name === 'respond-hash')
            .content
          switch (type) {
            case 'posts':
              const posts = $(r)
                .find('#post-list')
                .html()
              if (posts) {
                $('#post-list').append(posts)
                $('[name="respond-hash"]').attr('content', hash)
                $load.remove()
                document.title = title
                pushState($(title).text(), link)
                imgLazyLoad('.post__thumb img')
                $('#__newpage').length && animateScrollTo($('#__newpage').offset().top)
              }
              break
            case 'comments':
              const comments = $(r)
                .find('#comment-list')
                .html()
              if (comments) {
                $('#comment-list').append(comments)
                $('[name="respond-hash"]').attr('content', hash)
                $load.remove()
                document.title = title
                pushState(title, link)
                imgLazyLoad('.comments .avatar')
                $('#__newpage').length && animateScrollTo($('#__newpage').offset().top)
              }
              break
          }
        }
      })
    }
  })

  // Ajax 评论
  var commentIsPosting = false
  $('#comment-form').on('submit', function (e) {
    e.preventDefault()
    $('#form-face').removeClass('form__face__active')
    const $form = $(this)
    const data = $form.serializeArray()
    const hash = $('[name="respond-hash"]').attr('content')
    const replyTo = $form.data('replyTo')
    const isValid = []
    let isPost = false
    let action = $form.attr('action')
    const showMsg = (msg, type, name, time, cb) => {
      const $err = $('#form-error')
      const types = ['success', 'info', 'warning']
      let timerA
      let timerB
      type = $.inArray(type, types) > -1 ? type : 'info'
      name = name || null
      time = time || 2000
      cb = cb || null
      cb = $.isFunction(time) ? time : cb
      time = $.isNumeric(name) ? name : time
      $err.removeClass('form__error__show __success __info __warning')
      const __show = () => {
        if (!$.isNumeric(name) && !isMobile()) {
          $form.find('[name="' + name + '"]').focus()
        }
        $form.find('.submit').prop('disabled', true)
        $err.html(msg).addClass('form__error__show __' + type)
        const ___show = () => {
          if (time > 0) {
            $form.find('.submit').prop('disabled', false)
            $err.removeClass('form__error__show')
            setTimeout(() => {
              $err.removeClass('__success __info __warning')
            }, 200)
          }
          if (cb) {
            cb()
          }
        }
        if (time < 0) {
          ___show()
        } else {
          if (timerB) {
            clearTimeout(timerB)
          }
          timerB = setTimeout(() => {
            ___show()
          }, time)
        }
      }
      if (time < 0) {
        __show()
      } else {
        if (timerA) {
          clearTimeout(timerA)
        }
        timerA = setTimeout(() => {
          __show()
        }, 220)
      }
    }
    if (action.indexOf('?') > -1) {
      action = action + '&_=' + hash
    } else {
      action = action + '?_=' + hash
    }
    $.each(data, (i, field) => {
      const msgs = {
        text: '还是说点什么吧',
        author: '阁下如何称呼呢',
        mail: '留个邮箱方便联系'
      }
      const val = field.value.replace(/[\s]+/g, '')
      let msg = ''
      if (val) {
        if (field.name === 'mail' && !/^([^@]+)@([^.]+)\.([^.]+)/.test(val)) {
          msg = '这个邮箱收不到邮件啊'
        }
        if (field.name === 'url' && !/^https?:\/\/([^.]+)\.([^.]+)/.test(val)) {
          msg = '这个网站打不开啊'
        }
      } else {
        if (msgs[field.name]) {
          msg = msgs[field.name]
        }
      }
      if (msg) {
        showMsg(msg, 'info', field.name)
        return false
      } else {
        isValid[i] = true
      }
    })
    if (isValid.length === data.length && !commentIsPosting) {
      commentIsPosting = true
      let wait = 30
      let waiting = setInterval(() => {
        if (wait < 10) {
          showMsg('正在提交，请稍候 (' + wait + ') ...', 'info', 10000)
          if (wait < 1) {
            clearInterval(waiting)
            if (!isPost) {
              showMsg('提交失败，可能是超时了', 'warning', 15000, () => {
                commentIsPosting = false
              })
            }
          }
        } else {
          showMsg('正在提交，请稍候 (' + wait + ') ...', 'info', -1)
        }
        wait--
      }, 1000)
      $.post(action, data, r => {
        if (r) {
          isPost = true
          clearInterval(waiting)
          commentIsPosting = false
          if (r.message) {
            showMsg(r.message, 'warning')
          } else {
            $form.find('[name="text"]').val('')
            showMsg('评论发表成功', 'success', 1500, () => {
              if (replyTo) {
                r = '<div class="children new__comment"><ol class="comment-list">' + r + '</ol></div>'
                $form.before(r)
                animateScrollTo($('#li-comment-' + replyTo).offset().top)
              } else {
                $('#comment-list').prepend('<ol class="comment-list">' + r + '</ol>')
                animateScrollTo($('#comment-list').offset().top)
              }
              imgLazyLoad('.comments .avatar')
            })
          }
        }
      })
    }
  })

  // 更改身份
  $('#form-user-edit').on('click', function (e) {
    e.preventDefault()
    $(this)
      .parent()
      .remove()
    $('#form-user').removeClass('form__user__hide')
  })

  // 回复评论
  $('#comments').on('click', '.comment__reply', function (e) {
    e.preventDefault()
    const $comments = $('#comments')
    const $form = $('#comment-form')
    const $reply = $(this)
    const href = $reply.attr('href')
    let action = $form.attr('action')
    if ($reply.hasClass('cancel__reply')) {
      $reply.text('回复').removeClass('cancel__reply')
      $form.attr('action', action.replace(/parent=\d+&?/, '')).data('replyTo', null)
      $comments.prepend($form.removeClass('form__reply'))
      animateScrollTo($comments.offset().top)
      return false
    }
    if (checkDomain(href)) {
      const replyTo = getParam(href, 'replyTo')
      const parent = getParam(action, 'parent')
      if (replyTo && $.isNumeric(replyTo)) {
        if (parent) {
          action = action.replace(/parent=\d+/, 'parent=' + replyTo)
        } else {
          if (action.indexOf('?') > -1) {
            action = action
              .replace('?', '?parent=' + replyTo + '&')
              .replace('??', '?')
              .replace('&&', '&')
          } else {
            action += '?parent=' + replyTo
          }
        }
        $comments
          .find('.comment__reply')
          .text('回复')
          .removeClass('cancel__reply')
        $form.attr('action', action).data('replyTo', replyTo)
        $reply.parent().append($form.addClass('form__reply'))
        $reply.text('取消回复').addClass('cancel__reply')
        animateScrollTo($reply.parent().offset().top, {
          onComplete () {
            if (!isMobile()) {
              $form.find('[name="text"]').focus()
            }
          }
        })
      }
    }
  })

  // 表情
  $('#form-face-hold').on('click', () => {
    $('#form-face').toggleClass('form__face__active')
  })
  $('#form-face-list').on('click', '.face', function () {
    const sTag = $(this).data('tag')
    const $textarea = $('#form-textarea')
    const tElement = $textarea[0]
    const tValue = $textarea.val()
    const tStart = tElement.selectionStart
    const tEnd = tElement.selectionEnd
    const rStart = tStart === tEnd ? tStart + sTag.length : tStart
    const rEnd = tStart + sTag.length
    $textarea.val(`${tValue.substring(0, tStart)}${sTag}${tValue.substring(tEnd)}`)
    tElement.setSelectionRange(rStart, rEnd)
    if (!isMobile()) {
      $textarea.focus()
    }
  })

  // 文章伸缩框
  $('.toggle-title').on('click', function () {
    $(this).parent().toggleClass('active')
  })

  // 选项卡
  $('.tabs-title').on('click', 'li', function (e) {
    e.preventDefault()
    const index = $(this).index()
    $(this).parent().find('li').removeClass('active')
    $(this).addClass('active')
    $('.tabs-content').removeClass('active')
    $('#mc-tab-' + index).addClass('active')
  })

  // 打赏按钮
  $('#post-donate-btn').on('click', function () {
    $('#post-donate-list').toggleClass('post__donate__list--active')
  })

  // 外链新窗口打开
  $('#post-content, #comments').on('click', 'a[href^="http"]', function () {
    const href = $(this).attr('href')
    if (!checkDomain(href)) {
      $(this).attr('target', '_blank')
    }
  })

  // 文章图片居中
  $('#post-content img').each(function () {
    const img = new window.Image()
    img.src = $(this).data('original')
    img.onload = () => {
      if (
        img.width >= $('#post-content').width() * (2 / 3) &&
        img.height >= img.width * (1 / 3)
      ) {
        $(this).addClass('card aligncenter')
      }
    }
  })

  // 文章语音朗读
  let speechList = []
  let speechIndex = 0
  let speechIsGet = false
  $('#post-text2speech').on('click', function () {
    if (speechIsGet) return
    const $self = $(this)
    const $text = $('#post-text2speech-text')
    const $time = $('#post-text2speech-time')
    const $progress = $('#post-text2speech-progress')
    let currentTime = 0
    let duration = 0

    if (speechList.length) {
      const speech = speechList[speechIndex]
      if (!speech.paused) {
        speech.pause()
      } else {
        speech.play()
      }
      return
    }

    speechIsGet = true
    $text.text('正在转换, 请稍后...')

    $.get('', { do: 'getSpeech' }, r => {
      speechIsGet = false
      if (!r || !r.data || !Array.isArray(r.data)) {
        $text.text('转换失败, 点击重试')
        return
      }
      r.data.forEach(v => {
        const speech = new window.Audio(v)
        speech.preload = 'metadata'
        speechList.push(speech)

        $(speech).on('play', () => {
          $text.text('正在朗读...')
          $self.addClass('isPlaying')
        })
        $(speech).on('pause', () => {
          $text.text('朗读已暂停')
          $self.removeClass('isPlaying')
        })
        $(speech).on('loadedmetadata', () => {
          duration = duration + speech.duration
          $time.text(`00:00 / ${sec2minute(duration)}`)
        })
        $(speech).on('timeupdate', () => {
          const nowTime = currentTime + speech.currentTime
          $progress.css('width', (nowTime / duration * 100).toFixed(2) + '%')
          $time.text(`${sec2minute(nowTime)} / ${sec2minute(duration)}`)
        })
        $(speech).on('ended', () => {
          currentTime += speech.duration
          if (speechIndex >= speechList.length - 1) {
            speechIndex = 0
            currentTime = 0
            $text.text('点击重新朗读')
          } else {
            speechIndex += 1
            speechList[speechIndex].play()
          }
        })
        $(speech).on('error', () => {
          $text.text('语音资源加载失败')
        })
      })

      if (isMobile()) {
        $text.text('转换成功, 点击朗读')
      } else {
        speechList[0].play()
      }
    })
  })

  // 返回顶部
  $('#footer-beaker').on('click', () => {
    animateScrollTo(0)
  })

  // 滚动事件
  $(window).on('scroll', function () {
    const $beaker = $('#footer-beaker')
    const $span = $('span', $beaker)
    const docH = $(document).height()
    const winT = $(this).scrollTop()
    const winH = $(this).height()
    const spanH = $span.height()
    const scroll = Math.floor(spanH - spanH / 100 * (winT / (docH - winH)) * 100) + 'px'
    if (winT > 500) {
      $beaker.addClass('footer__beaker__on')
      $span.css({
        backgroundPositionY: scroll
      })
    } else {
      $beaker.removeClass('footer__beaker__on')
    }
  })

  // 加载事件
  $(window).on('load', () => {
    imgLazyLoad('.post__thumb img, .post__content img, .comments .avatar')
  })

  // 清除 Zepto
  window.Zepto = window.$ = undefined
})
