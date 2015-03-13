
    <div class="dash-main">
            <div class="dash-left">
                <?php $this->load->view(strtolower($page)); ?>
        </div>
        <div class="dash-right">
            <?php require_once 'right_bar_new.php'; ?>
        </div>
    </div>