<?php
// This function will help you to trace issues
if(!function_exists('print_pre')){
    function print_pre($data, $stop = 1){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if($stop){
            $backtrace = debug_backtrace();
            if(count($backtrace)){
                die('Called at : '.$backtrace[0]['file'].' , on line '. $backtrace[0]['line']);
            }else{
                die();
            }
        }
    }
}

spl_autoload_register(function ($class) {
    $path = __DIR__ . "/classes/" . $class . ".class.php";
    if (file_exists($path)) {
        require_once $path;
    }
});
