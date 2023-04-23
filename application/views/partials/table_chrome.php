<div class="row">
    <div class="col-8">
        <div class="options mg-b-10">
            <?php if (in_array("export", $table_chrome["actions"])) : ?>
                <button class="btn btn-primary top-option-btn rounded adaptive export"><i class="typcn typcn-download-outline"></i> Export</button>
            <?php endif; ?>
            <?php if (in_array("edit", $table_chrome["actions"])) : ?>
                <button class="btn btn-primary top-option-btn rounded adaptive edit" disabled><i class="typcn typcn-edit"></i> Edit</button>
            <?php endif; ?>
            <?php if (in_array("clone", $table_chrome["actions"])) : ?>
                <button class="btn btn-primary top-option-btn rounded adaptive clone" disabled><i class="typcn typcn-book"></i> Clone</button>
            <?php endif; ?>
            <?php if (in_array("remove", $table_chrome["actions"])) : ?>
                <button class="btn btn-danger top-option-btn rounded adaptive remove" disabled><i class="typcn typcn-trash"></i> Remove</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-4">
        <div class="options mg-b-10 text-end">
            <?php if (array_key_exists("import", $table_chrome["manage"])) : ?>
                <a href="<?php echo $table_chrome["manage"]["import"]["url"]; ?>" class="btn btn-success top-option-btn rounded create"><i class="typcn typcn-upload"></i> Import Clients</a>
            <?php endif; ?>
            <?php if (array_key_exists("add", $table_chrome["manage"])) : ?>
                <a id="add-client" class="btn btn-success top-option-btn rounded create modal-launcher" data-bs-toggle="modal" data-bs-target="#large-modal" data-modal-url="api/clients/add-client-form" data-modal-title="Add Client"><i class="typcn typcn-plus"></i> Add Client</a>
            <?php endif; ?>

        </div>
    </div>
</div>
<div class="custom-table filters mg-b-10">
    <div class="row row-xs">
        <div class="col-md-2">
            <input class="form-control search rounded" placeholder="Search" type="text">
        </div><!-- col -->

        <div class="col-md-2">
            <button data-bs-toggle="dropdown" class="btn btn-dark w-100 rounded"><i class="typcn typcn-filter"></i> Filters (8)</button>
            <div class="dropdown-menu table-filter-container">

                <?php foreach ($table_structure["columns"] as $key => $column) : if ($column["filterable"] !== true) continue; ?>
                    <span id="table-filter-<?php echo $column["class"]; ?>" class="<?php echo $column["class"]; ?> dropdown-item pointer table-filter" data-bs-toggle="modal" data-bs-target="#small-modal" data-modal-url="api/clients/filter-options/<?php echo $column["class"]; ?>" data-modal-title="Add Client" data-filter-name="<?php echo $key ?>" data-preprocessor="toggleListPreprocessor"><?php echo $column["label"]; ?></span>
                <?php endforeach; ?>

            </div><!-- dropdown-menu -->
        </div>

        <div class="col-md-2">
            <button data-bs-toggle="dropdown" class="btn btn-dark w-100 rounded"><i class="typcn typcn-eye"></i> Show / Hide Columns</button>
            <div class="dropdown-menu show_hide_columns">
                <?php foreach ($table_structure["columns"] as $key => $column) : ?>
                    <label class="<?php echo $column["class"]; ?> dropdown-item">
                        <input type="checkbox" checked="checked" class="<?php echo $column["class"]; ?>" />
                        <?php echo $column["label"]; ?>
                    </label>
                <?php endforeach; ?>

            </div><!-- dropdown-menu -->
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark rounded w-100"><i class="typcn typcn-plus"></i> Save View</button>

        </div>

        <div class="col-md-2">
            <button class="btn btn-dark rounded w-100"><i class="typcn typcn-plus"></i> Manage Views</button>

        </div>

        <div class="col-md-2">
            <select class="form-control select2">
                <option label="Choose one">Select View</option>
                <option label="Choose one">Excluded trashed Contracts</option>
                <option label="Choose one">Expired</option>
                <option label="Choose one">Not Expired</option>
                <option label="Choose one">Contracts Without Date End</option>
                <option label="Choose one">Contracts Under Seal</option>
            </select>
        </div>





    </div>
</div>