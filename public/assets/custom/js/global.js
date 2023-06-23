$(".dropdown-menu label").click(function (e) {
    e.stopPropagation();
});

Vue.component('admin-menu', {
    data: function () {
        return {

        }
    }
})


Vue.component('info-pane', {
    data: function () {
        return {

        }
    }
})

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
        current_info_item: "",
        selected: [],
        all_selected: false,
        bulk_options_class: "disabled"

    },
    computed: {
        file_folder_map: {
            // getter
            get: function () {
                return this.files.reduce((accumulator, item) => {
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
        }


    },
    watch: {
        all_selected: function (val) {
            this.selected = [];
            if (val == true) {
                for (var key in this.file_folder_map) {

                    this.selected.push(key);
                }
            }
        },
        selected: function (val) {
            if (val.length > 0) this.bulk_options_class = "";
            else this.bulk_options_class = "disabled";
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

            this.selected = [];
        },
        populateInfoPane(event) {
            this.clearAllSelected();
            this.all_selected = false;
            this.current_info_item = event.target.dataset.fileId;
            this.selected.push(event.target.dataset.fileId);
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