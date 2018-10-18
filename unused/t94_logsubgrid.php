<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t94_logsub_grid)) $t94_logsub_grid = new ct94_logsub_grid();

// Page init
$t94_logsub_grid->Page_Init();

// Page main
$t94_logsub_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t94_logsub_grid->Page_Render();
?>
<?php if ($t94_logsub->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft94_logsubgrid = new ew_Form("ft94_logsubgrid", "grid");
ft94_logsubgrid.FormKeyCountName = '<?php echo $t94_logsub_grid->FormKeyCountName ?>';

// Validate form
ft94_logsubgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_logmain_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t94_logsub->logmain_id->FldCaption(), $t94_logsub->logmain_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_logmain_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t94_logsub->logmain_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_index_");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t94_logsub->index_->FldCaption(), $t94_logsub->index_->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_index_");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t94_logsub->index_->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subj_");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t94_logsub->subj_->FldCaption(), $t94_logsub->subj_->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft94_logsubgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "logmain_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "index_", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subj_", false)) return false;
	return true;
}

// Form_CustomValidate event
ft94_logsubgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft94_logsubgrid.ValidateRequired = true;
<?php } else { ?>
ft94_logsubgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft94_logsubgrid.Lists["x_logmain_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_subj_","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t93_logmain"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t94_logsub->CurrentAction == "gridadd") {
	if ($t94_logsub->CurrentMode == "copy") {
		$bSelectLimit = $t94_logsub_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t94_logsub_grid->TotalRecs = $t94_logsub->SelectRecordCount();
			$t94_logsub_grid->Recordset = $t94_logsub_grid->LoadRecordset($t94_logsub_grid->StartRec-1, $t94_logsub_grid->DisplayRecs);
		} else {
			if ($t94_logsub_grid->Recordset = $t94_logsub_grid->LoadRecordset())
				$t94_logsub_grid->TotalRecs = $t94_logsub_grid->Recordset->RecordCount();
		}
		$t94_logsub_grid->StartRec = 1;
		$t94_logsub_grid->DisplayRecs = $t94_logsub_grid->TotalRecs;
	} else {
		$t94_logsub->CurrentFilter = "0=1";
		$t94_logsub_grid->StartRec = 1;
		$t94_logsub_grid->DisplayRecs = $t94_logsub->GridAddRowCount;
	}
	$t94_logsub_grid->TotalRecs = $t94_logsub_grid->DisplayRecs;
	$t94_logsub_grid->StopRec = $t94_logsub_grid->DisplayRecs;
} else {
	$bSelectLimit = $t94_logsub_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t94_logsub_grid->TotalRecs <= 0)
			$t94_logsub_grid->TotalRecs = $t94_logsub->SelectRecordCount();
	} else {
		if (!$t94_logsub_grid->Recordset && ($t94_logsub_grid->Recordset = $t94_logsub_grid->LoadRecordset()))
			$t94_logsub_grid->TotalRecs = $t94_logsub_grid->Recordset->RecordCount();
	}
	$t94_logsub_grid->StartRec = 1;
	$t94_logsub_grid->DisplayRecs = $t94_logsub_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t94_logsub_grid->Recordset = $t94_logsub_grid->LoadRecordset($t94_logsub_grid->StartRec-1, $t94_logsub_grid->DisplayRecs);

	// Set no record found message
	if ($t94_logsub->CurrentAction == "" && $t94_logsub_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t94_logsub_grid->setWarningMessage(ew_DeniedMsg());
		if ($t94_logsub_grid->SearchWhere == "0=101")
			$t94_logsub_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t94_logsub_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t94_logsub_grid->RenderOtherOptions();
?>
<?php $t94_logsub_grid->ShowPageHeader(); ?>
<?php
$t94_logsub_grid->ShowMessage();
?>
<?php if ($t94_logsub_grid->TotalRecs > 0 || $t94_logsub->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t94_logsub">
<div id="ft94_logsubgrid" class="ewForm form-inline">
<?php if ($t94_logsub_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t94_logsub_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t94_logsub" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t94_logsubgrid" class="table ewTable">
<?php echo $t94_logsub->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t94_logsub_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t94_logsub_grid->RenderListOptions();

// Render list options (header, left)
$t94_logsub_grid->ListOptions->Render("header", "left");
?>
<?php if ($t94_logsub->logmain_id->Visible) { // logmain_id ?>
	<?php if ($t94_logsub->SortUrl($t94_logsub->logmain_id) == "") { ?>
		<th data-name="logmain_id"><div id="elh_t94_logsub_logmain_id" class="t94_logsub_logmain_id"><div class="ewTableHeaderCaption"><?php echo $t94_logsub->logmain_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="logmain_id"><div><div id="elh_t94_logsub_logmain_id" class="t94_logsub_logmain_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t94_logsub->logmain_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t94_logsub->logmain_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t94_logsub->logmain_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t94_logsub->index_->Visible) { // index_ ?>
	<?php if ($t94_logsub->SortUrl($t94_logsub->index_) == "") { ?>
		<th data-name="index_"><div id="elh_t94_logsub_index_" class="t94_logsub_index_"><div class="ewTableHeaderCaption"><?php echo $t94_logsub->index_->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="index_"><div><div id="elh_t94_logsub_index_" class="t94_logsub_index_">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t94_logsub->index_->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t94_logsub->index_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t94_logsub->index_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t94_logsub->subj_->Visible) { // subj_ ?>
	<?php if ($t94_logsub->SortUrl($t94_logsub->subj_) == "") { ?>
		<th data-name="subj_"><div id="elh_t94_logsub_subj_" class="t94_logsub_subj_"><div class="ewTableHeaderCaption"><?php echo $t94_logsub->subj_->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subj_"><div><div id="elh_t94_logsub_subj_" class="t94_logsub_subj_">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t94_logsub->subj_->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t94_logsub->subj_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t94_logsub->subj_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t94_logsub_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t94_logsub_grid->StartRec = 1;
$t94_logsub_grid->StopRec = $t94_logsub_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t94_logsub_grid->FormKeyCountName) && ($t94_logsub->CurrentAction == "gridadd" || $t94_logsub->CurrentAction == "gridedit" || $t94_logsub->CurrentAction == "F")) {
		$t94_logsub_grid->KeyCount = $objForm->GetValue($t94_logsub_grid->FormKeyCountName);
		$t94_logsub_grid->StopRec = $t94_logsub_grid->StartRec + $t94_logsub_grid->KeyCount - 1;
	}
}
$t94_logsub_grid->RecCnt = $t94_logsub_grid->StartRec - 1;
if ($t94_logsub_grid->Recordset && !$t94_logsub_grid->Recordset->EOF) {
	$t94_logsub_grid->Recordset->MoveFirst();
	$bSelectLimit = $t94_logsub_grid->UseSelectLimit;
	if (!$bSelectLimit && $t94_logsub_grid->StartRec > 1)
		$t94_logsub_grid->Recordset->Move($t94_logsub_grid->StartRec - 1);
} elseif (!$t94_logsub->AllowAddDeleteRow && $t94_logsub_grid->StopRec == 0) {
	$t94_logsub_grid->StopRec = $t94_logsub->GridAddRowCount;
}

// Initialize aggregate
$t94_logsub->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t94_logsub->ResetAttrs();
$t94_logsub_grid->RenderRow();
if ($t94_logsub->CurrentAction == "gridadd")
	$t94_logsub_grid->RowIndex = 0;
if ($t94_logsub->CurrentAction == "gridedit")
	$t94_logsub_grid->RowIndex = 0;
while ($t94_logsub_grid->RecCnt < $t94_logsub_grid->StopRec) {
	$t94_logsub_grid->RecCnt++;
	if (intval($t94_logsub_grid->RecCnt) >= intval($t94_logsub_grid->StartRec)) {
		$t94_logsub_grid->RowCnt++;
		if ($t94_logsub->CurrentAction == "gridadd" || $t94_logsub->CurrentAction == "gridedit" || $t94_logsub->CurrentAction == "F") {
			$t94_logsub_grid->RowIndex++;
			$objForm->Index = $t94_logsub_grid->RowIndex;
			if ($objForm->HasValue($t94_logsub_grid->FormActionName))
				$t94_logsub_grid->RowAction = strval($objForm->GetValue($t94_logsub_grid->FormActionName));
			elseif ($t94_logsub->CurrentAction == "gridadd")
				$t94_logsub_grid->RowAction = "insert";
			else
				$t94_logsub_grid->RowAction = "";
		}

		// Set up key count
		$t94_logsub_grid->KeyCount = $t94_logsub_grid->RowIndex;

		// Init row class and style
		$t94_logsub->ResetAttrs();
		$t94_logsub->CssClass = "";
		if ($t94_logsub->CurrentAction == "gridadd") {
			if ($t94_logsub->CurrentMode == "copy") {
				$t94_logsub_grid->LoadRowValues($t94_logsub_grid->Recordset); // Load row values
				$t94_logsub_grid->SetRecordKey($t94_logsub_grid->RowOldKey, $t94_logsub_grid->Recordset); // Set old record key
			} else {
				$t94_logsub_grid->LoadDefaultValues(); // Load default values
				$t94_logsub_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t94_logsub_grid->LoadRowValues($t94_logsub_grid->Recordset); // Load row values
		}
		$t94_logsub->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t94_logsub->CurrentAction == "gridadd") // Grid add
			$t94_logsub->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t94_logsub->CurrentAction == "gridadd" && $t94_logsub->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t94_logsub_grid->RestoreCurrentRowFormValues($t94_logsub_grid->RowIndex); // Restore form values
		if ($t94_logsub->CurrentAction == "gridedit") { // Grid edit
			if ($t94_logsub->EventCancelled) {
				$t94_logsub_grid->RestoreCurrentRowFormValues($t94_logsub_grid->RowIndex); // Restore form values
			}
			if ($t94_logsub_grid->RowAction == "insert")
				$t94_logsub->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t94_logsub->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t94_logsub->CurrentAction == "gridedit" && ($t94_logsub->RowType == EW_ROWTYPE_EDIT || $t94_logsub->RowType == EW_ROWTYPE_ADD) && $t94_logsub->EventCancelled) // Update failed
			$t94_logsub_grid->RestoreCurrentRowFormValues($t94_logsub_grid->RowIndex); // Restore form values
		if ($t94_logsub->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t94_logsub_grid->EditRowCnt++;
		if ($t94_logsub->CurrentAction == "F") // Confirm row
			$t94_logsub_grid->RestoreCurrentRowFormValues($t94_logsub_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t94_logsub->RowAttrs = array_merge($t94_logsub->RowAttrs, array('data-rowindex'=>$t94_logsub_grid->RowCnt, 'id'=>'r' . $t94_logsub_grid->RowCnt . '_t94_logsub', 'data-rowtype'=>$t94_logsub->RowType));

		// Render row
		$t94_logsub_grid->RenderRow();

		// Render list options
		$t94_logsub_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t94_logsub_grid->RowAction <> "delete" && $t94_logsub_grid->RowAction <> "insertdelete" && !($t94_logsub_grid->RowAction == "insert" && $t94_logsub->CurrentAction == "F" && $t94_logsub_grid->EmptyRow())) {
?>
	<tr<?php echo $t94_logsub->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t94_logsub_grid->ListOptions->Render("body", "left", $t94_logsub_grid->RowCnt);
?>
	<?php if ($t94_logsub->logmain_id->Visible) { // logmain_id ?>
		<td data-name="logmain_id"<?php echo $t94_logsub->logmain_id->CellAttributes() ?>>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t94_logsub->logmain_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<span<?php echo $t94_logsub->logmain_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->logmain_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<?php
$wrkonchange = trim(" " . @$t94_logsub->logmain_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t94_logsub->logmain_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t94_logsub_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="sv_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo $t94_logsub->logmain_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>"<?php echo $t94_logsub->logmain_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" data-value-separator="<?php echo $t94_logsub->logmain_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="q_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo $t94_logsub->logmain_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft94_logsubgrid.CreateAutoSuggest({"id":"x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->OldValue) ?>">
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t94_logsub->logmain_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<span<?php echo $t94_logsub->logmain_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->logmain_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<?php
$wrkonchange = trim(" " . @$t94_logsub->logmain_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t94_logsub->logmain_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t94_logsub_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="sv_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo $t94_logsub->logmain_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>"<?php echo $t94_logsub->logmain_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" data-value-separator="<?php echo $t94_logsub->logmain_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="q_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo $t94_logsub->logmain_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft94_logsubgrid.CreateAutoSuggest({"id":"x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_logmain_id" class="t94_logsub_logmain_id">
<span<?php echo $t94_logsub->logmain_id->ViewAttributes() ?>>
<?php echo $t94_logsub->logmain_id->ListViewValue() ?></span>
</span>
<?php if ($t94_logsub->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->FormValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="ft94_logsubgrid$x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="ft94_logsubgrid$x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->FormValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="ft94_logsubgrid$o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="ft94_logsubgrid$o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t94_logsub_grid->PageObjName . "_row_" . $t94_logsub_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t94_logsub" data-field="x_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t94_logsub->id->CurrentValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_id" name="o<?php echo $t94_logsub_grid->RowIndex ?>_id" id="o<?php echo $t94_logsub_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t94_logsub->id->OldValue) ?>">
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_EDIT || $t94_logsub->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t94_logsub->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t94_logsub->index_->Visible) { // index_ ?>
		<td data-name="index_"<?php echo $t94_logsub->index_->CellAttributes() ?>>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_index_" class="form-group t94_logsub_index_">
<input type="text" data-table="t94_logsub" data-field="x_index_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->index_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->index_->EditValue ?>"<?php echo $t94_logsub->index_->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="o<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="o<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->OldValue) ?>">
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_index_" class="form-group t94_logsub_index_">
<input type="text" data-table="t94_logsub" data-field="x_index_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->index_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->index_->EditValue ?>"<?php echo $t94_logsub->index_->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_index_" class="t94_logsub_index_">
<span<?php echo $t94_logsub->index_->ViewAttributes() ?>>
<?php echo $t94_logsub->index_->ListViewValue() ?></span>
</span>
<?php if ($t94_logsub->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->FormValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="o<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="o<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="ft94_logsubgrid$x<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="ft94_logsubgrid$x<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->FormValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="ft94_logsubgrid$o<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="ft94_logsubgrid$o<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t94_logsub->subj_->Visible) { // subj_ ?>
		<td data-name="subj_"<?php echo $t94_logsub->subj_->CellAttributes() ?>>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_subj_" class="form-group t94_logsub_subj_">
<input type="text" data-table="t94_logsub" data-field="x_subj_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t94_logsub->subj_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->subj_->EditValue ?>"<?php echo $t94_logsub->subj_->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->OldValue) ?>">
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_subj_" class="form-group t94_logsub_subj_">
<input type="text" data-table="t94_logsub" data-field="x_subj_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t94_logsub->subj_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->subj_->EditValue ?>"<?php echo $t94_logsub->subj_->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t94_logsub_grid->RowCnt ?>_t94_logsub_subj_" class="t94_logsub_subj_">
<span<?php echo $t94_logsub->subj_->ViewAttributes() ?>>
<?php echo $t94_logsub->subj_->ListViewValue() ?></span>
</span>
<?php if ($t94_logsub->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->FormValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="ft94_logsubgrid$x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="ft94_logsubgrid$x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->FormValue) ?>">
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="ft94_logsubgrid$o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="ft94_logsubgrid$o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t94_logsub_grid->ListOptions->Render("body", "right", $t94_logsub_grid->RowCnt);
?>
	</tr>
<?php if ($t94_logsub->RowType == EW_ROWTYPE_ADD || $t94_logsub->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft94_logsubgrid.UpdateOpts(<?php echo $t94_logsub_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t94_logsub->CurrentAction <> "gridadd" || $t94_logsub->CurrentMode == "copy")
		if (!$t94_logsub_grid->Recordset->EOF) $t94_logsub_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t94_logsub->CurrentMode == "add" || $t94_logsub->CurrentMode == "copy" || $t94_logsub->CurrentMode == "edit") {
		$t94_logsub_grid->RowIndex = '$rowindex$';
		$t94_logsub_grid->LoadDefaultValues();

		// Set row properties
		$t94_logsub->ResetAttrs();
		$t94_logsub->RowAttrs = array_merge($t94_logsub->RowAttrs, array('data-rowindex'=>$t94_logsub_grid->RowIndex, 'id'=>'r0_t94_logsub', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t94_logsub->RowAttrs["class"], "ewTemplate");
		$t94_logsub->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t94_logsub_grid->RenderRow();

		// Render list options
		$t94_logsub_grid->RenderListOptions();
		$t94_logsub_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t94_logsub->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t94_logsub_grid->ListOptions->Render("body", "left", $t94_logsub_grid->RowIndex);
?>
	<?php if ($t94_logsub->logmain_id->Visible) { // logmain_id ?>
		<td data-name="logmain_id">
<?php if ($t94_logsub->CurrentAction <> "F") { ?>
<?php if ($t94_logsub->logmain_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<span<?php echo $t94_logsub->logmain_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->logmain_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<?php
$wrkonchange = trim(" " . @$t94_logsub->logmain_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t94_logsub->logmain_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t94_logsub_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="sv_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo $t94_logsub->logmain_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>"<?php echo $t94_logsub->logmain_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" data-value-separator="<?php echo $t94_logsub->logmain_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="q_x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo $t94_logsub->logmain_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft94_logsubgrid.CreateAutoSuggest({"id":"x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t94_logsub_logmain_id" class="form-group t94_logsub_logmain_id">
<span<?php echo $t94_logsub->logmain_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->logmain_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="x<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" name="o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" id="o<?php echo $t94_logsub_grid->RowIndex ?>_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t94_logsub->index_->Visible) { // index_ ?>
		<td data-name="index_">
<?php if ($t94_logsub->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t94_logsub_index_" class="form-group t94_logsub_index_">
<input type="text" data-table="t94_logsub" data-field="x_index_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->index_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->index_->EditValue ?>"<?php echo $t94_logsub->index_->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t94_logsub_index_" class="form-group t94_logsub_index_">
<span<?php echo $t94_logsub->index_->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->index_->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t94_logsub" data-field="x_index_" name="o<?php echo $t94_logsub_grid->RowIndex ?>_index_" id="o<?php echo $t94_logsub_grid->RowIndex ?>_index_" value="<?php echo ew_HtmlEncode($t94_logsub->index_->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t94_logsub->subj_->Visible) { // subj_ ?>
		<td data-name="subj_">
<?php if ($t94_logsub->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t94_logsub_subj_" class="form-group t94_logsub_subj_">
<input type="text" data-table="t94_logsub" data-field="x_subj_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t94_logsub->subj_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->subj_->EditValue ?>"<?php echo $t94_logsub->subj_->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t94_logsub_subj_" class="form-group t94_logsub_subj_">
<span<?php echo $t94_logsub->subj_->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->subj_->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="x<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t94_logsub" data-field="x_subj_" name="o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" id="o<?php echo $t94_logsub_grid->RowIndex ?>_subj_" value="<?php echo ew_HtmlEncode($t94_logsub->subj_->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t94_logsub_grid->ListOptions->Render("body", "right", $t94_logsub_grid->RowCnt);
?>
<script type="text/javascript">
ft94_logsubgrid.UpdateOpts(<?php echo $t94_logsub_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t94_logsub->CurrentMode == "add" || $t94_logsub->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t94_logsub_grid->FormKeyCountName ?>" id="<?php echo $t94_logsub_grid->FormKeyCountName ?>" value="<?php echo $t94_logsub_grid->KeyCount ?>">
<?php echo $t94_logsub_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t94_logsub->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t94_logsub_grid->FormKeyCountName ?>" id="<?php echo $t94_logsub_grid->FormKeyCountName ?>" value="<?php echo $t94_logsub_grid->KeyCount ?>">
<?php echo $t94_logsub_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t94_logsub->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft94_logsubgrid">
</div>
<?php

// Close recordset
if ($t94_logsub_grid->Recordset)
	$t94_logsub_grid->Recordset->Close();
?>
<?php if ($t94_logsub_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t94_logsub_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t94_logsub_grid->TotalRecs == 0 && $t94_logsub->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t94_logsub_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t94_logsub->Export == "") { ?>
<script type="text/javascript">
ft94_logsubgrid.Init();
</script>
<?php } ?>
<?php
$t94_logsub_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t94_logsub_grid->Page_Terminate();
?>
