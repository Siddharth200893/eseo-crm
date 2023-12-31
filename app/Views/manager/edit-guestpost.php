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
    <?php echo view('manager/header') ?>
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
                <form id="update-guestpost-form" method="post" action="<?= base_url() ?>manager/update-guestpost">
                    <input type="hidden" value="<?= $guest_posts['guestpost_id'] ?>" class="form-control" id="" name="id">
                    <div id="currencyINR">
                        <div class="mb-3">
                            <label for="currencyINR" class="form-label">Currency</label>
                            <select class="form-select" id="currency" name="currency">

                                <?php if ($guest_posts['payment_mode_id']) { ?>
                                    <option value="<?= $guest_posts['currency_id'] ?>"><?= $guest_posts['currency_name'] ?></option>
                                <?php
                                }
                                ?>

                                <option value="<?= $selected_currency['id'] ?>"><?= $selected_currency['name'] ?></option>

                                <!-- Add more currency options here if needed -->
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label for="paymentMode" class="form-label">Payment Mode</label>
                        <select class="form-select" id="paymentmode" name="paymentmode">
                            <?php if ($guest_posts['payment_mode_id']) { ?>
                                <option value="<?= $guest_posts['payment_mode_id'] ?>"><?= $guest_posts['payment_mode'] ?></option>
                            <?php
                            }
                            ?>
                            <?php foreach ($currency_payment_modes as $payment_mode) : ?>
                                <option value="<?= $payment_mode['id'] ?>"><?= $payment_mode['name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" value="<?= $guest_posts['amount'] ?>" class="form-control focus" id="amount" name="amount">
                    </div>
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Project Name</label>
                        <select class="form-select" id="projectName" name="projectName">
                            <option value="<?= $guest_posts['project_id'] ?>"><?= $guest_posts['project_name'] ?></option>
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

                        <div id="radio-buttons" style="display:none;">
                            <div class="mb-3">
                                <input type="radio" id="" class="" name="radio_btn" value="email">
                                <label for="radio_btn">Payee Email</label>
                                <input type="radio" id="" class="" name="radio_btn" value="invoice">
                                <label for="radio_btn">Invoice</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div id="for_email" style="display:none;">
                                <label for="payee_email">Payee Email</label>
                                <input type="email" class="form-control" id="" name="payee_email" value="" placeholder="Payee Email">
                            </div>
                            <div id="for_invoice" style="display:none;">
                                <label for="reference_number">Invoice</label>
                                <input type="text" class="form-control" id="invoice_number" name="reference_number" value="<?= $guest_posts['reference_number'] ?>" placeholder="Invoice Number">
                            </div>
                            <div id="for_ref_no" style="display:none;">
                                <label for="reference_number">Reference Number</label>
                                <input type="text" class="form-control" id="reference_number" name="reference_number" value="<?= $guest_posts['reference_number'] ?>" placeholder="Reference Number" style="display:none;">
                            </div>
                            <div id="for_payee_number" class="mt-3" style="display:none;">
                                <label for="payee_number">Payee Number</label>
                                <input type="text" class="form-control" id="payee_number" name="payee_number" value="<?= $guest_posts['payee_number'] ?>" placeholder="Payee Number">
                            </div>
                        </div>
                    </div>
                    <div class="right_submit"> <button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
        </div>
    </main>
    </main>
    <?php echo view('manager/footer') ?>
    <script>
        $(document).ready(function() {
            // currency_features();
            payment_features();
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
            $('#currency').on('change', function() { //calling function once again ....
                var cr = $('#currency').val();
                currency_features();
            });
            $('#paymentmode').on('change', function() {
                var pmt_mode = $('#paymentmode').val();
                payment_features();
            });
        });

        //edit form functions....

        function prop_disable() {
            var cr = $('#paymentStatus').val();
            if (cr == 1) {
                $('#projectName').prop('disabled', true);
                $('#paymentStatus').prop('disabled', true);
                $('#currency').prop('disabled', true);
                $('#paymentmode').prop('disabled', true);
                $('#payee_number').prop('disabled', true);
                $('input[type=radio][name=radio_btn]').prop('disabled', true);
                $("input[type=text][name=reference_number]").prop('disabled', true);
            }
        }

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

        function payment_features() {
            var pmt_mode = $('#paymentmode').val();

            if (pmt_mode == 1) { //using 1 one for paypal and 2 for gpay.......

                $('#for_ref_no').hide();
                $('#radio-buttons').show();
                $('#for_invoice').show();
            } else if (pmt_mode == 2) {
                $('#for_ref_no').show();
                $('#radio-buttons').hide();
                $('#for_invoice').hide();
                $('#reference_number').show();
                $('#for_payee_number').show();
            }
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