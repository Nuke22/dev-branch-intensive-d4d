const path = require('path')
const HTMLWebpackPlugin = require('html-webpack-plugin')

module.exports = {
  entry: {
    index: path.resolve(__dirname, 'web/themes/custom/subtheme/js/index.js'),
  },
  output: {
    filename: "[name].processed.js",
    path: path.resolve(__dirname, 'web/themes/custom/subtheme/dist')
  },
  plugins: [
    new HTMLWebpackPlugin({
      title: "Webpack not App"
    })
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader']
      }
    ]
  }
}
