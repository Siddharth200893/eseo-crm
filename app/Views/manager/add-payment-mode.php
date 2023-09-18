<!DOCTYPE html>
<html lang="en">
<?php
$session = session();
if ($session->getFlashdata('success_save')) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $session->getFlashdata('success_save'); ?>
    </div>
<?php
}
if ($session->getFlashdata('error_save')) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $session->getFlashdata('error_save'); ?>
    </div>
<?php
}
?>
<?php echo view('manager/header') ?>

<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">



                    <div class="card">
                        <div class="text-center mt-4">
                            <h1 class="add-user-btn">Add Payment Mode</h1>
                            <!-- <p class="lead">
								Start creating the best possible user experience for you customers.
							</p> -->
                        </div>
                        <div class="card-body card-body-another">
                            <div class="m-sm-3">
                                <form id="add-project-form" method="post" action="<?= base_url() ?>manager/add-payment-mode">
                                    <div class="mb-3">
                                        <label class="form-label">Payment Mode Name:</label>
                                        <input id="name" class="form-control form-control-lg form-control-lg-1 focus" type="text" name="name" placeholder="Payment Mode Name " />
                                    </div>


                                    <div class="right_submit">
                                        <button type="submit" class="btn btn-primary add-user-button">Add Payment Mode</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?= base_url() ?>assests/js/app.js"></script>
<?php echo view('manager/footer') ?>
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
    $("#add-project-form").validate({
        rules: {
            name: {
                required: true,
                letters: true,
            }


        }
    });
</script>

<script>
    $(document).ready(function() {

        var url = "<?php echo current_url() ?>";
        // alert(url);
        console.log('<?php echo current_url() ?>');

        var currentUrl = window.location.href;
        var paymentMode = currentUrl.substr(-4) === 'mode' ? 'active' : '';
        var currency = currentUrl.substr(-8) === 'currency' ? 'active' : '';
        console.log(paymentMode); // This will output 'active' if the condition is met, or an empty string otherwise.
        console.log(currency); // This will output 'active' if the condition is met, or an empty string otherwise.


        if (paymentMode === "active" || currency === "active") {
            console.log('yes');
            $('.sidebar-link').attr('aria-expanded', 'true');
            $('.sidebar-link').removeClass('collapsed');
            $('#collapseExample').addClass('show');
        }
    })
</script>

</body>

</html>