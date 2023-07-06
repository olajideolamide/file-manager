<div id="move-modal" class="modal-content">
  <div class="modal-header border-bottom p-4">
    <div class="modal-title fw-bold" id="staticBackdropLabel">Move <span class="text-dark">{{modal_title | truncate(30)}}</span> to</div>
    <button type="button" class="btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body p-4">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron pt-2 pb-1 bg-body-tertiary rounded-3">
          <li class="breadcrumb-item" v-on:click="moveModalUpdateParent('')">
            <a class="link-body-emphasis" href="#">
              <i class="fa-sharp fa-solid fa-house"></i>
              <span class="visually-hidden">Home</span>
            </a>
          </li>


          <li v-if="dropdown_breadcrumb.length > 0" class="breadcrumb-item">
            <div class="btn-group p-0" role="group">
              <span class="dropdown-item" class="pointer dropdown-toggle no-icon p-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
              </span>
              <ul class="dropdown-menu">
                <li v-for="bread2 in dropdown_breadcrumb" aria-current="page" v-bind:data-id="bread2.id" v-on:click="moveModalUpdateParent(bread2.id)">
                  <span class="dropdown-item" class="pointer"><i class="fa-solid fa-folder"></i> {{bread2.name | truncate(15)}} </span>
                </li>
              </ul>
            </div>
          </li>

          <li v-for="(bread, index) in visible_breadcrumb" class="breadcrumb-item active" aria-current="page" v-bind:data-id="bread.id" v-on:click="moveModalUpdateParent(bread.id)">
            <span v-if="index < (visible_breadcrumb.length-1)" class="link-primary pointer">{{bread.name | truncate(10)}} </span>
            <span v-else>{{bread.name | truncate(10)}} </span>
          </li>





        </ol>
      </nav>

      <div class="d-flex justify-content-between align-items-center py-3"><span>Select a folder</span> <span v-on:click="showDialog" class="btn btn-link btn-sm">New Folder</span></div>



      <div class="list-group">
        <a v-for="folder in folders" href="#" class="list-group-item list-group-item-action d-flex gap-3 py-1" aria-current="true" v-on:click="moveModalUpdateParent(folder.id)">

          <div class="d-flex gap-2 w-100 justify-content-between align-items-center">
            <div>
              <p class="mb-0">
                <svg viewBox="476.646 525.165 150.477 150" width="150.477px" height="150px" style="width: 30px; height: 30px" xmlns="http://www.w3.org/2000/svg" class="me-3">

                  <rect class="fil0" x="500.03" y="561.816" width="100" height="100.038" style="fill:none" />
                  <rect x="477.123" y="525.165" width="150" height="150" style="fill: none;" />
                  <g transform="matrix(0.304878, 0, 0, 0.305672, 473.597687, 521.723145)">
                    <g>
                      <polygon fill="#FFE352" points="10,156 40,436 472,436 502,156" />
                    </g>
                    <g>
                      <polygon fill="#FFB236" points="192,116 182,76 82,76 72,116 40,116 40,156 472,156 472,116" />
                    </g>
                    <g>
                      <rect x="69" y="356" transform="matrix(-1 4.491373e-11 -4.491373e-11 -1 258 760)" fill="#FFB236" width="120" height="48" />
                    </g>
                    <g>
                      <rect x="69" y="316" transform="matrix(-1 1.866717e-11 -1.866717e-11 -1 258 652)" fill="#6E83B7" width="120" height="20" />
                    </g>
                  </g>
                </svg>

                {{folder.name}}
              </p>

            </div>
            <span class="opacity-50 text-nowrap"><i class="fa-solid fa-angle-right"></i></span>
          </div>
        </a>

      </div>

      <div v-if="folders.length < 1" class="text-center">
        <div class="card border-0 rounded-0  p-0">

          <div class="card-body p-3 mt-2">
            <img src="/assets/custom/images/info_pane_empty.svg" height="150" class="mb-4" />
            <h6>There are no subfolders to show</h6>
          </div>

        </div>
      </div>




    </div>
  </div>





  <div class="modal-footer">
    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-sm btn-primary submit-btn" v-bind:class="move_btn_class" v-on:click="moveItems">
      <span class="spinner spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
      Move here
    </button>
  </div>
