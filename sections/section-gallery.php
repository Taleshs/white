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
$section_title = get_sub_field('section_gallery_title') ?? '';
$section_logos_description = get_sub_field('section_gallery_description');
$behaviour_logos_strip = get_field('behaviour_logos_strip', 'option') ? '' : '--unset';

$inline_style = '';
if ($force_background_color_bool && $force_background_color) {
    $inline_style .= 'background-color: var(--' . esc_attr($force_background_color) . ');';
}

$inline_style = $inline_style ? 'style="' . trim($inline_style) . '"' : '';

$section_classes = esc_attr(trim("$section_fragment $custom_class_name"));
?>

<section class="<?= $section_classes; ?> gallery <?= $section_style_type_logos ? 'gallery--' . esc_attr($section_style_type_logos) : ''; ?>" id="<?= esc_attr($sectionID); ?>" <?= $inline_style; ?>>
<?php inject_inline_section_css($section_fragment); ?>

    <article class="gallery__heading">
        <h2 class="gallery__title"><?php echo $section_title; ?></h2>
        <?php echo $section_logos_description; ?>
    </article>
    <div class="gallery__lightbox">
        <?php
            $gallery = get_sub_field('section_gallery_items');

            if (!empty($gallery) && is_array($gallery)) {
                foreach ($gallery as $img) {
                    $img_id = $img['ID']; 
                    $img_url = esc_url($img['url']);
                    $img_alt = esc_attr($img['alt']);

                    $link_url = get_field('attachment_logo_url', $img_id);
                    $new_tab = get_field('attachment_new_tab', $img_id);
                    $target = !empty($new_tab) && $new_tab ? ' target="_blank" rel="noopener noreferrer"' : '';

                    echo '<div class="gallery__slide">';

                    // Link externo, se houver
                    if (!empty($link_url)) {
                        echo '<a href="' . esc_url($link_url) . '"' . $target . ' class="gallery__link">';
                    }

                    // Link da imagem para abrir no GLightbox
                    echo '<a href="' . $img_url . '" class="glightbox gallery__image" data-gallery="gallery1">';
                    echo '<img src="' . $img_url . '" alt="' . $img_alt . '">';
                    echo '</a>';

                    // Fecha o link externo, se houver
                    if (!empty($link_url)) {
                        echo '</a>';
                    }

                    echo '</div>';
                }
            }
        ?>
    </div>
    
</section>

