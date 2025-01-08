import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/assets/css/bootstrap.min.css',
                'resources/assets/css/font-awesome.min.css',
                'resources/assets/css/AdminLTE.min.css',
                'resources/assets/js/jquery.min.js',
                'resources/assets/js/bootstrap.min.js',
                'resources/plugin/Chart.js/Chart.js',
                'resources/select2/dist/css/select2.min.css',
                'resources/assets/css/bootstrap-theme.min.css',
                'resources/plugin/Ionicons/css/ionicons.min.css',
                'resources/assets/fontawesome/css/fontawesome.min.css',
                'resources/assets/fontawesome/css/brands.css',
                'resources/assets/fontawesome/css/solid.css',
                'resources/assets/fontawesome/css/all.css',
                'resources/assets/css/ie10-viewport-bug-workaround.css',
                'resources/assets/css/style.css',
                'resources/plugin/datepicker/datepicker3.css',
                'resources/plugin/Lobibox/lobibox.css',
                'resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                'resources/plugin/daterangepicker_old/daterangepicker-bs3.css',
                'resources/plugin/table-fixed-header/table-fixed-header.css',
                'resources/plugin/bower_components/jquery-ui/jquery-ui.min.js',
                'resources/assets/js/jquery.form.min.js',
                'resources/assets/js/jquery-validate.js',
                'resources/assets/js/ie10-viewport-bug-workaround.js',
                'resources/assets/js/script.js',
                'resources/plugin/Lobibox/Lobibox.js',
                'resources/select2/dist/js/select2.min.js',
                'resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
                'resources/plugin/daterangepicker_old/moment.min.js',
                'resources/plugin/daterangepicker_old/daterangepicker.js',
                'resources/assets/js/jquery.canvasjs.min.js',
                'resources/plugin/table-fixed-header/table-fixed-header.js',
                'resources/assets/js/app.js',
                'resources/plugin/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css',
                'resources/plugin/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
		'resources/plugin/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css',
		'resources/plugin/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js'
            ],
            refresh: true,
        }),
        vue()
    ],

    define: {
        'process.env': JSON.stringify(process.env),
    },

    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },

    base: '/'
});
