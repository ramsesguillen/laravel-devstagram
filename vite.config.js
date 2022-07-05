import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import autoprefixer from 'autoprefixer';
// import tailwindcss from 'tailwindcss';


// export default defineConfig({
//     plugins: [
//         laravel({
//             postcss: [
//                 'resources/css/app.css',
//                 tailwindcss(),
//                 autoprefixer(),
//             ]
//         })
//     ],
// });

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
