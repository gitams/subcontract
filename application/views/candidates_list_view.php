<h3 style="text-align: center; margin-top: 3px;"><label>My Candidates</label></h3><hr/>
<style>
    .canCircle
    {
        width:100px;
        height:100px;
        border-radius:40px;
        font-size:15px;
        color:#fff;
        text-align:center;
        background:#257AB1;
    }
	.canCirclegreen
    {
        width:100px;
        height:100px;
        border-radius:40px;
        font-size:15px;
        color:#fff;
        text-align:center;
        background:rgb(22,160,133);
    }
    .capitalize {
        text-transform: capitalize;
    }
	.fe {
		display: none; /* Hide button */
		/*position: absolute;
         right: 2%;*/
	}
	.vendors2:hover .fe{
		display: block; /* On :hover of div show button */
	}
</style>
<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($cans); exit; ?>
    <p style="color: #006600"><?php echo $this->session->flashdata('suc_msg'); ?> </p>
    <?php if((isset($cans)) && (!empty($cans))) {
        foreach ($cans as $can) {
        if($accountId = $can->can_account_id) { ?>
            <div class="col-sm-12 vendors2" style="width: 100%;">
                <div class="">
                    <i class="fa fa-user"></i>
                    <strong>
                        <a class="canBox capitalize">
                            <?php echo $can->can_first_name." " .$can->can_last_name; ?>
                        </a>
                    </strong>
                </div>
                <div>
					<?php
						$applyCSS = "canCircle";
						if($can->is_can_placed == 1)
						{
							$applyCSS = "canCirclegreen";
						}
					?>
                    <div id="circle_<?php echo $can->can_id; ?>" class="<?php echo $applyCSS; ?> col-sm-6" style="margin-top: 10px;">
						<div style="padding-top: 20px;">
							<?php echo $can->skillname; ?><br/><?php echo $can->can_current_exp_years . " + Years "; ?>
						</div>
					</div>
                    <div  class="col-sm-9" >
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td style="border:0;"><i class="fa fa-flag"> </i> <?php echo $can->can_current_org; ?></td>
                                <td style="border:0;"><i class="fa fa-bookmark"> </i> <?php echo $can->can_emp_type. "(".$can->can_work_type .")"; ?></td>
                                <td style="border:0;"><i class="fa fa-star"></i> <?php echo $can->skillname; ?></td>
                                <td style="border:0;"><i class="fa fa-calendar-o"> </i> <?php echo $can->can_current_exp_years . " + Years "; ?></td>
                            </tr>
                            <tr>
                                <td style="border:0;"><i class="fa fa-money"></i> <?php echo $can->can_current_ctc; ?></td>
                                <td style="border:0;"><i class="fa fa-file-word-o"></i> <?php echo $can->can_resume; ?></td>
                                <td style="border: 0;"><i class="fa fa-inbox"></i> <?php echo $can->can_email; ?></td>
								<td style="border:0;"><i class="fa fa-graduation-cap"></i> <?php echo $can->can_high_edu; ?></td>

                            </tr>
                            <tr>
                                <td style="border:0;"><i class="fa fa-star-half-o"></i> <?php echo $can->can_other_skill_1. ", " . $can->can_other_skill_2; ?></td>
                                <td style="border:0;"><i class="fa fa-map-marker"></i> <?php echo $can->can_location; ?></td>
								<td style="border:0;"><i class="fa fa-phone-square"></i> <?php echo $can->can_mobile;?></td>
                                <td style="border:0;"><!--<a href="<?php /*echo base_url('dashboard/editCandidate')."/".$can->can_id */?>" class="btn btn-primary" style="height: 30px;">Edit</a>--><!--<a href="<?php /*echo base_url('dashboard/deleteCandidate')*/?>" class="btn btn-danger" style="height: 30px;">Delete</a>--></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
					<div>
						<p id="msgDIV" class="hidden" style="color:red;"></p>
						<?php
							if($can->is_can_placed == 1)
							{
								$textVal = "Add To Bench";
								$changeVal = 0;
							}
							else
							{
								$textVal = "Place";
								$changeVal = 1;
							}
						?>
						<input class="btn btn-primary" type="button" val_att="<?php echo $changeVal; ?>" id="button_placed_<?php echo $can->can_id;?>" value="<?php echo $textVal ;?>" onclick="changePlaced(<?php echo $can->can_id; ?>);"/>
						<div class="fe"><a class="btn btn-warning" href="<?php echo base_url("dashboard/editCandidate")."/".$can->can_id; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></div>
						<span class="hidden" id="loading_<?php echo $can->can_id; ?>">Updating...</span>
					</div>
                </div>
            </div>
            <!--<div style="background-color: #595959; height: 1px;" ></div>-->
        <?php   } } } else { ?>
        <div class="vendors2" style="width: 100%;">
            <h4>No Candidates Added Yet</h4>
            <a href="<?php echo base_url('dashboard/addCandidate');?>" class="btn btn-primary"> Click to Add A Candidate</a>
        </div>
        <?php }?>
		<script>
			function changePlaced(canID)
			{
				var val = $("#button_placed_"+canID).attr('val_att');
				var parms= "val="+val+"&canID="+canID;
				$("#loading_"+canID).show();
				$.ajax({
				   type: "POST",
				   url: "<?php echo base_url('dashboard/changePlaced'); ?>",
				   dataType: "json",
				   data: parms,
				   success: function(json){
					   $("#loading_"+canID).hide();
						if(json.status=="success")
						{
							$("#msgDIV").html("Updated Successfully");
							$("#circle_"+canID).removeClass("canCircle");
							$("#circle_"+canID).removeClass("canCirclegreen");
							if(val != 1)
							{
								$("#circle_"+canID).addClass("canCircle");
								$("#button_placed_"+canID).val("Place");
								$("#button_placed_"+canID).attr('val_att',1)
							}
							else
							{
								$("#circle_"+canID).addClass("canCirclegreen");
								$("#button_placed_"+canID).val("Add To Bench");
								$("#button_placed_"+canID).attr('val_att',0)
							}
						}
						else
						{
							$("#msgDIV").html("Could Not Be Updated");
							return false;
						}
					}
				});
			}
		</script>