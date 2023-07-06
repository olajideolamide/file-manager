var SYSTEM = new Vue({
    el: '#system',
    data: {
        toast_class: "text-bg-danger",
        toast_message: "",
        modal_size_class: "modal-sm",
        modal_title: "",
        modal_has_content: false,
        child_modal_has_content: false

    },
    computed: {},
    watch: {},
    methods: {
        showModal(size_class, url) {
            this.modal_size_class = size_class;
            this.modal_has_content = false;
            $("#modal .content").html("");
            MODAL.show();
            var data = {};
            request(url, data, "get", "process_modal_ui_response");
        },
        showChildModal(url, data) {
            this.child_modal_has_content = false;
            $("#child-modal .content").html("");
            CHILD_MODAL.show();
            request(url, data, "get", "process_child_modal_ui_response");
        },
        showToast(msg, this_size_class) {

            this.toast_class = this_size_class;
            this.toast_message = msg;

            $("#info-toast").toast("show");
        }
    }
})


feather.replace();

let MODAL = new bootstrap.Modal("#modal", {
    backdrop: 'static'
});

let CHILD_MODAL = new bootstrap.Modal("#child-modal", {
    backdrop: 'static'
});

const chid_modal_el = document.getElementById('child-modal')
chid_modal_el.addEventListener('show.bs.modal', event => {
    $("#modal").css("z-index", 2);

});

chid_modal_el.addEventListener('hidden.bs.modal', event => {
    $("#modal").css("z-index", 1055);

});





var process_modal_ui_response = function (data, status_text) {

    if (status_text) {
        MODAL.hide();
        SYSTEM.toast_message = "status_text";
        return;
    }

    SYSTEM.modal_has_content = true;


    $("#modal .content").html(data["data"]);

};


var process_child_modal_ui_response = function (data, status_text) {

    if (status_text) {
        CHILD_MODAL.hide();
        SYSTEM.toast_message = "status_text";
        return;
    }

    SYSTEM.child_modal_has_content = true;


    $("#child-modal .content").html(data["data"]);

};






$(".dropdown-menu label").click(function (e) {
    e.stopPropagation();
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


function objectifyForm(formArray) {
    //serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function isTouchDevice() {
    return (('ontouchstart' in window) ||
        (navigator.maxTouchPoints > 0) ||
        (navigator.msMaxTouchPoints > 0));
}