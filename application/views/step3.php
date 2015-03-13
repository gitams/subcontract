<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="step_staging">
                <img src="<?php echo base_url('assets/images/step3_num.jpg'); ?>"  />
            </div>
            <div class="register_form">
                <h1><i class="fa fa-user"></i>&nbsp;&nbsp;Services &nbsp; &amp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-building-o"></i>&nbsp;&nbsp;&nbsp;Clients </h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/saveStep3') ?>" method="post" class="form-horizontal" role="form">
                            <h2><i class="fa fa-user"></i>&nbsp;&nbsp;Services</h2>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-4 control-label">Service Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="service Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-4 control-label">Expertise:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="expertise" name="expertise" placeholder="Expertise">
                                    </div>
                                </div>
                            </div>
                            <h2><i class="fa fa-building-o"></i>&nbsp;&nbsp;Clients</h2>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="contact-name" class="col-sm-4 control-label">Client Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="client" name="client" placeholder="Client Names by ,">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form_buttons">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary" type="button" onclick="window.location = '<?php echo base_url('landing/doItLater');?>';"><i class="fa fa-user"></i> &nbsp;&nbsp;Do It Later</button>
                                    <button class="btn btn-primary" type="button" onclick="window.location = '<?php echo base_url('landing/skipStep3'); ?>';"><i class="fa fa-share"></i> &nbsp;&nbsp;Skip</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit"> <i class="fa fa-floppy-o"></i> <i class="fa fa-share"></i> &nbsp;&nbsp;Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>