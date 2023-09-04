<!DOCTYPE php>
<php lang="en">

    <?php echo view('agent/header') ?>
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
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount">
                    </div>
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Project Name</label>
                        <select class="form-select" id="projectName" name="projectName">
                            <option value="">Select</option>
                            <?php foreach ($projects as $project) {
                            ?>
                                <option value="<?= $project['id'] ?>"><?= $project['name'] ?></option>
                            <?php
                            } ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" id="paymentStatus" name="paymentStatus">
                            <option value="">Select</option>
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                    <div id="currencyINR">
                        <div class="mb-3">
                            <label for="currencyINR" class="form-label">Currency (INR)</label>
                            <select class="form-select" id="" name="currency">
                                <option value="">Select</option>

                                <?php foreach ($all_currencies as $currency) : ?>
                                    <option value="<?= $currency['id'] ?>"><?= $currency['name'] ?></option>
                                <?php
                                endforeach;
                                ?>
                                <!-- Add more currency options here if needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentmode" name="paymentmode">
                                <option value="">Select</option>
                                <?php foreach ($all_payment_modes as $payment_mode) : ?>
                                    <option value="<?= $payment_mode['id'] ?>"><?= $payment_mode['name'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <div id="reference_number" class="reference_number" name="">
                                <label for="reference_number" class="form-label">Reference Number</label>
                                <input type="" class="form-control" id="" name="reference_number">
                            </div>
                        </div>
                    </div>
                    <div class="right_submit"> <button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
        </div>
    </main>
    <?php echo view('agent/footer') ?>
    <!-- <script>
        $(document).ready(function() {
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $("#guest-posting-form").validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                    // url_check: true,
                },
                amount: {
                    required: true,
                    digits: true
                },
                projectName: {
                    required: true,
                },
                paymentStatus: {
                    required: true,
                },
                paymentmode: {
                    required: true,
                },
                currency: {
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
            $("#paymentStatus").change(function() {
                if ($(this).val() == "0") {
                    $("#reference_number").hide();
                } else {
                    $("#reference_number").show();
                }
            });
        });
    </script>

    </body>
</php>