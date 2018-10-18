<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t95_logdetail_grid)) $t95_logdetail_grid = new ct95_logdetail_grid();

// Page init
$t95_logdetail_grid->Page_Init();

// Page main
$t95_logdetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t95_logdetail_grid->Page_Render();
?>
<?php if ($t95_logdetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft95_logdetailgrid = new ew_Form("ft95_logdetailgrid", "grid");
ft95_logdetailgrid.FormKeyCountName = '<?php echo $t95_logdetail_grid->FormKeyCountName ?>';

// Validate form
ft95_logdetailgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_logmaster_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t95_logdetail->logmaster_id->FldCaption(), $t95_logdetail->logmaster_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_logmaster_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t95_logdetail->logmaster_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_index_");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t95_logdetail->index_->FldCaption(), $t95_logdetail->index_->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_index_");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t95_logdetail->index_->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subject");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t95_logdetail->subject->FldCaption(), $t95_logdetail->subject->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_date_");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t95_logdetail->date_->FldCaption(), $t95_logdetail->date_->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_date_");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t95_logdetail->date_->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_description");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t95_logdetail->description->FldCaption(), $t95_logdetail->description->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft95_logdetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "logmaster_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "index_", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subject", false)) return false;
	if (ew_ValueChanged(fobj, infix, "date_", false)) return false;
	if (ew_ValueChanged(fobj, infix, "description", false)) return false;
	return true;
}

// Form_CustomValidate event
ft95_logdetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft95_logdetailgrid.ValidateRequired = true;
<?php } else { ?>
ft95_logdetailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t95_logdetail->CurrentAction == "gridadd") {
	if ($t95_logdetail->CurrentMode == "copy") {
		$bSelectLimit = $t95_logdetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t95_logdetail_grid->TotalRecs = $t95_logdetail->SelectRecordCount();
			$t95_logdetail_grid->Recordset = $t95_logdetail_grid->LoadRecordset($t95_logdetail_grid->StartRec-1, $t95_logdetail_grid->DisplayRecs);
		} else {
			if ($t95_logdetail_grid->Recordset = $t95_logdetail_grid->LoadRecordset())
				$t95_logdetail_grid->TotalRecs = $t95_logdetail_grid->Recordset->RecordCount();
		}
		$t95_logdetail_grid->StartRec = 1;
		$t95_logdetail_grid->DisplayRecs = $t95_logdetail_grid->TotalRecs;
	} else {
		$t95_logdetail->CurrentFilter = "0=1";
		$t95_logdetail_grid->StartRec = 1;
		$t95_logdetail_grid->DisplayRecs = $t95_logdetail->GridAddRowCount;
	}
	$t95_logdetail_grid->TotalRecs = $t95_logdetail_grid->DisplayRecs;
	$t95_logdetail_grid->StopRec = $t95_logdetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t95_logdetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t95_logdetail_grid->TotalRecs <= 0)
			$t95_logdetail_grid->TotalRecs = $t95_logdetail->SelectRecordCount();
	} else {
		if (!$t95_logdetail_grid->Recordset && ($t95_logdetail_grid->Recordset = $t95_logdetail_grid->LoadRecordset()))
			$t95_logdetail_grid->TotalRecs = $t95_logdetail_grid->Recordset->RecordCount();
	}
	$t95_logdetail_grid->StartRec = 1;
	$t95_logdetail_grid->DisplayRecs = $t95_logdetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t95_logdetail_grid->Recordset = $t95_logdetail_grid->LoadRecordset($t95_logdetail_grid->StartRec-1, $t95_logdetail_grid->DisplayRecs);

	// Set no record found message
	if ($t95_logdetail->CurrentAction == "" && $t95_logdetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t95_logdetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t95_logdetail_grid->SearchWhere == "0=101")
			$t95_logdetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t95_logdetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t95_logdetail_grid->RenderOtherOptions();