</div>






<script>
  var MOVE_MODAL = new Vue({
    el: '#move-modal',
    data: {
      modal_title: "<?php echo $folder_name; ?>",
      items: [<?php echo $ids; ?>],
      items_parents: [<?php echo $items_parents; ?>],
      parent: "-",
      folders: [],
      breadcrumb: [],
      visible_breadcrumb: [],
      dropdown_breadcrumb: [],
      move_btn_class: "disabled"


    },
    computed: {},
    watch: {
      parent: function() {
        this.refreshFolders();
        moveModalRefetchPath();
        var parent = this.parent;

        if (this.parent == "") parent = 0;



        var found = this.items_parents.find(function(item) {
          if (item == parent) return true;
        });




        if (found || found === 0) {
          this.move_btn_class = "disabled";
        } else {
          this.move_btn_class = "";
        }

      },
      breadcrumb: function() {
        let len = this.breadcrumb.length;
        this.dropdown_breadcrumb = [];
        this.visible_breadcrumb = this.breadcrumb;
        if (len > 5) {
          this.dropdown_breadcrumb = this.breadcrumb.slice(0, -4);
          this.visible_breadcrumb = this.breadcrumb.slice(-4);
        }
      }
    },
    methods: {
      refreshFolders() {
        var data = {
          "parent": this.parent
        };
        request("/api/drive/folders", data, "get", "move_modal_load_folders");
      },
      moveModalUpdateParent(parent_id) {

        this.parent = parent_id;
      },
      moveItems() {
        var data = {
          "ids": MOVE_MODAL.items,
          "destination_id": MOVE_MODAL.parent
        };
        toggleLoadingButton("#modal .submit-btn", "show");
        request("/api/drive/move", data, "post", "move_modal_post_move_reponse");
      },
      showDialog() {
        SYSTEM.showChildModal('/api/modal/child/drive/new-folder/', {
          "parent": this.parent,
          "callback": "move_modal_handle_new_folder"
        });
      }
    }


  })



  function move_modal_handle_new_folder(parent_id) {
    MOVE_MODAL.parent = parent_id;
  }

  var move_modal_post_move_reponse = function(data = null, status_text) {
    if (status_text) {
      toggleLoadingButton("#modal .submit-btn", "hide");
      SYSTEM.showToast(jQuery.parseJSON(status_text).messages.error, "text-bg-danger");
      return;
    }

    refetchData();
    //for (item of MOVE_MODAL.items) {
      //console.log(item);
      //file_app.removeItemFromFiles(item);
    //}
    MODAL.hide();
    SYSTEM.showToast("Items have been moved", "text-bg-success");
  };


  function moveModalRefetchPath() {

    var data = {};
    if (MOVE_MODAL.parent == "") {
      MOVE_MODAL.breadcrumb = [];
      return;
    }
    request("/api/drive/path/" + MOVE_MODAL.parent, data, "get", "move_modal_handle_path");
  }


  var move_modal_handle_path = function(data, status_text) {


    if (status_text) {
      //we show error
      return;
    }

    MOVE_MODAL.breadcrumb = [];

    $.each(data, function(key, item) {
      MOVE_MODAL.breadcrumb.push({
        "id": item.id,
        "name": item.name
      });
    });
  };


  var move_modal_load_folders = function(data, status_text) {

    if (status_text) {
      return;
    }

    MOVE_MODAL.folders = [];
    var found;
    $.each(data, function(key, item) {
      found = MOVE_MODAL.items.find(function(item2) {

        return item.id == item2;
      });


      if (found) {} else {
        MOVE_MODAL.folders.push(item);
      }

    });
  };


  $(function() {
    MOVE_MODAL.parent = "";
  })
</script>