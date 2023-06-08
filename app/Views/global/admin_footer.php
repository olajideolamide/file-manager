<div class="modal fade" id="small-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-2 px-3">
                <div class="modal-title" id="staticBackdropLabel"></div>
                <button type="button" class="btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 content">

                </div>

                <div class="d-flex justify-content-end ">
                    <button type="button" class="btn btn-sm btn-primary submit-btn">Create</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="large-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-2 px-3">
                <div class="modal-title" id="staticBackdropLabel"></div>
                <button type="button" class="btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 content">

                </div>

                <div class="d-flex justify-content-end ">
                    <button type="button" class="btn btn-sm btn-primary submit-btn">Create</button>
                </div>
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