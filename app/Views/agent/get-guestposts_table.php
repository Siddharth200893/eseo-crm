<div id="replace_data">
    <?php echo view('agent/ajax-header') ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />
    <main class="content">

    </main>
    <div class="container-fluid p-0">
        <div class="wrapper_inner">
            <div class="row justify-content-md-center">
                <div class="col-12">
                    <h2>
                        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
                    </h2>
                    <div class="table-responsive" id="table_dat">
                        <span id="sale_result"></span>
                        <table id="contact_us_table" class="table default_table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-xl-table-cell">Date</th>
                                    <th class="d-xl-table-cell">Project Name</th>
                                    <th class="d-xl-table-cell">Blogger Name</th>
                                    <th class="d-xl-table-cell">Link</th>
                                    <th class="d-xl-table-cell">Amount</th>
                                    <th class="d-xl-table-cell">Payment Status</th>
                                    <th class="d-xl-table-cell">Currency</th>
                                    <th class="d-xl-table-cell">Payment Mode</th>
                                    <th class="d-xl-table-cell">Payee Number</th>
                                    <th class="d-xl-table-cell">Reference No.</th>
                                    <th class="d-xl-table-cell">Payee Email</th>
                                    <th class="d-xl-table-cell">Agent Name</th>
                                    <th class="d-xl-table-cell">Flag</th>
                                    <th class="d-xl-table-cell">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_table_body">
                                <?php
                                $session = session();
                                foreach ($guest_posts as $guestpost) : ?>
                                    <tr class="<?php echo $guestpost['is_flag'] == 1 ? "highlight_flag" : ""  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "" ?> <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending" ?> <?php echo $session->get('some_name') == $guestpost['id'] ? "highlight" : "" ?>">
                                        <td class="d-xl-table-cell td_date"><?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?></td>
                                        <td class=""><?php echo $guestpost['project_name']; ?></td>
                                        <td class=""><?php echo $guestpost['blogger_name']; ?></td>
                                        <td class="d-xl-table-cell "><?php echo $guestpost['link']; ?></td>
                                        <td class="d-xl-table-cell range "><?php echo $guestpost['amount']; ?></td>
                                        <td class="d-xl-table-cell "><?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?></td>
                                        <td class="td_currency"><?php echo $guestpost['currency_name']; ?></td>
                                        <td class="td_pmt_mode"><?php echo $guestpost['payment_mode']; ?></td>
                                        <td class="td_pmt_mode"><?php echo $guestpost['payee_number']; ?></td>
                                        <td class="d-xl-table-cell "><?php echo $guestpost['reference_number']; ?></td>
                                        <td class="d-xl-table-cell "><?php echo $guestpost['payee_email']; ?></td>
                                        <td class="d-xl-table-cell td_username"><?php echo $guestpost['username']; ?></td>
                                        <td class="d-xl-table-cell td_username">
                                            <button type="button" class="check btn btn-success " value="" onclick="change_flag(<?php echo $guestpost['is_flag'] ?>,<?php echo $guestpost['id']; ?>, this)">
                                                <?php echo $guestpost['is_flag'] == 1 ? '<i class="fa fa-flag" aria-hidden="true"></i>' : '<i class="fa fa-flag-o" aria-hidden="true"></i>'; ?>
                                            </button>
                                        </td>

                                        <td class="d-xl-table-cell"><a class="sidebar-link edit-gp-btn <?php echo $guestpost['payment_approvel'] == 1 ? "edited" : ""  ?>" href="<?= base_url('agent/edit-guestpost/') . md5($guestpost['id']); ?>"><?php echo $guestpost['payment_approvel'] == 1 ? "Edited" : "Edit" ?></a></td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="pagination_new"><?= $pager->links() ?></div>
    <div id="pagination-container"></div>
    <?php echo view('agent/footer') ?>
</div>
</main>
<div id="pagination-container"></div>






</body>
</php>