<?php
class Page {
    private static $base_path = 'View/';

    static function render($view) {
        $filepath = self::$base_path . $view . ".php";

        try {
            if(file_exists($filepath)) {
                require_once PROJECT_ROOT . "/View/Default.php";
                require_once PROJECT_ROOT . "/" . $filepath;
                echo "</body>";
                echo "</html>";
            }
        } catch(Exception $ex) {
            throw $ex;
        }
    }
}
?>