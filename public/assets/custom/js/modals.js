var process_modal_ui_response = function (data, status_text) {

    if (status_text) {
        MODAL.hide();
        SYSTEM.toast_message = "status_text";
        return;
    }

    SYSTEM.modal_has_content = true;


    $("#modal .content").html(data["data"]);

};