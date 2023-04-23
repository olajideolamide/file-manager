<form action="api/clients/add-client" method="post">
  <input value="<?php echo $security['csrf_hash']; ?>" name="<?php echo $security['csrf_name']; ?>" type="hidden" />
  <div class="row">
    <div class="col-3 mb-3"><label class="form-control-label">Company Name: <span class="tx-danger">*</span></label></div>
    <div class="col-9 mb-3"><input name="name" id="name" class="form-control" placeholder="Company Name" type="text"></div>



    <div class="col-3 mb-3"><label class="form-control-label">Address: </label></div>
    <div class="col-9 mb-3">
      <textarea name="address" rows="3" class="form-control" placeholder="Address"></textarea>
    </div>

    <div class="col-3 mb-3"><label class="form-control-label">City: </label></div>
    <div class="col-9 mb-3"><input name="city" id="city" class="form-control" placeholder="City" type="text"></div>


    <div class="col-3 mb-3"><label class="form-control-label">State: </label></div>
    <div class="col-9 mb-3"><input name="state" id="state" class="form-control" placeholder="State" type="text"></div>


    <div class="col-3 mb-3"><label class="form-control-label">Zip: </label></div>
    <div class="col-9 mb-3"><input name="zip" id="zip" class="form-control" placeholder="Zip" type="text"></div>

    <div class="col-3 mb-3"><label class="form-control-label">Country: </label></div>
    <div class="col-9 mb-3">
      <select name="country" class="form-control single-select">
        <option label="Choose one" value="">Choose one</option>

        <?php foreach ($country_list as $code => $country) : ?>
          <option label="<?php echo $code; ?>" value="<?php echo $code; ?>"><?php echo $country; ?></option>
        <?php endforeach; ?>

      </select>
    </div>

    <div class="col-3 mb-3"><label class="form-control-label">Currency:</label></div>
    <div class="col-9 mb-3">
      <select name="currency" class="form-control single-select">
        <option label="Choose one" value="">Choose one</option>

        <?php foreach ($currency_list as $currency) : ?>
          <option label="<?php echo $currency["code"]; ?>" value="<?php echo $currency["code"]; ?>"><?php echo $currency["name"]; ?> (<?php echo $currency["symbol"]; ?>)</option>
        <?php endforeach; ?>

      </select>
    </div>

    <div class="col-3 mb-3"><label class="form-control-label">Phone: </label></div>
    <div class="col-9 mb-3"><input name="phone" id="phone" class="form-control" placeholder="Phone" type="text"></div>


    <div class="col-3 mb-3"><label class="form-control-label">Website: </label></div>
    <div class="col-9 mb-3"><input name="website" id="website" class="form-control" placeholder="Website" type="text"></div>

    <div class="col-3 mb-3"><label class="form-control-label">Vat Number: </label></div>
    <div class="col-9 mb-3"><input name="vat" id="vat" class="form-control" placeholder="Vat" type="text"></div>

    <div class="col-3 mb-3"><label class="form-control-label">Groups: </label></div>
    <div class="col-9 mb-3">
      <select name="groups[]" class="form-control multi-select" multiple>
        <option label="High Value" value="1">High Value</option>
        <option label="High Budget" value="2">High Budget</option>
        <option label="Low Budget" value="3">Low Budget</option>
        <option label="Vip" value="4">Vip</option>
      </select>
    </div>


  </div>
</form>