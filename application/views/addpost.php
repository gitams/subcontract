<style>
    .val-err {
       color: #ff4626;
    }
</style>
<div class="afterLogin">
    <div class="row">
        <div class="col-sm-12">
        <h4 style="text-align: center; margin: 0;"><label>Post a Job</label></h4><hr/>
            <form action="<?php echo base_url('dashboard/savePost') ?>" name="addPost" id="addPost" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" <!--onsubmit="return validationForm();-->">
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Job Title:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="posttitle" class="form-control" id="posttitle" placeholder="Job Title" required="required">
                            <div class="val-err" id="postTitleErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Job ID:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="postid" class="form-control" id="postid" placeholder="Ex: SAP_Tech_Functional" required="required">
                            <div class="val-err" id="postIdErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="postDescription" class="col-sm-4 control-label pull-left">Job Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="4" id="postDescription" name="postDescription" placeholder="Post Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Number of positions:</label>
                        <div class="col-sm-8">
                            <input type="text" name="numpos" class="form-control" id="numpos" placeholder="Number of positions" maxlength="3" pattern="\d*"  title="Number of Jobs - Only digits">
                            <div class="val-err" id="numPosErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="Qualification" class="col-sm-4 control-label pull-left">Qualification:</label>
                        <div class="col-sm-8">
                            <input type="text" name="qual" class="form-control" id="qual" placeholder="MSC/MCA/BTech/MBA..etc" >
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
                                <option value="Contract">Contract</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Intern">Intern</option>
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
                                <option value="Direct Client">Direct Client</option>
                                <option value="Sub Contract">Sub Contract</option>
                                <option value="US Citizen">US Citizen</option>
                                <option value="EAD">EAD</option>
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
                                <option value="H1B">H1B</option>
                                <option value="Green Card">Green Card</option>
                                <option value="US Citizen">US Citizen</option>
                                <option value="EAD">EAD</option>
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
                                <option value="hour">Hour</option>
                                <option value="month">Monthly</option>
                                <option value="annual">Annual</option>
                            </select>
                            <div class="val-err" id="reteErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="ctc_from" class="col-sm-4 control-label">Salary Range:</label>
                        <div class="col-sm-4">
                            <input type="text" name="ctc_from" class="form-control" id="ctc_from" placeholder="From"  maxlength="7" pattern="\d*" title="Only Digits"/>
                            <div class="val-err" id="ctcFromErr"></div>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="ctc_to" class="form-control" id="ctc_to" placeholder="To"  maxlength="7" pattern="\d*" title="Only Digits">
                            <div class="val-err" id="ctcToErr"></div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="contract_terms" class="col-sm-4 control-label">Contract Terms:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="contract_terms" name="contract_terms" placeholder="Contract Terms"></textarea>
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
                                <?php for ($i = 0; $i <= 19; $i++) { echo "<option value='" . $i . "'>" . $i . ' Years</option>'; } ?>
                            </select>
                            <div class="val-err" id="expFrmErr"></div>
                        </div>
                        <div class="col-sm-4">
                            <!-- <input type="text" name="experience_to" class="form-control" id="experience_to" placeholder="Experience To"> -->
                            <select name="experience_to" class="form-control" id="experience_to" >
                                <option value="">To</option>
                                <?php for ($i = 1; $i <= 20; $i++) { echo "<option value='" . $i . "'>" . $i . ' Years</option>'; } ?>
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
                                <?php foreach ($skills as $skill) { echo '<option value="'.$skill->skillid.'">'.$skill->skillname.'</option>'; } ?>
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
                        <label for="industry" class="col-sm-4 control-label pull-left">Keywords:</label>
                        <div class="col-sm-8">
                            <input type="text" name="keyword" class="form-control" id="keywords" placeholder="key words" >
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
                                <?php foreach ($industries as $industry) { echo '<option value="' . $industry->industryid . '">' . $industry->industry_name . '</option>'; } ?>
                            </select>
                            <div class="val-err" id="industryErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="FunctionalArea" class="col-sm-4 control-label pull-left">Functional Area:</label>
                        <div class="col-sm-8">
                            <input type="text" name="funarea" class="form-control" id="funarea" placeholder="Functional Area"  pattern="[a-zA-Z\s]+" title="only Characters and space">
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
                                <option value="25">25 %</option>
                                <option value="50">50 %</option>
                                <option value="75">75 %</option>
                                <option value="100">100 %</option>
                            </select>
                            <div class="val-err" id="travelErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="compDescription" class="col-sm-4 control-label pull-left">Company Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="compDescription" name="compDescription" placeholder="Company Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="onboarding" class="col-sm-4 control-label pull-left">On boarding by :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="onboardby" name="onboardby" placeholder="Ex: 1 week/ 2 weeks/ 4 weeks"  maxlength="1" pattern="\d*" title="Only one Digit">
                            <div class="val-err" id="onBoardErr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="travel" class="col-sm-4 control-label">Refresh job by:</label>
                        <div class="col-sm-8">
                            <select name="refjob" id="refjob" class="form-control" >
                                <option value="">Please Select</option>
                                <option value="weekly">Weekly</option>
                                <option value="fortnight">Fortnight</option>
                                <option value="monthly">Monthly</option>
                            </select>
                            <div class="val-err" id="refJobErr"></div>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
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
                            <input type="text" class="form-control" id="location" name="location" placeholder="Type Your city" required="required"/>
                        </div>
                    </div>
                </div>
                <input id="latitude" type="hidden" name="latitude" value=""/>
                <input id="longitude" type="hidden" name="longitude" value=""/>
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