const path = require('path');
const miniCss = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require("html-webpack-plugin");

module.exports = {
    mode: 'production',
    entry: {
        index: path.join(__dirname, './js', 'index.js'),
    },

    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'dist')
    },
    devServer: {

    },
    module: {
        rules: [
        {
            test: /\.css$/,
            use: [
            miniCss.loader,
            'css-loader',
            ]
        },
        {
            test: /\.s[ac]ss$/,
            use: [
            miniCss.loader,
            'css-loader',
            'sass-loader',
            ]
        }
        ]
    },
    plugins: [
    new miniCss(
        {
            filename: 'style.css',
        }
    ),
    new HtmlWebpackPlugin(
        {
            title: "webpack not App"
        }
    )
  ],
}
