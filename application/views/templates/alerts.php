<?php if ($this->session->flashdata('success')) {?>
    <div id="flash-message" class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
    </div>

<?php } else if ($this->session->flashdata('error')) {?>

    <div id="flash-message" class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
    </div>

<?php } else if ($this->session->flashdata('warning')) {?>

    <div id="flash-message" class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
    </div>

<?php } else if ($this->session->flashdata('info')) {?>

    <div id="flash-message" class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
    </div>
<?php }?>

<script>
    $(document).ready (function(){
        $("#flash-message").fadeTo(2000, 500).slideUp(500);
    });
</script>