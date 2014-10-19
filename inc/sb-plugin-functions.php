<?php
function sb_paginate_check_core() {
    $activated_plugins = get_option('active_plugins');
    $sb_core_installed = in_array('sb-core/sb-core.php', $activated_plugins);
    if(!$sb_core_installed) {
        $sb_plugins = array(SB_PAGINATE_BASENAME);
        $activated_plugins = get_option('active_plugins');
        $activated_plugins = array_diff($activated_plugins, $sb_plugins);
        update_option('active_plugins', $activated_plugins);
    }
    return $sb_core_installed;
}

function sb_paginate_activation() {
    if(!sb_paginate_check_core()) {
        wp_die(sprintf(__('You must install and activate plugin %1$s first! Click here to %2$s.', 'sb-paginate'), '<a href="https://wordpress.org/plugins/sb-core/">SB Core</a>', sprintf('<a href="%1$s">%2$s</a>', admin_url('plugins.php'), __('go back', 'sb-paginate'))));
    }
    do_action('sb_paginate_activation');
}
register_activation_hook(SB_PAGINATE_FILE, 'sb_paginate_activation');

if(!sb_paginate_check_core()) {
    return;
}

function sb_paginate_settings_link($links) {
    if(sb_paginate_check_core()) {
        $settings_link = sprintf('<a href="admin.php?page=sb_paginate">%s</a>', __('Settings', 'sb-paginate'));
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links_' . SB_PAGINATE_BASENAME, 'sb_paginate_settings_link');

function sb_paginate_textdomain() {
    load_plugin_textdomain( 'sb-paginate', false, SB_PAGINATE_DIRNAME . '/languages/' );
}
add_action('plugins_loaded', 'sb_paginate_textdomain');

if(!function_exists('sb_paginate')) {
    function sb_paginate($args = array()) {
        SB_Paginate::show($args);
    }
}

function sb_paginate_test() {
    return apply_filters('sb_testing', false);
}

if(!function_exists('sb_paginate_style_and_script')) {
    function sb_paginate_style_and_script() {
        if(sb_paginate_test()) {
            wp_enqueue_style('sb-paginate-style', SB_PAGINATE_URL . '/css/sb-paginate-style.css');
            wp_enqueue_script('sb-paginate', SB_PAGINATE_URL . '/js/sb-paginate-script.js', array('jquery'), false, true);
        } else {
            wp_enqueue_style('sb-paginate-style', SB_PAGINATE_URL . '/css/sb-paginate-style.min.css');
            wp_enqueue_script('sb-paginate', SB_PAGINATE_URL . '/js/sb-paginate-script.js', array('jquery'), false, true);
        }
    }
}
add_action('wp_enqueue_scripts', 'sb_paginate_style_and_script');

require SB_PAGINATE_INC_PATH . '/sb-plugin-load.php';