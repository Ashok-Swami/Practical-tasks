<?php $this->load->view('layout/header');?>
<div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form method="post" name="frmAdd" action="">
                    <h3>Create Category</h3>

                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" name="category_name" id="category_name">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" id="description">
                    </div>
                    
                    <br>
                    <div class="form-group">
                        <input type="submit" id="submit_btn" value="Add Category" name="btnadd" class="btn btn-primary btn-lg">
                    </div>

                </form>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $("#submit_btn").on("click", function(e) {
        e.preventDefault();
        var category_name = $('#category_name').val();
        var description = $('#description').val();
        if (category_name == '' || category_name == null) {
            alert("category name requerid ");
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>category/check_unique",
                data: { 'category_name':category_name,'description':description},
                cache: false,
                success: function(data) {
                    var res = JSON.parse(data);
                    if(res.status==0){
                        alert(res.msg);
                    }
                    if(res.status==1){
                        alert(res.msg);
                        window.location.href = '<?php echo base_url();?>category/index';
                    }
                }

                // return false;
            });
    


    }
    });
</script>