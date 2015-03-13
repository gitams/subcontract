<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) { echo $title; } ?></title>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/font-awesome.css')?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery-ui.css')?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/bootstrap.css')?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/dash.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery1-ui.css')?>"  />
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/responsivemobilemenu.css')?>" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/jquery.tokenize.css')?>" />
    <link href="<?php echo base_url('assets/styles/tabcontent.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/datepicker.css'); ?>"  />

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/typeahead.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/responsivemobilemenu.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery1-ui.js')?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/slideControl.css');  ?>" />
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.slideControl.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/ajaxfileupload.js'); ?>"></script>
    <script type="text/javascript" >
        $(document).ready(function()
        {
            $("#notificationLink").click(function() {
                $("#notificationContainer").fadeToggle(300);
                $("#notification_count").fadeOut("slow");
                $("#notificationsBody").load("<?php echo base_url('dashboard/notifications');?>");
                return false;
            });
            //Document Click
            $(document).click(function() {	$("#notificationContainer").hide();	});
            //Popup Click
        });
        $(document).ready(function()
        {
            $("#notificationLink2").click(function() {
                $("#notificationContainer2").fadeToggle(300);
                $("#notification_count2").fadeOut("slow");
                $("#notificationsBody2").load("<?php echo base_url('dashboard/notifications');?>");
                return false;
            });
            //Document Click
            $(document).click(function() {	$("#notificationContainer2").hide();	});
            //Popup Click
        });
    </script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tokenize.js'); ?>"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>


