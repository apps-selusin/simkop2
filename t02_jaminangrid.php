<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t02_jaminan_grid)) $t02_jaminan_grid = new ct02_jaminan_grid();

// Page init
$t02_jaminan_grid->Page_Init();

// Page main
$t02_jaminan_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t02_jaminan_grid->Page_Render();
?>
<?php if ($t02_jaminan->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft02_jaminangrid = new ew_Form("ft02_jaminangrid", "grid");
ft02_jaminangrid.FormKeyCountName = '<?php echo $t02_jaminan_grid->FormKeyCountName ?>';

// Validate form
ft02_jaminangrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_jaminan->nasabah_id->FldCaption(), $t02_jaminan->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_MerkType");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_jaminan->MerkType->FldCaption(), $t02_jaminan->MerkType->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft02_jaminangrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "nasabah_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "MerkType", false)) return false;
	if (ew_ValueChanged(fobj, infix, "NoRangka", false)) return false;
	if (ew_ValueChanged(fobj, infix, "NoMesin", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Warna", false)) return false;
	if (ew_ValueChanged(fobj, infix, "NoPol", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "AtasNama", false)) return false;
	return true;
}

// Form_CustomValidate event
ft02_jaminangrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft02_jaminangrid.ValidateRequired = true;
<?php } else { ?>
ft02_jaminangrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft02_jaminangrid.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Customer","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_nasabah"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t02_jaminan->CurrentAction == "gridadd") {
	if ($t02_jaminan->CurrentMode == "copy") {
		$bSelectLimit = $t02_jaminan_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t02_jaminan_grid->TotalRecs = $t02_jaminan->SelectRecordCount();
			$t02_jaminan_grid->Recordset = $t02_jaminan_grid->LoadRecordset($t02_jaminan_grid->StartRec-1, $t02_jaminan_grid->DisplayRecs);
		} else {
			if ($t02_jaminan_grid->Recordset = $t02_jaminan_grid->LoadRecordset())
				$t02_jaminan_grid->TotalRecs = $t02_jaminan_grid->Recordset->RecordCount();
		}
		$t02_jaminan_grid->StartRec = 1;
		$t02_jaminan_grid->DisplayRecs = $t02_jaminan_grid->TotalRecs;
	} else {
		$t02_jaminan->CurrentFilter = "0=1";
		$t02_jaminan_grid->StartRec = 1;
		$t02_jaminan_grid->DisplayRecs = $t02_jaminan->GridAddRowCount;
	}
	$t02_jaminan_grid->TotalRecs = $t02_jaminan_grid->DisplayRecs;
	$t02_jaminan_grid->StopRec = $t02_jaminan_grid->DisplayRecs;
} else {
	$bSelectLimit = $t02_jaminan_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t02_jaminan_grid->TotalRecs <= 0)
			$t02_jaminan_grid->TotalRecs = $t02_jaminan->SelectRecordCount();
	} else {
		if (!$t02_jaminan_grid->Recordset && ($t02_jaminan_grid->Recordset = $t02_jaminan_grid->LoadRecordset()))
			$t02_jaminan_grid->TotalRecs = $t02_jaminan_grid->Recordset->RecordCount();
	}
	$t02_jaminan_grid->StartRec = 1;
	$t02_jaminan_grid->DisplayRecs = $t02_jaminan_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t02_jaminan_grid->Recordset = $t02_jaminan_grid->LoadRecordset($t02_jaminan_grid->StartRec-1, $t02_jaminan_grid->DisplayRecs);

	// Set no record found message
	if ($t02_jaminan->CurrentAction == "" && $t02_jaminan_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t02_jaminan_grid->setWarningMessage(ew_DeniedMsg());
		if ($t02_jaminan_grid->SearchWhere == "0=101")
			$t02_jaminan_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t02_jaminan_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t02_jaminan_grid->RenderOtherOptions();
?>
<?php $t02_jaminan_grid->ShowPageHeader(); ?>
<?php
$t02_jaminan_grid->ShowMessage();
?>
<?php if ($t02_jaminan_grid->TotalRecs > 0 || $t02_jaminan->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t02_jaminan">
<div id="ft02_jaminangrid" class="ewForm form-inline">
<?php if ($t02_jaminan_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t02_jaminan_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t02_jaminan" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t02_jaminangrid" class="table ewTable">
<?php echo $t02_jaminan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t02_jaminan_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t02_jaminan_grid->RenderListOptions();

// Render list options (header, left)
$t02_jaminan_grid->ListOptions->Render("header", "left");
?>
<?php if ($t02_jaminan->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_t02_jaminan_nasabah_id" class="t02_jaminan_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div><div id="elh_t02_jaminan_nasabah_id" class="t02_jaminan_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->MerkType->Visible) { // MerkType ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->MerkType) == "") { ?>
		<th data-name="MerkType"><div id="elh_t02_jaminan_MerkType" class="t02_jaminan_MerkType"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->MerkType->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MerkType"><div><div id="elh_t02_jaminan_MerkType" class="t02_jaminan_MerkType">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->MerkType->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->MerkType->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->MerkType->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->NoRangka->Visible) { // NoRangka ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->NoRangka) == "") { ?>
		<th data-name="NoRangka"><div id="elh_t02_jaminan_NoRangka" class="t02_jaminan_NoRangka"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->NoRangka->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoRangka"><div><div id="elh_t02_jaminan_NoRangka" class="t02_jaminan_NoRangka">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->NoRangka->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->NoRangka->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->NoRangka->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->NoMesin->Visible) { // NoMesin ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->NoMesin) == "") { ?>
		<th data-name="NoMesin"><div id="elh_t02_jaminan_NoMesin" class="t02_jaminan_NoMesin"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->NoMesin->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoMesin"><div><div id="elh_t02_jaminan_NoMesin" class="t02_jaminan_NoMesin">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->NoMesin->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->NoMesin->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->NoMesin->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->Warna->Visible) { // Warna ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->Warna) == "") { ?>
		<th data-name="Warna"><div id="elh_t02_jaminan_Warna" class="t02_jaminan_Warna"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->Warna->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Warna"><div><div id="elh_t02_jaminan_Warna" class="t02_jaminan_Warna">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->Warna->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->Warna->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->Warna->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->NoPol->Visible) { // NoPol ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->NoPol) == "") { ?>
		<th data-name="NoPol"><div id="elh_t02_jaminan_NoPol" class="t02_jaminan_NoPol"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->NoPol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoPol"><div><div id="elh_t02_jaminan_NoPol" class="t02_jaminan_NoPol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->NoPol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->NoPol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->NoPol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t02_jaminan_Keterangan" class="t02_jaminan_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div><div id="elh_t02_jaminan_Keterangan" class="t02_jaminan_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->Keterangan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_jaminan->AtasNama->Visible) { // AtasNama ?>
	<?php if ($t02_jaminan->SortUrl($t02_jaminan->AtasNama) == "") { ?>
		<th data-name="AtasNama"><div id="elh_t02_jaminan_AtasNama" class="t02_jaminan_AtasNama"><div class="ewTableHeaderCaption"><?php echo $t02_jaminan->AtasNama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AtasNama"><div><div id="elh_t02_jaminan_AtasNama" class="t02_jaminan_AtasNama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_jaminan->AtasNama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_jaminan->AtasNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_jaminan->AtasNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t02_jaminan_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t02_jaminan_grid->StartRec = 1;
$t02_jaminan_grid->StopRec = $t02_jaminan_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t02_jaminan_grid->FormKeyCountName) && ($t02_jaminan->CurrentAction == "gridadd" || $t02_jaminan->CurrentAction == "gridedit" || $t02_jaminan->CurrentAction == "F")) {
		$t02_jaminan_grid->KeyCount = $objForm->GetValue($t02_jaminan_grid->FormKeyCountName);
		$t02_jaminan_grid->StopRec = $t02_jaminan_grid->StartRec + $t02_jaminan_grid->KeyCount - 1;
	}
}
$t02_jaminan_grid->RecCnt = $t02_jaminan_grid->StartRec - 1;
if ($t02_jaminan_grid->Recordset && !$t02_jaminan_grid->Recordset->EOF) {
	$t02_jaminan_grid->Recordset->MoveFirst();
	$bSelectLimit = $t02_jaminan_grid->UseSelectLimit;
	if (!$bSelectLimit && $t02_jaminan_grid->StartRec > 1)
		$t02_jaminan_grid->Recordset->Move($t02_jaminan_grid->StartRec - 1);
} elseif (!$t02_jaminan->AllowAddDeleteRow && $t02_jaminan_grid->StopRec == 0) {
	$t02_jaminan_grid->StopRec = $t02_jaminan->GridAddRowCount;
}

// Initialize aggregate
$t02_jaminan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t02_jaminan->ResetAttrs();
$t02_jaminan_grid->RenderRow();
if ($t02_jaminan->CurrentAction == "gridadd")
	$t02_jaminan_grid->RowIndex = 0;
if ($t02_jaminan->CurrentAction == "gridedit")
	$t02_jaminan_grid->RowIndex = 0;
while ($t02_jaminan_grid->RecCnt < $t02_jaminan_grid->StopRec) {
	$t02_jaminan_grid->RecCnt++;
	if (intval($t02_jaminan_grid->RecCnt) >= intval($t02_jaminan_grid->StartRec)) {
		$t02_jaminan_grid->RowCnt++;
		if ($t02_jaminan->CurrentAction == "gridadd" || $t02_jaminan->CurrentAction == "gridedit" || $t02_jaminan->CurrentAction == "F") {
			$t02_jaminan_grid->RowIndex++;
			$objForm->Index = $t02_jaminan_grid->RowIndex;
			if ($objForm->HasValue($t02_jaminan_grid->FormActionName))
				$t02_jaminan_grid->RowAction = strval($objForm->GetValue($t02_jaminan_grid->FormActionName));
			elseif ($t02_jaminan->CurrentAction == "gridadd")
				$t02_jaminan_grid->RowAction = "insert";
			else
				$t02_jaminan_grid->RowAction = "";
		}

		// Set up key count
		$t02_jaminan_grid->KeyCount = $t02_jaminan_grid->RowIndex;

		// Init row class and style
		$t02_jaminan->ResetAttrs();
		$t02_jaminan->CssClass = "";
		if ($t02_jaminan->CurrentAction == "gridadd") {
			if ($t02_jaminan->CurrentMode == "copy") {
				$t02_jaminan_grid->LoadRowValues($t02_jaminan_grid->Recordset); // Load row values
				$t02_jaminan_grid->SetRecordKey($t02_jaminan_grid->RowOldKey, $t02_jaminan_grid->Recordset); // Set old record key
			} else {
				$t02_jaminan_grid->LoadDefaultValues(); // Load default values
				$t02_jaminan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t02_jaminan_grid->LoadRowValues($t02_jaminan_grid->Recordset); // Load row values
		}
		$t02_jaminan->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t02_jaminan->CurrentAction == "gridadd") // Grid add
			$t02_jaminan->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t02_jaminan->CurrentAction == "gridadd" && $t02_jaminan->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t02_jaminan_grid->RestoreCurrentRowFormValues($t02_jaminan_grid->RowIndex); // Restore form values
		if ($t02_jaminan->CurrentAction == "gridedit") { // Grid edit
			if ($t02_jaminan->EventCancelled) {
				$t02_jaminan_grid->RestoreCurrentRowFormValues($t02_jaminan_grid->RowIndex); // Restore form values
			}
			if ($t02_jaminan_grid->RowAction == "insert")
				$t02_jaminan->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t02_jaminan->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t02_jaminan->CurrentAction == "gridedit" && ($t02_jaminan->RowType == EW_ROWTYPE_EDIT || $t02_jaminan->RowType == EW_ROWTYPE_ADD) && $t02_jaminan->EventCancelled) // Update failed
			$t02_jaminan_grid->RestoreCurrentRowFormValues($t02_jaminan_grid->RowIndex); // Restore form values
		if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t02_jaminan_grid->EditRowCnt++;
		if ($t02_jaminan->CurrentAction == "F") // Confirm row
			$t02_jaminan_grid->RestoreCurrentRowFormValues($t02_jaminan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t02_jaminan->RowAttrs = array_merge($t02_jaminan->RowAttrs, array('data-rowindex'=>$t02_jaminan_grid->RowCnt, 'id'=>'r' . $t02_jaminan_grid->RowCnt . '_t02_jaminan', 'data-rowtype'=>$t02_jaminan->RowType));

		// Render row
		$t02_jaminan_grid->RenderRow();

		// Render list options
		$t02_jaminan_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t02_jaminan_grid->RowAction <> "delete" && $t02_jaminan_grid->RowAction <> "insertdelete" && !($t02_jaminan_grid->RowAction == "insert" && $t02_jaminan->CurrentAction == "F" && $t02_jaminan_grid->EmptyRow())) {
?>
	<tr<?php echo $t02_jaminan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t02_jaminan_grid->ListOptions->Render("body", "left", $t02_jaminan_grid->RowCnt);
?>
	<?php if ($t02_jaminan->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $t02_jaminan->nasabah_id->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t02_jaminan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_nasabah_id" class="form-group t02_jaminan_nasabah_id">
<span<?php echo $t02_jaminan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_nasabah_id" class="form-group t02_jaminan_nasabah_id">
<?php
$wrkonchange = trim(" " . @$t02_jaminan->nasabah_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t02_jaminan->nasabah_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t02_jaminan_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="sv_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo $t02_jaminan->nasabah_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>"<?php echo $t02_jaminan->nasabah_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" data-value-separator="<?php echo $t02_jaminan->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="q_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo $t02_jaminan->nasabah_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft02_jaminangrid.CreateAutoSuggest({"id":"x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_nasabah_id" class="form-group t02_jaminan_nasabah_id">
<span<?php echo $t02_jaminan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->nasabah_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_nasabah_id" class="t02_jaminan_nasabah_id">
<span<?php echo $t02_jaminan->nasabah_id->ViewAttributes() ?>>
<?php echo $t02_jaminan->nasabah_id->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t02_jaminan_grid->PageObjName . "_row_" . $t02_jaminan_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t02_jaminan->id->CurrentValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_id" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_id" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t02_jaminan->id->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT || $t02_jaminan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t02_jaminan->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t02_jaminan->MerkType->Visible) { // MerkType ?>
		<td data-name="MerkType"<?php echo $t02_jaminan->MerkType->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_MerkType" class="form-group t02_jaminan_MerkType">
<input type="text" data-table="t02_jaminan" data-field="x_MerkType" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->MerkType->EditValue ?>"<?php echo $t02_jaminan->MerkType->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_MerkType" class="form-group t02_jaminan_MerkType">
<input type="text" data-table="t02_jaminan" data-field="x_MerkType" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->MerkType->EditValue ?>"<?php echo $t02_jaminan->MerkType->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_MerkType" class="t02_jaminan_MerkType">
<span<?php echo $t02_jaminan->MerkType->ViewAttributes() ?>>
<?php echo $t02_jaminan->MerkType->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t02_jaminan->NoRangka->Visible) { // NoRangka ?>
		<td data-name="NoRangka"<?php echo $t02_jaminan->NoRangka->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoRangka" class="form-group t02_jaminan_NoRangka">
<input type="text" data-table="t02_jaminan" data-field="x_NoRangka" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoRangka->EditValue ?>"<?php echo $t02_jaminan->NoRangka->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoRangka" class="form-group t02_jaminan_NoRangka">
<input type="text" data-table="t02_jaminan" data-field="x_NoRangka" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoRangka->EditValue ?>"<?php echo $t02_jaminan->NoRangka->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoRangka" class="t02_jaminan_NoRangka">
<span<?php echo $t02_jaminan->NoRangka->ViewAttributes() ?>>
<?php echo $t02_jaminan->NoRangka->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t02_jaminan->NoMesin->Visible) { // NoMesin ?>
		<td data-name="NoMesin"<?php echo $t02_jaminan->NoMesin->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoMesin" class="form-group t02_jaminan_NoMesin">
<input type="text" data-table="t02_jaminan" data-field="x_NoMesin" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoMesin->EditValue ?>"<?php echo $t02_jaminan->NoMesin->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoMesin" class="form-group t02_jaminan_NoMesin">
<input type="text" data-table="t02_jaminan" data-field="x_NoMesin" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoMesin->EditValue ?>"<?php echo $t02_jaminan->NoMesin->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoMesin" class="t02_jaminan_NoMesin">
<span<?php echo $t02_jaminan->NoMesin->ViewAttributes() ?>>
<?php echo $t02_jaminan->NoMesin->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t02_jaminan->Warna->Visible) { // Warna ?>
		<td data-name="Warna"<?php echo $t02_jaminan->Warna->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_Warna" class="form-group t02_jaminan_Warna">
<input type="text" data-table="t02_jaminan" data-field="x_Warna" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Warna->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Warna->EditValue ?>"<?php echo $t02_jaminan->Warna->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_Warna" class="form-group t02_jaminan_Warna">
<input type="text" data-table="t02_jaminan" data-field="x_Warna" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Warna->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Warna->EditValue ?>"<?php echo $t02_jaminan->Warna->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_Warna" class="t02_jaminan_Warna">
<span<?php echo $t02_jaminan->Warna->ViewAttributes() ?>>
<?php echo $t02_jaminan->Warna->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t02_jaminan->NoPol->Visible) { // NoPol ?>
		<td data-name="NoPol"<?php echo $t02_jaminan->NoPol->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoPol" class="form-group t02_jaminan_NoPol">
<input type="text" data-table="t02_jaminan" data-field="x_NoPol" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoPol->EditValue ?>"<?php echo $t02_jaminan->NoPol->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoPol" class="form-group t02_jaminan_NoPol">
<input type="text" data-table="t02_jaminan" data-field="x_NoPol" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoPol->EditValue ?>"<?php echo $t02_jaminan->NoPol->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_NoPol" class="t02_jaminan_NoPol">
<span<?php echo $t02_jaminan->NoPol->ViewAttributes() ?>>
<?php echo $t02_jaminan->NoPol->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t02_jaminan->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t02_jaminan->Keterangan->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_Keterangan" class="form-group t02_jaminan_Keterangan">
<textarea data-table="t02_jaminan" data-field="x_Keterangan" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->getPlaceHolder()) ?>"<?php echo $t02_jaminan->Keterangan->EditAttributes() ?>><?php echo $t02_jaminan->Keterangan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_Keterangan" class="form-group t02_jaminan_Keterangan">
<textarea data-table="t02_jaminan" data-field="x_Keterangan" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->getPlaceHolder()) ?>"<?php echo $t02_jaminan->Keterangan->EditAttributes() ?>><?php echo $t02_jaminan->Keterangan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_Keterangan" class="t02_jaminan_Keterangan">
<span<?php echo $t02_jaminan->Keterangan->ViewAttributes() ?>>
<?php echo $t02_jaminan->Keterangan->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t02_jaminan->AtasNama->Visible) { // AtasNama ?>
		<td data-name="AtasNama"<?php echo $t02_jaminan->AtasNama->CellAttributes() ?>>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_AtasNama" class="form-group t02_jaminan_AtasNama">
<input type="text" data-table="t02_jaminan" data-field="x_AtasNama" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->AtasNama->EditValue ?>"<?php echo $t02_jaminan->AtasNama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->OldValue) ?>">
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_AtasNama" class="form-group t02_jaminan_AtasNama">
<input type="text" data-table="t02_jaminan" data-field="x_AtasNama" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->AtasNama->EditValue ?>"<?php echo $t02_jaminan->AtasNama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_jaminan_grid->RowCnt ?>_t02_jaminan_AtasNama" class="t02_jaminan_AtasNama">
<span<?php echo $t02_jaminan->AtasNama->ViewAttributes() ?>>
<?php echo $t02_jaminan->AtasNama->ListViewValue() ?></span>
</span>
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="ft02_jaminangrid$x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->FormValue) ?>">
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="ft02_jaminangrid$o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t02_jaminan_grid->ListOptions->Render("body", "right", $t02_jaminan_grid->RowCnt);
?>
	</tr>
<?php if ($t02_jaminan->RowType == EW_ROWTYPE_ADD || $t02_jaminan->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft02_jaminangrid.UpdateOpts(<?php echo $t02_jaminan_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t02_jaminan->CurrentAction <> "gridadd" || $t02_jaminan->CurrentMode == "copy")
		if (!$t02_jaminan_grid->Recordset->EOF) $t02_jaminan_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t02_jaminan->CurrentMode == "add" || $t02_jaminan->CurrentMode == "copy" || $t02_jaminan->CurrentMode == "edit") {
		$t02_jaminan_grid->RowIndex = '$rowindex$';
		$t02_jaminan_grid->LoadDefaultValues();

		// Set row properties
		$t02_jaminan->ResetAttrs();
		$t02_jaminan->RowAttrs = array_merge($t02_jaminan->RowAttrs, array('data-rowindex'=>$t02_jaminan_grid->RowIndex, 'id'=>'r0_t02_jaminan', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t02_jaminan->RowAttrs["class"], "ewTemplate");
		$t02_jaminan->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t02_jaminan_grid->RenderRow();

		// Render list options
		$t02_jaminan_grid->RenderListOptions();
		$t02_jaminan_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t02_jaminan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t02_jaminan_grid->ListOptions->Render("body", "left", $t02_jaminan_grid->RowIndex);
?>
	<?php if ($t02_jaminan->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<?php if ($t02_jaminan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t02_jaminan_nasabah_id" class="form-group t02_jaminan_nasabah_id">
<span<?php echo $t02_jaminan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_nasabah_id" class="form-group t02_jaminan_nasabah_id">
<?php
$wrkonchange = trim(" " . @$t02_jaminan->nasabah_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t02_jaminan->nasabah_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t02_jaminan_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="sv_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo $t02_jaminan->nasabah_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>"<?php echo $t02_jaminan->nasabah_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" data-value-separator="<?php echo $t02_jaminan->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="q_x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo $t02_jaminan->nasabah_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft02_jaminangrid.CreateAutoSuggest({"id":"x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_nasabah_id" class="form-group t02_jaminan_nasabah_id">
<span<?php echo $t02_jaminan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->MerkType->Visible) { // MerkType ?>
		<td data-name="MerkType">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_MerkType" class="form-group t02_jaminan_MerkType">
<input type="text" data-table="t02_jaminan" data-field="x_MerkType" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->MerkType->EditValue ?>"<?php echo $t02_jaminan->MerkType->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_MerkType" class="form-group t02_jaminan_MerkType">
<span<?php echo $t02_jaminan->MerkType->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->MerkType->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_MerkType" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_MerkType" value="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->NoRangka->Visible) { // NoRangka ?>
		<td data-name="NoRangka">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_NoRangka" class="form-group t02_jaminan_NoRangka">
<input type="text" data-table="t02_jaminan" data-field="x_NoRangka" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoRangka->EditValue ?>"<?php echo $t02_jaminan->NoRangka->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_NoRangka" class="form-group t02_jaminan_NoRangka">
<span<?php echo $t02_jaminan->NoRangka->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->NoRangka->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoRangka" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoRangka" value="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->NoMesin->Visible) { // NoMesin ?>
		<td data-name="NoMesin">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_NoMesin" class="form-group t02_jaminan_NoMesin">
<input type="text" data-table="t02_jaminan" data-field="x_NoMesin" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoMesin->EditValue ?>"<?php echo $t02_jaminan->NoMesin->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_NoMesin" class="form-group t02_jaminan_NoMesin">
<span<?php echo $t02_jaminan->NoMesin->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->NoMesin->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoMesin" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoMesin" value="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->Warna->Visible) { // Warna ?>
		<td data-name="Warna">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_Warna" class="form-group t02_jaminan_Warna">
<input type="text" data-table="t02_jaminan" data-field="x_Warna" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Warna->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Warna->EditValue ?>"<?php echo $t02_jaminan->Warna->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_Warna" class="form-group t02_jaminan_Warna">
<span<?php echo $t02_jaminan->Warna->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->Warna->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_Warna" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_Warna" value="<?php echo ew_HtmlEncode($t02_jaminan->Warna->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->NoPol->Visible) { // NoPol ?>
		<td data-name="NoPol">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_NoPol" class="form-group t02_jaminan_NoPol">
<input type="text" data-table="t02_jaminan" data-field="x_NoPol" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoPol->EditValue ?>"<?php echo $t02_jaminan->NoPol->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_NoPol" class="form-group t02_jaminan_NoPol">
<span<?php echo $t02_jaminan->NoPol->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->NoPol->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_NoPol" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_NoPol" value="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_Keterangan" class="form-group t02_jaminan_Keterangan">
<textarea data-table="t02_jaminan" data-field="x_Keterangan" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->getPlaceHolder()) ?>"<?php echo $t02_jaminan->Keterangan->EditAttributes() ?>><?php echo $t02_jaminan->Keterangan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_Keterangan" class="form-group t02_jaminan_Keterangan">
<span<?php echo $t02_jaminan->Keterangan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->Keterangan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_Keterangan" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_jaminan->AtasNama->Visible) { // AtasNama ?>
		<td data-name="AtasNama">
<?php if ($t02_jaminan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_jaminan_AtasNama" class="form-group t02_jaminan_AtasNama">
<input type="text" data-table="t02_jaminan" data-field="x_AtasNama" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->AtasNama->EditValue ?>"<?php echo $t02_jaminan->AtasNama->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_jaminan_AtasNama" class="form-group t02_jaminan_AtasNama">
<span<?php echo $t02_jaminan->AtasNama->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->AtasNama->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="x<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_jaminan" data-field="x_AtasNama" name="o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" id="o<?php echo $t02_jaminan_grid->RowIndex ?>_AtasNama" value="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t02_jaminan_grid->ListOptions->Render("body", "right", $t02_jaminan_grid->RowCnt);
?>
<script type="text/javascript">
ft02_jaminangrid.UpdateOpts(<?php echo $t02_jaminan_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t02_jaminan->CurrentMode == "add" || $t02_jaminan->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t02_jaminan_grid->FormKeyCountName ?>" id="<?php echo $t02_jaminan_grid->FormKeyCountName ?>" value="<?php echo $t02_jaminan_grid->KeyCount ?>">
<?php echo $t02_jaminan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t02_jaminan->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t02_jaminan_grid->FormKeyCountName ?>" id="<?php echo $t02_jaminan_grid->FormKeyCountName ?>" value="<?php echo $t02_jaminan_grid->KeyCount ?>">
<?php echo $t02_jaminan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t02_jaminan->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft02_jaminangrid">
</div>
<?php

// Close recordset
if ($t02_jaminan_grid->Recordset)
	$t02_jaminan_grid->Recordset->Close();
?>
<?php if ($t02_jaminan_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t02_jaminan_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t02_jaminan_grid->TotalRecs == 0 && $t02_jaminan->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t02_jaminan_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t02_jaminan->Export == "") { ?>
<script type="text/javascript">
ft02_jaminangrid.Init();
</script>
<?php } ?>
<?php
$t02_jaminan_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t02_jaminan_grid->Page_Terminate();
?>
