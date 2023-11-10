import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
// import { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig(({ command, mode }) => {
    const env = loadEnv(mode, process.cwd(), '')

    const config = {
        plugins: [
            vue(),
            laravel({
                input: [
                    'resources/sass/app.scss',
                    'resources/js/app.js',
                ],
                // refresh: [
                //     ...refreshPaths,
                //     'app/Http/Livewire/**',
                // ],
            }),
        ],
    }

    if (env.USING_SAIL) {
        config.server = {
            https: false,
            host: true,
            port: 3009,
            hmr: {
                host: '0.0.0.0',
                protocol: 'ws'
            }
        }
    }

    return config
})

