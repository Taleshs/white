<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name');
$custom_id_name = get_sub_field('custom_id_name');
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color');
$sectionID = $custom_id_name ?: $section_fragment;
$section_style_type_testimonial_solo = get_sub_field('section_style_type_testimonial_solo') ?? '';

// Custom fields
$testimonial_solo_starts = get_sub_field('testimonial_solo_starts') ?? '';
$testimonial_solo_quote = get_sub_field('testimonial_solo_quote') ?? '';
$testimonial_solo_author = get_sub_field('testimonial_solo_author') ?? '';
$testimonial_solo_from = get_sub_field('testimonial_solo_from') ?? '';
$testimonial_solo_image  = get_sub_field('testimonial_solo_image') ?? '';

// Ensure $rating is not null; default to 0 if invalid
$testimonial_solo_starts = is_numeric($testimonial_solo_starts) ? floatval($testimonial_solo_starts) : 0;

// Round up the rating
$rounded_rating = ceil($testimonial_solo_starts);

// Determine the number of stars
$full_stars = floor($testimonial_solo_starts); // Full stars
$half_star = ($rounded_rating > $full_stars) ? 1 : 0; // Half star if needed
$empty_stars = 5 - ($full_stars + $half_star); // Remaining empty stars

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

    <section class="<?= $section_classes; ?> testimonial <?= $section_style_type_testimonial_solo ? 'testimonial--' . esc_attr($section_style_type_testimonial_solo) : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
        <?php inject_inline_section_css($section_fragment); ?>

    <article class="wrapper testimonial__container">

        <?php if(isset($testimonial_solo_image)):?>
            <div class="testimonial__container__image">
                <picture>
                    <img src="<?php echo esc_url($testimonial_solo_image['url']);?>" alt="<?php echo esc_attr($testimonial_solo_image['alt']);?>"  loading="lazy"/>
                </picture>
            </div>
        <?php endif;?>

        <div class="testimonial__container__details">
            <div class="testimonial__container__stars">
            <?php 
                // Render full stars
                for ($i = 0; $i < $full_stars; $i++) {
                    echo '<span class="full"></span>';
                }

                // Render half star if applicable
                if ($half_star) {
                    echo '<span class="half"></span>';
                }

                // Render empty stars
                for ($i = 0; $i < $empty_stars; $i++) {
                    echo '<span class="empty"></span>';
                }
            ?>
            </div>
            <blockquote class="testimonial__container__text">
                <p>Oscar and the team at Blue Bayou Roofing were amazing from start to finish! They were professional, efficient, and kept me informed throughout the entire process. The quality of their work is outstanding, and my roof looks better than ever. I couldn’t have asked for a better experience. Highly recommend them!</p>
            </blockquote>
            <div class="testimonial__container__author-box">
                <div class="testimonial__container__author-box__author">Wendy Boudreaux</div>
                <div class="testimonial__container__author-box__source">via Facebook</div>
            </div>
            <?php display_button('cta_group');?>
        </div>

    </article>
</section>
