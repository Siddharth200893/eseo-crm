<div id="replace_data">

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
                                    <th class="d-xl-table-cell">Payment Approvel</th>
                                    <th class="d-xl-table-cell">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_table_body">
                                <?php
                                foreach ($guestposts as $guestpost) : ?>
                                    <tr class="<?php echo $guestpost['is_flag'] == 1 ? "highlight_flag" : ""  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : ""  ?> <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?>">
                                        <td class="d-xl-table-cell td_date" data-td_date="<?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?>"><?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?></td>
                                        <td class="td_project_name" data-td_project_name="<?php echo $guestpost['project_name']; ?>"><?php echo $guestpost['project_name']; ?></td>
                                        <td class="td_blogger_name" data-td_blogger_name="<?php echo $guestpost['blogger_name']; ?>"><?php echo $guestpost['blogger_name']; ?></td>
                                        <td class="d-xl-table-cell td_link"><?php echo $guestpost['link']; ?></td>
                                        <td class="d-xl-table-cell range td_amount"><?php echo $guestpost['amount']; ?></td>
                                        <td class="d-xl-table-cell td_pmt_status" data-td_pmt_status="<?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?>"><?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?></td>
                                        <td class="td_currency" data-td_currency="<?php echo $guestpost['currency_name']; ?>"><?php echo $guestpost['currency_name']; ?></td>
                                        <td class="td_pmt_mode" data-td_pmt_mode="<?php echo $guestpost['payment_mode']; ?>"><?php echo $guestpost['payment_mode']; ?></td>
                                        <td class="td_pmt_mode" data-td_pmt_mode="<?php echo $guestpost['payee_number']; ?>"><?php echo $guestpost['payee_number']; ?></td>
                                        <td class="d-xl-table-cell td_reference_number"><?php echo $guestpost['reference_number']; ?></td>
                                        <td class="d-xl-table-cell "><?php echo $guestpost['payee_email']; ?></td>

                                        <td data-username="<?php echo $guestpost['username']; ?>" class="d-xl-table-cell td_username"><?php echo $guestpost['username']; ?></td>

                                        <td class="d-xl-table-cell td_username">
                                            <button type="button" class="check btn btn-success" value="" onclick="change_flag(<?php echo $guestpost['is_flag'] ?>,<?php echo $guestpost['id']; ?>, this)">
                                                <?php echo $guestpost['is_flag'] == 1 ? '<i class="fa fa-flag" aria-hidden="true"></i>' : '<i class="fa fa-flag-o" aria-hidden="true"></i>'; ?>
                                            </button>
                                        </td>
                                        <td class="d-xl-table-cell td_edit"><button class="btn <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved badge bg-success" : "Approve badge bg-danger"  ?>" type="button" onclick="payemnt_approvel(<?php echo $guestpost['payment_status']; ?>,<?php echo $guestpost['id']; ?>, this)"><?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "Approve"  ?></button></td>


                                        <td class="d-xl-table-cell"><a class="sidebar-link edit-gp-btn <?php echo $guestpost['payment_approvel'] == 1 ? "edited" : ""  ?>" href="<?= base_url('manager/edit-guestpost/') . md5($guestpost['id']); ?>"><?php echo $guestpost['payment_approvel'] == 1 ? "Edited" : "Edit" ?></a></td>
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
</div>