<admin-menu inline-template>

    <div class="pt-3">

        <div class="text-center">
            <img src="/assets/custom/images/icon-new-md.png" width="70" />
        </div>


        <div class="btn-toolbar mt-5">

            <div class="dropdown mx-auto">
                <button class="btn btn-primary  btn-sm dropdown-toggle fw-bold no-icon rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:150px">
                    <i class="fa-solid fa-upload"></i> Upload
                </button>
                <ul class="dropdown-menu">
                    <li><a class="upload-files dropdown-item" href="#"><span data-feather="file" class="align-text-bottom"></span> Upload files</a></li>
                    <li><a class="upload-files dropdown-item" href="#"><span data-feather="folder" class="align-text-bottom"></span> Upload Folder</a></li>
                    <li><a onclick="SYSTEM.showModal('', '/api/modal/drive/new-folder');" class="dropdown-item create-folder-btn" href="#"><span data-feather="folder-plus" class="align-text-bottom "></span> Create Folder</a></li>
                </ul>
            </div>

        </div>


        <ul class="nav flex-column mt-4 mb-2 border-top pt-4">
            <li class="nav-item mb-2">
                <a class="nav-link link-primary" href="#">
                    <div class="d-inline-block" style="width:25px; height: 15px"><i class="fa-solid fa-database me-2 "></i></div>
                    All files
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <div class="d-inline-block" style="width:25px; height: 15px"><i class="fa-solid fa-clock me-2"></i></div>

                    Recent
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <div class="d-inline-block" style="width:25px; height: 15px"> <i class="fa-solid fa-star me-2"></i></div>

                    Starred
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <div class="d-inline-block" style="width:25px; height: 15px"> <i class="fa-solid fa-share-nodes me-2"></i></div>

                    Shared with me
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <div class="d-inline-block" style="width:25px; height: 15px"> <i class="fa-solid fa-trash me-2"></i></div>

                    Trash
                </a>
            </li>

        </ul>



        <div class="border-top mt-4 pt-4">
            <div class="progress mx-3" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-primary" style="width: 25%"></div>

            </div>
            <div class="mx-3 text-center ">
                <div class="mt-2"><small>70MB of 1GB used</small></div>
            </div>
        </div>



    </div>








</admin-menu>