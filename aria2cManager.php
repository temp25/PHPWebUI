<?php
    require_once("Constants.php");
    require_once("ErrorHandler.php");
    require_once("Utils.php");
    require_once("Aria2.php");
    set_error_handler("handleError");

    $aria2c = new Aria2('http://127.0.0.1:6800/jsonrpc');

    // try {
    //     $gid = $aria2c->addUri(
    //         ['http://localhost/Darbar.mp4'],
    //         ['dir'=>'C:\wamp64\www\tmp']
    //     );
    //     echo PHP_EOL."gid:";
    //     var_dump($gid);
    //     echo PHP_EOL.PHP_EOL;
    //     $globalStat = $aria2c->getGlobalStat();
    //     var_dump($globalStat);
    // } catch (\Exception $e) {
    //     echo PHP_EOL."Error: " . $e->getMessage().PHP_EOL.PHP_EOL;
    //     var_dump($e);
    // }

    try {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            die("Invalid script execution");
        } else {
            
            if(empty($_POST)) {
                //For cases where the request header is set as application/json 
                $_POST = json_decode(file_get_contents("php://input"), true);
            }

            if (empty($_POST)) {
                throw new InsufficientArgumentException("one or more parameters missing in request");
            }

            $requestType = $_POST["requestType"];

            if(isset($requestType)) {
                
                switch ($requestType) {
                    //TODO: Add aria2c daemon start and stop logic here
                    case START_DAEMON:
                            $aria2cStartDaemonStatus = startAria2cDaemon();
                            $status = "";
                            if($aria2cStartDaemonStatus === -1) {
                                throw new Exception("Error in starting Aria2c daemon");
                            } else if($aria2cStartDaemonStatus === -2) {
                                $status = "Aria2c daemon already running";
                            } else {
                                $status = "Aria2c daemon started with PID, $aria2cStartDaemonStatus successfully";
                            }
                            return sendData(getResponse($status));
                            break;
                    case STOP_DAEMON:
                            $aria2cStopDaemonStatus = stopAria2cDaemon();
                            $status = "";
                            if($aria2cStopDaemonStatus === -1) {
                                $status = "Aria2c daemon stopped successfully";
                            } else if($aria2cStopDaemonStatus === -2) {
                                $status = "Aria2c daemon already stopped";
                            } else {
                                throw new Exception("Error in stopping Aria2c daemon with PID, $aria2cStopDaemonStatus");
                            }
                            return sendData(getResponse($status));
                            break;
                    case DAEMON_STATUS:
                            $aria2cDaemonStatus = getAria2cDaemonStatus();
                            $status = $aria2cDaemonStatus === -1 ? "Aria2c daemon not running" : "Aria2c daemon running with PID, $aria2cDaemonStatus";
                            return sendData(getResponse($status));
                            break;
                    case GLOBAL_STATISTICS:
                        //get global statistics
                        return sendData(getResponse(getGlobalStat()));
                        break;
                    case ADD_URI:
                        //Add URI to aria2c download list
                        if(empty($_POST["uris"])) {
                            throw new InsufficientArgumentException("Download URIs missing in request");
                        }
                        $uris = $_POST["uris"];
                        return sendData(getResponse(addUri($uris)));
                        break;
                    case TELL_ACTIVE:
                        return sendData(getResponse(tellActive()));
                        break;
                    case TELL_WAITING:
                        return sendData(getResponse(tellWaiting()));
                    case TELL_STATUS:
                        return sendData(getResponse(tellStatus()));

                    default:
                        throw new UnsupportedRequestTypeException("Request type '$requestType' is not supported");
                        break;
                }

            } else {
                throw new InsufficientArgumentException("one or more parameters missing in request");
            }
        }
    } catch (\Exception $e) {
        $error = [
            "timestamp" => getTimestamp(),
            "statusCode" => 400,
            "status" => "error",
            "errorMessage" => $e->getMessage()
        ];
        sendData($error);
    }

    function isValidURI($uri) {
        if(filter_var($uri, FILTER_VALIDATE_URL) !== false) {
            return true;
        }
        throw new InvalidArgumentException("One or more URI fails validation");
    }

    function getResponse($responseText) {
        return [
            "timestamp" => getTimestamp(),
            "statusCode" => 200,
            "status" => "success",
            "response" => $responseText
        ];
    }

    function startAria2cDaemon() {
        $aria2cDaemonStatus = getAria2cDaemonStatus();
        if($aria2cDaemonStatus !== -1) {
            return -2;
        }
        switch(PHP_OS) {
            case "WIN32":
            case "WINNT":
            case "Windows":
                            //create a gid if not exists
                            if(file_exists(GID_FILE)) {
                                unlink(GID_FILE);
                            }
                            if(!touch(GID_FILE)) {
                                throw new GidFileProcessingException("Error in creating file " . GID_FILE);
                            }

                            //start script for windows
                            $handle = popen("START /B aria2c.exe --enable-rpc --rpc-listen-all --max-connection-per-server=1 --max-concurrent-downloads=1 --log=aria2c.log >NUL 2>&1", "r");
                            pclose($handle);
                            return getAria2cDaemonStatus();
                            break;
            case "FreeBSD":
            case "NetBSD":
            case "OpenBSD":
            case "Unix":
            case "Linux":
                            //start script for Unix/Linux
                            echo "Unix/Linux type OS";
                            break;
            default:    
        }
    }

    function stopAria2cDaemon() {

        $aria2cDaemonStatus = getAria2cDaemonStatus();

        if($aria2cDaemonStatus === -1) {
            return -2;
        }

        switch(PHP_OS) {
            case "WIN32":
            case "WINNT":
            case "Windows":
                            //stop script for windows
                            exec("TASKKILL /PID $aria2cDaemonStatus /F >NUL 2>&1");
                            return getAria2cDaemonStatus();
                            break;
            case "FreeBSD":
            case "NetBSD":
            case "OpenBSD":
            case "Unix":
            case "Linux":
                            //stop script for Unix/Linux
                            echo "Unix/Linux type OS";
                            break;
            default:    
        }
    }

    function getAria2cDaemonStatus() {
        switch(PHP_OS) {
            case "WIN32":
            case "WINNT":
            case "Windows":
                            //start script for windows
                            $taskList = array();
                            exec("TASKLIST | FINDSTR /I aria2c 2>NUL", $taskList);
                            if(empty($taskList) === false) {
                                return preg_split("/\s+/", $taskList[0])[1]; //return pid of the running process
                            } else {
                                return -1; //daemon not started
                            }
                            break;
            case "FreeBSD":
            case "NetBSD":
            case "OpenBSD":
            case "Unix":
            case "Linux":
                            //start script for Unix/Linux
                            echo "Unix/Linux type OS";
                            break;
            default:    
        }
    }

    function getGlobalStat() {
        global $aria2c;
        $globalStat = $aria2c->getGlobalStat();
        return $globalStat;
    }

    function addUri($uris) {
        global $aria2c;
        $validatedURIs = [];
        foreach($uris as $uri) {
            if(isValidURI($uri)) {
                array_push($validatedURIs, $uri);
            }
        }

        $generatedGids = [];
        foreach ($validatedURIs as $uri) {
            $result = $aria2c->addUri(
                [$uri],
                ["dir" => DOWNLOAD_DIRECTORY]
            );
            if($result["id"] == 1) {
                $gid = $result["result"];

                if(($gidArray = file(GID_FILE, FILE_IGNORE_NEW_LINES)) === FALSE ) {
                    throw new GidFileProcessingException("Failed in reading GID file");
                }
                array_push($gidArray, $gid);
                if(file_put_contents(GID_FILE, implode(PHP_EOL,$gidArray)) === false) {
                    throw new GidFileProcessingException("Failed to write to GID file");
                }

                array_push($generatedGids, $gid);
            }
        }

        return $generatedGids;
    }
    
    function tellActive() {
        global $aria2c;
        return $aria2c->tellActive();
    }

    function tellWaiting() {
        global $aria2c;
        return $aria2c->tellWaiting(0, 1000);
    }

    function getFileDownloadUrl($url) {
        preg_match("/(^.*)\.(.*?)$/", $url, $matches);
        $fileName = $matches[1];
        $extension = $matches[2];
        $downloadUrl = "<a href='/downloadLogFile.php?logFileName=$fileName&fileType=$extension'>$url<a/>";
        return $downloadUrl;
    }

    function tellStatus() {
        global $aria2c;
        $versionInfo = $aria2c->getVersion();

        $statusArray = [ "id" => $versionInfo["id"], "jsonrpc" => $versionInfo["jsonrpc"], "result" => [] ];

        if(($gidArray = file(GID_FILE, FILE_IGNORE_NEW_LINES)) === FALSE ) {
            throw new GidFileProcessingException("Failed in reading GID file");
        }

        foreach($gidArray as $gid) {
            $status = $aria2c->tellStatus($gid);
            if(!empty($status["result"]["files"])) {
                preg_match("/[^\/]+$/", $status["result"]["files"][0]["path"], $matches);
                $status["result"]["fileName"] = empty($matches) ? "" : getFileDownloadUrl($matches[0]);
            }
            
            $statusArray["result"][] = $status["result"];
        }


        return $statusArray;
    }

?>