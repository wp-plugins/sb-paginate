<?php
/*
Plugin Name: SB Paginate
Plugin URI: http://hocwp.net/
Description: SB Paginate is a pagination plugin that allows to set up navigation on WordPress site. SB Paginate not only supports the default query but also it can be used to show navigation for the custom query on WordPress.
Author: SB Team
Version: 1.0.3
Author URI: http://hocwp.net/
*/

define("SB_PAGINATE_PATH", untrailingslashit(plugin_dir_path( __FILE__ )));

require_once(SB_PAGINATE_PATH."/inc/class-sb-paginate.php");

if(!function_exists("sb_paginate")) {
	function sb_paginate($args = array()) {
		SB_Paginate::show($args);
	}
}

function sb_paginate_test() {
	return apply_filters("sb_paginate_test", false);
}

if(!function_exists("sb_paginate_style_and_script")) {
	function sb_paginate_style_and_script() {
		if(sb_paginate_test()) {
			wp_enqueue_style("sb-paginate-style", plugins_url('css/sb-paginate-style.css', __FILE__ ));
			wp_enqueue_script("sb-paginate", plugins_url("js/sb-paginate-script.js", __FILE__), array("jquery"), false, true);
		} else {
			wp_enqueue_style("sb-paginate-style", plugins_url('css/sb-paginate-style.min.css', __FILE__ ));
			wp_enqueue_script("sb-paginate", plugins_url("js/sb-paginate-script.min.js", __FILE__), array("jquery"), false, true);
		}
	}
}
add_action("wp_enqueue_scripts", "sb_paginate_style_and_script");

function sb_paginate_settings_link($links) { 
	$settings_link = '<a href="admin.php?page=sb_paginate">Settings</a>';
	array_unshift($links, $settings_link); 
	return $links; 
}
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'sb_paginate_settings_link' );

require_once(SB_PAGINATE_PATH."/admin/sb-admin.php");
?>
