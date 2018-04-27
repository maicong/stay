# 短代码

> 短代码注册信息在 [`shortcode.php`](shortcode.php)

在线预览：https://maicong.me/shortcode

**自带的短代码列表**

```ubb
[task]项目面板[/task]

[noway]禁止面板[/noway]

[warning]警告面板[/warning]

[buy]购买面板[/buy]

[down]下载面板[/down]

[btntext href="###" target="_blank"]文本按钮[/btntext]

[btnheart href="###" target="_blank"]爱心按钮[/btnheart]

[btnbox href="###" target="_blank"]盒子按钮[/btnbox]

[btnsearch href="###" target="_blank"]搜索按钮[/btnsearch]

[btnlink href="###" target="_blank"]链接按钮[/btnlink]

[btndown href="###" target="_blank"]下载按钮[/btndown]

[btnnext href="###" target="_blank"]箭头按钮[/btnnext]

[btnaudio href="###" target="_blank"]音频按钮[/btnaudio]

[btnvideo href="###" target="_blank"]视频按钮[/btnvideo]

[btncolor href="###" target="_blank"]随机色彩[/btncolor]

[audio src="xxx.mp3" preload="metadata"]音频播放[/audio]

[video src="xxx.mp4" preload="metadata"]视频播放[/video]

[swf]xxx.swf[/swf]

[toggle title="标题"]收缩栏[/toggle]

[tabs]
[item title="标题1"]选项卡1[/item]
[item title="标题2"]选项卡2[/item]
[/tabs]

[friends]
[link href="###" title="友链A说明"]友链A[/link]
[link href="###" title="友链B说明"]友链B[/link]
[/friends]
```

audio 和 video 支持 `autoplay`(自动播放) 和 `loop`(循环) 参数：

```ubb
[audio src="" preload="metadata" autoplay="autoplay" loop="loop"]音频播放[/audio]

[video src="" preload="metadata" autoplay="autoplay" loop="loop"]视频播放[/video]
```

video 和 swf 支持 `width`(宽度) 和 `height`(高度) 参数：

```ubb
[video src="xxx.mp4" preload="metadata" width="640" height="360"]视频播放[/video]

[swf width="640" height="360"]xxx.swf[/swf]
```
