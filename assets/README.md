# 调试或打包资源文件

[![node](https://img.shields.io/badge/node-%3E%3D%206.9.0-green.svg?style=flat-square)]()

> 注意：Node.js 版本需要大于等于 6.9.0

此为主题资源目录，为了更好的开发，使用了 `webpack` 来构建资源文件

开发前，建议查阅 [Node.js 开发文档][1]、[webpack 中文文档][2]、[ECMAScript 6 features][3]、[Front-End Checklist][4]

## 新手说明

`src` 是源文件目录，`build` 是打包后的文件目录，开发完成后可以只上传或保留 `build` 就行。

## 特性介绍

- 自动构建
- 代码检测
- 代码压缩
- 样式预处理
- 脚本预处理


## 风格说明

- JS 尽量使用 ES6/7
- 使用 2 个 Space 缩进
- 语法结尾不加分号
- 方法括号前要有一个空格
- 代码行后要空一行
- UTF-8 编码
- 换行符是 LF

## 命令说明

如果使用的是 Yarn:

```bash
# 安装依赖
yarn install

# 调试模式
yarn run dev

# 打包模式
yarn run build
```

如果使用的是 NPM:

```bash
# 安装依赖
npm install

# 调试模式
npm run dev

# 打包模式
npm run build
```

[1]: https://nodejs.org/api/all.html
[2]: https://doc.webpack-china.org/concepts/
[3]: https://github.com/lukehoban/es6features
[4]: https://github.com/thedaviddias/Front-End-Checklist
