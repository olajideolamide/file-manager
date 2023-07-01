var PARENT = "";
var LIST_STATUS = 1;
var SEARCH_TERM = "";
var SORT_COLUMN = "";
var SORT_DIR = "";
var FOLDERS = {};
var FILE_MAP = {};
var ITEMS_COUNT = 0;
var BREADCRUMB = [];
var CURRENT_VIEW = "table";


var TABLE_FILTERS = {};

var PUSH_STATE = true;


/**
 * refetches the table data from the server
 */
function refetchData() {

    var data = getOptions();

    request(table_src_url, data, "get", "refresh_table");
}

function refetchPath() {

    var data = {};
    if (file_app.parent == "") {
        file_app.breadcrumb = [];
        return;
    }
    request("/api/drive/path/" + file_app.parent, data, "get", "handle_path");
}


//initialize the table and load the default view
$(function () {

    if (typeof folder_id !== 'undefined' && folder_id !== null) file_app.parent = folder_id;
    refetchData();
})



//table options
function getOptions() {

    return {
        "filter": JSON.stringify(TABLE_FILTERS),
        "search": file_app.search_term,
        "sort": file_app.sort_column,
        "dir": file_app.sort_dir,
        "parent": file_app.parent
    };
}


function clearOptions() {
    file_app.search_term = "";
    file_app.sort_column = "";
    file_app.sort_dir = "";
    $(".search.form-control").val("");

}

function populateModalFormOptions(data) {
    data["parent"] = file_app.parent;
    return data;
}



$(function () {
    'use strict'



    //double click a folder in the table view
    $('body').on('dblclick', 'table.custom tbody tr, .grid-view .card', function (e) {

        var item = file_app.getItemFromFiles($(this).data("id"));


        if (item["type"] == "FOLDER") {

            updateParent(item.id);


        }


    });

    //click on a breadcrumb item
    $('body').on('click', '.breadcrumb-clickable', function (e) {

        clearOptions();
        updateParent($(this).data("id"));
    });




    //bulk options click
    $('body').on('click', '.bulk-option.move', function (e) {
        showModal("large-modal", "Move Item(s)", move_modal_content, "Create");
    });


})


window.onpopstate = function (e) {
    if (e.state) {
        //document.getElementById("content").innerHTML = e.state.html;
        //document.title = e.state.pageTitle;
        console.log(e.state);


        file_app.search_term = e.state.search;
        file_app.sort_column = e.state.sort;
        file_app.sort_dir = e.state.dir;
        file_app.parent = e.state.parent;
        PUSH_STATE = false;
        refetchData();

    }
};

function updateParent(parent) {
    file_app.parent = parent;
    refetchData();
}



//column sort
function sortCustomTable(column, direction) {
    file_app.sort_column = column;
    file_app.sort_dir = direction;

    refetchData();
}


function refreshFolders() {

    var data = {"parent": file_app.parent};
    request("/api/drive/folders", data, "get", "populate_folders");

}


var populate_folders = function (data, status_text) {

    if (status_text) {
        return;
    }

    let this_parent;
    $.each(data, function (key, item) {

        //if this folder belongs to this parent and it is not in view, add
        this_parent = file_app.parent;
        if (!this_parent) this_parent = null;

        if (item["parent_id"] == this_parent && !file_app.getItemFromFiles(item["id"])) {
            insertFileFolder(0, item, true);
        }

    });
};



var refresh_table = function (data, status_text) {

    file_app.files = [];

    if (status_text) {
        //we show error
        return;
    }

    $.each(data, function (key, item) {
        insertFileFolder(key, item);
    });

    let url_path;
    if (PUSH_STATE == true) {
        if (file_app.parent == "") {
            url_path = "/drive";
        } else {
            url_path = "/drive/" + btoa(file_app.parent.toString().padEnd(10, "padding")).replace(/=+/, "");
        }
        window.history.pushState(getOptions(), "", url_path);
    } else {
        PUSH_STATE = true;
    }

};

var handle_path = function (data, status_text) {


    if (status_text) {
        //we show error
        return;
    }

    file_app.breadcrumb = [];
    $.each(data, function (key, item) {
        file_app.breadcrumb.push({
            "id": item.id,
            "name": item.name
        });
    });
};






function insertFileFolder(key, item, prepend = false) {
    let this_parent = file_app.parent;
    if (!this_parent) this_parent = null;
    if (item["parent_id"] != this_parent) return;

    if (prepend == true) file_app.files.unshift(item);
    else file_app.files.push(item);

}



$(function () {

    $('body').on('click', '.table.custom thead th.sortable', function (e) {

        //first clear all active
        $(".table.custom thead th.sortable").removeClass("active");
        $(".table.custom thead th.sortable").children(".fa-solid").remove();

        var column;
        var direction;

        if ($(this).hasClass("down")) {
            //go up
            $(this).removeClass("down");
            $(this).addClass("up");
            $(this).addClass("active");
            $(this).children(".fa-solid").remove();
            $(this).append(' <i class="fa-solid fa-caret-up"></i>');

            column = $(this).attr("data-name");
            direction = "ASC";

        } else if ($(this).hasClass("up")) {
            //remove sort
            $(this).removeClass("up");
            $(this).removeClass("down");

            //reset sort
            column = "";
            direction = "";

        } else {
            //go down
            $(this).removeClass("up");
            $(this).addClass("down");
            $(this).addClass("active");
            $(this).append(' <i class="fa-solid fa-caret-down"></i>');

            column = $(this).attr("data-name");
            direction = "DESC";
        }

        sortCustomTable(column, direction);


    });

})