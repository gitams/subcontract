<h3 style="text-align: center; margin-top: 3px;"><label>Add Candidate - Step 1</label></h3><hr/>
<div class="afterLogin">
    <div class="errors">
        <?php echo validation_errors(); ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo base_url('dashboard/saveCandidate') ?>" name="addCandidate" id="addCandidate" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">First Name:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="can_first_name" class="form-control" id="can_first_name" placeholder="First name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Last Name:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="can_last_name" class="form-control" id="can_last_name" placeholder="Last name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Mobile:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="can_mobile" class="form-control" id="can_mobile" placeholder="10 Digits Only" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="postDescription" class="col-sm-4 control-label pull-left">Email:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" rows="4" id="can_email" name="can_email" placeholder="Eg: email@company.com" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Current Salary:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="can_ctc" class="form-control" id="can_ctc" placeholder="Eg: 320000 (no spaces or spl chars)" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Experience:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="can_exp_year" class="form-control" id="can_exp_year" required="required">
                                <option value="0">Fresher</option>
                                <?php for ($i = 1; $i <= 16; $i++) { echo "<option value='" . $i . "'>" . $i . '+ Years</option>'; } ?>
                            </select>
                        </div>
                        <!--<div class="col-sm-4">
                            <select name="can_exp_mnth" class="form-control" id="can_exp_mnth" required="required">
                                <option value="">Month</option>
                                <?php /*for ($i = 1; $i <= 11; $i++) { echo "<option value='" . $i . "'>" . $i . ' Months</option>'; } */?>
                            </select>
                        </div>-->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="skills" class="col-sm-4 control-label">Major Skill:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="can_skill" id="can_skill" class="form-control"  required="required">
                                <option value="">Select a Skill</option>
                                <?php foreach ($skills as $skill) {
                                    echo '<option value="' . $skill->skillid . '">' . $skill->skillname . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Latest Resume: <span style="font-size: small">(doc, docx, pdf)</span><span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="file" name="can_resume" class="btn-primary form-control" id="can_resume"  required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Save Candidate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>