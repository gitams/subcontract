<?php //print'<pre>';print_r($ymkMoreList);
if((isset($ymkMoreList)) && (!empty($ymkMoreList))) { ?>
    <?php $i = 1; foreach($ymkMoreList as $ymk) {
        if($i==10) break;?>
        <div class="col-md-6" style="margin-bottom: 15px;">
            <div class="col-md-3"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
            <div class="col-md-9">
                <div style="margin-left: 10px">
                    <h4 style="color: #1D7FB0"><?php echo $ymk->accountname; ?></h4>
                    <i class="fa fa-flag"></i>&nbsp; <?php echo $ymk->iname; ?>
                </div>
                <div style="float:right;">
                    <input type="button" class="btn btn-success" style="margin-left: 8px; height: 32px;" id="<?php echo $ymk->accountid;?>" value="Connect" onclick="connect(this.id)">
                </div>
            </div>
        </div>
    <?php $i++;} } else {?>
    <h5>Not Connected to Any One Yet</h5>
    <a href="<?php echo base_url('dashboard/request');?>" class="btn btn-primary">Send A Request</a>
<?php } ?>
<script type="text/javascript">
    function connect(id)
    {
        //alert(id);
        $.ajax({
            url: "<?php echo base_url('dashboard/sendarequestFromSearch')?>",
            type: "POST",
            data: {'accountid' : id, 'rand': Math.round(Math.random() * 100000000)},
            dataType: 'html',
            error: function(data){
                alert(data);
            },
            success:function(data){
                //alert(data);
                document.getElementById(id).value="Requested";
                document.getElementById(id).disabled = true;
                location.reload(true);
            }
        });
        return false;
    }
</script>
