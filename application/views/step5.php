<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="step_staging">
                <img src="<?php echo base_url('assets/images/step5_num.jpg'); ?>"  />
            </div>
            <div class="register_form">
                <h1><i class="fa fa-bookmark"></i>&nbsp;&nbsp;&nbsp;Portfolio</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/complete'); ?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="counter" value="2">
                            <div class="row portfolio_item">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="contact-name" class="col-sm-3 control-label">Item Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Enter Item Name" id="item_1" name="item_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="contact-name" class="col-sm-3 control-label">Category:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="cat_1">
                                                    <option value="desktop">Desktop</option>
                                                    <option value="mobile">Mobile</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea  class="form-control" style="height:100px;" placeholder="Enter Brief Description" name="desc_1" id="desc_1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Upload-Photo" class="col-sm-3 control-label">Upload Photo:</label>
                                        <div class="col-sm-9">
                                            <input type="file" id="file1"  name="file_1" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row new_portfolioitem">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="contact-name" class="col-sm-3 control-label">Item Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="item_2" placeholder="Enter Item Name" name="item_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="contact-name" class="col-sm-3 control-label">Category:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="cat_2">
                                                    <option value="desktop">Desktop</option>
                                                    <option value="mobile">Mobile</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea  name="desc_2" class="form-control" style="height:100px;" placeholder="Enter Brief Description about the product"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Upload-Photo2" class="col-sm-3 control-label">Upload Photo:</label>
                                        <div class="col-sm-9">
                                            <input type="file" id="file_2"  name="file_2" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form_buttons">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-warning" type="button" onclick="window.location = '<?php echo base_url('landing/step4'); ?>';"><i class="fa fa-reply"></i>&nbsp;&nbsp; BACK</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Finish & Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>