
<?php if(isset($search) && !empty($search)) { ?>
    <?php //print'<pre>'; print_r($search);exit;?>
    <h2 style="text-align: center"><label>Results</label></h2>
    <?php foreach($search as $key=>$result) { ?>
        <div>
            <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
            <div class="col-md-4">
                <table class="table" >
                    <tbody>
                    <tr><td style="border: 0px"><h4 style="color: #1D7FB0"><?php echo $result->accountname;?></h4></td></tr>
                    <tr> <td style="border: 0px"><i class="fa fa-flag"></i>&nbsp; <?php echo $result->industry_name;?></td> </tr>
                    <tr> <td style="border: 0px">
                            <i class="fa fa-map-marker"></i>&nbsp; <?php echo $result->cityname;?>
                            <i class="fa fa-bookmark"></i>&nbsp; <?php echo $result->statename;?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } } else {?>
    <h4>No  Job Results Found </h4>
<?php }?>