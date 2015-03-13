<div class="afterLogin">
    <div class="errors">
        <?php echo validation_errors();
        //print'<pre>';print_r($cans); //exit;?>
        <h3 style="text-align: center; margin-top: 3px;"><label>Edit Candidate Details</label></h3><hr/>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form action="<?php echo base_url('dashboard/updateEditCandidate') ?>" name="addCandidate" id="addCandidate" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <input type="hidden" name="canId" id="canId" value="<?php echo $cans[0]->can_id;?>">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="FirstName" class="control-label pull-left">First Name:</label>
                        <input type="text" name="can_first_name" class="form-control" id="can_first_name" value="<?php echo $cans[0]->can_first_name; ?>" required="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="lastName" class="control-label pull-left">Last Name:</label>
                        <input type="text" name="can_last_name" class="form-control" id="can_last_name" value="<?php echo $cans[0]->can_last_name; ?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="mobile" class="control-label pull-left">Mobile:</label>
                        <input type="text" name="can_mobile" class="form-control" id="can_mobile" value="<?php echo $cans[0]->can_mobile; ?>" required="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="postDescription" class="control-label pull-left">Email:</label>
                        <input type="text" class="form-control" rows="4" id="can_email" name="can_email" value="<?php echo $cans[0]->can_email;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="numberOfPositions" class="control-label pull-left">Current CTC:</label>
                        <input type="text" name="can_ctc" class="form-control" id="can_ctc" value="<?php echo $cans[0]->can_current_ctc; ?>" required="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="experience" class="control-label">Experience:</label>
                        <div>
                            <div class="col-sm-12" style="padding-left: 0; padding-right: 0;">
                                <select name="can_exp_year" class="form-control" id="can_exp_year" required="required">
                                    <?php for ($i = 0; $i <= 15; $i++) { ?>
                                    <option <?php if($cans[0]->can_current_exp_years == $i) { echo "selected='selected'"; } ?> value="<?php echo $i; ?>"> <?php echo $i . ' + Years'; } ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="skills" class="control-label">Major Skill:</label>
                            <select name="can_skill" id="can_skill" class="form-control"  required="required">
                                <option value="">Select a Skill</option>
                                <?php foreach ($skills as $skill) { ?>
                                    <option value="<?php echo $skill->skillid;?>" <?php if($cans[0]->can_maj_skill == $skill->skillid) { echo "selected='selected'"; } ?>><?php echo $skill->skillname;?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="numberOfPositions" class="control-label pull-left">Latest Resume: <span>(doc, docx, pdf)</span></label>
                        <input type="file" name="can_resume_file" class="form-control" id="can_resume_file">
                        <input type="text" readonly name="can_resume" class="form-control" id="can_resume"  value="<?php echo $cans[0]->can_resume; ?>" required="required">
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="posttitle" class="control-label pull-left">Currently Working in:</label>
                        <input type="text" name="can_current_company" class="form-control" id="can_current_company" value="<?php echo $cans[0]->can_current_org; ?>" required="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="experience_from" class="control-label">As:</label>
                        <div>
                            <div class="col-sm-6" style="padding-left: 0; padding-right: 0;">
                                <select name="can_emp_type" class="form-control" id="can_emp_type" required="required">
                                    <option value="Contract" <?php if($cans[0]->can_emp_type == "Contract"){ echo "selected='selected'"; }?>>Contract</option>
                                    <option value="Permanent" <?php if($cans[0]->can_emp_type == "Permanent"){ echo "selected='selected'"; }?>>Permanent</option>
                                    <option value="Pay-Roll" <?php if($cans[0]->can_emp_type == "Pay-Roll"){ echo "selected='selected'"; }?>>Pay-Roll</option>
                                </select>
                            </div>
                            <div class="col-sm-6" style="padding-right: 0;">
                                <select name="can_work_type" class="form-control" id="can_work_type" required="required">
                                    <option value="Full-Time" <?php if($cans[0]->can_work_type == "Full-Time"){ echo "selected='selected'"; }?>>Full-Time</option>
                                    <option value="Part-Time" <?php if($cans[0]->can_work_type == "Part-Time"){ echo "selected='selected'"; }?>>Part-Time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="education" class="control-label">Highest Education & Year:</label>
                        <div>
                            <div class="col-sm-6" style="padding-left: 0; padding-right: 0;">
                                <select name="can_high_edu" class="form-control" id="can_high_edu" required="required">
                                    <option value="MCA" <?php if($cans[0]->can_high_edu == "MCA"){ echo "selected='selected'"; }?>>MCA</option>
                                    <option value="MBA" <?php if($cans[0]->can_high_edu == "MBA"){ echo "selected='selected'"; }?>>MBA</option>
                                    <option value="B-Tech" <?php if($cans[0]->can_high_edu == "B-Tech"){ echo "selected='selected'"; }?>>B-Tech</option>
                                    <option value="B.Sc" <?php if($cans[0]->can_high_edu == "B.Sc"){ echo "selected='selected'"; }?>>B.Sc</option>
                                </select>
                            </div>
                            <div class="col-sm-6" style="padding-right: 0;">
                                <select name="can_high_year_pass" class="form-control" id="can_high_year_pass" required="required">
                                    <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { ?>
                                    <option <?php if($cans[0]->can_high_year == $year){ echo "selected='selected'"; }?> value='<?php echo $year;?>'><?php echo $year;  $year-- ;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="posttitle" class="control-label pull-left">University:</label>
                        <input type="text" name="can_high_univ" class="form-control" id="can_high_univ" value="<?php echo $cans[0]->can_high_univ; ?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="experience_from" class="control-label">Other Education & Year:</label>
                        <div>
                            <div class="col-sm-6" style="padding-left: 0; padding-right: 0;">
                                <select name="can_other_edu" class="form-control" id="can_other_edu" required="required">
                                    <option value="MCA" <?php if($cans[0]->can_other_edu == "MCA"){ echo "selected='selected'"; }?>>MCA</option>
                                    <option value="MBA" <?php if($cans[0]->can_other_edu == "MCA"){ echo "selected='selected'"; }?>>MBA</option>
                                    <option value="B-Tech" <?php if($cans[0]->can_other_edu == "MCA"){ echo "selected='selected'"; }?>>B-Tech</option>
                                    <option value="B.Sc" <?php if($cans[0]->can_other_edu == "MCA"){ echo "selected='selected'"; }?>>B.Sc</option>
                                </select>
                            </div>
                            <div class="col-sm-6" style="padding-right: 0;">
                                <select name="can_other_year_pass" class="form-control" id="can_other_year_pass" required="required">
                                    <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { echo "<option value='" . $year . "'>" . $year . '</option>'; $year-- ; } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="university" class="control-label pull-left">University:</label>
                        <input type="text" name="can_other_univ" class="form-control" id="can_other_univ" value="<?php echo $cans[0]->can_other_univ;?>" placeholder="University Name" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div>
                            <label for="otherSkills" class="control-label" style="">Other Skills:</label>
                        </div>
                        <div>
                            <div class="col-sm-6" style="padding-left: 0; padding-right: 0;">
                                <input type="text" class="form-control" id="can_other_skill_1" name="other_skill_1"  value="<?php echo $cans[0]->can_other_skill_1;?>"placeholder="Skill 1"/>
                            </div>
                            <div class="col-sm-6" style="padding-right: 0;">
                                <input type="text" class="form-control" id="can_other_skill_2" name="other_skill_2"  value="<?php echo $cans[0]->can_other_skill_2;?>"placeholder="Skill 2"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="skills" class="control-label">Current Location:</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $cans[0]->can_location;?>"/>
                    </div>
                </div>
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Update</button>
                        <button class="btn btn-warning" type="button" onclick="history.back()"><i class="fa fa-arrow-left"></i>&nbsp;Back</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>
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