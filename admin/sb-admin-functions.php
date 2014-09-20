<?php
if(!defined("SB_ADMIN_VERSION")) {
    define("SB_ADMIN_VERSION", "1.0.0");
}

if(!defined("SB_VERSION")) {
    define("SB_VERSION", SB_ADMIN_VERSION);
}

if(!defined("SB_ADMIN_PATH")) {
    define("SB_ADMIN_PATH", untrailingslashit(plugin_dir_path( __FILE__ )));
}

if(!function_exists("sb_add_submenu_page")) {
    function sb_add_submenu_page($title, $slug, $callback) {
        add_submenu_page('sb_options', $title, $title, 'manage_options', $slug, $callback);
    }
}

if(!function_exists("sb_get_current_page")) {
    function sb_get_current_page() {
        return isset($_REQUEST["page"]) ? $_REQUEST["page"] : '';
    }
}

if(!function_exists("sb_options_page")) {
    function sb_options_page() {
        $page = sb_get_current_page();
        if("sb_options" == $page) {
            return true;
        }
        return false;
    }
}

if(!function_exists("sb_add_setting_section")) {
    function sb_add_setting_section($section_id, $section_title, $page_slug) {
        add_settings_section($section_id, $section_title, 'sb_option_description_callback', $page_slug);
    }
}

if(!function_exists("sb_option_description_callback")) {
    function sb_option_description_callback($args) {
        if($args["id"] == "sb_options_section") {
            echo "Short description about SB Options.";
        } else {
            _e("Change your settings below:", "sbteam");
        }
    }
}

if(!function_exists("sb_add_setting_field")) {
    function sb_add_setting_field($field_id, $field_title, $section_id, $callback, $page_slug) {
        add_settings_field($field_id, $field_title, $callback, $page_slug, $section_id);
    }
}