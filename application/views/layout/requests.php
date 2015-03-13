<?php //print_r($requests);exit;?>
<?php if(isset($requests) && (!empty($requests))) { foreach ($requests as $request) { ?>
    <div class="col-lg-12">
        <div class="col-md-6">
           <a href="javascript: void(0);" style="color: #3071A9;"><strong><?php echo $request->accountname;?></strong></a>
        </div>
        <div class="col-lg-6">
            <button name="approve" class="btn btn-success approveRequest" requestid="<?php echo $request->requestfrom; ?>">Accept</button>
            <button name="approve" class="btn btn-danger cancelRequest" requestid="<?php echo $request->requestto; ?>">Reject</button>
        </div>
    </div><?php //echo base_url('assets/images/logo.png');?>
<?php } } else { $found=0; } 

if(isset($resume_request) && !empty($resume_request)){
	if($resume_request[0]->countreq >0){
		echo 'You Have <a style="color:#3C5BAF;display:inline;" href="'.base_url('candidates/resumes_download').'">'.$resume_request[0]->countreq .' </a> Resume requests';
		$found++;
	}
	else{
		$found=0;
	}
}
if(isset($resume_accept) && !empty($resume_accept)){
	if($resume_accept[0]->countreq >0){
		echo 'You Have <a style="color:#3C5BAF;display:inline;" href="'.base_url('candidates/resumes_download').'">'.$resume_accept[0]->countreq .' </a> Resume Ready to dowload ';
		$found++;
	}
	else{
		$found=0;
	}
}
if(isset($resume_down) && !empty($resume_down)){
	if($resume_down[0]->countreq ==1){
		echo ' <a style="color:#3C5BAF;display:inline;" href="'.base_url('candidates/resumes_download').'">'.$resume_down[0]->countreq .' </a> Resume is dowloaded. ';
		$found++;
	}
	else if($resume_down[0]->countreq >1){
		echo ' <a style="color:#3C5BAF;display:inline;" href="'.base_url('candidates/resumes_download').'">'.$resume_down[0]->countreq .' </a> Resumes are dowloaded. ';
		$found++;
		
	}else{
		$found=0;
	}
}

if($found==0){?>
<div>
    <h4 style="padding: 0 0 0 10px;">No Requests Found</h4>
</div>
<?php }
?>

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