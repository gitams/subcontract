<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="register_form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <h2 style="text-align: center"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;&nbsp;<label>Job Details</label></h2>
                                <?php //print'<pre>'; print_r($resultJob[0]); exit;
                                if(isset($resultJob) && (!empty($resultJob))) {?>
                                    <div class="user">
                                        <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
                                        <div class="col-md-10">
                                            <strong> <a href="javascript: void(0);"> <?php echo $resultJob[0]->post_title; ?></a><p style="color: #16A085"><small>Posted By <?php echo $resultJob[0]->accountname; ?></small></p> </a> </strong>
                                            <table class="table table-striped" style="margin-top: 15px;">
                                                <?php //$skillset = $skillsObj->fetchJobSkills($job->post_id); ?>
                                                <tbody>
                                                <tr> <td style="border: 0"><?php echo $resultJob[0]->post_description; ?></td> </tr>
                                                <tr> <td style="border: 0">Salary Range: <strong><?php echo $resultJob[0]->ctc_from . '$ - ' . $resultJob[0]->ctc_to . '$ per' . " ".$resultJob[0]->rate; ?></strong> With <strong><?php echo $resultJob[0]->experience_from . '  '.' - '.$resultJob[0]->experience_to . ' Years '; ?></strong> Experience</td> </tr>
                                                <tr> <td style="border: 0">On <strong><?php echo $resultJob[0]->skillname;?></strong> at <?php echo $resultJob[0]->locationname; ?></td> </tr>
                                                <tr> <td style="border: 0">Date Posted : <?php echo $resultJob[0]->createddate; ?><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="float: right;">
                                            <a href="<?php echo base_url('');?>" class="btn btn-success">Login to Apply</a>
                                            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div>
                                        <strong>Something Wrong with your selected Job</strong>
                                        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>