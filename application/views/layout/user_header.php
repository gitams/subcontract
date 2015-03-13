<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) { echo $title; } ?></title>
    <!-- CSS Links-->
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/font-awesome.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery-ui.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/bootstrap.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/dash.css"')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery1-ui.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/responsivemobilemenu.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/jquery.tokenize.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/tabcontent.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/slideControl.css');  ?>" />
    <!-- Js Links -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/typeahead.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/responsivemobilemenu.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.10.2.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery1-ui.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.slideControl.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tokenize.js'); ?>"></script>
    <script type="text/javascript" >
        $(document).ready(function()
        {
            $("#notificationLink").click(function() {
                $("#notificationContainer").fadeToggle(300);
                $("#notification_count").fadeOut("slow");
                $("#notificationsBody").load("notifications");
                return false;
            });
            //Document Click
            $(document).click(function() {	$("#notificationContainer").hide();	});
            //Popup Click
        });
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
</head>
<body>
<div class="dash-wrap">
    <div class="dash-container">
        <div class="dash-header">
            <div class="dash-logo"><img style="padding-left:34px;" src="<?php echo base_url('assets/images/logo.png');?>" alt=""></div>
            <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
            <div class="clear"></div>
                <div class="drop" style="margin-top: 2.3%">
                    <ul class="drop_menu">
                        <li><a href='<?php echo base_url('user_dashboard');?>' style="padding-left:0px; margin-left:0px;">Home</a></li>
                        <li><a href='javascript:void(0);'>Jobs</a>
                            <ul>
                                <li><a href="<?php echo base_url('user_dashboard/selfUserSuggestJobs');?>">Suggested Jobs</a></li>
                                <li><a href="<?php echo base_url('user_dashboard/selfUserSearchJobs');?>">Search Jobs</a></li>
                                <li><a href="<?php echo base_url('user_dashboard/selfUserAppliedJobs');?>">Applied Jobs</a></li>
                            </ul>
                        </li>
                        <li><a href='javascript:void(0);'>Employers</a>
                            <ul>
                                <!-- <li><a href="<?php echo base_url('user_dashboard/inProgress');?>">Suggested Employers</a></li> -->
                                <li><a href="<?php echo base_url('user_dashboard/selfUserSearchEmp');?>">Search Employers</a></li>
                                <!-- <li><a href="<?php echo base_url('user_dashboard/inProgress');?>">My Subscriptions</a></li> -->
                            </ul>
                        </li>
                    </ul>
                    <div class="drop" style=" width: auto; padding: 5px; border: 2px; border-radius: 20px; float: right">
                        <div class="circle" style=" float: left; background-image: url('<?php echo base_url('assets/images/kick.png'); ?>'); "></div>
                        <ul class="drop_menu">
                            <li><a href="<?php echo base_url('dashboard'); ?>"><?php
                                    $u_name = $this->session->userdata('userLoginDetails');
                                    $name =  ( (isset($u_name->first_name))?($u_name->first_name):'' ).' '. ( (isset($u_name->last_name))?($u_name->last_name):'' );
									$name = trim($name);
                                    if(empty($name)) 
                                    {
										echo "User Name";
									}
									else
									{
										echo $name;
									} ?></a>
                                <ul>
                                    <li><a href="<?php echo base_url('user_dashboard/myProfile'); ?>">My Profile</a></li>
                                    
                                    <li><a href="<?php echo base_url('user_dashboard/signout'); ?>">Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php } else { ?>
                <form name="userlogin" id="userlogin" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/login'); ?>">
                    <div class="col-sm-2 fr">
                        <input type="submit" value="Sign In" tabindex="3" class="signin_btn" />
                    </div>
                    <div class="input_section col-sm-3 fr">
                        <i class="fa fa-key"></i>&nbsp;<input tabindex="2" type="password" name="userpassword" id="userpassword" placeholder="Password" />
                    </div>
                    <div class="input_section col-sm-3 fr">
                        <i class="fa fa-envelope"></i>&nbsp;<input tabindex="1" type="text" name="useremail" id="useremail" placeholder="Email Address"  />
                    </div>
                </form>
                <div class="clear"></div>
            <?php } ?>
        </div>
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