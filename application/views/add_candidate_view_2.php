<h3 style="text-align: center; margin-top: 3px;"><label>Add Candidate - Step 2</label></h3><hr/>
<div class="afterLogin">
    <div class="errors">
        <?php echo validation_errors(); ?>
        <h4 align="center">  Additional Details </h4><br/>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo base_url('dashboard/saveCandidate_Details') ?>" name="addCandidate_details" id="addCandidate_details" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Currently Working in:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="can_current_company" class="form-control" id="can_current_company" placeholder="Company Name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">As:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-4">
                            <select name="can_emp_type" class="form-control" id="can_emp_type" required="required">
                                <option value="Contract">Contract</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Pay-Roll">Pay-Roll</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="can_work_type" class="form-control" id="can_work_type" required="required">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Highest Education & Year:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-4">
                            <select name="can_high_edu" class="form-control" id="can_high_edu" required="required">
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                                <option value="B-Tech">B-Tech</option>
                                <option value="B.Sc">B.Sc</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="can_high_year_pass" class="form-control" id="can_high_year_pass" required="required">
                                <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { echo "<option value='" . $year . "'>" . $year . '</option>'; $year-- ; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">University:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="can_high_univ" class="form-control" id="can_high_univ" placeholder="University Name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Other Education & Year:</label>
                        <div class="col-sm-4">
                            <select name="can_other_edu" class="form-control" id="can_other_edu">
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                                <option value="B-Tech">B-Tech</option>
                                <option value="B.Sc">B.Sc</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="can_other_year_pass" class="form-control" id="can_other_year_pass">
                                <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { echo "<option value='" . $year . "'>" . $year . '</option>'; $year-- ; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">University:</label>
                        <div class="col-sm-8">
                            <input type="text" name="can_other_univ" class="form-control" id="can_other_univ" placeholder="University Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="postDescription" class="col-sm-4 control-label pull-left">Other Skills:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="can_other_skill_1" name="other_skill_1" placeholder="Skill 1"/>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="can_other_skill_2" name="other_skill_2" placeholder="Skill 2"/>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="col-sm-9">
                        <label for="contact-name" class="col-sm-4 control-label">Country:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="can_cur_country" id="can_cur_country" class="form-control">
                                <option value="">Select Country</option>
                                <?php
/*                                foreach ($countries as $country) {
                                    echo '<option value="' . $country->countryid . '">' . $country->countryname . '</option>';
                                }
                                */?>
                            </select>
                        </div>
                    </div>
                    </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="contact-name" class="col-sm-4 control-label">State:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="can_cur_state" id="can_cur_state" class="form-control">
                                <option value="">Select a State</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="skills" class="col-sm-4 control-label">Current City:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="can_cur_city" id="can_cur_city" class="form-control">
                                <option value="">Select a City</option>
                            </select>
                        </div>
                    </div>
                </div>-->
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="location" class="col-sm-4 control-label">Location:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Type Your city" required="required"/>
                        </div>
                    </div>
                </div>
                <input id="latitude" type="hidden" name="latitude" value=""/>
                <input id="longitude" type="hidden" name="longitude" value=""/>
                <input id="fAddress" type="hidden" name="fAddress" value=""/>
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Save Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript">
    var placeSearch, autocomplete;
    function initialize()
    {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('location')),
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
<script>
    $(document).ready(function () {
        $(document).on('change', '#can_cur_country', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#can_cur_state';
            $.ajax({
                url: '<?php echo base_url('dashboard/getStates');?>',
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
        $(document).on('change', '#can_cur_state', function () {
            if (this.value == 0 || this.value == "") {
                alert('Please select proper state');
                return false;
            }
            var dest = '#can_cur_city';
            $.ajax({
                url: '<?php echo base_url('dashboard/getCities');?>',
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