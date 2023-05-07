var PARENT = "";
var LIST_STATUS = 1;
var LIST_SEARCH = "";
var LIST_SORT_COLUMN = "";
var LIST_SORT_DIR = "";
var FOLDERS = {};
var ITEMS_MAP = {};
var ITEMS_COUNT = 0;
var BREADCRUMB = [];
var CURRENT_VIEW = "table";

BREADCRUMB[0] = {
    id: "",
    name: "Home",
    index: 0
};

var TABLE_FILTERS = {};

var TABLE_PLACEHOLDER = `
<tr>
<td class="text-center d-none"><input type="checkbox" /></td>
<td><p class="placeholder-glow">
<span class="placeholder col-12"></span></p></td><td ><p class="placeholder-glow">
<span class="placeholder col-12"></span></p></td><td ><p class="placeholder-glow">
<span class="placeholder col-12"></span></p></td>`;




/**
 * refetches the table data from the server
 */
function refetchData() {
    tableLoader("show");
    var data = getOptions();
    request(table_src_url, data, "post", "refresh_table");
}


//initialize the table and load the default view
$(function () {
    refreshBreadCrumb();
    refetchData();
})



function tableLoader(action) {
    if (action == "show") {
        $('table.custom tbody').empty();
        for (let i = 0; i < 1; i++) {
            $('table.custom tbody').append(TABLE_PLACEHOLDER);
        }

        $(".table-container .loader").css("height", "100%");
    } else {
        $(".table-container .loader").css("height", "0%");
    }

}

//table options
function getOptions() {

    return {
        "filter": JSON.stringify(TABLE_FILTERS),
        "search": LIST_SEARCH,
        "sort": LIST_SORT_COLUMN,
        "dir": LIST_SORT_DIR,
        "parent": PARENT
    };
}


function clearOptions() {
    LIST_SEARCH = "";
    LIST_SORT_COLUMN = "";
    LIST_SORT_DIR = "";
    $(".search.form-control").val("");

}

function getModalFormOptions() {
    return "parent=" + PARENT;
}



$(function () {
    'use strict'

    $('body').on('click', 'table.custom tbody tr', function (e) {

        //
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

        var item = ITEMS_MAP[$(this).data("id")];

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
    PARENT = parent;
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



//search filter
$(function () {

    $(".search").keyup(function (e) {

        LIST_SEARCH = $(this).val();
        refetchData();
    });

})


//column sort
function sortCustomTable(column, direction) {


    LIST_SORT_COLUMN = column;
    LIST_SORT_DIR = direction;

    refetchData();
}



function refreshItemsMap(data) {
    ITEMS_MAP = {};
    ITEMS_COUNT = 0;
    $.each(data, function (key, item) {
        ITEMS_MAP[item["id"]] = item;

    })


}

function refreshFolders(data) {
    FOLDERS = {};
    let this_parent;
    $.each(data, function (key, item) {
        FOLDERS[item["id"]] = item;

        //if this folder belongs to this parent and it is not in view, add
        this_parent = PARENT;
        if (!this_parent) this_parent = null;

        if (item["parent_id"] == this_parent && !ITEMS_MAP[item["id"]]) {
            insertItem(0, item);
        }

    });


}


var refresh_table = function (data, status_text) {


    if (status_text) {
        //we show error
        tableLoader("hide");
        return;
    }

    refreshItemsMap(data.data);
    refreshFolders(data.folders);

    clearView();
    prepareView();

    $.each(data.data, function (key, item) {
        insertItem(key, item);
    });




};

function prepareView() {


    if (ITEMS_COUNT == 0 && PARENT == "" && LIST_SEARCH == "") {
        $(".drag-drop-container").removeClass("d-none");
        $(".list-view").addClass("d-none");
        $(".grid-view").addClass("d-none");
    } else if (ITEMS_COUNT == 0 && LIST_SEARCH != "") {
        $(".drag-drop-container").addClass("d-none");
        if (CURRENT_VIEW == "table") {
            $(".list-view").removeClass("d-none");
            $(".grid-view").addClass("d-none");
            $('table.custom tbody').append(generateEmptyRow("No result was found for your query"));

        } else {
            $(".list-view").addClass("d-none");
            $(".grid-view").removeClass("d-none");

        }
    } else if (ITEMS_COUNT == 0 && LIST_SEARCH == "") {
        $(".drag-drop-container").addClass("d-none");
        if (CURRENT_VIEW == "table") {
            $(".list-view").removeClass("d-none");
            $(".grid-view").addClass("d-none");
            $('table.custom tbody').append(generateEmptyRow("This folder is empty"));

        } else {
            $(".list-view").addClass("d-none");
            $(".grid-view").removeClass("d-none");

        }

    } else {
        $(".drag-drop-container").addClass("d-none");
        if (CURRENT_VIEW == "table") {
            $(".list-view").removeClass("d-none");
            $(".grid-view").addClass("d-none");
            $('table.custom tbody .empty').remove();
        } else {
            $(".list-view").addClass("d-none");
            $(".grid-view").removeClass("d-none");

        }
    }


}

function clearView() {
    if (CURRENT_VIEW == "table") $('table.custom tbody').empty();
    else $('.grid-view').empty();
}


function insertItem(key, item) {
    let this_parent = PARENT;
    if (!this_parent) this_parent = null;
    if (item["parent_id"] != this_parent) return;
    ITEMS_MAP[item["id"]] = item;
    ITEMS_COUNT++;
    if (CURRENT_VIEW == "table") generateRow(item);
    else generateGrid(item);

    prepareView();
}



function generateRow(row) {
    tableLoader("hide");
    var markup = `<tr data-id="` + row["id"] + `">`;
    markup += `<td class="text-center d-none"><input type="checkbox" /></td>`;
    markup += `<td class="d-flex ps-3"><div class="flex-grow-1"><i class="fa-solid  pe-3 fa-` + row["icon"] + `"></i> ` + truncate(row["name"], 35) + `</div> <div class="px-3"><i class="fa-regular fa-star"></i></div></td> `;

    if (row["type"] == "FOLDER") markup += `<td >` + row["size"] + ` items</td>`;
    else markup += `<td >` + formatBytes(row["size"]) + `</td>`;

    markup += `<td >` + row["updated_at"] + `</td>`;

    markup += `</tr>`;

    if (row["type"] == "FOLDER") $('table.custom tbody').prepend(markup);
    else $('table.custom tbody').append(markup);

}

function generateGrid(grid) {

}

function generateEmptyRow(message) {

    var markup = `<tr class="empty"><td class="text-center" colspan="4">` + message + `</td></tr>`;

    return markup;
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