<?php 

// Remove Yoast SEO generator tag
add_filter('wpseo_debug_markers', '__return_false');

// Disabling default file editor
if(!defined('DISALLOW_FILE_EDIT')):
	define('DISALLOW_FILE_EDIT', true);
endif;

//Allow SVG to be uploaded
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

//Return All TopBar Fields
function promotion_top_bar_settings() {
    $top_bar_settings = get_field('general_options_top_bar_promotion_top_bar_group', 'option');

    $read_more_button = !empty($top_bar_settings['promotion_top_bar_group_read_more_buttom_cta_group']) 
        ? $top_bar_settings['promotion_top_bar_group_read_more_buttom_cta_group'] 
        : null;

    return [
        'alert_icon' => !empty($top_bar_settings['promotion_top_bar_group_alert_icon']) ? $top_bar_settings['promotion_top_bar_group_alert_icon'] : '',
        'info_text' => !empty($top_bar_settings['promotion_top_bar_group_info_text']) ? $top_bar_settings['promotion_top_bar_group_info_text'] : '',
        'long_text' => !empty($top_bar_settings['promotion_top_bar_group_long_text']) ? $top_bar_settings['promotion_top_bar_group_long_text'] : '',
        'info_text_mobile' => !empty($top_bar_settings['promotion_top_bar_group_info_text_mobile']) ? $top_bar_settings['promotion_top_bar_group_info_text_mobile'] : '',
        'long_text_mobile' => !empty($top_bar_settings['promotion_top_bar_group_long_text_mobile']) ? $top_bar_settings['promotion_top_bar_group_long_text_mobile'] : '',

        'custom_color' => !empty($top_bar_settings['general_options_top_bar_custom_color']) ? $top_bar_settings['general_options_top_bar_custom_color'] : '',
        'custom_color_text' => !empty($top_bar_settings['general_options_top_bar_custom_text_color']) ? $top_bar_settings['general_options_top_bar_custom_text_color'] : '',

        'read_more_button' => [
            'enabled' => !empty($read_more_button['add_cta']) ? (bool) $read_more_button['add_cta'] : false,
            'label' => !empty($read_more_button['cta_group_label']) ? $read_more_button['cta_group_label'] : '',
            'link' => !empty($read_more_button['cta_group_link']) ? $read_more_button['cta_group_link'] : '',
            'target' => !empty($read_more_button['cta_group_open_in_a_new_tab']) ? '_blank' : '_self',
            'icon_type' => !empty($read_more_button['cta_group_icon_type']) ? $read_more_button['cta_group_icon_type'] : '',
            'custom_icon' => !empty($read_more_button['cta_group_custom_icon']['url']) ? $read_more_button['cta_group_custom_icon']['url'] : '',
            'font_awesome' => !empty($read_more_button['cta_group_font_awesome']) ? $read_more_button['cta_group_font_awesome'] : '',
            'icon_position' => !empty($read_more_button['cta_group_icon_position']) ? $read_more_button['cta_group_icon_position'] : '',
            'filled_style' => !empty($read_more_button['cta_group_filled_style']) ? $read_more_button['cta_group_filled_style'] : '',
        ]
    ];
}



//Return All Headers Fields
function header_settings_logo_group() {
    $logo_settings = get_field('header_settings_logo_group', 'option');

    return [
        'logo' => !empty($logo_settings['logo_group_image']['url']) ? $logo_settings['logo_group_image']['url'] : '',
        'logo_dark_mode' => !empty($logo_settings['logo_group_image_dark_mode']['url']) ? $logo_settings['logo_group_image_dark_mode']['url'] : '',
        'max_width' => !empty($logo_settings['logo_group_max_width']) ? $logo_settings['logo_group_max_width'] : '',
        'max_width_mobile' => !empty($logo_settings['logo_group_max_width_mobile']) ? $logo_settings['logo_group_max_width_mobile'] : '',
        'centered_logo' => isset($logo_settings['logo_group_centered_logo']) ? (bool) $logo_settings['logo_group_centered_logo'] : false, 
    ];
}

