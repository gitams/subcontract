<style>
    .black_overlay{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 5px solid #16A085;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }

</style>
<?php $userDetails = $this->session->userdata('userLoginDetails');
    $accountId = $userDetails->accountid;
    $contactId = $userDetails->contactid;
?>
<?php   //print'<pre>'; print_r($resultJob[0]); exit;
        //print'<pre>'; print_r($cans); exit;
if(isset($resultJob) && (!empty($resultJob))) {?>
<div class="user">
    <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
    <div class="col-md-10">
        <strong> <a href="javascript: void(0);"> <?php echo $resultJob[0]->post_title; ?></a><p style="color: #16A085"><small>Posted By <?php echo $resultJob[0]->accountname; ?></small></p> </a> </strong>
        <table class="table table-striped" style="margin-top: 15px;">
            <?php //$skillset = $skillsObj->fetchJobSkills($job->post_id); ?>
            <tbody>
            <tr> <td style="border: 0px"><?php echo $resultJob[0]->post_description; ?></td> </tr>
            <tr> <td style="border: 0px">Salary Range: <strong><?php echo $resultJob[0]->ctc_from . '$ - ' . $resultJob[0]->ctc_to . '$ per' . " ".$resultJob[0]->rate; ?></strong> With <strong><?php echo $resultJob[0]->experience_from . '  '.' - '.$resultJob[0]->experience_to . ' Years '; ?></strong> Experience</td> </tr>
            <tr> <td style="border: 0px">On <strong><?php echo $resultJob[0]->skillname;?></strong> at <?php echo $resultJob[0]->locationname; ?></td> </tr>
            <tr> <td style="border: 0px">Date Posted : <?php echo $resultJob[0]->createddate; ?><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
            </tbody>
        </table>
    </div>
    <div style="float: right;">
        <!--<a href="<?php /*if($accountId != 1) {echo base_url('dashboard/applyJobByEmp')."/".$resultJob[0]->post_id.""."/".$resultJob[0]->accid;}
                        else { echo base_url('user_dashboard/applyJobByUser')."/".$resultJob[0]->post_id.""."/".$resultJob[0]->accid;}*/?>"
           class="btn btn-success">Apply</a>-->
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-warning">Apply</a>
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
    </div>
</div>
<?php } else { ?>

<div>
    <strong>Something Wrong with your selected Job</strong>
    <a href="javascript:history.back()" class="btn btn-primary">Back</a>
</div>
<?php } ?>





<!-- pop up window for edit section 1-->
<div id="light" class="white_content">
    <form action="<?php if($accountId != 1) {echo base_url('dashboard/applyJobByEmp')."/".$resultJob[0]->post_id.""."/".$resultJob[0]->accid;}
    else { echo base_url('user_dashboard/applyJobByUser')."/".$resultJob[0]->post_id.""."/".$resultJob[0]->accid;}?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        <?php if((isset($cans)) && (!empty($cans))) {
            foreach ($cans as $can) {
                if($accountId = $can->can_account_id) { ?>
                    <div class="col-sm-11" style="width: 80%; height: 40px; float: left;">
                            <div>
                                <input type="checkbox" name="cans[]" value="<?php echo $can->can_id;?>">
                                <i class="fa fa-user"></i>
                                <a class="canBox capitalize"><?php echo $can->can_first_name." " .$can->can_last_name; ?></a>
                            </div>
                        <div class="col-sm-12" style="font-size: smaller;">
                            <?php
                            $applyCSS = "canCircle";
                            if($can->is_can_placed == 1)
                            {
                                $applyCSS = "canCirclegreen";
                            }
                            ?>
                            <!--<table class="table table-hover">
                                <tbody>
                                <tr>-->
                                    <!--<td style="border:0;"><i class="fa fa-flag"></i> <?php /*echo $can->can_current_org; */?></td>-->
                                    <span style="border:0;"><i class="fa fa-star"></i> <?php echo $can->skillname; ?></span>
                                    <span style="border:0;"><i class="fa fa-calendar-o"> </i> <?php echo $can->can_current_exp_years . " Years " . $can->can_current_exp_months . " Months"; ?></span>
                                    <!--<td style="border: 0;"><i class="fa fa-inbox"></i> <?php /*echo $can->can_email; */?></td>
                                <td style="border:0;"><i class="fa fa-star-half-o"></i> <?php /*echo $can->can_other_skill_1. ", " . $can->can_other_skill_2; */?></td>
                                <td style="border:0;"><i class="fa fa-phone-square"></i> <?php /*echo $can->can_mobile;*/?></td>-->
                                <!--</tr>
                                </tbody>
                            </table>-->
                        </div>
                    </div>
                    <!--<div style="background-color: #595959; height: 1px;" ></div>-->
                <?php   } } } else { ?>
            <div class="vendors2" style="width: 100%;">
                <h4>No Candidates Added Yet</h4>
                <a href="<?php echo base_url('dashboard/addCandidate');?>" class="btn btn-primary"> Click to Add A Candidate</a>
            </div>
        <?php }?>
        <div class="col-md-12" align="center">
            <input class="btn btn-success" type="submit" value="Apply this job" id="submit">
            <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" class="btn btn-danger">Close</a>
        </div>
    </form>
</div>
<div id="fade" class="black_overlay"></div>
<!-- End pop up window for edit section 1-->