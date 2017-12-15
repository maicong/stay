/**
 *
 * webpack 配置
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.0.0
 *
 */

const Webpack = require('webpack')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const ProgressBarPlugin = require('progress-bar-webpack-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const PhpManifestPlugin = require('webpack-php-manifest')
const WriteFilePlugin = require('write-file-webpack-plugin')

const Pkg = require('./package.json')
const { resolve, posix } = require('path')
const IS_PROD = process.env.NODE_ENV === 'production'

process.noDeprecation = true

const config = {
  entry: {
    stay: resolve(__dirname, 'src/js/stay.js')
  },
  output: {
    path: resolve(__dirname, 'build'),
    filename: IS_PROD ? '[name]-[hash:7].min.js' : '[name]-[hash:7].source.js'
  },
  devtool: 'cheap-module-eval-source-map',
  stats: {
    modules: false,
    children: false
  },
  performance: {
    hints: false
  },
  resolve: {
    extensions: ['.js', '.css'],
    modules: [resolve(__dirname, 'src'), 'node_modules']
  },
  module: {
    noParse: /es6-promise\.js$/,
    rules: [
      {
        test: /\.js$/,
        enforce: 'pre',
        loader: 'eslint-loader',
        exclude: /node_modules/,
        options: {
          formatter: require('eslint-friendly-formatter')
        }
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        options: {
          babelrc: false,
          plugins: ['transform-runtime', 'transform-async-to-generator'],
          presets: [
            [
              'env',
              {
                modules: false,
                useBuiltIns: true
              }
            ],
            'stage-0'
          ],
          cacheDirectory: true
        }
      },
      {
        test: require.resolve('zepto'),
        loader: 'imports-loader?this=>window'
      },
      {
        test: /\.css/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                minimize: IS_PROD,
                importLoaders: 1,
                sourceMap: !IS_PROD
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                sourceMap: 'inline'
              }
            }
          ]
        })
      },
      {
        test: /\.(gif|png|jpe?g)$/,
        loader: 'url-loader',
        options: {
          limit: 5120,
          name: posix.join('img', IS_PROD ? '[name]-[hash:7].[ext]' : '[name]-[hash:7].source.[ext]')
        }
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin(['build'], {
      dry: false,
      verbose: true,
      exclude: ['.gitkeep'],
      root: resolve(__dirname)
    }),
    new ExtractTextPlugin({
      disable: false,
      allChunks: true,
      filename: IS_PROD ? '[name]-[contenthash:7].min.css' : '[name]-[contenthash:7].source.css'
    }),
    new PhpManifestPlugin({
      output: 'manifest',
      path: 'assets/build/',
      phpClassName: 'WebpackManifest'
    }),
    new ProgressBarPlugin(),
    new Webpack.optimize.OccurrenceOrderPlugin(),
    new Webpack.optimize.AggressiveMergingPlugin()
  ]
}

if (IS_PROD) {
  config.devtool = false
  config.plugins = config.plugins.concat([
    new UglifyJsPlugin({
      parallel: true,
      uglifyOptions: {
        /* eslint camelcase: 0 */
        mangle: true,
        beautify: false,
        comments: false,
        sourceMap: false,
        compress: {
          unsafe: true,
          warnings: false,
          drop_console: true,
          drop_debugger: true
        },
        output: {
          ascii_only: true,
          comments: false
        }
      }
    }),
    new Webpack.BannerPlugin(`${Pkg.name} v${Pkg.version} - ${Pkg.homepage}`)
  ])
} else {
  config.plugins = config.plugins.concat([
    new Webpack.HashedModuleIdsPlugin(),
    new Webpack.NoEmitOnErrorsPlugin(),
    new WriteFilePlugin()
  ])
}

module.exports = config
