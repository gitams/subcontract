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
<form action="<?php if($accountId != 1) {echo base_url('dashboard/applyJobByEmp')."/".$resultJob[0]->post_id.""."/".$resultJob[0]->accid;}
    else { echo base_url('user_dashboard/applyJobByUser')."/".$resultJob[0]->post_id.""."/".$resultJob[0]->accid;}?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
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
        <input class="btn btn-success" type="submit" value="Apply this job" id="submit">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
		
    </div>
	</form>
</div>
<?php } else { ?>

<div>
    <strong>Something Wrong with your selected Job</strong>
    <a href="javascript:history.back()" class="btn btn-primary">Back</a>
</div>
<?php } ?>