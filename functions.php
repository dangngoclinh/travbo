<?php
define('THEME_NAME', 'TravBo');
define('THEME_FOLDER', 'travbo');
define('THEME_VERSION', '1.0');
define('THEME_PREFIX', 'travbo_');

define('TRAVBO_THEME', 'travbo');
define("TRAVBO_URL", get_template_directory_uri());
define("TRAVBO_DIR", get_template_directory());

define("TRAVBO_RATE_RATING", '_travbo_rate_rating');
define("TRAVBO_RATE_TOTAL", '_travbo_rate_total');

require_once TRAVBO_DIR . '/framework/functions/theme-functions.php';
require_once TRAVBO_DIR . '/framework/functions/breadcrumbs.php';
require_once TRAVBO_DIR . '/framework/functions/scripts.php';
require_once TRAVBO_DIR . '/framework/functions/customize.php';
require_once TRAVBO_DIR . '/framework/functions/quicktags.php';
require_once TRAVBO_DIR . '/framework/functions/meta-box.php';
require_once TRAVBO_DIR . '/admin/index.php';
require_once TRAVBO_DIR . '/framework/widgets.php';
require_once TRAVBO_DIR . '/framework/class-tgm-plugin-activation.php';