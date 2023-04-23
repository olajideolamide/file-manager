<div class="az-content-header edit-header bd-b">
    <div class="az-content-header-top">
        <div>
            <h2 class="az-content-title mg-b-5 mg-b-lg-8">
                EDIT: RevContent | IT | Mystery Shopper | desktop | white list
            </h2>

        </div>

        <div class="options">
            <button class="btn btn-success top-option-btn rounded adaptive save"><i class="typcn typcn-folder-add"></i> Save</button>
            <button class="btn btn-primary top-option-btn rounded adaptive save-close"><i class="typcn typcn-folder-add"></i> Save &amp; Close</button>
            <button class="btn btn-primary top-option-btn rounded adaptive clone"><i class="typcn typcn-book"></i> Clone</button>
            <button class="btn btn-primary top-option-btn rounded adaptive statistics"><i class="typcn typcn-chart-bar"></i> Statistics</button>
        </div><!-- az-dashboard-date -->
    </div><!-- az-content-body-title -->

</div>


<div class="az-content-body pt-0 pd-b-0-f">
    <form class="campaign-edit-form" data-parsley-validate data-parsley-errors-messages-disabled>
        <div class="row row-sm gx-2 bg-white pd-10 page-form">

            <div class="col-md-6 pd-t-10">
                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Name: <i class="tx-danger">*</i></div>
                    <div class="input-group">
                        <input type="text" class="form-control d-inline-block" required>
                        <span class="input-group-btn">

                        </span>
                    </div>
                </div>


                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Group: <i class="tx-danger">*</i></div>
                    <div id="slWrapper" class="input-group parsley-select">

                        <select class="status form-control select2" data-parsley-class-handler="#slWrapper" required>

                            <option value="">&nbsp;</option>
                            <?php foreach ($grps as $grp) : ?>
                                <option value="<?php echo $grp["id"]; ?>"><?php echo $grp["name"]; ?></option>
                            <?php endforeach; ?>


                        </select>


                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button"><i class="typcn typcn-plus"></i></button>
                        </span>
                    </div>

                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Traffic Source: <i class="tx-danger">*</i></div>
                    <div id="slWrapper2" class="input-group parsley-select">

                        <select class="status form-control select2" data-parsley-class-handler="#slWrapper2" required>
                            <option value="">&nbsp;</option>
                            <?php foreach ($srcs as $src) : ?>
                                <option value="<?php echo $src["id"]; ?>"><?php echo $src["name"]; ?></option>
                            <?php endforeach; ?>

                        </select>


                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button"><i class="typcn typcn-plus"></i></button>
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Type: <i class="tx-danger">*</i></div>
                    <div class="input-group">
                        <select class="status form-control select2-no-search">

                            <option value="0"></option>
                            <option value="1">CPC</option>
                            <option value="2">CPM</option>
                            <option value="3">CPA</option>


                        </select>
                    </div>
                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Cost / Currency / Auto: <i class="tx-danger">*</i></div>
                    <div class="input-group align-items-center">
                        <input type="text" class="wd-3 form-control d-inline-block mg-r-10" value="0.00">
                        <div class="mg-r-10 wd-200">
                            <select class="status form-control select2 ">

                                <option value="">&nbsp;</option>
                                <option value="1">USD - US Dollar</option>
                                <option value="0">EUR - Euros</option>
                                <option value="3">GBP - Great Britain Pounds</option>
                                <option value="2">RUB - Russian Rubble</option>
                                <option value="2">CNY - Chinese Yen</option>
                                <option value="2">PLN</option>
                                <option value="2">JPY - Japanase Yen</option>
                                <option value="2">UAH</option>
                                <option value="2">CAD - Canadian Dollar</option>
                                <option value="2">BTC -  Bitcoin</option>
                                <option value="2">INR - Indian Rupee</option>

                            </select>
                        </div>
                        <div class="wd-100">
                            <input type="checkbox"><span> Auto</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Hide referrer: <i class="tx-danger">*</i></div>
                    <div class="input-group">
                        <select class="status form-control select2-no-search">

                            <option value="0">None</option>
                            <option value="1">Meta refresh</option>
                            <option value="2">Double meta refresh</option>
                            <option value="3">Smart meta refresh</option>


                        </select>
                    </div>
                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Hide referrer domain: <i class="tx-danger">*</i></div>
                    <div class="input-group">
                        <select class="status form-control select2-no-search">

                            <option value="0"></option>
                            <option value="1">CPC</option>
                            <option value="2">CPM</option>
                            <option value="3">CPA</option>


                        </select>
                    </div>
                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Domain: <i class="tx-danger">*</i></div>
                    <div class="input-group">
                        <select class="status form-control select2">

                            <option value="0"></option>
                            <option value="1">CPC</option>
                            <option value="2">CPM</option>
                            <option value="3">CPA</option>


                        </select>
                    </div>
                </div>

                <div class="d-flex align-items-center mg-b-10">
                    <div class="w-50 d-inline-block">Distribution method: <i class="tx-danger">*</i></div>
                    <div class="input-group">
                        <select class="status form-control select2-no-search">

                            <option value="0">Normal rotation (random)</option>
                            <option value="1">Smart rotation Paths</option>
                            <option value="2">Smart rotation Paths & LPs</option>
                            <option value="3">Smart rotation Paths & LPs & Offers</option>
                            <option value="4">Fix on Paths</option>
                            <option value="5">Fix on Paths & LPs</option>
                            <option value="6">Fix on Paths & LPs & Offers</option>


                        </select>
                    </div>
                </div>

            </div>

            <div class="col-md-6 rotation-landers bd-l">

            </div>







        </div>

    </form>

</div><!-- az-content-body -->