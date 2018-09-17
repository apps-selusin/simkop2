<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t05_pinjamanjaminan_grid)) $t05_pinjamanjaminan_grid = new ct05_pinjamanjaminan_grid();

// Page init
$t05_pinjamanjaminan_grid->Page_Init();

// Page main
$t05_pinjamanjaminan_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t05_pinjamanjaminan_grid->Page_Render();
?>
<?php if ($t05_pinjamanjaminan->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft05_pinjamanjaminangrid = new ew_Form("ft05_pinjamanjaminangrid", "grid");
ft05_pinjamanjaminangrid.FormKeyCountName = '<?php echo $t05_pinjamanjaminan_grid->FormKeyCountName ?>';

// Validate form
ft05_pinjamanjaminangrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_jaminan_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t05_pinjamanjaminan->jaminan_id->FldCaption(), $t05_pinjamanjaminan->jaminan_id->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft05_pinjamanjaminangrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "jaminan_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ft05_pinjamanjaminangrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft05_pinjamanjaminangrid.ValidateRequired = true;
<?php } else { ?>
ft05_pinjamanjaminangrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft05_pinjamanjaminangrid.Lists["x_jaminan_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_MerkType","","",""],"ParentFields":["t03_pinjaman x_nasabah_id"],"ChildFields":[],"FilterFields":["x_nasabah_id"],"Options":[],"Template":"","LinkTable":"t02_jaminan"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t05_pinjamanjaminan->CurrentAction == "gridadd") {
	if ($t05_pinjamanjaminan->CurrentMode == "copy") {
		$bSelectLimit = $t05_pinjamanjaminan_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t05_pinjamanjaminan_grid->TotalRecs = $t05_pinjamanjaminan->SelectRecordCount();
			$t05_pinjamanjaminan_grid->Recordset = $t05_pinjamanjaminan_grid->LoadRecordset($t05_pinjamanjaminan_grid->StartRec-1, $t05_pinjamanjaminan_grid->DisplayRecs);
		} else {
			if ($t05_pinjamanjaminan_grid->Recordset = $t05_pinjamanjaminan_grid->LoadRecordset())
				$t05_pinjamanjaminan_grid->TotalRecs = $t05_pinjamanjaminan_grid->Recordset->RecordCount();
		}
		$t05_pinjamanjaminan_grid->StartRec = 1;
		$t05_pinjamanjaminan_grid->DisplayRecs = $t05_pinjamanjaminan_grid->TotalRecs;
	} else {
		$t05_pinjamanjaminan->CurrentFilter = "0=1";
		$t05_pinjamanjaminan_grid->StartRec = 1;
		$t05_pinjamanjaminan_grid->DisplayRecs = $t05_pinjamanjaminan->GridAddRowCount;
	}
	$t05_pinjamanjaminan_grid->TotalRecs = $t05_pinjamanjaminan_grid->DisplayRecs;
	$t05_pinjamanjaminan_grid->StopRec = $t05_pinjamanjaminan_grid->DisplayRecs;
} else {
	$bSelectLimit = $t05_pinjamanjaminan_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t05_pinjamanjaminan_grid->TotalRecs <= 0)
			$t05_pinjamanjaminan_grid->TotalRecs = $t05_pinjamanjaminan->SelectRecordCount();
	} else {
		if (!$t05_pinjamanjaminan_grid->Recordset && ($t05_pinjamanjaminan_grid->Recordset = $t05_pinjamanjaminan_grid->LoadRecordset()))
			$t05_pinjamanjaminan_grid->TotalRecs = $t05_pinjamanjaminan_grid->Recordset->RecordCount();
	}
	$t05_pinjamanjaminan_grid->StartRec = 1;
	$t05_pinjamanjaminan_grid->DisplayRecs = $t05_pinjamanjaminan_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t05_pinjamanjaminan_grid->Recordset = $t05_pinjamanjaminan_grid->LoadRecordset($t05_pinjamanjaminan_grid->StartRec-1, $t05_pinjamanjaminan_grid->DisplayRecs);

	// Set no record found message
	if ($t05_pinjamanjaminan->CurrentAction == "" && $t05_pinjamanjaminan_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t05_pinjamanjaminan_grid->setWarningMessage(ew_DeniedMsg());
		if ($t05_pinjamanjaminan_grid->SearchWhere == "0=101")
			$t05_pinjamanjaminan_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t05_pinjamanjaminan_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t05_pinjamanjaminan_grid->RenderOtherOptions();
?>
<?php $t05_pinjamanjaminan_grid->ShowPageHeader(); ?>
<?php
$t05_pinjamanjaminan_grid->ShowMessage();
?>
<?php if ($t05_pinjamanjaminan_grid->TotalRecs > 0 || $t05_pinjamanjaminan->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t05_pinjamanjaminan">
<div id="ft05_pinjamanjaminangrid" class="ewForm form-inline">
<?php if ($t05_pinjamanjaminan_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t05_pinjamanjaminan_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t05_pinjamanjaminan" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t05_pinjamanjaminangrid" class="table ewTable">
<?php echo $t05_pinjamanjaminan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t05_pinjamanjaminan_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t05_pinjamanjaminan_grid->RenderListOptions();

// Render list options (header, left)
$t05_pinjamanjaminan_grid->ListOptions->Render("header", "left");
?>
<?php if ($t05_pinjamanjaminan->jaminan_id->Visible) { // jaminan_id ?>
	<?php if ($t05_pinjamanjaminan->SortUrl($t05_pinjamanjaminan->jaminan_id) == "") { ?>
		<th data-name="jaminan_id"><div id="elh_t05_pinjamanjaminan_jaminan_id" class="t05_pinjamanjaminan_jaminan_id"><div class="ewTableHeaderCaption"><?php echo $t05_pinjamanjaminan->jaminan_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jaminan_id"><div><div id="elh_t05_pinjamanjaminan_jaminan_id" class="t05_pinjamanjaminan_jaminan_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t05_pinjamanjaminan->jaminan_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t05_pinjamanjaminan->jaminan_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t05_pinjamanjaminan->jaminan_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t05_pinjamanjaminan_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t05_pinjamanjaminan_grid->StartRec = 1;
$t05_pinjamanjaminan_grid->StopRec = $t05_pinjamanjaminan_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t05_pinjamanjaminan_grid->FormKeyCountName) && ($t05_pinjamanjaminan->CurrentAction == "gridadd" || $t05_pinjamanjaminan->CurrentAction == "gridedit" || $t05_pinjamanjaminan->CurrentAction == "F")) {
		$t05_pinjamanjaminan_grid->KeyCount = $objForm->GetValue($t05_pinjamanjaminan_grid->FormKeyCountName);
		$t05_pinjamanjaminan_grid->StopRec = $t05_pinjamanjaminan_grid->StartRec + $t05_pinjamanjaminan_grid->KeyCount - 1;
	}
}
$t05_pinjamanjaminan_grid->RecCnt = $t05_pinjamanjaminan_grid->StartRec - 1;
if ($t05_pinjamanjaminan_grid->Recordset && !$t05_pinjamanjaminan_grid->Recordset->EOF) {
	$t05_pinjamanjaminan_grid->Recordset->MoveFirst();
	$bSelectLimit = $t05_pinjamanjaminan_grid->UseSelectLimit;
	if (!$bSelectLimit && $t05_pinjamanjaminan_grid->StartRec > 1)
		$t05_pinjamanjaminan_grid->Recordset->Move($t05_pinjamanjaminan_grid->StartRec - 1);
} elseif (!$t05_pinjamanjaminan->AllowAddDeleteRow && $t05_pinjamanjaminan_grid->StopRec == 0) {
	$t05_pinjamanjaminan_grid->StopRec = $t05_pinjamanjaminan->GridAddRowCount;
}

// Initialize aggregate
$t05_pinjamanjaminan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t05_pinjamanjaminan->ResetAttrs();
$t05_pinjamanjaminan_grid->RenderRow();
if ($t05_pinjamanjaminan->CurrentAction == "gridadd")
	$t05_pinjamanjaminan_grid->RowIndex = 0;
if ($t05_pinjamanjaminan->CurrentAction == "gridedit")
	$t05_pinjamanjaminan_grid->RowIndex = 0;
while ($t05_pinjamanjaminan_grid->RecCnt < $t05_pinjamanjaminan_grid->StopRec) {
	$t05_pinjamanjaminan_grid->RecCnt++;
	if (intval($t05_pinjamanjaminan_grid->RecCnt) >= intval($t05_pinjamanjaminan_grid->StartRec)) {
		$t05_pinjamanjaminan_grid->RowCnt++;
		if ($t05_pinjamanjaminan->CurrentAction == "gridadd" || $t05_pinjamanjaminan->CurrentAction == "gridedit" || $t05_pinjamanjaminan->CurrentAction == "F") {
			$t05_pinjamanjaminan_grid->RowIndex++;
			$objForm->Index = $t05_pinjamanjaminan_grid->RowIndex;
			if ($objForm->HasValue($t05_pinjamanjaminan_grid->FormActionName))
				$t05_pinjamanjaminan_grid->RowAction = strval($objForm->GetValue($t05_pinjamanjaminan_grid->FormActionName));
			elseif ($t05_pinjamanjaminan->CurrentAction == "gridadd")
				$t05_pinjamanjaminan_grid->RowAction = "insert";
			else
				$t05_pinjamanjaminan_grid->RowAction = "";
		}

		// Set up key count
		$t05_pinjamanjaminan_grid->KeyCount = $t05_pinjamanjaminan_grid->RowIndex;

		// Init row class and style
		$t05_pinjamanjaminan->ResetAttrs();
		$t05_pinjamanjaminan->CssClass = "";
		if ($t05_pinjamanjaminan->CurrentAction == "gridadd") {
			if ($t05_pinjamanjaminan->CurrentMode == "copy") {
				$t05_pinjamanjaminan_grid->LoadRowValues($t05_pinjamanjaminan_grid->Recordset); // Load row values
				$t05_pinjamanjaminan_grid->SetRecordKey($t05_pinjamanjaminan_grid->RowOldKey, $t05_pinjamanjaminan_grid->Recordset); // Set old record key
			} else {
				$t05_pinjamanjaminan_grid->LoadDefaultValues(); // Load default values
				$t05_pinjamanjaminan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t05_pinjamanjaminan_grid->LoadRowValues($t05_pinjamanjaminan_grid->Recordset); // Load row values
		}
		$t05_pinjamanjaminan->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t05_pinjamanjaminan->CurrentAction == "gridadd") // Grid add
			$t05_pinjamanjaminan->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t05_pinjamanjaminan->CurrentAction == "gridadd" && $t05_pinjamanjaminan->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t05_pinjamanjaminan_grid->RestoreCurrentRowFormValues($t05_pinjamanjaminan_grid->RowIndex); // Restore form values
		if ($t05_pinjamanjaminan->CurrentAction == "gridedit") { // Grid edit
			if ($t05_pinjamanjaminan->EventCancelled) {
				$t05_pinjamanjaminan_grid->RestoreCurrentRowFormValues($t05_pinjamanjaminan_grid->RowIndex); // Restore form values
			}
			if ($t05_pinjamanjaminan_grid->RowAction == "insert")
				$t05_pinjamanjaminan->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t05_pinjamanjaminan->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t05_pinjamanjaminan->CurrentAction == "gridedit" && ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_EDIT || $t05_pinjamanjaminan->RowType == EW_ROWTYPE_ADD) && $t05_pinjamanjaminan->EventCancelled) // Update failed
			$t05_pinjamanjaminan_grid->RestoreCurrentRowFormValues($t05_pinjamanjaminan_grid->RowIndex); // Restore form values
		if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t05_pinjamanjaminan_grid->EditRowCnt++;
		if ($t05_pinjamanjaminan->CurrentAction == "F") // Confirm row
			$t05_pinjamanjaminan_grid->RestoreCurrentRowFormValues($t05_pinjamanjaminan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t05_pinjamanjaminan->RowAttrs = array_merge($t05_pinjamanjaminan->RowAttrs, array('data-rowindex'=>$t05_pinjamanjaminan_grid->RowCnt, 'id'=>'r' . $t05_pinjamanjaminan_grid->RowCnt . '_t05_pinjamanjaminan', 'data-rowtype'=>$t05_pinjamanjaminan->RowType));

		// Render row
		$t05_pinjamanjaminan_grid->RenderRow();

		// Render list options
		$t05_pinjamanjaminan_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t05_pinjamanjaminan_grid->RowAction <> "delete" && $t05_pinjamanjaminan_grid->RowAction <> "insertdelete" && !($t05_pinjamanjaminan_grid->RowAction == "insert" && $t05_pinjamanjaminan->CurrentAction == "F" && $t05_pinjamanjaminan_grid->EmptyRow())) {
?>
	<tr<?php echo $t05_pinjamanjaminan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t05_pinjamanjaminan_grid->ListOptions->Render("body", "left", $t05_pinjamanjaminan_grid->RowCnt);
?>
	<?php if ($t05_pinjamanjaminan->jaminan_id->Visible) { // jaminan_id ?>
		<td data-name="jaminan_id"<?php echo $t05_pinjamanjaminan->jaminan_id->CellAttributes() ?>>
<?php if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t05_pinjamanjaminan_grid->RowCnt ?>_t05_pinjamanjaminan_jaminan_id" class="form-group t05_pinjamanjaminan_jaminan_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id"><?php echo (strval($t05_pinjamanjaminan->jaminan_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t05_pinjamanjaminan->jaminan_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t05_pinjamanjaminan->jaminan_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t05_pinjamanjaminan->jaminan_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo $t05_pinjamanjaminan->jaminan_id->CurrentValue ?>"<?php echo $t05_pinjamanjaminan->jaminan_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_jaminan")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t05_pinjamanjaminan->jaminan_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id',url:'t02_jaminanaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t05_pinjamanjaminan->jaminan_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="s_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo $t05_pinjamanjaminan->jaminan_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->OldValue) ?>">
<?php } ?>
<?php if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t05_pinjamanjaminan_grid->RowCnt ?>_t05_pinjamanjaminan_jaminan_id" class="form-group t05_pinjamanjaminan_jaminan_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id"><?php echo (strval($t05_pinjamanjaminan->jaminan_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t05_pinjamanjaminan->jaminan_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t05_pinjamanjaminan->jaminan_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t05_pinjamanjaminan->jaminan_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo $t05_pinjamanjaminan->jaminan_id->CurrentValue ?>"<?php echo $t05_pinjamanjaminan->jaminan_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_jaminan")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t05_pinjamanjaminan->jaminan_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id',url:'t02_jaminanaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t05_pinjamanjaminan->jaminan_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="s_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo $t05_pinjamanjaminan->jaminan_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t05_pinjamanjaminan_grid->RowCnt ?>_t05_pinjamanjaminan_jaminan_id" class="t05_pinjamanjaminan_jaminan_id">
<span<?php echo $t05_pinjamanjaminan->jaminan_id->ViewAttributes() ?>>
<?php echo $t05_pinjamanjaminan->jaminan_id->ListViewValue() ?></span>
</span>
<?php if ($t05_pinjamanjaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->FormValue) ?>">
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="ft05_pinjamanjaminangrid$x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="ft05_pinjamanjaminangrid$x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->FormValue) ?>">
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="ft05_pinjamanjaminangrid$o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="ft05_pinjamanjaminangrid$o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t05_pinjamanjaminan_grid->PageObjName . "_row_" . $t05_pinjamanjaminan_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_id" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->id->CurrentValue) ?>">
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_id" name="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_id" id="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->id->OldValue) ?>">
<?php } ?>
<?php if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_EDIT || $t05_pinjamanjaminan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_id" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->id->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$t05_pinjamanjaminan_grid->ListOptions->Render("body", "right", $t05_pinjamanjaminan_grid->RowCnt);
?>
	</tr>
