<form class="modal-form">
  <div class="modal-content">
    <div class="modal-header border-bottom p-4">
      <div class="modal-title fw-bold" id="staticBackdropLabel">New Folder</div>
      <button type="button" class="btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-4">
      <div class="py-2">
        <label class="form-label">Folder name:</label>
        <input name="name" type="text" class="form-control form-control-sm" required minlength="3" maxlength="50">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-sm btn-primary submit-btn" v-bind:class="move_btn_class">Create</button>
    </div>
  </div>
</form>


<script>
  var callback = "<?php echo $callback; ?>";
  $(".modal-form").submit(function(e) {
    e.preventDefault();
    var data = objectifyForm($(".modal-form").serializeArray());

    data["parent"] = "<?php echo $parent; ?>";

    var fn = window["move_modal_handle_new_folder"];

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
      window[callback](item.id);
    });
    CHILD_MODAL.hide();
    refreshFolders(data.folders);
    SYSTEM.showToast("Folder Created", "text-bg-success");
  }
</script>