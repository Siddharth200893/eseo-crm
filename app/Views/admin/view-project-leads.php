<!DOCTYPE php>
<php lang="en">

    <?php echo view('admin/header') ?>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row justify-content-md-center">
                <div class="col-12">
                    <!-- <h2>All Leads</h2> -->
                    <div class="add_btninfos">
                        <a class="badge bg-success" href="<?= base_url('admin/add-project') ?>" style="text-decoration:none;">Add Project</a>
                    </div>
                    <table id="businessTable" class="table tabledesign table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-xl-table-cell">Date</th>
                                <th class="d-xl-table-cell">Agent Name</th>
                                <th class="d-xl-table-cell">Link</th>

                                <th class="d-xl-table-cell">Amount</th>
                                <th class="d-xl-table-cell">Payment Status</th>
                                <th class="d-xl-table-cell">Currency</th>
                                <th class="d-xl-table-cell">Payment Mode</th>
                                <th class="d-xl-table-cell">Reference No.</th>
                                <th class="d-xl-table-cell">Payment Approvel</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($projects_leads as $lead) : ?>
                                <tr>
                                    <td class="d-xl-table-cell"><?php echo date("F j, Y", strtotime($lead['created_at'])); ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['user_name']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['link']; ?></td>

                                    <td class="d-xl-table-cell"><?php echo $lead['amount']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['payment_status'] == 1 ? "Completed" : "Pending"; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['currency']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['payment_mode']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['reference_number']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $lead['payment_approvel'] == 1 ? "Completed" : "Pending";; ?></td>





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