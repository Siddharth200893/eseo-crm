<!DOCTYPE php>
<php lang="en">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <?php $session = session();
            ?>
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
    <style>
        .Pending {
            background: #ffed0063;
        }
    </style>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="eseo_form">
                <div class="form_title">
                    <h2>Edit Guest Posting</h2>
                </div>
                <form id="update-guestpost-form" method="post" action="<?= base_url() ?>admin/update-guestpost">
                    <input type="hidden" value="<?= $guest_posts['guestpost_id'] ?>" class="form-control" id="" name="id">
                    <div class="mb-3">
                        <label for="guestPosting" class="form-label">Guest Posting Link</label>
                        <input type="text" class="form-control focus" id="guestPosting" name="link" value="<?= $guest_posts['link'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="agent_email" class="form-label">Agent Email</label>
                        <input type="email" class="form-control " id="agent_email" name="agent_email" value="<?= $guest_posts['agent_email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="blogger_name" class="form-label">Blogger Name</label>
                        <input type="text" class="form-control" id="blogger_name" name="blogger_name" value="<?= $guest_posts['blogger_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="blogger_email" class="form-label">Blogger Email</label>
                        <input type="email" class="form-control" id="blogger_email" name="blogger_email" value="<?= $guest_posts['blogger_email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="blogger_phone" class="form-label">Blogger Phone</label>
                        <input type="number" class="form-control" id="blogger_phone" name="blogger_phone" value="<?= $guest_posts['blogger_phone'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Project Name</label>
                        <select class="form-select" id="projectName" name="projectName">
                            <?php foreach ($projects as $projects) {
                            ?>
                                <option value="<?= $projects['id'] ?>"><?= $projects['name'] ?></option>
                            <?php
                            } ?>
                        </select>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" id="paymentStatus" name="paymentStatus">
                            <option value="<?= $guest_posts['payment_status'] ?>"><?= $guest_posts['payment_status'] == 1 ? "Completed" : "Pending" ?></option>
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                    <div id="" class="reference_number">
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" id="currency" name="currency">
                                <?php if ($guest_posts['payment_mode_id']) {
                                    // If $guest_posts['payment_mode_id'] is not empty, select the appropriate currency.
                                ?>
                                    <option value="<?= $guest_posts['currency_name'] ?>" selected><?= $guest_posts['currency_name'] ?></option>
                                    <?php } else {
                                    foreach ($all_currencies as $currency) : ?>
                                        <option value="<?= $currency['name'] ?>"><?= $currency['name'] ?></option>
                                <?php
                                    endforeach;
                                }
                                ?>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="<?= $guest_posts['amount'] ?>">
                        </div>
                        <div class="mb-3 ">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentmode" name="paymentmode">
                                <?php if ($guest_posts['payment_mode_id']) { ?>
                                    <!-- selected_payment_mode -->
                                    <option value="<?= $selected_payment_mode['name'] ?>"><?= $selected_payment_mode['name'] ?></option>
                                    <?php
                                } else {
                                    foreach ($all_payment_modes as $payment_mode) : ?>
                                        <option value="<?= $payment_mode['name'] ?>"><?= $payment_mode['name'] ?></option>
                                <?php
                                    endforeach;
                                }
                                ?>
                            </select>
                        </div>
                        <div id="radio-buttons" style="display:none;">
                            <div class="mb-3">
                                <input type="radio" id="" class="" name="radio_btn" value="email">
                                <label for="radio_btn">Payee Email</label>
                                <input type="radio" id="" class="" name="radio_btn" value="invoice">
                                <label for="radio_btn">Invoice</label>
                            </div>
                        </div>
                        <div class="mb-3" id="payment_details">


                        </div>
                    </div>
                    <div class="right_submit"> <button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
        </div>
    </main>
    </main>
    <?php echo view('admin/footer') ?>

    <script>
        $('#paymentStatus').on('change', function() {
            show_hide();
        });

        function show_hide() {
            const p_sts = $('#paymentStatus').val();
            if (p_sts === '1') {
                $('.reference_number').show();
            } else {
                $('.reference_number').hide();
            }
        }
    </script>
    <script>
        var agent_email = `<?= $session->get('email') ?>`;
        if (agent_email) {
            $("#agent_email").prop('disabled', true);
        }
    </script>
    <script>
        $(document).ready(function() {
            show_hide();
            currency_features();
            payment_mode_features();
            prop_disable();
            $('input[type=radio][name=radio_btn]').change(function() {
                // alert(this.value);
                if (this.value === 'email') {
                    $('#for_invoice').hide();
                    $('#for_email').show();
                } else if (this.value === 'invoice') {
                    $('#for_email').hide();
                    $('#for_invoice').show();
                    $('#reference_number').prop('disabled', true);
                }
            });
            $('#currency').on('change', function() {
                var cr = $('#currency').val();
                // alert(cr);
                var pmt_mode = $('#paymentmode').val();
                currency_features();
                $.ajax({
                    type: "GET",
                    url: '<?php echo base_url() ?>admin/payment-modes/' + cr,
                    success: function(response) {
                        $('#paymentmode').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
                payment_mode_features();
            });
            $('#paymentmode').on('change', function() {
                var pmt_mode = $('#paymentmode').val();
                payment_mode_features();
            });
        });
    </script>

    <script>
        function payment_mode_features() {
            var pmt_mode = $('#paymentmode').val();
            const bank_details = `<div class="mb-3">
            <label for="acct_no" class="form-label">Account No.</label>
        <input type="number" class="form-control" id="acct_no" name="acct_no" value="<?= $guest_posts['account_no'] ?>"" >
        </div>
        <div class="mb-3">
        <label for="acct_name" class="form-label">Account Name</label>
        <input type="text" class="form-control" id="acct_name" name="acct_name" value="<?= $guest_posts['account_name'] ?>">
        </div>
        <div class="mb-3">
        <label for="ifsc" class="form-label">IFSC Code</label>
        <input type="text" class="form-control" id="ifsc" name="ifsc" value="<?= $guest_posts['ifsc_code'] ?>">
        </div>
        <div id="for_ref_no" >
                                <label for="reference_number">Transaction Number</label>
                                <input type="text" class="form-control" id="reference_number" name="reference_number" value="<?= $guest_posts['ref_num'] ?>" placeholder="Transaction Number">
                            </div>`;
            const paypal = `<div id="for_email" >
                                <label for="payee_email">Payee Email</label>
                                <input type="email" class="form-control" id="" name="payee_email" value="<?= $guest_posts['payee_email'] ?>" placeholder="Payee Email">
                            </div>
                            <div id="for_invoice" style="display:none;>
                                <label for="reference_number">Invoice</label>
                                <input type="text" class="form-control" id="invoice_number" name="reference_number" value="<?= $guest_posts['ref_num'] ?>" placeholder="Invoice Number">
                            </div>
                            `;
            const upi = `<div id="for_ref_no" >
                                <label for="reference_number">Reference Number</label>
                                <input type="text" class="form-control" id="reference_number" name="reference_number" value="<?= $guest_posts['ref_num'] ?>" placeholder="Reference Number">
                            </div>
                            <div id="for_payee_number" class="mt-3">
                                <label for="payee_number">Payee Number</label>
                                <input type="text" class="form-control" id="payee_number" name="payee_number" value="<?= $guest_posts['payee_number'] ?>" placeholder="Payee Number">
                            </div>`;
            if (pmt_mode === 'BANK DETAILS') {
                $('#payment_details').html(bank_details);
            } else if (pmt_mode === 'UPI') {
                $('#payment_details').html(upi);
            } else if (pmt_mode === 'PAYPAL') {
                $('#payment_details').html(paypal);
            } else {
                $('#payment_details').html(paypal);
            }
        }

        function currency_features() {
            var crncy = $('#currency').val();
            if (crncy === "USD") {
                $('#radio-buttons').show();
                $('#for_ref_no').hide();
                $('#for_invoice').show();
            } else if (crncy === "INR") {
                $('#for_email').hide();
                $('#for_invoice').hide();
                $('#radio-buttons').hide();
                $('#for_ref_no').show();
                $('#reference_number').show();
            } else {
                $('#radio-buttons').show();
                $('#for_ref_no').show();
                $('#for_invoice').show();
            }
        }
    </script>
    <script>
        function prop_disable() {
            var pmt_status = $('#paymentStatus').val();
            if (pmt_status == 1) {
                $('#reference_number').prop('disabled', true);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        jQuery.validator.addMethod("ifscCode", function(value, element) {
            // Regular expression to match IFSC code
            var ifscRegex = /^[A-Z]{4}\d{7}$/;

            // Check if the input value matches the IFSC code pattern
            return this.optional(element) || ifscRegex.test(value);
        }, "Please enter a valid IFSC code.");
        jQuery.validator.addMethod('check_phone',
            function(value, element) {
                return this.optional(element) || /^[0-9]{10}$/i.test(value);
            },
            'Enter valid phone number'
        );
        jQuery.validator.addMethod(
            'letters',
            function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
            },
            'Letters only please'
        );
        jQuery.validator.addMethod("customEmailValidation", function(value, element) {
            // Define a custom regular expression for email validation
            // This regex requires a dot (.) in the domain part
            var emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            return this.optional(element) || emailRegex.test(value);
        }, "Please enter a valid email address with a dot (.) in the domain part.");
    </script>
    <script>
        $("#update-guestpost-form").validate({
            rules: {
                amount: {
                    required: true,
                },
                projectName: {
                    required: true,
                },
                paymentStatus: {
                    required: true,
                },
                currency: {
                    required: true,
                },
                paymentmode: {
                    required: true,
                },
                reference_number: {
                    required: true,
                },
                payee_email: {
                    required: true,
                    customEmailValidation: true
                },
                payee_number: {
                    required: true,
                    check_phone: true
                },
                ifsc: {
                    required: true,
                    ifscCode: true
                },
                acct_name: {
                    required: true,
                    letters: true
                },
                acct_no: {
                    required: true,
                    digits: true
                },
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($('#paymentStatus').val() == "0") {
                $(".reference_number").hide();
            } else {
                $(".reference_number").show();
            }
            $("#paymentStatus").change(function() {
                if ($(this).val() == "0") {
                    $(".reference_number").hide();
                } else {
                    $(".reference_number").show();
                }
            });
        });
    </script>
    </body>
</php>