<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestPostLeadsModel;
use App\Models\UsersModel;
use App\Models\RoleModel;
use App\Models\ProjectsModel;
use function PHPSTORM_META\type; ?>
<!DOCTYPE php>
<php lang="en">
    <?php echo view('manager/header') ?>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row justify-content-md-center">
                <div class="col-12">
                    <!-- <h2>All Leads</h2> -->
                    <div class="add_btninfos">
                        <a class="badge bg-success" href="<?= base_url('manager/project') ?>" style="text-decoration:none;">Add Project</a>
                    </div>
                    <table id="businessTable" class="table tabledesign table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-xl-table-cell">Date</th>
                                <th class="d-xl-table-cell">Project Name</th>
                                <th class="d-xl-table-cell">User Name</th>
                                <th class="d-xl-table-cell">Action</th>
                                <th class="d-xl-table-cell">View Leads</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($all_projects as $project) : ?>
                                <tr>
                                    <td class="d-xl-table-cell"><?php echo date("F j, Y", strtotime($project['created_at'])); ?></td>
                                    <td class="d-xl-table-cell"><?php echo $project['project_name']; ?></td>
                                    <td class="d-xl-table-cell"><?php echo $project['user_name']; ?></td>
                                    <td class="d-xl-table-cell"><a class="badge badge-edit-btn bg-warning" href="<?= base_url() ?>manager/edit-project/<?= md5($project['id']) ?>"> Edit<a></td>
                                    <td class="d-xl-table-cell"><a class="badge badge-edit-btn bg-warning" href="<?= base_url() ?>manager/view-project-leads/<?= md5($project['id']) ?>"> View Leads <?php $ProductsModel = new ProjectsModel();
                                                                                                                                                                                                        $GuestPostLeadsModel = new GuestPostLeadsModel();
                                                                                                                                                                                                        $leads_count = $GuestPostLeadsModel->select('guestpost_leads.id, COUNT(guestpost_leads.id) as guestpost_count,projects.id')
                                                                                                                                                                                                            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')

                                                                                                                                                                                                            ->where('guestpost_leads.project_id', $project['id'])->findAll();
                                                                                                                                                                                                        // print_r($project_count['projects_count']);
                                                                                                                                                                                                        echo "(" . $leads_count[0]['guestpost_count'] . ")";
                                                                                                                                                                                                        // print("<pre>" . print_r($leads_count[0]['guestpost_count'], true) . "</pre>");
                                                                                                                                                                                                        // die('hi');
                                                                                                                                                                                                        $all_projects =  $ProductsModel->select('projects.id, projects.name as project_name,projects.user_id,projects.created_at,projects.updated_at,users.name as user_name')
                                                                                                                                                                                                            ->join('users', 'users.id = projects.user_id', 'left')
                                                                                                                                                                                                            ->orderBy('projects.id', 'desc')
                                                                                                                                                                                                            ->paginate(20);
                                                                                                                                                                                                        foreach ($all_projects as $project) :
                                                                                                                                                                                                            $leads_count = $GuestPostLeadsModel->select('guestpost_leads.id, COUNT(guestpost_leads.id) as guestpost_leads_count')->where('guestpost_leads.project_id', $project['id'])->findAll();
                                                                                                                                                                                                        endforeach; ?><a></td>
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