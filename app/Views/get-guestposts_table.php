<div id="replace_data">
    <?php echo view('admin/ajax-header') ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />
    <main class="content">
        <div class="row">
            <!-- <div class="col-md-2">
                <input type="text" id="date_range_filter" class="form-control filter ">
            </div> -->
            <div class="col-md-2">
                <select id="paymentModeFilter" class="form-control filter">
                    <option value="0">All Payment Mode</option>
                    <?php foreach ($all_payment_modes as $payment_mode) : ?>
                        <option value="<?= $payment_mode['name'] ?>"><?= $payment_mode['name'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="currencyFilter" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="0">All Currencies</option>
                    <?php foreach ($all_Currencies as $currency) : ?>
                        <option value="<?= $currency['name'] ?>"><?= $currency['name'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="projectFilter" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="0">All Projects</option>
                    <?php foreach ($all_projects as $project) : ?>
                        <option value="<?= $project['name'] ?>"><?= $project['name'] ?></option>
                    <?php
                    endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="paymentFilter" class="form-control filter">
                    <option value="0">Payment Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="bloggerFilter" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="0">Bloggers</option>
                    <?php foreach ($blogger_names as $blogger) : ?>
                        <option value="<?= $blogger['blogger_name'] ?>"><?= $blogger['blogger_name'] ?></option>
                    <?php
                    endforeach; ?>
                </select>
            </div>
        </div>
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
                                    <th class="d-xl-table-cell">Reference No.</th>
                                    <th class="d-xl-table-cell">Agent Name</th>
                                    <th class="d-xl-table-cell">Payment Approvel</th>
                                    <th class="d-xl-table-cell">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_table_body">
                                <?php
                                foreach ($guestposts as $guestpost) : ?>
                                    <tr class="<?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : ""  ?> <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?>">
                                        <td class="d-xl-table-cell td_date" data-td_date="<?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?>"><?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?></td>
                                        <td class="td_project_name" data-td_project_name="<?php echo $guestpost['project_name']; ?>"><?php echo $guestpost['project_name']; ?></td>
                                        <td class="td_blogger_name" data-td_blogger_name="<?php echo $guestpost['blogger_name']; ?>"><?php echo $guestpost['blogger_name']; ?></td>
                                        <td class="d-xl-table-cell td_link"><?php echo $guestpost['link']; ?></td>
                                        <td class="d-xl-table-cell range td_amount"><?php echo $guestpost['amount']; ?></td>
                                        <td class="d-xl-table-cell td_pmt_status" data-td_pmt_status="<?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?>"><?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?></td>
                                        <td class="td_currency" data-td_currency="<?php echo $guestpost['currency_name']; ?>"><?php echo $guestpost['currency_name']; ?></td>
                                        <td class="td_pmt_mode" data-td_pmt_mode="<?php echo $guestpost['payment_mode']; ?>"><?php echo $guestpost['payment_mode']; ?></td>
                                        <td class="d-xl-table-cell td_reference_number"><?php echo $guestpost['reference_number']; ?></td>
                                        <td data-username="<?php echo $guestpost['username']; ?>" class="d-xl-table-cell td_username"><?php echo $guestpost['username']; ?></td>
                                        <td class="d-xl-table-cell td_edit"><button class="btn <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved badge bg-success" : "Approve badge bg-danger"  ?>" type="button" onclick="payemnt_approvel(<?php echo $guestpost['payment_status']; ?>,<?php echo $guestpost['id']; ?>, this)"><?php echo $guestpost['payment_approvel'] == 1 ? "Approved <i class='fa fa-check-square-o' aria-hidden='true'></i>" : "Approve"  ?></button></td>


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
    <?php echo view('admin/footer') ?>
</div>
</main>
<div id="pagination-container"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daterangepicker.js"></script>
<script>
    $(document).ready(function() {
        function md5(input) {
            return CryptoJS.MD5(input).toString();
        }
        $('#date_range_filter').daterangepicker({
                ranges: {
                    // 'Select Date': ["", ""],
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
            },
            function(start, end, label) {
                var tableRow = null;
                var url = '<?= base_url('admin/guestpost-leads-date-range') ?>?start_date=' + start + '&end_date=' + end;
                $.ajax({
                    url: url,
                    type: "get",
                    success: function(response) {
                        $('#replace_data').html(response);
                        console.log(response);
                        filter()
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
            });
    });
</script>
<script>
    function filter() {
        // alert(1);
        filter_function();
        //calling filter function each select box value change
    }
    $('.filter').change(filter);
    $('table tbody tr').show(); //intially all rows will be shown
    function filter_function() {
        $('table tbody tr').hide(); //hide all rows
        // var companyFlag = 0;
        // var companyValue = $('#date_range_filter').val();
        var contactFlag = 0;
        var contactValue = $('#paymentModeFilter').val();
        console.log(contactValue);
        var rangeFlag = 0;
        var rangeValue = $('#currencyFilter').val();
        console.log(rangeValue);
        var projectFlag = 0;
        var projectValue = $('#projectFilter').val();
        console.log(projectValue + "projectflag");
        var paymentFlag = 0;
        var paymentValue = $('#paymentFilter').val();
        // alert(paymentValue);
        console.log(paymentValue + "paymentFilterflag");
        var bloggerFlag = 0;
        var bloggerValue = $('#bloggerFilter').val();
        console.log(bloggerValue + "bloggerValuetflag");
        //setting intial values and flags needed
        //traversing each row one by one
        $('#sales_table_body tr').each(function() {
            if (rangeValue == 0) {
                // console.log(rangeValue + "rangevalue1");
                rangeFlag = 1;
            } else if (rangeValue == $(this).find('td.td_currency').data('td_currency')) {
                // console.log(rangeValue + "rangevalue");
                rangeFlag = 1;
            } else {
                rangeFlag = 0;
            }
            if (contactValue == 0) {
                contactFlag = 1;
            } else if (contactValue == $(this).find('td.td_pmt_mode').data('td_pmt_mode')) {
                contactFlag = 1;
            } else {
                contactFlag = 0;
            }
            if (projectValue == 0) {
                projectFlag = 1;
            } else if (projectValue == $(this).find('td.td_project_name').data('td_project_name')) {
                projectFlag = 1;
            } else {
                projectFlag = 0;
            }
            if (paymentValue == 0) {
                paymentFlag = 1;
            } else if (paymentValue == $(this).find('td.td_pmt_status').data('td_pmt_status')) {
                paymentFlag = 1;
            } else {
                paymentFlag = 0;
            }
            if (bloggerValue == 0) {
                bloggerFlag = 1;
            } else if (bloggerValue == $(this).find('td.td_blogger_name').data('td_blogger_name')) {
                bloggerFlag = 1;
            } else {
                bloggerFlag = 0;
            }
            if (contactFlag && rangeFlag && projectFlag && bloggerFlag && paymentFlag) {
                // console.log(companyFlag);
                console.log('yes');
                console.log(contactFlag);
                console.log(rangeFlag);
                $(this).show(); //displaying row which satisfies all conditions
            }
        });
    }
</script>



</body>
</php>