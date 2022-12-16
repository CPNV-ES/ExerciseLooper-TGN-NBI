<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Class for use template
*/

namespace Src\Renderer;

class Renderer
{
    /**
     * Render a view with the specified template and content
     *
     * @param string $template Name of the template file to use, or null to skip using a template
     * @param string $content Name of the view file to render
     * @param array $data Array of data to pass to the view
     */
    public static function render($template, $content, $data = [])
    {
        // Check if a template was specified
        if ($template) {
            // Start output buffering to capture the content view
            ob_start();
            // Include the content view
            include(SOURCE_DIR . "/views/$content");
            // Get the contents of the output buffer and clean it
            $content = ob_get_clean();
            // Include the template with the content view inside
            include(SOURCE_DIR . "/views/templates/$template");
        } else {
            // No template was specified, just include the content view
            include(SOURCE_DIR . "/views/$content");
        }
    }
}
