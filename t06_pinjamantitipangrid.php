<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t06_pinjamantitipan_grid)) $t06_pinjamantitipan_grid = new ct06_pinjamantitipan_grid();

// Page init
$t06_pinjamantitipan_grid->Page_Init();

// Page main
$t06_pinjamantitipan_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_pinjamantitipan_grid->Page_Render();
?>
<?php if ($t06_pinjamantitipan->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft06_pinjamantitipangrid = new ew_Form("ft06_pinjamantitipangrid", "grid");
ft06_pinjamantitipangrid.FormKeyCountName = '<?php echo $t06_pinjamantitipan_grid->FormKeyCountName ?>';

// Validate form
ft06_pinjamantitipangrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_pinjamantitipan->Tanggal->FldCaption(), $t06_pinjamantitipan->Tanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_pinjamantitipan->Tanggal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Masuk");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_pinjamantitipan->Masuk->FldCaption(), $t06_pinjamantitipan->Masuk->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Masuk");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_pinjamantitipan->Masuk->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Keluar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_pinjamantitipan->Keluar->FldCaption(), $t06_pinjamantitipan->Keluar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Keluar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_pinjamantitipan->Keluar->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Sisa");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_pinjamantitipan->Sisa->FldCaption(), $t06_pinjamantitipan->Sisa->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_pinjamantitipan->nasabah_id->FldCaption(), $t06_pinjamantitipan->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_pinjamantitipan->nasabah_id->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft06_pinjamantitipangrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "Tanggal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Masuk", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keluar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Sisa", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nasabah_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ft06_pinjamantitipangrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_pinjamantitipangrid.ValidateRequired = true;
<?php } else { ?>
ft06_pinjamantitipangrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t06_pinjamantitipan->CurrentAction == "gridadd") {
	if ($t06_pinjamantitipan->CurrentMode == "copy") {
		$bSelectLimit = $t06_pinjamantitipan_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t06_pinjamantitipan_grid->TotalRecs = $t06_pinjamantitipan->SelectRecordCount();
			$t06_pinjamantitipan_grid->Recordset = $t06_pinjamantitipan_grid->LoadRecordset($t06_pinjamantitipan_grid->StartRec-1, $t06_pinjamantitipan_grid->DisplayRecs);
		} else {
			if ($t06_pinjamantitipan_grid->Recordset = $t06_pinjamantitipan_grid->LoadRecordset())
				$t06_pinjamantitipan_grid->TotalRecs = $t06_pinjamantitipan_grid->Recordset->RecordCount();
		}
		$t06_pinjamantitipan_grid->StartRec = 1;
		$t06_pinjamantitipan_grid->DisplayRecs = $t06_pinjamantitipan_grid->TotalRecs;
	} else {
		$t06_pinjamantitipan->CurrentFilter = "0=1";
		$t06_pinjamantitipan_grid->StartRec = 1;
		$t06_pinjamantitipan_grid->DisplayRecs = $t06_pinjamantitipan->GridAddRowCount;
	}
	$t06_pinjamantitipan_grid->TotalRecs = $t06_pinjamantitipan_grid->DisplayRecs;
	$t06_pinjamantitipan_grid->StopRec = $t06_pinjamantitipan_grid->DisplayRecs;
} else {
	$bSelectLimit = $t06_pinjamantitipan_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t06_pinjamantitipan_grid->TotalRecs <= 0)
			$t06_pinjamantitipan_grid->TotalRecs = $t06_pinjamantitipan->SelectRecordCount();
	} else {
		if (!$t06_pinjamantitipan_grid->Recordset && ($t06_pinjamantitipan_grid->Recordset = $t06_pinjamantitipan_grid->LoadRecordset()))
			$t06_pinjamantitipan_grid->TotalRecs = $t06_pinjamantitipan_grid->Recordset->RecordCount();
	}
	$t06_pinjamantitipan_grid->StartRec = 1;
	$t06_pinjamantitipan_grid->DisplayRecs = $t06_pinjamantitipan_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t06_pinjamantitipan_grid->Recordset = $t06_pinjamantitipan_grid->LoadRecordset($t06_pinjamantitipan_grid->StartRec-1, $t06_pinjamantitipan_grid->DisplayRecs);

	// Set no record found message
	if ($t06_pinjamantitipan->CurrentAction == "" && $t06_pinjamantitipan_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t06_pinjamantitipan_grid->setWarningMessage(ew_DeniedMsg());
		if ($t06_pinjamantitipan_grid->SearchWhere == "0=101")
			$t06_pinjamantitipan_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t06_pinjamantitipan_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t06_pinjamantitipan_grid->RenderOtherOptions();
?>
<?php $t06_pinjamantitipan_grid->ShowPageHeader(); ?>
<?php
$t06_pinjamantitipan_grid->ShowMessage();
?>
<?php if ($t06_pinjamantitipan_grid->TotalRecs > 0 || $t06_pinjamantitipan->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t06_pinjamantitipan">
<div id="ft06_pinjamantitipangrid" class="ewForm form-inline">
<?php if ($t06_pinjamantitipan_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t06_pinjamantitipan_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t06_pinjamantitipan" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t06_pinjamantitipangrid" class="table ewTable">
<?php echo $t06_pinjamantitipan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t06_pinjamantitipan_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t06_pinjamantitipan_grid->RenderListOptions();

// Render list options (header, left)
$t06_pinjamantitipan_grid->ListOptions->Render("header", "left");
?>
<?php if ($t06_pinjamantitipan->Tanggal->Visible) { // Tanggal ?>
	<?php if ($t06_pinjamantitipan->SortUrl($t06_pinjamantitipan->Tanggal) == "") { ?>
		<th data-name="Tanggal"><div id="elh_t06_pinjamantitipan_Tanggal" class="t06_pinjamantitipan_Tanggal"><div class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Tanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal"><div><div id="elh_t06_pinjamantitipan_Tanggal" class="t06_pinjamantitipan_Tanggal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Tanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_pinjamantitipan->Tanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_pinjamantitipan->Tanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_pinjamantitipan->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t06_pinjamantitipan->SortUrl($t06_pinjamantitipan->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t06_pinjamantitipan_Keterangan" class="t06_pinjamantitipan_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div><div id="elh_t06_pinjamantitipan_Keterangan" class="t06_pinjamantitipan_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Keterangan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_pinjamantitipan->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_pinjamantitipan->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_pinjamantitipan->Masuk->Visible) { // Masuk ?>
	<?php if ($t06_pinjamantitipan->SortUrl($t06_pinjamantitipan->Masuk) == "") { ?>
		<th data-name="Masuk"><div id="elh_t06_pinjamantitipan_Masuk" class="t06_pinjamantitipan_Masuk"><div class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Masuk->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Masuk"><div><div id="elh_t06_pinjamantitipan_Masuk" class="t06_pinjamantitipan_Masuk">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Masuk->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_pinjamantitipan->Masuk->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_pinjamantitipan->Masuk->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_pinjamantitipan->Keluar->Visible) { // Keluar ?>
	<?php if ($t06_pinjamantitipan->SortUrl($t06_pinjamantitipan->Keluar) == "") { ?>
		<th data-name="Keluar"><div id="elh_t06_pinjamantitipan_Keluar" class="t06_pinjamantitipan_Keluar"><div class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Keluar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keluar"><div><div id="elh_t06_pinjamantitipan_Keluar" class="t06_pinjamantitipan_Keluar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Keluar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_pinjamantitipan->Keluar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_pinjamantitipan->Keluar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_pinjamantitipan->Sisa->Visible) { // Sisa ?>
	<?php if ($t06_pinjamantitipan->SortUrl($t06_pinjamantitipan->Sisa) == "") { ?>
		<th data-name="Sisa"><div id="elh_t06_pinjamantitipan_Sisa" class="t06_pinjamantitipan_Sisa"><div class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Sisa->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sisa"><div><div id="elh_t06_pinjamantitipan_Sisa" class="t06_pinjamantitipan_Sisa">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->Sisa->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_pinjamantitipan->Sisa->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_pinjamantitipan->Sisa->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_pinjamantitipan->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($t06_pinjamantitipan->SortUrl($t06_pinjamantitipan->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_t06_pinjamantitipan_nasabah_id" class="t06_pinjamantitipan_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div><div id="elh_t06_pinjamantitipan_nasabah_id" class="t06_pinjamantitipan_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_pinjamantitipan->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_pinjamantitipan->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_pinjamantitipan->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t06_pinjamantitipan_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t06_pinjamantitipan_grid->StartRec = 1;
$t06_pinjamantitipan_grid->StopRec = $t06_pinjamantitipan_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t06_pinjamantitipan_grid->FormKeyCountName) && ($t06_pinjamantitipan->CurrentAction == "gridadd" || $t06_pinjamantitipan->CurrentAction == "gridedit" || $t06_pinjamantitipan->CurrentAction == "F")) {
		$t06_pinjamantitipan_grid->KeyCount = $objForm->GetValue($t06_pinjamantitipan_grid->FormKeyCountName);
		$t06_pinjamantitipan_grid->StopRec = $t06_pinjamantitipan_grid->StartRec + $t06_pinjamantitipan_grid->KeyCount - 1;
	}
}
$t06_pinjamantitipan_grid->RecCnt = $t06_pinjamantitipan_grid->StartRec - 1;
if ($t06_pinjamantitipan_grid->Recordset && !$t06_pinjamantitipan_grid->Recordset->EOF) {
	$t06_pinjamantitipan_grid->Recordset->MoveFirst();
	$bSelectLimit = $t06_pinjamantitipan_grid->UseSelectLimit;
	if (!$bSelectLimit && $t06_pinjamantitipan_grid->StartRec > 1)
		$t06_pinjamantitipan_grid->Recordset->Move($t06_pinjamantitipan_grid->StartRec - 1);
} elseif (!$t06_pinjamantitipan->AllowAddDeleteRow && $t06_pinjamantitipan_grid->StopRec == 0) {
	$t06_pinjamantitipan_grid->StopRec = $t06_pinjamantitipan->GridAddRowCount;
}

// Initialize aggregate
$t06_pinjamantitipan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t06_pinjamantitipan->ResetAttrs();
$t06_pinjamantitipan_grid->RenderRow();
if ($t06_pinjamantitipan->CurrentAction == "gridadd")
	$t06_pinjamantitipan_grid->RowIndex = 0;
if ($t06_pinjamantitipan->CurrentAction == "gridedit")
	$t06_pinjamantitipan_grid->RowIndex = 0;
while ($t06_pinjamantitipan_grid->RecCnt < $t06_pinjamantitipan_grid->StopRec) {
	$t06_pinjamantitipan_grid->RecCnt++;
	if (intval($t06_pinjamantitipan_grid->RecCnt) >= intval($t06_pinjamantitipan_grid->StartRec)) {
		$t06_pinjamantitipan_grid->RowCnt++;
		if ($t06_pinjamantitipan->CurrentAction == "gridadd" || $t06_pinjamantitipan->CurrentAction == "gridedit" || $t06_pinjamantitipan->CurrentAction == "F") {
			$t06_pinjamantitipan_grid->RowIndex++;
			$objForm->Index = $t06_pinjamantitipan_grid->RowIndex;
			if ($objForm->HasValue($t06_pinjamantitipan_grid->FormActionName))
				$t06_pinjamantitipan_grid->RowAction = strval($objForm->GetValue($t06_pinjamantitipan_grid->FormActionName));
			elseif ($t06_pinjamantitipan->CurrentAction == "gridadd")
				$t06_pinjamantitipan_grid->RowAction = "insert";
			else
				$t06_pinjamantitipan_grid->RowAction = "";
		}

		// Set up key count
		$t06_pinjamantitipan_grid->KeyCount = $t06_pinjamantitipan_grid->RowIndex;

		// Init row class and style
		$t06_pinjamantitipan->ResetAttrs();
		$t06_pinjamantitipan->CssClass = "";
		if ($t06_pinjamantitipan->CurrentAction == "gridadd") {
			if ($t06_pinjamantitipan->CurrentMode == "copy") {
				$t06_pinjamantitipan_grid->LoadRowValues($t06_pinjamantitipan_grid->Recordset); // Load row values
				$t06_pinjamantitipan_grid->SetRecordKey($t06_pinjamantitipan_grid->RowOldKey, $t06_pinjamantitipan_grid->Recordset); // Set old record key
			} else {
				$t06_pinjamantitipan_grid->LoadDefaultValues(); // Load default values
				$t06_pinjamantitipan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t06_pinjamantitipan_grid->LoadRowValues($t06_pinjamantitipan_grid->Recordset); // Load row values
		}
		$t06_pinjamantitipan->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t06_pinjamantitipan->CurrentAction == "gridadd") // Grid add
			$t06_pinjamantitipan->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t06_pinjamantitipan->CurrentAction == "gridadd" && $t06_pinjamantitipan->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t06_pinjamantitipan_grid->RestoreCurrentRowFormValues($t06_pinjamantitipan_grid->RowIndex); // Restore form values
		if ($t06_pinjamantitipan->CurrentAction == "gridedit") { // Grid edit
			if ($t06_pinjamantitipan->EventCancelled) {
				$t06_pinjamantitipan_grid->RestoreCurrentRowFormValues($t06_pinjamantitipan_grid->RowIndex); // Restore form values
			}
			if ($t06_pinjamantitipan_grid->RowAction == "insert")
				$t06_pinjamantitipan->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t06_pinjamantitipan->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t06_pinjamantitipan->CurrentAction == "gridedit" && ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT || $t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) && $t06_pinjamantitipan->EventCancelled) // Update failed
			$t06_pinjamantitipan_grid->RestoreCurrentRowFormValues($t06_pinjamantitipan_grid->RowIndex); // Restore form values
		if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t06_pinjamantitipan_grid->EditRowCnt++;
		if ($t06_pinjamantitipan->CurrentAction == "F") // Confirm row
			$t06_pinjamantitipan_grid->RestoreCurrentRowFormValues($t06_pinjamantitipan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t06_pinjamantitipan->RowAttrs = array_merge($t06_pinjamantitipan->RowAttrs, array('data-rowindex'=>$t06_pinjamantitipan_grid->RowCnt, 'id'=>'r' . $t06_pinjamantitipan_grid->RowCnt . '_t06_pinjamantitipan', 'data-rowtype'=>$t06_pinjamantitipan->RowType));

		// Render row
		$t06_pinjamantitipan_grid->RenderRow();

		// Render list options
		$t06_pinjamantitipan_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t06_pinjamantitipan_grid->RowAction <> "delete" && $t06_pinjamantitipan_grid->RowAction <> "insertdelete" && !($t06_pinjamantitipan_grid->RowAction == "insert" && $t06_pinjamantitipan->CurrentAction == "F" && $t06_pinjamantitipan_grid->EmptyRow())) {
?>
	<tr<?php echo $t06_pinjamantitipan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_pinjamantitipan_grid->ListOptions->Render("body", "left", $t06_pinjamantitipan_grid->RowCnt);
?>
	<?php if ($t06_pinjamantitipan->Tanggal->Visible) { // Tanggal ?>
		<td data-name="Tanggal"<?php echo $t06_pinjamantitipan->Tanggal->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Tanggal" class="form-group t06_pinjamantitipan_Tanggal">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Tanggal" data-format="7" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Tanggal->EditValue ?>"<?php echo $t06_pinjamantitipan->Tanggal->EditAttributes() ?>>
<?php if (!$t06_pinjamantitipan->Tanggal->ReadOnly && !$t06_pinjamantitipan->Tanggal->Disabled && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["readonly"]) && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_pinjamantitipangrid", "x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Tanggal" class="form-group t06_pinjamantitipan_Tanggal">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Tanggal" data-format="7" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Tanggal->EditValue ?>"<?php echo $t06_pinjamantitipan->Tanggal->EditAttributes() ?>>
<?php if (!$t06_pinjamantitipan->Tanggal->ReadOnly && !$t06_pinjamantitipan->Tanggal->Disabled && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["readonly"]) && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_pinjamantitipangrid", "x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Tanggal" class="t06_pinjamantitipan_Tanggal">
<span<?php echo $t06_pinjamantitipan->Tanggal->ViewAttributes() ?>>
<?php echo $t06_pinjamantitipan->Tanggal->ListViewValue() ?></span>
</span>
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t06_pinjamantitipan_grid->PageObjName . "_row_" . $t06_pinjamantitipan_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->id->CurrentValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_id" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_id" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->id->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT || $t06_pinjamantitipan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t06_pinjamantitipan->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t06_pinjamantitipan->Keterangan->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Keterangan" class="form-group t06_pinjamantitipan_Keterangan">
<textarea data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->getPlaceHolder()) ?>"<?php echo $t06_pinjamantitipan->Keterangan->EditAttributes() ?>><?php echo $t06_pinjamantitipan->Keterangan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Keterangan" class="form-group t06_pinjamantitipan_Keterangan">
<textarea data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->getPlaceHolder()) ?>"<?php echo $t06_pinjamantitipan->Keterangan->EditAttributes() ?>><?php echo $t06_pinjamantitipan->Keterangan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Keterangan" class="t06_pinjamantitipan_Keterangan">
<span<?php echo $t06_pinjamantitipan->Keterangan->ViewAttributes() ?>>
<?php echo $t06_pinjamantitipan->Keterangan->ListViewValue() ?></span>
</span>
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Masuk->Visible) { // Masuk ?>
		<td data-name="Masuk"<?php echo $t06_pinjamantitipan->Masuk->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Masuk" class="form-group t06_pinjamantitipan_Masuk">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Masuk->EditValue ?>"<?php echo $t06_pinjamantitipan->Masuk->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Masuk" class="form-group t06_pinjamantitipan_Masuk">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Masuk->EditValue ?>"<?php echo $t06_pinjamantitipan->Masuk->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Masuk" class="t06_pinjamantitipan_Masuk">
<span<?php echo $t06_pinjamantitipan->Masuk->ViewAttributes() ?>>
<?php echo $t06_pinjamantitipan->Masuk->ListViewValue() ?></span>
</span>
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Keluar->Visible) { // Keluar ?>
		<td data-name="Keluar"<?php echo $t06_pinjamantitipan->Keluar->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Keluar" class="form-group t06_pinjamantitipan_Keluar">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Keluar->EditValue ?>"<?php echo $t06_pinjamantitipan->Keluar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Keluar" class="form-group t06_pinjamantitipan_Keluar">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Keluar->EditValue ?>"<?php echo $t06_pinjamantitipan->Keluar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Keluar" class="t06_pinjamantitipan_Keluar">
<span<?php echo $t06_pinjamantitipan->Keluar->ViewAttributes() ?>>
<?php echo $t06_pinjamantitipan->Keluar->ListViewValue() ?></span>
</span>
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Sisa->Visible) { // Sisa ?>
		<td data-name="Sisa"<?php echo $t06_pinjamantitipan->Sisa->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Sisa" class="form-group t06_pinjamantitipan_Sisa">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Sisa->EditValue ?>"<?php echo $t06_pinjamantitipan->Sisa->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Sisa" class="form-group t06_pinjamantitipan_Sisa">
<span<?php echo $t06_pinjamantitipan->Sisa->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Sisa->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_Sisa" class="t06_pinjamantitipan_Sisa">
<span<?php echo $t06_pinjamantitipan->Sisa->ViewAttributes() ?>>
<?php echo $t06_pinjamantitipan->Sisa->ListViewValue() ?></span>
</span>
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $t06_pinjamantitipan->nasabah_id->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t06_pinjamantitipan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<span<?php echo $t06_pinjamantitipan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->nasabah_id->EditValue ?>"<?php echo $t06_pinjamantitipan->nasabah_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t06_pinjamantitipan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<span<?php echo $t06_pinjamantitipan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->nasabah_id->EditValue ?>"<?php echo $t06_pinjamantitipan->nasabah_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_pinjamantitipan_grid->RowCnt ?>_t06_pinjamantitipan_nasabah_id" class="t06_pinjamantitipan_nasabah_id">
<span<?php echo $t06_pinjamantitipan->nasabah_id->ViewAttributes() ?>>
<?php echo $t06_pinjamantitipan->nasabah_id->ListViewValue() ?></span>
</span>
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="ft06_pinjamantitipangrid$x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->FormValue) ?>">
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="ft06_pinjamantitipangrid$o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_pinjamantitipan_grid->ListOptions->Render("body", "right", $t06_pinjamantitipan_grid->RowCnt);
?>
	</tr>
<?php if ($t06_pinjamantitipan->RowType == EW_ROWTYPE_ADD || $t06_pinjamantitipan->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft06_pinjamantitipangrid.UpdateOpts(<?php echo $t06_pinjamantitipan_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t06_pinjamantitipan->CurrentAction <> "gridadd" || $t06_pinjamantitipan->CurrentMode == "copy")
		if (!$t06_pinjamantitipan_grid->Recordset->EOF) $t06_pinjamantitipan_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t06_pinjamantitipan->CurrentMode == "add" || $t06_pinjamantitipan->CurrentMode == "copy" || $t06_pinjamantitipan->CurrentMode == "edit") {
		$t06_pinjamantitipan_grid->RowIndex = '$rowindex$';
		$t06_pinjamantitipan_grid->LoadDefaultValues();

		// Set row properties
		$t06_pinjamantitipan->ResetAttrs();
		$t06_pinjamantitipan->RowAttrs = array_merge($t06_pinjamantitipan->RowAttrs, array('data-rowindex'=>$t06_pinjamantitipan_grid->RowIndex, 'id'=>'r0_t06_pinjamantitipan', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t06_pinjamantitipan->RowAttrs["class"], "ewTemplate");
		$t06_pinjamantitipan->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t06_pinjamantitipan_grid->RenderRow();

		// Render list options
		$t06_pinjamantitipan_grid->RenderListOptions();
		$t06_pinjamantitipan_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t06_pinjamantitipan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_pinjamantitipan_grid->ListOptions->Render("body", "left", $t06_pinjamantitipan_grid->RowIndex);
?>
	<?php if ($t06_pinjamantitipan->Tanggal->Visible) { // Tanggal ?>
		<td data-name="Tanggal">
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Tanggal" class="form-group t06_pinjamantitipan_Tanggal">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Tanggal" data-format="7" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Tanggal->EditValue ?>"<?php echo $t06_pinjamantitipan->Tanggal->EditAttributes() ?>>
<?php if (!$t06_pinjamantitipan->Tanggal->ReadOnly && !$t06_pinjamantitipan->Tanggal->Disabled && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["readonly"]) && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_pinjamantitipangrid", "x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Tanggal" class="form-group t06_pinjamantitipan_Tanggal">
<span<?php echo $t06_pinjamantitipan->Tanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Tanggal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Tanggal" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Keterangan" class="form-group t06_pinjamantitipan_Keterangan">
<textarea data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->getPlaceHolder()) ?>"<?php echo $t06_pinjamantitipan->Keterangan->EditAttributes() ?>><?php echo $t06_pinjamantitipan->Keterangan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Keterangan" class="form-group t06_pinjamantitipan_Keterangan">
<span<?php echo $t06_pinjamantitipan->Keterangan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Keterangan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Masuk->Visible) { // Masuk ?>
		<td data-name="Masuk">
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Masuk" class="form-group t06_pinjamantitipan_Masuk">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Masuk->EditValue ?>"<?php echo $t06_pinjamantitipan->Masuk->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Masuk" class="form-group t06_pinjamantitipan_Masuk">
<span<?php echo $t06_pinjamantitipan->Masuk->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Masuk->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Masuk" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Keluar->Visible) { // Keluar ?>
		<td data-name="Keluar">
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Keluar" class="form-group t06_pinjamantitipan_Keluar">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Keluar->EditValue ?>"<?php echo $t06_pinjamantitipan->Keluar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Keluar" class="form-group t06_pinjamantitipan_Keluar">
<span<?php echo $t06_pinjamantitipan->Keluar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Keluar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Keluar" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->Sisa->Visible) { // Sisa ?>
		<td data-name="Sisa">
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Sisa" class="form-group t06_pinjamantitipan_Sisa">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Sisa->EditValue ?>"<?php echo $t06_pinjamantitipan->Sisa->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_Sisa" class="form-group t06_pinjamantitipan_Sisa">
<span<?php echo $t06_pinjamantitipan->Sisa->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Sisa->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_pinjamantitipan->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id">
<?php if ($t06_pinjamantitipan->CurrentAction <> "F") { ?>
<?php if ($t06_pinjamantitipan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<span<?php echo $t06_pinjamantitipan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->nasabah_id->EditValue ?>"<?php echo $t06_pinjamantitipan->nasabah_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t06_pinjamantitipan_nasabah_id" class="form-group t06_pinjamantitipan_nasabah_id">
<span<?php echo $t06_pinjamantitipan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t06_pinjamantitipan_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_pinjamantitipan_grid->ListOptions->Render("body", "right", $t06_pinjamantitipan_grid->RowCnt);
?>
<script type="text/javascript">
ft06_pinjamantitipangrid.UpdateOpts(<?php echo $t06_pinjamantitipan_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t06_pinjamantitipan->CurrentMode == "add" || $t06_pinjamantitipan->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t06_pinjamantitipan_grid->FormKeyCountName ?>" id="<?php echo $t06_pinjamantitipan_grid->FormKeyCountName ?>" value="<?php echo $t06_pinjamantitipan_grid->KeyCount ?>">
<?php echo $t06_pinjamantitipan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_pinjamantitipan->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t06_pinjamantitipan_grid->FormKeyCountName ?>" id="<?php echo $t06_pinjamantitipan_grid->FormKeyCountName ?>" value="<?php echo $t06_pinjamantitipan_grid->KeyCount ?>">
<?php echo $t06_pinjamantitipan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_pinjamantitipan->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft06_pinjamantitipangrid">
</div>
<?php

// Close recordset
if ($t06_pinjamantitipan_grid->Recordset)
	$t06_pinjamantitipan_grid->Recordset->Close();
?>
<?php if ($t06_pinjamantitipan_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t06_pinjamantitipan_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t06_pinjamantitipan_grid->TotalRecs == 0 && $t06_pinjamantitipan->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_pinjamantitipan_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t06_pinjamantitipan->Export == "") { ?>
<script type="text/javascript">
ft06_pinjamantitipangrid.Init();
</script>
<?php } ?>
<?php
$t06_pinjamantitipan_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t06_pinjamantitipan_grid->Page_Terminate();
?>
