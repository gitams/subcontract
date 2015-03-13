<h3 style="text-align: center"><label>Your Team</label></h3><hr/>
<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($recs); exit;?>
<p style="color:#060"><?php echo $this->session->flashdata('suc_msg');?></p>
<p style="color:#d3d60e"><?php echo $this->session->flashdata('war_msg');?></p>
<p style="color:#bf0600"><?php echo $this->session->flashdata('err_msg');?></p>
<?php if((isset($recs)) && (!empty($recs))){
    foreach ($recs as $rec) { ?>
            <strong><a href="javascript: void(0);"><?php echo $rec->first_name. " ".$rec->last_name; ?></a></strong>
            <table class="table table-striped" style="margin-top: 15px;">
            <tbody>
            <tr>
                <td><strong>First Name:</strong></td>
                <td><?php echo $rec->first_name;?></td>
                <td><strong>Last Name:</strong></td>
                <td><?php echo $rec->last_name;?></td>
            </tr>
            <tr>
                <td><strong>Email/User Name:</strong></td>
                <td><?php echo $rec->username; ?></td>
                <td><strong>Mobile:</strong></td>
                <td><?php echo $rec->phonenumber;?></td>
            </tr>
            <tr>
                <td><strong>Password</strong></td>
                <td><?php echo $rec->password;?></td>
                <td><!--<a href="<?php /*echo base_url('dashboard/editRec') */?>" class="btn btn-primary" style="height: 30px;">Edit</a>--></td>
                <td><!--<a href="<?php /*echo base_url('dashboard/addRec') */?>" class="btn btn-danger" style="height: 30px;">Delete</a>--></td>
            </tr>
            </tbody>
            </table>
            <div style="height: 10px;"></div>
        <?php    } } else {?>
        <h4>No recruiters Found</h4>
        <a href="<?php echo base_url('dashboard/addRec');?>" class="btn btn-primary">Click to Add a Recruiter</a>
        <?php } ?>