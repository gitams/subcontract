<h3 style="text-align: center"><a href="<?php echo base_url('/dashboard/candidatesList').'/'.$profile[0]->accountid;?>"><label><?php echo strtoupper($profile[0]->accountname); ?></label></a></h3>
<style>
    #pp {
        width: 200px;
        height: 250px;
    }
</style>
<div style=" padding-top: 4px;">
    
    <script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>
    <!--<h3 style="text-align: center; margin-top: 3px;"><label>Your Connections & All Other Jobs</label></h3><hr/>-->
    <?php   $userDetails = $this->session->userdata('userLoginDetails');
    $accountId = $userDetails->accountid;
    //print($accountId);
    //print'<pre>';print_r($jobs); exit;
    echo $this->session->flashdata('suc_msg');?>
    <ul class="tabs" data-persist="true">
        <li><a href="#view1">Main Details</a></li>
        <li><a href="#view2">Social links</a></li>
        <li><a href="#view3">Services</a></li>
        <li><a href="#view4">Company Est</a></li>
    </ul>
    <div class="tabcontents" style="padding:0px;">
        <div id="view1">
            <?php //print'<pre>'; print_r($profile); print'</pre>'; ?>
            <div class="user">
                <div class="col-md-10">
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">User Type : </td><td style="border: 0"><?php if($profile[0]->accounttype == 1) {echo " Super Admin "; }?>
                        <?php if($profile[0]->accounttype == 2) {echo " Employer "; }?>
                        <?php if($profile[0]->accounttype == 3) {echo " Recruiter "; }?>
                        <?php if($profile[0]->accounttype == 4) {echo " user "; }?></td> </tr>
                        <tr> <td style="border: 0">Industry : </td><td style="border: 0"><?php echo $profile[0]->industry_name; ?></td> </tr>
                        <tr> <td style="border: 0">Email: </td><td style="border: 0"><strong><?php echo $profile[0]->username; ?></td> </tr>
                        <tr> <td style="border: 0">Mobile: </td><td style="border: 0"><strong>+1 - <?php echo $profile[0]->phonenumber; ?></td> </tr>
                        <tr> <td style="border: 0">Location:</td><td style="border: 0"> <?php echo $profile[0]->locationname; ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="view2" style="min-height: 200px;">
            <?php //print'<pre>'; print_r($social); print'</pre>'; ?>
            <?php if(isset($social) && (!empty($social))) {?>
            <div class="user">
                <div class="col-md-10">
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Facebook </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_facebook; ?></a></td> </tr>
                        <tr> <td style="border: 0">Google Plus  </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_google; ?></a></td> </tr>
                        <tr> <td style="border: 0">Twitter </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_twitter; ?></a></td> </tr>
                        <tr> <td style="border: 0">Linked In </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_linkedin; ?></a></td> </tr>
                        <tr> <td style="border: 0">Website </td><td style="border: 0"><a href="javascript: void(0);"><?php echo $social[0]->asu_website; ?></a></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else {?>
                <h3> No Details found</h3>
            <?php }?>
        </div>
        <div id="view3" style="min-height: 200px;">
            <?php //print'<pre>'; print_r($services); print'</pre>'; ?>
            <?php if(isset($services) && (!empty($services))) {?>
            <div class="user">
                <div class="col-md-10">
                    <strong> <a href="javascript: void(0);"> <?php echo $profile[0]->accountname; ?></a> </strong>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Doing Services in </td><td style="border: 0"><?php echo $services[0]->as_service;?></td> </tr>
                        <tr> <td style="border: 0">Expert In </td><td style="border: 0"><?php echo $services[0]->as_expertise;?></td> </tr>
                        <tr> <td style="border: 0">Major client is </td><td style="border: 0"><?php echo $services[0]->as_client; ?></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else {?>
                <h3> No Details found</h3>
            <?php }?>
        </div>
        <div id="view4" style="min-height: 200px;">
            <?php //print'<pre>'; print_r($company); print'</pre>'; ?>
            <?php if(isset($company) && (!empty($company))) {?>
            <div class="user">
                <div class="col-md-10">
                    <strong> <a href="javascript: void(0);"> <?php echo $profile[0]->accountname; ?></a> </strong>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Established date </td><td style="border: 0"><?php echo $company[0]->ac_est_date;?></td> </tr>
                        <tr> <td style="border: 0">Current revenue per year </td><td style="border: 0"><?php echo $company[0]->ac_ann_revenue;?></td> </tr>
                        <tr> <td style="border: 0">Total Employees </td><td style="border: 0"><?php echo $company[0]->ac_num_emp; ?></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else {?>
                <h3> No Details found</h3>
            <?php }?>
        </div>
    </div>
</div>