?>
<?php $t95_logdetail_grid->ShowPageHeader(); ?>
<?php
$t95_logdetail_grid->ShowMessage();
?>
<?php if ($t95_logdetail_grid->TotalRecs > 0 || $t95_logdetail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t95_logdetail">
<div id="ft95_logdetailgrid" class="ewForm form-inline">
<?php if ($t95_logdetail_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t95_logdetail_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t95_logdetail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t95_logdetailgrid" class="table ewTable">
<?php echo $t95_logdetail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t95_logdetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t95_logdetail_grid->RenderListOptions();

// Render list options (header, left)
$t95_logdetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t95_logdetail->id->Visible) { // id ?>
	<?php if ($t95_logdetail->SortUrl($t95_logdetail->id) == "") { ?>
		<th data-name="id"><div id="elh_t95_logdetail_id" class="t95_logdetail_id"><div class="ewTableHeaderCaption"><?php echo $t95_logdetail->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id"><div><div id="elh_t95_logdetail_id" class="t95_logdetail_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_logdetail->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_logdetail->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_logdetail->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t95_logdetail->logmaster_id->Visible) { // logmaster_id ?>
	<?php if ($t95_logdetail->SortUrl($t95_logdetail->logmaster_id) == "") { ?>
		<th data-name="logmaster_id"><div id="elh_t95_logdetail_logmaster_id" class="t95_logdetail_logmaster_id"><div class="ewTableHeaderCaption"><?php echo $t95_logdetail->logmaster_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="logmaster_id"><div><div id="elh_t95_logdetail_logmaster_id" class="t95_logdetail_logmaster_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_logdetail->logmaster_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_logdetail->logmaster_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_logdetail->logmaster_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t95_logdetail->index_->Visible) { // index_ ?>
	<?php if ($t95_logdetail->SortUrl($t95_logdetail->index_) == "") { ?>
		<th data-name="index_"><div id="elh_t95_logdetail_index_" class="t95_logdetail_index_"><div class="ewTableHeaderCaption"><?php echo $t95_logdetail->index_->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="index_"><div><div id="elh_t95_logdetail_index_" class="t95_logdetail_index_">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_logdetail->index_->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_logdetail->index_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_logdetail->index_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t95_logdetail->subject->Visible) { // subject ?>
	<?php if ($t95_logdetail->SortUrl($t95_logdetail->subject) == "") { ?>
		<th data-name="subject"><div id="elh_t95_logdetail_subject" class="t95_logdetail_subject"><div class="ewTableHeaderCaption"><?php echo $t95_logdetail->subject->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subject"><div><div id="elh_t95_logdetail_subject" class="t95_logdetail_subject">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_logdetail->subject->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_logdetail->subject->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_logdetail->subject->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t95_logdetail->date_->Visible) { // date_ ?>
	<?php if ($t95_logdetail->SortUrl($t95_logdetail->date_) == "") { ?>
		<th data-name="date_"><div id="elh_t95_logdetail_date_" class="t95_logdetail_date_"><div class="ewTableHeaderCaption"><?php echo $t95_logdetail->date_->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_"><div><div id="elh_t95_logdetail_date_" class="t95_logdetail_date_">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_logdetail->date_->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_logdetail->date_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_logdetail->date_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t95_logdetail->description->Visible) { // description ?>
	<?php if ($t95_logdetail->SortUrl($t95_logdetail->description) == "") { ?>
		<th data-name="description"><div id="elh_t95_logdetail_description" class="t95_logdetail_description"><div class="ewTableHeaderCaption"><?php echo $t95_logdetail->description->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description"><div><div id="elh_t95_logdetail_description" class="t95_logdetail_description">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_logdetail->description->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_logdetail->description->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_logdetail->description->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t95_logdetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t95_logdetail_grid->StartRec = 1;
$t95_logdetail_grid->StopRec = $t95_logdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t95_logdetail_grid->FormKeyCountName) && ($t95_logdetail->CurrentAction == "gridadd" || $t95_logdetail->CurrentAction == "gridedit" || $t95_logdetail->CurrentAction == "F")) {
		$t95_logdetail_grid->KeyCount = $objForm->GetValue($t95_logdetail_grid->FormKeyCountName);
		$t95_logdetail_grid->StopRec = $t95_logdetail_grid->StartRec + $t95_logdetail_grid->KeyCount - 1;
	}
}
$t95_logdetail_grid->RecCnt = $t95_logdetail_grid->StartRec - 1;
if ($t95_logdetail_grid->Recordset && !$t95_logdetail_grid->Recordset->EOF) {
	$t95_logdetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t95_logdetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t95_logdetail_grid->StartRec > 1)
		$t95_logdetail_grid->Recordset->Move($t95_logdetail_grid->StartRec - 1);
} elseif (!$t95_logdetail->AllowAddDeleteRow && $t95_logdetail_grid->StopRec == 0) {
	$t95_logdetail_grid->StopRec = $t95_logdetail->GridAddRowCount;
}

// Initialize aggregate
$t95_logdetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t95_logdetail->ResetAttrs();
$t95_logdetail_grid->RenderRow();
if ($t95_logdetail->CurrentAction == "gridadd")
	$t95_logdetail_grid->RowIndex = 0;
if ($t95_logdetail->CurrentAction == "gridedit")
	$t95_logdetail_grid->RowIndex = 0;
while ($t95_logdetail_grid->RecCnt < $t95_logdetail_grid->StopRec) {
	$t95_logdetail_grid->RecCnt++;
	if (intval($t95_logdetail_grid->RecCnt) >= intval($t95_logdetail_grid->StartRec)) {
		$t95_logdetail_grid->RowCnt++;
		if ($t95_logdetail->CurrentAction == "gridadd" || $t95_logdetail->CurrentAction == "gridedit" || $t95_logdetail->CurrentAction == "F") {
			$t95_logdetail_grid->RowIndex++;
			$objForm->Index = $t95_logdetail_grid->RowIndex;
			if ($objForm->HasValue($t95_logdetail_grid->FormActionName))
				$t95_logdetail_grid->RowAction = strval($objForm->GetValue($t95_logdetail_grid->FormActionName));
			elseif ($t95_logdetail->CurrentAction == "gridadd")
				$t95_logdetail_grid->RowAction = "insert";
			else
				$t95_logdetail_grid->RowAction = "";
		}

		// Set up key count
		$t95_logdetail_grid->KeyCount = $t95_logdetail_grid->RowIndex;

		// Init row class and style
		$t95_logdetail->ResetAttrs();
		$t95_logdetail->CssClass = "";
		if ($t95_logdetail->CurrentAction == "gridadd") {
			if ($t95_logdetail->CurrentMode == "copy") {
				$t95_logdetail_grid->LoadRowValues($t95_logdetail_grid->Recordset); // Load row values
				$t95_logdetail_grid->SetRecordKey($t95_logdetail_grid->RowOldKey, $t95_logdetail_grid->Recordset); // Set old record key
			} else {
				$t95_logdetail_grid->LoadDefaultValues(); // Load default values
				$t95_logdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t95_logdetail_grid->LoadRowValues($t95_logdetail_grid->Recordset); // Load row values
		}
		$t95_logdetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t95_logdetail->CurrentAction == "gridadd") // Grid add
			$t95_logdetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t95_logdetail->CurrentAction == "gridadd" && $t95_logdetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t95_logdetail_grid->RestoreCurrentRowFormValues($t95_logdetail_grid->RowIndex); // Restore form values
		if ($t95_logdetail->CurrentAction == "gridedit") { // Grid edit
			if ($t95_logdetail->EventCancelled) {
				$t95_logdetail_grid->RestoreCurrentRowFormValues($t95_logdetail_grid->RowIndex); // Restore form values
			}
			if ($t95_logdetail_grid->RowAction == "insert")
				$t95_logdetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t95_logdetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t95_logdetail->CurrentAction == "gridedit" && ($t95_logdetail->RowType == EW_ROWTYPE_EDIT || $t95_logdetail->RowType == EW_ROWTYPE_ADD) && $t95_logdetail->EventCancelled) // Update failed
			$t95_logdetail_grid->RestoreCurrentRowFormValues($t95_logdetail_grid->RowIndex); // Restore form values
		if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t95_logdetail_grid->EditRowCnt++;
		if ($t95_logdetail->CurrentAction == "F") // Confirm row
			$t95_logdetail_grid->RestoreCurrentRowFormValues($t95_logdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t95_logdetail->RowAttrs = array_merge($t95_logdetail->RowAttrs, array('data-rowindex'=>$t95_logdetail_grid->RowCnt, 'id'=>'r' . $t95_logdetail_grid->RowCnt . '_t95_logdetail', 'data-rowtype'=>$t95_logdetail->RowType));

		// Render row
		$t95_logdetail_grid->RenderRow();

		// Render list options
		$t95_logdetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t95_logdetail_grid->RowAction <> "delete" && $t95_logdetail_grid->RowAction <> "insertdelete" && !($t95_logdetail_grid->RowAction == "insert" && $t95_logdetail->CurrentAction == "F" && $t95_logdetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t95_logdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t95_logdetail_grid->ListOptions->Render("body", "left", $t95_logdetail_grid->RowCnt);
?>
	<?php if ($t95_logdetail->id->Visible) { // id ?>
		<td data-name="id"<?php echo $t95_logdetail->id->CellAttributes() ?>>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_id" class="form-group t95_logdetail_id">
<span<?php echo $t95_logdetail->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->CurrentValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_id" class="t95_logdetail_id">
<span<?php echo $t95_logdetail->id->ViewAttributes() ?>>
<?php echo $t95_logdetail->id->ListViewValue() ?></span>
</span>
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t95_logdetail_grid->PageObjName . "_row_" . $t95_logdetail_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($t95_logdetail->logmaster_id->Visible) { // logmaster_id ?>
		<td data-name="logmaster_id"<?php echo $t95_logdetail->logmaster_id->CellAttributes() ?>>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t95_logdetail->logmaster_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<span<?php echo $t95_logdetail->logmaster_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->logmaster_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<input type="text" data-table="t95_logdetail" data-field="x_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" size="30" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->logmaster_id->EditValue ?>"<?php echo $t95_logdetail->logmaster_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->OldValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t95_logdetail->logmaster_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<span<?php echo $t95_logdetail->logmaster_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->logmaster_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<input type="text" data-table="t95_logdetail" data-field="x_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" size="30" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->logmaster_id->EditValue ?>"<?php echo $t95_logdetail->logmaster_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_logmaster_id" class="t95_logdetail_logmaster_id">
<span<?php echo $t95_logdetail->logmaster_id->ViewAttributes() ?>>
<?php echo $t95_logdetail->logmaster_id->ListViewValue() ?></span>
</span>
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_logdetail->index_->Visible) { // index_ ?>
		<td data-name="index_"<?php echo $t95_logdetail->index_->CellAttributes() ?>>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_index_" class="form-group t95_logdetail_index_">
<input type="text" data-table="t95_logdetail" data-field="x_index_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->index_->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->index_->EditValue ?>"<?php echo $t95_logdetail->index_->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->OldValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_index_" class="form-group t95_logdetail_index_">
<input type="text" data-table="t95_logdetail" data-field="x_index_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->index_->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->index_->EditValue ?>"<?php echo $t95_logdetail->index_->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_index_" class="t95_logdetail_index_">
<span<?php echo $t95_logdetail->index_->ViewAttributes() ?>>
<?php echo $t95_logdetail->index_->ListViewValue() ?></span>
</span>
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_logdetail->subject->Visible) { // subject ?>
		<td data-name="subject"<?php echo $t95_logdetail->subject->CellAttributes() ?>>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_subject" class="form-group t95_logdetail_subject">
<input type="text" data-table="t95_logdetail" data-field="x_subject" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->subject->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->subject->EditValue ?>"<?php echo $t95_logdetail->subject->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->OldValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_subject" class="form-group t95_logdetail_subject">
<input type="text" data-table="t95_logdetail" data-field="x_subject" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->subject->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->subject->EditValue ?>"<?php echo $t95_logdetail->subject->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_subject" class="t95_logdetail_subject">
<span<?php echo $t95_logdetail->subject->ViewAttributes() ?>>
<?php echo $t95_logdetail->subject->ListViewValue() ?></span>
</span>
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_logdetail->date_->Visible) { // date_ ?>
		<td data-name="date_"<?php echo $t95_logdetail->date_->CellAttributes() ?>>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_date_" class="form-group t95_logdetail_date_">
<input type="text" data-table="t95_logdetail" data-field="x_date_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->date_->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->date_->EditValue ?>"<?php echo $t95_logdetail->date_->EditAttributes() ?>>
<?php if (!$t95_logdetail->date_->ReadOnly && !$t95_logdetail->date_->Disabled && !isset($t95_logdetail->date_->EditAttrs["readonly"]) && !isset($t95_logdetail->date_->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft95_logdetailgrid", "x<?php echo $t95_logdetail_grid->RowIndex ?>_date_", 0);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->OldValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_date_" class="form-group t95_logdetail_date_">
<input type="text" data-table="t95_logdetail" data-field="x_date_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->date_->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->date_->EditValue ?>"<?php echo $t95_logdetail->date_->EditAttributes() ?>>
<?php if (!$t95_logdetail->date_->ReadOnly && !$t95_logdetail->date_->Disabled && !isset($t95_logdetail->date_->EditAttrs["readonly"]) && !isset($t95_logdetail->date_->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft95_logdetailgrid", "x<?php echo $t95_logdetail_grid->RowIndex ?>_date_", 0);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_date_" class="t95_logdetail_date_">
<span<?php echo $t95_logdetail->date_->ViewAttributes() ?>>
<?php echo $t95_logdetail->date_->ListViewValue() ?></span>
</span>
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_logdetail->description->Visible) { // description ?>
		<td data-name="description"<?php echo $t95_logdetail->description->CellAttributes() ?>>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_description" class="form-group t95_logdetail_description">
<textarea data-table="t95_logdetail" data-field="x_description" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->description->getPlaceHolder()) ?>"<?php echo $t95_logdetail->description->EditAttributes() ?>><?php echo $t95_logdetail->description->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->OldValue) ?>">
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_description" class="form-group t95_logdetail_description">
<textarea data-table="t95_logdetail" data-field="x_description" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->description->getPlaceHolder()) ?>"<?php echo $t95_logdetail->description->EditAttributes() ?>><?php echo $t95_logdetail->description->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_logdetail_grid->RowCnt ?>_t95_logdetail_description" class="t95_logdetail_description">
<span<?php echo $t95_logdetail->description->ViewAttributes() ?>>
<?php echo $t95_logdetail->description->ListViewValue() ?></span>
</span>
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="ft95_logdetailgrid$x<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->FormValue) ?>">
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="ft95_logdetailgrid$o<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t95_logdetail_grid->ListOptions->Render("body", "right", $t95_logdetail_grid->RowCnt);
?>
	</tr>
<?php if ($t95_logdetail->RowType == EW_ROWTYPE_ADD || $t95_logdetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft95_logdetailgrid.UpdateOpts(<?php echo $t95_logdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t95_logdetail->CurrentAction <> "gridadd" || $t95_logdetail->CurrentMode == "copy")
		if (!$t95_logdetail_grid->Recordset->EOF) $t95_logdetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t95_logdetail->CurrentMode == "add" || $t95_logdetail->CurrentMode == "copy" || $t95_logdetail->CurrentMode == "edit") {
		$t95_logdetail_grid->RowIndex = '$rowindex$';
		$t95_logdetail_grid->LoadDefaultValues();

		// Set row properties
		$t95_logdetail->ResetAttrs();
		$t95_logdetail->RowAttrs = array_merge($t95_logdetail->RowAttrs, array('data-rowindex'=>$t95_logdetail_grid->RowIndex, 'id'=>'r0_t95_logdetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t95_logdetail->RowAttrs["class"], "ewTemplate");
		$t95_logdetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t95_logdetail_grid->RenderRow();

		// Render list options
		$t95_logdetail_grid->RenderListOptions();
		$t95_logdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t95_logdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t95_logdetail_grid->ListOptions->Render("body", "left", $t95_logdetail_grid->RowIndex);
?>
	<?php if ($t95_logdetail->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_id" class="form-group t95_logdetail_id">
<span<?php echo $t95_logdetail->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_id" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_id" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t95_logdetail->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_logdetail->logmaster_id->Visible) { // logmaster_id ?>
		<td data-name="logmaster_id">
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<?php if ($t95_logdetail->logmaster_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<span<?php echo $t95_logdetail->logmaster_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->logmaster_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<input type="text" data-table="t95_logdetail" data-field="x_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" size="30" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->logmaster_id->EditValue ?>"<?php echo $t95_logdetail->logmaster_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_logmaster_id" class="form-group t95_logdetail_logmaster_id">
<span<?php echo $t95_logdetail->logmaster_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->logmaster_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_logmaster_id" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_logmaster_id" value="<?php echo ew_HtmlEncode($t95_logdetail->logmaster_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_logdetail->index_->Visible) { // index_ ?>
		<td data-name="index_">
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t95_logdetail_index_" class="form-group t95_logdetail_index_">
<input type="text" data-table="t95_logdetail" data-field="x_index_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->index_->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->index_->EditValue ?>"<?php echo $t95_logdetail->index_->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_index_" class="form-group t95_logdetail_index_">
<span<?php echo $t95_logdetail->index_->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->index_->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_index_" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t95_logdetail->index_->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_logdetail->subject->Visible) { // subject ?>
		<td data-name="subject">
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t95_logdetail_subject" class="form-group t95_logdetail_subject">
<input type="text" data-table="t95_logdetail" data-field="x_subject" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->subject->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->subject->EditValue ?>"<?php echo $t95_logdetail->subject->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_subject" class="form-group t95_logdetail_subject">
<span<?php echo $t95_logdetail->subject->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->subject->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_subject" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_subject" value="<?php echo ew_HtmlEncode($t95_logdetail->subject->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_logdetail->date_->Visible) { // date_ ?>
		<td data-name="date_">
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t95_logdetail_date_" class="form-group t95_logdetail_date_">
<input type="text" data-table="t95_logdetail" data-field="x_date_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->date_->getPlaceHolder()) ?>" value="<?php echo $t95_logdetail->date_->EditValue ?>"<?php echo $t95_logdetail->date_->EditAttributes() ?>>
<?php if (!$t95_logdetail->date_->ReadOnly && !$t95_logdetail->date_->Disabled && !isset($t95_logdetail->date_->EditAttrs["readonly"]) && !isset($t95_logdetail->date_->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft95_logdetailgrid", "x<?php echo $t95_logdetail_grid->RowIndex ?>_date_", 0);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_date_" class="form-group t95_logdetail_date_">
<span<?php echo $t95_logdetail->date_->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->date_->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_date_" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_date_" value="<?php echo ew_HtmlEncode($t95_logdetail->date_->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_logdetail->description->Visible) { // description ?>
		<td data-name="description">
<?php if ($t95_logdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t95_logdetail_description" class="form-group t95_logdetail_description">
<textarea data-table="t95_logdetail" data-field="x_description" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_logdetail->description->getPlaceHolder()) ?>"<?php echo $t95_logdetail->description->EditAttributes() ?>><?php echo $t95_logdetail->description->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t95_logdetail_description" class="form-group t95_logdetail_description">
<span<?php echo $t95_logdetail->description->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t95_logdetail->description->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="x<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t95_logdetail" data-field="x_description" name="o<?php echo $t95_logdetail_grid->RowIndex ?>_description" id="o<?php echo $t95_logdetail_grid->RowIndex ?>_description" value="<?php echo ew_HtmlEncode($t95_logdetail->description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t95_logdetail_grid->ListOptions->Render("body", "right", $t95_logdetail_grid->RowCnt);
?>
<script type="text/javascript">
ft95_logdetailgrid.UpdateOpts(<?php echo $t95_logdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t95_logdetail->CurrentMode == "add" || $t95_logdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t95_logdetail_grid->FormKeyCountName ?>" id="<?php echo $t95_logdetail_grid->FormKeyCountName ?>" value="<?php echo $t95_logdetail_grid->KeyCount ?>">
<?php echo $t95_logdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t95_logdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t95_logdetail_grid->FormKeyCountName ?>" id="<?php echo $t95_logdetail_grid->FormKeyCountName ?>" value="<?php echo $t95_logdetail_grid->KeyCount ?>">
<?php echo $t95_logdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t95_logdetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft95_logdetailgrid">
</div>
<?php

// Close recordset
if ($t95_logdetail_grid->Recordset)
	$t95_logdetail_grid->Recordset->Close();
?>
<?php if ($t95_logdetail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t95_logdetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t95_logdetail_grid->TotalRecs == 0 && $t95_logdetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t95_logdetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t95_logdetail->Export == "") { ?>
<script type="text/javascript">
ft95_logdetailgrid.Init();
</script>
<?php } ?>
<?php
$t95_logdetail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t95_logdetail_grid->Page_Terminate();
?>
