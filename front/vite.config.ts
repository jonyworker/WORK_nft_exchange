import {defineConfig} from 'vite';
import vue from '@vitejs/plugin-vue';
import * as path from 'path';
import AutoImport from 'unplugin-auto-import/vite';
 // windi css 样式框架
import vueJsx from '@vitejs/plugin-vue-jsx'; // JSX语法编写组件
export default defineConfig(() => {
    return {
        // base: './dist/', //打包路径
        base: './', // index.html文件所在位置
        root: './', // js导入的资源路径，src
        build: {
            outDir: '../public/dist',
            assetsDir: 'dist',
            cssCodeSplit: false,
            rollupOptions: {
                output: {
                    entryFileNames: `assets/[name].js`,
                    chunkFileNames: `assets/js/[name].js`,
                    assetFileNames: `assets/[name].[ext]`,
                }
            }
        },
        plugins: [
            vue({
                // refTransform: true //开启ref转换 使用$ref
            }),
            // ElementPlus({
            //   useSource: true,
            // }),
            // gzip压缩 生产环境生成 .gz 文件
            vueJsx({}),
            
            AutoImport({
                imports: ['vue', 'vue-router'],
            }),
        ],
        // 配置别名
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'src'),
            '@utils': path.resolve(__dirname, 'src/utils'),
            '@api': path.resolve(__dirname, 'src/api'),
            '@components': path.resolve(__dirname, 'src/components'),
            '@store': path.resolve(__dirname, 'src/store'),
            '@enum': path.resolve(__dirname, 'src/enum'),
        },
        extensions: ['.js', '.ts', '.json', '.vue'], //导入文件省略后缀
    },
    //启动服务配置
    server: {
        open: true,
        https: false,
        strictPort: true,
        port: 8088,
        host: 'localhost',
        hmr: { overlay: true },
        proxy: {
            // '^/api/login': {
            //     target: 'http://www.nftotal.io/',
            //     //  target: 'http://www.farm01.com/',
            //     ws: true, // 代理的WebSockets
            //     changeOrigin: true, // 允许websockets跨域
            // },
            '^/api': {
                target: 'https://v2admin.nftotal.io/',
                //  target: 'http://www.farm01.com/',
                ws: true, // 代理的WebSockets
                changeOrigin: true, // 允许websockets跨域
            },
        },
    },
    //css全局预处理器
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: '@use "@/assets/style/theme.scss" as *;',
            },
        },
        postcss: {
            plugins: [
                // 移除打包element时的@charset警告
                {
                    postcssPlugin: 'internal:charset-removal',
                    AtRule: {
                        charset: (atRule) => {
                            if (atRule.name === 'charset') {
                                atRule.remove();
                            }
                        },
                    },
                },
            ],
        },
    },

}});