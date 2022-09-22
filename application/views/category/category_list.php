<?php $this->load->view('layout/header'); ?>
<div class="contener">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2>List of Categories</h2>
            <a href="<?php echo base_url(); ?>category/create_category" class="btn btn-primary btn-lg center" role="button" aria-pressed="true">Add category</a>
            <br>
            <br>
            <table class="table table-bordered example" id="example">
                <thead>
                    <tr>
                        <td>Category Name</td>
                        <td>Description</td>
                        <td>Last_Updated_Date</td>
                        <td>Action</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($allcategory)) {
                        foreach ($allcategory as $cat) {
                    ?>

                            <tr>
                                <td><?php echo $cat['category_name']; ?></td>
                                <td><?php echo $cat['description']; ?></td>
                                <td><?php echo $cat['Last_Updated_Date']; ?></td>
                                <td><a href="<?php echo base_url(); ?>category/edit/<?php echo $cat['id']; ?>">Edit</a> <a href="<?php echo base_url(); ?>category/delete/<?php echo $cat['id']; ?>">Delete</a></td>
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