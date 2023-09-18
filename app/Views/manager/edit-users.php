<!DOCTYPE html>
<html lang="en">

<?php echo view('manager/header') ?>
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
<main class="content">
    <div class="container-fluid p-0">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <!-- <h2>All Leads</h2> -->
                <div class="eseo_form">
                    <div class="form_title">
                        <h2>Edit User</h2>
                    </div>
                    <form id="edit-user-form" method="post" action="<?= base_url() ?>manager/update-user">
                        <input class="form-control form-control-lg " value="<?= $Users['user_id'] ?>" type="hidden" name="id" />


                        <div class="mb-3">
                            <label class="form-label">Full name</label>
                            <input id="name" class="form-control form-control-lg focus" value="<?= $Users['username'] ?>" type="text" name="name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control form-control-lg" value="<?= $Users['email'] ?>" type="email" name="email" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input class="form-control form-control-lg" value="<?= $Users['phone'] ?>" type="phone" name="phone" />
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Role</label>


                            <select class="form-control" name="role_id" id="role">
                                <option value="<?= $Users['role_id'] ?>"><?= $Users['role'] ?></option>
                                <option value="2">Agent</option>

                            </select>
                        </div>



                        <div class="right_submit"> <button type="submit" class="btn btn-lg btn-primary">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a class="text-muted" href="https://managerkit.io/" target="_blank"><strong>ll</strong></a> - <a class="text-muted" href="https://managerkit.io/" target="_blank"><strong>Bootstrap manager Template</strong></a> &copy;
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="https://managerkit.io/" target="_blank">Support</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="https://managerkit.io/" target="_blank">Help Center</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="https://managerkit.io/" target="_blank">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="https://managerkit.io/" target="_blank">Terms</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>

</div>

<script src="<?php base_url() ?>assets/js/app.js"></script>
<?php echo view('manager/footer') ?>
<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> -->
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
    $("#edit-user-form").validate({
        rules: {
            name: {
                required: true,
                letters: true,
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                check_phone: true,

            },
            role: {
                required: true,

            },
        }
    });
</script>

</body>

</html>