
<?php if(isset($requests) && (!empty($requests))){ foreach ($requests as $request) { ?>
    <div class="row postBlock">
        <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8">
            <strong><a href="javascript: void(0);"><?php echo $request->accountname; ?></a></strong>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
            <button name="approve" class="btn btn-success approveRequest" requestid="<?php echo $request->requestfrom; ?>">Approve</button>
            <button name="approve" class="btn btn-danger cancelRequest" requestid="<?php echo $request->requestto; ?>">Cancel Request</button>
        </div>
    </div>
<?php } }else {?>
<div><h4>No Notifications Found</h4></div>
<?php }?>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.approveRequest', function () {
            $(this).addClass('test');
            $.ajax({
                url: '<?php echo base_url('dashboard/updaterequest');?>',
                method: "POST",
                data: {'id': $(this).attr('requestid'), 'typeid': '1', 'csrf': Math.round(Math.random() * 10000000)},
                datatype: 'html',
                success: function (data) {
                    alert(data);
                    $('.test').parent().parent().remove();
                }
            })
        });
        $(document).on('click', '.cancelRequest', function () {
            $(this).addClass('cancelled');
            $.ajax({
                url: '<?php echo base_url('dashboard/updaterequest');?>',
                method: "POST",
                data: {'id': $(this).attr('requestid'), 'typeid': '2', 'csrf': Math.round(Math.random() * 10000000)},
                datatype: 'html',
                success: function (data) {
                    alert(data);
                    $('.cancelled').parent().parent().remove();
                }
            })
        });
    });
</script>