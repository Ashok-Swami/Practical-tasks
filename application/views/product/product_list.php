<?php $this->load->view('layout/header'); ?>
<div class="contener">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2>List of Product</h2>
            <a href="<?php echo base_url(); ?>product/create_product" class="btn btn-primary btn-lg center" role="button" aria-pressed="true">Add Product</a>
            <br>
            <br>
            <table class="table table-bordered example" id="example">
                <thead>
                    <tr>
                        <td>Product Name</td>
                        <td>Description</td>
                        <!-- <td>image</td> -->
                        <td>Sub Category Name</td>
                        <td>Category Name</td>
                        <td>Last_Updated_Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($allcategory)) {
                        foreach ($allcategory as $cat => $value) {
                        // print_r($value);

                    ?>

                            <tr>
                            <td><?php echo $value['product_name']; ?></td>
                            <td><?php echo $value['description']; ?></td>
                            <!-- <td><?php echo $value['image']; ?></td> -->
                            <td><?php echo $value['product_sub_category_name']; ?></td>
                            <td><?php echo $value['category_name']; ?></td>
                            <td><?php echo $value['last_updated_date']; ?></td>
                            <td><a href="<?php echo base_url(); ?>product/edit/<?php echo $value['id']; ?>">Edit</a> <a href="<?php echo base_url(); ?>product/delete/<?php echo $value['id']; ?>">Delete</a></td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr class="text-center">
                            <td colspan="4">records not foudns</td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-2"></div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#example").DataTable();
    });
</script>
<?php $this->load->view('layout/footer'); ?>