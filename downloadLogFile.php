<?php

require_once("Utils.php");

$logFileName = $_GET['logFileName'];
$fileType = $_GET['fileType'];

if (!isset($logFileName) && !isset($fileType)) {
    die('Invalid invocation of file');
}

$contentType = getContentTypeFromFileType($fileType);

$filename = "$logFileName.$fileType";

$absoluteFilePath = getcwd();
if ($logFileName != "aria2c") {
    $absoluteFilePath .= (DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "downloads");
}
$absoluteFilePath .= (DIRECTORY_SEPARATOR . $filename);

$absoluteFilePath = realpath($absoluteFilePath);

// http headers for log file downloads
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: $contentType");
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($absoluteFilePath));

ob_end_flush();
@readfile($absoluteFilePath);

?>