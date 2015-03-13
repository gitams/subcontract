<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="step_staging">
                <img src="<?php echo base_url('assets/images/step4_num.jpg'); ?>"  />
            </div>
            <div class="register_form">
                <h1><i class="fa fa-comment"></i>&nbsp;&nbsp;Company</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/saveStep4'); ?>" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-3 control-label">Company Established Date:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name ="estDate" id="estDate" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-3 control-label">Annual Revenue:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="annRev" id="annRev" placeholder="ex: 127545000">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-3 control-label">Number Of Employees:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="numEmp" id="numEmp" placeholder="ex: 127545000">
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-3 control-label">Certifications:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="contact-name" placeholder="Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="button" class="btn btn-default" value="Add More" />
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group form_buttons">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-success" type="button" onclick="window.location = '<?php echo base_url('landing/step3'); ?>';"><i class="fa fa-reply"></i>&nbsp;&nbsp; Back</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="button" onclick="window.location = '<?php echo base_url('landing/step5'); ?>';"><i class="fa fa-share"></i> &nbsp;&nbsp;Skip</button> &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> <i class="fa fa-share"></i> &nbsp;&nbsp;Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(
        function() {
            $('#estDate').datepicker( {
                    onClose: function(dateText, inst) {
                        alert("My date is: " + dateText);
                    }
                });
        }
    );
</script>