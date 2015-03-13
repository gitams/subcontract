<option value="">Select State</option>
<?php

if (count($states) > 0) {
    foreach ($states as $state) {?>
        <option value="<?php echo $state->stateid;?>"><?php echo $state->statename;?></option>
    <?php }
} else {
    echo '<option value="0"> No State present</option>';
}

