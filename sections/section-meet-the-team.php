<?php
// Default fields
$section_fragment = get_query_var('section_fragment');
$custom_class_name = get_sub_field('custom_class_name') ?? '';
$custom_id_name = get_sub_field('custom_id_name') ?? '';
$force_background_color_bool = get_sub_field('force_background_color_bool');
$force_background_color = get_sub_field('force_background_color') ?? '';
$section_style_type_meet_the_team = get_sub_field('section_style_type_meet_the_team') ?? '';

// Define ID section
$sectionID = $custom_id_name ?: $section_fragment;

// Custom fields
$section_meet_title = get_sub_field('section_meet_title') ?? '';

// Sets the inline style of the background if necessary
$inline_style = ($force_background_color_bool && !empty($force_background_color)) 
    ? 'style="background-color: var(--' . esc_attr($force_background_color) . ');"'
    : '';

// Define CSS classes
$section_classes = trim("$section_fragment $custom_class_name");
if (!empty($section_style_type_meet_the_team)) {
    $section_classes .= " $section_classes-$section_style_type_meet_the_team";
}
?>

<section 
    class="<?php echo esc_attr($section_classes); ?>" 
    id="<?php echo esc_attr($sectionID); ?>" 
    <?php echo $inline_style; ?> >
    
    <?php inject_inline_section_css($section_fragment); //inline css?>

    <?php 
    if ($section_meet_title) :
        echo '<h2 class="wrapper section-our-services__title">' . esc_html($section_meet_title) . '</h2>';
    endif; ?>

    <div class="wrapper">
    <!-- Repeater members -->
    <?php if (have_rows('team_members_repeater')) :  while (have_rows('team_members_repeater')) : the_row(); 
        $member_photo = get_sub_field('member_photo');
        $member_name = get_sub_field('member_name');
        $member_title = get_sub_field('member_title');
        $member_description = get_sub_field('member_description');
    ?>
        <?php 
            echo $member_name;
            echo $member_title;
            echo $member_description;
            if(isset($member_photo)){
                echo esc_url($member_photo['url']);//image
            }
        ?>
        <!-- Repeater social icons inside members -->
        <?php if (have_rows('social_item')) :  while (have_rows('social_item')) : the_row(); 
            $team_member_social_icon = get_sub_field('team_member_social_icon');
            $team_member_social_url = get_sub_field('team_member_social_url');
        ?>
            <?php 
                echo $team_member_social_icon;
                echo $team_member_social_url;
            ?>

        <?php endwhile; endif; ?>
    <?php endwhile; endif; ?>

        
    </div>
</section>
