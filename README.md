# Stay

## 特色介绍

**响应式** 响应式设计模式，兼容各大主流 PC 和 Mobile 浏览器

**无缝加载** 文章和评论列表 Pjax 加载，丝滑般的享受

**清爽页面** 单栏、居中、无广告、无特效，就是这么任性

**醒目标题** 大标题，只为提高浏览效率

**大缩略图** 加一张配图，能让文章更有阅读性

**异步处理** 翻页、评论，统统都是异步处理，只为更好的用户体验

**短代码支持** 主题自带短代码功能，移植至 WordPress

**自定义页头** 页头信息不够？那就自己凑

**页脚统计** 悄悄加上统计代码，就是不显山不漏水

**嵌套评论** 评论排排坐，看上去有趣多了

**评论过滤** 主题搭配的插件，启用后不良评论统统干掉

**评论邮件** 有人发了评论，马上一封通知邮件就送达，不漏过一条评论

**页面压缩** 听说压缩那么一下下可以增加一点点访问速度

## 使用说明

1. 前往 [Releases][1] 下载最新发布版本
2. 将解压后的文件夹重命名为 `stay`
3. 移动主题目录 `stay` 到 Typecho 的 `usr/themes` 里
4. 将 `stay/plugins` 里的主题定制插件 `Stay` 移动到 Typecho 的 `usr/plugins` 里
5. 进入 Typecho 管理后台，在 `控制台->外观` 找到 `Stay` 并启用
6. 进入 Typecho 管理后台，在 `控制台->插件` 找到 `Stay` 并启用

## 功能配置

控制台->外观->设置外观:

> 短代码支持、更改 Gravatar 头像地址、自定义头部信息、增加统计代码

控制台->插件->设置:

> 页面代码压缩、评论内容过滤、评论邮件发送、SMTP 配置

## 支持的短代码

请查看 [SHORTCODE.md][2]

## 特殊操作

`assets` 为主题资源目录，为了更好的开发，我使用了 `webpack` 来构建资源文件

如果你有自定义的样式和脚本内容，可以在 assets 目录里进行增删改，详情使用方法请查看 [assets/README.md][3]

## 使用协议

The MIT License (MIT)

[1]: https://github.com/maicong/stay/releases
[2]: https://github.com/maicong/stay/blob/master/SHORTCODE.md
[3]: https://github.com/maicong/stay/blob/master/assets/README.md
