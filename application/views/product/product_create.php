<?php $this->load->view('layout/header'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" name="frmAdd" action="" enctype="multipart/form-data">
                <h3>Create Product</h3>
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" name="productname" id="productname">
                </div>


                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="img" id="img">
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" id="description">
                </div>
                <div class="form-group">
                    <label for="">Category Name</label>
                    <select class="form-select" id="cat_select">
                        <option value="0" selected>select category </option>
                        <?php
                        foreach ($all_category as $key => $value) {
                        ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['category_name']; ?> </option>
                        <?php
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sub Category Name</label>
                    <select class="form-select" id="subcat_select">
                        <option value="0" selected>select sub category </option>
                        <?php
                        foreach ($all_category as $key => $value) {
                        ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['category_name']; ?> </option>
                        <?php
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" id="submit_btn" value="Add Product" name="btnadd" class="btn btn-primary btn-lg">
                </div>

            </form>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#cat_select').on('change', function() {
        var selectVal = $("#cat_select option:selected").val();
        if (selectVal == 0) {
            alert("Please select category proper");
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>product/getsubcategory",
                data: {
                    'selectVal': selectVal
                },
                cache: false,
                success: function(data) {
                    var res = JSON.parse(data);
                    if (res.status == 0) {
                        alert(res.msg);
                        var opt = '<option value="0">select sub category </option>';
                        $("#subcat_select").html(opt);
                    }
                    if (res.status == 1) {
                        // alert(res.msg);
                        subcat_array = res.results[0]['id'];
                        // var element = '';
                        // var subcat_ele = '';
                        var opt = '<option value="0">select sub category </option>';
                        if (subcat_array.length != 0) {
                            for (let i = 0; i <= subcat_array.length; i++) {
                                // subcat_ele = subcat_array[i];
                                opt += '<option value=' + res.results[i]['id'] + '>' + res.results[i]['product_sub_category_name'] + '</option>';

                            }
                        }
                        $("#subcat_select").html(opt);
                    }
                }
            });
        }

    });
    $("#submit_btn").on("click", function(e) {
        e.preventDefault();
        var productname = $('#productname').val();
        var description = $('#description').val();
        var category_id = $('#cat_select').val();
        var subcategory_id = $('#subcat_select').val();
        var file = document.getElementById("img");
        if (productname == '' || productname == null) {
            alert(" Product name requerid ");
            return false;
        }
        if (file.files.length == 0) {
            alert("please select file")
            return false;
        }
        if (category_id == 0) {
            alert(" please select category name ");
            return false;
        }

        if (subcategory_id == 0) {
            alert(" please select sub category name ");
            return false;

        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>product/check_unique",
            data: {
                'productname': productname,
                'description': description,
                'category_id': category_id,
                'subcategory_id': subcategory_id
            },
            cache: false,
            success: function(data) {
                var res = JSON.parse(data);
                if (res.status == 0) {
                    alert(res.msg);
                }
                if (res.status == 1) {
                    alert(res.msg);
                    window.location.href = '<?php echo base_url(); ?>product';
                }
            }
            // return false;
        });

    });
</script>