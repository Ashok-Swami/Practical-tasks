<?php $this->load->view('layout/header'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" name="frmAdd" action="">
                <h3>Edit sub Category</h3>
                <div class="form-group">
                    <input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $allcategory[0]['id']; ?>">
                    <label for="">sub Category  Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo $allcategory[0]['product_sub_category_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="<?php echo $allcategory[0]['description']; ?>">
                </div>
                <div class="form-group">
                        <label for="">category Name</label>
                        <select class="form-select" id="cat_select">
                        <option value="0">select category </option>
                            <?php
                                foreach ($all_category as $key => $value) {
                                    if($value['id']== $allcategory[0]['product_category_no']){
                                        $sel="selected";
                                    }else
                                    {
                                        $sel="";  
                                    }
                                ?>
                                 <option value="<?php echo $value['id'];?>" <?php echo $sel ?> ><?php echo $value['category_name']; ?> </option>
                                <?php
                                }?>  
                        </select>
                    </div>
                <div class="form-group">
                    <input type="submit" id="update_btn" value="Update sub Category" name="update_btn" class="btn btn-primary btn-lg">
                </div>
            </form>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">
    $("#update_btn").on("click", function(e) {
        e.preventDefault();
        var subcategory_name = $('#category_name').val();
        var description = $('#description').val();
        var category_id = $('#cat_select').val();
        var subcategory_id = $('#subcategory_id').val();
        
        if (category_name == '' || category_name == null) {
            alert("category name requerid ");
        } else {
            if(category_id==0){
                alert(" please select category name ");
            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>subcategory/edit_data",
                cache: false,
                data: {
                    'subcategory_name':subcategory_name,'description':description,'category_id':category_id,'subcategory_id':subcategory_id
                },
                success: function(data) {
                    var res = JSON.parse(data);
                    if (res.status == 0) {
                        alert(res.msg);

                    }
                    if (res.status == 1) {
                        alert(res.msg);
                        window.location.href = '<?php echo base_url(); ?>subcategory';

                    }
                }
                // return false;
            });
        }
    });
</script>