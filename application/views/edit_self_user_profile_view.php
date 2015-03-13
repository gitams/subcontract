<style>
    input[type='file'] {
        direction: rtl;        /* Sets the Control to Right-To-Left */
    }
    label{
        margin-top: 10px;
    }
</style>
<?php //print'<pre>'; print_r($details);?>
<h3 style="text-align: center; margin-top: 3px;"><label>Update Your Profile</label></h3><hr/>
<div class="afterLogin">
    <div class="errors">
        <?php echo validation_errors(); ?>
    </div>
    <div class="">
        <div class="col-sm-12">
            <form action="<?php echo base_url('user_dashboard/saveUpdateProfile') ?>" name="addCandidate" id="addCandidate" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <div class="col-md-6">
                    <label for="posttitle" class="pull-left">First Name<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_first_name" class="form-control" id="su_first_name" value="<?php echo $details[0]->scd_first_name?>" placeholder="enter first name" required="required">
                </div>
                <div class="col-md-6">
                    <label for="posttitle" class="pull-left">Last Name<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_last_name" class="form-control" id="su_last_name" value="<?php echo $details[0]->scd_last_name?>" placeholder="enter last name" required="required">
                </div>
                <div class="col-md-6">
                    <label for="posttitle" class="pull-left">Mobile<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_mobile" class="form-control" id="su_mobile" placeholder="10 Digits Only" value="<?php echo $details[0]->scd_mobile?>"  maxlength="10" pattern="\d{10}" required="required" title="only 10 digits">
                </div>
                <div class="col-md-6">
                    <label for="postDescription" class="pull-left">Email<span style="color: #FF0000"> *</span></label>
                    <input type="email" class="form-control" rows="4" id="su_email" name="su_email" placeholder="Eg: email@company.com" value="<?php echo $details[0]->scd_email?>" required="required"/>
                </div>
                <div class="col-md-6">
                    <label for="numberOfPositions" class="pull-left">Current CTC<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_ctc" class="form-control" id="su_ctc" value="<?php echo $details[0]->scd_cur_ctc?>" placeholder="Eg: 320000 (no spaces or spl chars)" required="required" maxlength="10" pattern="\d*" title="only numbers & no characters or special">
                </div>
                <div class="col-md-6">
                    <label for="skills" class="">Major Skill<span style="color: #FF0000"> *</span></label>
                    <select name="su_skill" id="su_skill" class="form-control"  required="required">
                        <option value="">Select a Skill</option>
                        <?php foreach ($skills as $skill) { ?>
                            <option value="<?php echo $skill->skillid;?>" <?php if($details[0]->scd_majar_skill==$skill->skillid){ echo "selected='selected'";}?>><?php echo $skill->skillname;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6" >
                    <label for="experience_from" class="pull-left">Experience Years<span style="color: #FF0000"> *</span></label>
                    <select name="su_exp_year"  id="su_exp_year" required="required" class="form-control">
                        <option value="">Year</option>
                        <?php for ($i = 0; $i <= 15; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($details[0]->scd_tot_exp_yr==$i){ echo "selected='selected'";}?>><?php echo $i;?> Years</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="experience_from" class="pull-left">And <span style="color: #FF0000"> *</span></label>
                    <select name="su_exp_mnth" class="form-control" id="su_exp_mnth" required="required">
                        <option value="">Month</option>
                        <?php for ($i = 1; $i <= 11; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($details[0]->scd_exp_mnth==$i){ echo "selected='selected'";}?>><?php echo $i;?> Months</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="posttitle" class="pull-left">Currently Working in<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_current_company" class="form-control" id="su_current_company" placeholder="Company Name" required="required" value="<?php echo $details[0]->scd_cur_company?>">
                </div>
                <div class="col-md-6">
                    <label for="numberOfPositions" class="pull-left">Latest Resume: <span style="font-size: small">(doc, docx, pdf)</span><span style="color: #FF0000"> *</span></label>
                    <input type="file" name="su_resume" class="form-control" id="su_resume" value="<?php echo $details[0]->scd_resume?>">
                     <span style="font-weight: bolder; color: #16A085" class="form-control"><?php echo $details[0]->scd_resume?></span>
                </div>
                <div class="col-md-6">
                    <label for="experience_from">Employment Type<span style="color: #FF0000">*</span></label>
                    <select name="su_emp_type" class="form-control" id="su_emp_type" required="required">
                        <option value="Contract" <?php if($details[0]->scd_cur_emp_type == "Contract") {echo "selected='selected'";}?>>Contract</option>
                        <option value="Permanent" <?php if($details[0]->scd_cur_emp_type == "Permanent") {echo "selected='selected'";}?>>Permanent</option>
                        <option value="Pay-Roll" <?php if($details[0]->scd_cur_emp_type == "Pay-Roll") {echo "selected='selected'";}?>>Pay-Roll</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="experience_from">Work Type<span style="color: #FF0000">*</span></label>
                    <select name="su_work_type" class="form-control" id="su_work_type" required="required">
                        <option value="Full-Time" <?php if($details[0]->scd_cur_work_type == "Full-Time") {echo "selected='selected'";}?>>Full-Time</option>
                        <option value="Part-Time" <?php if($details[0]->scd_cur_work_type == "Part-Time") {echo "selected='selected'";}?>>Part-Time</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="experience_from">Highest Education<span style="color: #FF0000"> *</span></label>
                    <select name="su_high_edu" class="form-control" id="su_high_edu" required="required">
                        <option value="MCA" <?php if($details[0]->scd_high_edu == "MCA") {echo "selected='selected'";}?>>MCA</option>
                        <option value="MBA" <?php if($details[0]->scd_high_edu == "MBA") {echo "selected='selected'";}?>>MBA</option>
                        <option value="B-Tech" <?php if($details[0]->scd_high_edu == "B-Tech") {echo "selected='selected'";}?>>B-Tech</option>
                        <option value="B.Sc" <?php if($details[0]->scd_high_edu == "B.Sc") {echo "selected='selected'";}?>>B.Sc</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="experience_from">Year<span style="color: #FF0000"> *</span></label>
                    <select name="su_high_year_pass" class="form-control" id="su_high_year_pass" required="required">
                        <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { ?>
                        <option value='<?php echo $year;?>' <?php if($details[0]->scd_high_year == $year) {echo "selected='selected'";}?>><?php echo $year;?></option><?php $year--; } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="posttitle" class="control-label pull-left">University<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_high_univ" class="form-control" id="su_high_univ" placeholder="University Name" required="required" value="<?php echo $details[0]->scd_high_univ?>">
                </div>
                <div class="col-md-6">
                    <label for="experience_from" class="control-label">Other Education<span style="color: #FF0000"> *</span></label>
                    <select name="su_other_edu" class="form-control" id="su_other_edu" required="required">
                        <option value="MCA" <?php if($details[0]->scd_other_edu == "MCA") {echo "selected='selected'";}?>>MCA</option>
                        <option value="MBA" <?php if($details[0]->scd_other_edu == "MBA") {echo "selected='selected'";}?>>MBA</option>
                        <option value="B-Tech" <?php if($details[0]->scd_other_edu == "B-Tech") {echo "selected='selected'";}?>>B-Tech</option>
                        <option value="B.Sc" <?php if($details[0]->scd_other_edu == "B.Sc") {echo "selected='selected'";}?>>B.Sc</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="experience_from" class="control-label">Year<span style="color: #FF0000"> *</span></label>
                    <select name="su_other_year_pass" class="form-control" id="su_other_year_pass" required="required">
                        <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { ?>
                            <option value='<?php echo $year;?>' <?php if($details[0]->scd_other_year == $year) {echo "selected='selected'";}?>><?php echo $year;?></option><?php $year--; } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="posttitle" class="control-label pull-left">University<span style="color: #FF0000"> *</span></label>
                    <input type="text" name="su_other_univ" class="form-control" id="su_other_univ" placeholder="University Name" required="required" value="<?php echo $details[0]->scd_other_univ?>">
                </div>
                <div class="col-md-6">
                    <label for="postDescription" class="control-label pull-left">Other Skills 1</label>
                    <input type="text" class="form-control" id="su_other_skill_1" name="other_skill_1" placeholder="Skill 1" value="<?php echo $details[0]->scd_other_skill_1?>"/>
                </div>
                <div class="col-md-6">
                    <label for="postDescription" class="control-label pull-left">Other Skills 2</label>
                    <input type="text" class="form-control" id="su_other_skill_2" name="other_skill_2" placeholder="Skill 2" value="<?php echo $details[0]->scd_other_skill_2?>"/>
                </div>
                <div class="col-sm-6">
                    <label for="location" class="control-label">Location<span style="color: #FF0000"> *</span></label>
                    <input name="su_location" class="form-control" id="autocomplete" value="<?php echo  $details[0]->scd_location; ?>"   type="text"/>
                </div>
                <!-- <div class="col-md-6">
                    <label for="contact-name" class="control-label">State<span style="color: #FF0000"> *</span></label>
                    <select name="su_cur_state" id="su_cur_state" class="form-control">
                        <option value="">Select a State</option>
                    </select>
                </div>

                    <div class="col-md-6">
                        <label for="skills" class="control-label">Current City<span style="color: #FF0000"> *</span></label>
                        <select name="su_cur_city" id="su_cur_city" class="form-control">
                            <option value="">Select a City</option>
                        </select>
                    </div> -->
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Update Details</button>
                        <a class="btn btn-primary" href="javascript:history.back()">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var cId = document.getElementById('su_cur_country').value;
        //alert(cId);
        $.ajax({

            url: '<?php echo base_url('user_dashboard/getStates');?>',
            type: 'POST',
            data: {'countryId': cId, 'rand': Math.round(Math.random() * 1000000)},
            datatype: 'html',

            success: function (data) {
                $('#su_cur_state').text('').append(data);
                $('#su_cur_state').val('<?php echo $details[0]->scd_cur_state ?>');
            }
        });

        var sId = <?php echo $details[0]->scd_cur_state ?>;
        //alert(cId);
        $.ajax({

            url: '<?php echo base_url('user_dashboard/getCities');?>',
            type: 'POST',
            data: {'stateId': sId, 'rand': Math.round(Math.random() * 1000000)},
            datatype: 'html',

            success: function (data) {
                $('#su_cur_city').text('').append(data);
                $('#su_cur_city').val('<?php echo $details[0]->scd_cur_city ?>');
            }
        });
            //////////////////////////////////////////////////////////////////////////////
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
    });
</script>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript">
    var placeSearch, autocomplete;
    function initialize()
    {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
            { types: ['geocode'] });
        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            //lat = place.geometry.location.k
            //alert(place.geometry.location);
            //alert(place.address_components);
            // hard to segregate the individual details of the address components.
            //alert(place.formatted_address);
            var LAT = place.geometry.location.k;
            //alert(LAT);
            document.getElementById('latitude').value = LAT;
            //var abc = document.getElementById('latitude').value;
            //alert(abc);
            var LON = place.geometry.location.D;
            document.getElementById('longitude').value = LON;
            var ADR = place.formatted_address;
            document.getElementById('fAddress').value = ADR;
            //console.log(place);
            //console.log(place);
            //alert(place.geometry.location.k);
            //alert(place.geometry.location.D);
            //alert('sasa');

        });
    }
