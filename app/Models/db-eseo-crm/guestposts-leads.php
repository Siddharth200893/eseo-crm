<!DOCTYPE php>
<php lang="en">
    <?php echo view('admin/header') ?>
    <style>
        .Pending {
            background: #ffed0063;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />
    <main class="content">
        <div class="row">
            <div class="col-md-3">
                <input type="text" id="date_range_filter" class="form-control filter ">
            </div>
            <div class="col-md-3">
                <select id="paymentModeFilter" class="form-control filter">
                    <option value="0">All Payment Mode</option>
                    <!-- <option value="0">No value</option> -->
                    <option value="paypal">Paypal</option>
                    <option value="upi">Upi</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="currencyFilter" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="0">All Currencies</option>
                    <option value="inr">Inr</option>
                    <option value="usd">Usd</option>
                    <option value="NA">NA</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="projectFilter" class="form-control filter">
                    <!-- <option value="0">No value</option> -->
                    <option value="0">All Projects</option>
                    <?php foreach ($all_projects as $project) : ?>
                        <option value="<?= $project['name'] ?>"><?= $project['name'] ?></option>
                    <?php
                    endforeach; ?>
                </select>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="wrapper_inner">
                <div class="row justify-content-md-center">
                    <div class="col-12">
                        <h2>
                            <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
                        </h2>
                        <div class="table-responsive">
                            <span id="sale_result"></span>
                            <table id="contact_us_table" class="table default_table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th class="d-xl-table-cell">Date</th>
                                        <th class="d-xl-table-cell">Project Name</th>
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
                                    foreach ($guest_posts as $guestpost) : ?>
                                        <tr class="<?php echo $guestpost['payment_approvel'] == 1 ? "Approved" : "Approve"  ?> <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?>">
                                            <td class="d-xl-table-cell td_date" data-td_date="<?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?>"><?php echo date("F j, Y", strtotime($guestpost['created_at'])); ?></td>
                                            <td class="td_project_name" data-td_project_name="<?php echo $guestpost['project_name']; ?>"><?php echo $guestpost['project_name']; ?></td>
                                            <td class="d-xl-table-cell td_link"><?php echo $guestpost['link']; ?></td>
                                            <td class="d-xl-table-cell range td_amount"><?php echo $guestpost['amount']; ?></td>
                                            <td class="d-xl-table-cell td_pmt_status" data-td_pmt_status="<?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?>"><?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?></td>
                                            <td class="td_currency" data-td_currency="<?php echo $guestpost['currency']; ?>"><?php echo $guestpost['currency']; ?></td>
                                            <td class="td_pmt_mode" data-td_pmt_mode="<?php echo $guestpost['payment_mode']; ?>"><?php echo $guestpost['payment_mode']; ?></td>
                                            <td class="d-xl-table-cell td_reference_number"><?php echo $guestpost['reference_number']; ?></td>
                                            <td data-username="<?php echo $guestpost['username']; ?>" class="d-xl-table-cell td_username"><?php echo $guestpost['username']; ?></td>
                                            <td class="d-xl-table-cell td_edit"><button class="btn <?php echo $guestpost['payment_status'] == 1 ? "Completed" : "Pending"  ?> <?php echo $guestpost['payment_approvel'] == 1 ? "Approved badge bg-success" : "Approve badge bg-danger"  ?>" type="button" onclick="payemnt_approvel(<?php echo $guestpost['payment_status']; ?>,<?php echo $guestpost['id']; ?>, this)"><?php echo $guestpost['payment_approvel'] == 1 ? "Approved <i class='fa fa-check-square-o' aria-hidden='true'></i>" : "Approve"  ?></button></td>
                                            <td class="d-xl-table-cell"><a class="sidebar-link edit-gp-btn <?php echo $guestpost['payment_approvel'] == 1 ? "edited" : ""  ?>" href="<?= base_url('admin/edit-guestpost/') . $guestpost['id']; ?>"><?php echo $guestpost['payment_approvel'] == 1 ? "Edited" : "Edit"  ?></a></td>
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
    </main>
    <?php echo view('admin/footer') ?>
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
                    $.ajax({
                        url: "<?= base_url('admin/guestpost-leads-date-range') ?>",
                        type: "POST",
                        data: {
                            start_date: start.format('YYYY-MM-DD'),
                            end_date: end.format('YYYY-MM-DD')
                        },
                        dataType: "json",
                        // contentType: "application/json; charset=utf-8",
                        success: function(response) {
                            console.log(response.data);
                            // form.reset();
                            // swal("Success!", "Your data has been saved. Thank you!", "success");
                            // Assuming the response contains the 'data' array
                            var data = response.data;
                            // Get the count of rows
                            var rowCount = data.length;
                            if (rowCount <= 0) {
                                $("#sale_result").text("No records found");
                                $("#contact_us_table").hide();
                            } else {
                                $(".agent-row").hide();
                                $("#contact_us_table").show();
                                $("#sale_result").hide();
                                for (var i = 0; i < data.length; i++) {
                                    var row = data[i];
                                    const payment_status_text = row.payment_status == 1 ? "Completed " : "Pending ";
                                    const payment_status = row.payment_status == 1 ? "Completed badge bg-success" : "Pending Approve badge bg-danger";
                                    const payment_approvel = row.payment_approvel == 1 ? "Approved" : "Pending";
                                    const aproove_status = row.payment_approvel == 1 ? "Approved" : "Approve";
                                    const editing_status = row.payment_approvel == 1 ? "edited" : "";
                                    const editing_text = row.payment_approvel == 1 ? "Edited" : "Edit";
                                    tableRow += '<tr class="' + payment_approvel + " " + aproove_status + '">' +
                                        '<td>' + row.created_at + '</td>' +
                                        '<td class="td_project_name" data-td_project_name ="' + row.project_name + '">' + row.project_name + '</td>' +
                                        '<td>' + row.link + '</td>' +
                                        '<td>' + row.amount + '</td>' +
                                        '<td>' + payment_status_text + '</td>' +
                                        '<td class="td_currency" data-td_currency ="' + row.currency + '">' + row.currency + '</td>' +
                                        '<td class="td_pmt_mode" data-td_pmt_mode="' + row.payment_mode + '">' + row.payment_mode + '</td>' +
                                        '<td>' + row.reference_number + '</td>' +
                                        '<td>' + row.username + '</td>' +

                                        '<td>' + '<button class="btn ' + payment_status + " " + aproove_status + '" type="button" onclick="payemnt_approvel(' + row.payment_status + ',' + row.id + ')">' + aproove_status + '</button> ' + ' </td>' +
                                        // '<td>' + row.agent_id + '</td>' +
                                        '<td>' + '<a target="_blank" href="<?= base_url('admin/edit-guestpost/') ?>' + '/' + row.id + '" class="edit-gp-btn ' +
                                        editing_status + '"">' + editing_text + '</a>'; + '</td > ' +
                                    '</tr>';
                                    $("#sales_table_body").html(tableRow);
                                }
                            }
                            // console.log(tableRow);
                            // console.log("Row count: " + rowCount);
                            $("#sale_count").text(rowCount);
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

            // var date_val = $('#date_range_filter').val();
            // console.log(date_val + 'date_val');
            // alert(date_val);
            $('.pagination').hide();
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
                if (contactFlag && rangeFlag && projectFlag) {
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