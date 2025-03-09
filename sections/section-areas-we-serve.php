<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name');
$custom_id_name = get_sub_field('custom_id_name');
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color');
$sectionID = $custom_id_name ?: $section_fragment;
$section_style_type_areas = get_sub_field('section_style_type_areas') ?? '';

//Locations from Page Options
$locations = get_locations();

// Custom fields
$section_title = get_sub_field('section_areas_title') ?? '';
$section_areas_description = get_sub_field('section_areas_description') ?? '';
$section_areas_maps_image = get_sub_field('section_areas_maps_image') ?? '';
$section_areas_cta = get_sub_field('add_cta');
$section_areas_design = get_sub_field('section_areas_design') ?? '';

$inline_style = '';
if ($force_background_color_bool && $force_background_color) {
    $inline_style .= 'background-color: var(--' . esc_attr($force_background_color) . ');';
}

$inline_style = $inline_style ? 'style="' . trim($inline_style) . '"' : '';

$section_classes = esc_attr(trim("$section_fragment $custom_class_name"));
?>

<section class="<?= $section_classes; ?> areas <?= $section_style_type_areas ? 'areas--' . esc_attr($section_style_type_areas) : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>

    <?php inject_inline_section_css($section_fragment); ?>

        <article class="wrapper areas__container">
            <div class="areas__container__head">
                <?php if (!empty($section_title)) : ?>
                    <h2><?= esc_html($section_title); ?></h2>
                <?php endif; ?>

                <?php if (!empty($section_areas_description)) : ?>
                    <?= $section_areas_description; ?>
                <?php endif; ?>
            </div>

            <div class="areas__container__maps areas__container__maps--<?= $section_areas_design;?>">

                <?php if(!empty($section_areas_maps_image)) : ?>
                    <picture>
                        <img src="<?= $section_areas_maps_image['url']; ?>" alt="<?= $section_areas_maps_image['alt']; ?>"/>
                    </picture>
                <?php endif;?>
                <div class="maps__list">
                    <?php if (!empty($locations)): ?>
                        <?php foreach ($locations as $lc): ?>
                            <div class="maps__list__item">
                                <?php echo $lc['icon']; ?>
                                <?php if($lc['title_link_location']):?>
                                <div class="maps__list__content">
                                    <a href="<?=$lc['title_link_location'];?>" <?php echo !empty($lc['open_in_new_tab_location']) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                        <h2><?php echo esc_html($lc['title_location']); ?></h2>
                                        <p><?php echo esc_html($lc['subtitle_location']); ?></p>
                                    </a>
                                </div>
                                <?php else: ?>
                                <div class="maps__list__content">
                                    <h2><?php echo esc_html($lc['title_location']); ?></h2>
                                    <p><?php echo esc_html($lc['subtitle_location']); ?></p>
                                </div>
                                <?php endif;?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($section_areas_cta) : ?>
                <?php display_button('cta_group'); ?>
            <?php endif; ?>
        </article>
</section>