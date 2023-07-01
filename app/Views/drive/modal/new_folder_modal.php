<form class="modal-form">
  <label class="form-label">Folder name:</label>
  <input name="name" type="text" class="form-control form-control-sm" required minlength="3" maxlength="50">

  <div class="d-flex justify-content-end pt-4">
    <a data-bs-dismiss="modal" class="btn btn-sm btn-secondary me-2">Cancel</a>
    <button type="submit" class="btn btn-sm btn-primary submit-btn">Create</button>
  </div>
</form>


<script>
  $(".modal-form").submit(function(e) {
    e.preventDefault();
    var data = objectifyForm($(".modal-form").serializeArray());

    data = populateModalFormOptions(data);

    request("/api/drive/folder", data, "post", "create_folder_callback");

  });

  var create_folder_callback = function(data, status_text) {
    if (status_text) {
      SYSTEM.showToast(jQuery.parseJSON(status_text).messages.error, "text-bg-danger");
      return;
    }

    //insert the folder into the tree
    $.each(data.data, function(key, item) {
      insertFileFolder(key, item, true);
    });
    MODAL.hide();
    refreshFolders(data.folders);
    SYSTEM.showToast("Folder Created", "text-bg-success");
  }
</script>