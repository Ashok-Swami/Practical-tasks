<?php $this->load->view('layout/header');?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" name="frmAdd" action="">
                <h3>Edit Category</h3>

                <div class="form-group">
                <input type="hidden" id="category_id" name="category_id" value="<?php echo $allcategory[0]['id']; ?>">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo $allcategory[0]['category_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="<?php echo $allcategory[0]['description']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" id="update_btn" value="Update Category" name="update_btn" class="btn btn-primary btn-lg">
                </div>

            </form>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $("#update_btn").on("click", function(e) {
        e.preventDefault();
        var category_name = $('#category_name').val();
        var description = $('#description').val();
        var id=$('#category_id').val();
        if (category_name == '' || category_name == null) {
            alert("category name requerid ");
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>category/edit_data",
                data: {
                    'category_name': category_name,
                    'description': description,
                    'category_id':id
                },
                cache: false,
                success: function(data) {
                    var res = JSON.parse(data);
                    if (res.status == 0) {
                    }
                    if (res.status == 1) {
                        window.location.href = '<?php echo base_url(); ?>category';

                    }
                    alert(res.msg);


                }

                // return false;
            });



        }
    });
</script>

<?php $this->load->view('layout/footer');?>