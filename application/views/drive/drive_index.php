<div class="px-3">
    <div class="navbar  flex-md-nowrap p-0  col-md-12 ms-sm-auto col-lg-12 mt-3">

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="search form-control form-control-sm w-100 rounded border-0 bg-light" type="text" placeholder="> Search files and folders" aria-label="Search">

    </div>



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2">
        <div>




            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb me-2 mb-0">

                </ol>
            </nav>


        </div>
        <div class="btn-toolbar mb-2 mb-md-0">

            <div class="dropdown">
                <button class="btn btn-primary  btn-sm dropdown-toggle fw-bold no-icon rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:150px">
                    <i class="fa-solid fa-upload"></i> Upload
                </button>
                <ul class="dropdown-menu">
                    <li><a id="upload-files" class="dropdown-item" href="#"><span data-feather="file" class="align-text-bottom"></span> Upload files</a></li>
                    <li><a id="upload-folder" class="dropdown-item" href="#"><span data-feather="folder" class="align-text-bottom"></span> Upload Folder</a></li>
                    <li><a class="dropdown-item create-folder-btn" href="#"><span data-feather="folder-plus" class="align-text-bottom "></span> Create Folder</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="bg-light mb-3 py-1">

        <button type="button" class="option btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" disabled>
            <span data-feather="copy" class="align-text-bottom"></span> Copy
        </button>

        <button type="button" class="option btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" disabled>
            <span data-feather="move" class="align-text-bottom"></span> Move
        </button>


        <button type="button" class="option btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" disabled>
            <span data-feather="download" class="align-text-bottom"></span> Download
        </button>



        <button type="button" class="option btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" disabled>
            <span data-feather="share-2" class="align-text-bottom"></span> Share
        </button>

        <button type="button" class="option btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" disabled>
            <span data-feather="star" class="align-text-bottom"></span> Star
        </button>

        <button type="button" class="option btn btn-link btn-sm text-secondary text-decoration-none border-0 hover-dark" disabled>
            <span data-feather="trash-2" class="align-text-bottom"></span> Trash
        </button>
    </div>




    <div class="main-content">
        <div class="drag-drop-container border border-3 mb-3 rounded d-none">
            <img src="/assets/custom/images/add_files.svg" height="150" />
            <div class="mt-3">
                <h4>Drop files and folders here</h4>
                Or use the "Upload" button
            </div>

        </div>
        <div class="d-none border rounded list-view">
            <div class="card border-0" style="background-color:transparent">
                <div class="card-body p-0">
                    <div class="table-container">
                        <div class="loader"></div>
                        <table class="table table-sm custom mb-0 py-3">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" width="30" style="max-width: 30px"><input class="check-all" type="checkbox" /></th>
                                    <th class="sortable" scope="col" data-name="name" width="400" style="min-width: 70%">Name</th>
                                    <th class="sortable" scope="col" data-name="size" width="100" style="min-width: 100px">Size</th>
                                    <th class="sortable" scope="col" data-name="updated_at">Last Modified</th>



                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row grid-view d-none g-3">
            <div class="col-2">
                <div class="card">
                    <div class="img-container"><img src="/delete/7.jpg" style="max-width: 161px" class="card-img-top border-0"></div>
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="img-container" class="card-img-top"><i class="fa-solid fa-file-pdf fa-8x"></i></div>

                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="/delete/5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Screenshot ... Installation.png</p>
                    </div>
                </div>
            </div>

        </div>



    </div>
    </main>

    <!--<div class="col-md-4 col-lg-3 d-md-block p-3" style="box-shadow: inset 1px 0 0 rgba(0, 0, 0, .1);">


        <div class="modal-body p-1">
            <h2 class="fw-bold mb-0">What's new</h2>

            <ul class="d-grid gap-4 my-5 list-unstyled">
                <li class="d-flex gap-4">
                    <svg class="bi text-muted flex-shrink-0" width="48" height="48">
                        <use xlink:href="#grid-fill"></use>
                    </svg>
                    <div>
                        <h5 class="mb-0">Grid view</h5>
                        Not into lists? Try the new grid view.
                    </div>
                </li>
                <li class="d-flex gap-4">
                    <svg class="bi text-warning flex-shrink-0" width="48" height="48">
                        <use xlink:href="#bookmark-star"></use>
                    </svg>
                    <div>
                        <h5 class="mb-0">Bookmarks</h5>
                        Save items you love for easy access later.
                    </div>
                </li>
                <li class="d-flex gap-4">
                    <svg class="bi text-primary flex-shrink-0" width="48" height="48">
                        <use xlink:href="#film"></use>
                    </svg>
                    <div>
                        <h5 class="mb-0">Video embeds</h5>
                        Share videos wherever you go.
                    </div>
                </li>
            </ul>
            <button type="button" class="btn btn-lg btn-primary mt-5 w-100" data-bs-dismiss="modal">Great,
                thanks!</button>
        </div>

    </div>-->

</div>



<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="queue-toast" class="toast fase" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">

            <strong class="me-auto">Uploaded 5 files</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body p-0 ps-3 pt-2">
            <div class="list-group download-queue">
            </div>
        </div>
    </div>
</div>



</div>

<input id="file-input" class="d-none" type="file" name="name[]" multiple />
<input id="folder-input" type="file" webkitdirectory mozdirectory />