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

                                <option value="inr">INR</option>
                                <option value="usd">USD</option>
                                <option value="na">NA</option>
                                <!-- Add more currency options here if needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentmode" name="paymentmode">
                                <option value="">Select</option>
                                <option value="upi">Upi</option>
                                <option value="paypal">Paypal</option>
                                <option value="na">NA</option>
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
            $("#paymentmode").change(function() {
                if ($(this).val() === "na") {
                    $("#reference_number").hide();
                } else {
                    $("#reference_number").show();
                }
            });
        });
    </script>

    </body>
</php>