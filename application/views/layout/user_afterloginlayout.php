
    <div class="dash-main">
        <div class="dash-left">
            <?php $this->load->view(strtolower($page)); ?>
        </div>
        <div class="dash-right">
            <?php require_once 'user_rightbar.php'; ?>
        </div>
    </div>
