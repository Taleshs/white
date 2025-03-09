<?php
/**
 * Template Name: Page Builder
 */

get_header();

// Variável de controle para debug
$debug = false; // Defina como true para ativar o debug

if (have_rows('sections_blocks')) :
    while (have_rows('sections_blocks')) : the_row();

        // Obtém o layout atual
        $current_layout = get_row_layout();

        // Prepara o slug do template (adiciona "section-" e converte underscores para hífens)
        $section_slug = 'section-' . str_replace('_', '-', $current_layout);
        set_query_var('section_fragment', $section_slug);

        // Debug: Exibe informações sobre o layout atual
        if ($debug) {
            echo '<div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border: 1px solid #ccc;">';
            echo '<h3>Debug: current Layout </h3>';
            echo '<pre>';
            echo 'Layout: ' . $current_layout . "\n";
            echo 'Template: sections/' . $section_slug . '.php' . "\n";
            echo '</pre>';
            echo '</div>';
        }

        // Carrega o template da seção
        if (locate_template('sections/' . $section_slug . '.php')) {
            get_template_part('sections/' . $section_slug);
        } else {
            echo '<p>❌ not found: ' . $section_slug . '</p>';
        }

    endwhile;
else :
    echo "<p>❌ Nenhuma seção foi encontrada no loop.</p>";
endif;

get_footer();
