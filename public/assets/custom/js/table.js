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
    if (app.parent == "") {
        app.breadcrumb = [];
        return;
    }
    request("/api/drive/path/" + app.parent, data, "get", "handle_path");
}


//initialize the table and load the default view
$(function () {

    if (typeof folder_id !== 'undefined' && folder_id !== null) app.parent = folder_id;
    refetchData();
})



//table options
function getOptions() {

    return {
        "filter": JSON.stringify(TABLE_FILTERS),
        "search": app.search_term,
        "sort": app.sort_column,
        "dir": app.sort_dir,
        "parent": app.parent
    };
}


function clearOptions() {
    app.search_term = "";
    app.sort_column = "";
    app.sort_dir = "";
    $(".search.form-control").val("");

}

function populateModalFormOptions(data) {
    data["parent"] = app.parent;
    return data;
}



$(function () {
    'use strict'



    //double click a folder in the table view
    $('body').on('dblclick', 'table.custom tbody tr, .grid-view .card', function (e) {

        var item = app.getItemFromFiles($(this).data("id"));


        if (item["type"] == "FOLDER") {

            updateParent(item.id);


        }


    });

    //click on a breadcrumb item
    $('body').on('click', '.breadcrumb-clickable', function (e) {

        clearOptions();
        updateParent($(this).data("id"));
    });



    $('body').on('click', '.create-folder-btn', function (e) {
        showModal("small-modal", "New Folder", getCreateFolderModalContent(), "Create");
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


        app.search_term = e.state.search;
        app.sort_column = e.state.sort;
        app.sort_dir = e.state.dir;
        app.parent = e.state.parent;
        PUSH_STATE = false;
        refetchData();

    }
};

function updateParent(parent) {
    app.parent = parent;
    refetchData();
}















//column sort
function sortCustomTable(column, direction) {
    app.sort_column = column;
    app.sort_dir = direction;

    refetchData();
}


function refreshFolders(data) {
    app.folders = {};
    let this_parent;
    $.each(data, function (key, item) {
        app.folders[item["id"]] = item;

        //if this folder belongs to this parent and it is not in view, add
        this_parent = app.parent;
        if (!this_parent) this_parent = null;

        if (item["parent_id"] == this_parent && !app.getItemFromFiles(item["id"])) {
            insertFileFolder(0, item);
        }

    });


}


var refresh_table = function (data, status_text) {

    app.files = [];

    if (status_text) {
        //we show error
        return;
    }

    $.each(data.data, function (key, item) {
        insertFileFolder(key, item);
    });

    let url_path;
    if (PUSH_STATE == true) {
        if (app.parent == "") {
            url_path = "/drive";
        } else {
            url_path = "/drive/" + btoa(app.parent.toString().padEnd(10, "padding")).replace(/=+/, "");
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

    app.breadcrumb = [];
    $.each(data.data, function (key, item) {
        app.breadcrumb.push({
            "id": item.id,
            "name": item.name
        });
    });
};






function insertFileFolder(key, item, prepend = false) {
    let this_parent = app.parent;
    if (!this_parent) this_parent = null;
    if (item["parent_id"] != this_parent) return;

    if (prepend == true) app.files.unshift(item);
    else app.files.push(item);

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