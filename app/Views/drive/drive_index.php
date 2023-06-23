<div class="content-container col-xs-12 col-md-12 col-lg-10 ">
    <div class="row g-0">


        <div
            class="content-header col-12 p-0 p-3 border-bottom d-flex justify-content-between align-items-center bg-light">

            <div class="w-75 d-flex">
                <button type="button" class="btn btn-outline-secondary btn-sm me-3 d-lg-none" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasResponsive2" aria-controls="offcanvasResponsive2">
                    <span data-feather="menu"></span>
                </button>

                <input class="search form-control form-control-sm w-75 rounded border-secondary-subtle" type="text"
                    placeholder="Search files and folders" aria-label="Search" v-model="search_term">
            </div>


            <div class="user-widget">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
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
                <div>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb me-2 mb-0">

                        </ol>
                    </nav>


                </div>
                <div class="btn-toolbar mb-2 mb-md-0">

                    <div class="dropdown">
                        <button class="btn btn-primary  btn-sm dropdown-toggle fw-bold no-icon rounded" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="width:150px">
                            <i class="fa-solid fa-upload"></i> Upload
                        </button>
                        <ul class="dropdown-menu">
                            <li><a id="upload-files" class="dropdown-item" href="#"><span data-feather="file"
                                        class="align-text-bottom"></span> Upload files</a></li>
                            <li><a id="upload-folder" class="dropdown-item" href="#"><span data-feather="folder"
                                        class="align-text-bottom"></span> Upload Folder</a></li>
                            <li><a class="dropdown-item create-folder-btn" href="#"><span data-feather="folder-plus"
                                        class="align-text-bottom "></span> Create Folder</a></li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="d-flex justify-content-between bg-light mb-2 mt-3 py-1 mx-3 px-2">

                <div>

                    <div class="dropdown d-lg-none">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" v-bind:class="bulk_options_class">
                            <span data-feather="menu" class="align-text-bottom"></span> Options
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Move to</a></li>
                            <li><a class="dropdown-item" href="#">Download</a></li>
                            <li><a class="dropdown-item" href="#">Add to Starred</a></li>
                            <li><a class="dropdown-item" href="#">Trash</a></li>
                        </ul>
                    </div>



                    <button type="button"
                        class="d-none d-lg-inline-block option bulk-option move btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark"
                        v-bind:class="bulk_options_class">
                        <span data-feather="move" class="align-text-bottom"></span> Move
                    </button>


                    <button type="button"
                        class="d-none d-lg-inline-block option bulk-option download btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark"
                        v-bind:class="bulk_options_class">
                        <span data-feather="download" class="align-text-bottom"></span> Download
                    </button>

                    <button type="button"
                        class="d-none d-lg-inline-block option bulk-option star btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark"
                        v-bind:class="bulk_options_class">
                        <span data-feather="star" class="align-text-bottom"></span> Star
                    </button>

                    <button type="button"
                        class="d-none d-lg-inline-block option bulk-option trash btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark"
                        v-bind:class="bulk_options_class">
                        <span data-feather="trash-2" class="align-text-bottom"></span> Trash
                    </button>

                </div>

                <div>




                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked
                            value="true" v-model="show_list">
                        <label class="btn btn-outline-secondary" for="btnradio1"><i data-feather="list"></i></label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"
                            value="false" v-model="show_list">
                        <label class="btn btn-outline-secondary" for="btnradio2"><i data-feather="grid"></i></label>

                        <button v-on:click="showInfoPane" class="btn btn-sm btn-outline-secondary"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive"
                        aria-controls="offcanvasResponsive">
                        <i data-feather="info"></i>
                    </button>
                    </div>




                </div>

            </div>





            <div class="main-content">
                <div class="mx-3">
                    <div class="drag-drop-container border border-3 mb-3 rounded d-none">
                        <img src="/assets/custom/images/add_files.svg" height="150" />
                        <div class="mt-3">
                            <h4>Drop files and folders here</h4>
                            Or use the "Upload" button
                        </div>

                    </div>
                    <div class="rounded list-view" v-if="show_list == 'true'">
                        <div class="card border-0" style="background-color:transparent">
                            <div class="card-body p-0">
                                <div class="table-container">
                                    <div class="loader"></div>
                                    <table class="table table-sm custom mb-0 py-3">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle" scope="col" width="30"
                                                    style="max-width: 30px">

                                                    <div>
                                                        <input class="form-check-input check-all" type="checkbox"
                                                            v-model="all_selected">
                                                    </div>


                                                <th class="sortable ps-3" scope="col" data-name="name">Name</th>
                                                <th class="sortable d-none d-md-table-cell" scope="col" data-name="size"
                                                    width="100" style="min-width: 100px">Size</th>
                                                <th class="sortable d-none d-md-table-cell" scope="col"
                                                    data-name="updated_at">Last Modified</th>
                                                <th class="d-lg-none" scope="col" width="30"></th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(file, index) of file_folder_map" :key="file.id"
                                                v-bind:data-id="file.id">
                                                <td class="text-center align-middle">
                                                    <div>
                                                        <input class="form-check-input" type="checkbox"
                                                            v-model="selected" :value="file.id">
                                                    </div>
                                                </td>
                                                <td class="d-flex ps-3">
                                                    <div v-bind:data-file-id="file.id" v-on:click="populateInfoPane"
                                                        class="d-flex align-items-center flex-grow-1">
                                                        <img v-if="file.file_type == 'photo'"
                                                            v-bind:src="file.thumb_url" width="30" height="30"
                                                            class="me-3" v-bind:data-file-id="file.id" />
                                                        <i v-else
                                                            v-bind:class="[ file.icon, 'fa-solid', 'pe-3', 'fa-2x' ]"
                                                            v-bind:data-file-id="file.id"></i>

                                                        <div class="file-name text-truncate"
                                                            v-bind:data-file-id="file.id">
                                                            {{ file.name }}
                                                        </div>
                                                    </div>
                                                    <div class="px-3 d-none d-md-block">
                                                        <i class="fa-regular fa-star"></i>
                                                    </div>
                                                </td>
                                                <td class="d-none d-md-table-cell" v-if="file.type == 'FOLDER'"
                                                    v-bind:data-file-id="file.id" v-on:click="populateInfoPane">11 items
                                                </td>
                                                <td class="d-none d-md-table-cell" v-else v-bind:data-file-id="file.id"
                                                    v-on:click="populateInfoPane">{{ formatBytes(file.size) }}
                                                </td>
                                                <td class="d-none d-md-table-cell" v-bind:data-file-id="file.id"
                                                    v-on:click="populateInfoPane">{{ file.updated_at }}</td>
                                                <td class="d-lg-none" scope="col">

                                                    <div class="dropdown">
                                                        <button class="btn btn-xs btn-light dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
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
                            <div v-for="(file,index) of file_folder_map" :key="file.id" v-bind:data-id="file.id"
                                class="col-6 col-sm-4 col-md-3">
                                <div class="card" v-bind:data-file-id="file.id">
                                    <div class="img-container">
                                        <input class="form-check-input" type="checkbox" v-model="selected"
                                            :value="file.id">
                                        <img v-if="file.file_type == 'photo'" v-bind:src="file.thumb_url"
                                            style="width: 100%;" class="card-img-top border-0"
                                            v-bind:data-file-id="file.id" v-on:click="populateInfoPane">
                                        <i v-else class="fa-solid fa-file-pdf fa-8x"></i>
                                    </div>
                                    <div class="card-body" v-bind:data-file-id="file.id" v-on:click="populateInfoPane">
                                        <div class="card-text d-flex justify-content-between">
                                            <div class=" text-truncate" style="max-width: 90%;">
                                                {{file.name}}
                                            </div>
                                            <div class="dropdown d-lg-none">
                                                <button class="btn btn-xs btn-light dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
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

        <div id="info-pane" class="d-none col-lg-3" v-bind:class="[info_pane_active_class]">

            <div class="card border-0 border-bottom rounded-0">
                <div class="card-header p-3">
                    <div class="info-pane-header d-flex justify-content-between align-items-center">
                        <div class="fw-bolder">{{current_info_item_object.name | truncate(25)}}</div>
                        <button v-on:click="hideInfoPane" type="button" class="btn-close" aria-label="Close"></button>
                    </div>

                    <div class="info-pane-header-options mt-3 d-flex">
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-primary me-1" title="Get link"><i
                                    data-feather="link"></i></button>
                            <button class="btn btn-sm btn-outline-primary me-2" title="Share"><i
                                    data-feather="share"></i></button>

                            <span
                                class="avatar border rounded-circle fw-bold d-flex align-items-center justify-content-center me-1 bg-lighter"
                                title="Jack Rabii has edit access">J</span>
                            <span
                                class="avatar border rounded-circle fw-bold d-flex align-items-center justify-content-center me-1 bg-lighter">R</span>
                            <span
                                class="avatar border rounded-circle fw-bold d-flex align-items-center justify-content-center me-1 bg-lighter">+8</span>
                        </div>


                    </div>
                </div>
                <div class="card-body">

                    <div class="text-center">
                        <!---->

                        <span v-if="current_info_item_object.file_type == 'photo'">
                            <img v-bind:src="current_info_item_object.thumb_url" class="w-50" /></span>
                        <span v-else-if="current_info_item_object.file_type == 'video'">12 items</span>

                        <i v-else class="fa fa-solid fa-10x" v-bind:class="[ current_info_item_object.icon ]"></i>
                    </div>




                </div>
            </div>




            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button p-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                            <i data-feather="info" class="me-2"></i> Info
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse show"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body p-3 py-4">
                            <div class="mb-3">
                                <span class="w-one-third d-inline-block text-secondary">Saved in</span>
                                <span
                                    class="w-two-third d-inline-block text-primary pointer">{{current_info_item_object.parent_name}}</span>
                            </div>
                            <div class="mb-3">
                                <span class="w-one-third d-inline-block text-secondary">Size</span>
                                <span
                                    class="w-two-third d-inline-block text-dark">{{ formatBytes(current_info_item_object.size) }}</span>
                            </div class="mb-3">
                            <div class="mb-3">
                                <span class="w-one-third d-inline-block text-secondary">Created</span>
                                <span
                                    class="w-two-third d-inline-block text-dark">{{ current_info_item_object.created_at }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="w-one-third d-inline-block text-secondary">Modified</span>
                                <span
                                    class="w-two-third d-inline-block text-dark">{{ current_info_item_object.updated_at }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="w-one-third d-inline-block text-secondary">Owner</span>
                                <span
                                    class="w-two-third d-inline-block text-primary pointer">{{current_info_item_object.owner}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <i data-feather="tag" class="me-2"></i> Tags
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body p-3 py-4">
                            <label for="inputPassword5" class="form-label">Tags</label>
                            <input type="text" class="form-control form-control-sm" aria-labelledby="passwordHelpBlock">
                            <div class="tags mt-3">
                                <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#zip <i
                                        class="fa-solid fa-circle-xmark ms-2"></i></span>
                                <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#music <i
                                        class="fa-solid fa-circle-xmark ms-2"></i></span>
                                <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#work <i
                                        class="fa-solid fa-circle-xmark ms-2"></i></span>
                                <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#collab <i
                                        class="fa-solid fa-circle-xmark ms-2"></i></span>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            <i data-feather="message-circle" class="me-2"></i> Comments
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body p-3 py-4">Placeholder content for this accordion, which is intended
                            to
                            demonstrate the
                            <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more
                            exciting
                            happening here in terms of content, but just filling up the space to make it look, at least
                            at
                            first
                            glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="offcanvas-lg offcanvas-end" data-bs-backdrop="false" data-bs-scroll="true" tabindex="-1"
    id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Responsive offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p class="mb-0">This is content within an <code>.offcanvas-lg</code>.</p>
    </div>
</div>


<div class="offcanvas-lg offcanvas-start" data-bs-backdrop="false" data-bs-scroll="true" tabindex="-1"
    id="offcanvasResponsive2" aria-labelledby="offcanvasResponsive2Label">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasResponsive2Label">Responsive offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive2"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p class="mb-0">This is content within an <code>.offcanvas-lg</code>.</p>
    </div>
</div>