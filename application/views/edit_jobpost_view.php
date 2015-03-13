<?php //print_r($postDetails); exit;?>
<style>
    .val-err {
       color: #ff4626;
    }
</style>
<div class="afterLogin">
    <div class="row">
        <div class="col-sm-12">
        <h4 style="text-align: center; margin: 0;"><label>Edit Job Post</label></h4><hr/>
            <form action="<?php echo base_url('dashboard/updateJobPost') ?>" name="addPost" id="addPost" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" onsubmit="return validationForm();">
                <input type="hidden" name="postID" value="<?php echo $postDetails[0]->post_id;?>">
                <input type="hidden" name="jobPostSkillId" value="<?php echo $postDetails[0]->jpsId;?>">
                <input type="hidden" name="jobPostLocationId" value="<?php echo $postDetails[0]->jplId;?>">
                <input type="hidden" name="locationId" value="<?php echo $postDetails[0]->lId;?>">
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="job-title" class="col-sm-4 control-label pull-left">Job Title:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="posttitle" class="form-control" id="posttitle" value="<?php echo $postDetails[0]->post_title;?>" placeholder="Job Title" required="required">
                            <div class="val-err" id="postTitleErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Job ID:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="jobId" class="form-control"  value="<?php echo $postDetails[0]->jobid;?>" id="postid" placeholder="Ex: SAP_Tech_Functional" required="required">
                            <div class="val-err" id="postIdErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="postDescription" class="col-sm-4 control-label pull-left">Job Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="4" id="postDescription" name="postDescription" placeholder="Post Description"><?php echo $postDetails[0]->post_description;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Number of positions:</label>
                        <div class="col-sm-8">
                            <input type="text" name="numpos" class="form-control" id="numpos"   value="<?php echo $postDetails[0]->positions;?>" placeholder="Number of positions" maxlength="3" pattern="\d*"  title="Number of Jobs - Only digits">
                            <div class="val-err" id="numPosErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="Qualification" class="col-sm-4 control-label pull-left">Qualification:</label>
                        <div class="col-sm-8">
                            <input type="text" name="qual" class="form-control" id="qual"  value="<?php echo $postDetails[0]->qualification;?>" placeholder="MSC/MCA/BTech/MBA..etc" >
                            <div class="val-err" id="qualErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="EmpType" class="col-sm-4 control-label">Employment type:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="emptype" id="emp_type" class="form-control" required="required">
                                <option value="">Select Type</option>
                                <option value="Contract" <?php if($postDetails[0]->emp_type == "Contract") { echo "selected = 'selected'";}?>>Contract</option>
                                <option value="Full-Time" <?php if($postDetails[0]->emp_type == "Full-Time") { echo "selected = 'selected'";}?>>Full-Time</option>
                                <option value="Part-Time" <?php if($postDetails[0]->emp_type == "Part-Time") { echo "selected = 'selected'";}?>>Part-Time</option>
                                <option value="Intern" <?php if($postDetails[0]->emp_type == "Intern") { echo "selected = 'selected'";}?>>Intern</option>
                            </select>
                            <div class="val-err" id="empTypeErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="ReqType" class="col-sm-4 control-label">Requirement type:</label>
                        <div class="col-sm-8">
                            <select name="reqtype" id="req_type" class="form-control" >
                                <option value="">Select Type</option>
                                <option value="Direct Client" <?php if($postDetails[0]->req_type == "Direct Client") { echo "selected = 'selected'";}?>>Direct Client</option>
                                <option value="Sub Contract" <?php if($postDetails[0]->req_type == "Sub Contract") { echo "selected = 'selected'";}?>>Sub Contract</option>
                                <option value="US Citizen" <?php if($postDetails[0]->req_type == "US Citizen") { echo "selected = 'selected'";}?>>US Citizen</option>
                                <option value="EAD" <?php if($postDetails[0]->req_type == "EAD") { echo "selected = 'selected'";}?>>EAD</option>
                            </select>
                            <div class="val-err" id="reqTypeErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="WorkStatus" class="col-sm-4 control-label">Work Status:</label>
                        <div class="col-sm-8">
                            <select name="work" id="work_status" class="form-control" >
                                <option value="">Select Status</option>
                                <option value="H1B" <?php if($postDetails[0]->req_type == "H1B") { echo "selected = 'selected'";}?>>H1B</option>
                                <option value="Green Card" <?php if($postDetails[0]->req_type == "Green Card") { echo "selected = 'selected'";}?>>Green Card</option>
                                <option value="US Citizen" <?php if($postDetails[0]->req_type == "US Citizen") { echo "selected = 'selected'";}?>>US Citizen</option>
                                <option value="EAD" <?php if($postDetails[0]->req_type == "EAD") { echo "selected = 'selected'";}?>>EAD</option>
                            </select>
                            <div class="val-err" id="workStatusErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="rate" class="col-sm-4 control-label pull-left">Rate:</label>
                        <div class="col-sm-8">
                            <select name="rate" class="form-control" id="rate" >
                                <option value="hour" <?php if($postDetails[0]->rate == "hour") { echo "selected = 'selected'";}?>>Hour</option>
                                <option value="month" <?php if($postDetails[0]->rate == "month") { echo "selected = 'selected'";}?>>Monthly</option>
                                <option value="annual" <?php if($postDetails[0]->rate == "annual") { echo "selected = 'selected'";}?>>Annual</option>
                            </select>
                            <div class="val-err" id="reteErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="ctc_from" class="col-sm-4 control-label">Salary Range:</label>
                        <div class="col-sm-4">
                            <input type="text" name="ctc_from" class="form-control" id="ctc_from"   value="<?php echo $postDetails[0]->ctc_from;?>" placeholder="From"  maxlength="7" pattern="\d*" title="Only Digits"/>
                            <div class="val-err" id="ctcFromErr"></div>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="ctc_to" class="form-control" id="ctc_to"   value="<?php echo $postDetails[0]->ctc_to;?>" placeholder="To"  maxlength="7" pattern="\d*" title="Only Digits">
                            <div class="val-err" id="ctcToErr"></div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="contract_terms" class="col-sm-4 control-label">Contract Terms:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="contract_terms" name="contract_terms" placeholder="Contract Terms"><?php echo $postDetails[0]->contract_terms;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Experience Range:</label>
                        <div class="col-sm-4">
                            <!--<input type="text" name="experience_from" class="form-control" id="experience_from" placeholder="Experience From"> -->
                            <select name="experience_from" class="form-control" id="experience_from" >
                                <option value="">From</option>
                                <?php for ($i = 0; $i <= 19; $i++) { ?>
                                <option value="<?php echo $i;?>" <?php if($i == $postDetails[0]->experience_from) {echo "selected = 'selected' "; }?>><?php echo $i." "."Years"?></option>';
                                <?php } ?>
                            </select>
                            <div class="val-err" id="expFrmErr"></div>
                        </div>
                        <div class="col-sm-4">
                            <!-- <input type="text" name="experience_to" class="form-control" id="experience_to" placeholder="Experience To"> -->
                            <select name="experience_to" class="form-control" id="experience_to" >
                                <option value="">To</option>
                                <?php for ($i = 1; $i <= 20; $i++) { ?>
                                    <option value="<?php echo $i;?>" <?php if($i == $postDetails[0]->experience_to) {echo "selected = 'selected' "; }?>><?php echo $i." "."Years"?></option>';
                                <?php } ?>
                            </select>
                            <div class="val-err" id="expToErr"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="skills" class="col-sm-4 control-label">Skills:</label>
                        <div class="col-sm-8"">
                            <select name="skills[]" id="tokenize" class="tokenize-sample" multiple="multiple" >
                                <?php foreach ($skills as $skill) { ?>
                                <option value="<?php echo $skill->skillid;?>" <?php if($skill->skillid == $postDetails[0]->skill_id) {echo "selected = 'selected' "; }?>><?php echo $skill->skillname;?></option>
                                <?php } ?>
                            </select>
                        <div class="val-err" id="skillErr"></div>
                            <script type="text/javascript">
                                $('#tokenize').tokenize();
                            </script>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="keywords" class="col-sm-4 control-label pull-left">Keywords:</label>
                        <div class="col-sm-8">
                            <input type="text" name="keyword" class="form-control" value="<?php echo $postDetails[0]->keywords;?>" id="keywords" placeholder="key words" >
                            <div class="val-err" id="keyWordErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="industry_name" class="col-sm-4 control-label">Industry:</label>
                        <div class="col-sm-8">
                            <select name="industry" id="industry" class="form-control" >
                                <option value="">Select an Industry</option>
                                <?php foreach ($industries as $industry) { ?>
                                    <option value="<?php echo $industry->industryid ?>" <?php if($industry->industryid == $postDetails[0]->industry) {echo "selected = 'selected' "; }?>><?php echo $industry->industry_name?></option>
                                <?php } ?>
                            </select>
                            <div class="val-err" id="industryErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="FunctionalArea" class="col-sm-4 control-label pull-left">Functional Area:</label>
                        <div class="col-sm-8">
                            <input type="text" name="funarea" class="form-control" id="funarea" value="<?php echo $postDetails[0]->fun_area;?>" placeholder="Functional Area"  pattern="[a-zA-Z\s]+" title="only Characters and space">
                            <div class="val-err" id="funAreaErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="travel" class="col-sm-4 control-label">Travel Type:</label>
                        <div class="col-sm-8">
                            <select name="travel" id="travel" class="form-control" >
                                <option value="">Please Select</option>
                                <option value="nil">Nil</option>
                                <option value="25" <?php if($postDetails[0]->travel_type == "25") {echo "selected = 'selected' "; }?>>25 %</option>
                                <option value="50" <?php if($postDetails[0]->travel_type == "50") {echo "selected = 'selected' "; }?>>50 %</option>
                                <option value="75" <?php if($postDetails[0]->travel_type == "75") {echo "selected = 'selected' "; }?>>75 %</option>
                                <option value="100" <?php if($postDetails[0]->travel_type == "100") {echo "selected = 'selected' "; }?>>100 %</option>
                            </select>
                            <div class="val-err" id="travelErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="compDescription" class="col-sm-4 control-label pull-left">Company Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="compDescription" name="compDescription" placeholder="Company Description"> <?php echo $postDetails[0]->comp_desc;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="onboarding" class="col-sm-4 control-label pull-left">On boarding by (weeks):</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="onboardby" name="onboardby"  value="<?php echo $postDetails[0]->on_boarding_by;?>" placeholder="Ex: 1 week/ 2 weeks/ 4 weeks"  maxlength="1" pattern="\d*" title="Only one Digit">
                            <div class="val-err" id="onBoardErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="travel" class="col-sm-4 control-label">Refresh job by:</label>
                        <div class="col-sm-8">
                            <select name="refjob" id="refjob" class="form-control" >travel_type
                                <option value="">Please Select</option>
                                <option value="weekly" <?php if($postDetails[0]->refresh_by == "weekly") {echo "selected = 'selected' "; }?>>Weekly</option>
                                <option value="fortnight" <?php if($postDetails[0]->refresh_by == "fortnight") {echo "selected = 'selected' "; }?>>Fortnight</option>
                                <option value="monthly" <?php if($postDetails[0]->refresh_by == "monthly") {echo "selected = 'selected' "; }?>>Monthly</option>
                            </select>
                            <div class="val-err" id="refJobErr"></div>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="col-sm-9">
                        <label for="country_name" class="col-sm-4 control-label">Country:</label>
                        <div class="col-sm-8">
                            <select name="country" id="country_name" class="form-control" >
                                <option value="">Select a Country</option>
                                <?php /*foreach ($countries as $country) { echo '<option value="' . $country->countryid . '">' . $country->countryname . '</option>'; } */?>
                            </select>
                            <div class="val-err" id="countryErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="state-name" class="col-sm-4 control-label">State:</label>
                        <div class="col-sm-8">
                            <select name="state" id="state_name" class="form-control" >
                                <option value="">Select a State</option>
                            </select>
                            <div class="val-err" id="stateErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="contact-name" class="col-sm-4 control-label">City:</label>
                        <div class="col-sm-8">
                            <select name="city" id="city_name" class="form-control" >
                                <option value="">Select a City</option>
                            </select>
                            <div class="val-err" id="cityErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="contact-name" class="col-sm-4 control-label">Zipcode:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="zipcode" placeholder="Zipcode" name="zipcode"  title="only 5 digits" pattern="\d*" maxlength="5"/>
                            <div class="val-err" id="contactErr"></div>
                        </div>
                    </div>
                </div>-->
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="location" class="col-sm-4 control-label">Location:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location"  value="<?php echo $postDetails[0]->locationname;?>"   name="location" placeholder="Type Your city" required="required"/>
                        </div>
                    </div>
                </div>
                <input id="latitude" type="hidden" name="latitude" value="<?php echo $postDetails[0]->latitude;?>"/>
                <input id="longitude" type="hidden" name="longitude" value="<?php echo $postDetails[0]->longitude;?>"/>
                <input id="fAddress" type="hidden" name="fAddress" value=""/>
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Submit Post</button>
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
        $(document).on('change', '#country_name', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#state_name';
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
        $(document).on('change', '#state_name', function () {
            if (this.value == 0) {
                alert('Please select proper state');
                return false;
            }
            var dest = '#city_name';
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
<!--<script>
    function validationForm() {
        var postTitle = document.getElementById('posttitle').value;
        var postId = document.getElementById('postid').value;
        var numPos = document.getElementById('numpos').value;
        var Qua = document.getElementById('qual').value;
        var EmpType = document.getElementById('emp_type').value;
        var ReqType = document.getElementById('req_type').value;
        var workStat = document.getElementById('work_status').value;
        var Rate = document.getElementById('rate').value;
        var ctcFrm = document.getElementById('ctc_from').value;
        var ctcTo = document.getElementById('ctc_to').value;
        var expFrm = document.getElementById('experience_from').value;
        var expTo = document.getElementById('experience_to').value;
        var skill = document.getElementById('tokenize').value;
        var keyW = document.getElementById('keywords').value;
        var indS = document.getElementById('industry').value;
        var funArea = document.getElementById('funarea').value;
        var Travel = document.getElementById('travel').value;
        var onBrd = document.getElementById('onboardby').value;
        var refJob = document.getElementById('refjob').value;
        var countryName = document.getElementById('country_name').value;
        var stateName = document.getElementById('state_name').value;
        var cityName = document.getElementById('city_name').value;
        var zipCode = document.getElementById('zipcode').value;






    }
</script>-->