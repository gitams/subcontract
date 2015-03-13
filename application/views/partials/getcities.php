<option value="">Select City</option>
<?php
if (count($cities) > 0) {
    foreach ($cities as $city) { ?>
        <?php echo '<option value="' . $city->cityid . '">' . $city->cityname . '</option>';
    }
} else {
    echo '<option value="0"> No City present</option>';
}
?>