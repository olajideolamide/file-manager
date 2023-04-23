<ul class="list-group options-list table-filter-options">
  <?php foreach ($country_list as $key => $country) : ?>
    <li class="list-group-item pointer hover table-filter-option <?php if ($key == $selection) : ?> active<?php endif; ?>" data-option-name="<?php echo $name; ?>" data-option-value="<?php echo $key; ?>"><i class="typcn typcn-media-play"></i> <?php echo $country; ?></li>
  <?php endforeach; ?>
</ul>