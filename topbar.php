<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
		  
		  <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
		  
		   <li class="nav-item no-arrow mx-1">
		   <a class="nav-link" href="index_rent.php" title="Rent Dashboard">
                <i class="fas fa-building fa-fw"></i> Rent
              </a>
		   </li>
		   
		   <li class="nav-item no-arrow mx-1">
		   <a class="nav-link" href="index_account.php" title="Account Dashboard">
                <i class="fas fa-calculator fa-fw"></i> Account
              </a>
		   </li>
		   
		   <li class="nav-item no-arrow mx-1">
		   <a class="nav-link" href="#" title="Maintenance">
                <i class="fas fa-life-ring fa-fw"></i> Maintenance
                
              </a>
		   </li>
		   
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $params['user_name'];?></span>
                <img class="img-profile rounded-circle" src="img/profile.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="user_profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->