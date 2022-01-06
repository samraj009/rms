<?php
$dashboard_menu = ''; 

$owner_menu = '';
$owner_parent_nav_class = "nav-link collapsed";
$owner_child_nav_class = "collapse";

$building_menu = '';
$building_parent_nav_class = "nav-link collapsed";
$building_child_nav_class = "collapse";

$tenant_menu = '';
$tenant_parent_nav_class = "nav-link collapsed";
$tenant_child_nav_class = "collapse";

$rent_collection_menu = '';
$rent_collection_parent_nav_class = "nav-link collapsed";
$rent_collection_child_nav_class = "collapse";

$agent_commission_menu = '';
$agent_commission_parent_nav_class = "nav-link collapsed";
$agent_commission_child_nav_class = "collapse";

$settings_menu = '';
$settings_parent_nav_class = "nav-link collapsed";
$settings_child_nav_class = "collapse";

$entry_menu = '';
$report_menu = '';
$account_menu = '';

$account_dashboard_menu = ''; 
$entry_menu = '';
$report_menu = '';
$account_menu = '';
$account_settings_menu = "";

$entry_parent_nav_class = "nav-link collapsed";
$entry_child_nav_class = "collapse";

$account_parent_nav_class = "nav-link collapsed";
$account_child_nav_class = "collapse";

$report_parent_nav_class = "nav-link collapsed";
$report_child_nav_class = "collapse";

$account_settings_parent_nav_class = "nav-link collapsed";
$account_settings_child_nav_class = "collapse";

