<?php
	$currDir=dirname(__FILE__);
	require("$currDir/incCommon.php");

	// get groupID of anonymous group
	$anonGroupID=sqlValue("select groupID from membership_groups where name='".$adminConfig['anonymousGroup']."'");

	// request to save changes?
	if($_POST['saveChanges']!=''){
		// validate data
		$name=makeSafe($_POST['name']);
		$description=makeSafe($_POST['description']);
		switch($_POST['visitorSignup']){
			case 0:
				$allowSignup=0;
				$needsApproval=1;
				break;
			case 2:
				$allowSignup=1;
				$needsApproval=0;
				break;
			default:
				$allowSignup=1;
				$needsApproval=1;
		}

		###############################
		$xpenses_insert=checkPermissionVal('xpenses_insert');
		$xpenses_view=checkPermissionVal('xpenses_view');
		$xpenses_edit=checkPermissionVal('xpenses_edit');
		$xpenses_delete=checkPermissionVal('xpenses_delete');
		###############################

		// new group or old?
		if($_POST['groupID']==''){ // new group
			// make sure group name is unique
			if(sqlValue("select count(1) from membership_groups where name='$name'")){
				echo "<div class=\"alert alert-danger\">Error: Group name already exists. You must choose a unique group name.</div>";
				include("$currDir/incFooter.php");
			}

			// add group
			sql("insert into membership_groups set name='$name', description='$description', allowSignup='$allowSignup', needsApproval='$needsApproval'", $eo);

			// get new groupID
			$groupID=db_insert_id(db_link());

		}else{ // old group
			// validate groupID
			$groupID=intval($_POST['groupID']);

			if($groupID==$anonGroupID){
				$name=$adminConfig['anonymousGroup'];
				$allowSignup=0;
				$needsApproval=0;
			}

			// make sure group name is unique
			if(sqlValue("select count(1) from membership_groups where name='$name' and groupID!='$groupID'")){
				echo "<div class=\"alert alert-danger\">Error: Group name already exists. You must choose a unique group name.</div>";
				include("$currDir/incFooter.php");
			}

			// update group
			sql("update membership_groups set name='$name', description='$description', allowSignup='$allowSignup', needsApproval='$needsApproval' where groupID='$groupID'", $eo);

			// reset then add group permissions
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='xpenses'", $eo);
			
		}
		
		// add group permissions
		if($groupID){
			// table 'xpenses'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='xpenses', allowInsert='$xpenses_insert', allowView='$xpenses_view', allowEdit='$xpenses_edit', allowDelete='$xpenses_delete'", $eo);
			// table 'external_entity'
		}
		// redirect to group editing page
		redirect("admin/pageEditGroup.php?groupID=$groupID");

	}elseif($_GET['groupID']!=''){
		// we have an edit request for a group
		$groupID=intval($_GET['groupID']);
	}

	include("$currDir/incHeader.php");

	if($groupID!=''){
		// fetch group data to fill in the form below
		$res=sql("select * from membership_groups where groupID='$groupID'", $eo);
		if($row=db_fetch_assoc($res)){
			// get group data
			$name=$row['name'];
			$description=$row['description'];
			$visitorSignup=($row['allowSignup']==1 && $row['needsApproval']==1 ? 1 : ($row['allowSignup']==1 ? 2 : 0));

			// get group permissions for each table
			$res=sql("select * from membership_grouppermissions where groupID='$groupID'", $eo);
			while($row=db_fetch_assoc($res)){
				$tableName=$row['tableName'];
				$vIns=$tableName."_insert";
				$vUpd=$tableName."_edit";
				$vDel=$tableName."_delete";
				$vVue=$tableName."_view";
				$$vIns=$row['allowInsert'];
				$$vUpd=$row['allowEdit'];
				$$vDel=$row['allowDelete'];
				$$vVue=$row['allowView'];
			}
		}else{
			// no such group exists
			echo "<div class=\"alert alert-danger\">Error: Group not found!</div>";
			$groupID=0;
		}
	}
?>

