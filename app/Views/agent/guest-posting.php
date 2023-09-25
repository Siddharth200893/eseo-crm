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
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount">
                    </div>
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


    <script>
        var agent_email = `<?= $session->get('email') ?>`;
        if (agent_email) {
            $("#agent_email").prop('disabled', true);
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
    </script>

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
                currency: {
                    required: true,
                },
                projectName: {
                    required: true,
                },
                agent_email: {
                    required: true,
                    email: true
                },

                blogger_name: {
                    required: true,
                    letters: true
                },
                blogger_email: {
                    required: true,
                    email: true
                },
                blogger_phone: {
                    required: true,
                    check_phone: true
                },
            },

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