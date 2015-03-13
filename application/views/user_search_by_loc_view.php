<h3 style="text-align: center; margin-top: 3px;"><label>Search By Location</label></h3><hr/>
<script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>

<div class="user">
    <div class="col-md-12">
        <div class="col-sm-4 control-label">
            <label for="contact-name" >Country:<span style="color: #FF0000"> *</span></label>
                <select name="su_cur_country" id="su_cur_country" class="form-control">
                    <option value="">Select Country</option>
                    <?php
                    foreach ($countries as $country) {
                        echo '<option value="' . $country->countryid . '">' . $country->countryname . '</option>';
                    }
                    ?>
                </select>
        </div>
        <div class="col-sm-4 control-label">
            <label for="contact-name">State:<span style="color: #FF0000"> *</span></label>
                <select name="su_cur_state" id="su_cur_state" class="form-control">
                    <option value="">Select a State</option>
                </select>
        </div>
        <div class="col-sm-4 control-label">
            <label for="skills">Current City:<span style="color: #FF0000"> *</span></label>
                <select name="su_cur_city" id="su_cur_city" class="form-control">
                    <option value="">Select a City</option>
                </select>
        </div>

    </div>
    <div class="col-md-12">
        <div class="control-label" style="float: right">
            <br/>
            <i class="fa fa-search fa-2x btn btn-primary" id="search"> &nbsp;Search</i>
        </div>
    </div>
</div>
<div id="wait" style="display: none" align="center"><img src='<?php echo base_url('assets/images/loading.gif');?>' /></div>
<div class="form-group" id="searchResultDiv">
    <?php include('layout/self_user_search_by_loc_div.php');?>
</div>
<script>
    $(document).ready(function () {
        $(document).on('change', '#su_cur_country', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#su_cur_state';
            $.ajax({
                url: '<?php echo base_url('user_dashboard/getStates');?>',
                type: 'POST',
                data: {'countryId': this.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                beforeSend: function () {
                    $(dest).text('<option value="0">Please wait .. </option>');
                },
                error: function () {
                    $(dest).text('<option value="0">Error....</option>');
                },
                success: function (data) {
                    $(dest).text('').append(data);
                }
            });
        });
        $(document).on('change', '#su_cur_state', function () {
            if (this.value == 0 || this.value == "") {
                alert('Please select proper state');
                return false;
            }
            var dest = '#su_cur_city';
            $.ajax({
                url: '<?php echo base_url('user_dashboard/getCities');?>',
                type: 'POST',
                data: {'stateId': this.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                beforeSend: function () {
                    $(dest).text('<option value="0">Please wait .. </option>');
                },
                error: function () {
                    $(dest).text('<option value="0">Error....</option>');
                },
                success: function (data) {
                    $(dest).text('').append(data);
                }
            });
        });
        $(document).on('click', '#search', function () {
            $("#wait").css("display","block");
            var country = document.getElementById('su_cur_country');
            var state = document.getElementById('su_cur_state');
            var city = document.getElementById('su_cur_city');
            if (country.value == 0 || country.value == "") {
                alert('Please select proper country');
                return false;
            }
            if (state.value == 0 || state.value == "") {
                alert('Please select proper state');
                return false;
            }
            if (city.value == 0 || city.value == "") {
                alert('Please select proper city');
                return false;
            }
            $.ajax({
                url: '<?php echo base_url('user_dashboard/searchResultByLoc');?>',
                type: 'POST',
                data: {'countryId': country.value, 'stateId': state.value, 'cityId': city.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                error: function () {

                },
                success: function (data) {
                    $('#wait').fadeOut(1000);
                    $('#searchResultDiv').html('').append(data);
                }
            });
        });
    });

</script>
