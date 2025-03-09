<?php 
/**
 * Injects section-specific CSS inline into the page.
 *
 * This function retrieves the CSS file associated with a section block,
 * reads its contents, minifies the CSS by removing extra spaces, and 
 * injects it inside a <style> tag in the page's HTML.
 *
 * @param string $section_fragment The section identifier (e.g., 'hero-section-v1').
 */
function inject_inline_section_css($section_fragment) {
    // Ensure the section fragment is provided
    if (empty($section_fragment)) {
        return;
    }

    // Construct the absolute path to the section's CSS file
    $css_file_path = get_template_directory() . '/dist/sections/' . $section_fragment . '.css';

    // Check if the CSS file exists before attempting to read it
    if (file_exists($css_file_path)) {
        // Read the contents of the CSS file
        $inline_css = file_get_contents($css_file_path);

        // Minify the CSS by removing unnecessary spaces and line breaks
        $inline_css = preg_replace('/\s+/', ' ', trim($inline_css));

        // Output the CSS within a <style> tag, ensuring safe output with wp_kses_post()
        echo '<style>' . wp_kses_post($inline_css) . '</style>';
    }
}
