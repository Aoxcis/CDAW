<?php
class AutoLoader {

    public function __construct() {
        spl_autoload_register( array($this, 'load') );
        // spl_autoload_register(array($this, 'loadComplete'));
    }

    // This method will be automatically executed by PHP whenever it encounters an unknown class name in the source code
    private function load($className) {

        // TODO : compute path of the file to load (cf. PHP function is_readable)
        // it is in one of these subdirectory '/classes/', '/model/', '/controller/'
        // if it is a model, load its sql queries file too in sql/ directory

        $classPath = __ROOT_DIR . "/classes/" . $className . ".class.php";
        $modelPath = __ROOT_DIR . "/model/" . $className . ".class.php";
        $controllerPath = __ROOT_DIR . "/controller/" . $className . ".class.php";
        $sqlPath = __ROOT_DIR . "/sql/" . $className . ".sql.php";

        if (is_readable($classPath)) {
            require_once($classPath);
        } else if (is_readable($modelPath)) {
            require_once($modelPath);
            if (is_readable($sqlPath)) {
                require_once($sqlPath);
            }
        } else if (is_readable($controllerPath)) {
            require_once($controllerPath);
        } else {
            die("Class $className not found");
        }
    }
}

$__LOADER = new AutoLoader();
