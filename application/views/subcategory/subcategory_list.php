<?php $this->load->view('layout/header'); ?>
<div class="contener">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2>List of Product subCategories</h2>
            <a href="<?php echo base_url(); ?>subcategory/create_subcategory" class="btn btn-primary btn-lg center" role="button" aria-pressed="true">Add sub category</a>
            <br>
            <br>
            <table class="table table-bordered example" id="example">
                <thead>
                    <tr>
                        <td>Sub Category Name</td>
                        <td>Description</td>
                        <td>Category Name</td>
                        <td>Last_Updated_Date</td>
                        <td>Action</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($allcategory)) {
                        foreach ($allcategory as $cat => $value) {
                    ?>

                            <tr>
                                <td><?php echo $value['product_sub_category_name']; ?></td>
                                <td><?php echo $value['description']; ?></td>
                                <td><?php echo $value['category_name']; ?></td>
                                <td><?php echo $value['last_updated_date']; ?></td>
                                <td><a href="<?php echo base_url(); ?>subcategory/edit/<?php echo $value['id']; ?>">Edit</a> <a href="<?php echo base_url(); ?>subcategory/delete/<?php echo $value['id']; ?>">Delete</a></td>
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