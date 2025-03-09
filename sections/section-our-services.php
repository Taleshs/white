<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name') ?? '';
$custom_id_name = get_sub_field('custom_id_name') ?? '';
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color') ?? '';
$section_style_type_our_services = get_sub_field('section_style_type_services') ?? '';
$add_cta_services = get_sub_field('add_cta');

// Define ID section
$sectionID = $custom_id_name ?: $section_fragment;

// Custom fields
$section_title = get_sub_field('title') ?? '';

// Sets the inline style of the background if necessary
$inline_style = ($force_background_color_bool && !empty($force_background_color)) 
    ? 'style="background-color: var(--' . esc_attr($force_background_color) . ');"'
    : '';

// Define CSS classes
$section_classes = trim("$section_fragment $custom_class_name");
if (!empty($section_style_type_our_services)) {
    $section_classes .= " $section_fragment--$section_style_type_our_services";
}
?>

<section 
    class="<?php echo esc_attr($section_classes); ?>" 
    id="<?php echo esc_attr($sectionID); ?>" 
    <?php echo $inline_style; ?> >

    <?php inject_inline_section_css($section_fragment); //inline css?>


    <?php 
    if ($section_title) :
        echo '<h2 class="wrapper section-our-services__title">' . esc_html($section_title) . '</h2>';
    endif; ?>

    <div class="wrapper section-our-services__container">
    <?php if (have_rows('services')) :  while (have_rows('services')) : the_row(); 
        $service_title = get_sub_field('title');
        $custom_icon = get_sub_field('custom_icon');
        $service_icon = get_sub_field('icon');
        $service_icon_svg = get_sub_field('icon_svg');
        $service_description = get_sub_field('description');
    ?>

        <div class="section-our-services__card">
            <figure>
                <?php if (!empty($custom_icon) && !empty($service_icon_svg['url'])) : ?>
                    <span class="custom-icon" style="
                        display: inline-block;
                        width: 50px;
                        height: 50px;
                        -webkit-mask-image: url('<?php echo esc_url($service_icon_svg['url']); ?>');
                        mask-image: url('<?php echo esc_url($service_icon_svg['url']); ?>');
                        -webkit-mask-repeat: no-repeat;
                        mask-repeat: no-repeat;
                        -webkit-mask-size: contain;
                        mask-size: contain;
                        -webkit-mask-position: center;
                        mask-position: center;">
                    </span>
                <?php else : ?>
                    <?php echo $service_icon; ?>
                <?php endif; ?>
            </figure>

            <article>

                <?php if ($service_title) : ?>
                    <h4><?php echo esc_html($service_title); ?></h4>
                <?php endif; ?>
                
                <?php if ($service_description) : ?>
                    <div class="service-description">
                        <?php echo apply_filters('the_content', $service_description); ?>
                    </div>
                <?php endif; ?>

            </article>
        </div>
        
    <?php endwhile; endif; ?>
    </div>


    <?php if($add_cta_services):?>
        <?php display_button('cta_group'); ?>
    <?php endif;?>

</section>