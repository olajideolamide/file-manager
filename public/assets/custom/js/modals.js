let CUSTOM_MODAL;

function showModal(type, title, body, submit_text) {

    $("#" + type + " .modal-title").text(title);
    $("#" + type + " .modal-body .content").html(body);

    if (submit_text != "") {
        $("#" + type + ".modal .submit-btn").removeClass("d-none").text(submit_text);
    }

    CUSTOM_MODAL = new bootstrap.Modal("#" + type, {
        backdrop: 'static'
    });
    CUSTOM_MODAL.show();
}

function closeModal() {
    CUSTOM_MODAL.hide();

}


$('body').on('click', '#small-modal.modal .submit-btn', function () {
    var data = objectifyForm($("#small-modal .modal-form").serializeArray());

    data = populateModalFormOptions(data);

    request($("#small-modal .modal-form").attr('action'), data, $("#small-modal .modal-form").attr('method'), $("#small-modal .modal-form").attr('callback'));
});



function getCreateFolderModalContent(call_back) {
    if (!call_back) call_back = "create_folder_callback";
    return `<form class="modal-form" action="api/drive/folder" method="post" callback="` + call_back + `">
    <input name="name" type="text" class="form-control form-control-sm" placeholder="Enter a name" required>
</form>`;
}




let move_modal_content =
    `<a class=" text-primary" data-bs-target="#small-modal" data-bs-toggle="modal">Create Folder</a>
    <form class="modal-form" action="api/drive/folder" method="post" callback="create_folder_callback">
            <input name="name" type="text" class="form-control form-control-sm" placeholder="Enter a name" required>
    </form>`;