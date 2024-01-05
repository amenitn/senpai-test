const HtmlWebpackPlugin = require('html-webpack-plugin');
const path = require('path');
const isProduction = process.env.NODE_ENV === 'production';

const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");

const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const CreateFileWebpack = require('create-file-webpack');

//const stylesHandler = 'style-loader';
const stylesHandler = MiniCssExtractPlugin.loader;


let htaccessoptions = {
    // path to folder in which the file will be created
    path: './dist',
    // file name
    fileName: '.htaccess',
    // content of the file
    content: 'Allow From All'
};

const config  = {
  entry: {
    "main/senpai-wp-test-loader": path.resolve(__dirname, 'src','main.js'),
    "main/senpai-wp-test-public": path.resolve(__dirname, 'src','public.js'),
    "main/senpai-wp-form-public": path.resolve(__dirname, 'src','form.js')
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].js',
    clean: true
  },
  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
   },
   performance: {
        maxEntrypointSize: 1024000,
        maxAssetSize: 1024000
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: 'static/index.html',
    }),
    new MiniCssExtractPlugin(),
    new CreateFileWebpack(htaccessoptions),
  ],
  watchOptions: {
    ignored: ['./node_modules/']
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/i,
        loader: 'babel-loader',
      },
      {
        test: /\.css$/i,
        use: [stylesHandler, 'css-loader', 'postcss-loader'],
      },
      {
        test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
        type: 'asset',
      },
    ],
  },
};

module.exports = () => {
  if (isProduction) {
    config.mode = 'production';
  } else {
    config.mode = 'development';
  }
  return config;
};