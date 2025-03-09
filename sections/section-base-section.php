<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name') ?? '';
$custom_id_name = get_sub_field('custom_id_name') ?? '';
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color') ?? '';
$section_style_type_faq = get_sub_field('section_style_type_faq') ?? '';

// Define ID section
$sectionID = $custom_id_name ?: $section_fragment;


// Sets the inline style of the background if necessary
$inline_style = ($force_background_color_bool && !empty($force_background_color)) 
    ? 'style="background-color: var(--' . esc_attr($force_background_color) . ');"'
    : '';

// Define CSS classes
$section_classes = trim("$section_fragment $custom_class_name");
if (!empty($section_style_type_faq)) {
    $section_classes .= " section-faq--$section_style_type_faq";
}
?>

<section 
    class="<?php echo esc_attr($section_classes); ?>" 
    id="<?php echo esc_attr($sectionID); ?>" 
    <?php echo $inline_style; ?> >
    
    <?php inject_inline_section_css($section_fragment); //inline css?>

    <div class="wrapper">
        <?php display_button('cta_group');?>
    </div>
</section>
