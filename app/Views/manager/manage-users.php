<!DOCTYPE php>
<php lang="en">

    <?php echo view('manager/header') ?>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row justify-content-md-center">
                <div class="col-12">
                    <!-- <h2>All Leads</h2> -->
                    <div class="add_btninfos">
                        <a class="badge bg-success" href="<?= base_url('manager/add-user') ?>" style="text-decoration:none;">Add User</a>
                    </div>
                    <table id="businessTable" class="table tabledesign table-hover my-0">
                        <thead>
                            <tr>

                                <th class="d-xl-table-cell">Name</th>
                                <th class="d-xl-table-cell">Phone</th>
                                <th class="d-xl-table-cell">Email</th>
                                <th class="d-xl-table-cell">Role</th>
                                <th class="d-xl-table-cell">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($Users as $user) : ?>
                                <tr>

                                    <td class="d-xl-table-cell"><?php echo $user['username']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $user['phone']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $user['email']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $user['role']; ?></td>


                                    <td class="d-xl-table-cell"><a class="badge badge-edit-btn bg-warning" href="<?= base_url() ?>manager/edit-users/<?= md5($user['user_id']) ?>"> Edit<a></td>
                                </tr>
                            <?php
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination_new"><?= $pager->links() ?></div>
    </main>

    <?php echo view('manager/footer') ?>

    </body>

</php>