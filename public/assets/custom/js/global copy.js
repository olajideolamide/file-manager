const loading_div = '<div class="w-75 mx-auto text-center py-5"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

$(".dropdown-menu label").click(function (e) {
    e.stopPropagation(); // if you click on the div itself it will cancel the click event.
});

Vue.filter('truncate', function (fullStr, strLen, separator) {
    if (!fullStr) return '';

    if (fullStr.length <= strLen) return fullStr;

    separator = separator || '...';

    var sepLen = separator.length,
        charsToShow = strLen - sepLen,
        frontChars = Math.ceil(charsToShow / 2),
        backChars = Math.floor(charsToShow / 2);

    return fullStr.substr(0, frontChars) +
        separator +
        fullStr.substr(fullStr.length - backChars);
})


var app = new Vue({
    el: '#apps',
    data: {
        parent: "",
        search_term: "",
        sort_column: "",
        sort_dir: "",
        show_list: "true",
        folders: {},
        files: [],
        main_pane_active_class: 'col-lg-12',
        info_pane_active_class: '',
        info_pane_data: {
            title: "",

        },
        current_info_item: ""

    },
    computed: {
        file_folder_map: {
            // getter
            get: function () {
                return this.files.reduce((accumulator, item) => {

                    item.selected = false;
                    return {
                        ...accumulator,
                        [item.id]: item
                    };
                }, {});
            }
        },
        current_info_item_object: {
            get: function () {
                if (!this.current_info_item) return {};

                return this.file_folder_map[this.current_info_item];
            }
        },
        enable_bulk_options: {
            get: function () {

                for (var key in this.file_folder_map) {
                    console.log(this.file_folder_map);
                    if (this.file_folder_map[key].selected == true) {

                        return "";
                    }
                }


                return "disabled";
            }
        }

    },
    methods: {
        truncateThis: function (str, n) {
            return (str.length > n) ? str.slice(0, n - 1) + "..." : str;
        },
        formatBytes(bytes, decimals = 1) {
            if (!+bytes) return '0 Bytes'

            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

            const i = Math.floor(Math.log(bytes) / Math.log(k))

            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        },
        showInfoPane() {
            this.main_pane_active_class = 'col-lg-9';
            this.info_pane_active_class = 'd-lg-block';
        },
        hideInfoPane() {
            this.main_pane_active_class = 'col-lg-12';
            this.info_pane_active_class = '';
        },
        clearAllSelected() {
            for (var key in this.file_folder_map) {
                this.file_folder_map[key].selected = false;
            }
            $(".table.custom tbody td input").prop('checked', false);
            $(".table.custom tbody td input").attr("checked", false);
        },
        toggleFilesSelect(event) {
            let value = true;

            if (event.target.checked != true) value = false;
            for (var key in this.file_folder_map) {
                this.file_folder_map[key].selected = value;
            }
        },
        populateInfoPane(event) {
            //if (!event.target.dataset.fileId) return;
            this.clearAllSelected();
            this.current_info_item = event.target.dataset.fileId;
            this.file_folder_map[event.target.dataset.fileId].selected = true;
            //this.info_pane_data.title = this.file_folder_map[event.target.dataset.fileId].name;
            //this.showInfoPane();

        }

    }
})







//ajax
function request(path, data, method, call_back) {

    if (method != "get") {
        data[csrf_token_name] = csrf_hash;
    }

    var request = $.ajax({
        url: path,
        method: method,
        data: data,
        cache: false,
        dataType: "json"
    });

    request.done(function (msg) {
        var fn = window[call_back];
        if (typeof fn === "function") fn(msg);
        //call_back(msg)
    });

    request.fail(function (jqXHR, textStatus) {
        //call_back("", jqXHR.responseText);
        var fn = window[call_back];
        if (typeof fn === "function") fn("", jqXHR.responseText);

    });
}




function showToast(message) {
    $(".toast .toast-body").html(message);
    $(".demo-static-toast .toast").show().delay(10000).fadeOut();
}

function randomString(len) {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = len;
    var randomstring = '';
    for (var i = 0; i < string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars[rnum];
    }
    return randomstring;
}

function truncate(str, n) {
    return (str.length > n) ? str.slice(0, n - 1) + '&hellip;' : str;
};

function formatBytes(bytes, decimals = 1) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}


function objectifyForm(formArray) {
    //serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}