<div class="page-header"><h1><?php echo ($groupID ? "Edit Group '$name'" : "Add New Group"); ?></h1></div>
<?php if($anonGroupID==$groupID){ ?>
	<div class="alert alert-warning">Attention! This is the anonymous group.</div>
<?php } ?>
<input type="checkbox" id="showToolTips" value="1" checked><label for="showToolTips">Show tool tips as mouse moves over options</label>
<form method="post" action="pageEditGroup.php">
	<input type="hidden" name="groupID" value="<?php echo $groupID; ?>">
	<div class="table-responsive"><table class="table table-striped">
		<tr>
			<td align="right" class="tdFormCaption" valign="top">
				<div class="formFieldCaption">Group name</div>
				</td>
			<td align="left" class="tdFormInput">
				<input type="text" name="name" <?php echo ($anonGroupID==$groupID ? "readonly" : ""); ?> value="<?php echo $name; ?>" size="20" class="formTextBox">
				<br>
				<?php if($anonGroupID==$groupID){ ?>
					The name of the anonymous group is read-only here.
				<?php }else{ ?>
					If you name the group '<?php echo $adminConfig['anonymousGroup']; ?>', it will be considered the anonymous group<br>
					that defines the permissions of guest visitors that do not log into the system.
				<?php } ?>
				</td>
			</tr>
		<tr>
			<td align="right" valign="top" class="tdFormCaption">
				<div class="formFieldCaption">Description</div>
				</td>
			<td align="left" class="tdFormInput">
				<textarea name="description" cols="50" rows="5" class="formTextBox"><?php echo $description; ?></textarea>
				</td>
			</tr>
		<?php if($anonGroupID!=$groupID){ ?>
		<tr>
			<td align="right" valign="top" class="tdFormCaption">
				<div class="formFieldCaption">Allow visitors to sign up?</div>
				</td>
			<td align="left" class="tdFormInput">
				<?php
					echo htmlRadioGroup(
						"visitorSignup",
						array(0, 1, 2),
						array(
							"No. Only the admin can add users.",
							"Yes, and the admin must approve them.",
							"Yes, and automatically approve them."
						),
						($groupID ? $visitorSignup : $adminConfig['defaultSignUp'])
					);
				?>
				</td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="2" align="right" class="tdFormFooter">
				<input type="submit" name="saveChanges" value="Save changes">
				</td>
			</tr>
		<tr>
			<td colspan="2" class="tdFormHeader">
				<table class="table table-striped">
					<tr>
						<td class="tdFormHeader" colspan="5"><h2>Table permissions for this group</h2></td>
						</tr>
					<?php
						// permissions arrays common to the radio groups below
						$arrPermVal=array(0, 1, 2, 3);
						$arrPermText=array("No", "Owner", "Group", "All");
					?>
					<tr>
						<td class="tdHeader"><div class="ColCaption">Table</div></td>
						<td class="tdHeader"><div class="ColCaption">Insert</div></td>
						<td class="tdHeader"><div class="ColCaption">View</div></td>
						<td class="tdHeader"><div class="ColCaption">Edit</div></td>
						<td class="tdHeader"><div class="ColCaption">Delete</div></td>
						</tr>
				<!-- xpenses table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Xpenses</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(xpenses_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="xpenses_insert" value="1" <?php echo ($xpenses_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("xpenses_view", $arrPermVal, $arrPermText, $xpenses_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("xpenses_edit", $arrPermVal, $arrPermText, $xpenses_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("xpenses_delete", $arrPermVal, $arrPermText, $xpenses_delete, "highlight");
							?>
							</td>
					</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td colspan="2" align="right" class="tdFormFooter">
				<input type="submit" name="saveChanges" value="Save changes">
				</td>
			</tr>
		</table></div>
</form>

	<script>
		$j(function(){
			var highlight_selections = function(){
				$j('input[type=radio]:checked').next().addClass('text-primary');
				$j('input[type=radio]:not(:checked)').next().removeClass('text-primary');
			}

			$j('input[type=radio]').change(function(){ highlight_selections(); });
			highlight_selections();
		});
	</script>


<?php
	include("$currDir/incFooter.php");
?>