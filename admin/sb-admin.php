<?php
if(!defined("SB_ADMIN_VERSION")) {
    require_once(trailingslashit(plugin_dir_path( __FILE__ ))."sb-admin-functions.php");
}
if(!class_exists("SB_Admin")) {
	require_once(trailingslashit(plugin_dir_path( __FILE__ ))."class-sb-admin.php");
}

$sb_admin = new SB_Admin();

function sb_paginate_menu() {
    sb_add_submenu_page("SB Paginate", "sb_paginate", "sb_paginate_menu_callback");
}
add_action("sb_admin_menu", "sb_paginate_menu");

function sb_paginate_tab($tabs) {
    $tabs["sb_paginate"] = array('title' => "SB Paginate", 'section_id' => "sb_paginate_section");
    return $tabs;
}
add_filter("sb_admin_tabs", "sb_paginate_tab");

function sb_paginate_setting_field() {
    sb_add_setting_section("sb_paginate_section", __("SB Paginate options page", "sbteam"), "sb_paginate");
    sb_add_setting_field("sb_paginate_range", "Range", "sb_paginate_section", "sb_paginate_range_callback", "sb_paginate");
    sb_add_setting_field("sb_paginate_anchor", "Anchor", "sb_paginate_section", "sb_paginate_anchor_callback", "sb_paginate");
    sb_add_setting_field("sb_paginate_gap", "Gap", "sb_paginate_section", "sb_paginate_gap_callback", "sb_paginate");
    sb_add_setting_field("sb_paginate_style", "Style", "sb_paginate_section", "sb_paginate_style_callback", "sb_paginate");
    sb_add_setting_field("sb_paginate_border_radius", "Border radius", "sb_paginate_section", "sb_paginate_border_radius_callback", "sb_paginate");
}
add_action("sb_admin_init", "sb_paginate_setting_field");

function sb_paginate_range_callback() {
    $options = get_option("sb_options");
    $value = isset($options["paginate"]["range"]) ? $options["paginate"]["range"] : 3;
    $description = __("The number of page links to show before and after the current page.", "sbteam");
    printf('<input type="number" id="%1$s" name="%2$s" value="%3$s" class="" min="1" max="100"><p class="description">%4$s</p>', 'sb_paginate_range', esc_attr("sb_options[paginate][range]"), $value, $description);
}

function sb_paginate_anchor_callback() {
    $options = get_option("sb_options");
    $value = isset($options["paginate"]["anchor"]) ? $options["paginate"]["anchor"] : 1;
    $description = __("The number of page links to show at beginning and end of pagination.", "sbteam");
    printf('<input type="number" id="%1$s" name="%2$s" value="%3$s" class="" min="1" max="10"><p class="description">%4$s</p>', 'sb_paginate_anchor', esc_attr("sb_options[paginate][anchor]"), $value, $description);
}

function sb_paginate_gap_callback() {
    $options = get_option("sb_options");
    $value = isset($options["paginate"]["gap"]) ? $options["paginate"]["gap"] : 3;
    $description = __("The minimum number of page links before ellipsis shows.", "sbteam");
    printf('<input type="number" id="%1$s" name="%2$s" value="%3$s" class="" min="1" max="100"><p class="description">%4$s</p>', 'sb_paginate_gap', esc_attr("sb_options[paginate][gap]"), $value, $description);
}

function sb_paginate_style_callback() {
    $args = array(
        "default" => "Default",
        "orange" => "Orange",
        "dark" => "Dark"
    );
    $styles = apply_filters("sb_paginate_style", $args);
    $name = "sb_paginate_style";
    $options = get_option("sb_options");
    $value = isset($options["paginate"]["style"]) ? $options["paginate"]["style"] : "default";
    $description = __("Choose style color for pagination.", "sbteam");
    ?>
    <label for="<?php echo $name; ?>"></label>
    <select id="<?php echo $name; ?>" name="<?php echo esc_attr("sb_options[paginate][style]"); ?>">
        <?php foreach($styles as $key => $title) : ?>
            <option value="<?php echo $key; ?>"<?php selected( $value, $key ); ?>><?php echo $title; ?></option>
        <?php endforeach; ?>
    </select>
    <p class="description"><?php echo $description; ?></p>
    <?php
}

function sb_paginate_border_radius_callback() {
    $args = array(
        "default" => "Default",
        "elipse" => "Elipse",
        "none" => "None"
    );
    $styles = apply_filters("sb_paginate_border_radius", $args);
    $name = "sb_paginate_border_radius";
    $options = get_option("sb_options");
    $value = isset($options["paginate"]["border_radius"]) ? $options["paginate"]["border_radius"] : "default";
    $description = __("You can make navigation buttons have border radius or not.", "sbteam");
    ?>
    <label for="<?php echo $name; ?>"></label>
    <select id="<?php echo $name; ?>" name="<?php echo esc_attr("sb_options[paginate][border_radius]"); ?>">
        <?php foreach($styles as $key => $title) : ?>
            <option value="<?php echo $key; ?>"<?php selected( $value, $key ); ?>><?php echo $title; ?></option>
        <?php endforeach; ?>
    </select>
    <p class="description"><?php echo $description; ?></p>
<?php
}

function sb_paginate_menu_callback() {
    include(SB_ADMIN_PATH."/sb-setting-page.php");
}

function sb_paginate_sanitize($input) {
    $data = array();
    $data = get_option("sb_options");
    $data["paginate"]["range"] = isset($input["paginate"]["range"]) ? $input["paginate"]["range"] : 3;
    $data["paginate"]["gap"] = isset($input["paginate"]["gap"]) ? $input["paginate"]["gap"] : 3;
    $data["paginate"]["anchor"] = isset($input["paginate"]["anchor"]) ? $input["paginate"]["anchor"] : 1;
    $data["paginate"]["style"] = isset($input["paginate"]["style"]) ? $input["paginate"]["style"] : "default";
    $data["paginate"]["border_radius"] = isset($input["paginate"]["border_radius"]) ? $input["paginate"]["border_radius"] : "default";
    return $data;
}
add_filter("sb_options_sanitize", "sb_paginate_sanitize");

?>