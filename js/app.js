
// document.addEventListener('DOMContentLoaded', function() {
//     let elems = document.querySelectorAll(".sidenav");
//     let options = {
//         // "edge": "right",
//         // "draggable": false
//     };
//     var instances = M.Sidenav.init(elems, options)
// });

const BASE_URI = window.location.origin; //"http://localhost/Aria2c-PHP-webui";

const ABSOLUTE_RESOURCE_PATH = BASE_URI + "/aria2cManager.php";

let daemonStatusCheckInterval = 0;
let activeDownloadInterval = 0;
let waitingDownloadInterval = 0;
let completedOrFinishedDownloadInterval = 0;

$.fn.toggleStartStopButton = function (enabledSelector, disabledSelector) {
  $(enabledSelector).attr("disabled", true);
  $(disabledSelector).removeAttr("disabled");
};

$.fn.toggleState = function () {
  if ($(this).attr("class").indexOf("active") != -1) {
    $(this).removeClass("active");
    $(this).addClass("disabled");
  } else {
    $(this).addClass("active");
    $(this).removeClass("disabled");
  }
};

$.fn.addBtnClass = function (className) {
  $(this).removeClass("positive");
  $(this).removeClass("negative");
  $(this).addClass(className);
  $("#startStopDaemonIcon").removeClass("play");
  $("#startStopDaemonIcon").removeClass("stop");
  $("#startStopDaemonIcon").addClass((className === "positive") ? "play" : "stop");
}

