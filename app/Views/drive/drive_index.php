<div class="content-container col-xs-12 col-md-12 col-lg-10 ">
    <div class="row g-0">


        <div class="content-header col-12 p-0 p-3 border-bottom d-flex justify-content-between align-items-center bg-light">

            <div class="w-75 d-flex">
                <button type="button" class="btn btn-outline-secondary btn-sm me-3 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive2" aria-controls="offcanvasResponsive2">
                    <span data-feather="menu"></span>
                </button>

                <input class="search form-control form-control-sm w-75 rounded border-secondary-subtle" type="text" placeholder="Search files and folders" aria-label="Search" v-model="search_term">
            </div>


            <div class="user-widget">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">

                        <span class="mx-2 text-secondary d-none d-md-inline-block">Olajide</span>
                    </a>
                    <ul class="dropdown-menu text-small" style="">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>

        </div>



        <div id="main-pane" class="col-12" v-bind:class="[main_pane_active_class]">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-0 mb-2 mx-3">
                <div class="breadcrumb-container">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb me-2 mb-0">


                            <li class="breadcrumb-item breadcrumb-clickable active" aria-current="page" v-bind:data-id="root_breadcrumb.id">
                                <span v-if="visible_breadcrumb.length > 0" class="link-primary pointer"><i class="fa-sharp fa-solid fa-house"></i> </span>

                            </li>


                            <li v-if="dropdown_breadcrumb.length > 0" class="breadcrumb-item">
                                <div class="btn-group p-0" role="group">
                                    <span class="dropdown-item" class="pointer dropdown-toggle no-icon p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li v-for="bread2 in dropdown_breadcrumb" class="breadcrumb-clickable" aria-current="page" v-bind:data-id="bread2.id">
                                            <span class="dropdown-item" class="pointer"><i class="fa-solid fa-folder"></i> {{bread2.name | truncate(15)}} </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li v-for="(bread, index) in visible_breadcrumb" class="breadcrumb-item breadcrumb-clickable active" aria-current="page" v-bind:data-id="bread.id">
                                <span v-if="index < (visible_breadcrumb.length-1)" class="link-primary pointer">{{bread.name | truncate(15)}} </span>
                                <span v-else>{{bread.name | truncate(15)}} </span>
                            </li>


                        </ol>
                    </nav>


                </div>
                <div class="btn-toolbar mb-2 mb-md-0">

                    <div class="dropdown">
                        <button class="btn btn-primary  btn-sm dropdown-toggle fw-bold no-icon rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:150px">
                            <i class="fa-solid fa-upload"></i> Upload
                        </button>
                        <ul class="dropdown-menu">
                            <li><a id="upload-files" class="dropdown-item" href="#"><span data-feather="file" class="align-text-bottom"></span> Upload files</a></li>
                            <li><a id="upload-folder" class="dropdown-item" href="#"><span data-feather="folder" class="align-text-bottom"></span> Upload Folder</a></li>
                            <li><a onclick="SYSTEM.showModal('', '/api/modal/drive/new-folder');" class="dropdown-item create-folder-btn" href="#"><span data-feather="folder-plus" class="align-text-bottom "></span> Create Folder</a></li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="d-flex justify-content-between bg-light mb-2 mt-3 py-1 mx-3 px-2">

                <div>

                    <div class="dropdown d-lg-none">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" v-bind:class="bulk_options_class">
                            <span data-feather="menu" class="align-text-bottom"></span> Options
                        </button>
                        <ul class="dropdown-menu">
                            <li><span class="dropdown-item bulk-option move pointer">Move to</span></li>
                            <li><span class="dropdown-item pointer">Download</span></li>
                            <li><span class="dropdown-item pointer">Add to Starred</span></li>
                            <li><span class="dropdown-item pointer">Trash</span></li>
                        </ul>
                    </div>



                    <button type="button" class="d-none d-lg-inline-block option bulk-option move btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" v-bind:class="bulk_options_class">
                        <span data-feather="move" class="align-text-bottom"></span> Move
                    </button>


                    <button type="button" class="d-none d-lg-inline-block option bulk-option download btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" v-bind:class="bulk_options_class">
                        <span data-feather="download" class="align-text-bottom"></span> Download
                    </button>

                    <button type="button" class="d-none d-lg-inline-block option bulk-option star btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" v-bind:class="bulk_options_class">
                        <span data-feather="star" class="align-text-bottom"></span> Star
                    </button>

                    <button type="button" class="d-none d-lg-inline-block option bulk-option trash btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" v-bind:class="bulk_options_class">
                        <span data-feather="trash-2" class="align-text-bottom"></span> Trash
                    </button>

                </div>

                <div>




                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked value="true" v-model="show_list">
                        <label class="btn btn-outline-secondary" for="btnradio1"><i data-feather="list"></i></label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="false" v-model="show_list">
                        <label class="btn btn-outline-secondary" for="btnradio2"><i data-feather="grid"></i></label>

                        <button v-on:click="showInfoPane" class="btn btn-sm btn-outline-secondary d-none d-lg-block">
                            <i data-feather="info"></i>
                        </button>

                        <button v-on:click="showInfoPane" class="btn btn-sm btn-outline-secondary d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                            <i data-feather="info"></i>
                        </button>
                    </div>




                </div>

            </div>





            <div class="main-content">
                <div class="mx-3">
                    <div v-if="files.length == 0" class="drag-drop-container border border-3 mb-3 rounded">
                        <img src="/assets/custom/images/add_files.svg" height="150" />
                        <div class="mt-3">
                            <h4>Drop files and folders here</h4>
                            Or use the "Upload" button
                        </div>

                    </div>

                    <div v-else class="list_grid">
                        <div class="rounded list-view" v-if="show_list == 'true'">
                            <div class="card border-0" style="background-color:transparent">
                                <div class="card-body p-0">
                                    <div class="table-container">
                                        <div class="loader"></div>
                                        <table class="table table-sm custom mb-0 py-3">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle" scope="col" width="30" style="max-width: 30px">

                                                        <div>
                                                            <input class="form-check-input check-all" type="checkbox" v-model="all_selected">
                                                        </div>


                                                    <th class="sortable ps-3" scope="col" data-name="name">Name</th>
                                                    <th class="sortable d-none d-md-table-cell" scope="col" data-name="size" width="100" style="min-width: 100px">Size</th>
                                                    <th class="sortable d-none d-md-table-cell" scope="col" data-name="updated_at">Last Modified</th>
                                                    <th class="d-lg-none" scope="col" width="30"></th>



                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(file, index) of files" :key="file.id" v-bind:data-id="file.id">
                                                    <td class="text-center align-middle">
                                                        <div>
                                                            <input class="form-check-input" type="checkbox" v-model="selected" :value="file.id">
                                                        </div>
                                                    </td>
                                                    <td class="d-flex ps-3">
                                                        <div v-bind:data-file-id="file.id" v-on:click="populateInfoPane" class="d-flex align-items-center flex-grow-1">
                                                            <img v-if="file.file_type == 'photo'" v-bind:src="file.thumb_url" width="30" height="30" class="me-3" v-bind:data-file-id="file.id" />
                                                            <small-folder v-else-if="file.type == 'FOLDER'" v-bind:id="file.id" v-on:click="populateInfoPane"></small-folder>
                                                            <small-icon v-else v-bind:text="file.extension" v-bind:id="file.id" v-on:click="populateInfoPane"></small-icon>



                                                            <div class="file-name text-truncate" v-bind:data-file-id="file.id">
                                                                {{ file.name }}
                                                            </div>
                                                        </div>
                                                        <div class="px-3 d-none d-md-block">
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                    </td>
                                                    <td class="d-none d-md-table-cell" v-if="file.type == 'FOLDER'" v-bind:data-file-id="file.id" v-on:click="populateInfoPane">Folder
                                                    </td>
                                                    <td class="d-none d-md-table-cell" v-else v-bind:data-file-id="file.id" v-on:click="populateInfoPane">
                                                        {{ formatBytes(file.size) }}

                                                    </td>
                                                    <td class="d-none d-md-table-cell" v-bind:data-file-id="file.id" v-on:click="populateInfoPane">{{ file.updated_at }}</td>
                                                    <td class="d-lg-none" scope="col">

                                                        <div class="dropdown">
                                                            <button class="btn btn-xs btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#">Move to</a></li>
                                                                <li><a class="dropdown-item" href="#">Download</a></li>
                                                                <li><a class="dropdown-item" href="#">Add to Starred</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#">Trash</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid-view pt-0" v-if="show_list == 'false'">

                            <div class="row g-3 mt-1 grid-container">
                                <div v-for="(file,index) of files" :key="file.id" v-bind:data-id="file.id" class="col-6 col-sm-4 col-md-3">
                                    <div class="card" v-bind:data-file-id="file.id" v-bind:data-id="file.id" style="box-shadow: 0px 8px 15px -3px rgba(0,0,0,0.1);">
                                    <input class="form-check-input" type="checkbox" v-model="selected" :value="file.id">
                                        <div class="img-container" style="height: 90%" v-bind:data-file-id="file.id" v-on:click="populateInfoPane">

                                            <img v-if="file.file_type == 'photo'" v-bind:src="file.thumb_url" style="width: auto; max-width: 100%; object-fit: cover;" class="card-img-top border-0" v-bind:data-file-id="file.id" v-on:click="populateInfoPane" />
                                            <large-folder v-else-if="file.type == 'FOLDER'" v-bind:id="file.id" v-on:click="populateInfoPane"></large-folder>
                                            <large-icon v-else v-bind:text="file.extension" v-bind:id="file.id" v-on:click="populateInfoPane"></large-icon>
                                        </div>
                                        <div class="card-body" v-bind:data-file-id="file.id" v-on:click="populateInfoPane">
                                            <div class="card-text d-flex justify-content-between">
                                                <div class="text-truncate" style="max-width: 90%;" v-bind:data-file-id="file.id" v-on:click="populateInfoPane">
                                                    {{file.name}}
                                                </div>
                                                <div class="dropdown d-lg-none">
                                                    <button class="btn btn-xs btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Move to</a></li>
                                                        <li><a class="dropdown-item" href="#">Download</a></li>
                                                        <li><a class="dropdown-item" href="#">Add to Starred</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Trash</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div id="info-pane" class="d-none col-lg-3 border-start" v-bind:class="[info_pane_active_class]">
            <?= $this->include('drive/sidebar_partials/info_pane') ?>
        </div>
    </div>
</div>





<div class="offcanvas offcanvas-lg offcanvas-start" data-bs-backdrop="true" data-bs-scroll="true" tabindex="-1" id="offcanvasResponsive2" aria-labelledby="offcanvasResponsive2Label">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-secondary" id="offcanvasResponsive2Label">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive2" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="bg-light">
            <?= $this->include('global/sidebar_partials/side_menu') ?>
        </nav>
    </div>
</div>




<div class="offcanvas offcanvas-lg offcanvas-end" data-bs-backdrop="static" data-bs-scroll="true" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">

    <div class="offcanvas-body p-0">
        <?= $this->include('drive/sidebar_partials/info_pane') ?>
    </div>
</div>


<input id="file-input" class="d-none" type="file" name="name[]" multiple />
<input id="folder-input" class="d-none" type="file" webkitdirectory mozdirectory />