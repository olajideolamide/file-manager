<info-pane inline-template>

    <div v-if="$parent.current_info_item_object.name">
        <div class="card border-0 border-bottom rounded-0">
            <div class="card-header p-3">
                <div class="info-pane-header d-flex justify-content-between align-items-center">
                    <div class="fw-bolder">{{$parent.current_info_item_object.name | truncate(25)}}</div>
                    <button v-on:click="$parent.hideInfoPane" type="button" class="btn-close d-none d-lg-inline-flex" aria-label="Close"></button>
                    <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                </div>

                <div class="info-pane-header-options mt-3 d-flex">
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-primary me-1" title="Get link"><i data-feather="link"></i></button>
                        <button class="btn btn-sm btn-outline-primary me-2" title="Share"><i data-feather="share"></i></button>

                        <span class="avatar border rounded-circle fw-bold d-flex align-items-center justify-content-center me-1 bg-lighter" title="Jack Rabii has edit access">J</span>
                        <span class="avatar border rounded-circle fw-bold d-flex align-items-center justify-content-center me-1 bg-lighter">R</span>
                        <span class="avatar border rounded-circle fw-bold d-flex align-items-center justify-content-center me-1 bg-lighter">+8</span>
                    </div>


                </div>
            </div>
            <div class="card-body">

                <div class="text-center">
                    <!---->

                    <span v-if="$parent.current_info_item_object.file_type == 'photo'"><img v-bind:src="$parent.current_info_item_object.thumb_url" class="w-50" /></span>
                    <span v-else-if="$parent.current_info_item_object.file_type == 'video'">12 items</span>

                    <large-folder v-else-if="$parent.current_info_item_object.type == 'FOLDER'" v-bind:id="$parent.current_info_item_object.id"></large-folder>
                    <large-icon v-else v-bind:text="$parent.current_info_item_object.extension" v-bind:id="$parent.current_info_item_object.id"></large-icon>

                    <i v-else class="fa fa-solid fa-10x" v-bind:class="[ $parent.current_info_item_object.icon ]"></i>
                </div>




            </div>
        </div>




        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button p-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                        <i data-feather="info" class="me-2"></i> Info
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body p-3 py-4">
                        <div class="mb-3">
                            <span class="w-one-third d-inline-block text-secondary">Saved in</span>
                            <span class="w-two-third d-inline-block text-primary pointer">{{$parent.current_info_item_object.parent_name}}</span>
                        </div>
                        <div class="mb-3" v-if="$parent.current_info_item_object.type == 'FILE'">
                            <span class="w-one-third d-inline-block text-secondary">Size</span>
                            <span class="w-two-third d-inline-block text-dark">{{ $parent.formatBytes($parent.current_info_item_object.size) }}</span>
                        </div class="mb-3">
                        <div class="mb-3">
                            <span class="w-one-third d-inline-block text-secondary">Created</span>
                            <span class="w-two-third d-inline-block text-dark">{{ $parent.current_info_item_object.created_at }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="w-one-third d-inline-block text-secondary">Modified</span>
                            <span class="w-two-third d-inline-block text-dark">{{ $parent.current_info_item_object.updated_at }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="w-one-third d-inline-block text-secondary">Owner</span>
                            <span class="w-two-third d-inline-block text-primary pointer">{{$parent.current_info_item_object.owner}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <i data-feather="tag" class="me-2"></i> Tags
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body p-3 py-4">
                        <label for="inputPassword5" class="form-label">Tags</label>
                        <input type="text" class="form-control form-control-sm" aria-labelledby="passwordHelpBlock">
                        <div class="tags mt-3">
                            <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#zip <i class="fa-solid fa-circle-xmark ms-2"></i></span>
                            <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#music <i class="fa-solid fa-circle-xmark ms-2"></i></span>
                            <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#work <i class="fa-solid fa-circle-xmark ms-2"></i></span>
                            <span class="badge fw-light bg-lighter text-black-50 fs-7 mb-1">#collab <i class="fa-solid fa-circle-xmark ms-2"></i></span>

                        </div>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <i data-feather="message-circle" class="me-2"></i> Comments
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body p-3 py-4">Placeholder content for this accordion, which is intended
                        to
                        demonstrate the
                        <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more
                        exciting
                        happening here in terms of content, but just filling up the space to make it look, at least
                        at
                        first
                        glance, a bit more representative of how this would look in a real-world application.
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div v-else class="text-center">
        <div class="card border-0 rounded-0  p-0">
            <div class="card-header">
                <div class="d-flex flex-row-reverse">
                    <button v-on:click="$parent.hideInfoPane" type="button" class="btn-close d-none d-lg-inline-flex" aria-label="Close"></button>
                    <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                </div>
            </div>
            <div class="card-body p-3 mt-5">
                <img src="/assets/custom/images/info_pane_empty.svg" height="150" class="mb-4" />
                <h6>Select a file or folder to see details here</h6>
            </div>

        </div>
    </div>


</info-pane>