$(document).ready(function () {

  $('.ui.sidebar').sidebar({
    context: $('.bottom.segment')
  })
    .sidebar('attach events', '.menu .item');

  function showSegment(segmentName) {
    $("#appStatusSegment").hide();
    $("#aria2cOperations").hide();
    $("#activeDownloadsSegment").hide();
    $("#waitingDownloadsSegment").hide();
    $("#completedOrFinishedDownloadsSegment").hide();
    clearInterval(daemonStatusCheckInterval); activeDownloadInterval = 0;
    clearInterval(activeDownloadInterval); activeDownloadInterval = 0;
    clearInterval(waitingDownloadInterval); waitingDownloadInterval = 0;
    clearInterval(completedOrFinishedDownloadInterval); completedOrFinishedDownloadInterval = 0;
    if (segmentName != "") {
      $("#" + segmentName).show();
      if (segmentName === "appStatusSegment") {
        appStatus(true);
      }
      $("#dimmer").toggleState();
    }
  }

  function updateTimestamp(timeStamp) {
    $("#timeStamp").text(new Date(timeStamp).toString());
  }

  showSegment("appStatusSegment");

  function populateAppStatus(response, isToggleDimmerState) {

    $("#appStatus").text(response);

    let isRunning = (response.indexOf("not running") === -1 && response.indexOf("stopped") === -1);

    console.log("isRunning: " + isRunning);

    if (isRunning) {
      $("#startStopDaemon").addBtnClass("negative");
      $("#startStopDaemonText").text("Stop");
      $("#aria2cOperations").show();
      let isFirstTimeStatus = true;
      if (daemonStatusCheckInterval === 0) {
        daemonStatusCheckInterval = setInterval(() => {
          if (isFirstTimeStatus) {
            $("#dimmer").toggleState();
            isFirstTimeStatus = false;
            appStatus(true);
          } else {
            appStatus();
          }
        }, 60000);
      }
    } else {
      $("#startStopDaemon").addBtnClass("positive");
      $("#startStopDaemonText").text("Start");
      $("#aria2cOperations").hide();
      clearInterval(daemonStatusCheckInterval); activeDownloadInterval = 0;
      clearInterval(activeDownloadInterval); activeDownloadInterval = 0;
      clearInterval(waitingDownloadInterval); waitingDownloadInterval = 0;
      clearInterval(completedOrFinishedDownloadInterval); completedOrFinishedDownloadInterval = 0;
    }

    if (isToggleDimmerState) {
      $("#dimmer").toggleState();
    }

  }

  function appStatus(isToggleDimmerState = false) {
    $.post(ABSOLUTE_RESOURCE_PATH, { "requestType": "aria2cDaemonStatus" },

      function (data, textStatus, jqXHR) {

        updateTimestamp(data.timestamp);

        let response = data.response;
        populateAppStatus(response, isToggleDimmerState);

        if(data.hasOwnProperty("globalOption")) {
          if (data.globalOption["allow-overwrite"] === "true") {
            $("#allowOverwrite").attr("checked", "checked");
          } else {
            $("#allowOverwrite").removeAttr("checked");
          }

          if (data.globalOption["always-resume"] === "true") {
            $("#alwaysResume").attr("checked", "checked");
          } else {
            $("#alwaysResume").removeAttr("checked");
          }

          if (data.globalOption["check-integrity"] === "true") {
            $("#checkIntegrity").attr("checked", "checked");
          } else {
            $("#checkIntegrity").removeAttr("checked");
          }

          if (data.globalOption["disable-ipv6"] === "true") {
            $("#disableIPv6").attr("checked", "checked");
          } else {
            $("#disableIPv6").removeAttr("checked");
          }

          $("#logLevel").val(data.globalOption["log-level"]);

          $("#diskCache").val(parseInt(data.globalOption["disk-cache"]));
          $("#maxConcurrentDownloads").val(parseInt(data.globalOption["max-concurrent-downloads"]));
          $("#maxConnectionPerServer").val(parseInt(data.globalOption["max-connection-per-server"]));
          $("#maxDownloadLimit").val(parseInt(data.globalOption["max-download-limit"]));
          $("#maxDownloadResult").val(parseInt(data.globalOption["max-download-result"]));
          $("#maxOverallDownloadLimit").val(parseInt(data.globalOption["max-overall-download-limit"]));
          $("#maxOverallUploadLlimit").val(parseInt(data.globalOption["max-overall-upload-limit"]));
          $("#maxResumeFailureTries").val(parseInt(data.globalOption["max-resume-failure-tries"]));
          $("#maxTries").val(parseInt(data.globalOption["max-tries"]));
          $("#maxUploadLimit").val(parseInt(data.globalOption["max-upload-limit"]));
          $("#minSplitSize").val(parseInt(data.globalOption["min-split-size"]));
        }

      },
      "json"
    );
  }

  function getProgressBar(percent) {

    let progressBar = "";
    progressBar += "<div class=\"ui indicating progress\" data-percent=\"" + percent + "\">";
    progressBar += "    <div class=\"bar\" style=\"transition-duration: 300ms; width: " + percent + "%;\"></div>";
    let completionStatus = isNaN(percent) ? "Not started" : percent + "% Completed";
    progressBar += "    <div class=\"label\">" + completionStatus + "</div>";
    progressBar += "</div>";

    return progressBar;

  }

  function getCell(cellElement, datum) {
    let cell = document.createElement(cellElement);
    if (datum.indexOf("ui indicating progress") === -1 && datum.indexOf("href") === -1) {
      cell.appendChild(document.createTextNode(datum));
    } else {
      cell.innerHTML = datum.trim();
    }

    if (datum === "Progress") {
      cell.setAttribute("style", "padding-left: 50px; padding-right: 50px");
    }

    return cell;
  }

  function appendRow(parentElement, data, isHeaderRow = false) {

    let cellElement = "td";
    if (isHeaderRow) {
      cellElement = "th";
    }

    let rowElement = document.createElement("tr");

    data.forEach(function (datum) {
      rowElement.appendChild(getCell(cellElement, datum));
    });

    parentElement.appendChild(rowElement);

  }

  function createTable(tableData) {

    let table = document.createElement("table");
    let tableHead;

    if (tableData.length !== 0) {
      tableHead = document.createElement("thead");
      appendRow(tableHead, tableData[0], true)
    } else {
      return;
    }

    let tableBody = document.createElement("tbody");

    tableData.forEach(function (tableRowData, rowIndex) {

      if (rowIndex == 0) {
        return true;
      }

      appendRow(tableBody, tableRowData)

    });

    table.setAttribute("class", "ui celled table");
    table.appendChild(tableHead);
    table.appendChild(tableBody);

    return table;
  }

  function getTableData(responseMessage, isFileNameAvailable = false) {
    let tableData = [];

    let tableHeaders = ["Gid"];
    if(isFileNameAvailable) {
      tableHeaders = tableHeaders.concat(["Filename"]);
    }
    tableHeaders = tableHeaders.concat(["Status", "Progress", "Download directory", "Connections", "Num pieces", "Piece length", "Download speed", "Total length", "Completed length", "Upload length", "Upload speed"]);

    tableData.push(tableHeaders);
    console.log(responseMessage.result);
    responseMessage.result.forEach(function (activeDownloadItem) {
      let downloadItemDetails = [];
      let totalLength = activeDownloadItem.totalLength;
      let completedLength = activeDownloadItem.completedLength;
      let percentCompleted = Math.trunc((completedLength / totalLength) * 100);
      downloadItemDetails.push(activeDownloadItem.gid);
      if(isFileNameAvailable) {
        downloadItemDetails.push(activeDownloadItem.fileName);
      }
      downloadItemDetails.push(activeDownloadItem.status);
      downloadItemDetails.push(getProgressBar(percentCompleted));
      downloadItemDetails.push(activeDownloadItem.dir);
      downloadItemDetails.push(activeDownloadItem.connections);
      downloadItemDetails.push(activeDownloadItem.numPieces);
      downloadItemDetails.push(activeDownloadItem.pieceLength);
      downloadItemDetails.push(activeDownloadItem.downloadSpeed);
      downloadItemDetails.push(totalLength);
      downloadItemDetails.push(completedLength);
      downloadItemDetails.push(activeDownloadItem.uploadLength);
      downloadItemDetails.push(activeDownloadItem.uploadSpeed);
      tableData.push(downloadItemDetails);
    });

    return tableData;
  }

  function getActiveDownloadStatus() {
    $.post(ABSOLUTE_RESOURCE_PATH, { "requestType": "tellActive" },

      function (data, textStatus, jqXHR) {

        updateTimestamp(data.timestamp);

        if(data.statusCode === 200) {
          let response = data.response;
          let tableData = getTableData(response);
          $("#activeDownloadTable").html(createTable(tableData));
        } else {
          if(activeDownloadInterval != 0) {
            clearInterval(activeDownloadInterval);
            showToast("error", data.errorMessage);
          }
        }

      },
      "json"
    );
  }

  function getWaitingDownloadStatus() {

    $.post(ABSOLUTE_RESOURCE_PATH, { "requestType": "tellWaiting" },

      function (data, textStatus, jqXHR) {

        updateTimestamp(data.timestamp);

        if(data.statusCode === 200) {
          let response = data.response;
          let tableData = getTableData(response);
          $("#waitingDownloadTable").html(createTable(tableData));
        } else {
          if(waitingDownloadInterval != 0) {
            clearInterval(waitingDownloadInterval);
            showToast("error", data.errorMessage);
            showToast("error", "Try again after some time");
          }
        }
        

      },
      "json"
    );

  }

  function getCompletedOrFinishedDownloadStatus() {
    $.post(ABSOLUTE_RESOURCE_PATH, { "requestType": "tellStatus" },
      function (data, textStatus, jqXHR) {

        updateTimestamp(data.timestamp);

        if(data.statusCode === 200) {
          let response = data.response;
          let tableData = getTableData(response, true);
          $("#completedOrFinishedDownloadTable").html(createTable(tableData));
        } else {
          if(completedOrFinishedDownloadInterval != 0) {
            clearInterval(completedOrFinishedDownloadInterval);
            showToast("error", data.errorMessage);
            showToast("error", "Try again after some time");
          }
        }
      },
      "json"
    );
  }

  function showToast(toastType, message) {

    toastr.options.preventDuplicates = true;
    toastr.options.timeOut = 2000;

      if(toastType === "success") {
        toastr.success(message);
      } else if(toastType === "info") {
        toastr.info(message);
      } else if(toastType === "warning") {
        toastr.warning(message);
      } else if(toastType === "error") {
        toastr.options.timeOut = 2500;
        toastr.error(message);
      } else {
        alert("Invalid toastType, "+toastType+" requested");
      }

  }

  //appStatus(true);

  $(".item").click(function (e) {

    let currentTarget = e.currentTarget;
    //console.log(currentTarget.innerText);
    console.log("_"+currentTarget.innerText+"_");
    switch (currentTarget.innerText) {
      case "Menu": console.log("Menu clicked");
        break;
      case "Home": console.log("Home clicked"); showSegment("appStatusSegment");
        let isFirstTimeStatus = true;
        appStatus(true);
        break;
      case "Active Downloads": console.log("Active Downloads clicked"); showSegment("activeDownloadsSegment");
        let isFirstTimeActive =  true;
        if (activeDownloadInterval === 0) {
          activeDownloadInterval = setInterval(() => {
            getActiveDownloadStatus();
            if (isFirstTimeActive) {
              $("#dimmer").toggleState();
              isFirstTimeActive = false;
            }
          }, 5000);
        }
        break;
      case "Waiting Downloads": console.log("Waiting Downloads clicked"); showSegment("waitingDownloadsSegment");
        let isFirstTimeWaiting =  true;
        if(waitingDownloadInterval === 0) {
          waitingDownloadInterval = setInterval(() => {
            getWaitingDownloadStatus();
            if (isFirstTimeWaiting) {
              $("#dimmer").toggleState();
              isFirstTimeWaiting = false;
            }
          }, 5000);
        }
        break;
      case "Completed/Finished Downloads": console.log("History clicked"); showSegment("completedOrFinishedDownloadsSegment");
        let isFirstTimeCompletedOrFinished =  true;
        if(completedOrFinishedDownloadInterval === 0) {
          completedOrFinishedDownloadInterval = setInterval(() => {
            getCompletedOrFinishedDownloadStatus();
            if (isFirstTimeCompletedOrFinished) {
              $("#dimmer").toggleState();
              isFirstTimeCompletedOrFinished = false;
            }
          }, 15000);
        }
        break;
      default: console.log("Click action not configured for menu, " + currentTarget.innerText);
        break;
    }

  });



  $("#startStopDaemon").click(function (e) {
    $("#dimmer").toggleState();

    let requestMode = ($("#startStopDaemonText").text() === "Start") ? "startDaemon" : "stopDaemon";

    $.post(ABSOLUTE_RESOURCE_PATH, { "requestType": requestMode },
      function (data, textStatus, jqXHR) {

        updateTimestamp(data.timestamp);

        let response = data.response;
        populateAppStatus(response, true);

      },
      "json"
    );

  });

  $("#addDownload").click(function (e) {
    $('.fullscreen.modal')
        .modal({
          closable: false,
          onHide: function () { console.log("Model:> onHide invoked....."); },
          onShow: function () { console.log("Model:> onShow invoked....."); },
          onApprove: function () { 
            let uris = $("#addDownloadsTextArea").val().split('\n');
            if (uris.length === 1 && uris[0] === "") {
              showToast("warning", "Enter atleast one url to download");
              return false;
            } else {
              $.post(ABSOLUTE_RESOURCE_PATH, { "requestType": "addUri", "uris": uris },
                function (data, textStatus, jqXHR) {

                  updateTimestamp(data.timestamp);

                  if (data.statusCode === 200) {
                    showToast("success", "Successfully added uri. See for generated ids, " + data.response.toString() + " in active downloads section");
                  } else {
                    showToast("error", data.errorMessage);
                  }

                },
                "json"
              );
            }
          },
          onDeny: function () { console.log("Model:> onDeny invoked....."); }
        })
        .modal('show');
  });

  $("#downloadAria2cLog").click(function (e) {
    window.location.href = BASE_URI + "/downloadLogFile.php?logFileName=aria2c&fileType=log"
  });

  $("#updateGlobalSettings").click(function (e) {
    
    let allowOverwrite = ($("#allowOverwrite").attr("checked") == "checked") ? "true" : "flase";
    let alwaysResume = ($("#alwaysResume").attr("checked") == "checked") ? "true" : "flase";
    let checkIntegrity = ($("#checkIntegrity").attr("checked") == "checked") ? "true" : "flase";
    let disableIPv6 = ($("#disableIPv6").attr("checked") == "checked") ? "true" : "flase";
    let logLevel = $("#logLevel").val();
    let diskCache = $("#diskCache").val();
    let maxConcurrentDownloads = $("#maxConcurrentDownloads").val();
    let maxConnectionPerServer = $("#maxConnectionPerServer").val();
    let maxDownloadLimit = $("#maxDownloadLimit").val();
    let maxDownloadResult = $("#maxDownloadResult").val();
    let maxOverallDownloadLimit = $("#maxOverallDownloadLimit").val();
    let maxOverallUploadLlimit = $("#maxOverallUploadLlimit").val();
    let maxResumeFailureTries = $("#maxResumeFailureTries").val();
    let maxTries = $("#maxTries").val();
    let maxUploadLimit = $("#maxUploadLimit").val();
    let minSplitSize = $("#minSplitSize").val();

    // console.log(
    //   "allowOverwrite: " + allowOverwrite + "\n" +
    //   "alwaysResume: " + alwaysResume + "\n" +
    //   "checkIntegrity: " + checkIntegrity + "\n" +
    //   "disableIPv6: " + disableIPv6 + "\n" +
    //   "logLevel: " + logLevel + "\n" +
    //   "diskCache: " + diskCache + "\n" +
    //   "maxConcurrentDownloads: " + maxConcurrentDownloads + "\n" +
    //   "maxConnectionPerServer: " + maxConnectionPerServer + "\n" +
    //   "maxDownloadLimit: " + maxDownloadLimit + "\n" +
    //   "maxDownloadResult: " + maxDownloadResult + "\n" +
    //   "maxOverallDownloadLimit: " + maxOverallDownloadLimit + "\n" +
    //   "maxOverallUploadLlimit: " + maxOverallUploadLlimit + "\n" +
    //   "maxResumeFailureTries: " + maxResumeFailureTries + "\n" +
    //   "maxTries: " + maxTries + "\n" +
    //   "maxUploadLimit: " + maxUploadLimit + "\n" +
    //   "minSplitSize: " + minSplitSize
    // );

    let modifiedGlobalOptions = {
      "requestType": "setGlobalOption",
      "allow-overwrite": allowOverwrite,
      "always-resume": alwaysResume,
      "check-integrity": checkIntegrity,
      "disable-ipv6": disableIPv6,
      "disk-cache": diskCache,
      "log-level": logLevel,
      "max-concurrent-downloads": maxConcurrentDownloads,
      "max-connection-per-server": maxConnectionPerServer,
      "max-download-limit": maxDownloadLimit,
      "max-download-result": maxDownloadResult,
      "max-overall-download-limit": maxOverallDownloadLimit,
      "max-overall-upload-limit": maxOverallUploadLlimit,
      "max-resume-failure-tries": maxResumeFailureTries,
      "max-tries": maxTries,
      "max-upload-limit": maxUploadLimit,
      "min-split-size": minSplitSize
    };

    //console.log("modifiedGlobalOptions : ");
    //console.log(modifiedGlobalOptions)

    $(this).toggleClass("loading");
    $(this).addClass("disabled", "disabled");

    $.post(ABSOLUTE_RESOURCE_PATH, modifiedGlobalOptions,
      function (data, textStatus, jqXHR) {
        
        $("#updateGlobalSettings").toggleClass("loading");
        $("#updateGlobalSettings").text("Updated");

        setTimeout(() => {
          $("#updateGlobalSettings").text("Update");
          $("#updateGlobalSettings").removeClass("disabled");
        }, 3000);

        if (data.statusCode === 200) {
          showToast("success", "Updated settings successfully");
        } else {
          showToast("error", data.errorMessage);
        }

      },
      "json"
    );

  });

});