//Return All Footer Fields
function footer_settings_logo_group() {
    $logo_settings = get_field('footer_settings_logo_group', 'option');

    if ($logo_settings) {
        return [
            'logo' => !empty($logo_settings['logo_group_image']) ? $logo_settings['logo_group_image']['url'] : '',
            'logo_dark' => !empty($logo_settings['logo_group_image_dark_mode']) ? $logo_settings['logo_group_image_dark_mode']['url'] : '',
            'favicon' => !empty($logo_settings['logo_group_favicon']) ? $logo_settings['logo_group_favicon']['url'] : '',
            'max_width' => !empty($logo_settings['logo_group_max_width']) ? $logo_settings['logo_group_max_width'] : '',
            'max_width_mobile' => !empty($logo_settings['logo_group_max_width_mobile']) ? $logo_settings['logo_group_max_width_mobile'] : '',
        ];
    }

    return [];
}

//Return Enable Top Bar
function enable_top_bar() {
    return get_field('general_options_top_bar_enable_top_bar', 'option') ? true : false;
}

//Return Enable Top Bar
function hide_top_bar_on_mobile() {
    return get_field('general_options_top_bar_hide_promotion_top_bar_on_mobile', 'option') ? true : false;
}
//Return Enable Top Bar
function sticky_top_bar() {
    return get_field('general_options_top_bar_sticky_promotion_top_bar', 'option') ? true : false;
}

//Return Stick header
function stick_header() {
    return get_field('header_settings_stick_header', 'option') ? true : false;
}

//Return Dark Mode
function dark_mode_header() {
    return get_field('header_settings_dark_mode', 'option') ? true : false;
}

//Return Contact Info
function show_contact_info() {
    return get_field('header_settings_show_contact_info', 'option') ? true : false;
}

//Return Google Badge
function show_google_badge() {
    return get_field('header_settings_show_google_badge', 'option') ? true : false;
}

function filled_button_style() {
    return get_field('theme_styles_filled_button_style', 'option') ? true : false;
}



//Social links
function get_social_links() {
    $social_repeater = get_field('general_options_social_repeater', 'option');
    $social_links = [];

    if (!empty($social_repeater)) {
        foreach ($social_repeater as $social) {
            $social_links[] = [
                'custom_svg' => !empty($social['social_repeater_custom_svg_icon']) ? $social['social_repeater_custom_svg_icon'] : '',
                'icon' => !empty($social['social_repeater_icon']) ? $social['social_repeater_icon'] : '',
                'url' => !empty($social['social_repeater_url_icon']) ? $social['social_repeater_url_icon'] : '',
            ];
        }
    }

    return $social_links;
}

//Return Phone Number
function get_primary_phone_numbers() {
    $phone_repeater = get_field('general_options_phone_number_repeater', 'option');
    $primary_phones = [];

    if (!empty($phone_repeater)) {
        foreach ($phone_repeater as $phone) {
            if (!empty($phone['phone_number_repeater_define_as_primary'])) { 
                $primary_phones[] = [
                    'label' => !empty($phone['phone_number_repeater_label']) ? $phone['phone_number_repeater_label'] : '',
                    'icon' => !empty($phone['phone_number_repeater_icon_phone']) ? $phone['phone_number_repeater_icon_phone'] : '',
                    'number' => !empty($phone['phone_number_repeater_data_primary_phone']) ? $phone['phone_number_repeater_data_primary_phone'] : '',
                ];
            }
        }
    }

    return $primary_phones;
}

//Return Clean Phone number
function clean_phone_number($phone) {
    return preg_replace('/\D+/', '', $phone);
}

