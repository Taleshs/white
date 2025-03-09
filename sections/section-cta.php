<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name');
$custom_id_name = get_sub_field('custom_id_name');
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color');
$sectionID = $custom_id_name ?: $section_fragment;
$section_style_type_cta = get_sub_field('section_style_type_cta');

// Custom fields
$section_title = get_sub_field('section_cta_title');
$section_cta_description = get_sub_field('section_cta_description');
$section_cta_cta = get_sub_field('section_cta_cta_cta_group');
$cta_type = get_sub_field('cta_type'); 
$cta_background_image = get_sub_field('cta_background_image'); 
$cta_parallax_effect = get_sub_field('cta_parallax_effect');
$cta_coupon_infos = get_sub_field('cta_coupon_infos');

$inline_style = '';
if ($force_background_color_bool && $force_background_color) {
    $inline_style .= 'background-color: var(--' . esc_attr($force_background_color) . ');';
}
if (!empty($cta_background_image) && is_array($cta_background_image) && isset($cta_background_image['url']) && !in_array($cta_type, ['default', 'bubble'])) {
    $inline_style .= ' background-image: url(' . esc_url($cta_background_image['url']) . '); background-size: cover; background-position: center;';
}
$inline_style = $inline_style ? 'style="' . trim($inline_style) . '"' : '';

$section_classes = esc_attr(trim("$section_fragment $custom_class_name"));
?>

<?php if ($cta_type == 'default'): ?>
    <section class="<?= $section_classes; ?> cta cta--neutral <?= $section_style_type_cta ? 'cta--neutral-' . esc_attr($section_style_type_cta) : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
        <?php inject_inline_section_css($section_fragment); ?>

        <article class="wrapper cta__container">
            <?php if (!empty($section_title)) : ?>
                <h2><?= esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($section_cta_description)) : ?>
                <?= $section_cta_description; ?>
            <?php endif; ?>

            <?php if ($section_cta_cta) : ?>
                <?php display_button('cta_group'); ?>
            <?php endif; ?>
        </article>

    </section>
<?php endif; ?>


<?php if ($cta_type == 'bubble'): ?>
    <section class="<?= $section_classes; ?> cta cta--bubble <?= $section_style_type_cta ? esc_attr($section_style_type_cta) : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
        <?php inject_inline_section_css($section_fragment); ?>

        <article class="wrapper cta__container">
            <?php if (!empty($section_title)) : ?>
                <h2><?= esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($section_cta_description)) : ?>
                <?= $section_cta_description; ?>
            <?php endif; ?>

            <?php if ($section_cta_cta) : ?>
                <?php display_button('cta_group'); ?>
            <?php endif; ?>
        </article>

    </section>
<?php endif; ?>


<?php if ($cta_type == 'frame'): ?>
    <section class="<?= $section_classes; ?> cta cta--frame <?= $cta_parallax_effect ? 'cta--frame-parallax' : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
        <?php inject_inline_section_css($section_fragment); ?>
        
        <article class="wrapper cta__container">
            <?php if (!empty($section_title)) : ?>
                <h2><?= esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if ($section_cta_cta) : ?>
                <?php display_button('cta_group'); ?>
            <?php endif; ?>
        </article>

    </section>
<?php endif; ?>

<?php if ($cta_type == 'cta_coupon'): ?>
    <section class="<?= $section_classes; ?> cta cta--coupon <?= $section_style_type_cta ? 'cta--coupon-' . esc_attr($section_style_type_cta) : ''; ?> <?= $cta_parallax_effect ? 'cta--coupon-parallax' : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
        <?php inject_inline_section_css($section_fragment); ?>

        <div class="wrapper cta__container">
            <article>
                <?php if (!empty($section_title)) : ?>
                    <h2><?= esc_html($section_title); ?></h2>
                <?php endif; ?>
                
                <?php if (!empty($section_cta_description)) : ?>
                    <?= $section_cta_description; ?>
                <?php endif; ?>

                <?php if ($section_cta_cta) : ?>
                    <?php display_button('cta_group'); ?>
                <?php endif; ?>
            </article>

            <?php if ($cta_coupon_infos) : ?>
                <div class="cta__coupon">
                    <?= $cta_coupon_infos; ?>
                </div>
            <?php endif; ?>
        </div>

    </section>
<?php endif; ?>