</script>
<script type="text/javascript">
    initialize();
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#country_name', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#state_name';
            $.ajax({
                url: '<?php echo base_url('no_profile_employer/getStates');?>',
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
        $(document).on('change', '#state_name', function () {
            if (this.value == 0) {
                alert('Please select proper state');
                return false;
            }
            var dest = '#city_name';
            $.ajax({
                url: '<?php echo base_url('no_profile_employer/getCities');?>',
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

    });
</script>
<script type="text/javascript">
    function validationForm() {
        var i = document.getElementById('industry').value;
        var l = document.getElementById('autocomplete').value;
        var a1 = document.getElementById('address1').value;
        var cNum = document.getElementById('contact-number').value;
        var conName = document.getElementById('contact-name').value;

        document.getElementById('iErr').innerHTML = "";
        document.getElementById('LErr').innerHTML = "";
        document.getElementById('a1Err').innerHTML = "";
        document.getElementById('numErr').innerHTML = "";
        document.getElementById('conErr').innerHTML = "";


        if (i == "" || i == null || i == 0) {
            $('#iErr').css('padding', '10px 0 0 12px');
            document.getElementById('iErr').innerHTML = "Please select an industry";
            document.getElementById('industry').focus();
            return false;
        }
        if (l == "" || l == null) {
            $('#LErr').css('padding', '10px 0 0 12px');
            document.getElementById('LErr').innerHTML = "Location is Required";
            document.getElementById('autocomplete').focus();
            return false;
        }
        if (a1 == "" || a1 == null) {
            $('#a1Err').css('padding', '10px 0 0 12px');
            document.getElementById('a1Err').innerHTML = "Please fill this field";
            document.getElementById('address1').focus();
            return false;
        }
        if (cNum == "" || cNum == null) {
            $('#numErr').css('padding', '10px 0 0 12px');
            document.getElementById('numErr').innerHTML = "Please fill this field";
            document.getElementById('contact-number').focus();
            return false;
        }
        if (conName == "" || conName == null) {
            $('#conErr').css('padding', '10px 0 0 12px');
            document.getElementById('conErr').innerHTML = "Please fill this field";
            document.getElementById('contact-name').focus();
            return false;
        }
    }
</script>