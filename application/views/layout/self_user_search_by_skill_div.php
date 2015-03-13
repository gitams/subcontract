
<?php if(isset($search) && !empty($search)) { ?>
    <h2 style="text-align: center"><label>Results</label></h2>
    <?php foreach($search as $key=>$result) { ?>
        <div class="user">
            <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
            <div class="col-md-10">
                <table class="table table-striped" >
                    <tbody>
                    <tr><td style="border: 0px"><h4 style="color: #1D7FB0"><?php echo $result->post_title;?></h4></td></tr>
                    <tr> <td style="border: 0px"><i class="fa fa-envelope"></i>&nbsp; <?php echo $result->post_description;?></td> </tr>
                    <tr> <td style="border: 0px">
                            <i class="fa fa-book"></i>&nbsp; <?php echo $result->accountname;?>
                            <i class="fa fa-map-marker"></i>&nbsp; <?php echo $result->cityname;?>
                            <i class="fa fa-bookmark"></i>&nbsp; <?php echo $result->skillname;?>
                            <i class="fa fa-calendar-o"></i>&nbsp;  <?php echo $result->createddate;?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="height: 5px;"></div>
    <?php } } else {?>
    <h4>No  Job Results Found </h4>
<?php }?>