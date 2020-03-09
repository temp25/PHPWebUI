<?php

function downloadFile($fileName, $contentType) {
    
    $absoluteFilePath = getcwd() . DIRECTORY_SEPARATOR . $fileName;

    // http headers for zip downloads
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-type: " . $contentType . ", application/octet-stream");
    header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . filesize($absoluteFilePath));
    ob_end_flush();
    @readfile($absoluteFilePath);

}

?>