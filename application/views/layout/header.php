<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php if(isset($title)) { echo $title; } ?></title>
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/font-awesome.css'); ?>"  />
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery-ui.css'); ?>"  />
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/bootstrap.css'); ?>"  />
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrapValidator.css'); ?>"/> -->
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/mainstyles.css'); ?>"  />
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/datepicker3.css'); ?>"  />
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/datepicker.css'); ?>"  />

        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/typeahead.js'); ?>"></script>

        <!--<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php /*echo base_url('assets/js/userlogin.js'); */?>"></script>-->

        <script type="text/javascript">

            var assetLoc = '<?php echo base_url('assets'); ?>';
            var BASEURL = '<?php echo base_url(); ?>';

        </script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/slideControl.css');  ?>" />
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.slideControl.js');  ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.slideControl').slideControl();
            });
        </script>
    </head>
    <body>
        <header>
            <div class="nav_section">
                <div class="container">
                    <div class="col-sm-3">
                        <div class="logo_section">
                            <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url('assets/images/logo.png'); ?>" /> </a>
                        </div>
                    </div>
                    <div class="col-sm-9">
					<div style="float:right;margin:0 35px 8px 0;">
                                               <a target="_blank" href="http://linkedin.com/subcontract" style="text-decoration:none;">
                                                       <img width="17" height="17" alt="Linkedin" src="<?php echo base_url('assets/images/linked_in.png');?>">
                                               </a>        
                                               <a target="_blank" href="http://twitter.com/subcontract" style="text-decoration:none;">
                                                       <img width="17" height="17" alt="Twitter" src="<?php echo base_url('assets/images/twitter.png');?>">
                                               </a>
                                               <a target="_blank" href="http://www.facebook.com/subcontract" style="text-decoration:none;">
                                                       <img width="17" height="17" alt="Facebook" src="<?php echo base_url('assets/images/fb.png');?>">
                                               </a>
                                       </div>
									   <div style="clear:both;"></div>
									   <div>
                        <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
                            <div class="fr">
                                <input type="button" value="Logout" class="signin_btn" onclick="window.location = '<?php echo base_url('dashboard/signout'); ?>';"/>
                            </div>
                            <div class="col-sm-3 fr">
                                <?php echo 'Welcome <b>' . $this->session->userdata('username') . '</b>'; ?>
                            </div>
                            <?php } else { ?>
                            <form name="userlogin" id="userlogin" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/login'); ?>">
                                <div class="row col-sm-10" style="float: right; display: inline;">
                                    <div class="col-sm-5">

                                        <label for="useremail" class="control-label" style="font-weight: 500;">Employer / Employee <span style="color: #FF0000"> *</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" name="useremail" class="form-control" id="useremail" placeholder="abc@example.com" required="required"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">

                                        <label for="userpassword"  style="font-weight: 500;" class="control-label">Password <span style="color: #FF0000"> *</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                            <input type="password" name="userpassword" class="form-control" id="userpassword" placeholder="Password" required="required"/>
                                        </div>
                                        <div style="float:right;">
                                            <a class="btn btn-primary btn-xs" href="<?php echo base_url('landing/forgotPasswordCall'); ?>" title="forgot password">Forgot Password</a>
                                        </div>
                                        <!--&nbsp;<input tabindex="1" type="text" name="useremail" title="email ID" id="useremail" placeholder="Email Address"  />-->
                                    </div><!--
                                    <div class="input_section" style="float: left">
                                        <i class="fa fa-key"></i>&nbsp;<input tabindex="2" type="password" name="userpassword" title="Password here" id="userpassword" placeholder="Password" />
                                    </div>-->
                                <div class="col-sm-2">
                                    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input style="float:left; padding:4px 13px;" class="btn btn-primary"type="submit" value="Login" />
                                </div>
                                </div>
                            </form>
                            <?php } ?>
							</div>
							
                    </div>

                </div>
            </div>
        </header>
        <?php
        if ($this->session->flashdata('error')) {
            $errors = $this->session->flashdata('error');
            echo '<div class="container" style="margin-top: 3px;">';
            foreach ($errors as $error) {
                echo '<div class="' . $error[0] . '">'
                . '<button class="close" data-dismiss="alert" type="button">x</button>' . $error[1] . '</div>';
            }
            echo '</div>';
        }
        ?>
