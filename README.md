# Stay - 一款响应式 Typecho 主题

[![GitHub release](https://img.shields.io/github/release/maicong/stay.svg?style=flat-square)](https://github.com/maicong/stay/releases)
[![GitHub repo size in bytes](https://img.shields.io/github/repo-size/maicong/stay.svg?style=flat-square)](https://github.com/maicong/stay/pulse)
[![Typecho](https://img.shields.io/badge/typecho-%3E%3D%201.0-blue.svg?style=flat-square)](https://github.com/typecho/typecho)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](#LICENSE)

- [使用说明](#使用说明)
- [特色介绍](#特色介绍)
- [功能配置](#功能配置)
  - [自定义设置](#自定义设置)
  - [开启评论分页](#开启评论分页)
  - [更换头部背景图](#更换头部背景图)
  - [百度BDUSS](#百度bduss)
- [预览图](#预览图)

## 使用说明

1. 前往 [Releases](https://github.com/maicong/stay/releases) 下载最新发布版本
2. 将解压后的文件夹重命名为 `stay`
3. 移动主题目录 `stay` 到 Typecho 的 `usr/themes` 里
4. 将 `stay/plugins` 里的主题定制插件 `Stay` 移动到 Typecho 的 `usr/plugins` 里
5. 进入 Typecho 管理后台，在 `控制台->外观` 找到 `Stay` 并启用
6. 进入 Typecho 管理后台，在 `控制台->插件` 找到 `Stay` 并启用

## 特色介绍

> 自带的短代码列表请查看 [SHORTCODE.md](SHORTCODE.md)

> 如果你有自定义的样式和脚本内容，可以在 [assets](assets) 目录进行增删改

**响应式**

响应式设计模式，兼容各大主流 PC 和 Mobile 浏览器

**无缝加载**

文章和评论列表 Pjax 加载，丝滑般的享受

**清爽页面**

单栏、居中、无广告、无特效，就是这么任性

**醒目标题**

大标题，只为提高浏览效率

**大缩略图**

加一张配图，能让文章更有阅读性

**异步处理**

翻页、评论，统统都是异步处理，只为更好的用户体验

**短代码支持**

主题自带短代码功能，移植至 WordPress

**自定义页头**

页头信息不够？那就自己凑

**页脚统计**

悄悄加上统计代码，就是不显山不漏水

**嵌套评论**

评论排排坐，看上去有趣多了

**评论过滤**

主题搭配的插件，启用后不良评论统统干掉

**评论邮件**

有人发了评论，马上一封通知邮件就送达，不漏过一条评论

**评论表情**

没有表情的评论，总觉得少了点什么

**页面压缩**

听说压缩那么一下下可以增加一点点访问速度

**文章打赏**

如果觉得文章不错，那就打赏点小钱

**语音朗读**

如果觉得看文章太累，那就用耳朵听吧

## 功能配置

### 自定义设置

进入 `控制台->外观->设置外观`，可配置：

> 添加分类到导航、短代码支持、文章打赏、更改 Gravatar 头像地址、自定义头部信息、增加统计代码

进入 `控制台->插件->设置`，可配置：

> 页面代码压缩、评论内容过滤、评论邮件发送、SMTP 配置

### 开启评论分页

进入 `控制台->设置->评论`，使用下面的设置：

> 启用分页, 并且每页显示 `10` 篇评论, 在列出时将 `第一页` 作为默认显示

> 将 `较新的` 的评论显示在前面

### 更换头部背景图

选择一张比较大的图片，替换掉 `assets/src/img/` 目录下的 `bg_header.jpg` 即可。

### 百度BDUSS

1. 前往 [passport.baidu.com](https://passport.baidu.com/)
2. 使用 Chrome 登录后右键点击 `审查元素` 或 `检查`
3. 切换到 `Application`
4. 点开左侧目录的 `Cookies` 并选中 `https://passport.baidu.com`
5. 找到 `BDUSS` 对应的 Value，双击后复制

如图位置：

![百度BDUSS](https://ww4.sinaimg.cn/large/0060lm7Tly1fnak8p8pjgj30uj0fjwhf.jpg)

## 预览图

首页/列表

![首页/列表](https://ww3.sinaimg.cn/large/0060lm7Tly1fmmmcx73gjj31kw10k1ky.jpg)

文章

![文章](https://ww4.sinaimg.cn/large/0060lm7Tly1fmmmcvy4b8j31kw10yx6p.jpg)

评论

![评论](https://ww1.sinaimg.cn/large/0060lm7Tly1fmmmcslxq2j31kw10y7cg.jpg)

## 使用协议

The MIT License (MIT)
