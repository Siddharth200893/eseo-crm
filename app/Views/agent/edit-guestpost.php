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
                <form id="update-guestpost-form" method="post" action="<?= base_url() ?>agent/update-guestpost">
                    <input type="hidden" value="<?= $guest_posts['guestpost_id'] ?>" class="form-control" id="" name="id">


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
                    <div id="currencyINR">
                        <div class="mb-3">
                            <label for="currencyINR" class="form-label">Currency (INR)</label>
                            <select class="form-select" id="" name="currency">
                                <option value="<?= $guest_posts['currency_id'] ?>"><?= $guest_posts['currency_name'] ?></option>
                                <?php foreach ($all_currencies as $currency) : ?>
                                    <option value="<?= $currency['id'] ?>"><?= $currency['name'] ?></option>
                                <?php
                                endforeach;
                                ?>
                                <!-- Add more currency options here if needed -->
                            </select>
                        </div>
                        <div class="mb-3 reference_number">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="" name="paymentmode">
                                <option value="<?= $guest_posts['payment_mode_id'] ?>"><?= $guest_posts['payment_mode'] ?></option>
                                <?php foreach ($all_payment_modes as $payment_mode) : ?>
                                    <option value="<?= $payment_mode['id'] ?>"><?= $payment_mode['name'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <div id="" class="" name="">
                                <label for="paymentMode" class="form-label">Reference Number</label>
                                <input type="" value="<?= $guest_posts['reference_number'] ?>" class="form-control" id="reference_number" name="reference_number">
                            </div>
                        </div>
                    </div>
                    <div class="right_submit"> <button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
        </div>
    </main>
    </main>
    <?php echo view('agent/footer') ?>
    <!-- <script>
        $(document).ready(function() {

            var payment_status = $('#paymentStatus').val();
            // alert(payment_status);
            if (payment_status == 1) {
                $('#currencyINR').show();
            }

            $('#paymentStatus').on('change', function() {
                if (this.value === '1') {
                    $('#currencyINR').show();
                } else {
                    $('#currencyINR').hide();
                }
            });
        })
    </script> -->
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
        var ref_num = `<?= $guest_posts['reference_number'] ?>`;
        if (ref_num) {
            $("#reference_number").prop('disabled', true);
        } else {
            $("#reference_number").prop('disabled', false);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



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

    <script>
        $(document).ready(function() {
            console.log(<?= current_url() ?>);
            console.log(<?php echo substr(current_url(), -4) === 'mode' ? 'active' : ''; ?>);
            if (<?php echo substr(current_url(), -4) === 'mode' ? 'active' : ''; ?> === 'active') {
                console.log('yes');
                $('.sidebar-link').attr('aria-expanded', 'true');
                $('.sidebar-link').removeClass('collapsed');
            }
        })
    </script>
    </body>
</php>