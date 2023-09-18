<!DOCTYPE php>
<php lang="en">

    <?php echo view('admin/header') ?>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row justify-content-md-center">
                <div class="col-12">
                    <!-- <h2>All Leads</h2> -->
                    <div class="add_btninfos">
                        <a class="badge bg-success" href="<?= base_url('admin/project') ?>" style="text-decoration:none;">Add Project</a>
                    </div>
                    <table id="businessTable" class="table tabledesign table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-xl-table-cell">Blogger Name</th>
                                <th class="d-xl-table-cell">Blogger Email</th>
                                <th class="d-xl-table-cell">Leads Count</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($leads_by_email as $lead) : ?>
                                <tr>
                                    <td class="d-xl-table-cell"><?php echo $lead['blogger_name']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['blogger_email']; ?></td>
                                    <td class="d-xl-table-cell"><a href="<?php echo base_url('admin/blogger-leads/') . $lead['blogger_email'] ?>"><?php echo "View (" . $lead['leads_count'] . ")" ?></a></td>







                                </tr>
                            <?php
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination_new"><?= $pager->links() ?></div>
    </main>

    <?php echo view('admin/footer') ?>

    </body>

</php>