//Return Badges
function get_badges() {
    $badges_repeater = get_field('footer_settings_badges_repeater', 'option');
    $badges = [];

    if (!empty($badges_repeater)) {
        foreach ($badges_repeater as $badge) {
            $badges[] = [
                'logo' => !empty($badge['badges_repeater_logo']['url']) ? $badge['badges_repeater_logo']['url'] : '',
                'url' => !empty($badge['badges_repeater_url']) ? $badge['badges_repeater_url'] : '',
                'open_in_new_tab' => !empty($badge['badges_repeater_open']) ? true : false, 
            ];
        }
    }

    return $badges;
}


//Return Global Address
function get_global_address() {
    $address_group = get_field('general_options_global_address_group', 'option');

    return [
        'address' => !empty($address_group['global_address_group_address']) ? $address_group['global_address_group_address'] : '',
        'email' => !empty($address_group['global_address_group_email']) ? $address_group['global_address_group_email'] : '',
    ];
}

//Return Working Hours
function get_working_hours() {
    $working_hours_repeater = get_field('general_options_working_hours_repeater', 'option');
    $working_hours = [];

    if (!empty($working_hours_repeater)) {
        foreach ($working_hours_repeater as $hours) {
            $working_hours[] = [
                'days' => !empty($hours['working_hours_repeater_days_of_week']) ? $hours['working_hours_repeater_days_of_week'] : '',
                'hours' => !empty($hours['working_hours_repeater_working_hours']) ? $hours['working_hours_repeater_working_hours'] : '',
            ];
        }
    }

    return $working_hours;
}

//Return Global Locations
function get_locations() {
    $locations_repeater = get_field('locations_repeater', 'option');
    $location_icon_type = get_field('location_icon_type', 'option');
    $locations_icon_font_awesome = get_field('locations_icon_font_awesome', 'option');
    $locations_icon_custom_svg = get_field('locations_icon_custom_svg', 'option');

    $icon = '';
    if ($location_icon_type === 'font_awesome') {
        $icon = !empty($locations_icon_font_awesome) ? $locations_icon_font_awesome : '';
    } elseif ($location_icon_type === 'svg_icon') {
        $icon = !empty($locations_icon_custom_svg) ? '<img src="' . esc_attr($locations_icon_custom_svg['url']) . '"/>' : '';
    } elseif ($location_icon_type === 'default') {
        $icon = '<span class="pin"></span>';
    }

    $locations = [];

    if (!empty($locations_repeater)) {
        foreach ($locations_repeater as $location) {
            $locations[] = [
                'title_location' => !empty($location['title_location']) ? $location['title_location'] : '',
                'subtitle_location' => !empty($location['subtitle_location']) ? $location['subtitle_location'] : '',
                'title_link_location' => !empty($location['title_link_location']) ? $location['title_link_location'] : '',
                'open_in_new_tab_location' => !empty($location['open_in_new_tab_location']) ? $location['open_in_new_tab_location'] : '',
                'icon' => $icon, 
            ];
        }
    }

    return $locations;
}

//Return Global Icons
function get_logos_strip() {
    $logos = get_field('general_options_logos_strip', 'option');
    $output = '';

    if (!empty($logos) && is_array($logos)) {
        foreach ($logos as $logo) {
            $img_id = $logo['ID']; 
            $img_url = esc_url($logo['url']);
            $img_alt = esc_attr($logo['alt']);

            $link_url = get_field('attachment_logo_url', $img_id);
            $new_tab = get_field('attachment_new_tab', $img_id);

            $target = !empty($new_tab) && $new_tab ? ' target="_blank" rel="noopener noreferrer"' : '';

            $output .= '<div class="logos__slide">';

            if (!empty($link_url)) {
                $output .= '<a href="' . esc_url($link_url) . '"' . $target . ' class="logos__link">';
            }

            $output .= '<picture class="logos__image">';
            $output .= '<img src="' . $img_url . '" alt="' . $img_alt . '">';
            $output .= '</picture>';

            if (!empty($link_url)) {
                $output .= '</a>';
            }

            $output .= '</div>';
        }
    }

    return $output;
}

function behaviour_logos_strip() {
    return get_field('behaviour_logos_strip', 'option') ? 'logos__track' : 'logos__track--unset';
}