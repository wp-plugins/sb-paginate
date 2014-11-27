<?php
function sb_paginate_check_core() {
    $activated_plugins = get_option('active_plugins');
    $sb_core_installed = in_array('sb-core/sb-core.php', $activated_plugins);
    return $sb_core_installed;
}

function sb_paginate_activation() {
    if(!current_user_can('activate_plugins')) {
        return;
    }
    do_action('sb_paginate_activation');
}
register_activation_hook(SB_PAGINATE_FILE, 'sb_paginate_activation');

function sb_paginate_check_admin_notices() {
    if(!sb_paginate_check_core()) {
        unset($_GET['activate']);
        unset($_GET['activate-multi']);
        printf('<div class="error"><p><strong>' . __('Error', 'sb-paginate') . ':</strong> ' . __('The plugin with name %1$s has been deactivated because of missing %2$s plugin', 'sb-paginate') . '.</p></div>', '<strong>SB Paginate</strong>', sprintf('<a target="_blank" href="%s" style="text-decoration: none">SB Core</a>', 'https://wordpress.org/plugins/sb-core/'));
        deactivate_plugins(SB_PAGINATE_BASENAME);
    }
}
if(!empty($GLOBALS['pagenow']) && 'plugins.php' === $GLOBALS['pagenow']) {
    add_action('admin_notices', 'sb_paginate_check_admin_notices', 0);
}

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