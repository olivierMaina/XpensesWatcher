var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// pirl_dashboard table
pirl_dashboard_addTip=["",spacer+"This option allows all members of the group to add records to the 'PIRL Dashboard' table. A member who adds a record to the table becomes the 'owner' of that record."];

pirl_dashboard_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'PIRL Dashboard' table."];
pirl_dashboard_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'PIRL Dashboard' table."];
pirl_dashboard_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'PIRL Dashboard' table."];
pirl_dashboard_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'PIRL Dashboard' table."];

pirl_dashboard_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'PIRL Dashboard' table."];
pirl_dashboard_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'PIRL Dashboard' table."];
pirl_dashboard_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'PIRL Dashboard' table."];
pirl_dashboard_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'PIRL Dashboard' table, regardless of their owner."];

pirl_dashboard_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'PIRL Dashboard' table."];
pirl_dashboard_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'PIRL Dashboard' table."];
pirl_dashboard_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'PIRL Dashboard' table."];
pirl_dashboard_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'PIRL Dashboard' table."];

// external_entity table
external_entity_addTip=["",spacer+"This option allows all members of the group to add records to the 'External Entity' table. A member who adds a record to the table becomes the 'owner' of that record."];

external_entity_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'External Entity' table."];
external_entity_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'External Entity' table."];
external_entity_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'External Entity' table."];
external_entity_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'External Entity' table."];

external_entity_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'External Entity' table."];
external_entity_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'External Entity' table."];
external_entity_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'External Entity' table."];
external_entity_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'External Entity' table, regardless of their owner."];

external_entity_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'External Entity' table."];
external_entity_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'External Entity' table."];
external_entity_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'External Entity' table."];
external_entity_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'External Entity' table."];

// external_contact table
external_contact_addTip=["",spacer+"This option allows all members of the group to add records to the 'External Contact' table. A member who adds a record to the table becomes the 'owner' of that record."];

external_contact_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'External Contact' table."];
external_contact_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'External Contact' table."];
external_contact_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'External Contact' table."];
external_contact_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'External Contact' table."];

external_contact_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'External Contact' table."];
external_contact_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'External Contact' table."];
external_contact_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'External Contact' table."];
external_contact_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'External Contact' table, regardless of their owner."];

external_contact_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'External Contact' table."];
external_contact_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'External Contact' table."];
external_contact_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'External Contact' table."];
external_contact_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'External Contact' table."];

// internal_contact table
internal_contact_addTip=["",spacer+"This option allows all members of the group to add records to the 'Internal contact' table. A member who adds a record to the table becomes the 'owner' of that record."];

internal_contact_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Internal contact' table."];
internal_contact_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Internal contact' table."];
internal_contact_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Internal contact' table."];
internal_contact_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Internal contact' table."];

internal_contact_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Internal contact' table."];
internal_contact_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Internal contact' table."];
internal_contact_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Internal contact' table."];
internal_contact_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Internal contact' table, regardless of their owner."];

internal_contact_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'internal contact' table."];
internal_contact_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Internal contact' table."];
internal_contact_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Internal contact' table."];
internal_contact_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Internal contact' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
