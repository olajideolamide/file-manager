var SYSTEM = new Vue({
    el: '#system',
    data: {
        toast_class: "text-bg-danger",
        toast_message: "",
        modal_size_class: "modal-sm",
        modal_title: "",
        modal_has_content: false

    },
    computed: {},
    watch: {},
    methods: {
        showModal(size_class, title, url) {
            this.modal_size_class = size_class;
            this.modal_title = title;
            this.modal_has_content = false;
            $("#modal .content").html("");
            MODAL.show();
            var data = {};
            request(url, data, "get", "process_modal_ui_response");
        },
        showToast(msg, this_size_class){

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