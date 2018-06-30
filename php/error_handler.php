<?php

set_error_handler('ErrorHandler',E_ALL);

function ErrorHandler($nubmer, $text, $file, $line){
    if(ob_get_length) ob_clean();
    $errorMessage = 'Error: ' . $nubmer . char(10) .
                    'Message: ' . $text . char(10) .
                    'File: ' . $file . char(10) .
                    'Line: ' . $line;
    echo $errorMessage;
    exit;
}

?>