const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: './src/index.js',
  devServer: { contentBase: './dist' },
  devtool: 'inline-source-map',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist'),
    publicPath: '/'
  },
  plugins: [ 
    new HtmlWebpackPlugin({ 
      title: 'Output Management'
    }), // Rebuilds index file to include bundled scripts
    new HtmlWebpackPlugin({
      title: 'Test HTML',
      filename: 'test.html',
      template: 'src/test.html',
      chunks: []
    }), 
		new CleanWebpackPlugin(['dist']), // Cleans up the dist folder to include only files being used in build
		new MiniCssExtractPlugin({ 
      filename: "[name].css", 
      chunkFilename: "[id].css" // Extract css from sass
    })
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "postcss-loader"]
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          "css-loader",
          "sass-loader"
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: [
          'file-loader'
        ]
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: [
          'file-loader'
        ]
      },
    ]
  }
};