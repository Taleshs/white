<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name');
$custom_id_name = get_sub_field('custom_id_name');
$sectionID = $custom_id_name ?: $section_fragment;

// Custom fields
$hero_layout = get_sub_field('hero_layout') ?? '';
$section_hero_title = get_sub_field('section_hero_title') ?? '';
$section_hero_sub_title = get_sub_field('section_hero_sub_title') ?? '';
$section_hero_description = get_sub_field('section_hero_description') ?? '';
$section_hero_image = get_sub_field('section_hero_image') ?? '';
$section_hero_form_background_image = get_sub_field('section_hero_form_background_image') ?? '';
$section_hero_form_background_overlay_color = get_sub_field('section_hero_form_background_overlay_color') ?? '';

//form
$section_hero_form_title = get_sub_field('section_hero_form_title') ?? '';
$section_hero_form_description = get_sub_field('section_hero_form_description') ?? '';
$promotion_badge = get_sub_field('promotion_badge') ?? '';
$promotion_badge_content = get_sub_field('promotion_badge_content') ?? '';
$contact_form_integration = get_sub_field('contact_form_integration') ?? '';

$inline_style = '';
if ($section_hero_form_background_overlay_color) {
    $inline_style .= 'background-color: ' . esc_attr($section_hero_form_background_overlay_color) . ';';
}
if (!empty($section_hero_form_background_image) && is_array($section_hero_form_background_image) && isset($section_hero_form_background_image['url'])) {
    $inline_style .= ' background-image: url(' . esc_url($section_hero_form_background_image['url']) . '); background-size: cover; background-position: center;';
}

$inline_style = $inline_style ? 'style="' . trim($inline_style) . '"' : '';

$section_classes = esc_attr(trim("$section_fragment $custom_class_name"));
?>

<section class="<?= $section_classes; ?>" id="<?= esc_attr($sectionID); ?>" >
    <?php inject_inline_section_css($section_fragment); ?>

    <section class="hero">
        <div class="background-cover" <?= $inline_style; ?>></div>
        <div class="hero__container">
            <div class="hero__content">
            <?php 
            if ($section_hero_title) :
                echo '<h1 class="hero__title">' . esc_html($section_hero_title) . '</h1>';
            endif; ?>
            <?php 
            if ($section_hero_sub_title) :
                echo '<p class="hero__subtitle">' . esc_html($section_hero_sub_title) . '</p>';
            endif ;?>

            <?php 
            if ($section_hero_description) :
                echo '<div class="hero__list">' . $section_hero_description . '</div>';
            endif ;?>
                
                
            </div>
            <div class="hero__image">
                <img src="<?php echo $section_hero_image['url'];?>" alt="<?php echo $section_hero_image['alt'];?>">
            </div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section__container">
            <?php 
            if ($section_hero_form_title) :
                echo '<h2 class="form-section__title">' . $section_hero_form_title . '</h2>';
            endif; ?>

            <?php
                if ($hero_layout === 'variant_one' && $promotion_badge && $promotion_badge_content) {
                    echo '<p class="form-section__discount">' . $promotion_badge_content . '</p>';
                } elseif ($hero_layout === 'variant_two' && $section_hero_form_description) {
                    echo '<p class="hero__subtitle">' . $section_hero_form_description . '</p>';
                }
            ?>

            <?php 
            if ($contact_form_integration) :
                echo do_shortcode($contact_form_integration);
            endif; ?>
           
        </div>
    </section>
</section>
