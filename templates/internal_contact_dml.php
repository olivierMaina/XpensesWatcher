<?php

// Data functions (insert, update, delete, form) for table internal_contact

// This script and data application were generated by AppGini 5.40
// Download AppGini for free from http://bigprof.com/appgini/download/

function internal_contact_insert(){
	global $Translation;

	if($_GET['insert_x']!=''){$_POST=$_GET;}

	// mm: can member insert record?
	$arrPerm=getTablePermissions('internal_contact');
	if(!$arrPerm[1]){
		return false;
	}
	$data['cec'] = makeSafe($_POST['cec']);
		if($data['cec'] == empty_lookup_value){ $data['cec'] = ''; }
	$data['last_name'] = makeSafe($_POST['last_name']);
		if($data['last_name'] == empty_lookup_value){ $data['last_name'] = ''; }
	$data['first_name'] = makeSafe($_POST['first_name']);
		if($data['first_name'] == empty_lookup_value){ $data['first_name'] = ''; }
	$data['poste'] = makeSafe($_POST['function']);
		if($data['function'] == empty_lookup_value){ $data['function'] = ''; }
	$data['email'] = makeSafe($_POST['email']);
		if($data['email'] == empty_lookup_value){ $data['email'] = ''; }
	$data['phone'] = makeSafe($_POST['phone']);
		if($data['phone'] == empty_lookup_value){ $data['phone'] = ''; }
	$data['country'] = makeSafe($_POST['country']);
		if($data['country'] == empty_lookup_value){ $data['country'] = ''; }
	$data['info'] = makeSafe($_POST['info']);
		if($data['info'] == empty_lookup_value){ $data['info'] = ''; }

	// hook: internal_contact_before_insert
	if(function_exists('internal_contact_before_insert')){
		$args=array();
		if(!internal_contact_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('insert into `internal_contact` set      `cec`=' . (($data['cec'] !== '' && $data['cec'] !== NULL) ? "'{$data['cec']}'" : 'NULL') . ', `last_name`=' . (($data['last_name'] !== '' && $data['last_name'] !== NULL) ? "'{$data['last_name']}'" : 'NULL') . ',`first_name`=' . (($data['first_name'] !== '' && $data['first_name'] !== NULL) ? "'{$data['first_name']}'" : 'NULL') . ',`function`=' . (($data['function'] !== '' && $data['function'] !== NULL) ? "'{$data['function']}'" : 'NULL') . ', `email`=' . (($data['email'] !== '' && $data['email'] !== NULL) ? "'{$data['email']}'" : 'NULL') . ', `phone`=' . (($data['phone'] !== '' && $data['phone'] !== NULL) ? "'{$data['phone']}'" : 'NULL') . ', `country`=' . (($data['country'] !== '' && $data['country'] !== NULL) ? "'{$data['country']}'" : 'NULL') . ',`info`=' . (($data['info'] !== '' && $data['info'] !== NULL) ? "'{$data['info']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"internal_contact_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID=db_insert_id(db_link());

	// hook: internal_contact_after_insert
	if(function_exists('internal_contact_after_insert')){
		$res = sql("select * from `internal_contact` where `id`='" . makeSafe($recID) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID);
		$args=array();
		if(!internal_contact_after_insert($data, getMemberInfo(), $args)){ return (get_magic_quotes_gpc() ? stripslashes($recID) : $recID); }
	}

	// mm: save ownership data
	sql("insert into membership_userrecords set tableName='internal_contact', pkValue='$recID', memberID='".getLoggedMemberID()."', dateAdded='".time()."', dateUpdated='".time()."', groupID='".getLoggedGroupID()."'", $eo);

	return (get_magic_quotes_gpc() ? stripslashes($recID) : $recID);
}


function internal_contact_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('internal_contact');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='internal_contact' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='internal_contact' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: internal_contact_before_delete
	if(function_exists('internal_contact_before_delete')){
		$args=array();
		if(!internal_contact_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// child table: pirl_dahboard
	$res = sql("select `id` from `internal_contact` where `id`='$selected_id'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("select count(1) from `pirl_dahboard` where `internal_contact_name`='".addslashes($id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "pirl_dahboard", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "pirl_dahboard", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='internal_contact_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='internal_contact_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	sql("delete from `internal_contact` where `id`='$selected_id'", $eo);

	// hook: internal_contact_after_delete
	if(function_exists('internal_contact_after_delete')){
		$args=array();
		internal_contact_after_delete($selected_id, getMemberInfo(), $args);
	}
	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='internal_contact' and pkValue='$selected_id'", $eo);
}

function internal_contact_update($selected_id){
	global $Translation;

	if($_GET['update_x']!=''){$_POST=$_GET;}

	// mm: can member edit record?
	$arrPerm=getTablePermissions('internal_contact');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='internal_contact' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='internal_contact' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['cec'] = makeSafe($_POST['cec']);
		if($data['cec'] == empty_lookup_value){ $data['cec'] = ''; }
	$data['last_name'] = makeSafe($_POST['last_name']);
		if($data['last_name'] == empty_lookup_value){ $data['last_name'] = ''; }
	$data['first_name'] = makeSafe($_POST['first_name']);
		if($data['first_name'] == empty_lookup_value){ $data['first_name'] = ''; }
	$data['function'] = makeSafe($_POST['function']);
		if($data['function'] == empty_lookup_value){ $data['function'] = ''; }
	$data['email'] = makeSafe($_POST['email']);
		if($data['email'] == empty_lookup_value){ $data['email'] = ''; }
	$data['phone'] = makeSafe($_POST['phone']);
		if($data['phone'] == empty_lookup_value){ $data['phone'] = ''; }
	$data['country'] = makeSafe($_POST['country']);
		if($data['country'] == empty_lookup_value){ $data['country'] = ''; }
	$data['info'] = makeSafe($_POST['info']);
		if($data['info'] == empty_lookup_value){ $data['info'] = ''; }
	$data['selectedID']=makeSafe($selected_id);

	// hook: internal_contact_before_update
	if(function_exists('internal_contact_before_update')){
		$args=array();
		if(!internal_contact_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `internal_contact` set    `cec`=' . (($data['cec'] !== '' && $data['cec'] !== NULL) ? "'{$data['cec']}'" : 'NULL') . ', `last_name`=' . (($data['last_name'] !== '' && $data['last_name'] !== NULL) ? "'{$data['last_name']}'" : 'NULL') . ',`first_name`=' . (($data['first_name'] !== '' && $data['first_name'] !== NULL) ? "'{$data['first_name']}'" : 'NULL') . ',`function`=' . (($data['function'] !== '' && $data['function'] !== NULL) ? "'{$data['function']}'" : 'NULL') . ', `email`=' . (($data['email'] !== '' && $data['email'] !== NULL) ? "'{$data['email']}'" : 'NULL') . ', `phone`=' . (($data['phone'] !== '' && $data['phone'] !== NULL) ? "'{$data['phone']}'" : 'NULL') . ', `country`=' . (($data['country'] !== '' && $data['country'] !== NULL) ? "'{$data['country']}'" : 'NULL') . ',`info`=' . (($data['info'] !== '' && $data['info'] !== NULL) ? "'{$data['info']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="internal_contact_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}
	// hook: internal_contact_after_update
	if(function_exists('internal_contact_after_update')){
		$res = sql("SELECT * FROM `internal_contact` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!internal_contact_after_update($data, getMemberInfo(), $args)){ return; }
	}
	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='internal_contact' and pkValue='".makeSafe($selected_id)."'", $eo);	
}

function internal_contact_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('internal_contact');
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

	$combo_last_name = new DataCombo;
	$combo_first_name = new DataCombo;
	$combo_company_function = new DataCombo;
	$combo_cec = new DataCombo;

	// combobox: country
	$combo_country = new Combo;
	$combo_country->ListType = 0;
	$combo_country->MultipleSeparator = ', ';
	$combo_country->ListBoxHeight = 10;
	$combo_country->RadiosPerLine = 1;
	if(is_file(dirname(__FILE__).'/hooks/internal_contact.country.csv')){
		$country_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/internal_contact.country.csv')));
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
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='internal_contact' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='internal_contact' and pkValue='".makeSafe($selected_id)."'");
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

		$res = sql("select * from `internal_contact` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found']);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
		$combo_country->SelectedData = $row['country'];
	
	}else{
		$combo_country->SelectedText = ( $_REQUEST['FilterField'][1]=='9' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "");
	}
	$combo_country->Render();
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
		$templateCode = @file_get_contents('./templates/internal_contact_templateDVP.html');
	}else{
		$templateCode = @file_get_contents('./templates/internal_contact_templateDV.html');
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'External Contact', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return internal_contact_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return internal_contact_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return internal_contact_validateData();"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#cec').replaceWith('<div class=\"form-control-static\" id=\"cec\">' + (jQuery('#cec').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#last_name').replaceWith('<div class=\"form-control-static\" id=\"last_name\">' + (jQuery('#last_name').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#first_name').replaceWith('<div class=\"form-control-static\" id=\"first_name\">' + (jQuery('#first_name').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#function').replaceWith('<div class=\"form-control-static\" id=\"function\">' + (jQuery('#function').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#email').replaceWith('<div class=\"form-control-static\" id=\"email\">' + (jQuery('#email').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#email, #email-edit-link').hide();\n";

		$jsReadOnly .= "\tjQuery('#phone').replaceWith('<div class=\"form-control-static\" id=\"phone\">' + (jQuery('#phone').val() || '') + '</div>');\n";
	
		$jsReadOnly .= "\tjQuery('#country').replaceWith('<div class=\"form-control-static\" id=\"country\">' + (jQuery('#country').val() || '') + '</div>'); jQuery('#country-multi-selection-help').hide();\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}
	// process combos
	$templateCode=str_replace('<%%COMBO(country)%%>', $combo_country->HTML, $templateCode);
	$templateCode=str_replace('<%%COMBOTEXT(country)%%>', $combo_country->SelectedData, $templateCode);
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
	$templateCode=str_replace('<%%UPLOADFILE(cec)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(last_name)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(first_name)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(function)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(email)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(phone)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(country)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(info)%%>', '', $templateCode);
	// process values
	if($selected_id){
		$templateCode=str_replace('<%%VALUE(id)%%>', htmlspecialchars($row['id'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);

		$templateCode=str_replace('<%%VALUE(cec)%%>', htmlspecialchars($row['cec'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(cec)%%>', urlencode($urow['cec']), $templateCode);

		$templateCode=str_replace('<%%VALUE(last_name)%%>', htmlspecialchars($row['last_name'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(last_name)%%>', urlencode($urow['last_name']), $templateCode);

		$templateCode=str_replace('<%%VALUE(first_name)%%>', htmlspecialchars($row['first_name'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(first_name)%%>', urlencode($urow['first_name']), $templateCode);

		$templateCode=str_replace('<%%VALUE(funtion)%%>', htmlspecialchars($row['funtion'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(funtion)%%>', urlencode($urow['funtion']), $templateCode);

		$templateCode=str_replace('<%%VALUE(email)%%>', htmlspecialchars($row['email'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(email)%%>', urlencode($urow['email']), $templateCode);

		$templateCode=str_replace('<%%VALUE(phone)%%>', htmlspecialchars($row['phone'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(phone)%%>', urlencode($urow['phone']), $templateCode);

		$templateCode=str_replace('<%%VALUE(country)%%>', htmlspecialchars($row['country'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(country)%%>', urlencode($urow['country']), $templateCode);
		if($AllowUpdate || $AllowInsert){
			$templateCode=str_replace('<%%HTMLAREA(info)%%>', '<textarea name="info" id="info" rows="5">'.htmlspecialchars($row['info'], ENT_QUOTES).'</textarea>', $templateCode);
		}else{
			$templateCode=str_replace('<%%HTMLAREA(info)%%>', $row['info'], $templateCode);
		}
		$templateCode=str_replace('<%%VALUE(info)%%>', nl2br($row['info']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(info)%%>', urlencode($urow['info']), $templateCode);
	}else{
		$templateCode=str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(cec)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(cec)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(last_name)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(last_name)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(first_name)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(first_name)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(function)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(function)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(email)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(email)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(phone)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(phone)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(country)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(country)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%HTMLAREA(info)%%>', '<textarea name="info" id="info" rows="5"></textarea>', $templateCode);
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
			$templateCode.="\n\tif(document.getElementById('emailEdit')){ document.getElementById('emailEdit').style.display='inline'; }";
			$templateCode.="\n\tif(document.getElementById('emailEditLink')){ document.getElementById('emailEditLink').style.display='none'; }";
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

	// hook: internal_contact_dv
	if(function_exists('internal_contact_dv')){
		$args=array();
		internal_contact_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>