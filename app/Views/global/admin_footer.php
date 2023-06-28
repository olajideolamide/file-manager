</div> <!-- row -->

<div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-3">
    <div id="info-toast" class="toast info align-items-center" v-bind:class="toast_class" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            {{toast_message}}
        </div>
    </div>
</div>


</div> <!-- app -->

<div class="modal fade" id="small-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-3 px-3 border-0">
                <div class="modal-title fw-bold" id="staticBackdropLabel"></div>

                <button type="button" class="btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 content">

                </div>

                <div class="d-flex justify-content-end  py-2">
                    <button type="button" class="btn btn-sm btn-primary submit-btn">Create</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="large-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-3 px-3 border-0">
                <div class="modal-title fw-bold" id="staticBackdropLabel"></div>

                <button type="button" class="btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 content">

                </div>

                <div class="d-flex justify-content-end py-2">
                    <button type="button" class="btn btn-sm btn-primary submit-btn">Create</button>
                </div>
            </div>

        </div>
    </div>
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











<input id="file-input" class="d-none" type="file" name="name[]" multiple />
<input id="folder-input" class="d-none" type="file" webkitdirectory mozdirectory />





<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Show a second modal and hide this one with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
            </div>
        </div>
    </div>
</div>







<script src="/assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
</script>

<script>
    <?php if (!empty($content["table_src_url"])) : ?>
        let table_src_url = "<?php echo $content["table_src_url"]; ?>";
    <?php endif; ?>

    <?php if (!empty($content["folder_id"])) : ?>
        let folder_id = "<?php echo $content["folder_id"]; ?>";
    <?php endif; ?>

    let csrf_token_name = "<?php echo csrf_token(); ?>";
    let csrf_hash = "<?php echo csrf_hash(); ?>";
</script>

<script src="/assets/custom/js/dashboard.js"></script>
<script src="/assets/custom/js/modals.js"></script>
<script src="/assets/custom/js/global.js"></script>
<script src="/assets/custom/js/table.js"></script>
<script src="/assets/custom/js/queue.js"></script>
</body>


</html>