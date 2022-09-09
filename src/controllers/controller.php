<?php
namespace App\Controller;
class Controller {
    public function render($template, $content, $data = []) {
        if ($template) {
            ob_start();
            include(SOURCE_DIR."/views/$content");
            $content = ob_get_clean();
            include(SOURCE_DIR."/views/templates/$template");
        } else {
            include(SOURCE_DIR."/views/$content");
        }
    }
}