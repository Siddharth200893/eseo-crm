<!DOCTYPE php>
<php lang="en">

    <?php echo view('agent/header') ?>
    <main class="content">
        <div class="container-fluid p-0">
            <div class=" row justify-content-md-center">
                <div class="col-12">
                    <h2>
                        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
                    </h2>
                    <table id="" class="table default_table  table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-xl-table-cell">Date</th>
                                <th class="d-xl-table-cell">Link</th>
                                <th class="d-xl-table-cell">Amount</th>
                                <th class="d-xl-table-cell">Currency</th>
                                <th class="d-xl-table-cell">Payment Mode</th>
                                <th class="d-xl-table-cell">Payment Status</th>

                                <th class="d-xl-table-cell">Payment Approvel</th>
                                <th class="d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($guest_posts as $guestpost) : ?>
                                <tr class="<?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "Approve"  ?>">
                                    <td class="d-xl-table-cell"><?php echo date("F j, Y, g:i a", strtotime($guestpost['created_at'])); ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['link']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['amount']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['currency']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['payment_mode']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?></td>



                                    <td class="d-xl-table-cell"><button class="btn <?php echo $guestpost['payment_approvel'] == 1 ? "Approved badge bg-success" : "Approve badge bg-warning "  ?>" type="button"><?php echo $guestpost['payment_approvel'] == 1 ? " <i class='fa fa-check-square-o' aria-hidden='true'></i> Approved" : "Pending"  ?></button></td>
                                    <td class="d-xl-table-cell"><a class="sidebar-link edit-gp-btn <?php echo $guestpost['payment_approvel'] == 1 ? "edited" : ""  ?>" href="<?= base_url('agent/edit-guestpost/') . $guestpost['id']; ?>"><?php echo $guestpost['payment_approvel'] == 1 ? "Edited" : "Edit"  ?></a></td>




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
    <?php echo view('agent/footer') ?>

    </body>

</php>