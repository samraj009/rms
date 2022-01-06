<?php
$dashboard_menu = ''; 
$owner_menu = '';
$building_menu = '';
$tenant_menu = '';
$rent_collection_menu = '';
$entry_menu = '';
$report_menu = '';
$account_menu = '';
switch ($page_name) {
    case "Dashboard":
        $dashboard_menu = 'active';
        break;
    case "Owner Master":
        $owner_menu = 'active';
        break;
    case "Building Particulars":
        $building_menu = 'active';
        break;
	case "Tenant Particulars":
        $tenant_menu = 'active';
        break;
	case "Rent Collection":
        $rent_collection_menu = 'active';
        break;
	case "Reports":
        $report_menu = 'active';
        break;
	case "Entries":
        $entry_menu = 'active';
        break;
    case "Accounts Head":
        $account_menu = 'active';
        break;		
    default:
        $dashboard_menu = 'active';
}
?>
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon n-15">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $site['logo_text'];?></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php echo $dashboard_menu; ?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item">
        <a class="nav-link" href="index_rent.php">
          <i class="fas fa-fw fa-building"></i>
          <span>Rent</span></a>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item">
        <a class="nav-link" href="index_account.php">
          <i class="fas fa-fw fa-calculator"></i>
          <span>Account</span></a>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item">
        <a class="nav-link" href="javascript:;">
          <i class="fas fa-fw fa-life-ring"></i>
          <span>Maintenance</span></a>
      </li>
	  
	   <!-- Divider -->
      <hr class="sidebar-divider">
	 
      <!-- Nav Item - logout -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->