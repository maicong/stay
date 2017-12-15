module.exports = {
  root: true,
  parser: 'babel-eslint',
  parserOptions: {
    sourceType: 'module'
  },
  env: {
    node: true,
    es6: true
  },
  extends: [
    'standard'
  ],
  plugins: [
    'html'
  ],
  rules: {
    'arrow-parens': 0,
    'generator-star-spacing': 0,
    'no-use-before-define': 0,
    'no-debugger': 0,
    'no-console': 0,
    'comma-dangle': 0
  }
}
