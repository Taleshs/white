<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name');
$custom_id_name = get_sub_field('custom_id_name');
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color');
$sectionID = $custom_id_name ?: $section_fragment;
$section_style_type_logos = get_sub_field('section_style_type_logos') ?? '';

// Custom fields
$section_stripe_cta = get_sub_field('section_logo_stripe_cta_group');
$section_title = get_sub_field('section_logos_title') ?? '';
$section_logos_description = get_sub_field('section_logos_description');
$behaviour_logos_strip = get_field('behaviour_logos_strip', 'option') ? '' : '--unset';

$inline_style = '';
if ($force_background_color_bool && $force_background_color) {
    $inline_style .= 'background-color: var(--' . esc_attr($force_background_color) . ');';
}

$inline_style = $inline_style ? 'style="' . trim($inline_style) . '"' : '';

$section_classes = esc_attr(trim("$section_fragment $custom_class_name"));
?>

<section class="<?= $section_classes; ?> logos <?= $section_style_type_logos ? 'logos--' . esc_attr($section_style_type_logos) : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
<?php inject_inline_section_css($section_fragment); ?>

    <article class="logos__heading">
        <h2 class="logos__title"><?php echo $section_title; ?></h2>
        <?php echo $section_logos_description; ?>
    </article>
    
    <div class="logos__carousel">
        <div class="logos__track<?= $behaviour_logos_strip;?>">
            <?php echo get_logos_strip(); ?>
        </div>
    </div>
    <?php if($section_stripe_cta['add_cta']):?>
        <div class="logos__cta">
            <?php display_button('cta_group');?>
        </div>
    <?php endif;?>
    
</section>

