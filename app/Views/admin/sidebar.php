<?php $session = session();
$id = $session->get('id');
$name = $session->get('name');
$email = $session->get('email');
$role = $session->get('role');
// $loginstatus = $session->get('isLoggedIn');



// if (!$loginstatus) {
// 	return redirect()->to(base_url() . 'login');
// }

?>
<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="#">
			<span class="align-middle"><?= $role
										?></span>
		</a>

		<ul class="sidebar-nav">


			<li class="sidebar-item <?php echo substr(current_url(), -5) === 'admin' ? 'active' : ''; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>admin">
					<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>

			<!-- <li class="sidebar-item">
				<a class="sidebar-link" href="pages-profile.php">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
				</a>
			</li> -->
			<!-- <li class="sidebar-item">
                            <a class="sidebar-link" href="<? //= base_url() 
															?>agent/guest-posting">
                                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Guest Posting</span>
                            </a>
                        </li> -->
			<li class="sidebar-item <?php echo substr(current_url(), -5) === 'leads' ? 'active' : ''; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>admin/guest-posting-leads">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Guest Posting Leads</span>
				</a>
			</li>
			<li class="sidebar-item <?php echo substr(current_url(), -5) === 'users' ? 'active' : ''; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>admin/manage-users">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Manage Users</span>
				</a>
			</li>
			<li class="sidebar-item <?php echo substr(current_url(), -4) === 'user' ? 'active' : ''; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>admin/add-user">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Add User</span>
				</a>
			</li>
			<li class="sidebar-item <?php echo substr(current_url(), -7) === 'project' ? 'active' : ''; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>admin/project">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Add Project</span>
				</a>
			</li>
			<li class="sidebar-item <?php echo substr(current_url(), -8) === 'projects' ? 'active' : ''; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>admin/all-projects">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">All Projects</span>
				</a>
			</li>
			<!-- <li class="sidebar-item">
							<a class="sidebar-link" href="pages-profile.php">
								<i class="align-middle" data-feather="user"></i> <span class="align-middle">Guest Posting</span>
							</a>
						</li> -->

			<!-- <li class="sidebar-item">
							<a class="sidebar-link" href="<? //= base_url() 
															?>login">
								<i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="<? //= base_url() 
															?>register">

								<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
							</a>
						</li> -->
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url() ?>logout">

					<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Logout</span>
				</a>
			</li>

			<!-- <li class="sidebar-item">
							<a class="sidebar-link" href="pages-blank.php">
								<i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
							</a>
						</li>

						<li class="sidebar-header">
							Tools & Components
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-buttons.php">
								<i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-forms.php">
								<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-cards.php">
								<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-typography.php">
								<i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="icons-feather.php">
								<i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
							</a>
						</li>

						<li class="sidebar-header">
							Plugins & Addons
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="charts-chartjs.php">
								<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="maps-google.php">
								<i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
							</a>
						</li> -->
		</ul>

		<!-- <div class="sidebar-cta">
						<div class="sidebar-cta-content">
							<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
							<div class="mb-3 text-sm">
								Are you looking for more components? Check out our premium version.
							</div>
							<div class="d-grid">
								<a href="upgrade-to-pro.php" class="btn btn-primary">Upgrade to Pro</a>
							</div>
						</div>
					</div> -->
	</div>
</nav>