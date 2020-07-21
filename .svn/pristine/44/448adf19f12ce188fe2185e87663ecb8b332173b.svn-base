<?php if ($this->session->userdata('invoice')) { ?>
	<!-- START OF MENU SIDE -->
	<!-- START OF MENU SIDE -->
	<?php

		$menu_list	= $this->auth_model->get_menuList('j');
		$role = $this->session->userdata('role_type');
		$role_id =  $this->session->userdata('role_id');

		$auth_service = $this->auth_model->get_layanan($role_id);

		// print_r($role_id);exit;
		// echo print_r($menu_list);die();
		switch ($role) {
			case "User":
				unset($menu_list[9]); // Administrasi
				unset($menu_list[53]); // Koreksi Nota
				//ini menu CS
				unset($menu_list[10]); // Manage VA
				unset($menu_list[11]); // Transaction
				// unset($menu_list[12]); // Reporting VA
				unset($menu_list[7]); // Send Mail to Customer


				break;
			case "Admin Unit":
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[51]); // Koreksi Nota
				unset($menu_list[7]); // Send Mail to Customer

				//ini menu CS
				// unset($menu_list[10]); // Manage VA
				// unset($menu_list[11]); // Transaction
				// unset($menu_list[12]); // Reporting VA

				break;

			case "Customer Service":
				// 	echo print_r($menu_list);die();
				unset($menu_list[1]); // Kapal
				unset($menu_list[2]); // Barang
				unset($menu_list[3]); // Uster
				unset($menu_list[4]); // Petikemas
				unset($menu_list[5]); // Rupa Rupa
				unset($menu_list[6]); // Payment
				unset($menu_list[7]); // Send Mail to Customer
				unset($menu_list[8]); // Reporting
				unset($menu_list[9]); // Administrasi
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role

				break;

			case "Admin Entity":
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[51]); // Koreksi Nota

				//ini menu CS
				unset($menu_list[10]); // Manage VA
				unset($menu_list[11]); // Transaction
				unset($menu_list[12]); // Reporting VA
				unset($menu_list[7]); // Send Mail to Customer
				break;

			case "Super Admin VA":
				// 	echo print_r($menu_list);die();
				unset($menu_list[1]); // Kapal
				unset($menu_list[2]); // Barang
				unset($menu_list[3]); // Uster
				unset($menu_list[4]); // Petikemas
				unset($menu_list[5]); // Rupa Rupa
				unset($menu_list[6]); // Payment
				unset($menu_list[7]); // Send Mail to Customer
				unset($menu_list[8]); // Reporting
				unset($menu_list[9]); // Administrasi
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[53]); // Koreksi Nota

				break;

			case "Admin VA":
				// 	echo print_r($menu_list);die();
				unset($menu_list[1]); // Kapal
				unset($menu_list[2]); // Barang
				unset($menu_list[3]); // Uster
				unset($menu_list[4]); // Petikemas
				unset($menu_list[5]); // Rupa Rupa
				unset($menu_list[6]); // Payment
				unset($menu_list[7]); // Send Mail to Customer
				unset($menu_list[8]); // Reporting
				unset($menu_list[9]); // Administrasi
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[41]); // Manage VA - Master Bank
				unset($menu_list[42]); // Manage VA - Master Biller
				unset($menu_list[53]); // Koreksi Nota

				break;

			case "Billing VA":
				// 	echo print_r($menu_list);die();
				unset($menu_list[1]); // Kapal
				unset($menu_list[2]); // Barang
				unset($menu_list[3]); // Uster
				unset($menu_list[4]); // Petikemas
				unset($menu_list[5]); // Rupa Rupa
				unset($menu_list[6]); // Payment
				unset($menu_list[7]); // Send Mail to Customer
				unset($menu_list[8]); // Reporting
				unset($menu_list[9]); // Administrasi
				unset($menu_list[10]); // Manage VA
				unset($menu_list[12]); // Reporting VA
				unset($menu_list[53]); // koreksi nota
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[41]); // Manage VA - Master Bank
				unset($menu_list[42]); // Manage VA - Master Biller
				unset($menu_list[53]); // Koreksi Nota

				break;

			case "Keuangan VA":
				// 	echo print_r($menu_list);die();
				unset($menu_list[1]); // Kapal
				unset($menu_list[2]); // Barang
				unset($menu_list[3]); // Uster
				unset($menu_list[4]); // Petikemas
				unset($menu_list[5]); // Rupa Rupa
				unset($menu_list[6]); // Payment
				unset($menu_list[7]); // Send Mail to Customer
				unset($menu_list[8]); // Reporting
				unset($menu_list[9]); // Administrasi
				unset($menu_list[10]); // Manage VA
				unset($menu_list[11]); // Transaction
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[41]); // Manage VA - Master Bank
				unset($menu_list[42]); // Manage VA - Master Biller
				unset($menu_list[53]); // koreksi nota

				break;

			case "Customer/Self Service":
				// 	echo print_r($menu_list);die();
				unset($menu_list[1]); // Kapal
				unset($menu_list[2]); // Barang
				unset($menu_list[3]); // Uster
				unset($menu_list[4]); // Petikemas
				unset($menu_list[5]); // Rupa Rupa
				unset($menu_list[6]); // Payment
				unset($menu_list[7]); // Send Mail to Customer
				unset($menu_list[8]); // Reporting
				unset($menu_list[9]); // Administrasi
				unset($menu_list[10]); // Manage VA
				unset($menu_list[12]); // Reporting VA
				unset($menu_list[26]); // master entity
				unset($menu_list[27]); // master Materai
				unset($menu_list[28]); // master nota
				unset($menu_list[31]); // master role
				unset($menu_list[47]); // force flagging
				unset($menu_list[53]); // koreksi nota

				break;

			default:
		}

		if ($auth_service->INV_ROLE_KAPAL == 0) {
			unset($menu_list[1]);
		}

		if ($auth_service->INV_ROLE_BARANG == 0) {
			unset($menu_list[2]);
		}

		if ($auth_service->INV_ROLE_PETIKEMAS == 0) {
			unset($menu_list[4]);
		}

		if ($auth_service->INV_ROLE_RUPARUPA == 0) {
			unset($menu_list[5]);
		}

		//START SIGMA 23-09-2019
		if ($auth_service->INV_ROLE_USAHA_TERMINAL == 0) {
			unset($menu_list[3]); //PRIORITY [3]
		}
		//STOP SIGMA 23-09-2019

		?>

		<div id="nav-col">
			<section id="col-left" class="col-left-nano">
				<div id="col-left-inner" class="col-left-nano-content">
					<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
						<img alt="" src="<?= CUBE_ ?>img/profile_picture.png" />
						<div class="user-box">
							<span class="name">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?= $this->session->userdata('name_phd') ?>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?= ROOT ?>customer/my_profile"><i class="fa fa-user"></i>Profile</a></li>
									<!--<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
											<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>-->
									<li><a href="<?= ROOT ?>main/logout"><i class="fa fa-power-off"></i>Logout</a></li>
								</ul>
							</span>
							<!--<span class="status">
										<i class="fa fa-circle"></i> Online
									</span>-->
						</div>
					</div>
					<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
						<ul class="nav nav-pills nav-stacked">
							<li class="nav-header nav-header-first hidden-sm hidden-xs">
								Navigation
							</li>
							<?php foreach ($menu_list as $menu) {
									$child = 0;
									if ($menu["PARENT"] == 0) {

										foreach ($menu_list as $menu2) {
											if ($menu2["PARENT"] == $menu["ID_MENU"]) {
												$child = 1;
											}
										}

										if ($child == 0) {
											?>

										<li class="active">
											<a href="<?= ROOT ?><?= $menu["LINK"] ?>" target="<?= $menu["LINK_TARGET"] ?>">
												<i class="fa fa-dashboard"></i>
												<span><?= $menu["MENU"] ?></span>
												<!-- <span class="label label-primary label-circle pull-right">28</span> -->
											</a>
										</li>


									<?php
												} else {
													?>
										<li>
											<a href="#" class="dropdown-toggle">
												<i class="fa fa-table"></i>
												<span><?= $menu["MENU"] ?></span>
												<i class="fa fa-angle-right drop-icon"></i>
											</a>
											<ul class="submenu">
												<?php foreach ($menu_list as $menu3) {
																	if ($menu3["PARENT"] == $menu["ID_MENU"]) {
																		?>
														<li>
															<a href="<?= ROOT ?><?= $menu3["LINK"] ?>" target="<?= $menu["LINK_TARGET"] ?>">
																<?= $menu3["MENU"] ?>
															</a>
														</li>
												<?php
																	}
																} ?>
											</ul>
										</li>


							<?php
										}
									}
								}
								?>
						</ul>
					</div>
				</div>
			</section>
			<div id="nav-col-submenu"></div>
		</div>
		<!-- END OF MENU SIDE -->
		<!-- END OF MENU SIDE -->

	<?php } else { ?>


		<!-- START OF MENU SIDE -->
		<!-- START OF MENU SIDE -->
		<?php
			$menu_list	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
			?>

		<div id="nav-col">
			<section id="col-left" class="col-left-nano">
				<div id="col-left-inner" class="col-left-nano-content">
					<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
						<img alt="" src="<?= CUBE_ ?>img/profile_picture.png" />
						<div class="user-box">
							<span class="name">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?= $this->session->userdata('name_phd') ?>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?= ROOT ?>customer/my_profile"><i class="fa fa-user"></i>Profile</a></li>
									<!--<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
											<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>-->
									<li><a href="<?= ROOT ?>main/logout"><i class="fa fa-power-off"></i>Logout</a></li>
								</ul>
							</span>
							<!--<span class="status">
										<i class="fa fa-circle"></i> Online
									</span>-->
						</div>
					</div>
					<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
						<ul class="nav nav-pills nav-stacked">
							<li class="nav-header nav-header-first hidden-sm hidden-xs">
								Navigation
							</li>
							<?php foreach ($menu_list as $menu) {
									$child = 0;
									if ($menu["PARENT"] == 0) {

										foreach ($menu_list as $menu2) {
											if ($menu2["PARENT"] == $menu["ID_MENU"]) {
												$child = 1;
											}
										}

										if ($child == 0) {
											?>

										<li class="active">
											<a href="<?= ROOT ?><?= $menu["LINK"] ?>" target="<?= $menu["LINK_TARGET"] ?>">
												<i class="fa fa-dashboard"></i>
												<span><?= $menu["MENU"] ?></span>
												<!-- <span class="label label-primary label-circle pull-right">28</span> -->
											</a>
										</li>


									<?php
												} else {
													?>
										<li>
											<a href="#" class="dropdown-toggle">
												<i class="fa fa-table"></i>
												<span><?= $menu["MENU"] ?></span>
												<i class="fa fa-angle-right drop-icon"></i>
											</a>
											<ul class="submenu">
												<?php foreach ($menu_list as $menu3) {
																	if ($menu3["PARENT"] == $menu["ID_MENU"]) {
																		?>
														<li>
															<a href="<?= ROOT ?><?= $menu3["LINK"] ?>" target="<?= $menu["LINK_TARGET"] ?>">
																<?= $menu3["MENU"] ?>
															</a>
														</li>
												<?php
																	}
																} ?>
											</ul>
										</li>


							<?php
										}
									}
								}
								?>
						</ul>
					</div>
				</div>
			</section>
			<div id="nav-col-submenu"></div>
		</div>
		<!-- END OF MENU SIDE -->
		<!-- END OF MENU SIDE -->

	<?php } ?>
