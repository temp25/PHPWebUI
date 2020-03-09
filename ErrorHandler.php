<?php
    function handleError($errorNumber, $errorString, $errorFile, $errorLine) {
        throw new Exception("<b>Error: </b>[$errorNumber] $errorString - $errorFile:$errorLine", -1);
    }

    class InsufficientArgumentException extends Exception { }
    class UnsupportedRequestTypeException extends Exception { }
    
?>