<?php
// This script and data application were generated by AppGini 5.40
// Download AppGini for free from http://bigprof.com/appgini/download/
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/pirl_dashboard.php");
	include("$currDir/pirl_dashboard_dml.php");
	// mm: can the current member access this page?



	$perm=getTablePermissions('pirl_dashboard');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}
	$x = new DataList;
	$x->TableName = "pirl_dashboard";
	// Fields that can be displayed in the table view
	$x->QueryFieldsTV=array(   
		"`pirl_dashboard`.`id`" => "id",
		"`pirl_dashboard`.`dashboard`" => "dashboard",
		"`pirl_dashboard`.`category`" => "category",
		"IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('', `external_entity1`.`company_name`), '')  /* External entity */" => "external_entity_name",
		"`pirl_dashboard`.`engagement_nature`" => "engagement_nature",
		"`pirl_dashboard`.`engagement`" => "engagement",
		"IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('',   `external_contact1`.`first_name`, ' ', `external_contact1`.`last_name`), '') /* Extenal contact */" => "external_contact_name",
		"`pirl_dashboard`.`thread`" => "thread",
		"`pirl_dashboard`.`thread_description`" => "thread_description",
		"`pirl_dashboard`.`thread_status`" => "thread_status",
		"if(`pirl_dashboard`.`start_date`,date_format(`pirl_dashboard`.`start_date`,'%m/%d/%Y'),'')" => "start_date",
		"if(`pirl_dashboard`.`end_date`,date_format(`pirl_dashboard`.`end_date`,'%m/%d/%Y'),'')" => "end_date",
		"`pirl_dashboard`.`country`" => "country",
		"IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('',   `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') /* Internal contact */" => "internal_contact_name",
		"`pirl_dashboard`.`usefull_info`" => "usefull_info"


	);
	// mapping incoming sort by requests to actual query fields

	$x->SortFields = array(   
		1 => '`pirl_dashboard`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => '`pirl_dashboard`.`start_date`',
		12 => '`pirl_dashboard`.`end_date`',
		13 => 13,
		14 => 14,
		15 => 15
		

	);
	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV=array(   
		"`pirl_dashboard`.`id`" => "id",
		"`pirl_dashboard`.`dashboard`" => "dashboard",
		"`pirl_dashboard`.`category`" => "category",
		"IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('', `external_entity1`.`company_name`), '')  /* External entity */" => "external_entity_name",
		"`pirl_dashboard`.`engagement_nature`" => "engagement_nature",
		"`pirl_dashboard`.`engagement`" => "engagement",
		"IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('',   `external_contact1`.`first_name`, ' ', `external_contact1`.`last_name`), '') /* Extenal contact */" => "external_contact_name",
		"`pirl_dashboard`.`thread`" => "thread",
		"`pirl_dashboard`.`thread_description`" => "thread_description",
		"`pirl_dashboard`.`thread_status`" => "thread_status",
		"if(`pirl_dashboard`.`start_date`,date_format(`pirl_dashboard`.`start_date`,'%m/%d/%Y'),'')" => "start_date",
		"if(`pirl_dashboard`.`end_date`,date_format(`pirl_dashboard`.`end_date`,'%m/%d/%Y'),'')" => "end_date",
		"`pirl_dashboard`.`country`" => "country",
		"IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('',   `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') /* Internal Contact */" => "internal_contact_name",
		"`pirl_dashboard`.`usefull_info`" => "usefull_info"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters=array(   
		"`pirl_dashboard`.`id`" => "ID",
		"`pirl_dashboard`.`dashboard`" => "Dashboard",
		"`pirl_dashboard`.`category`" => "Category",
		"IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('', `external_entity1`.`company_name`), '')  /* External entity */" => "external_entity_name",
		"`pirl_dashboard`.`engagement_nature`" => "Engagement nature",
		"`pirl_dashboard`.`engagement`" => "Engagement",
		"IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('',   `external_contact1`.`first_name`, ' ', `external_contact1`.`last_name`), '') /* Extenal contact */" => "external_contact_name",
		"`pirl_dashboard`.`thread`" => "Thread",
		"`pirl_dashboard`.`thread_description`" => "Thread description",
		"`pirl_dashboard`.`thread_status`" => "Thread status",
		"`pirl_dashboard`.`start_date`" => "Start",
		"`pirl_dashboard`.`end_date`" => "End",
		"`pirl_dashboard`.`country`" => "Country",
		"IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('',   `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') /* Internal contact */" => "internal_contact_name",
		"`pirl_dashboard`.`usefull_info`" => "Useful info"
	);
	// Fields that can be quick searched
	$x->QueryFieldsQS=array(   
		"`pirl_dashboard`.`id`" => "id",
		"`pirl_dashboard`.`dashboard`" => "dashboard",
		"`pirl_dashboard`.`category`" => "category",
		"IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('', `external_entity1`.`company_name`), '')  /* External entity */" => "external_entity_name",
		"`pirl_dashboard`.`engagement_nature`" => "engagement_nature",
		"`pirl_dashboard`.`engagement`" => "engagement",
		"IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('',   `external_contact1`.`first_name`, ' ', `external_contact1`.`last_name`), '') /* Extenal contact */" => "external_contact_name",
		"`pirl_dashboard`.`thread`" => "thread",
		"`pirl_dashboard`.`thread_description`" => "thread_description",
		"`pirl_dashboard`.`thread_status`" => "thread_status",
		"if(`pirl_dashboard`.`start_date`,date_format(`pirl_dashboard`.`start_date`,'%m/%d/%Y'),'')" => "start_date",
		"if(`pirl_dashboard`.`end_date`,date_format(`pirl_dashboard`.`end_date`,'%m/%d/%Y'),'')" => "end_date",
		"`pirl_dashboard`.`country`" => "country",
		"IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('',   `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') /* Internal contact */" => "internal_contact_name",
		"`pirl_dashboard`.`usefull_info`" => "usefull_info"
	);
	// Lookup fields that can be used as filterers
	$x->filterers = array(  'external_contact_name' => 'External contact', 'external_entity_name' => 'External entity', 'internal_contact_name' => 'Internal contact');
	$x->QueryFrom="`pirl_dashboard` LEFT JOIN `external_entity` as external_entity1 ON `external_entity1`.`id`=`pirl_dashboard`.`external_entity_name` LEFT JOIN `external_contact` as external_contact1 ON `external_contact1`.`id`=`pirl_dashboard`.`external_contact_name` LEFT JOIN `internal_contact` as internal_contact1 ON `internal_contact1`.`id`=`pirl_dashboard`.`internal_contact_name` ";
	$x->QueryWhere='';
	$x->QueryOrder='';
	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "pirl_dashboard_view.php";
	$x->RedirectAfterInsert = "pirl_dashboard_view.php?SelectedID=#ID#";
	$x->TableTitle = "PIRL - Dashboard";
	$x->TableIcon = "resources/table_icons/Cisco_small.png";
	$x->PrimaryKey = "`pirl_dashboard`.`id`";
	$x->ColWidth   = array(  80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80);
	$x->ColCaption = array("Dashboard", "Category", "External Entity", "Engagement nature", "Engagement", "External contact", "Thread", "Thread description", "Thread status", "Start", "End", "Country", "Internal contact", "Useful info");
	$x->ColFieldName = array('dashboard', 'category', 'external_entity_name', 'engagement_nature', 'engagement', 'external_contact_name', 'thread', 'thread_description','thread_status','start_date', 'end_date', 'country', 'internal_contact_name', 'usefull_info');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
	$x->Template = 'templates/pirl_dashboard_templateTV.html';
	$x->SelectedTemplate = 'templates/pirl_dashboard_templateTVS.html';
	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		// echo '<script language="javascript"> alert("I am in $perm[2]=1");</script>'; 
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `pirl_dashboard`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='pirl_dashboard' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `pirl_dashboard`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='pirl_dashboard' and membership_userrecords.groupID='".getLoggedGroupID()."'";
		// echo '<script language="javascript"> alert("I am in $perm[2]=2");</script>'; 
	}elseif($perm[2]==3){ // view all
		// echo '<script language="javascript"> alert("I am in $perm[2]=3");</script>'; 
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");

		$x->QueryFrom = '`pirl_dashboard`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
		// echo '<script language="javascript"> alert("I am in $perm[2]=0");</script>'; 
	}
	// hook: pirl_dashboard_init
	$render=TRUE;
	if(function_exists('pirl_dashboard_init')){
		$args=array();
		$render=pirl_dashboard_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();
	// hook: pirl_dashboard_header
	$headerCode='';
	if(function_exists('pirl_dashboard_header')){
		$args=array();
		$headerCode=pirl_dashboard_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	
	// hook: pirl_dashboard_footer
	$footerCode='';
	if(function_exists('pirl_dashboard_footer')){
		$args=array();
		$footerCode=pirl_dashboard_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>