<?php

// Data functions (insert, update, delete, form) for table external_entity

// This script and data application were generated by AppGini 5.40
// Download AppGini for free from http://bigprof.com/appgini/download/

function external_entity_insert(){
	global $Translation;

	if($_GET['insert_x']!=''){$_POST=$_GET;}

	// mm: can member insert record?
	$arrPerm=getTablePermissions('external_entity');
	if(!$arrPerm[1]){
		return false;
	}

	$data['company_name'] = makeSafe($_POST['company_name']);
		if($data['company_name'] == empty_lookup_value){ $data['company_name'] = ''; }

	$data['company_class'] = makeSafe($_POST['company_class']);
		if($data['company_class'] == empty_lookup_value){ $data['company_class'] = ''; }

	$data['primary_email'] = makeSafe($_POST['primary_email']);
		if($data['primary_email'] == empty_lookup_value){ $data['primary_email'] = ''; }
	$data['alternate_email'] = makeSafe($_POST['alternate_email']);
		if($data['alternate_email'] == empty_lookup_value){ $data['alternate_email'] = ''; }
	$data['phone'] = makeSafe($_POST['phone']);
		if($data['phone'] == empty_lookup_value){ $data['phone'] = ''; }
	$data['country'] = makeSafe($_POST['country']);
		if($data['country'] == empty_lookup_value){ $data['country'] = ''; }
	$data['city'] = makeSafe($_POST['city']);
		if($data['city'] == empty_lookup_value){ $data['city'] = ''; }
	$data['street'] = makeSafe($_POST['street']);
		if($data['street'] == empty_lookup_value){ $data['street'] = ''; }
	$data['zip'] = makeSafe($_POST['zip']);
		if($data['zip'] == empty_lookup_value){ $data['zip'] = ''; }
	$data['comments'] = makeSafe($_POST['comments']);
		if($data['comments'] == empty_lookup_value){ $data['comments'] = ''; }

	// hook: external_entity_before_insert
	if(function_exists('external_entity_before_insert')){
		$args=array();
		if(!external_entity_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('insert into `external_entity` set       `company_name`=' . (($data['company_name'] !== '' && $data['company_name'] !== NULL) ? "'{$data['company_name']}'" : 'NULL') . ', `company_class`=' . (($data['company_class'] !== '' && $data['company_class'] !== NULL) ? "'{$data['company_class']}'" : 'NULL') . ', `primary_email`=' . (($data['primary_email'] !== '' && $data['primary_email'] !== NULL) ? "'{$data['primary_email']}'" : 'NULL') . ', `alternate_email`=' . (($data['alternate_email'] !== '' && $data['alternate_email'] !== NULL) ? "'{$data['alternate_email']}'" : 'NULL') . ', `phone`=' . (($data['phone'] !== '' && $data['phone'] !== NULL) ? "'{$data['phone']}'" : 'NULL') . ', `country`=' . (($data['country'] !== '' && $data['country'] !== NULL) ? "'{$data['country']}'" : 'NULL') . ',`city`=' . (($data['city'] !== '' && $data['city'] !== NULL) ? "'{$data['city']}'" : 'NULL') . ', `street`=' . (($data['street'] !== '' && $data['street'] !== NULL) ? "'{$data['street']}'" : 'NULL') . ', `zip`=' . (($data['zip'] !== '' && $data['zip'] !== NULL) ? "'{$data['zip']}'" : 'NULL') . ', `comments`=' . (($data['comments'] !== '' && $data['comments'] !== NULL) ? "'{$data['comments']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"external_entity_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID=db_insert_id(db_link());

	// hook: external_entity_after_insert
	if(function_exists('external_entity_after_insert')){
		$res = sql("select * from `external_entity` where `id`='" . makeSafe($recID) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID);
		$args=array();
		if(!external_entity_after_insert($data, getMemberInfo(), $args)){ return (get_magic_quotes_gpc() ? stripslashes($recID) : $recID); }
	}

	// mm: save ownership data
	sql("insert into membership_userrecords set tableName='external_entity', pkValue='$recID', memberID='".getLoggedMemberID()."', dateAdded='".time()."', dateUpdated='".time()."', groupID='".getLoggedGroupID()."'", $eo);

	return (get_magic_quotes_gpc() ? stripslashes($recID) : $recID);
}


function external_entity_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('external_entity');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='external_entity' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='external_entity' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: external_entity_before_delete
	if(function_exists('external_entity_before_delete')){
		$args=array();
		if(!external_entity_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// child table: pirl_dashboard
	$res = sql("select `id` from `external_entity` where `id`='$selected_id'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("select count(1) from `pirl_dashboard` where `external_entity_name`='".addslashes($id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "pirl_dashboard", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "pirl_dashboard", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='external_entity_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='external_entity_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	sql("delete from `external_entity` where `id`='$selected_id'", $eo);

	// hook: external_entity_after_delete
	if(function_exists('external_entity_after_delete')){
		$args=array();
		external_entity_after_delete($selected_id, getMemberInfo(), $args);
	}
	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='external_entity' and pkValue='$selected_id'", $eo);
}

function external_entity_update($selected_id){
	global $Translation;

	if($_GET['update_x']!=''){$_POST=$_GET;}

	// mm: can member edit record?
	$arrPerm=getTablePermissions('external_entity');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='external_entity' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='external_entity' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['company_name'] = makeSafe($_POST['company_name']);
		if($data['company_name'] == empty_lookup_value){ $data['company_name'] = ''; }
	$data['company_class'] = makeSafe($_POST['company_class']);
		if($data['company_class'] == empty_lookup_value){ $data['company_class'] = ''; }
	$data['primary_email'] = makeSafe($_POST['primary_email']);
		if($data['primary_email'] == empty_lookup_value){ $data['primary_email'] = ''; }
	$data['alternate_email'] = makeSafe($_POST['alternate_email']);
		if($data['alternate_email'] == empty_lookup_value){ $data['alternate_email'] = ''; }
	$data['phone'] = makeSafe($_POST['phone']);
		if($data['phone'] == empty_lookup_value){ $data['phone'] = ''; }
	$data['country'] = makeSafe($_POST['country']);
		if($data['country'] == empty_lookup_value){ $data['country'] = ''; }
	$data['city'] = makeSafe($_POST['city']);
		if($data['city'] == empty_lookup_value){ $data['city'] = ''; }
	$data['street'] = makeSafe($_POST['street']);
		if($data['street'] == empty_lookup_value){ $data['street'] = ''; }
	
	$data['zip'] = makeSafe($_POST['zip']);
		if($data['zip'] == empty_lookup_value){ $data['zip'] = ''; }
	$data['comments'] = makeSafe($_POST['comments']);
		if($data['comments'] == empty_lookup_value){ $data['comments'] = ''; }
	$data['selectedID']=makeSafe($selected_id);

	// hook: external_entity_before_update
	if(function_exists('external_entity_before_update')){
		$args=array();
		if(!external_entity_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `external_entity` set  `company_name`=' . (($data['company_name'] !== '' && $data['company_name'] !== NULL) ? "'{$data['company_name']}'" : 'NULL') . ',  `company_class`=' . (($data['company_class'] !== '' && $data['company_class'] !== NULL) ? "'{$data['company_class']}'" : 'NULL') . ', `primary_email`=' . (($data['primary_email'] !== '' && $data['primary_email'] !== NULL) ? "'{$data['primary_email']}'" : 'NULL') . ', `alternate_email`=' . (($data['alternate_email'] !== '' && $data['alternate_email'] !== NULL) ? "'{$data['alternate_email']}'" : 'NULL') . ', `phone`=' . (($data['phone'] !== '' && $data['phone'] !== NULL) ? "'{$data['phone']}'" : 'NULL') . ', `country`=' . (($data['country'] !== '' && $data['country'] !== NULL) ? "'{$data['country']}'" : 'NULL') . ', `city`=' . (($data['city'] !== '' && $data['city'] !== NULL) ? "'{$data['city']}'" : 'NULL') . ', `street`=' . (($data['street'] !== '' && $data['street'] !== NULL) ? "'{$data['street']}'" : 'NULL') . ',  `zip`=' . (($data['zip'] !== '' && $data['zip'] !== NULL) ? "'{$data['zip']}'" : 'NULL') . ', `comments`=' . (($data['comments'] !== '' && $data['comments'] !== NULL) ? "'{$data['comments']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="external_entity_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}
	// hook: external_entity_after_update
	if(function_exists('external_entity_after_update')){
		$res = sql("SELECT * FROM `external_entity` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!external_entity_after_update($data, getMemberInfo(), $args)){ return; }
	}
	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='external_entity' and pkValue='".makeSafe($selected_id)."'", $eo);	
}

function external_entity_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('external_entity');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}
	// populate filterers, starting from children to grand-parents
	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	//combo company name
	$combo_company_name = new DataCombo;
	//combo company class
	$combo_company_class = new Combo;
	$combo_company_class->ListType = 2;
	$combo_company_class->MultipleSeparator = ', ';
	$combo_company_class->ListBoxHeight = 10;
	$combo_company_class->RadiosPerLine = 5;
	if(is_file(dirname(__FILE__).'/hooks/external_entity.company_class.csv')){
		$company_class_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/external_entity.company_class.csv')));
		$combo_company_class->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions($country_data)));
		$combo_company_class->ListData = $combo_company_class->ListItem;
	}else{
		$combo_company_class->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions("A;;B;;C;;D")));
		$combo_company_class->ListData = $combo_company_class->ListItem;
	}
	$combo_company_class->SelectName = 'company_class';

	// combobox: country
	$combo_country = new Combo;
	$combo_country->ListType = 0;
	$combo_country->MultipleSeparator = ', ';
	$combo_country->ListBoxHeight = 10;
	$combo_country->RadiosPerLine = 1;
	if(is_file(dirname(__FILE__).'/hooks/external_entity.country.csv')){
		$country_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/external_entity.country.csv')));
		$combo_country->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions($country_data)));
		$combo_country->ListData = $combo_country->ListItem;
	}else{
		$combo_country->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions("Afghanistan;;Albania;;Algeria;;American Samoa;;Andorra;;Angola;;Anguilla;;Antarctica;;Antigua, Barbuda;;Argentina;;Armenia;;Aruba;;Australia;;Austria;;Azerbaijan;;Bahamas;;Bahrain;;Bangladesh;;Barbados;;Belarus;;Belgium;;Belize;;Benin;;Bermuda;;Bhutan;;Bolivia;;Bosnia, Herzegovina;;Botswana;;Bouvet Is.;;Brazil;;Brunei Darussalam;;Bulgaria;;Burkina Faso;;Burundi;;Cambodia;;Cameroon;;Canada;;Canary Is.;;Cape Verde;;Cayman Is.;;Central African Rep.;;Chad;;Channel Islands;;Chile;;China;;Christmas Is.;;Cocos Is.;;Colombia;;Comoros;;Congo, D.R. Of;;Congo;;Cook Is.;;Costa Rica;;Croatia;;Cuba;;Cyprus;;Czech Republic;;Denmark;;Djibouti;;Dominica;;Dominican Republic;;Ecuador;;Egypt;;El Salvador;;Equatorial Guinea;;Eritrea;;Estonia;;Ethiopia;;Falkland Is.;;Faroe Is.;;Fiji;;Finland;;France;;French Guiana;;French Polynesia;;French Territories;;Gabon;;Gambia;;Georgia;;Germany;;Ghana;;Gibraltar;;Greece;;Greenland;;Grenada;;Guadeloupe;;Guam;;Guatemala;;Guernsey;;Guinea-bissau;;Guinea;;Guyana;;Haiti;;Heard, Mcdonald Is.;;Honduras;;Hong Kong;;Hungary;;Iceland;;India;;Indonesia;;Iran;;Iraq;;Ireland;;Israel;;Italy;;Ivory Coast;;Jamaica;;Japan;;Jersey;;Jordan;;Kazakhstan;;Kenya;;Kiribati;;Korea, D.P.R Of;;Korea, Rep. Of;;Kuwait;;Kyrgyzstan;;Lao Peoples D.R.;;Latvia;;Lebanon;;Lesotho;;Liberia;;Libyan Arab Jamahiriya;;Liechtenstein;;Lithuania;;Luxembourg;;Macao;;Macedonia, F.Y.R Of;;Madagascar;;Malawi;;Malaysia;;Maldives;;Mali;;Malta;;Mariana Islands;;Marshall Islands;;Martinique;;Mauritania;;Mauritius;;Mayotte;;Mexico;;Micronesia;;Moldova;;Monaco;;Mongolia;;Montserrat;;Morocco;;Mozambique;;Myanmar;;Namibia;;Nauru;;Nepal;;Netherlands Antilles;;Netherlands;;New Caledonia;;New Zealand;;Nicaragua;;Niger;;Nigeria;;Niue;;Norfolk Island;;Norway;;Oman;;Pakistan;;Palau;;Palestinian Terr.;;Panama;;Papua New Guinea;;Paraguay;;Peru;;Philippines;;Pitcairn;;Poland;;Portugal;;Puerto Rico;;Qatar;;Reunion;;Romania;;Russian Federation;;Rwanda;;Samoa;;San Marino;;Sao Tome, Principe;;Saudi Arabia;;Senegal;;Seychelles;;Sierra Leone;;Singapore;;Slovakia;;Slovenia;;Solomon Is.;;Somalia;;South Africa;;South Georgia;;South Sandwich Is.;;Spain;;Sri Lanka;;St. Helena;;St. Kitts, Nevis;;St. Lucia;;St. Pierre, Miquelon;;St. Vincent, Grenadines;;Sudan;;Suriname;;Svalbard, Jan Mayen;;Swaziland;;Sweden;;Switzerland;;Syrian Arab Republic;;Taiwan;;Tajikistan;;Tanzania;;Thailand;;Timor-leste;;Togo;;Tokelau;;Tonga;;Trinidad, Tobago;;Tunisia;;Turkey;;Turkmenistan;;Turks, Caicoss;;Tuvalu;;Uganda;;Ukraine;;United Arab Emirates;;United Kingdom;;United States;;Uruguay;;Uzbekistan;;Vanuatu;;Vatican City;;Venezuela;;Viet Nam;;Virgin Is. British;;Virgin Is. U.S.;;Wallis, Futuna;;Western Sahara;;Yemen;;Yugoslavia;;Zambia;;Zimbabwe")));
		$combo_country->ListData = $combo_country->ListItem;
	}
	$combo_country->SelectName = 'country';

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='external_entity' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='external_entity' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}
		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `external_entity` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found']);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
		$combo_country->SelectedData = $row['country'];
		$combo_company_class->SelectedData = $row['company_class'];
	
	}else{
		$combo_company_class->SelectedText = ( $_REQUEST['FilterField'][1]=='2' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "");
		$combo_country->SelectedText = ( $_REQUEST['FilterField'][1]=='9' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "France");
	}
	$combo_country->Render();
	$combo_company_class->Render();
	ob_start();
	?>

	<script>
		// initial lookup values

		jQuery(function() {
		});
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$templateCode = @file_get_contents('./templates/external_entity_templateDVP.html');
	}else{
		$templateCode = @file_get_contents('./templates/external_entity_templateDV.html');
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'External entity', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return external_entity_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return external_entity_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'window.parent.jQuery(\'.modal\').modal(\'hide\'); return false;';
	}else{
		$backAction = '$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode=str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return external_entity_validateData();"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}
	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#company_name').replaceWith('<div class=\"form-control-static\" id=\"company_name\">' + (jQuery('#company_name').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#company_class').replaceWith('<div class=\"form-control-static\" id=\"company_class\">' + (jQuery('#company_class').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#primary_email').replaceWith('<div class=\"form-control-static\" id=\"primary_email\">' + (jQuery('#primary_email').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#primary_email, #primary_email-edit-link').hide();\n";
		$jsReadOnly .= "\tjQuery('#alternate_email').replaceWith('<div class=\"form-control-static\" id=\"alternate_email\">' + (jQuery('#alternate_email').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#alternate_email, #alternate_email-edit-link').hide();\n";
		$jsReadOnly .= "\tjQuery('#phone').replaceWith('<div class=\"form-control-static\" id=\"phone\">' + (jQuery('#phone').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#country').replaceWith('<div class=\"form-control-static\" id=\"country\">' + (jQuery('#country').val() || '') + '</div>'); jQuery('#country-multi-selection-help').hide();\n";
		$jsReadOnly .= "\tjQuery('#city').replaceWith('<div class=\"form-control-static\" id=\"city\">' + (jQuery('#city').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#street').replaceWith('<div class=\"form-control-static\" id=\"street\">' + (jQuery('#street').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#zip').replaceWith('<div class=\"form-control-static\" id=\"zip\">' + (jQuery('#zip').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}
	// process combos
	$templateCode=str_replace('<%%COMBO(country)%%>', $combo_country->HTML, $templateCode);
	$templateCode=str_replace('<%%COMBOTEXT(country)%%>', $combo_country->SelectedData, $templateCode);

	$templateCode=str_replace('<%%COMBO(company_class)%%>', $combo_company_class->HTML, $templateCode);
	$templateCode=str_replace('<%%COMBOTEXT(company_class)%%>', $combo_company_class->SelectedData, $templateCode);
	/* parent tables array: parent table name => array('lookup field name', 'lookup field caption') */

	$parent_tables = array();
	foreach($parent_tables as $pt => $luf){
		$pt_perm = getTablePermissions($pt);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf[0]})%%>", '<button type="button" class="btn btn-default view_parent hspacer-lg" id="' . $pt . '_view_parent" title="' . htmlspecialchars($Translation['View'] . ' ' . $luf[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}
		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$pt})%%>", '<button type="button" class="btn btn-success add_new_parent" id="' . $pt . '_add_new" title="' . htmlspecialchars($Translation['Add New'] . ' ' . $luf[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}
	// process images
	$templateCode=str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(company_name)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(company_class)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(primary_email)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(alternate_email)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(phone)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(country)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(city)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(street)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(zip)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(comments)%%>', '', $templateCode);

	// process values
	if($selected_id){
		$templateCode=str_replace('<%%VALUE(id)%%>', htmlspecialchars($row['id'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode=str_replace('<%%VALUE(company_name)%%>', htmlspecialchars($row['company_name'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(company_name)%%>', urlencode($urow['company_name']), $templateCode);
		$templateCode=str_replace('<%%VALUE(company_class)%%>', htmlspecialchars($row['company_class'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(company_class)%%>', urlencode($urow['company_class']), $templateCode);
		$templateCode=str_replace('<%%VALUE(primary_email)%%>', htmlspecialchars($row['primary_email'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(primary_email)%%>', urlencode($urow['primary_email']), $templateCode);
		$templateCode=str_replace('<%%VALUE(alternate_email)%%>', htmlspecialchars($row['alternate_email'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(alternate_email)%%>', urlencode($urow['alternate_email']), $templateCode);
		$templateCode=str_replace('<%%VALUE(phone)%%>', htmlspecialchars($row['phone'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(phone)%%>', urlencode($urow['phone']), $templateCode);
		$templateCode=str_replace('<%%VALUE(country)%%>', htmlspecialchars($row['country'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(country)%%>', urlencode($urow['country']), $templateCode);
		$templateCode=str_replace('<%%VALUE(city)%%>', htmlspecialchars($row['city'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(city)%%>', urlencode($urow['city']), $templateCode);
		$templateCode=str_replace('<%%VALUE(street)%%>', htmlspecialchars($row['street'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(street)%%>', urlencode($urow['street']), $templateCode);
		$templateCode=str_replace('<%%VALUE(zip)%%>', htmlspecialchars($row['zip'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(zip)%%>', urlencode($urow['zip']), $templateCode);
		if($AllowUpdate || $AllowInsert){
			$templateCode=str_replace('<%%HTMLAREA(comments)%%>', '<textarea name="comments" id="comments" rows="5">'.htmlspecialchars($row['comments'], ENT_QUOTES).'</textarea>', $templateCode);
		}else{
			$templateCode=str_replace('<%%HTMLAREA(comments)%%>', $row['comments'], $templateCode);
		}
		$templateCode=str_replace('<%%VALUE(comments)%%>', nl2br($row['comments']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(comments)%%>', urlencode($urow['comments']), $templateCode);
	}else{
		$templateCode=str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(company_name)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(company_name)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(company_class)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(company_class)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(date_of_birth)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(date_of_birth)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(primary_email)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(primary_email)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(alternate_email)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(alternate_email)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(phone)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(phone)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(country)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(country)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(city)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(city)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(street)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(street)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(zip)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(zip)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%HTMLAREA(comments)%%>', '<textarea name="comments" id="comments" rows="5"></textarea>', $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode=str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode=str_replace('<%%', '<!-- ', $templateCode);
	$templateCode=str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_POST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
			$templateCode.="\n\tif(document.getElementById('primary_emailEdit')){ document.getElementById('primary_emailEdit').style.display='inline'; }";
			$templateCode.="\n\tif(document.getElementById('primary_emailEditLink')){ document.getElementById('primary_emailEditLink').style.display='none'; }";
			$templateCode.="\n\tif(document.getElementById('alternate_emailEdit')){ document.getElementById('alternate_emailEdit').style.display='inline'; }";
			$templateCode.="\n\tif(document.getElementById('alternate_emailEditLink')){ document.getElementById('alternate_emailEditLink').style.display='none'; }";
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode=preg_replace('/blank.gif" rel="lightbox\[.*?\]"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	// hook: external_entity_dv
	if(function_exists('external_entity_dv')){
		$args=array();
		external_entity_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>