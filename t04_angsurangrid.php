<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t04_angsuran_grid)) $t04_angsuran_grid = new ct04_angsuran_grid();

// Page init
$t04_angsuran_grid->Page_Init();

// Page main
$t04_angsuran_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t04_angsuran_grid->Page_Render();
?>
<?php if ($t04_angsuran->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft04_angsurangrid = new ew_Form("ft04_angsurangrid", "grid");
ft04_angsurangrid.FormKeyCountName = '<?php echo $t04_angsuran_grid->FormKeyCountName ?>';

// Validate form
ft04_angsurangrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_pinjaman_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->pinjaman_id->FldCaption(), $t04_angsuran->pinjaman_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_pinjaman_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->pinjaman_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranKe");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->AngsuranKe->FldCaption(), $t04_angsuran->AngsuranKe->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranTanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->AngsuranTanggal->FldCaption(), $t04_angsuran->AngsuranTanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranPokok");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->AngsuranPokok->FldCaption(), $t04_angsuran->AngsuranPokok->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranBunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->AngsuranBunga->FldCaption(), $t04_angsuran->AngsuranBunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranTotal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->AngsuranTotal->FldCaption(), $t04_angsuran->AngsuranTotal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_SisaHutang");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->SisaHutang->FldCaption(), $t04_angsuran->SisaHutang->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TanggalBayar");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->TanggalBayar->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_TotalDenda");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->TotalDenda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Terlambat");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->Terlambat->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft04_angsurangrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "pinjaman_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "AngsuranKe", false)) return false;
	if (ew_ValueChanged(fobj, infix, "AngsuranTanggal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "AngsuranPokok", false)) return false;
	if (ew_ValueChanged(fobj, infix, "AngsuranBunga", false)) return false;
	if (ew_ValueChanged(fobj, infix, "AngsuranTotal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "SisaHutang", false)) return false;
	if (ew_ValueChanged(fobj, infix, "TanggalBayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "TotalDenda", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Terlambat", false)) return false;
	return true;
}

// Form_CustomValidate event
ft04_angsurangrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft04_angsurangrid.ValidateRequired = true;
<?php } else { ?>
ft04_angsurangrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t04_angsuran->CurrentAction == "gridadd") {
	if ($t04_angsuran->CurrentMode == "copy") {
		$bSelectLimit = $t04_angsuran_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t04_angsuran_grid->TotalRecs = $t04_angsuran->SelectRecordCount();
			$t04_angsuran_grid->Recordset = $t04_angsuran_grid->LoadRecordset($t04_angsuran_grid->StartRec-1, $t04_angsuran_grid->DisplayRecs);
		} else {
			if ($t04_angsuran_grid->Recordset = $t04_angsuran_grid->LoadRecordset())
				$t04_angsuran_grid->TotalRecs = $t04_angsuran_grid->Recordset->RecordCount();
		}
		$t04_angsuran_grid->StartRec = 1;
		$t04_angsuran_grid->DisplayRecs = $t04_angsuran_grid->TotalRecs;
	} else {
		$t04_angsuran->CurrentFilter = "0=1";
		$t04_angsuran_grid->StartRec = 1;
		$t04_angsuran_grid->DisplayRecs = $t04_angsuran->GridAddRowCount;
	}
	$t04_angsuran_grid->TotalRecs = $t04_angsuran_grid->DisplayRecs;
	$t04_angsuran_grid->StopRec = $t04_angsuran_grid->DisplayRecs;
} else {
	$bSelectLimit = $t04_angsuran_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t04_angsuran_grid->TotalRecs <= 0)
			$t04_angsuran_grid->TotalRecs = $t04_angsuran->SelectRecordCount();
	} else {
		if (!$t04_angsuran_grid->Recordset && ($t04_angsuran_grid->Recordset = $t04_angsuran_grid->LoadRecordset()))
			$t04_angsuran_grid->TotalRecs = $t04_angsuran_grid->Recordset->RecordCount();
	}
	$t04_angsuran_grid->StartRec = 1;
	$t04_angsuran_grid->DisplayRecs = $t04_angsuran_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t04_angsuran_grid->Recordset = $t04_angsuran_grid->LoadRecordset($t04_angsuran_grid->StartRec-1, $t04_angsuran_grid->DisplayRecs);

	// Set no record found message
	if ($t04_angsuran->CurrentAction == "" && $t04_angsuran_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t04_angsuran_grid->setWarningMessage(ew_DeniedMsg());
		if ($t04_angsuran_grid->SearchWhere == "0=101")
			$t04_angsuran_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t04_angsuran_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t04_angsuran_grid->RenderOtherOptions();
?>
<?php $t04_angsuran_grid->ShowPageHeader(); ?>
<?php
$t04_angsuran_grid->ShowMessage();
?>
<?php if ($t04_angsuran_grid->TotalRecs > 0 || $t04_angsuran->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t04_angsuran">
<div id="ft04_angsurangrid" class="ewForm form-inline">
<?php if ($t04_angsuran_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t04_angsuran_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t04_angsuran" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t04_angsurangrid" class="table ewTable">
<?php echo $t04_angsuran->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t04_angsuran_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t04_angsuran_grid->RenderListOptions();

// Render list options (header, left)
$t04_angsuran_grid->ListOptions->Render("header", "left");
?>
<?php if ($t04_angsuran->pinjaman_id->Visible) { // pinjaman_id ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->pinjaman_id) == "") { ?>
		<th data-name="pinjaman_id"><div id="elh_t04_angsuran_pinjaman_id" class="t04_angsuran_pinjaman_id"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->pinjaman_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pinjaman_id"><div><div id="elh_t04_angsuran_pinjaman_id" class="t04_angsuran_pinjaman_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->pinjaman_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->pinjaman_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->pinjaman_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranKe->Visible) { // AngsuranKe ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranKe) == "") { ?>
		<th data-name="AngsuranKe"><div id="elh_t04_angsuran_AngsuranKe" class="t04_angsuran_AngsuranKe"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranKe->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranKe"><div><div id="elh_t04_angsuran_AngsuranKe" class="t04_angsuran_AngsuranKe">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranKe->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranKe->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranKe->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranTanggal->Visible) { // AngsuranTanggal ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranTanggal) == "") { ?>
		<th data-name="AngsuranTanggal"><div id="elh_t04_angsuran_AngsuranTanggal" class="t04_angsuran_AngsuranTanggal"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranTanggal"><div><div id="elh_t04_angsuran_AngsuranTanggal" class="t04_angsuran_AngsuranTanggal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranTanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranTanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranPokok->Visible) { // AngsuranPokok ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranPokok) == "") { ?>
		<th data-name="AngsuranPokok"><div id="elh_t04_angsuran_AngsuranPokok" class="t04_angsuran_AngsuranPokok"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranPokok->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranPokok"><div><div id="elh_t04_angsuran_AngsuranPokok" class="t04_angsuran_AngsuranPokok">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranPokok->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranPokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranPokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranBunga->Visible) { // AngsuranBunga ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranBunga) == "") { ?>
		<th data-name="AngsuranBunga"><div id="elh_t04_angsuran_AngsuranBunga" class="t04_angsuran_AngsuranBunga"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranBunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranBunga"><div><div id="elh_t04_angsuran_AngsuranBunga" class="t04_angsuran_AngsuranBunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranBunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranBunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranBunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranTotal->Visible) { // AngsuranTotal ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranTotal) == "") { ?>
		<th data-name="AngsuranTotal"><div id="elh_t04_angsuran_AngsuranTotal" class="t04_angsuran_AngsuranTotal"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTotal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranTotal"><div><div id="elh_t04_angsuran_AngsuranTotal" class="t04_angsuran_AngsuranTotal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTotal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranTotal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranTotal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->SisaHutang->Visible) { // SisaHutang ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->SisaHutang) == "") { ?>
		<th data-name="SisaHutang"><div id="elh_t04_angsuran_SisaHutang" class="t04_angsuran_SisaHutang"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->SisaHutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SisaHutang"><div><div id="elh_t04_angsuran_SisaHutang" class="t04_angsuran_SisaHutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->SisaHutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->SisaHutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->SisaHutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->TanggalBayar->Visible) { // TanggalBayar ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->TanggalBayar) == "") { ?>
		<th data-name="TanggalBayar"><div id="elh_t04_angsuran_TanggalBayar" class="t04_angsuran_TanggalBayar"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->TanggalBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TanggalBayar"><div><div id="elh_t04_angsuran_TanggalBayar" class="t04_angsuran_TanggalBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->TanggalBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->TanggalBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->TanggalBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->TotalDenda->Visible) { // TotalDenda ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->TotalDenda) == "") { ?>
		<th data-name="TotalDenda"><div id="elh_t04_angsuran_TotalDenda" class="t04_angsuran_TotalDenda"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->TotalDenda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDenda"><div><div id="elh_t04_angsuran_TotalDenda" class="t04_angsuran_TotalDenda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->TotalDenda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->TotalDenda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->TotalDenda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->Terlambat->Visible) { // Terlambat ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->Terlambat) == "") { ?>
		<th data-name="Terlambat"><div id="elh_t04_angsuran_Terlambat" class="t04_angsuran_Terlambat"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->Terlambat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terlambat"><div><div id="elh_t04_angsuran_Terlambat" class="t04_angsuran_Terlambat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->Terlambat->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->Terlambat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->Terlambat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t04_angsuran_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t04_angsuran_grid->StartRec = 1;
$t04_angsuran_grid->StopRec = $t04_angsuran_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t04_angsuran_grid->FormKeyCountName) && ($t04_angsuran->CurrentAction == "gridadd" || $t04_angsuran->CurrentAction == "gridedit" || $t04_angsuran->CurrentAction == "F")) {
		$t04_angsuran_grid->KeyCount = $objForm->GetValue($t04_angsuran_grid->FormKeyCountName);
		$t04_angsuran_grid->StopRec = $t04_angsuran_grid->StartRec + $t04_angsuran_grid->KeyCount - 1;
	}
}
$t04_angsuran_grid->RecCnt = $t04_angsuran_grid->StartRec - 1;
if ($t04_angsuran_grid->Recordset && !$t04_angsuran_grid->Recordset->EOF) {
	$t04_angsuran_grid->Recordset->MoveFirst();
	$bSelectLimit = $t04_angsuran_grid->UseSelectLimit;
	if (!$bSelectLimit && $t04_angsuran_grid->StartRec > 1)
		$t04_angsuran_grid->Recordset->Move($t04_angsuran_grid->StartRec - 1);
} elseif (!$t04_angsuran->AllowAddDeleteRow && $t04_angsuran_grid->StopRec == 0) {
	$t04_angsuran_grid->StopRec = $t04_angsuran->GridAddRowCount;
}

// Initialize aggregate
$t04_angsuran->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t04_angsuran->ResetAttrs();
$t04_angsuran_grid->RenderRow();
if ($t04_angsuran->CurrentAction == "gridadd")
	$t04_angsuran_grid->RowIndex = 0;
if ($t04_angsuran->CurrentAction == "gridedit")
	$t04_angsuran_grid->RowIndex = 0;
while ($t04_angsuran_grid->RecCnt < $t04_angsuran_grid->StopRec) {
	$t04_angsuran_grid->RecCnt++;
	if (intval($t04_angsuran_grid->RecCnt) >= intval($t04_angsuran_grid->StartRec)) {
		$t04_angsuran_grid->RowCnt++;
		if ($t04_angsuran->CurrentAction == "gridadd" || $t04_angsuran->CurrentAction == "gridedit" || $t04_angsuran->CurrentAction == "F") {
			$t04_angsuran_grid->RowIndex++;
			$objForm->Index = $t04_angsuran_grid->RowIndex;
			if ($objForm->HasValue($t04_angsuran_grid->FormActionName))
				$t04_angsuran_grid->RowAction = strval($objForm->GetValue($t04_angsuran_grid->FormActionName));
			elseif ($t04_angsuran->CurrentAction == "gridadd")
				$t04_angsuran_grid->RowAction = "insert";
			else
				$t04_angsuran_grid->RowAction = "";
		}

		// Set up key count
		$t04_angsuran_grid->KeyCount = $t04_angsuran_grid->RowIndex;

		// Init row class and style
		$t04_angsuran->ResetAttrs();
		$t04_angsuran->CssClass = "";
		if ($t04_angsuran->CurrentAction == "gridadd") {
			if ($t04_angsuran->CurrentMode == "copy") {
				$t04_angsuran_grid->LoadRowValues($t04_angsuran_grid->Recordset); // Load row values
				$t04_angsuran_grid->SetRecordKey($t04_angsuran_grid->RowOldKey, $t04_angsuran_grid->Recordset); // Set old record key
			} else {
				$t04_angsuran_grid->LoadDefaultValues(); // Load default values
				$t04_angsuran_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t04_angsuran_grid->LoadRowValues($t04_angsuran_grid->Recordset); // Load row values
		}
		$t04_angsuran->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t04_angsuran->CurrentAction == "gridadd") // Grid add
			$t04_angsuran->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t04_angsuran->CurrentAction == "gridadd" && $t04_angsuran->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t04_angsuran_grid->RestoreCurrentRowFormValues($t04_angsuran_grid->RowIndex); // Restore form values
		if ($t04_angsuran->CurrentAction == "gridedit") { // Grid edit
			if ($t04_angsuran->EventCancelled) {
				$t04_angsuran_grid->RestoreCurrentRowFormValues($t04_angsuran_grid->RowIndex); // Restore form values
			}
			if ($t04_angsuran_grid->RowAction == "insert")
				$t04_angsuran->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t04_angsuran->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t04_angsuran->CurrentAction == "gridedit" && ($t04_angsuran->RowType == EW_ROWTYPE_EDIT || $t04_angsuran->RowType == EW_ROWTYPE_ADD) && $t04_angsuran->EventCancelled) // Update failed
			$t04_angsuran_grid->RestoreCurrentRowFormValues($t04_angsuran_grid->RowIndex); // Restore form values
		if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t04_angsuran_grid->EditRowCnt++;
		if ($t04_angsuran->CurrentAction == "F") // Confirm row
			$t04_angsuran_grid->RestoreCurrentRowFormValues($t04_angsuran_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t04_angsuran->RowAttrs = array_merge($t04_angsuran->RowAttrs, array('data-rowindex'=>$t04_angsuran_grid->RowCnt, 'id'=>'r' . $t04_angsuran_grid->RowCnt . '_t04_angsuran', 'data-rowtype'=>$t04_angsuran->RowType));

		// Render row
		$t04_angsuran_grid->RenderRow();

		// Render list options
		$t04_angsuran_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t04_angsuran_grid->RowAction <> "delete" && $t04_angsuran_grid->RowAction <> "insertdelete" && !($t04_angsuran_grid->RowAction == "insert" && $t04_angsuran->CurrentAction == "F" && $t04_angsuran_grid->EmptyRow())) {
?>
	<tr<?php echo $t04_angsuran->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_angsuran_grid->ListOptions->Render("body", "left", $t04_angsuran_grid->RowCnt);
?>
	<?php if ($t04_angsuran->pinjaman_id->Visible) { // pinjaman_id ?>
		<td data-name="pinjaman_id"<?php echo $t04_angsuran->pinjaman_id->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t04_angsuran->pinjaman_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<input type="text" data-table="t04_angsuran" data-field="x_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->pinjaman_id->EditValue ?>"<?php echo $t04_angsuran->pinjaman_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t04_angsuran->pinjaman_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<input type="text" data-table="t04_angsuran" data-field="x_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->pinjaman_id->EditValue ?>"<?php echo $t04_angsuran->pinjaman_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_pinjaman_id" class="t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<?php echo $t04_angsuran->pinjaman_id->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t04_angsuran_grid->PageObjName . "_row_" . $t04_angsuran_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_angsuran->id->CurrentValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_id" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_id" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_angsuran->id->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT || $t04_angsuran->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_angsuran->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t04_angsuran->AngsuranKe->Visible) { // AngsuranKe ?>
		<td data-name="AngsuranKe"<?php echo $t04_angsuran->AngsuranKe->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranKe->EditValue ?>"<?php echo $t04_angsuran->AngsuranKe->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<span<?php echo $t04_angsuran->AngsuranKe->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranKe->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranKe" class="t04_angsuran_AngsuranKe">
<span<?php echo $t04_angsuran->AngsuranKe->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranKe->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTanggal->Visible) { // AngsuranTanggal ?>
		<td data-name="AngsuranTanggal"<?php echo $t04_angsuran->AngsuranTanggal->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTanggal" data-format="7" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTanggal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTanggal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<span<?php echo $t04_angsuran->AngsuranTanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranTanggal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranTanggal" class="t04_angsuran_AngsuranTanggal">
<span<?php echo $t04_angsuran->AngsuranTanggal->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranTanggal->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranPokok->Visible) { // AngsuranPokok ?>
		<td data-name="AngsuranPokok"<?php echo $t04_angsuran->AngsuranPokok->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranPokok->EditValue ?>"<?php echo $t04_angsuran->AngsuranPokok->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<span<?php echo $t04_angsuran->AngsuranPokok->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranPokok->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranPokok" class="t04_angsuran_AngsuranPokok">
<span<?php echo $t04_angsuran->AngsuranPokok->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranPokok->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranBunga->Visible) { // AngsuranBunga ?>
		<td data-name="AngsuranBunga"<?php echo $t04_angsuran->AngsuranBunga->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranBunga->EditValue ?>"<?php echo $t04_angsuran->AngsuranBunga->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<span<?php echo $t04_angsuran->AngsuranBunga->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranBunga->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranBunga" class="t04_angsuran_AngsuranBunga">
<span<?php echo $t04_angsuran->AngsuranBunga->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranBunga->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTotal->Visible) { // AngsuranTotal ?>
		<td data-name="AngsuranTotal"<?php echo $t04_angsuran->AngsuranTotal->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTotal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTotal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<span<?php echo $t04_angsuran->AngsuranTotal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranTotal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_AngsuranTotal" class="t04_angsuran_AngsuranTotal">
<span<?php echo $t04_angsuran->AngsuranTotal->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranTotal->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->SisaHutang->Visible) { // SisaHutang ?>
		<td data-name="SisaHutang"<?php echo $t04_angsuran->SisaHutang->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<input type="text" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->SisaHutang->EditValue ?>"<?php echo $t04_angsuran->SisaHutang->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<span<?php echo $t04_angsuran->SisaHutang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->SisaHutang->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_SisaHutang" class="t04_angsuran_SisaHutang">
<span<?php echo $t04_angsuran->SisaHutang->ViewAttributes() ?>>
<?php echo $t04_angsuran->SisaHutang->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TanggalBayar->Visible) { // TanggalBayar ?>
		<td data-name="TanggalBayar"<?php echo $t04_angsuran->TanggalBayar->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<input type="text" data-table="t04_angsuran" data-field="x_TanggalBayar" data-format="7" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TanggalBayar->EditValue ?>"<?php echo $t04_angsuran->TanggalBayar->EditAttributes() ?>>
<?php if (!$t04_angsuran->TanggalBayar->ReadOnly && !$t04_angsuran->TanggalBayar->Disabled && !isset($t04_angsuran->TanggalBayar->EditAttrs["readonly"]) && !isset($t04_angsuran->TanggalBayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_angsurangrid", "x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<input type="text" data-table="t04_angsuran" data-field="x_TanggalBayar" data-format="7" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TanggalBayar->EditValue ?>"<?php echo $t04_angsuran->TanggalBayar->EditAttributes() ?>>
<?php if (!$t04_angsuran->TanggalBayar->ReadOnly && !$t04_angsuran->TanggalBayar->Disabled && !isset($t04_angsuran->TanggalBayar->EditAttrs["readonly"]) && !isset($t04_angsuran->TanggalBayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_angsurangrid", "x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_TanggalBayar" class="t04_angsuran_TanggalBayar">
<span<?php echo $t04_angsuran->TanggalBayar->ViewAttributes() ?>>
<?php echo $t04_angsuran->TanggalBayar->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TotalDenda->Visible) { // TotalDenda ?>
		<td data-name="TotalDenda"<?php echo $t04_angsuran->TotalDenda->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<input type="text" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TotalDenda->EditValue ?>"<?php echo $t04_angsuran->TotalDenda->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<input type="text" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TotalDenda->EditValue ?>"<?php echo $t04_angsuran->TotalDenda->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_TotalDenda" class="t04_angsuran_TotalDenda">
<span<?php echo $t04_angsuran->TotalDenda->ViewAttributes() ?>>
<?php echo $t04_angsuran->TotalDenda->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat"<?php echo $t04_angsuran->Terlambat->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<input type="text" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Terlambat->EditValue ?>"<?php echo $t04_angsuran->Terlambat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<input type="text" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Terlambat->EditValue ?>"<?php echo $t04_angsuran->Terlambat->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_grid->RowCnt ?>_t04_angsuran_Terlambat" class="t04_angsuran_Terlambat">
<span<?php echo $t04_angsuran->Terlambat->ViewAttributes() ?>>
<?php echo $t04_angsuran->Terlambat->ListViewValue() ?></span>
</span>
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="ft04_angsurangrid$x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->FormValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="ft04_angsurangrid$o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_angsuran_grid->ListOptions->Render("body", "right", $t04_angsuran_grid->RowCnt);
?>
	</tr>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD || $t04_angsuran->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft04_angsurangrid.UpdateOpts(<?php echo $t04_angsuran_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t04_angsuran->CurrentAction <> "gridadd" || $t04_angsuran->CurrentMode == "copy")
		if (!$t04_angsuran_grid->Recordset->EOF) $t04_angsuran_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t04_angsuran->CurrentMode == "add" || $t04_angsuran->CurrentMode == "copy" || $t04_angsuran->CurrentMode == "edit") {
		$t04_angsuran_grid->RowIndex = '$rowindex$';
		$t04_angsuran_grid->LoadDefaultValues();

		// Set row properties
		$t04_angsuran->ResetAttrs();
		$t04_angsuran->RowAttrs = array_merge($t04_angsuran->RowAttrs, array('data-rowindex'=>$t04_angsuran_grid->RowIndex, 'id'=>'r0_t04_angsuran', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t04_angsuran->RowAttrs["class"], "ewTemplate");
		$t04_angsuran->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t04_angsuran_grid->RenderRow();

		// Render list options
		$t04_angsuran_grid->RenderListOptions();
		$t04_angsuran_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t04_angsuran->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_angsuran_grid->ListOptions->Render("body", "left", $t04_angsuran_grid->RowIndex);
?>
	<?php if ($t04_angsuran->pinjaman_id->Visible) { // pinjaman_id ?>
		<td data-name="pinjaman_id">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<?php if ($t04_angsuran->pinjaman_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<input type="text" data-table="t04_angsuran" data-field="x_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->pinjaman_id->EditValue ?>"<?php echo $t04_angsuran->pinjaman_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranKe->Visible) { // AngsuranKe ?>
		<td data-name="AngsuranKe">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranKe->EditValue ?>"<?php echo $t04_angsuran->AngsuranKe->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<span<?php echo $t04_angsuran->AngsuranKe->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranKe->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTanggal->Visible) { // AngsuranTanggal ?>
		<td data-name="AngsuranTanggal">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTanggal" data-format="7" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTanggal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTanggal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<span<?php echo $t04_angsuran->AngsuranTanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranTanggal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranPokok->Visible) { // AngsuranPokok ?>
		<td data-name="AngsuranPokok">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranPokok->EditValue ?>"<?php echo $t04_angsuran->AngsuranPokok->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<span<?php echo $t04_angsuran->AngsuranPokok->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranPokok->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranBunga->Visible) { // AngsuranBunga ?>
		<td data-name="AngsuranBunga">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranBunga->EditValue ?>"<?php echo $t04_angsuran->AngsuranBunga->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<span<?php echo $t04_angsuran->AngsuranBunga->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranBunga->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTotal->Visible) { // AngsuranTotal ?>
		<td data-name="AngsuranTotal">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTotal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTotal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<span<?php echo $t04_angsuran->AngsuranTotal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranTotal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->SisaHutang->Visible) { // SisaHutang ?>
		<td data-name="SisaHutang">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<input type="text" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->SisaHutang->EditValue ?>"<?php echo $t04_angsuran->SisaHutang->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<span<?php echo $t04_angsuran->SisaHutang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->SisaHutang->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TanggalBayar->Visible) { // TanggalBayar ?>
		<td data-name="TanggalBayar">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<input type="text" data-table="t04_angsuran" data-field="x_TanggalBayar" data-format="7" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TanggalBayar->EditValue ?>"<?php echo $t04_angsuran->TanggalBayar->EditAttributes() ?>>
<?php if (!$t04_angsuran->TanggalBayar->ReadOnly && !$t04_angsuran->TanggalBayar->Disabled && !isset($t04_angsuran->TanggalBayar->EditAttrs["readonly"]) && !isset($t04_angsuran->TanggalBayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_angsurangrid", "x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar", 7);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<span<?php echo $t04_angsuran->TanggalBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->TanggalBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TotalDenda->Visible) { // TotalDenda ?>
		<td data-name="TotalDenda">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<input type="text" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TotalDenda->EditValue ?>"<?php echo $t04_angsuran->TotalDenda->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<span<?php echo $t04_angsuran->TotalDenda->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->TotalDenda->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat">
<?php if ($t04_angsuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<input type="text" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Terlambat->EditValue ?>"<?php echo $t04_angsuran->Terlambat->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<span<?php echo $t04_angsuran->Terlambat->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->Terlambat->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" id="o<?php echo $t04_angsuran_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_angsuran_grid->ListOptions->Render("body", "right", $t04_angsuran_grid->RowCnt);
?>
<script type="text/javascript">
ft04_angsurangrid.UpdateOpts(<?php echo $t04_angsuran_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t04_angsuran->CurrentMode == "add" || $t04_angsuran->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t04_angsuran_grid->FormKeyCountName ?>" id="<?php echo $t04_angsuran_grid->FormKeyCountName ?>" value="<?php echo $t04_angsuran_grid->KeyCount ?>">
<?php echo $t04_angsuran_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t04_angsuran->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t04_angsuran_grid->FormKeyCountName ?>" id="<?php echo $t04_angsuran_grid->FormKeyCountName ?>" value="<?php echo $t04_angsuran_grid->KeyCount ?>">
<?php echo $t04_angsuran_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t04_angsuran->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft04_angsurangrid">
</div>
<?php

// Close recordset
if ($t04_angsuran_grid->Recordset)
	$t04_angsuran_grid->Recordset->Close();
?>
<?php if ($t04_angsuran_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t04_angsuran_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t04_angsuran_grid->TotalRecs == 0 && $t04_angsuran->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_angsuran_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t04_angsuran->Export == "") { ?>
<script type="text/javascript">
ft04_angsurangrid.Init();
</script>
<?php } ?>
<?php
$t04_angsuran_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t04_angsuran_grid->Page_Terminate();
?>
