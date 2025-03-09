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

// Custom fields
$section_title = get_sub_field('title') ?? '';
$section_cta_description = get_sub_field('section_cta_description') ?? '';
$section_cta_cta = get_sub_field('section_cta_cta_cta_group') ?? '';
$cta_type = get_sub_field('cta_type') ?? '';

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

    <?php 
    if ($section_title) :
        echo '<h2 class="wrapper section-faq__title">' . esc_html($section_title) . '</h2>';
    endif; ?>

    <div class="section-faq__list">
        <?php if (have_rows('questions_and_answers')) :  while (have_rows('questions_and_answers')) : the_row(); 
            $faq_question = get_sub_field('question');
            $faq_answer = get_sub_field('answer');
        ?>

            <div class="section-faq__item">
                <button class="section-faq__question"><?php echo esc_attr($faq_question);?>
                    <span class="section-faq__icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/plus.svg">
                    </span>
                </button>
                <div class="section-faq__answer">
                    <?php echo $faq_answer;?>
                </div>
            </div>

        <?php endwhile; endif; ?>
    </div>
</section>
