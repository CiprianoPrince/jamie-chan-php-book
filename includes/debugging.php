<?php

//    error_reporting(E_ALL); 
//    ini_set('display_errors', '1');
//    error_reporting=E_ALL
//    display_errors=On
//    date.timezone=America/New_York
//    auto_prepend_file="/xampp/htdocs/PHPFOLDERS/PHPProjectFiles/phpproject-complete/includes/debugging.php"

function myDebugger($msg, $file, $line, $trace = '')
{


    $message = $trace . '<BR><BR><strong>' . $msg . '</strong> found on <u>line ' . $line . '</u> in file <u>' . $file . '</u>';
    if (ini_get('display_errors')) {
        echo $message;
    } else {
        error_log($message);
        header('Location: error.html');
    }
}


function myExceptionHandler($e)
{
    myDebugger($e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString());
}

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    myDebugger($errstr, $errfile, $errline);
}

function myShutDownHandler()
{

    $lastError = error_get_last();

    if (isset($lastError)) {
        myDebugger($lastError['message'], $lastError['file'], $lastError['line']);
    }
}

set_exception_handler('myExceptionHandler');
set_error_handler('myErrorHandler');
register_shutdown_function('myShutDownHandler');
