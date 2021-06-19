<?php

$uri=$_SERVER['REQUEST_URI'];
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$parts = parse_url($url);
$path=$parts['path'];
?>
<nav class="navbar-default navbar-static-side w-bg" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<img src="../assets/img/small_logo.jpg">
				<div class="dropdown">
					<b class="logged-in-user1 user-info">
						<span id="role_name_sidebar"></span>
						<span id="state_sidebar"></span>
						<span id="district_sidebar"></span>
						<span id="block_sidebar"></span>
					</b>
				</div>
			</li>

			<li> <a href="../auth/dashboard.php"><img src="../assets/img/menuicon/dashboard.png"> <span class="nav-label">Dashboard</span></a></li>
			

			
			<?php 
			if(strpos($path, 'role-management')!==false)
			{
				$role_management='active';
				$role_management_collapse='in';
			}
			?>
			<li class="hidden role <?php echo isset($role_management)?$role_management:'';?>"> <a href="#"><img src="../assets/img/menuicon/user.png"> <span class="nav-label">Role Management</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="hidden role_view"><a href="../role-management/role-listing.php">View Roles</a></li>
					<li class="hidden role_add"><a href="../role-management/add_role.php">Create Roles</a></li>
					
				</ul>
			</li>
			<?php 
			if(strpos($path, 'permission-management')!==false)
			{
				$permission_mapping='active';
				$permission_mapping_collapse='in';
			}
			?>
			
			<li class="hidden role_mapping_view role_mapping_add role_mapping_edit role_mapping_status"> <a href="../role-mapping/view-role-mapping.php"><img src="../assets/img/menuicon/role_mapping.png"><span class="nav-label"> Scrutiny Management</span></a>
				
			</li>

			<li class="hidden user_management"> <a href="#"><img src="../assets/img/menuicon/user_management.png"> <span class="nav-label">User Management</span><span class="fa arrow fa-2"></span></a>
		        <ul class="nav nav-second-level collapse">
		          <li class="hidden user_management_view"><a href="../user/user-listing.php">User Listing</a></li>
		        </ul>
		      </li>


		     <?php 
			if(strpos($path, 'project-proposal')!==false)
			{
				$project_proposal='active';
				$project_proposal_collapse='in';
			}
			if(strpos($path, 'modification-infrastructure')!==false)
			{
				$infra_proposal='active'; 
			}
			?>
			<li class="hidden mfp_procurement_plan <?php echo isset($project_proposal)?$project_proposal:'';?>"> <a href="#"><img src="../assets/img/menuicon/proposals.png"> <span class="nav-label">MFP Procurement</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="hidden mfp_procurement_plan_add"><a href="../project-proposal/step1.php">Add Form</a></li>
					<li class="hidden mfp_procurement_plan_view"><a href="../project-proposal/mfp-procurement-listing.php">Listing</a></li>
					
				</ul>
			</li>
			

			<li class="hidden infrastructure_development <?php echo isset($infra_proposal)?$infra_proposal:'';?>"> <a href="#"><img src="../assets/img/menuicon/user.png"> <span class="nav-label">Infrastructure Development</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="hidden infrastructure_development_add"><a href="../modification-infrastructure/step1.php">Add Form</a></li> 
					<li class="hidden infrastructure_development_view"><a href="../modification-infrastructure/infrastructure-development-listing.php">Listing</a></li>					
				</ul>
			</li>

			<li class="approval-management"> <a href="#"><img src="../assets/img/menuicon/approved-management.png"> <span class="nav-label">Approval Management</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class=""><a href="../proposal-verification/mfp-procurement-verification.php?tab=1">MFP Proposals Pending For Verifications</a></li>
					<li><a href="../proposal-verification/infrastructure-development-verification.php?tab=1">Infrastructure Proposals Pending For Verifications</a></li>
				</ul>
			</li>

			<li class="warehouse-management"> <a href="#"><img src="../assets/img/menuicon/approved-management.png"> <span class="nav-label">Warehouse Management</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="../warehouse-management/warehouse-listing.php">Warehouse Listing</a></li>
				</ul>
			</li>

			 
			<?php 
			if(strpos($path, 'fund-management')!==false)
			{
				$approved_consolidate='active';
			}
			?>
			<li class="hidden fund_management <?php echo isset($approved_consolidate)?$approved_consolidate:'';?>"> <a href="#"><img src="../assets/img/menuicon/fund-management.png"> <span class="nav-label">Fund Management</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="hidden fund_management_approved_consolidate_view"><a href="../fund-management/consolidated-list.php">MFP Procurement Generate Sanction</a></li>
					<li class="hidden fund_management_view_sanction_letter"><a href="../fund-management/sanctioned-letter-list.php">MFP Procurement Sanctioned List</a></li>
					<li id="scrutinylevelrelease" class="hidden fund_management_release_fund"><a href="../fund-management/mfp_procurement_release_fund.php">MFP Procurement Release Fund</a></li>
					<li class="hidden fund_management_view_mfp_procurement_received_fund"><a href="../fund-management/mfp_procurement_received_fund.php">MFP Procurement Received Fund</a></li>
					<li class="hidden fund_management_view_procurement_agent_received_fund"><a href="../survey-forms/shg-gatherer-management.php">SHG Gatherer Manage</a></li>
					<li class="hidden fund_management_view_procurement_agent_fund_details"><a href="../fund-management/procurement_agent_fund_detail.php">Procurement Agent Fund Details</a></li>
					<li class="hidden fund_management_view_procurement_agent_received_fund"><a href="../fund-management/mfp_procurement_pa_received_fund.php">Procurement Agent Received Fund</a></li>
					
					<li class="hidden mfp_procurement_actual_details_view"><a href="../actual-details/tribal-details-list.php">MFP Procurement View Transaction Details</a></li>
					
					<li class="hidden fund_management_approved_consolidate_view"><a href="../fund-management/infrastructure-consolidated-list.php">Infrastructure Generate Sanction</a></li>
					<li class="hidden fund_management_view_sanction_letter"><a href="../fund-management/infrastructure-sanctioned-letter-list.php">Infrastructure Sanctioned List</a></li>
					<li class="hidden fund_management_release_fund"><a href="../fund-management/infrastructure_release_fund.php">Infrastructure Release Fund</a></li> 
					
					
					<li class="hidden fund_management_infrastructure_development_received_fund"><a href="../fund-management/infrastructure_received_fund.php">Infrastructure Received Fund</a></li> 
					
					<li class="hidden fund_management_infrastructure_progress_details"><a href="../fund-management/infrastructure_progress_details.php">Infrastructure Listing Details</a></li> 
					
					<li class="hidden mfp_procurement_transaction_details_view"><a href="../actual-details/mfp_procurement_transaction_details_list.php">Procurement Transaction Details</a></li> 
					<li class="hidden mfp_procurement_transaction_details_consolidated_transaction_view_PA"><a href="../actual-details/list_of_proposal_consolidated_transaction.php">Consolidated Transaction List(PA)</a></li> 
					<li class="hidden mfp_procurement_transaction_details_consolidated_transaction_view"><a href="../actual-details/list_of_proposal_consolidated_transaction_dia.php">Consolidated Transaction List</a></li> 
					
					<li class="hidden fund_management_received_infrastructure_consolidated_proposal"><a href="../fund-management/received_infrastructure_consolidated_proposal.php">Received Infrastructure Consolidated Proposal</a></li> 


					<li class="hidden fund_management_view_dia_commission_details"><a href="../fund-management/commission_received_by_dia.php">Commission Received by DIA</a></li> 
					<li class="hidden fund_management_view_sia_commission_details"><a href="../fund-management/commission_received_by_sia.php">Commission Received by SIA</a></li> 

					<li class="hidden fund_management_view_sia_commission_details"><a href="../fund-management/infrastructure_commission_received_by_sia.php">Infrastructure Commission Received by SIA</a></li> 


					<li class="hidden fund_management_view_dia_commission_details"><a href="../fund-management/infrastructure_commission_received.php"> Received DIA Infrastructure Commission </a></li> 

				</ul>
			</li>
			<li class="hidden mfp_details_view"> <a href="../proposal-verification/last_five_years_mfp_details.php"><img src="../assets/img/menuicon/dashboard.png"> <span class="nav-label">MFP Details</span></a></li>
			<?php 
			if(strpos($path, 'auction')!==false)
			{
				$auction='active';
				$auction_collapse='in';
			}
			?>
			<li class="hidden auction <?php echo isset($auction)?$auction:'';?>"> <a href="#"><img src="../assets/img/menuicon/proposals.png"> <span class="nav-label">Auction</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="hidden auction_create_committe"><a href="../auction/create_committe.php?type=1">Create Committee</a></li>
					<li class="hidden auction_create_committe"><a href="../auction/create_committe.php?type=2">Create Committee(Value Added Products)</a></li>
					<li class="hidden auction_view_committe"><a href="../auction/auction-committe-list.php">Auction Committee List</a></li>
					<li class="hidden auction_create_transaction_detail"><a href="../auction/add-auction-transaction-detail.php?type=1">Create Auction Transaction Detail</a></li>

					<li class="hidden auction_create_transaction_detail"><a href="../auction/add-auction-transaction-detail.php?type=2">Create Auction Transaction Detail(Value Added Products)</a></li>

					<li class="hidden auction_view_transaction_detail"><a href="../auction/auction-transaction-list.php?type=1">View Auction Transaction Detail</a></li>
					<li class="hidden auction_view_transaction_detail"><a href="../auction/auction-transaction-list.php?type=2">View Auction Transaction Detail(Value Added Products)</a></li>
				</ul>
			</li>
			<?php 
			if(strpos($path, 'masters')!==false)
			{
				$masters='active';
				$masters_collapse='in';
			}
			?>
			<li class="hidden master_management <?php echo isset($masters)?$masters:'';?>"> <a href="user-listing.html"><img src="../assets/img/menuicon/key.png"> <span class="nav-label">Master Management</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					
					<li> <a href="../masters/commission-master-list.php"><span class="nav-label">Commission Master</span></a></li>
					<li> <a href="../masters/haat-bazaar-list.php"><span class="nav-label">Haat Bazaar Master</span></a></li>
					<li> <a href="../masters/packing-master-list.php"><span class="nav-label">Packing Master</span></a></li>
					<li> <a href="user-listing.html"><span class="nav-label">Item Master</span><span class="fa arrow fa-2"></span></a>
						<ul class="nav nav-third-level collapse">
							<li> <a href="../masters/haat-bazaar-items.php">Haat Bazaar Items</a></li>
							<li><a href="../masters/warehouse-items.php">Warehouse Items</a></li>
							<li><a href="../masters/multipurpose-procurement-centre-items.php">Multipurpose Procurement Centre Items</a></li> 
						</ul>
					</li>
					<li> <a href="user-listing.html"><span class="nav-label">Area Master</span><span class="fa arrow fa-2"></span></a>
						<ul class="nav nav-third-level collapse">
							<li><a href="../masters/state-master.php">State</a></li>
							<li><a href="../masters/district-master.php">District</a></li>
							<li><a href="../masters/block-master.php">Block/Tehsil</a></li>
							<li><a href="../masters/village-master.php">Village</a></li>
						</ul>
					</li>
					<li><a href="../masters/mfp-master.php">MFP Master</a></li>
					<li><a href="../masters/mfp-master-logs.php">MFP Price Logs</a></li>
					<li><a href="../masters/warehouse-master.php">Warehouse Master</a></li>
					

					<li> <a href="user-listing.html"><span class="nav-label">Other Master</span><span class="fa arrow fa-2"></span></a>
					  <ul class="nav nav-third-level collapse">
						<li><a href="../masters/financial-year-master.php">Financial Year</a></li>
						<li><a href="../masters/designation-master.php">Designation</a></li>
						<li><a href="../masters/department-master.php">Department</a></li>
					
						<li><a href="../masters/level-master.php">Level</a></li>
					
					  </ul>
					</li>
				</ul>
			</li>
    

    		<?php 
			if(strpos($path, 'msp_market_price')!==false)
			{
				$msp_market_price='active';
			}
			?>
			<li class="hidden msp_market_price  <?php echo isset($msp_market_price)?$msp_market_price:'';?>"> <a href="#"><img src="../assets/img/menuicon/proposals.png"> <span class="nav-label">MSP Market</span><span class="fa arrow fa-2"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="hidden msp_market_price_add "><a href="../msp_market_price/add_msp_market_price.php">Add MSP Market Price</a></li>
					<li class="hidden msp_market_price_view_pending "><a href="../msp_market_price/msp_market_price_listing.php">Pending MSP Market Listing</a></li>
					<li class="hidden msp_market_price_view_approved "><a href="../msp_market_price/msp_market_price_approved_listing.php">Approved MSP Market Listing</a></li>
					<li class="hidden msp_market_price_approval "><a href="../msp_market_price/msp_market_price_approval_listing.php">Approval MSP Market Listing</a></li>
				</ul>
			</li>

    <li> <a href="#" onclick="TRIFED.logout();"><img src="../assets/img/menuicon/logout.png"> <span class="nav-label">Log-out</span></a></li>
    </ul>
  </div>
</nav>
