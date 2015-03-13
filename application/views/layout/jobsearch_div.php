

    <?php //print'<pre>';print_r($jobs); exit;?>

        <?php if(isset($jobs) && !empty($jobs)) {
        foreach($jobs as $key=>$result) { ?>
            <li class="list-group-item">
                <div class="clearfix">
                    <div class="dummy-image pull-left"></div>
                        <div class="job-description pull-left">
                            <h4><?php //print'<pre>';print_r($result); exit;
                                echo $result->post_title;?></h4>
                            <?php   /*$today = date("Y-m-d");  $cdate = $jobs[$key]->createddate;
                                    $diff = date_diff($today,$cdate);
                                    echo $cdate; exit;*///print'<pre>';print_r($result); exit;
                            ?>
                            <p>
                                <small class="margin-right10"><i class="fa fa-envelope"></i>&nbsp;  <?php echo $result->accountname;?></small>
                                <small class="margin-right10"><i class="fa fa-map-marker"></i>&nbsp;  <?php echo $result->cityname;?></small>
                                <small><i class="fa fa-calendar-o"></i>&nbsp;  <?php echo $result->createddate;?></small>
                            </p>
                            <p><small><b>80</b> Applications Submitted</small></p>
                        </div>
                    <div class="pull-right job-desc-image freelance"></div>
                </div>
            </li>
        <?php } } ?>