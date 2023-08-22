<!DOCTYPE html>
<html lang="en">
<?php $session = session(); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <?php
        if ($session->getFlashdata('save_msg')) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $session->getFlashdata('save_msg'); ?>
            </div>
        <?php
        }
        if ($session->getFlashdata('save_msg_error')) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $session->getFlashdata('save_msg_error'); ?>
            </div>
        <?php
        }

        ?>

    </div>
</div>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bootstrap 5 Form</title>
</head>


<body>
    <div class="container mt-5">
        <form method="post" action="<?= base_url() ?>save-guestpost">
            <div class="mb-3">
                <label for="guestPosting" class="form-label">Guest Posting Link</label>
                <input type="text" class="form-control" id="guestPosting" name="link">
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount">
            </div>
            <div class="mb-3">
                <label for="currencyINR" class="form-label">Currency (INR)</label>
                <select class="form-select" id="currencyINR" name="currency">
                    <option value="inr">INR</option>
                    <!-- Add more currency options here if needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="paymentMode" class="form-label">Payment Mode</label>
                <select class="form-select" id="paymentmode" name="paymentmode">
                    <option value="pending">Upi</option>
                    <option value="completed">Cash</option>
                    <option value="failed">Cheque</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="paymentStatus" class="form-label">Payment Status</label>
                <select class="form-select" id="paymentStatus" name="paymentStatus">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>