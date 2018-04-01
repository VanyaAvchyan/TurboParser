<?php

/**
 * Loads the required classes
 *
 * @param string $name Class name
 * @return void;
 */
function autoloader($class)
{
    $file = __DIR__.'/Factories/'.$class.'.php';
    try {
        if(!file_exists($file))
            throw new \Exception ('Class '.$file.' called on line '.__FILE__.': '.__LINE__.' not found');
        include $file;
    } catch (\Exception $ex) {
        echo $ex->getMessage();
        exit;
    }
}
spl_autoload_register('autoloader');
