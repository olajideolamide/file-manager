let CUSTOM_MODAL;

function showModal(title, body, submit_text) {

    $(".modal-title").text(title);
    $(".modal-body .content").html(body);

    if (submit_text != "") {
        $(".modal .submit-btn").removeClass("d-none").text(submit_text);
    }
    CUSTOM_MODAL = new bootstrap.Modal('#modal', {
        backdrop: 'static'
    });
    CUSTOM_MODAL.show();
}

function closeModal() {
    CUSTOM_MODAL.hide();

}


$('body').on('click', '.modal .submit-btn', function () {
    var data = $("#modal-form").serialize();
    data = getModalFormOptions() + "&" + data;

    request($("#modal-form").attr('action'), data, $("#modal-form").attr('method'), $("#modal-form").attr('callback'));
});





let create_folder_modal_content =
    `<form id="modal-form" action="drive/create-folder" method="post" callback="create_folder_callback">
            <input name="name" type="text" class="form-control form-control-sm" placeholder="Enter a name" required>
    </form>`;