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





BREADCRUMB[0] = {
    id: "",
    name: "Home",
    index: 0
};

var TABLE_FILTERS = {};


/**
 * refetches the table data from the server
 */
function refetchData() {

    var data = getOptions();
    request(table_src_url, data, "get", "refresh_table");
}


//initialize the table and load the default view
$(function () {
    refreshBreadCrumb();
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

    $('body').on('click', 'table.custom tbody tr', function (e) {


        if ($(e.target).closest('input[type="checkbox"]').length > 0) {

        } else {
            var this_checkbox = $(this).children(":first").children(":first");
            this_checkbox.prop("checked", !this_checkbox.prop("checked"));

            if (this_checkbox.prop("checked") == true) $(this).addClass("selected");
            else $(this).removeClass("selected");
        }

        customTable_refreshChecked();

    });

    //double click a folder in the table view
    $('body').on('dblclick', 'table.custom tbody tr', function (e) {

        var item = app.file_folder_map[$(this).data("id")];

        if (item["type"] == "FOLDER") {
            incrementBreadcrumb({
                id: item["id"],
                name: item["name"],
                index: BREADCRUMB.length
            });

            updateParent(item["id"]);
        }


    });

    //click on a breadcrumb item
    $('body').on('click', '.breadcrumb-clickable', function (e) {
        pruneBreadcrumb($(this).data("index"));
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

function updateParent(parent) {
    app.parent = parent;
    refetchData();
}

function incrementBreadcrumb(entry) {
    BREADCRUMB.push(entry);
    refreshBreadCrumb();
}

function pruneBreadcrumb(index) {
    BREADCRUMB = BREADCRUMB.slice(0, index + 1);
    refreshBreadCrumb();
}

function refreshBreadCrumb() {
    let markup = "";
    let len = BREADCRUMB.length;
    let breadcrumb_dropdown = [];
    let visible_breadcrumb = BREADCRUMB;
    if (len > 5) {
        breadcrumb_dropdown = BREADCRUMB.slice(1, -4);
        visible_breadcrumb = BREADCRUMB.slice(-4);
        visible_breadcrumb.unshift(BREADCRUMB[0]);
    }

    let active = "";

    visible_breadcrumb.forEach((entry, index) => {
        if (visible_breadcrumb.length == index + 1) active = "active";
        markup += `<li class="breadcrumb-item breadcrumb-clickable ` + active + `" aria-current="page" data-id="` + entry["id"] + `" data-index="` + entry["index"] + `">`;
        if (visible_breadcrumb.length != index + 1) markup += `<a href="#" >`;
        markup += entry["name"];
        if (visible_breadcrumb.length != index + 1) markup += `</a>`;
        markup += `</li>`;

        if (index == 0 && len > 5) {
            markup += `<li class="breadcrumb-item">`;
            markup += `<div class="btn-group p-0" role="group">
                            <a class="dropdown-item" href="#" class="dropdown-toggle no-icon p-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                            </a>
                            <ul class="dropdown-menu">`;
            breadcrumb_dropdown.forEach((entry2) => {
                markup += `<li class="breadcrumb-clickable" aria-current="page" data-id="` + entry["id"] + `" data-index="` + entry["index"] + `"><a class="dropdown-item" href="#"><i class="fa-solid fa-folder"></i> ` + entry2["name"] + `</a></li>`;
            });


            markup += `</ul></div> </li>`;
        }
    });
    $(".breadcrumb").html(markup);
}




function customTable_refreshChecked() {
    //loop the inputs
    var count = 0;
    $('table.custom tbody input').each(function (index) {
        if ($(this).is(":checked") == true) {
            count++;
            $(this).closest("tr").addClass("checked");
        } else {
            $(this).closest("tr").removeClass("checked");
        }
    });

    refreshOptions(count);

}


function refreshOptions(count) {

    $(".option").prop('disabled', true);
    if (count >= 1) {
        $(".option").prop('disabled', false);
    }
}





$(function () {

    //first clear all active
    $(".table.custom thead th input.check-all").change(function () {
        // this will contain a reference to the checkbox

        if (this.checked) {
            $(".table.custom tbody td input").prop('checked', true);
        } else {
            $(".table.custom tbody td input").prop('checked', false);
        }

        customTable_refreshChecked();

    })


});





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

        if (item["parent_id"] == this_parent && !app.file_folder_map[item["id"]]) {
            insertFileFolder(0, item);
        }

    });


}


var refresh_table = function (data, status_text) {


    if (status_text) {
        //we show error
        return;
    }

    $.each(data.data, function (key, item) {
        insertFileFolder(key, item);
    });

};






function insertFileFolder(key, item) {
    let this_parent = app.parent;
    if (!this_parent) this_parent = null;
    if (item["parent_id"] != this_parent) return;
    app.files.push(item);

}



$(function () {

    $(".table.custom thead th.sortable").click(function (e) {

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