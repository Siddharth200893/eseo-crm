<!-- business_details.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <title>All Leads</title>
    <style>
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            justify-content: flex-end;
            width: 80%;
            align-items: center;
        }

        .pagination li {
            padding: 5px 11px;
            color: white;
            font-weight: 600;
            border-radius: 5px;
            font-size: 1.1em;
            margin: 0 2px;
        }

        li.active {
            background: #998383e3;
        }

        .pagination li a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h2>All Leads</h2>
                <table id="businessTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guest_posts as $guestpost) : ?>
                            <tr>

                                <td><?php echo $guestpost['link']; ?></td>
                                <td><?php echo $guestpost['amount']; ?></td>
                                <td><?php echo $guestpost['currency']; ?></td>
                                <td><?php echo $guestpost['payment_mode']; ?></td>
                                <td><?php echo $guestpost['payment_status']; ?></td>
                                <td><?php echo $guestpost['created_at']; ?></td>

                            </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?= $pager->links() ?>
</body>

</html>