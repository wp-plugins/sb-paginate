<?php
/*
Plugin Name: SB Paginate
Plugin URI: http://hocwp.net/
Description: SB Paginate is a pagination plugin that allows to set up navigation on WordPress site. SB Paginate not only supports the default query but also it can be used to show navigation for the custom query on WordPress.
Author: Lại Đình Cường
Version: 1.0.0
Author URI: http://hocwp.net/
*/

define("SB_PAGINATE_PATH", untrailingslashit(plugin_dir_path( __FILE__ )));

require_once(SB_PAGINATE_PATH."/inc/class-sb-paginate.php");

if(!function_exists("sb_paginate")) {
	function sb_paginate($args = array()) {
		SB_Paginate::show($args);
	}
}

if(!function_exists("sb_paginate_style_and_script")) {
	function sb_paginate_style_and_script() {
		//wp_enqueue_style("sb-paginate-style", plugins_url('css/sb-paginate-style.css', __FILE__ ));
		wp_enqueue_style("sb-paginate-style", plugins_url('css/sb-paginate-style.min.css', __FILE__ ));
		//wp_enqueue_script("sb-paginate", plugins_url("js/sb-paginate-script.js", __FILE__), array("jquery"), false, true);
		wp_enqueue_script("sb-paginate", plugins_url("js/sb-paginate-script.min.js", __FILE__), array("jquery"), false, true);
	}
}
add_action("wp_enqueue_scripts", "sb_paginate_style_and_script");
?>
