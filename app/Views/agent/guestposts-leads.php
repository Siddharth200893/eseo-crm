<!DOCTYPE php>
<php lang="en">
    <?php $session = session(); ?>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <?php
            if ($session->getFlashdata('success_save')) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $session->getFlashdata('success_save'); ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <?php
            if ($session->getFlashdata('error_save')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $session->getFlashdata('error_save'); ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php echo view('agent/header') ?>
    <main class="content">
        <div class="container-fluid p-0">
            <div class=" row justify-content-md-center">
                <div class="col-12">
                    <h2>
                        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
                    </h2>
                    <div class="add_btninfos">
                        <a class="badge bg-success" href="<?= base_url('agent/guest-posting') ?>" style="text-decoration:none;">Add Guestpost</a>
                    </div>
                    <table id="" class="table default_table  table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-xl-table-cell">Date</th>
                                <th class="d-xl-table-cell">Project Name</th>

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
                                <tr class="<?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "Approve"  ?>">
                                    <td class="d-xl-table-cell"><?php echo date("F j, Y, g:i a", strtotime($guestpost['created_at'])); ?></td>
                                    <td class="td_project_name" data-td_project_name="<?php echo $guestpost['project_name']; ?>"><?php echo $guestpost['project_name']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['link']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['amount']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['currency_name']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['payment_mode']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?></td>



                                    <td class="d-xl-table-cell  ">
                                        <?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "Pending"  ?>



                                    </td>
                                    <td class="d-xl-table-cell"><a class="sidebar-link edit-gp-btn <?php echo $guestpost['payment_approvel'] == 1 ? "edited" : ""  ?>" href="<?= base_url('agent/edit-guestpost/') . md5($guestpost['id']); ?>"><?php echo $guestpost['payment_approvel'] == 1 ? "Edited" : "Edit"  ?></a></td>




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