switch ($page_name) {
    case "Dashboard":
        $dashboard_menu = 'active';
        break;
    case "Owner Master":
        $owner_menu = 'active';
		$owner_parent_nav_class = "nav-link";
        $owner_child_nav_class = "collapse show";
        break;
    case "Building Particulars":
        $building_menu = 'active';
		$building_parent_nav_class = "nav-link";
        $building_child_nav_class = "collapse show";
        break;
	case "Tenant Particulars":
        $tenant_menu = 'active';
		$tenant_parent_nav_class = "nav-link";
        $tenant_child_nav_class = "collapse show";
        break;
	case "Rent Collection":
        $rent_collection_menu = 'active';
		$rent_collection_parent_nav_class = "nav-link";
		$rent_collection_child_nav_class = "collapse show";
        break;
	case "Agent Commission":
        $agent_commission_menu = 'active';
		$agent_commission_parent_nav_class = "nav-link";
		$agent_commission_child_nav_class = "collapse show";
        break;
	case "Settings":
        $settings_menu = 'active';
		$settings_parent_nav_class = "nav-link";
		$settings_child_nav_class = "collapse show";
        break;	
/*	case "Reports":
        $report_menu = 'active';
        break;
	case "Entries":
        $entry_menu = 'active';
        break;
    case "Accounts Head":
        $account_menu = 'active';
        break;	*/
	case "Account Dashboard":
        $account_dashboard_menu = 'active';
        break;	
	case "Reports":
        $report_menu = 'active';
		$report_parent_nav_class = "nav-link";
        $report_child_nav_class = "collapse show";
        break;
	case "Entries":
        $entry_menu = 'active';
		$entry_parent_nav_class = "nav-link";
        $entry_child_nav_class = "collapse show";
        break;
    case "Accounts Head":
        $account_menu = 'active';
		$account_parent_nav_class = "nav-link";
        $account_child_nav_class = "collapse show";
        break;
	case "Account Settings":
        $account_settings_menu = 'active';
		$account_settings_parent_nav_class = "nav-link";
        $account_settings_child_nav_class = "collapse show";
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
        <a class="nav-link" href="index_rent.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Rent Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item <?php echo $owner_menu; ?>">
        <a class="<?php echo $owner_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#ownermenu" aria-expanded="true" aria-controls="ownermenu">
          <i class="fas fa-fw fa-address-book"></i>
          <span>Owner Master</span>
        </a>
        <div id="ownermenu" class="<?php echo $owner_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Owner Master"){ echo "active"; }?>" href="owner_list.php">List</a>
            <a class="collapse-item <?php if($page_title == "Add Owner Master"){ echo "active"; }?>" href="owner_add.php">Add</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item <?php echo $building_menu; ?>">
        <a class="<?php echo $building_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#buildingmenu" aria-expanded="true" aria-controls="buildingmenu">
          <i class="fas fa-fw fa-building"></i>
          <span>Building Particulars</span>
        </a>
        <div id="buildingmenu" class="<?php echo $building_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Building Particulars"){ echo "active"; }?>" href="building_list.php">List</a>
            <a class="collapse-item <?php if($page_title == "Add Building Particulars"){ echo "active"; }?>" href="building_add.php">Add</a>
          </div>
        </div>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item <?php echo $tenant_menu; ?>">
        <a class="<?php echo $tenant_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#tenantmenu" aria-expanded="true" aria-controls="tenantmenu">
          <i class="fas fa-fw fa-users"></i>
          <span>Tenant Particulars</span>
        </a>
        <div id="tenantmenu" class="<?php echo $tenant_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Tenant Particulars"){ echo "active"; }?>" href="tenant_list.php">List</a>
            <a class="collapse-item <?php if($page_title == "Add Tenant Particulars"){ echo "active"; }?>" href="tenant_add.php">Add</a>
          </div>
        </div>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item <?php echo $rent_collection_menu; ?>">
        <a class="<?php echo $rent_collection_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#rentcollectionmenu" aria-expanded="true" aria-controls="rentcollectionmenu">
          <i class="fas fa-fw fa-briefcase"></i>
          <span>Rent Collection</span>
        </a>
        <div id="rentcollectionmenu" class="<?php echo $rent_collection_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Rent Collection" || $page_title == "View Rent Collection"){ echo "active"; }?>" href="rentcollection_list.php">List</a>
            <a class="collapse-item <?php if($page_title == "Add Rent Collection"){ echo "active"; }?>" href="rentcollection_add.php">Add</a>
          </div>
        </div>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <li class="nav-item <?php echo $agent_commission_menu; ?>">
        <a class="<?php echo $agent_commission_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#agentcommissionmenu" aria-expanded="true" aria-controls="agentcommissionmenu">
          <i class="fas fa-fw fa-percent"></i>
          <span>Agent Commission</span>
        </a>
        <div id="agentcommissionmenu" class="<?php echo $agent_commission_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Agent Commission"){ echo "active"; }?>" href="agent_commission_list.php">List</a>
            <a class="collapse-item <?php if($page_title == "Add Agent Commission"){ echo "active"; }?>" href="agent_commission_add.php">Add</a>
          </div>
        </div>
      </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	   <!-- Nav Item - Reports Menu -->
      <li class="nav-item <?php echo $settings_menu; ?>">
        <a class="<?php echo $settings_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="settings">
          <i class="fas fa-fw fa-cog"></i>
          <span>Rent Settings</span>
        </a>
        <div id="settings" class="<?php echo $settings_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "Owner Sync With A/C Head"){ echo "active"; }?>" href="sync_owners.php">Owner Sync With A/C</a>
			<a class="collapse-item <?php if($page_title == "Rent Sync With Receipts"){ echo "active"; }?>" href="sync_rents.php">Rent Sync With Receipts</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  


      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php echo $account_dashboard_menu; ?>">
        <a class="nav-link" href="index_account.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Account Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <!-- Nav Item - Entries Menu -->
      <li class="nav-item <?php echo $account_menu; ?>">
        <a class="<?php echo $account_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#accounthead" aria-expanded="true" aria-controls="accounthead">
          <i class="fas fa-fw fa-folder"></i>
          <span>A/c Head Creation</span>
        </a>
        <div id="accounthead" class="<?php echo $account_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Accounts Head"){ echo "active"; }?>" href="accountshead_list.php">List</a>
            <a class="collapse-item <?php if($page_title == "Add Accounts Head"){ echo "active"; }?>" href="accountshead_add.php">Add</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <!-- Nav Item - Entries Menu -->
      <li class="nav-item <?php echo $entry_menu; ?>">
        <a class="<?php echo $entry_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#Entries" aria-expanded="true" aria-controls="Entries">
          <i class="fas fa-fw fa-folder"></i>
          <span>Entries</span>
        </a>
        <div id="Entries" class="<?php echo $entry_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "List Payments Entry" || $page_title == "Add Payments Entry" || $page_title == "View Payments Entry"){ echo "active"; }?>" href="payments_add.php">Payments</a>
            <a class="collapse-item <?php if($page_title == "List Receipts Entry" || $page_title == "Add Receipts Entry" || $page_title == "View Receipts Entry"){ echo "active"; }?>" href="receipts_add.php">Receipts</a>
            <a class="collapse-item" href="javascript:;">Journal</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
	  
      <!-- Nav Item - Reports Menu -->
      <li class="nav-item <?php echo $report_menu; ?>">
        <a class="<?php echo $report_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#Reports" aria-expanded="true" aria-controls="Reports">
          <i class="fas fa-fw fa-folder"></i>
          <span>Reports</span>
        </a>
        <div id="Reports" class="<?php echo $report_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "DayBook View"){ echo "active"; }?>" href="reports_daybook_view.php">Day Book View</a>
            <a class="collapse-item <?php if($page_title == "Ledger View"){ echo "active"; }?>" href="reports_ledger_view.php">Ledger View</a>
			<a class="collapse-item <?php if($page_title == "Book Balance View"){ echo "active"; }?>" href="reports_book_balance_view.php">Book Balance View</a>
            <a class="collapse-item <?php if($page_title == "Trial Balance View"){ echo "active"; }?>" href="reports_trial_balance_view.php">TB View</a>
			<a class="collapse-item <?php if($page_title == "Profit & Loss A/c View"){ echo "active"; }?>" href="reports_profile_loss_view.php">P & L A/c View</a>
          </div>
        </div>
      </li>
	  
	   <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <!-- Nav Item - Reports Menu -->
      <li class="nav-item <?php echo $account_settings_menu; ?>">
        <a class="<?php echo $account_settings_parent_nav_class;?>" href="#" data-toggle="collapse" data-target="#accountsettings" aria-expanded="true" aria-controls="accountsettings">
          <i class="fas fa-fw fa-cog"></i>
          <span>Account Settings</span>
        </a>
        <div id="accountsettings" class="<?php echo $account_settings_child_nav_class;?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php if($page_title == "Balance Updates"){ echo "active"; }?>" href="balance_updates.php">Balance Updates</a>
          </div>
        </div>
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