<?php 
/**
 * Display an H1 section title dynamically.
 *
 * This function retrieves a value from the Advanced Custom Fields (ACF) 
 * using `get_sub_field()`, checks if it is not empty, and then outputs it 
 * inside an <h1> tag with `esc_html()` for security.
 *
 * Usage Example:
 * ```php
 * <section>
 *     <?php display_section_title('hero_section_v1_title'); ?>
 * </section>
 * ```
 *
 * @param string $field_name The name of the ACF sub-field to retrieve.
 */
function display_section_title($field_name) {
    $title = get_sub_field($field_name);
    if (!empty($title)) {
        echo '<h1>' . esc_html($title) . '</h1>';
    }
}
