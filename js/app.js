
// document.addEventListener('DOMContentLoaded', function() {
//     let elems = document.querySelectorAll(".sidenav");
//     let options = {
//         // "edge": "right",
//         // "draggable": false
//     };
//     var instances = M.Sidenav.init(elems, options)
// });

const BASE_URI = "http://localhost/Aria2c-PHP-webui/aria2cManager.php";

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

  $("#dimmer").toggleState();

  function showSegment(segmentName) {
    $("#appStatusSegment").hide();
    $("#aria2cOperations").hide();
    $("#activeDownloadsSegment").hide();
    $("#waitingDownloadsSegment").hide();
    $("#completedOrFinishedDownloadsSegment").hide();
    if (segmentName != "") {
      $("#" + segmentName).show();
    }
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
    } else {
      $("#startStopDaemon").addBtnClass("positive");
      $("#startStopDaemonText").text("Start");
      $("#aria2cOperations").hide();
    }

    if (isToggleDimmerState) {
      $("#dimmer").toggleState();
    }

  }

  function appStatus(isToggleDimmerState = false) {
    $.post(BASE_URI, { "requestType": "aria2cDaemonStatus" },

      function (data, textStatus, jqXHR) {

        let response = data.response;
        populateAppStatus(response, isToggleDimmerState);

      },
      "json"
    );
  }

  function getProgressBar(percent) {
  
    let progressBar = "";
    progressBar += "<div class=\"ui indicating progress\" data-percent=\""+percent+"\">";
    progressBar += "    <div class=\"bar\" style=\"transition-duration: 300ms; width: "+percent+"%;\"></div>";
    progressBar += "    <div class=\"label\">"+percent+"% Completed</div>";
    progressBar += "</div>";
  
    return progressBar;
  
  }

  function getCell(cellElement, datum) {
    let cell = document.createElement(cellElement);
    if(datum.indexOf("ui indicating progress") === -1) {
      cell.appendChild(document.createTextNode(datum));
    } else {
      cell.innerHTML = datum.trim();
    }

    if(datum === "Progress") {
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
  
  function getTableData(responseMessage) {
    let tableData = [];

    tableData.push(["Gid","Status","Progress","Download directory","Connections","Num pieces","Piece length","Download speed","Total length","Completed length","Upload length","Upload speed"]);
    console.log("responseMessage.result");
    console.log(responseMessage.result);
    responseMessage.result.forEach(function(activeDownloadItem){
      let downloadItemDetails = [];
      let totalLength = activeDownloadItem.totalLength;
      let completedLength = activeDownloadItem.completedLength;
      let percentCompleted = Math.trunc((completedLength/totalLength)*100);
      downloadItemDetails.push(activeDownloadItem.gid);
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
    $.post(BASE_URI, { "requestType": "tellActive" },

      function (data, textStatus, jqXHR) {

        let response = data.response;
        let tableData = getTableData(response);
        $("#activeDownloadTable").html(createTable(tableData));

      },
      "json"
    );
  }

  appStatus(true);

  $(".item").click(function (e) {

    let currentTarget = e.currentTarget;
    //console.log(currentTarget.innerText);
    switch (currentTarget.innerText) {
      case "Menu": console.log("Menu clicked");
        break;
      case "Home": console.log("Home clicked"); showSegment("appStatusSegment");
        break;
      case "Active Downloads": console.log("Active Downloads clicked"); showSegment("activeDownloadsSegment");
        setInterval(() => {
          getActiveDownloadStatus();
        }, 1000);
        break;
      case "Waiting Downloads": console.log("Waiting Downloads clicked"); showSegment("waitingDownloadsSegment");
        break;
      case "History": console.log("History clicked"); showSegment("completedOrFinishedDownloadsSegment");
        break;
      default: console.log("Click action not configured for menu, " + currentTarget.innerText);
        break;
    }

  });



  $("#startStopDaemon").click(function (e) {
    $("#dimmer").toggleState();

    let requestMode = ($("#startStopDaemonText").text() === "Start") ? "startDaemon" : "stopDaemon";

    $.post(BASE_URI, { "requestType": requestMode },
      function (data, textStatus, jqXHR) {

        let response = data.response;
        populateAppStatus(response, true);

      },
      "json"
    );

  });

  $("#addDownload").click(function (e) {
    $('.fullscreen.modal')
      .modal('show');
  });

  $("#downloadAria2cLog").click(function (e) {
    
  });

});
