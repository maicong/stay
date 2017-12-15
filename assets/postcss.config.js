/**
 *
 * postcss 配置
 *
 * @author  MaiCong <i@maicong.me>
 * @link    https://github.com/maicong/stay
 * @since   1.0.0
 *
 */

module.exports = {
  plugins: [
    require('postcss-cssnext')({
      warnForDuplicates: false,
      browsers: [
        'Chrome >= 28',
        'Firefox >= 28',
        'Edge >= 12',
        'Explorer >= 9',
        'Safari >= 5.1',
        'iOS >= 7',
        'Android >= 4',
        'ExplorerMobile >= 11',
        'ChromeAndroid >= 54',
        'FirefoxAndroid >= 50',
        'UCAndroid >= 11',
        'OperaMobile >= 12.1',
        'BlackBerry >= 10',
        'Samsung >= 4'
      ]
    }),
    require('postcss-pxtorem')({
      rootValue: 12,
      propList: ['*'],
      mediaQuery: true
    }),
    process.env.NODE_ENV === 'production' &&
      require('cssnano')({
        preset: 'default',
        reduceIdents: false,
        zindex: false
      })
  ]
}
