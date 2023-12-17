const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    entry: {
        'main': [
            './node_modules/admin-lte/dist/js/adminlte.min.js',
            './node_modules/admin-lte/dist/css/adminlte.min.css'
        ]
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'public/dist'),
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, 'css-loader'],
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ],
    },
    plugins: [new MiniCssExtractPlugin({
        filename: '[name].css',
        chunkFilename: '[id].css',
    })],
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()],
    },
};