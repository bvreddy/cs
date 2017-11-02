const webpack = require('webpack');
const path = require('path');

// const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
// const glob = require('glob');
var glob = require('glob-all');
const PurifyCSSPlugin = require('purifycss-webpack');

module.exports = {

    resolve: {
        alias: {
            sass: path.resolve(__dirname, 'dev/sass/'),
            js: path.resolve(__dirname, 'dev/js/'),
            img: path.resolve(__dirname, 'dev/img/')
        },
        extensions: [".tsx", ".ts", ".js"]
    },

    entry: {
        app: 'js/app.js',
        admin_app: 'js/admin_app.js',
        main: 'sass/main.scss',
        admin_main: 'sass/admin_main.scss',
        // not_direct_use: 'sass/not_direct_use.scss'
    },

    output: {
        path: path.resolve(__dirname, './assets'),
        filename: 'js/[name].js',
        // publicPath: '/wp/wp-content/plugins/test/assets/'
    },


    module: {
        rules: [

            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',

                options: {
                    presets: ['es2015']
                }
            },

            // {
            //     test: /\.tsx?$/,
            //     use: 'ts-loader',
            //     exclude: /node_modules/
            // },

            {
                test: /\.s[ac]ss|css$/,
                use: ExtractTextPlugin.extract({
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                // url: false
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true
                            }
                        },


                    ],
                    fallback: 'style-loader'
                })
            },

            {
                test: /\.(png|jpg|gif)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 81,
                            name: 'img/[name].[ext]'

                        }
                    }
                ]
            },


            {
                test: /\.(svg|woff|woff2|eot|ttf|otf)$/,
                loader: 'file-loader',
                options: {
                    name: 'fonts/[name].[ext]',
                    limit: 50,
                    publicPath: '../'
                },
            },


        ]
    },  //  ## end of - modules


    plugins: [

        new ExtractTextPlugin({
            filename: "css/[name].css",
        }),

        // new PurifyCSSPlugin({
        //     // Give paths to parse for rules. These should be absolute!
        //     paths: glob.sync([
        //         path.join(__dirname, '**/*.html'),
        //         path.join(__dirname, '**/*.php'),
        //         // path.join(__dirname, './dev/js/*.js'),
        //         path.join(__dirname, './assets/js/*.js'),
                
        //     ]),
        //    }),

        // new HtmlWebpackPlugin({
        // }),

    ]




}  //  ## end of - module.exports



