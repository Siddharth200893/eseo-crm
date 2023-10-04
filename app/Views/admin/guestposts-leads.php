<!DOCTYPE php>
<?php $session = session();
$session->markAsTempdata('some_name', 10); ?>
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
<?php echo view('admin/header') ?>
<main class="content">
    <div class="row">
        <div class="col-md-2">
            <input type="text" id="date_range_filter" class="form-control filter">
        </div>
        <div class="col-md-2">
            <select id="paymentModeFilter" class="form-control filter">
                <option value="">All Payment Mode</option>
                <?php foreach ($all_payment_modes as $payment_mode) : ?>
                    <option value="<?= $payment_mode['id'] ?>"><?= $payment_mode['name'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <select id="currencyFilter" class="form-control filter">
                <!-- <option value="0">No value</option> -->
                <option value="">All Currencies</option>
                <?php foreach ($all_Currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>"><?= $currency['name'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <select id="projectFilter" class="form-control filter">
                <!-- <option value="0">No value</option> -->
                <option value="">All Projects</option>
                <?php foreach ($all_projects as $project) : ?>
                    <option value="<?= $project['id'] ?>"><?= $project['name'] ?></option>
                <?php
                endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <select id="paymentFilter" class="form-control filter">
                <option value="">Payment Status</option>
                <option value="0">Pending</option>
                <option value="1">Completed</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="bloggerFilter" class="form-control filter">
                <!-- <option value="0">No value</option> -->
                <option value="">Bloggers</option>
                <?php foreach ($blogger_names as $blogger) : ?>
                    <option value="<?= $blogger['blogger_name'] ?>"><?= $blogger['blogger_name'] ?></option>
                <?php
                endforeach; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-2 mt-3">
                <select id="urgent-flag" name="urgent_flag" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="">Select Flag</option>
                    <option value="1">Flag </option>
                    <option value="0">Unflag</option>

                </select>
            </div>
            <div class="col-md-2 mt-3">
                <select id="invoice-options" name="invoice_options" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="">Invoice Options</option>
                    <option value="1">Email</option>
                    <option value="0">Invoice /Reference Number</option>

                </select>
            </div>
            <div class="col-md-2 mt-3">
                <button type="button" id="export_data" class="edit-gp-btn">Export Csv</button>
            </div>
        </div>
    </div>
</main>
<php lang="en">
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
                            <table id="replace_table_data" class="table default_table table-hover my-0">
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
                                            <td class="d-xl-table-cell td_edit"><button class="btn <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved badge bg-success" : "Approve badge bg-danger"  ?>" type="button" onclick="payemnt_approvel(<?php echo $guestpost['payment_status']; ?>,<?php echo $guestpost['id']; ?>, this)"><?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "Approve"  ?></button></td>
                                            <td class="d-xl-table-cell"><a class="sidebar-link edit-gp-btn <?php echo $guestpost['payment_approvel'] == 1 ? "edited" : ""  ?>" href="<?= base_url('admin/edit-guestpost/') . md5($guestpost['id']); ?>"><?php echo $guestpost['payment_approvel'] == 1 ? "Edited" : "Edit" ?></a></td>
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
    <?php echo view('admin/footer') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <!-- <script>
        function change_flag(status, id, el) {
            let url = `<? //= base_url('admin/is-flag/') 
                        ?>${id}`;
            $.ajax({
                url: url,
                type: "get",
                success: function(response) {
                    if (response == 1) {
                        // alert('flagged successfully');
                        // console.log(el);
                        $(el).html('<i class="fa fa-flag" aria-hidden="true"></i>');
                        // el.html();
                    } else if (response == 0) {
                        // alert(23);
                        $(el).html('<i class="fa fa-flag-o" aria-hidden="true"></i>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        };
    </script> -->
    <script>
        $(document).ready(function() {
            var selectedDateRange = {
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            };
            $('#date_range_filter').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: selectedDateRange.startDate,
                endDate: selectedDateRange.endDate,
            }, function(start, end, label) {
                selectedDateRange.startDate = start;
                selectedDateRange.endDate = end;
                // You can perform actions or updates here based on the new selected date range.
            });
            $('.filter').change(function() {
                // Access selectedDateRange.startDate and selectedDateRange.endDate here
                var start = selectedDateRange.startDate;
                var end = selectedDateRange.endDate;
                var paymentmodeFilter = $('#paymentModeFilter').val();
                var currency = $('#currencyFilter').val();
                var projectValue = $('#projectFilter').val();
                var paymentValue = $('#paymentFilter').val();
                var blogger = $('#bloggerFilter').val();
                var urgent_flag = $('#urgent-flag').val();
                var invoice_options = $('#invoice-options').val();
                // alert(paymentValue);
                // console.log(paymentValue);
                var url = '<?= base_url('admin/guestpost-leads-date-range') ?>?start_date=' + start + '&end_date=' + end + '&paymentModeFilter=' + paymentmodeFilter + '&currencyFilter=' + currency + '&projectFilter=' + projectValue + '&paymentFilter=' + paymentValue + '&bloggerFilter=' + blogger + '&urgent_flag=' + urgent_flag + '&invoice_options=' + invoice_options;
                console.log(url);
                $.ajax({
                    url: url,
                    type: "get",
                    success: function(response) {
                        $('#replace_data').html(response);
                        // console.log(response);
                        // filter();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
            });
            $('#export_data').click(function() {
                // alert('clicked');
                var start = selectedDateRange.startDate;
                var end = selectedDateRange.endDate;
                var paymentmodeFilter = $('#paymentModeFilter').val();
                var currency = $('#currencyFilter').val();
                var projectValue = $('#projectFilter').val();
                var paymentValue = $('#paymentFilter').val();
                var blogger = $('#bloggerFilter').val();
                var urgent_flag = $('#urgent-flag').val();
                var invoice_options = $('#invoice-options').val();
                // alert(paymentValue);
                // console.log(paymentValue);
                var url = '<?= base_url('admin/exportdata') ?>?start_date=' + start + '&end_date=' + end + '&paymentModeFilter=' + paymentmodeFilter + '&currencyFilter=' + currency + '&projectFilter=' + projectValue + '&paymentFilter=' + paymentValue + '&bloggerFilter=' + blogger + '&urgent_flag=' + urgent_flag + '&invoice_options=' + invoice_options;
                // console.log(url);
                window.location.href = url;
            })
        });
    </script>
    </body>
</php>