</head>
<body>
<div class="dropStick">
    <img style="padding: 0 0 0 6%;" src="<?php echo base_url('assets/images/logo.png');?>" alt="">
    <ul class="drop_menu" style="float: right; padding: 0 6% 0 0">
        <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
        <!--<li></li>-->
        <li style="margin-left: 50px;"><a href='<?php echo base_url('dashboard/index');?>'><i class="fa fa-home fa-lg"><!-- Home--></i></a></li>
        <!--<li><a href='javascript:void(0);'>Vendors</a></li>-->
        <li><a href="<?php echo base_url('dashboard/myposts');?>"><i class="fa fa-bars fa-lg"><!-- Jobs--></i></a>
            <ul>
					 <li><a href="<?php echo base_url('dashboard/myposts');?>"><i class="fa">My Jobs Posts</i></a></li>                
                <li><a href="<?php echo base_url('dashboard/addpost');?>"><i class="fa">Post a job</i></a></li>
                <li><a href="<?php echo base_url('dashboard/joblist');?>"><i class="fa">All Jobs Posts</i></a></li>
            </ul>
        </li>
        <li><a href="<?php echo base_url('dashboard/myCandidates');?>"><i class="fa fa-users fa-lg"><!-- Candidates--></i></a>
            <ul>
					<li><a href="<?php echo base_url('dashboard/myCandidates');?>"><i class="fa">My Candidates</i></a></li>                
                <li><a href="<?php echo base_url('dashboard/addCandidate') ?>"><i class="fa">Add a Candidate</i></a></li>
            </ul>
        </li>
        <?php   $userDetails = $this->session->userdata('userLoginDetails');
        $contact_type_id = $userDetails->contacttypeid;
        if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) { ?>
            <li><a href="<?php echo base_url('dashboard/connections');?>"><i class="fa fa-user"></i><i class="fa fa-users fa-lg"><!-- Connections--></i></a>
                <ul>
                    <li><a href="<?php echo base_url('dashboard/connections');?>"><i class="fa">My Connections</i></a></li>
                    <!--<li><a href="<?php /*echo base_url('dashboard/request');*/?>">Send a Request</a> </li>-->
                    <li><a href="<?php echo base_url('dashboard/approverequest');?>"><i class="fa">Pending Requests</i></a> </li>
                    <li><a href="<?php echo base_url('dashboard/sentrequest');?>"><i class="fa">Sent Requests</i></a> </li>
                    <li><a href="<?php echo base_url('dashboard/empByMap');?>"><i class="fa">Employers by region</i></a> </li>
                </ul>
            </li>
            <li id="notification_li2">
                <span id="notification_count2" style="display: none"></span>
                <a href="#" id="notificationLink2" ><i class="fa fa-globe fa-lg"><!-- Notifications--></i></a>
                <div id="notificationContainer2">
                    <div id="notificationTitle2">Notifications</div>
                    <div id="notificationsBody2" class="notifications">
                    </div>
                    <div id="notificationFooter2"><a href="<?php echo base_url('dashboard/approverequest');?>"><i class="fa">See All</i></a></div>
                </div>
            </li>
            <li style="margin-top: -1%">
                <form class="visible-md-block visible-lg-block navbar-form" role="search" action="<?php echo base_url('dashboard/searchIn')?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Job, Company, Location" name="keyword" required="required"><div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </li>
        <?php } ?>

        <li><div class="circle" style="background-image: url('<?php echo base_url('assets/images/kick.png'); ?>'); "></div>
            <!--<a href="<?php /*echo base_url('dashboard/index'); */?>"><i class="fa"><?php /*echo $this->session->userdata('username'); */?></i></a>-->
                <ul>
                    <li><a href="<?php echo base_url('dashboard/myProfile'); ?>"><i class="fa">My Profile</i></a></li>
                    <li><a href="<?php echo base_url('dashboard/signout'); ?>"><i class="fa">Sign Out</i></a></li>
                </ul>
            <?php } else { ?>
                <form name="userlogin" id="userlogin" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/login'); ?>">
                    <div class="col-sm-2 fr">
                        <input type="submit" value="Sign In" tabindex="3" class="signin_btn" />
                        <a href="" class="btn btn-danger">Forgot Password</a>
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
        </li>
    </ul>
</div>
<div class="dash-wrap">
    <div class="dash-container">
        <div class="dash-header">
            <div class="dash-logo"><img style="padding-left:43px;" src="<?php echo base_url('assets/images/logo.png');?>" alt=""></div>
                <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
                    <div class="drop" style="float: right; margin-right:20px; margin-top: 1.5%; background-color: #16A085; width: auto; padding: 5px; 	border: 2px;">
                        <div class="circle" style=" float: left; background-image: url('<?php echo base_url('assets/images/kick.png'); ?>'); "></div>
                        <ul class="drop_menu">
                            <li><a href="<?php echo base_url('dashboard/index'); ?>"><?php echo $this->session->userdata('username'); ?></a>
                                <ul class="header-margin">
                                    <li><a href="<?php echo base_url('dashboard/myProfile'); ?>">My Profile</a></li>
                                    <!-- <li><a href="javascript:void(0);">Messages</a></li>
                                    <li><a href="javascript:void(0);">Settings</a></li> -->
                                    <li><a href="<?php echo base_url('dashboard/signout'); ?>">Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <form name="userlogin" id="userlogin" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/login'); ?>">
                        <div class="col-sm-2 fr">
                            <input type="submit" value="Sign In" tabindex="3" class="signin_btn" />
                            <a href="" class="btn btn-danger">Forgot Password</a>
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
            <div class="clear"></div>
            <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
            <div class="drop">
                <ul class="drop_menu">
                    <li><a href='<?php echo base_url('dashboard/index');?>'>Home</a></li>
                    <!--<li><a href='javascript:void(0);'>Vendors</a></li>-->
                    <li><a href="<?php echo base_url('dashboard/myposts');?>">Jobs</a>
                        <ul>
									<li><a href="<?php echo base_url('dashboard/myposts');?>">My Jobs Posts</a></li>                            
                            <li><a href="<?php echo base_url('dashboard/addpost');?>">Post a job</a></li>
                            <li><a href="<?php echo base_url('dashboard/joblist');?>">All Jobs Posts</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url('dashboard/myCandidates');?>">Candidates</a>
                        <ul>
									<li><a href="<?php echo base_url('dashboard/myCandidates');?>">My Candidates</a></li>                            
                            <li><a href="<?php echo base_url('dashboard/addCandidate') ?>">Add a Candidate</a></li>
                        </ul>
                    </li>
                    <?php   $userDetails = $this->session->userdata('userLoginDetails');
                            $contact_type_id = $userDetails->contacttypeid;
                            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) { ?>
                    <li><a href="<?php echo base_url('dashboard/connections');?>">Connections</a>
                        <ul>
                            <li><a href="<?php echo base_url('dashboard/connections');?>">My Connections</a></li>
                            <!--<li><a href="<?php /*echo base_url('dashboard/request');*/?>">Send a Request</a> </li>-->
                            <li><a href="<?php echo base_url('dashboard/approverequest');?>">Pending Requests</a> </li>
                            <li><a href="<?php echo base_url('dashboard/sentrequest');?>">Sent Requests</a> </li>
                            <li><a href="<?php echo base_url('dashboard/empByMap');?>">Employers by region</a> </li>
                        </ul>
                    </li>
                    <li id="notification_li">
                        <span id="notification_count" style="display: none"></span>
                        <a href="#" id="notificationLink" ><i class="fa fa-globe"> </i> Notifications</a>
                        <div id="notificationContainer">
                            <div id="notificationTitle">Notifications</div>
                            <div id="notificationsBody" class="notifications">
                            </div>
                            <div id="notificationFooter"><a href="<?php echo base_url('dashboard/approverequest');?>">See All</a></div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
                <div class="visible-md-block visible-lg-block" style="float:right; margin-top: -0.35%;">
                    <form class="navbar-form" role="search" action="<?php echo base_url('dashboard/searchIn')?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Job, Company, Location" name="keyword" required="required">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
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
<script>
    var num = 52; //number of pixels before modifying styles
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > num) {
            $('.dropStick').addClass('fixed');
        } else {
            $('.dropStick').removeClass('fixed');
        }
    });
</script>