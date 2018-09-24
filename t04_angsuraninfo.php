<?php

// Global variable for table object
$t04_angsuran = NULL;

//
// Table class for t04_angsuran
//
class ct04_angsuran extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $id;
	var $pinjaman_id;
	var $AngsuranKe;
	var $AngsuranTanggal;
	var $AngsuranPokok;
	var $AngsuranBunga;
	var $AngsuranTotal;
	var $SisaHutang;
	var $TanggalBayar;
	var $Terlambat;
	var $TotalDenda;
	var $Bayar_Titipan;
	var $Bayar_Non_Titipan;
	var $Bayar_Total;
	var $Keterangan;
	var $pinjamantitipan_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 't04_angsuran';
		$this->TableName = 't04_angsuran';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t04_angsuran`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('t04_angsuran', 't04_angsuran', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pinjaman_id
		$this->pinjaman_id = new cField('t04_angsuran', 't04_angsuran', 'x_pinjaman_id', 'pinjaman_id', '`pinjaman_id`', '`pinjaman_id`', 3, -1, FALSE, '`pinjaman_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pinjaman_id->Sortable = TRUE; // Allow sort
		$this->pinjaman_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pinjaman_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->pinjaman_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pinjaman_id'] = &$this->pinjaman_id;

		// AngsuranKe
		$this->AngsuranKe = new cField('t04_angsuran', 't04_angsuran', 'x_AngsuranKe', 'AngsuranKe', '`AngsuranKe`', '`AngsuranKe`', 16, -1, FALSE, '`AngsuranKe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranKe->Sortable = TRUE; // Allow sort
		$this->AngsuranKe->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['AngsuranKe'] = &$this->AngsuranKe;

		// AngsuranTanggal
		$this->AngsuranTanggal = new cField('t04_angsuran', 't04_angsuran', 'x_AngsuranTanggal', 'AngsuranTanggal', '`AngsuranTanggal`', ew_CastDateFieldForLike('`AngsuranTanggal`', 7, "DB"), 133, 7, FALSE, '`AngsuranTanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranTanggal->Sortable = TRUE; // Allow sort
		$this->AngsuranTanggal->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['AngsuranTanggal'] = &$this->AngsuranTanggal;

		// AngsuranPokok
		$this->AngsuranPokok = new cField('t04_angsuran', 't04_angsuran', 'x_AngsuranPokok', 'AngsuranPokok', '`AngsuranPokok`', '`AngsuranPokok`', 4, -1, FALSE, '`AngsuranPokok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranPokok->Sortable = TRUE; // Allow sort
		$this->AngsuranPokok->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['AngsuranPokok'] = &$this->AngsuranPokok;

		// AngsuranBunga
		$this->AngsuranBunga = new cField('t04_angsuran', 't04_angsuran', 'x_AngsuranBunga', 'AngsuranBunga', '`AngsuranBunga`', '`AngsuranBunga`', 4, -1, FALSE, '`AngsuranBunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranBunga->Sortable = TRUE; // Allow sort
		$this->AngsuranBunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['AngsuranBunga'] = &$this->AngsuranBunga;

		// AngsuranTotal
		$this->AngsuranTotal = new cField('t04_angsuran', 't04_angsuran', 'x_AngsuranTotal', 'AngsuranTotal', '`AngsuranTotal`', '`AngsuranTotal`', 4, -1, FALSE, '`AngsuranTotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranTotal->Sortable = TRUE; // Allow sort
		$this->AngsuranTotal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['AngsuranTotal'] = &$this->AngsuranTotal;

		// SisaHutang
		$this->SisaHutang = new cField('t04_angsuran', 't04_angsuran', 'x_SisaHutang', 'SisaHutang', '`SisaHutang`', '`SisaHutang`', 4, -1, FALSE, '`SisaHutang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SisaHutang->Sortable = TRUE; // Allow sort
		$this->SisaHutang->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['SisaHutang'] = &$this->SisaHutang;

		// TanggalBayar
		$this->TanggalBayar = new cField('t04_angsuran', 't04_angsuran', 'x_TanggalBayar', 'TanggalBayar', '`TanggalBayar`', ew_CastDateFieldForLike('`TanggalBayar`', 7, "DB"), 133, 7, FALSE, '`TanggalBayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TanggalBayar->Sortable = TRUE; // Allow sort
		$this->TanggalBayar->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['TanggalBayar'] = &$this->TanggalBayar;

		// Terlambat
		$this->Terlambat = new cField('t04_angsuran', 't04_angsuran', 'x_Terlambat', 'Terlambat', '`Terlambat`', '`Terlambat`', 2, -1, FALSE, '`Terlambat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Terlambat->Sortable = TRUE; // Allow sort
		$this->Terlambat->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Terlambat'] = &$this->Terlambat;

		// TotalDenda
		$this->TotalDenda = new cField('t04_angsuran', 't04_angsuran', 'x_TotalDenda', 'TotalDenda', '`TotalDenda`', '`TotalDenda`', 4, -1, FALSE, '`TotalDenda`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TotalDenda->Sortable = TRUE; // Allow sort
		$this->TotalDenda->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['TotalDenda'] = &$this->TotalDenda;

		// Bayar_Titipan
		$this->Bayar_Titipan = new cField('t04_angsuran', 't04_angsuran', 'x_Bayar_Titipan', 'Bayar_Titipan', '`Bayar_Titipan`', '`Bayar_Titipan`', 4, -1, FALSE, '`Bayar_Titipan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bayar_Titipan->Sortable = TRUE; // Allow sort
		$this->Bayar_Titipan->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Bayar_Titipan'] = &$this->Bayar_Titipan;

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan = new cField('t04_angsuran', 't04_angsuran', 'x_Bayar_Non_Titipan', 'Bayar_Non_Titipan', '`Bayar_Non_Titipan`', '`Bayar_Non_Titipan`', 4, -1, FALSE, '`Bayar_Non_Titipan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bayar_Non_Titipan->Sortable = TRUE; // Allow sort
		$this->Bayar_Non_Titipan->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Bayar_Non_Titipan'] = &$this->Bayar_Non_Titipan;

		// Bayar_Total
		$this->Bayar_Total = new cField('t04_angsuran', 't04_angsuran', 'x_Bayar_Total', 'Bayar_Total', '`Bayar_Total`', '`Bayar_Total`', 4, -1, FALSE, '`Bayar_Total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bayar_Total->Sortable = TRUE; // Allow sort
		$this->Bayar_Total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Bayar_Total'] = &$this->Bayar_Total;

		// Keterangan
		$this->Keterangan = new cField('t04_angsuran', 't04_angsuran', 'x_Keterangan', 'Keterangan', '`Keterangan`', '`Keterangan`', 201, -1, FALSE, '`Keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Keterangan->Sortable = TRUE; // Allow sort
		$this->fields['Keterangan'] = &$this->Keterangan;

		// pinjamantitipan_id
		$this->pinjamantitipan_id = new cField('t04_angsuran', 't04_angsuran', 'x_pinjamantitipan_id', 'pinjamantitipan_id', '`pinjamantitipan_id`', '`pinjamantitipan_id`', 3, -1, FALSE, '`pinjamantitipan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pinjamantitipan_id->Sortable = TRUE; // Allow sort
		$this->pinjamantitipan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pinjamantitipan_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->pinjamantitipan_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pinjamantitipan_id'] = &$this->pinjamantitipan_id;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "t03_pinjaman") {
			if ($this->pinjaman_id->getSessionValue() <> "")
				$sMasterFilter .= "`id`=" . ew_QuotedValue($this->pinjaman_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "t03_pinjaman") {
			if ($this->pinjaman_id->getSessionValue() <> "")
				$sDetailFilter .= "`pinjaman_id`=" . ew_QuotedValue($this->pinjaman_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_t03_pinjaman() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_t03_pinjaman() {
		return "`pinjaman_id`=@pinjaman_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t04_angsuran`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->WriteAuditTrailOnAdd($rs);
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		if ($bUpdate && $this->AuditTrailOnEdit) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit)) $rsaudit[$fldname] = $rsold[$fldname];
			$this->WriteAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		if ($bDelete && $this->AuditTrailOnDelete)
			$this->WriteAuditTrailOnDelete($rs);
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "t04_angsuranlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "t04_angsuranlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t04_angsuranview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t04_angsuranview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "t04_angsuranadd.php?" . $this->UrlParm($parm);
		else
			$url = "t04_angsuranadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("t04_angsuranedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("t04_angsuranadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("t04_angsurandelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "t03_pinjaman" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->pinjaman_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = ew_StripSlashes($_POST["id"]);
			elseif (isset($_GET["id"]))
				$arKeys[] = ew_StripSlashes($_GET["id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
		$this->AngsuranKe->setDbValue($rs->fields('AngsuranKe'));
		$this->AngsuranTanggal->setDbValue($rs->fields('AngsuranTanggal'));
		$this->AngsuranPokok->setDbValue($rs->fields('AngsuranPokok'));
		$this->AngsuranBunga->setDbValue($rs->fields('AngsuranBunga'));
		$this->AngsuranTotal->setDbValue($rs->fields('AngsuranTotal'));
		$this->SisaHutang->setDbValue($rs->fields('SisaHutang'));
		$this->TanggalBayar->setDbValue($rs->fields('TanggalBayar'));
		$this->Terlambat->setDbValue($rs->fields('Terlambat'));
		$this->TotalDenda->setDbValue($rs->fields('TotalDenda'));
		$this->Bayar_Titipan->setDbValue($rs->fields('Bayar_Titipan'));
		$this->Bayar_Non_Titipan->setDbValue($rs->fields('Bayar_Non_Titipan'));
		$this->Bayar_Total->setDbValue($rs->fields('Bayar_Total'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->pinjamantitipan_id->setDbValue($rs->fields('pinjamantitipan_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id
		// pinjaman_id
		// AngsuranKe
		// AngsuranTanggal

		$this->AngsuranTanggal->CellCssStyle = "white-space: nowrap;";

		// AngsuranPokok
		// AngsuranBunga
		// AngsuranTotal
		// SisaHutang
		// TanggalBayar
		// Terlambat
		// TotalDenda
		// Bayar_Titipan
		// Bayar_Non_Titipan
		// Bayar_Total
		// Keterangan
		// pinjamantitipan_id
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pinjaman_id
		$this->pinjaman_id->ViewCustomAttributes = "";

		// AngsuranKe
		$this->AngsuranKe->ViewValue = $this->AngsuranKe->CurrentValue;
		$this->AngsuranKe->ViewCustomAttributes = "";

		// AngsuranTanggal
		$this->AngsuranTanggal->ViewValue = $this->AngsuranTanggal->CurrentValue;
		$this->AngsuranTanggal->ViewValue = ew_FormatDateTime($this->AngsuranTanggal->ViewValue, 7);
		$this->AngsuranTanggal->ViewCustomAttributes = "";

		// AngsuranPokok
		$this->AngsuranPokok->ViewValue = $this->AngsuranPokok->CurrentValue;
		$this->AngsuranPokok->ViewValue = ew_FormatNumber($this->AngsuranPokok->ViewValue, 2, -2, -2, -2);
		$this->AngsuranPokok->CellCssStyle .= "text-align: right;";
		$this->AngsuranPokok->ViewCustomAttributes = "";

		// AngsuranBunga
		$this->AngsuranBunga->ViewValue = $this->AngsuranBunga->CurrentValue;
		$this->AngsuranBunga->ViewValue = ew_FormatNumber($this->AngsuranBunga->ViewValue, 2, -2, -2, -2);
		$this->AngsuranBunga->CellCssStyle .= "text-align: right;";
		$this->AngsuranBunga->ViewCustomAttributes = "";

		// AngsuranTotal
		$this->AngsuranTotal->ViewValue = $this->AngsuranTotal->CurrentValue;
		$this->AngsuranTotal->ViewValue = ew_FormatNumber($this->AngsuranTotal->ViewValue, 2, -2, -2, -2);
		$this->AngsuranTotal->CellCssStyle .= "text-align: right;";
		$this->AngsuranTotal->ViewCustomAttributes = "";

		// SisaHutang
		$this->SisaHutang->ViewValue = $this->SisaHutang->CurrentValue;
		$this->SisaHutang->ViewValue = ew_FormatNumber($this->SisaHutang->ViewValue, 2, -2, -2, -2);
		$this->SisaHutang->CellCssStyle .= "text-align: right;";
		$this->SisaHutang->ViewCustomAttributes = "";

		// TanggalBayar
		$this->TanggalBayar->ViewValue = $this->TanggalBayar->CurrentValue;
		$this->TanggalBayar->ViewValue = ew_FormatDateTime($this->TanggalBayar->ViewValue, 7);
		$this->TanggalBayar->ViewCustomAttributes = "";

		// Terlambat
		$this->Terlambat->ViewValue = $this->Terlambat->CurrentValue;
		$this->Terlambat->ViewCustomAttributes = "";

		// TotalDenda
		$this->TotalDenda->ViewValue = $this->TotalDenda->CurrentValue;
		$this->TotalDenda->ViewValue = ew_FormatNumber($this->TotalDenda->ViewValue, 2, -2, -2, -2);
		$this->TotalDenda->CellCssStyle .= "text-align: right;";
		$this->TotalDenda->ViewCustomAttributes = "";

		// Bayar_Titipan
		$this->Bayar_Titipan->ViewValue = $this->Bayar_Titipan->CurrentValue;
		$this->Bayar_Titipan->ViewValue = ew_FormatNumber($this->Bayar_Titipan->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Titipan->CellCssStyle .= "text-align: right;";
		$this->Bayar_Titipan->ViewCustomAttributes = "";

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->ViewValue = $this->Bayar_Non_Titipan->CurrentValue;
		$this->Bayar_Non_Titipan->ViewValue = ew_FormatNumber($this->Bayar_Non_Titipan->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Non_Titipan->CellCssStyle .= "text-align: right;";
		$this->Bayar_Non_Titipan->ViewCustomAttributes = "";

		// Bayar_Total
		$this->Bayar_Total->ViewValue = $this->Bayar_Total->CurrentValue;
		$this->Bayar_Total->ViewValue = ew_FormatNumber($this->Bayar_Total->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Total->CellCssStyle .= "text-align: right;";
		$this->Bayar_Total->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// pinjamantitipan_id
		if (strval($this->pinjamantitipan_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->pinjamantitipan_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `sisa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v01_pinjamantitipan`";
		$sWhereWrk = "";
		$this->pinjamantitipan_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pinjamantitipan_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pinjamantitipan_id->ViewValue = $this->pinjamantitipan_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pinjamantitipan_id->ViewValue = $this->pinjamantitipan_id->CurrentValue;
			}
		} else {
			$this->pinjamantitipan_id->ViewValue = NULL;
		}
		$this->pinjamantitipan_id->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pinjaman_id
		$this->pinjaman_id->LinkCustomAttributes = "";
		$this->pinjaman_id->HrefValue = "";
		$this->pinjaman_id->TooltipValue = "";

		// AngsuranKe
		$this->AngsuranKe->LinkCustomAttributes = "";
		$this->AngsuranKe->HrefValue = "";
		$this->AngsuranKe->TooltipValue = "";

		// AngsuranTanggal
		$this->AngsuranTanggal->LinkCustomAttributes = "";
		$this->AngsuranTanggal->HrefValue = "";
		$this->AngsuranTanggal->TooltipValue = "";

		// AngsuranPokok
		$this->AngsuranPokok->LinkCustomAttributes = "";
		$this->AngsuranPokok->HrefValue = "";
		$this->AngsuranPokok->TooltipValue = "";

		// AngsuranBunga
		$this->AngsuranBunga->LinkCustomAttributes = "";
		$this->AngsuranBunga->HrefValue = "";
		$this->AngsuranBunga->TooltipValue = "";

		// AngsuranTotal
		$this->AngsuranTotal->LinkCustomAttributes = "";
		$this->AngsuranTotal->HrefValue = "";
		$this->AngsuranTotal->TooltipValue = "";

		// SisaHutang
		$this->SisaHutang->LinkCustomAttributes = "";
		$this->SisaHutang->HrefValue = "";
		$this->SisaHutang->TooltipValue = "";

		// TanggalBayar
		$this->TanggalBayar->LinkCustomAttributes = "";
		$this->TanggalBayar->HrefValue = "";
		$this->TanggalBayar->TooltipValue = "";

		// Terlambat
		$this->Terlambat->LinkCustomAttributes = "";
		$this->Terlambat->HrefValue = "";
		$this->Terlambat->TooltipValue = "";

		// TotalDenda
		$this->TotalDenda->LinkCustomAttributes = "";
		$this->TotalDenda->HrefValue = "";
		$this->TotalDenda->TooltipValue = "";

		// Bayar_Titipan
		$this->Bayar_Titipan->LinkCustomAttributes = "";
		$this->Bayar_Titipan->HrefValue = "";
		$this->Bayar_Titipan->TooltipValue = "";

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->LinkCustomAttributes = "";
		$this->Bayar_Non_Titipan->HrefValue = "";
		$this->Bayar_Non_Titipan->TooltipValue = "";

		// Bayar_Total
		$this->Bayar_Total->LinkCustomAttributes = "";
		$this->Bayar_Total->HrefValue = "";
		$this->Bayar_Total->TooltipValue = "";

		// Keterangan
		$this->Keterangan->LinkCustomAttributes = "";
		$this->Keterangan->HrefValue = "";
		$this->Keterangan->TooltipValue = "";

		// pinjamantitipan_id
		$this->pinjamantitipan_id->LinkCustomAttributes = "";
		$this->pinjamantitipan_id->HrefValue = "";
		$this->pinjamantitipan_id->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pinjaman_id
		$this->pinjaman_id->EditAttrs["class"] = "form-control";
		$this->pinjaman_id->EditCustomAttributes = "";
		if ($this->pinjaman_id->getSessionValue() <> "") {
			$this->pinjaman_id->CurrentValue = $this->pinjaman_id->getSessionValue();
		$this->pinjaman_id->ViewCustomAttributes = "";
		} else {
		}

		// AngsuranKe
		$this->AngsuranKe->EditAttrs["class"] = "form-control";
		$this->AngsuranKe->EditCustomAttributes = "";
		$this->AngsuranKe->EditValue = $this->AngsuranKe->CurrentValue;
		$this->AngsuranKe->ViewCustomAttributes = "";

		// AngsuranTanggal
		$this->AngsuranTanggal->EditAttrs["class"] = "form-control";
		$this->AngsuranTanggal->EditCustomAttributes = "";
		$this->AngsuranTanggal->EditValue = $this->AngsuranTanggal->CurrentValue;
		$this->AngsuranTanggal->EditValue = ew_FormatDateTime($this->AngsuranTanggal->EditValue, 7);
		$this->AngsuranTanggal->ViewCustomAttributes = "";

		// AngsuranPokok
		$this->AngsuranPokok->EditAttrs["class"] = "form-control";
		$this->AngsuranPokok->EditCustomAttributes = "";
		$this->AngsuranPokok->EditValue = $this->AngsuranPokok->CurrentValue;
		$this->AngsuranPokok->EditValue = ew_FormatNumber($this->AngsuranPokok->EditValue, 2, -2, -2, -2);
		$this->AngsuranPokok->CellCssStyle .= "text-align: right;";
		$this->AngsuranPokok->ViewCustomAttributes = "";

		// AngsuranBunga
		$this->AngsuranBunga->EditAttrs["class"] = "form-control";
		$this->AngsuranBunga->EditCustomAttributes = "";
		$this->AngsuranBunga->EditValue = $this->AngsuranBunga->CurrentValue;
		$this->AngsuranBunga->EditValue = ew_FormatNumber($this->AngsuranBunga->EditValue, 2, -2, -2, -2);
		$this->AngsuranBunga->CellCssStyle .= "text-align: right;";
		$this->AngsuranBunga->ViewCustomAttributes = "";

		// AngsuranTotal
		$this->AngsuranTotal->EditAttrs["class"] = "form-control";
		$this->AngsuranTotal->EditCustomAttributes = "";
		$this->AngsuranTotal->EditValue = $this->AngsuranTotal->CurrentValue;
		$this->AngsuranTotal->EditValue = ew_FormatNumber($this->AngsuranTotal->EditValue, 2, -2, -2, -2);
		$this->AngsuranTotal->CellCssStyle .= "text-align: right;";
		$this->AngsuranTotal->ViewCustomAttributes = "";

		// SisaHutang
		$this->SisaHutang->EditAttrs["class"] = "form-control";
		$this->SisaHutang->EditCustomAttributes = "";
		$this->SisaHutang->EditValue = $this->SisaHutang->CurrentValue;
		$this->SisaHutang->EditValue = ew_FormatNumber($this->SisaHutang->EditValue, 2, -2, -2, -2);
		$this->SisaHutang->CellCssStyle .= "text-align: right;";
		$this->SisaHutang->ViewCustomAttributes = "";

		// TanggalBayar
		$this->TanggalBayar->EditAttrs["class"] = "form-control";
		$this->TanggalBayar->EditCustomAttributes = "style='width: 115px;'";
		$this->TanggalBayar->EditValue = ew_FormatDateTime($this->TanggalBayar->CurrentValue, 7);
		$this->TanggalBayar->PlaceHolder = ew_RemoveHtml($this->TanggalBayar->FldCaption());

		// Terlambat
		$this->Terlambat->EditAttrs["class"] = "form-control";
		$this->Terlambat->EditCustomAttributes = "";
		$this->Terlambat->EditValue = $this->Terlambat->CurrentValue;
		$this->Terlambat->PlaceHolder = ew_RemoveHtml($this->Terlambat->FldCaption());

		// TotalDenda
		$this->TotalDenda->EditAttrs["class"] = "form-control";
		$this->TotalDenda->EditCustomAttributes = "";
		$this->TotalDenda->EditValue = $this->TotalDenda->CurrentValue;
		$this->TotalDenda->PlaceHolder = ew_RemoveHtml($this->TotalDenda->FldCaption());
		if (strval($this->TotalDenda->EditValue) <> "" && is_numeric($this->TotalDenda->EditValue)) $this->TotalDenda->EditValue = ew_FormatNumber($this->TotalDenda->EditValue, -2, -2, -2, -2);

		// Bayar_Titipan
		$this->Bayar_Titipan->EditAttrs["class"] = "form-control";
		$this->Bayar_Titipan->EditCustomAttributes = "";
		$this->Bayar_Titipan->EditValue = $this->Bayar_Titipan->CurrentValue;
		$this->Bayar_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Titipan->FldCaption());
		if (strval($this->Bayar_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Titipan->EditValue)) $this->Bayar_Titipan->EditValue = ew_FormatNumber($this->Bayar_Titipan->EditValue, -2, -2, -2, -2);

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->EditAttrs["class"] = "form-control";
		$this->Bayar_Non_Titipan->EditCustomAttributes = "";
		$this->Bayar_Non_Titipan->EditValue = $this->Bayar_Non_Titipan->CurrentValue;
		$this->Bayar_Non_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Non_Titipan->FldCaption());
		if (strval($this->Bayar_Non_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Non_Titipan->EditValue)) $this->Bayar_Non_Titipan->EditValue = ew_FormatNumber($this->Bayar_Non_Titipan->EditValue, -2, -2, -2, -2);

		// Bayar_Total
		$this->Bayar_Total->EditAttrs["class"] = "form-control";
		$this->Bayar_Total->EditCustomAttributes = "";
		$this->Bayar_Total->EditValue = $this->Bayar_Total->CurrentValue;
		$this->Bayar_Total->PlaceHolder = ew_RemoveHtml($this->Bayar_Total->FldCaption());
		if (strval($this->Bayar_Total->EditValue) <> "" && is_numeric($this->Bayar_Total->EditValue)) $this->Bayar_Total->EditValue = ew_FormatNumber($this->Bayar_Total->EditValue, -2, -2, -2, -2);

		// Keterangan
		$this->Keterangan->EditAttrs["class"] = "form-control";
		$this->Keterangan->EditCustomAttributes = "";
		$this->Keterangan->EditValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

		// pinjamantitipan_id
		$this->pinjamantitipan_id->EditAttrs["class"] = "form-control";
		$this->pinjamantitipan_id->EditCustomAttributes = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->pinjaman_id->Exportable) $Doc->ExportCaption($this->pinjaman_id);
					if ($this->AngsuranKe->Exportable) $Doc->ExportCaption($this->AngsuranKe);
					if ($this->AngsuranTanggal->Exportable) $Doc->ExportCaption($this->AngsuranTanggal);
					if ($this->AngsuranPokok->Exportable) $Doc->ExportCaption($this->AngsuranPokok);
					if ($this->AngsuranBunga->Exportable) $Doc->ExportCaption($this->AngsuranBunga);
					if ($this->AngsuranTotal->Exportable) $Doc->ExportCaption($this->AngsuranTotal);
					if ($this->SisaHutang->Exportable) $Doc->ExportCaption($this->SisaHutang);
					if ($this->TanggalBayar->Exportable) $Doc->ExportCaption($this->TanggalBayar);
					if ($this->Terlambat->Exportable) $Doc->ExportCaption($this->Terlambat);
					if ($this->TotalDenda->Exportable) $Doc->ExportCaption($this->TotalDenda);
					if ($this->Bayar_Titipan->Exportable) $Doc->ExportCaption($this->Bayar_Titipan);
					if ($this->Bayar_Non_Titipan->Exportable) $Doc->ExportCaption($this->Bayar_Non_Titipan);
					if ($this->Bayar_Total->Exportable) $Doc->ExportCaption($this->Bayar_Total);
					if ($this->Keterangan->Exportable) $Doc->ExportCaption($this->Keterangan);
					if ($this->pinjamantitipan_id->Exportable) $Doc->ExportCaption($this->pinjamantitipan_id);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->pinjaman_id->Exportable) $Doc->ExportCaption($this->pinjaman_id);
					if ($this->AngsuranKe->Exportable) $Doc->ExportCaption($this->AngsuranKe);
					if ($this->AngsuranTanggal->Exportable) $Doc->ExportCaption($this->AngsuranTanggal);
					if ($this->AngsuranPokok->Exportable) $Doc->ExportCaption($this->AngsuranPokok);
					if ($this->AngsuranBunga->Exportable) $Doc->ExportCaption($this->AngsuranBunga);
					if ($this->AngsuranTotal->Exportable) $Doc->ExportCaption($this->AngsuranTotal);
					if ($this->SisaHutang->Exportable) $Doc->ExportCaption($this->SisaHutang);
					if ($this->TanggalBayar->Exportable) $Doc->ExportCaption($this->TanggalBayar);
					if ($this->Terlambat->Exportable) $Doc->ExportCaption($this->Terlambat);
					if ($this->TotalDenda->Exportable) $Doc->ExportCaption($this->TotalDenda);
					if ($this->Bayar_Titipan->Exportable) $Doc->ExportCaption($this->Bayar_Titipan);
					if ($this->Bayar_Non_Titipan->Exportable) $Doc->ExportCaption($this->Bayar_Non_Titipan);
					if ($this->Bayar_Total->Exportable) $Doc->ExportCaption($this->Bayar_Total);
					if ($this->Keterangan->Exportable) $Doc->ExportCaption($this->Keterangan);
					if ($this->pinjamantitipan_id->Exportable) $Doc->ExportCaption($this->pinjamantitipan_id);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->pinjaman_id->Exportable) $Doc->ExportField($this->pinjaman_id);
						if ($this->AngsuranKe->Exportable) $Doc->ExportField($this->AngsuranKe);
						if ($this->AngsuranTanggal->Exportable) $Doc->ExportField($this->AngsuranTanggal);
						if ($this->AngsuranPokok->Exportable) $Doc->ExportField($this->AngsuranPokok);
						if ($this->AngsuranBunga->Exportable) $Doc->ExportField($this->AngsuranBunga);
						if ($this->AngsuranTotal->Exportable) $Doc->ExportField($this->AngsuranTotal);
						if ($this->SisaHutang->Exportable) $Doc->ExportField($this->SisaHutang);
						if ($this->TanggalBayar->Exportable) $Doc->ExportField($this->TanggalBayar);
						if ($this->Terlambat->Exportable) $Doc->ExportField($this->Terlambat);
						if ($this->TotalDenda->Exportable) $Doc->ExportField($this->TotalDenda);
						if ($this->Bayar_Titipan->Exportable) $Doc->ExportField($this->Bayar_Titipan);
						if ($this->Bayar_Non_Titipan->Exportable) $Doc->ExportField($this->Bayar_Non_Titipan);
						if ($this->Bayar_Total->Exportable) $Doc->ExportField($this->Bayar_Total);
						if ($this->Keterangan->Exportable) $Doc->ExportField($this->Keterangan);
						if ($this->pinjamantitipan_id->Exportable) $Doc->ExportField($this->pinjamantitipan_id);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->pinjaman_id->Exportable) $Doc->ExportField($this->pinjaman_id);
						if ($this->AngsuranKe->Exportable) $Doc->ExportField($this->AngsuranKe);
						if ($this->AngsuranTanggal->Exportable) $Doc->ExportField($this->AngsuranTanggal);
						if ($this->AngsuranPokok->Exportable) $Doc->ExportField($this->AngsuranPokok);
						if ($this->AngsuranBunga->Exportable) $Doc->ExportField($this->AngsuranBunga);
						if ($this->AngsuranTotal->Exportable) $Doc->ExportField($this->AngsuranTotal);
						if ($this->SisaHutang->Exportable) $Doc->ExportField($this->SisaHutang);
						if ($this->TanggalBayar->Exportable) $Doc->ExportField($this->TanggalBayar);
						if ($this->Terlambat->Exportable) $Doc->ExportField($this->Terlambat);
						if ($this->TotalDenda->Exportable) $Doc->ExportField($this->TotalDenda);
						if ($this->Bayar_Titipan->Exportable) $Doc->ExportField($this->Bayar_Titipan);
						if ($this->Bayar_Non_Titipan->Exportable) $Doc->ExportField($this->Bayar_Non_Titipan);
						if ($this->Bayar_Total->Exportable) $Doc->ExportField($this->Bayar_Total);
						if ($this->Keterangan->Exportable) $Doc->ExportField($this->Keterangan);
						if ($this->pinjamantitipan_id->Exportable) $Doc->ExportField($this->pinjamantitipan_id);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 't04_angsuran';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 't04_angsuran';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$newvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 't04_angsuran';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnDelete) return;
		$table = 't04_angsuran';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$oldvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
