<?php
		$pcConfig = array(
			'pirl_dashboard' => array(   
				'external_entity_name' => array(   
					'parent-table' => 'external_entity',
					'parent-primary-key' => 'id',
					'child-primary-key' => 'id',
					'child-primary-key-index' => 0,
					'tab-label' => 'PIRL - Dashboard',
					'table-icon' => 'resources/table_icons/Cisco_small.png',
					'display-refresh' => true,
					'display-add-new' => true,
					'forced-where' => '',
					'display-fields' => array(1 => 'Dashboard', 2 => 'Category', 3 => 'External entity', 4 => 'Engagement nature', 5 => 'Engagement', 6 => 'External Contact', 7 => 'Thread', 8 => 'Thread description', 9 => 'Thread status', 10 => 'Start', 11 => 'End', 12 => 'Country', 13 => 'Internal Contact', 14 => 'Useful info' ),
					'display-field-names' => array(1 => 'dashboard', 2 => 'category', 3 => 'external_entity_name', 4 => 'engagement_nature', 5 => 'engagement', 6 => 'external_contact_name', 7 => 'thread', 8 => 'thread_description', 9 => 'thread_status', 10 => 'start_date', 11 => 'end_date', 12 => 'country', 13 =>'internal_contact_name', 14 => 'usefull_info'),
					'sortable-fields' => array(1 => '2', 2 => '3', 3 => '4', 4 => '5', 5 => '6', 6 => '7', 7 => '8', 8 => '9', 9 => '`pirl_dashboard`.`start_date`', 10 => '`pirl_dashboard`.`end_date`', 11 => '12', 12 => '13', 13 => '14'),
					'records-per-page' => 10,
					'default-sort-by' => false,
					'default-sort-direction' => 'asc',
					'open-detail-view-on-click' => true,
					'display-page-selector' => true,
					'show-page-progress' => true,
					'template' => 'children-pirl_dashboard',
					'query' => "SELECT `pirl_dashboard`.`id` as 'id',
									   `pirl_dashboard`.`dashboard` as 'dashboard',
									   `pirl_dashboard`.`category` as 'category',
					 					IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('',   `external_entity1`.`company_name`), '') as 'external_entity_name',
					 				   `pirl_dashboard`.`engagement_nature` as 'engagement_nature',
					 				   `pirl_dashboard`.`engagement` as 'engagement',
					   					IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('', `external_contact1`.`first_name`, ' ', `external_contact1`.`last_name`), '') as 'external_contact_name',
					    			   `pirl_dashboard`.`thread` as 'thread',
					    			   `pirl_dashboard`.`thread_description` as 'thread_description',
					    			   `pirl_dashboard`.`thread_status` as 'thread_status',
					    			    if(`pirl_dashboard`.`start_date`,date_format(`pirl_dashboard`.`start_date`,'%m/%d/%Y'),'') as 'start_date',
					    			    if(`pirl_dashboard`.`end_date`,date_format(`pirl_dashboard`.`end_date`,'%m/%d/%Y'),'') as 'end_date',
					    			   `pirl_dashboard`.`country` as 'country',
									   	IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('', `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') as 'internal_contact_name',
					    			    `pirl_dashboard`.`usefull_info` as 'usefull_info'

					    		FROM `pirl_dashboard`    

					    		LEFT JOIN `external_entity` as external_entity1 ON `external_entity1`.`id`=`pirl_dashboard`.`external_entity_name` 
					 			LEFT JOIN `external_contact` as external_contact1 ON `external_contact1`.`id`=`pirl_dashboard`.`external_contact_name` 
					    		LEFT JOIN `internal_contact` as internal_contact1 ON `internal_contact1`.`id`=`pirl_dashboard`.`internal_contact_name` "
				),
				'external_contact_name' => array(   
					'parent-table' => 'external_contact',
					'parent-primary-key' => 'id',
					'child-primary-key' => 'id',
					'child-primary-key-index' => 0,
					'tab-label' => 'PIRL Dashboard',
					'table-icon' => 'resources/table_icons/Cisco_small.png',
					'display-refresh' => true,
					'display-add-new' => true,
					'forced-where' => '',
					'display-fields' => array(1 => 'Dashboard', 2 => 'Category', 3 => 'External entity', 4 => 'Engagement nature', 5 => 'Engagement', 6 => 'External Contact', 7 => 'Thread', 8 => 'Thread description', 9 => 'Thread status', 10 => 'Start', 11 => 'End', 12 => 'Country', 13 =>  'Internal Contact', 14 => 'Useful info'),
					'display-field-names' => array(1 => 'dashboard', 2 => 'category', 3 => 'external_entity_name', 4 => 'engagement_nature', 5 => 'engagement', 6 => 'external_contact_name', 7 => 'thread', 8 => 'thread_description', 9 => 'thread_status', 10 => 'start_date', 11 => 'end_date', 12 => 'country', 13 =>'internal_contact_name', 14 => 'usefull_info'),
					'sortable-fields' => array(1 => '2', 2 => '3', 3 => '4', 4 => '5', 5 => '6', 6 => '7', 7 => '8', 8 => '9', 9 => '`pirl_dashboard`.`start_date`', 10 => '`pirl_dashboard`.`end_date`', 11 => '12', 12 => '13', 13 => '14'),
					'records-per-page' => 10,
					'default-sort-by' => false,
					'default-sort-direction' => 'asc',
					'open-detail-view-on-click' => true,
					'display-page-selector' => true,
					'show-page-progress' => true,
					'template' => 'children-pirl_dashboard',
					'query' => "SELECT `pirl_dashboard`.`id` as 'id',
									   `pirl_dashboard`.`dashboard` as 'dashboard',
									   `pirl_dashboard`.`category` as 'category',
					 					IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('',   `external_entity1`.`company_name`), '') as 'external_entity_name',
					 				   `pirl_dashboard`.`engagement_nature` as 'engagement_nature',
					 				   `pirl_dashboard`.`engagement` as 'engagement',
					   					IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('', `external_contact1`.`first_name`, ' ', `external_contact1`.`last_name`), '') as 'external_contact_name',
					    			   `pirl_dashboard`.`thread` as 'thread',
					    			   `pirl_dashboard`.`thread_description` as 'thread_description',
					    			   `pirl_dashboard`.`thread_status` as 'thread_status',
					    			    if(`pirl_dashboard`.`start_date`,date_format(`pirl_dashboard`.`start_date`,'%m/%d/%Y'),'') as 'start_date',
					    			   if(`pirl_dashboard`.`end_date`,date_format(`pirl_dashboard`.`end_date`,'%m/%d/%Y'),'') as 'end_date',
					    			   `pirl_dashboard`.`country` as 'country', 
									   	IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('', `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') as 'internal_contact_name',
									   	`pirl_dashboard`.`usefull_info` as 'usefull_info'
					    		FROM `pirl_dashboard` 

					    		LEFT JOIN `external_entity` as external_entity1 ON `external_entity1`.`id`=`pirl_dashboard`.`external_entity_name` 
					 			LEFT JOIN `external_contact` as external_contact1 ON `external_contact1`.`id`=`pirl_dashboard`.`external_contact_name` 
					    		LEFT JOIN `internal_contact` as internal_contact1 ON `internal_contact1`.`id`=`pirl_dashboard`.`internal_contact_name` "	
				),
				'internal_contact_name' => array(   
					'parent-table' => 'internal_contact',
					'parent-primary-key' => 'id',
					'child-primary-key' => 'id',
					'child-primary-key-index' => 0,
					'tab-label' => 'PIRL Dashboard',
					'table-icon' => 'resources/table_icons/Cisco_small.png',
					'display-refresh' => true,
					'display-add-new' => true,
					'forced-where' => '',
					'display-fields' => array(1 => 'Dashboard', 2 => 'Category', 3 => 'External entity', 4 => 'Engagement nature', 5 => 'Engagement', 6 => 'External Contact', 7 => 'Thread', 8 => 'Thread description', 9 => 'Thread status', 10 => 'Start', 11 => 'End', 12 => 'Country', 13 => 'Internal Contact', 14 => 'Useful info'),
					'display-field-names' => array(1 => 'dashboard', 2 => 'category', 3 => 'external_entity_name', 4 => 'engagement_nature', 5 => 'engagement', 6 => 'external_contact_name', 7 => 'thread', 8 => 'thread_description', 9 => 'thread_status', 10 => 'start_date', 11 => 'end_date', 12 => 'country', 13 =>'internal_contact_name', 14 => 'usefull_info'),
					'sortable-fields' => array(1 => '2', 2 => '3', 3 => '4', 4 => '5', 5 => '6', 6 => '7', 7 => '8', 8 => '9', 9 => '`pirl_dashboard`.`start_date`', 10 => '`pirl_dashboard`.`end_date`', 11 => '12', 12 => '13', 13 => '14'),
					'records-per-page' => 10,
					'default-sort-by' => false,
					'default-sort-direction' => 'asc',
					'open-detail-view-on-click' => true,
					'display-page-selector' => true,
					'show-page-progress' => true,
					'template' => 'children-pirl_dashboard',
					'query' => "SELECT `pirl_dashboard`.`id` as 'id',
									   `pirl_dashboard`.`dashboard` as 'dashboard',
									   `pirl_dashboard`.`category` as 'category',
					 					IF(    CHAR_LENGTH(`external_entity1`.`company_name`), CONCAT_WS('',   `external_entity1`.`company_name`), '') as 'external_entity_name',
					 				   `pirl_dashboard`.`engagement_nature` as 'engagement_nature',
					 				   `pirl_dashboard`.`engagement` as 'engagement',
					   					IF(    CHAR_LENGTH(`external_contact1`.`first_name`) || CHAR_LENGTH(`external_contact1`.`last_name`), CONCAT_WS('', `external_contact1`.`first_name`, '', `external_contact1`.`last_name`), '') as 'external_contact_name',
					    			   `pirl_dashboard`.`thread` as 'thread',
					    			   `pirl_dashboard`.`thread_description` as 'thread_description',
					    			   `pirl_dashboard`.`thread_status` as 'thread_status',
					    			    if(`pirl_dashboard`.`start_date`,date_format(`pirl_dashboard`.`start_date`,'%m/%d/%Y'),'') as 'start_date',
					    			   if(`pirl_dashboard`.`end_date`,date_format(`pirl_dashboard`.`end_date`,'%m/%d/%Y'),'') as 'end_date',
					    			   `pirl_dashboard`.`country` as 'country',
					    				IF(    CHAR_LENGTH(`internal_contact1`.`first_name`) || CHAR_LENGTH(`internal_contact1`.`last_name`), CONCAT_WS('', `internal_contact1`.`first_name`, ' ', `internal_contact1`.`last_name`), '') as 'internal_contact_name',
					    			   `pirl_dashboard`.`usefull_info` as 'usefull_info'
					    		FROM `pirl_dashboard` 

					    		LEFT JOIN `external_entity` as external_entity1 ON `external_entity1`.`id`=`pirl_dashboard`.`external_entity_name` 
					 			LEFT JOIN `external_contact` as external_contact1 ON `external_contact1`.`id`=`pirl_dashboard`.`external_contact_name` 
					    		LEFT JOIN `internal_contact` as internal_contact1 ON `internal_contact1`.`id`=`pirl_dashboard`.`internal_contact_name` "
				)
			),
			'external_entity' => array( 
			),
			'external_contact' => array( 
			),
			'internal_contact' => array( 
			)
			
		);

	/*************************************/
	/* End of configuration */

	@header("Content-Type: text/html; charset=UTF-8");
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	/**
	* dynamic configuration based on current user's permissions
	* $userPCConfig array is populated only with parent tables where the user has access to
	* at least one child table
	*/
	$userPCConfig = array();
	foreach($pcConfig as $pcChildTable => $ChildrenLookups){
		$permChild = getTablePermissions($pcChildTable);
		if($permChild[2]){ // user can view records of the child table, so proceed to check children lookups
			foreach($ChildrenLookups as $ChildLookupField => $ChildConfig){
				$permParent = getTablePermissions($ChildConfig['parent-table']);
				if($permParent[2]){ // user can view records of parent table
					$userPCConfig[$pcChildTable][$ChildLookupField] = $pcConfig[$pcChildTable][$ChildLookupField];
					// show add new only if configured above AND the user has insert permission
					if($permChild[1] && $pcConfig[$pcChildTable][$ChildLookupField]['display-add-new']){
						$userPCConfig[$pcChildTable][$ChildLookupField]['display-add-new'] = true;
					}else{
						$userPCConfig[$pcChildTable][$ChildLookupField]['display-add-new'] = false;
					}
				}
			}
		}
	}

	/* Receive, UTF-convert, and validate parameters */
	$ParentTable = $_REQUEST['ParentTable']; // needed only with operation=show-children, will be validated in the processing code
	$ChildTable = $_REQUEST['ChildTable'];
		if(!in_array($ChildTable, array_keys($userPCConfig))){
			/* defaults to first child table in config array if not provided */
			$ChildTable = current(array_keys($userPCConfig));
		}
		if(!$ChildTable){ die('<!-- No tables accessible to current user -->'); }
	$SelectedID = $_REQUEST['SelectedID'];
	$ChildLookupField = $_REQUEST['ChildLookupField'];
		if(!in_array($ChildLookupField, array_keys($userPCConfig[$ChildTable]))){
			/* defaults to first lookup in current child config array if not provided */
			$ChildLookupField = current(array_keys($userPCConfig[$ChildTable]));
		}
	$Page = intval($_REQUEST['Page']);
		if($Page < 1){
			$Page = 1;
		}
	$SortBy = ($_REQUEST['SortBy'] != '' ? abs(intval($_REQUEST['SortBy'])) : false);
		if(!in_array($SortBy, array_keys($userPCConfig[$ChildTable][$ChildLookupField]['sortable-fields']), true)){
			$SortBy = $userPCConfig[$ChildTable][$ChildLookupField]['default-sort-by'];
		}
	$SortDirection = strtolower($_REQUEST['SortDirection']);
		if(!in_array($SortDirection, array('asc', 'desc'))){
			$SortDirection = $userPCConfig[$ChildTable][$ChildLookupField]['default-sort-direction'];
		}
	$Operation = strtolower($_REQUEST['Operation']);
		if(!in_array($Operation, array('get-records', 'show-children'))){
			$Operation = 'get-records';
		}
	/* process requested operation */
	switch($Operation){
		/************************************************/
		case 'show-children':
			/* populate HTML and JS content with children tabs */
			$tabLabels = $tabPanels = $tabLoaders = '';
			foreach($userPCConfig as $ChildTable => $childLookups){
				foreach($childLookups as $ChildLookupField => $childConfig){
					if($childConfig['parent-table'] == $ParentTable){
						$TableIcon = ($childConfig['table-icon'] ? "<img src=\"{$childConfig['table-icon']}\" border=\"0\" />" : '');
						$tabLabels .= sprintf('<li%s><a href="#panel_%s-%s" id="tab_%s-%s" data-toggle="tab">%s%s</a></li>' . "\n\t\t\t\t\t",($tabLabels ? '' : ' class="active"'), $ChildTable, $ChildLookupField, $ChildTable, $ChildLookupField, $TableIcon, $childConfig['tab-label']);
						$tabPanels .= sprintf('<div id="panel_%s-%s" class="tab-pane%s"><img src="loading.gif" align="top" />%s</div>' . "\n\t\t\t\t", $ChildTable, $ChildLookupField, ($tabPanels ? '' : ' active'), $Translation['Loading ...']);
						$tabLoaders .= sprintf('post("parent-children.php", { ChildTable: "%s", ChildLookupField: "%s", SelectedID: "%s", Page: 1, SortBy: "", SortDirection: "", Operation: "get-records" }, "panel_%s-%s");' . "\n\t\t\t\t", $ChildTable, $ChildLookupField, addslashes($SelectedID), $ChildTable, $ChildLookupField);
					}
				}
			}

			if(!$tabLabels){ die('<!-- no children of current parent table are accessible to current user -->'); }
			?>
			<div id="children-tabs">
				<ul class="nav nav-tabs">
					<?php echo $tabLabels; ?>
				</ul>
				<span id="pc-loading"></span>
			</div>
			<div class="tab-content"><?php echo $tabPanels; ?></div>

			<script>
				/* ajax loading of each tab's contents */
				<?php echo $tabLoaders; ?>
			</script>
			<?php
			break;

		/************************************************/
		default: /* default is 'get-records' */

			// build the user permissions limiter
			$permissionsWhere = $permissionsJoin = '';
			if($permChild[2] == 1){ // user can view only his own records
				$permissionsWhere = "`$ChildTable`.`{$userPCConfig[$ChildTable][$ChildLookupField]['child-primary-key']}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='$ChildTable' AND LCASE(`membership_userrecords`.`memberID`)='".getLoggedMemberID()."'";
			}elseif($permChild[2] == 2){ // user can view only his group's records
				$permissionsWhere = "`$ChildTable`.`{$userPCConfig[$ChildTable][$ChildLookupField]['child-primary-key']}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='$ChildTable' AND `membership_userrecords`.`groupID`='".getLoggedGroupID()."'";
			}elseif($permChild[2] == 3){ // user can view all records
				/* that's the only case remaining ... no need to modify the query in this case */
			}
			$permissionsJoin = ($permissionsWhere ? ", `membership_userrecords`" : '');

			// build the count query
			$forcedWhere = $userPCConfig[$ChildTable][$ChildLookupField]['forced-where'];
			$query = 
				preg_replace('/^select .* from /i', 'SELECT count(1) FROM ', $userPCConfig[$ChildTable][$ChildLookupField]['query']) .
				$permissionsJoin . " WHERE " .
				($permissionsWhere ? "( $permissionsWhere )" : "( 1=1 )") . " AND " .
				($forcedWhere ? "( $forcedWhere )" : "( 2=2 )") . " AND " .
				"`$ChildTable`.`$ChildLookupField`='" . makeSafe($SelectedID) . "'";
			$totalMatches = sqlValue($query);

			// make sure $Page is <= max pages
			$maxPage = ceil($totalMatches / $userPCConfig[$ChildTable][$ChildLookupField]['records-per-page']);
			if($Page > $maxPage){ $Page = $maxPage; }

			// initiate output data array
			$data = array(
				'config' => $userPCConfig[$ChildTable][$ChildLookupField],
				'parameters' => array(
					'ChildTable' => $ChildTable,
					'ChildLookupField' => $ChildLookupField,
					'SelectedID' => $SelectedID,
					'Page' => $Page,
					'SortBy' => $SortBy,
					'SortDirection' => $SortDirection,
					'Operation' => 'get-records'
				),
				'records' => array(),
				'totalMatches' => $totalMatches
			);

			// build the data query
			if($totalMatches){ // if we have at least one record, proceed with fetching data
				$startRecord = $userPCConfig[$ChildTable][$ChildLookupField]['records-per-page'] * ($Page - 1);
				$data['query'] = 
					$userPCConfig[$ChildTable][$ChildLookupField]['query'] .
					$permissionsJoin . " WHERE " .
					($permissionsWhere ? "( $permissionsWhere )" : "( 1=1 )") . " AND " .
					($forcedWhere ? "( $forcedWhere )" : "( 2=2 )") . " AND " .
					"`$ChildTable`.`$ChildLookupField`='" . makeSafe($SelectedID) . "'" . 
					($SortBy !== false && $userPCConfig[$ChildTable][$ChildLookupField]['sortable-fields'][$SortBy] ? " ORDER BY {$userPCConfig[$ChildTable][$ChildLookupField]['sortable-fields'][$SortBy]} $SortDirection" : '') .
					" LIMIT $startRecord, {$userPCConfig[$ChildTable][$ChildLookupField]['records-per-page']}";
				$res = sql($data['query'], $eo);
				while($row = db_fetch_row($res)){
					$data['records'][$row[$userPCConfig[$ChildTable][$ChildLookupField]['child-primary-key-index']]] = $row;
				}
			}else{ // if no matching records
				$startRecord = 0;
			}

			$response = loadView($userPCConfig[$ChildTable][$ChildLookupField]['template'], $data);

			// change name space to ensure uniqueness
			$uniqueNameSpace = $ChildTable.ucfirst($ChildLookupField).'GetRecords';
			echo str_replace("{$ChildTable}GetChildrenRecordsList", $uniqueNameSpace, $response);
		/************************************************/
	}
