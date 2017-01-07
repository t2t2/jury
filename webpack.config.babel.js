import path from 'path'

import ExtractTextPlugin from 'extract-text-webpack-plugin'
import webpack from 'webpack'
import ManifestPlugin from 'webpack-manifest-plugin'
import merge from 'webpack-merge'
import WebpackCleanupPlugin from 'webpack-cleanup-plugin'
import WebpackNotifierPlugin from 'webpack-notifier'

const BASE_SETTINGS = {
	entry: {
		shared: ['./site/templates/scripts/entry/shared.js', './site/templates/styles/entry/shared.scss'],
		vendor: ['./site/templates/scripts/empty.js']
	},
	output: {
		filename: '[name].js',
		path: path.resolve(__dirname, 'public/static'),
		publicPath: '/static/'
	},
	module: {
		rules: [
			{test: /\.js$/, exclude: /node_modules/, loader: 'babel-loader'},
			{
				test: /\.scss$/,
				loader: ExtractTextPlugin.extract({
					loader: ['css-loader', 'postcss-loader', 'sass-loader'],
					fallbackLoader: 'style-loader'
				})
			},
			{
				test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
				loader: 'url',
				query: {
					limit: 10000,
					name: 'img/[name].[hash:7].[ext]'
				}
			},
			{
				test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
				loader: 'url',
				query: {
					limit: 10000,
					name: 'fonts/[name].[hash:7].[ext]'
				}
			}
		]
	},
	plugins: [
		new WebpackCleanupPlugin(),
		new webpack.optimize.CommonsChunkPlugin({
			names: ['vendor', 'manifest'] // Specify the common bundle's name.
		})
	]
}

const DEV_SETTINGS = {
	devtool: 'inline-source-map',
	plugins: [
		new ExtractTextPlugin({
			filename: '[name].css' // Leave it to hot reloading
		}),
		new webpack.DefinePlugin({
			'process.env': {
				NODE_ENV: '"development"'
			}
		}),
		new webpack.NamedModulesPlugin(),
		new WebpackNotifierPlugin()
	],
	devServer: {
		contentBase: false,
		inline: true,
		hot: true,
		noInfo: true
	}
}

const PROD_SETTINGS = {
	output: {
		filename: '[name].[chunkhash].js'
	},
	plugins: [
		new ManifestPlugin({
			basePath: '/static/',
			fileName: 'rev-manifest.json'
		}),
		new ExtractTextPlugin({
			filename: '[name].[contenthash].css'
		}),
		new webpack.DefinePlugin({
			'process.env': {
				NODE_ENV: '"production"'
			}
		})
	]
}

export default function ({
	prod = false
} = {}) {
	let settings
	if (prod) {
		settings = merge(BASE_SETTINGS, PROD_SETTINGS)
	} else {
		settings = merge(BASE_SETTINGS, DEV_SETTINGS)
	}

	return settings
}
