<!DOCTYPE php>
<php lang="en">
    <?php echo view('agent/header') ?>
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
    <main class="content">
        <div class="container-fluid p-0">
            <div class="eseo_form">
                <div class="form_title">
                    <h2>Guest Posting</h2>
                </div>
                <form id="guest-posting-form" method="post" action="<?= base_url() ?>agent/save-guestpost">
                    <div class="mb-3">
                        <label for="guestPosting" class="form-label">Guest Posting Link</label>
                        <input type="text" class="form-control focus" id="guestPosting" name="link">
                    </div>
                    <div class="mb-3">
                        <label for="agent_email" class="form-label">Agent Email</label>
                        <input type="email" class="form-control " id="agent_email" name="agent_email" value="<?= $session->get('email') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="blogger_name" class="form-label">Blogger Name</label>
                        <input type="text" class="form-control" id="blogger_name" name="blogger_name">
                    </div>
                    <div class="mb-3">
                        <label for="blogger_email" class="form-label">Blogger Email</label>
                        <input type="email" class="form-control" id="blogger_email" name="blogger_email">
                    </div>
                    <div class="mb-3">
                        <label for="blogger_phone" class="form-label">Blogger Phone</label>
                        <input type="number" class="form-control" id="blogger_phone" name="blogger_phone">
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
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                    <div id="" class="reference_number">
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" id="currency" name="currency">
                                <option value="">Select</option>
                                <?php foreach ($all_currencies as $currency) {
                                ?>
                                    <option value="<?= $currency['id'] ?>"><?= $currency['name'] ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="mb-3 ">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentmode" name="paymentmode">
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
    <?php echo view('agent/footer') ?>
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
    <!-- <script>
        $(document).ready(function() {
            $('#paymentmode').on('change', function() {
                if (this.value === 'upi' || this.value === 'paypal') {
                    $('#reference_number').show();
                } else {
                    $('#reference_number').hide();
                }
            });
        })
    </script> -->
    <script>
        var agent_email = `<?= $session->get('email') ?>`;
        if (agent_email) {
            $("#agent_email").prop('disabled', true);
        }
    </script>
    <script>
        $(document).ready(function() {
            show_hide();
            // currency_features();
            // payment_mode_features();
            // prop_disable();
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
            $('#currency').on('change', function() { //calling function once again ....
                var cr = $('#currency').val();
                var pmt_mode = $('#paymentmode').val();

                currency_features();
                // payment_mode_features();
                const usd_pmt_modes = `<?php foreach ($usd_payment_modes as $usd_payment_mode) : ?>
                                    <option value="">Select</option>
                                    <option value="<?= $usd_payment_mode['id'] ?>"><?= $usd_payment_mode['name'] ?></option>
                                <?php
                                        endforeach;
                                ?>`;
                const inr_pmt_modes = `<?php foreach ($inr_payment_modes as $inr_payment_mode) : ?>
                                    

                                    <option value="<?= $inr_payment_mode['id'] ?>"><?= $inr_payment_mode['name'] ?></option>
                                <?php
                                        endforeach;
                                ?>`;

                if (cr == 1) {
                    let selectOptions = `<option value="">Select</option> ${usd_pmt_modes}`;
                    $('#paymentmode').html(selectOptions);
                } else if (cr == 2) {
                    let selectOptions = `<option value="">Select</option> ${inr_pmt_modes}`;
                    $('#paymentmode').html(selectOptions);
                }
                // alert(this.value);
            });
            $('#paymentmode').on('change', function() {
                var pmt_mode = $('#paymentmode').val();


                payment_mode_features();
            });
        });
        //edit form functions....
        // function prop_disable() {
        //     var cr = $('#paymentStatus').val();
        //     if (cr == 1) {
        //         $('#projectName').prop('disabled', true);
        //         $('#paymentStatus').prop('disabled', true);
        //         $('#currency').prop('disabled', true);
        //         $('#paymentmode').prop('disabled', true);
        //         $('#payee_number').prop('disabled', true);
        //         $('input[type=radio][name=radio_btn]').prop('disabled', true);
        //         $("input[type=text][name=reference_number]").prop('disabled', true);
        //     }
        // }

        function currency_features() {
            var pmt_sts = $('#currency').val();
            if (pmt_sts == 1) {
                $('#paymentmode').val('1'); //using value 1 for USD and 2 for INR FROM database....
                $('#radio-buttons').show();
                $('#for_ref_no').hide();
                $('#for_invoice').show();
            } else if (pmt_sts == 2) {
                $('#paymentmode').val('2'); //using value 1 for USD and 2 for INR FROM database....
                $('#for_email').hide();
                $('#for_invoice').hide();
                $('#radio-buttons').hide();
                $('#for_ref_no').show();
                $('#reference_number').show();
            }
        }

        function payment_mode_features() {
            var pmt_mode = $('#paymentmode').val();
            // alert(pmt_mode);


            const bank_details = `<label for="acct_no" class="form-label">Account No.</label>
                            <input type="number" class="form-control" id="acct_no" name="acct_no">
                            <label for="acct_name" class="form-label">Account Name</label>
                            <input type="text" class="form-control" id="acct_name" name="acct_name">
                            <label for="ifsc" class="form-label">IFSC Code</label>
                            <input type="text" class="form-control" id="ifsc" name="ifsc">`;
            const paypal = `<div id="for_email" >
                                <label for="payee_email">Payee Email</label>
                                <input type="email" class="form-control" id="" name="payee_email" value="" placeholder="Payee Email">
                            </div>
                            <div id="for_invoice" style="display:none;>
                                <label for="reference_number">Invoice</label>
                                <input type="text" class="form-control" id="invoice_number" name="reference_number" value="" placeholder="Invoice Number">
                            </div>`;
            const upi = `<div id="for_ref_no" >
                                <label for="reference_number">Reference Number</label>
                                <input type="text" class="form-control" id="reference_number" name="reference_number" value="" placeholder="Reference Number">
                            </div>
                            <div id="for_payee_number" class="mt-3">
                                <label for="payee_number">Payee Number</label>
                                <input type="text" class="form-control" id="payee_number" name="payee_number" value="" placeholder="Payee Number">
                            </div>`;


            if (pmt_mode == 3) {
                $('#payment_details').html(bank_details);
            } else if (pmt_mode == 2) {
                $('#payment_details').html(upi);
            } else if (pmt_mode == 1) {
                $('#payment_details').html(paypal);
            }

            // if (pmt_mode === "Paypal") { //using 1 one for paypal and 2 for gpay.......
            //     $('#for_ref_no').hide();
            //     $('#radio-buttons').show();
            //     $('#for_invoice').show();
            // } else if (pmt_mode === "UPI") {
            //     $('#for_ref_no').show();
            //     $('#radio-buttons').hide();
            //     $('#for_invoice').hide();
            //     $('#reference_number').show();
            //     $('#for_payee_number').show();
            // } else if (pmt_mode === "Bank Details") {
            //     $('#for_ref_no').show();
            //     $('#radio-buttons').hide();
            //     $('#for_invoice').hide();
            //     $('#reference_number').show();
            //     $('#for_payee_number').show();
            // }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
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
        $("#guest-posting-form").validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                currency: {
                    required: true,
                },
                amount: {
                    required: true,
                    digits: true
                },
                projectName: {
                    required: true,
                },
                blogger_name: {
                    required: true,
                    letters: true
                },
                blogger_email: {
                    required: true,
                    customEmailValidation: true
                },
                blogger_phone: {
                    check_phone: true
                },
            },
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            $("#paymentStatus").change(function() {
                if ($(this).val() == "0") {
                    $("#reference_number").hide();
                } else {
                    $("#reference_number").show();
                }
            });
        });
    </script> -->
    </body>
</php>