<?php $this->load->view('layout/header');?>
<div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form method="post" name="frmAdd" action="">
                    <h3>Create sub Category</h3>

                    <div class="form-group">
                        <label for="">Sub Category Name</label>
                        <input type="text" class="form-control" name="category_name" id="category_name">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" id="description">
                    </div>
                    <div class="form-group">
                        <label for="">category Name</label>
                        <select class="form-select" id="cat_select">
                        <option value="0" selected>select category </option>
                            <?php
                                foreach ($all_category as $key => $value) {
                                ?>
                                 <option value="<?php echo $value['id'];?>"><?php echo $value['category_name']; ?> </option>
                                <?php
                                }?>  
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submit_btn" value="Add Sub Category" name="btnadd" class="btn btn-primary btn-lg">
                    </div>

                </form>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $("#submit_btn").on("click", function(e) {
        e.preventDefault();
        var subcategory_name = $('#category_name').val();
        var description = $('#description').val();
        var category_id = $('#cat_select').val();


        if (category_name == '' || category_name == null) {
            alert(" subcategory name requerid ");
        } else {
            if(category_id==0){
                alert(" please select category name ");
            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>subcategory/check_unique",
                data: { 'subcategory_name':subcategory_name,'description':description,'category_id':category_id},
                cache: false,
                success: function(data) {
                    var res = JSON.parse(data);
                    if(res.status==0){
                        alert(res.msg);
                    }
                    if(res.status==1){
                        alert(res.msg);
                        window.location.href = '<?php echo base_url();?>subcategory';
                    }
                }

                // return false;
            });
    


    }
    });
</script>