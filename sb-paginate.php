<?php
/*
Plugin Name: SB Paginate
Plugin URI: http://hocwp.net/
Description: SB Paginate is a pagination plugin that allows to set up navigation on WordPress site. SB Paginate not only supports the default query but also it can be used to show navigation for the custom query on WordPress.
Author: SB Team
Version: 1.0.4
Author URI: http://hocwp.net/
Text Domain: sb-paginate
Domain Path: /languages/
*/

define('SB_PAGINATE_FILE', __FILE__);

define('SB_PAGINATE_PATH', untrailingslashit(plugin_dir_path(SB_PAGINATE_FILE)));

define('SB_PAGINATE_URL', plugins_url('', SB_PAGINATE_FILE));

define('SB_PAGINATE_INC_PATH', SB_PAGINATE_PATH . '/inc');

define('SB_PAGINATE_BASENAME', plugin_basename(SB_PAGINATE_FILE));

define('SB_PAGINATE_DIRNAME', dirname(SB_PAGINATE_BASENAME));

require SB_PAGINATE_INC_PATH . '/sb-plugin-functions.php';
