let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


/*
 |--------------------------------------------------------------------------
 | Mix Configuration SetUp
 |--------------------------------------------------------------------------
 |
 | Configuration for setting up all the conf we need
 |
 */

mix.setPublicPath('public/');
mix.setResourceRoot('../../');

/* TODO Remove source maps sentence in deployment*/

/*
 |--------------------------------------------------------------------------
 | Mix Core
 |--------------------------------------------------------------------------
 |
 | Core Mixes
 |
 */

/* Assets PICS */
mix.copyDirectory('resources/assets/pics', 'public/pics');

/* Assets CSS Vendor */
mix.styles([
        'resources/assets/css/vendor/fontawesome.css',
    ],
    'public/css/vendor/vendor.css').sourceMaps();

mix.styles([
        'resources/assets/css/vendor/fontawesome.css',
        'resources/assets/css/vendor/log-viewer.css',
    ],
    'public/css/vendor/log-viewer.css').sourceMaps();


/* --- General App Section --- */
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css/').sourceMaps();


/*
|--------------------------------------------------------------------------
| Fronted Section
|--------------------------------------------------------------------------
|
| Mixes for the Admin section
|
*/

mix.styles([
        'resources/assets/css/front/bootstrap.css',
        'resources/assets/css/front/slick-theme.css',
        'resources/assets/css/front/slick.css',
        'resources/assets/css/front/carousel.css',
        'resources/assets/css/front/font-awesome.min.css',
        'resources/assets/css/front/layout.css',
        'resources/assets/css/front/custom.css',
        'resources/assets/css/front/plugins.css',
        'resources/assets/css/front/themify-icons.css',
        'resources/assets/css/front/style_general.css',
        'resources/assets/css/front/style-responsive.css'
    ],
    'public/css/front/app.css').sourceMaps();

/* CSS Webfonts folder */
mix.copyDirectory('resources/assets/css/webfonts', 'public/css/webfonts');
mix.copyDirectory('resources/assets/css/front', 'public/css/front');
mix.copyDirectory('resources/assets/js/front', 'public/js/front');
mix.copyDirectory('resources/assets/pics/front', 'public/pics/front');

mix.js('resources/assets/js/front/generalfrontscript.js', 'public/js/generalfrontscript.min.js').sourceMaps();
mix.js('resources/assets/js/front/raffles.js', 'public/js/raffles.min.js').sourceMaps();
mix.js('resources/assets/js/front/front_profile.js', 'public/js/front_profile.min.js').sourceMaps();

/*
 |--------------------------------------------------------------------------
 | Mix Admin Section
 |--------------------------------------------------------------------------
 |
 | Mixes for the Admin section
 |
 */

/* Admin | layout dash */
mix.js('resources/assets/js/admin/admin_dash.js', 'public/js/admin/admin_dash.js')
    .sass('resources/assets/sass/admin/now-ui-dashboard.scss', 'public/css/admin/admin.css').sourceMaps();

/* Theme Section */
mix.js('resources/assets/js/admin/views/login.js', 'public/js/login.js').sourceMaps();

/* Admin | layout views-tables */
// I don't need to include the now-ui-dashboard.scss is included and compiled already in the public asset directory
mix.js('resources/assets/js/admin/admin_views.js', 'public/js/admin/admin_views.js').sourceMaps();

/* Admin | views | billing */
mix.js('resources/assets/js/admin/views/admin/userbilling.js', 'public/js/admin/userbilling.js').sourceMaps();
/* Admin | views | userprofile */
mix.js('resources/assets/js/admin/views/admin/userprofile.js', 'public/js/admin/userprofile.js').sourceMaps();
/* Admin | views | categories */
mix.js('resources/assets/js/admin/views/admin/categories.js', 'public/js/admin/categories.js').sourceMaps();
/* Admin | views | roles */
mix.js('resources/assets/js/admin/views/admin/roles.js', 'public/js/admin/roles.js').sourceMaps();
/* Admin | views | users */
mix.js('resources/assets/js/admin/views/admin/users.js', 'public/js/admin/users.js').sourceMaps();

/* Admin | views | promos list */
mix.js('resources/assets/js/admin/views/admin/promoslist.js', 'public/js/admin/promoslist.js').sourceMaps();
/* Admin | views | promos client */
mix.js('resources/assets/js/admin/views/admin/promosclients.js', 'public/js/admin/promosclients.js').sourceMaps();

/* Admin | views | logs dashboard */
mix.js('resources/assets/js/admin/views/admin/logsdashboard.js', 'public/js/admin/logsdashboard.js').sourceMaps();
/* Admin | views | logs */
mix.js('resources/assets/js/admin/views/admin/logsview.js', 'public/js/admin/logsview.js').sourceMaps();
/* Admin | views | logs show */
mix.js('resources/assets/js/admin/views/admin/logsshow.js', 'public/js/admin/logsshow.js').sourceMaps();
/* Admin | layout views-logsviewer */
mix.js('resources/assets/js/admin/admin_logsviewer.js', 'public/js/admin/admin_logsviewer.js').sourceMaps();

/* Admin | views | published raffles */
mix.js('resources/assets/js/admin/views/admin/praffles.js', 'public/js/admin/praffles.js').sourceMaps();
/* Admin | views | unpublished raffles */
mix.js('resources/assets/js/admin/views/admin/uraffles.js', 'public/js/admin/uraffles.js').sourceMaps();
/* Admin | views | anulled raffles */
mix.js('resources/assets/js/admin/views/admin/araffles.js', 'public/js/admin/araffles.js').sourceMaps();
/* Admin | views | anulled raffles */
mix.js('resources/assets/js/admin/views/admin/payment.js', 'public/js/admin/payment.js').sourceMaps();
/* Admin | views | configs raffles */
mix.js('resources/assets/js/admin/views/admin/configs/configraffles.js', 'public/js/admin/configraffles.js').sourceMaps();

/* TODO use nprogres lib in the admin theme section */