<?php if ($t05_pinjamanjaminan->RowType == EW_ROWTYPE_ADD || $t05_pinjamanjaminan->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft05_pinjamanjaminangrid.UpdateOpts(<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t05_pinjamanjaminan->CurrentAction <> "gridadd" || $t05_pinjamanjaminan->CurrentMode == "copy")
		if (!$t05_pinjamanjaminan_grid->Recordset->EOF) $t05_pinjamanjaminan_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t05_pinjamanjaminan->CurrentMode == "add" || $t05_pinjamanjaminan->CurrentMode == "copy" || $t05_pinjamanjaminan->CurrentMode == "edit") {
		$t05_pinjamanjaminan_grid->RowIndex = '$rowindex$';
		$t05_pinjamanjaminan_grid->LoadDefaultValues();

		// Set row properties
		$t05_pinjamanjaminan->ResetAttrs();
		$t05_pinjamanjaminan->RowAttrs = array_merge($t05_pinjamanjaminan->RowAttrs, array('data-rowindex'=>$t05_pinjamanjaminan_grid->RowIndex, 'id'=>'r0_t05_pinjamanjaminan', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t05_pinjamanjaminan->RowAttrs["class"], "ewTemplate");
		$t05_pinjamanjaminan->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t05_pinjamanjaminan_grid->RenderRow();

		// Render list options
		$t05_pinjamanjaminan_grid->RenderListOptions();
		$t05_pinjamanjaminan_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t05_pinjamanjaminan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t05_pinjamanjaminan_grid->ListOptions->Render("body", "left", $t05_pinjamanjaminan_grid->RowIndex);
?>
	<?php if ($t05_pinjamanjaminan->jaminan_id->Visible) { // jaminan_id ?>
		<td data-name="jaminan_id">
<?php if ($t05_pinjamanjaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t05_pinjamanjaminan_jaminan_id" class="form-group t05_pinjamanjaminan_jaminan_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id"><?php echo (strval($t05_pinjamanjaminan->jaminan_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t05_pinjamanjaminan->jaminan_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t05_pinjamanjaminan->jaminan_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t05_pinjamanjaminan->jaminan_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo $t05_pinjamanjaminan->jaminan_id->CurrentValue ?>"<?php echo $t05_pinjamanjaminan->jaminan_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_jaminan")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t05_pinjamanjaminan->jaminan_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id',url:'t02_jaminanaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t05_pinjamanjaminan->jaminan_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="s_x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo $t05_pinjamanjaminan->jaminan_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t05_pinjamanjaminan_jaminan_id" class="form-group t05_pinjamanjaminan_jaminan_id">
<span<?php echo $t05_pinjamanjaminan->jaminan_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t05_pinjamanjaminan->jaminan_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="x<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t05_pinjamanjaminan" data-field="x_jaminan_id" name="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" id="o<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>_jaminan_id" value="<?php echo ew_HtmlEncode($t05_pinjamanjaminan->jaminan_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t05_pinjamanjaminan_grid->ListOptions->Render("body", "right", $t05_pinjamanjaminan_grid->RowCnt);
?>
<script type="text/javascript">
ft05_pinjamanjaminangrid.UpdateOpts(<?php echo $t05_pinjamanjaminan_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t05_pinjamanjaminan->CurrentMode == "add" || $t05_pinjamanjaminan->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t05_pinjamanjaminan_grid->FormKeyCountName ?>" id="<?php echo $t05_pinjamanjaminan_grid->FormKeyCountName ?>" value="<?php echo $t05_pinjamanjaminan_grid->KeyCount ?>">
<?php echo $t05_pinjamanjaminan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t05_pinjamanjaminan->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t05_pinjamanjaminan_grid->FormKeyCountName ?>" id="<?php echo $t05_pinjamanjaminan_grid->FormKeyCountName ?>" value="<?php echo $t05_pinjamanjaminan_grid->KeyCount ?>">
<?php echo $t05_pinjamanjaminan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t05_pinjamanjaminan->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft05_pinjamanjaminangrid">
</div>
<?php

// Close recordset
if ($t05_pinjamanjaminan_grid->Recordset)
	$t05_pinjamanjaminan_grid->Recordset->Close();
?>
<?php if ($t05_pinjamanjaminan_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t05_pinjamanjaminan_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t05_pinjamanjaminan_grid->TotalRecs == 0 && $t05_pinjamanjaminan->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t05_pinjamanjaminan_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t05_pinjamanjaminan->Export == "") { ?>
<script type="text/javascript">
ft05_pinjamanjaminangrid.Init();
</script>
<?php } ?>
<?php
$t05_pinjamanjaminan_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t05_pinjamanjaminan_grid->Page_Terminate();
?>
