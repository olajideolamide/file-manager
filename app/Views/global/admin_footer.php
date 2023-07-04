</div> <!-- row -->
</div> <!-- app -->


<div id="system">
    <div class="info-toast-conatiner toast-container position-fixed bottom-0 start-50 translate-middle-x p-3 rounded">
        <div id="info-toast" class="toast info align-items-center rounded bg-transparent" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
            <div class="toast-body rounded" v-bind:class="toast_class" v-html="toast_message">
            </div>
        </div>
    </div>

    <div class="file-upload-toast toast-container position-fixed bottom-0 end-0 p-3">
        <div id="queue-toast" class="toast fase text-bg-light" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto queue-stats"></strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body p-0 ps-3 pt-2 bg-white">
                <div class="list-group download-queue">
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade" v-bind:class="[modal_size_class]" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="content">

            </div>

            <div v-if="!modal_has_content" class="modal-content ">
                <div class="d-flex justify-content-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>



        </div>
    </div>



    <div id="child-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="child-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="content">

            </div>
            <div v-if="!child_modal_has_content" class="modal-content ">
                <div class="d-flex justify-content-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





<script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>



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

<script src="/assets/custom/js/system.js"></script>
<script src="/assets/custom/js/modals.js"></script>
<script src="/assets/custom/js/files_app.js"></script>
<script src="/assets/custom/js/table.js"></script>
<script src="/assets/custom/js/queue.js"></script>
</body>


</html>