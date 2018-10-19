<?php

// Global variable for table object
$t03_pinjaman = NULL;

//
// Table class for t03_pinjaman
//
class ct03_pinjaman extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $id;
	var $NoKontrak;
	var $TglKontrak;
	var $nasabah_id;
	var $Pinjaman;
	var $LamaAngsuran;
	var $Bunga;
	var $Denda;
	var $DispensasiDenda;
	var $AngsuranPokok;
	var $AngsuranBunga;
	var $AngsuranTotal;
	var $NoKontrakRefTo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 't03_pinjaman';
		$this->TableName = 't03_pinjaman';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t03_pinjaman`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('t03_pinjaman', 't03_pinjaman', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// NoKontrak
		$this->NoKontrak = new cField('t03_pinjaman', 't03_pinjaman', 'x_NoKontrak', 'NoKontrak', '`NoKontrak`', '`NoKontrak`', 200, -1, FALSE, '`NoKontrak`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NoKontrak->Sortable = TRUE; // Allow sort
		$this->fields['NoKontrak'] = &$this->NoKontrak;

		// TglKontrak
		$this->TglKontrak = new cField('t03_pinjaman', 't03_pinjaman', 'x_TglKontrak', 'TglKontrak', '`TglKontrak`', ew_CastDateFieldForLike('`TglKontrak`', 7, "DB"), 133, 7, FALSE, '`TglKontrak`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TglKontrak->Sortable = TRUE; // Allow sort
		$this->TglKontrak->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['TglKontrak'] = &$this->TglKontrak;

		// nasabah_id
		$this->nasabah_id = new cField('t03_pinjaman', 't03_pinjaman', 'x_nasabah_id', 'nasabah_id', '`nasabah_id`', '`nasabah_id`', 3, -1, FALSE, '`EV__nasabah_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->nasabah_id->Sortable = TRUE; // Allow sort
		$this->nasabah_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nasabah_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->nasabah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['nasabah_id'] = &$this->nasabah_id;

		// Pinjaman
		$this->Pinjaman = new cField('t03_pinjaman', 't03_pinjaman', 'x_Pinjaman', 'Pinjaman', '`Pinjaman`', '`Pinjaman`', 4, -1, FALSE, '`Pinjaman`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Pinjaman->Sortable = TRUE; // Allow sort
		$this->Pinjaman->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Pinjaman'] = &$this->Pinjaman;

		// LamaAngsuran
		$this->LamaAngsuran = new cField('t03_pinjaman', 't03_pinjaman', 'x_LamaAngsuran', 'LamaAngsuran', '`LamaAngsuran`', '`LamaAngsuran`', 16, -1, FALSE, '`LamaAngsuran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LamaAngsuran->Sortable = TRUE; // Allow sort
		$this->LamaAngsuran->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['LamaAngsuran'] = &$this->LamaAngsuran;

		// Bunga
		$this->Bunga = new cField('t03_pinjaman', 't03_pinjaman', 'x_Bunga', 'Bunga', '`Bunga`', '`Bunga`', 131, -1, FALSE, '`Bunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bunga->Sortable = TRUE; // Allow sort
		$this->Bunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Bunga'] = &$this->Bunga;

		// Denda
		$this->Denda = new cField('t03_pinjaman', 't03_pinjaman', 'x_Denda', 'Denda', '`Denda`', '`Denda`', 131, -1, FALSE, '`Denda`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Denda->Sortable = TRUE; // Allow sort
		$this->Denda->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Denda'] = &$this->Denda;

		// DispensasiDenda
		$this->DispensasiDenda = new cField('t03_pinjaman', 't03_pinjaman', 'x_DispensasiDenda', 'DispensasiDenda', '`DispensasiDenda`', '`DispensasiDenda`', 16, -1, FALSE, '`DispensasiDenda`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DispensasiDenda->Sortable = TRUE; // Allow sort
		$this->DispensasiDenda->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['DispensasiDenda'] = &$this->DispensasiDenda;

		// AngsuranPokok
		$this->AngsuranPokok = new cField('t03_pinjaman', 't03_pinjaman', 'x_AngsuranPokok', 'AngsuranPokok', '`AngsuranPokok`', '`AngsuranPokok`', 4, -1, FALSE, '`AngsuranPokok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranPokok->Sortable = TRUE; // Allow sort
		$this->AngsuranPokok->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['AngsuranPokok'] = &$this->AngsuranPokok;

		// AngsuranBunga
		$this->AngsuranBunga = new cField('t03_pinjaman', 't03_pinjaman', 'x_AngsuranBunga', 'AngsuranBunga', '`AngsuranBunga`', '`AngsuranBunga`', 4, -1, FALSE, '`AngsuranBunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranBunga->Sortable = TRUE; // Allow sort
		$this->AngsuranBunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['AngsuranBunga'] = &$this->AngsuranBunga;

		// AngsuranTotal
		$this->AngsuranTotal = new cField('t03_pinjaman', 't03_pinjaman', 'x_AngsuranTotal', 'AngsuranTotal', '`AngsuranTotal`', '`AngsuranTotal`', 4, -1, FALSE, '`AngsuranTotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AngsuranTotal->Sortable = TRUE; // Allow sort
		$this->AngsuranTotal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['AngsuranTotal'] = &$this->AngsuranTotal;

		// NoKontrakRefTo
		$this->NoKontrakRefTo = new cField('t03_pinjaman', 't03_pinjaman', 'x_NoKontrakRefTo', 'NoKontrakRefTo', '`NoKontrakRefTo`', '`NoKontrakRefTo`', 200, -1, FALSE, '`NoKontrakRefTo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NoKontrakRefTo->Sortable = TRUE; // Allow sort
		$this->NoKontrakRefTo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['NoKontrakRefTo'] = &$this->NoKontrakRefTo;
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
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			if ($ctrl) {
				$sOrderByList = $this->getSessionOrderByList();
				if (strpos($sOrderByList, $sSortFieldList . " " . $sLastSort) !== FALSE) {
					$sOrderByList = str_replace($sSortFieldList . " " . $sLastSort, $sSortFieldList . " " . $sThisSort, $sOrderByList);
				} else {
					if ($sOrderByList <> "") $sOrderByList .= ", ";
					$sOrderByList .= $sSortFieldList . " " . $sThisSort;
				}
				$this->setSessionOrderByList($sOrderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "t04_angsuran") {
			$sDetailUrl = $GLOBALS["t04_angsuran"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t05_pinjamanjaminan") {
			$sDetailUrl = $GLOBALS["t05_pinjamanjaminan"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t06_pinjamantitipan") {
			$sDetailUrl = $GLOBALS["t06_pinjamantitipan"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
			$sDetailUrl .= "&fk_nasabah_id=" . urlencode($this->nasabah_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "t03_pinjamanlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t03_pinjaman`";
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
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT CONCAT(`Customer`,'" . ew_ValueSeparator(1, $this->nasabah_id) . "',`Pekerjaan`) FROM `t01_nasabah` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`id` = `t03_pinjaman`.`nasabah_id` LIMIT 1) AS `EV__nasabah_id` FROM `t03_pinjaman`" .
			") `EW_TMP_TABLE`";
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
		return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
		$this->_SqlSelectList = $v;
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
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->nasabah_id->AdvancedSearch->SearchValue <> "" ||
			$this->nasabah_id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->nasabah_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->nasabah_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
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

		// Cascade Update detail table 't04_angsuran'
		$bCascadeUpdate = FALSE;
		$rscascade = array();
		if (!is_null($rsold) && (isset($rs['id']) && $rsold['id'] <> $rs['id'])) { // Update detail field 'pinjaman_id'
			$bCascadeUpdate = TRUE;
			$rscascade['pinjaman_id'] = $rs['id']; 
		}
		if ($bCascadeUpdate) {
			if (!isset($GLOBALS["t04_angsuran"])) $GLOBALS["t04_angsuran"] = new ct04_angsuran();
			$rswrk = $GLOBALS["t04_angsuran"]->LoadRs("`pinjaman_id` = " . ew_QuotedValue($rsold['id'], EW_DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$bUpdate = $GLOBALS["t04_angsuran"]->Update($rscascade, $rskey, $rswrk->fields);
				if (!$bUpdate) return FALSE;
				$rswrk->MoveNext();
			}
		}

		// Cascade Update detail table 't05_pinjamanjaminan'
		$bCascadeUpdate = FALSE;
		$rscascade = array();
		if (!is_null($rsold) && (isset($rs['id']) && $rsold['id'] <> $rs['id'])) { // Update detail field 'pinjaman_id'
			$bCascadeUpdate = TRUE;
			$rscascade['pinjaman_id'] = $rs['id']; 
		}
		if ($bCascadeUpdate) {
			if (!isset($GLOBALS["t05_pinjamanjaminan"])) $GLOBALS["t05_pinjamanjaminan"] = new ct05_pinjamanjaminan();
			$rswrk = $GLOBALS["t05_pinjamanjaminan"]->LoadRs("`pinjaman_id` = " . ew_QuotedValue($rsold['id'], EW_DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$bUpdate = $GLOBALS["t05_pinjamanjaminan"]->Update($rscascade, $rskey, $rswrk->fields);
				if (!$bUpdate) return FALSE;
				$rswrk->MoveNext();
			}
		}

		// Cascade Update detail table 't06_pinjamantitipan'
		$bCascadeUpdate = FALSE;
		$rscascade = array();
		if (!is_null($rsold) && (isset($rs['id']) && $rsold['id'] <> $rs['id'])) { // Update detail field 'pinjaman_id'
			$bCascadeUpdate = TRUE;
			$rscascade['pinjaman_id'] = $rs['id']; 
		}
		if (!is_null($rsold) && (isset($rs['nasabah_id']) && $rsold['nasabah_id'] <> $rs['nasabah_id'])) { // Update detail field 'nasabah_id'
			$bCascadeUpdate = TRUE;
			$rscascade['nasabah_id'] = $rs['nasabah_id']; 
		}
		if ($bCascadeUpdate) {
			if (!isset($GLOBALS["t06_pinjamantitipan"])) $GLOBALS["t06_pinjamantitipan"] = new ct06_pinjamantitipan();
			$rswrk = $GLOBALS["t06_pinjamantitipan"]->LoadRs("`pinjaman_id` = " . ew_QuotedValue($rsold['id'], EW_DATATYPE_NUMBER, 'DB') . " AND " . "`nasabah_id` = " . ew_QuotedValue($rsold['nasabah_id'], EW_DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$bUpdate = $GLOBALS["t06_pinjamantitipan"]->Update($rscascade, $rskey, $rswrk->fields);
				if (!$bUpdate) return FALSE;
				$rswrk->MoveNext();
			}
		}
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

		// Cascade delete detail table 't04_angsuran'
		if (!isset($GLOBALS["t04_angsuran"])) $GLOBALS["t04_angsuran"] = new ct04_angsuran();
		$rscascade = $GLOBALS["t04_angsuran"]->LoadRs("`pinjaman_id` = " . ew_QuotedValue($rs['id'], EW_DATATYPE_NUMBER, "DB")); 
		while ($rscascade && !$rscascade->EOF) {
			$GLOBALS["t04_angsuran"]->Delete($rscascade->fields);
			$rscascade->MoveNext();
		}

		// Cascade delete detail table 't05_pinjamanjaminan'
		if (!isset($GLOBALS["t05_pinjamanjaminan"])) $GLOBALS["t05_pinjamanjaminan"] = new ct05_pinjamanjaminan();
		$rscascade = $GLOBALS["t05_pinjamanjaminan"]->LoadRs("`pinjaman_id` = " . ew_QuotedValue($rs['id'], EW_DATATYPE_NUMBER, "DB")); 
		while ($rscascade && !$rscascade->EOF) {
			$GLOBALS["t05_pinjamanjaminan"]->Delete($rscascade->fields);
			$rscascade->MoveNext();
		}

		// Cascade delete detail table 't06_pinjamantitipan'
		if (!isset($GLOBALS["t06_pinjamantitipan"])) $GLOBALS["t06_pinjamantitipan"] = new ct06_pinjamantitipan();
		$rscascade = $GLOBALS["t06_pinjamantitipan"]->LoadRs("`pinjaman_id` = " . ew_QuotedValue($rs['id'], EW_DATATYPE_NUMBER, "DB") . " AND " . "`nasabah_id` = " . ew_QuotedValue($rs['nasabah_id'], EW_DATATYPE_NUMBER, "DB")); 
		while ($rscascade && !$rscascade->EOF) {
			$GLOBALS["t06_pinjamantitipan"]->Delete($rscascade->fields);
			$rscascade->MoveNext();
		}
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
			return "t03_pinjamanlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "t03_pinjamanlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t03_pinjamanview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t03_pinjamanview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "t03_pinjamanadd.php?" . $this->UrlParm($parm);
		else
			$url = "t03_pinjamanadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t03_pinjamanedit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t03_pinjamanedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t03_pinjamanadd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t03_pinjamanadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("t03_pinjamandelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
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
		$this->NoKontrak->setDbValue($rs->fields('NoKontrak'));
		$this->TglKontrak->setDbValue($rs->fields('TglKontrak'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->Pinjaman->setDbValue($rs->fields('Pinjaman'));
		$this->LamaAngsuran->setDbValue($rs->fields('LamaAngsuran'));
		$this->Bunga->setDbValue($rs->fields('Bunga'));
		$this->Denda->setDbValue($rs->fields('Denda'));
		$this->DispensasiDenda->setDbValue($rs->fields('DispensasiDenda'));
		$this->AngsuranPokok->setDbValue($rs->fields('AngsuranPokok'));
		$this->AngsuranBunga->setDbValue($rs->fields('AngsuranBunga'));
		$this->AngsuranTotal->setDbValue($rs->fields('AngsuranTotal'));
		$this->NoKontrakRefTo->setDbValue($rs->fields('NoKontrakRefTo'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id
		// NoKontrak
		// TglKontrak
		// nasabah_id
		// Pinjaman
		// LamaAngsuran
		// Bunga
		// Denda
		// DispensasiDenda
		// AngsuranPokok
		// AngsuranBunga
		// AngsuranTotal
		// NoKontrakRefTo
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// NoKontrak
		$this->NoKontrak->ViewValue = $this->NoKontrak->CurrentValue;
		$this->NoKontrak->ViewCustomAttributes = "";

		// TglKontrak
		$this->TglKontrak->ViewValue = $this->TglKontrak->CurrentValue;
		$this->TglKontrak->ViewValue = ew_FormatDateTime($this->TglKontrak->ViewValue, 7);
		$this->TglKontrak->ViewCustomAttributes = "";

		// nasabah_id
		if ($this->nasabah_id->VirtualValue <> "") {
			$this->nasabah_id->ViewValue = $this->nasabah_id->VirtualValue;
		} else {
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Customer` AS `DispFld`, `Pekerjaan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
		$sWhereWrk = "";
		$this->nasabah_id->LookupFilters = array("dx1" => '`Customer`', "dx2" => '`Pekerjaan`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Customer` ASC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->nasabah_id->ViewValue = $this->nasabah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
			}
		} else {
			$this->nasabah_id->ViewValue = NULL;
		}
		}
		$this->nasabah_id->ViewCustomAttributes = "";

		// Pinjaman
		$this->Pinjaman->ViewValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->ViewValue = ew_FormatNumber($this->Pinjaman->ViewValue, 2, -2, -2, -2);
		$this->Pinjaman->CellCssStyle .= "text-align: right;";
		$this->Pinjaman->ViewCustomAttributes = "";

		// LamaAngsuran
		$this->LamaAngsuran->ViewValue = $this->LamaAngsuran->CurrentValue;
		$this->LamaAngsuran->ViewValue = ew_FormatNumber($this->LamaAngsuran->ViewValue, 0, -2, -2, -2);
		$this->LamaAngsuran->CellCssStyle .= "text-align: right;";
		$this->LamaAngsuran->ViewCustomAttributes = "";

		// Bunga
		$this->Bunga->ViewValue = $this->Bunga->CurrentValue;
		$this->Bunga->ViewValue = ew_FormatNumber($this->Bunga->ViewValue, 2, -2, -2, -2);
		$this->Bunga->CellCssStyle .= "text-align: right;";
		$this->Bunga->ViewCustomAttributes = "";

		// Denda
		$this->Denda->ViewValue = $this->Denda->CurrentValue;
		$this->Denda->ViewValue = ew_FormatNumber($this->Denda->ViewValue, 2, -2, -2, -2);
		$this->Denda->CellCssStyle .= "text-align: right;";
		$this->Denda->ViewCustomAttributes = "";

		// DispensasiDenda
		$this->DispensasiDenda->ViewValue = $this->DispensasiDenda->CurrentValue;
		$this->DispensasiDenda->ViewValue = ew_FormatNumber($this->DispensasiDenda->ViewValue, 0, -2, -2, -2);
		$this->DispensasiDenda->CellCssStyle .= "text-align: right;";
		$this->DispensasiDenda->ViewCustomAttributes = "";

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

		// NoKontrakRefTo
		$this->NoKontrakRefTo->ViewValue = $this->NoKontrakRefTo->CurrentValue;
		$this->NoKontrakRefTo->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// NoKontrak
		$this->NoKontrak->LinkCustomAttributes = "";
		$this->NoKontrak->HrefValue = "";
		$this->NoKontrak->TooltipValue = "";

		// TglKontrak
		$this->TglKontrak->LinkCustomAttributes = "";
		$this->TglKontrak->HrefValue = "";
		$this->TglKontrak->TooltipValue = "";

		// nasabah_id
		$this->nasabah_id->LinkCustomAttributes = "";
		$this->nasabah_id->HrefValue = "";
		$this->nasabah_id->TooltipValue = "";

		// Pinjaman
		$this->Pinjaman->LinkCustomAttributes = "";
		$this->Pinjaman->HrefValue = "";
		$this->Pinjaman->TooltipValue = "";

		// LamaAngsuran
		$this->LamaAngsuran->LinkCustomAttributes = "";
		$this->LamaAngsuran->HrefValue = "";
		$this->LamaAngsuran->TooltipValue = "";

		// Bunga
		$this->Bunga->LinkCustomAttributes = "";
		$this->Bunga->HrefValue = "";
		$this->Bunga->TooltipValue = "";

		// Denda
		$this->Denda->LinkCustomAttributes = "";
		$this->Denda->HrefValue = "";
		$this->Denda->TooltipValue = "";

		// DispensasiDenda
		$this->DispensasiDenda->LinkCustomAttributes = "";
		$this->DispensasiDenda->HrefValue = "";
		$this->DispensasiDenda->TooltipValue = "";

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

		// NoKontrakRefTo
		$this->NoKontrakRefTo->LinkCustomAttributes = "";
		$this->NoKontrakRefTo->HrefValue = "";
		$this->NoKontrakRefTo->TooltipValue = "";

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

		// NoKontrak
		$this->NoKontrak->EditAttrs["class"] = "form-control";
		$this->NoKontrak->EditCustomAttributes = "";
		$this->NoKontrak->EditValue = $this->NoKontrak->CurrentValue;
		$this->NoKontrak->PlaceHolder = ew_RemoveHtml($this->NoKontrak->FldCaption());

		// TglKontrak
		$this->TglKontrak->EditAttrs["class"] = "form-control";
		$this->TglKontrak->EditCustomAttributes = "";
		$this->TglKontrak->EditValue = ew_FormatDateTime($this->TglKontrak->CurrentValue, 7);
		$this->TglKontrak->PlaceHolder = ew_RemoveHtml($this->TglKontrak->FldCaption());

		// nasabah_id
		$this->nasabah_id->EditAttrs["class"] = "form-control";
		$this->nasabah_id->EditCustomAttributes = "";

		// Pinjaman
		$this->Pinjaman->EditAttrs["class"] = "form-control";
		$this->Pinjaman->EditCustomAttributes = "";
		$this->Pinjaman->EditValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->PlaceHolder = ew_RemoveHtml($this->Pinjaman->FldCaption());
		if (strval($this->Pinjaman->EditValue) <> "" && is_numeric($this->Pinjaman->EditValue)) $this->Pinjaman->EditValue = ew_FormatNumber($this->Pinjaman->EditValue, -2, -2, -2, -2);

		// LamaAngsuran
		$this->LamaAngsuran->EditAttrs["class"] = "form-control";
		$this->LamaAngsuran->EditCustomAttributes = "";
		$this->LamaAngsuran->EditValue = $this->LamaAngsuran->CurrentValue;
		$this->LamaAngsuran->PlaceHolder = ew_RemoveHtml($this->LamaAngsuran->FldCaption());

		// Bunga
		$this->Bunga->EditAttrs["class"] = "form-control";
		$this->Bunga->EditCustomAttributes = "";
		$this->Bunga->EditValue = $this->Bunga->CurrentValue;
		$this->Bunga->PlaceHolder = ew_RemoveHtml($this->Bunga->FldCaption());
		if (strval($this->Bunga->EditValue) <> "" && is_numeric($this->Bunga->EditValue)) $this->Bunga->EditValue = ew_FormatNumber($this->Bunga->EditValue, -2, -2, -2, -2);

		// Denda
		$this->Denda->EditAttrs["class"] = "form-control";
		$this->Denda->EditCustomAttributes = "";
		$this->Denda->EditValue = $this->Denda->CurrentValue;
		$this->Denda->PlaceHolder = ew_RemoveHtml($this->Denda->FldCaption());
		if (strval($this->Denda->EditValue) <> "" && is_numeric($this->Denda->EditValue)) $this->Denda->EditValue = ew_FormatNumber($this->Denda->EditValue, -2, -2, -2, -2);

		// DispensasiDenda
		$this->DispensasiDenda->EditAttrs["class"] = "form-control";
		$this->DispensasiDenda->EditCustomAttributes = "";
		$this->DispensasiDenda->EditValue = $this->DispensasiDenda->CurrentValue;
		$this->DispensasiDenda->PlaceHolder = ew_RemoveHtml($this->DispensasiDenda->FldCaption());

		// AngsuranPokok
		$this->AngsuranPokok->EditAttrs["class"] = "form-control";
		$this->AngsuranPokok->EditCustomAttributes = "";
		$this->AngsuranPokok->EditValue = $this->AngsuranPokok->CurrentValue;
		$this->AngsuranPokok->PlaceHolder = ew_RemoveHtml($this->AngsuranPokok->FldCaption());
		if (strval($this->AngsuranPokok->EditValue) <> "" && is_numeric($this->AngsuranPokok->EditValue)) $this->AngsuranPokok->EditValue = ew_FormatNumber($this->AngsuranPokok->EditValue, -2, -2, -2, -2);

		// AngsuranBunga
		$this->AngsuranBunga->EditAttrs["class"] = "form-control";
		$this->AngsuranBunga->EditCustomAttributes = "";
		$this->AngsuranBunga->EditValue = $this->AngsuranBunga->CurrentValue;
		$this->AngsuranBunga->PlaceHolder = ew_RemoveHtml($this->AngsuranBunga->FldCaption());
		if (strval($this->AngsuranBunga->EditValue) <> "" && is_numeric($this->AngsuranBunga->EditValue)) $this->AngsuranBunga->EditValue = ew_FormatNumber($this->AngsuranBunga->EditValue, -2, -2, -2, -2);

		// AngsuranTotal
		$this->AngsuranTotal->EditAttrs["class"] = "form-control";
		$this->AngsuranTotal->EditCustomAttributes = "";
		$this->AngsuranTotal->EditValue = $this->AngsuranTotal->CurrentValue;
		$this->AngsuranTotal->PlaceHolder = ew_RemoveHtml($this->AngsuranTotal->FldCaption());
		if (strval($this->AngsuranTotal->EditValue) <> "" && is_numeric($this->AngsuranTotal->EditValue)) $this->AngsuranTotal->EditValue = ew_FormatNumber($this->AngsuranTotal->EditValue, -2, -2, -2, -2);

		// NoKontrakRefTo
		$this->NoKontrakRefTo->EditAttrs["class"] = "form-control";
		$this->NoKontrakRefTo->EditCustomAttributes = "";
		$this->NoKontrakRefTo->EditValue = $this->NoKontrakRefTo->CurrentValue;
		$this->NoKontrakRefTo->PlaceHolder = ew_RemoveHtml($this->NoKontrakRefTo->FldCaption());

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
					if ($this->NoKontrak->Exportable) $Doc->ExportCaption($this->NoKontrak);
					if ($this->TglKontrak->Exportable) $Doc->ExportCaption($this->TglKontrak);
					if ($this->nasabah_id->Exportable) $Doc->ExportCaption($this->nasabah_id);
					if ($this->Pinjaman->Exportable) $Doc->ExportCaption($this->Pinjaman);
					if ($this->LamaAngsuran->Exportable) $Doc->ExportCaption($this->LamaAngsuran);
					if ($this->Bunga->Exportable) $Doc->ExportCaption($this->Bunga);
					if ($this->Denda->Exportable) $Doc->ExportCaption($this->Denda);
					if ($this->DispensasiDenda->Exportable) $Doc->ExportCaption($this->DispensasiDenda);
					if ($this->AngsuranPokok->Exportable) $Doc->ExportCaption($this->AngsuranPokok);
					if ($this->AngsuranBunga->Exportable) $Doc->ExportCaption($this->AngsuranBunga);
					if ($this->AngsuranTotal->Exportable) $Doc->ExportCaption($this->AngsuranTotal);
					if ($this->NoKontrakRefTo->Exportable) $Doc->ExportCaption($this->NoKontrakRefTo);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->NoKontrak->Exportable) $Doc->ExportCaption($this->NoKontrak);
					if ($this->TglKontrak->Exportable) $Doc->ExportCaption($this->TglKontrak);
					if ($this->nasabah_id->Exportable) $Doc->ExportCaption($this->nasabah_id);
					if ($this->Pinjaman->Exportable) $Doc->ExportCaption($this->Pinjaman);
					if ($this->LamaAngsuran->Exportable) $Doc->ExportCaption($this->LamaAngsuran);
					if ($this->Bunga->Exportable) $Doc->ExportCaption($this->Bunga);
					if ($this->Denda->Exportable) $Doc->ExportCaption($this->Denda);
					if ($this->DispensasiDenda->Exportable) $Doc->ExportCaption($this->DispensasiDenda);
					if ($this->AngsuranPokok->Exportable) $Doc->ExportCaption($this->AngsuranPokok);
					if ($this->AngsuranBunga->Exportable) $Doc->ExportCaption($this->AngsuranBunga);
					if ($this->AngsuranTotal->Exportable) $Doc->ExportCaption($this->AngsuranTotal);
					if ($this->NoKontrakRefTo->Exportable) $Doc->ExportCaption($this->NoKontrakRefTo);
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
						if ($this->NoKontrak->Exportable) $Doc->ExportField($this->NoKontrak);
						if ($this->TglKontrak->Exportable) $Doc->ExportField($this->TglKontrak);
						if ($this->nasabah_id->Exportable) $Doc->ExportField($this->nasabah_id);
						if ($this->Pinjaman->Exportable) $Doc->ExportField($this->Pinjaman);
						if ($this->LamaAngsuran->Exportable) $Doc->ExportField($this->LamaAngsuran);
						if ($this->Bunga->Exportable) $Doc->ExportField($this->Bunga);
						if ($this->Denda->Exportable) $Doc->ExportField($this->Denda);
						if ($this->DispensasiDenda->Exportable) $Doc->ExportField($this->DispensasiDenda);
						if ($this->AngsuranPokok->Exportable) $Doc->ExportField($this->AngsuranPokok);
						if ($this->AngsuranBunga->Exportable) $Doc->ExportField($this->AngsuranBunga);
						if ($this->AngsuranTotal->Exportable) $Doc->ExportField($this->AngsuranTotal);
						if ($this->NoKontrakRefTo->Exportable) $Doc->ExportField($this->NoKontrakRefTo);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->NoKontrak->Exportable) $Doc->ExportField($this->NoKontrak);
						if ($this->TglKontrak->Exportable) $Doc->ExportField($this->TglKontrak);
						if ($this->nasabah_id->Exportable) $Doc->ExportField($this->nasabah_id);
						if ($this->Pinjaman->Exportable) $Doc->ExportField($this->Pinjaman);
						if ($this->LamaAngsuran->Exportable) $Doc->ExportField($this->LamaAngsuran);
						if ($this->Bunga->Exportable) $Doc->ExportField($this->Bunga);
						if ($this->Denda->Exportable) $Doc->ExportField($this->Denda);
						if ($this->DispensasiDenda->Exportable) $Doc->ExportField($this->DispensasiDenda);
						if ($this->AngsuranPokok->Exportable) $Doc->ExportField($this->AngsuranPokok);
						if ($this->AngsuranBunga->Exportable) $Doc->ExportField($this->AngsuranBunga);
						if ($this->AngsuranTotal->Exportable) $Doc->ExportField($this->AngsuranTotal);
						if ($this->NoKontrakRefTo->Exportable) $Doc->ExportField($this->NoKontrakRefTo);
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
		$table = 't03_pinjaman';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 't03_pinjaman';

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
		$table = 't03_pinjaman';

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
		$table = 't03_pinjaman';

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

		/*print_r($rsnew);

		// check data jaminan, data jaminan harus terisi
		$q = "select count(id) from t05_pinjamanjaminan where pinjaman_id = ".$rsnew["id"]."";
		$rec_cnt = ew_ExecuteScalar($q);
		if ($rec_cnt > 0) {
		}
		else {
			$this->setFailureMessage("Jaminan harus terisi !");
			return false;
		}*/
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		// create data rincian angsuran

		$pinjaman_id     = $rsnew["id"];
		$AngsuranTanggal = $rsnew["TglKontrak"]; //$_GET["TglKontrak"]; //$rsnew["TglKontrak"];
		$AngsuranTgl     = substr($AngsuranTanggal, -2); //substr($rsnew["TglKontrak"], -2);
		$AngsuranPokok   = $rsnew["AngsuranPokok"];
		$AngsuranBunga   = $rsnew["AngsuranBunga"];
		$AngsuranTotal   = $AngsuranPokok + $AngsuranBunga;
		$SisaHutang      = $rsnew["Pinjaman"]; // - $AngsuranTotal;
		$AngsuranPokokTotal = 0;
		$AngsuranBungaTotal = 0;
		$AngsuranTotalGrand = 0;

		//for ($i; $i <= 12; $i++) {
		for ($AngsuranKe = 1; $AngsuranKe <= $rsnew["LamaAngsuran"]; $AngsuranKe++) {
			$AngsuranTanggal     = f_TanggalAngsuran($AngsuranTanggal, $AngsuranTgl);
			$AngsuranPokokTotal += $AngsuranPokok;
			if ($AngsuranPokokTotal >= $rsnew["Pinjaman"]) {
				$AngsuranPokok      = $AngsuranPokok - ($AngsuranPokokTotal - $rsnew["Pinjaman"]);
				$AngsuranPokokTotal = $AngsuranPokokTotal - ($AngsuranPokokTotal - $rsnew["Pinjaman"]);
			}
			$SisaHutang         -= $AngsuranPokok;
			$AngsuranBunga       = $AngsuranTotal - $AngsuranPokok;
			$AngsuranBungaTotal += $AngsuranBunga;
			$AngsuranTotalGrand += $AngsuranTotal;
			$q = "insert into t04_angsuran (
				pinjaman_id,
				AngsuranKe,
				AngsuranTanggal,
				AngsuranPokok,
				AngsuranBunga,
				AngsuranTotal,
				SisaHutang
				) values (
				'".$pinjaman_id."',
				'".$AngsuranKe."',
				'".$AngsuranTanggal."',
				".$AngsuranPokok.",
				".$AngsuranBunga.",
				".$AngsuranTotal.",
				".$SisaHutang."
				)";
			ew_Execute($q);
		}
		f_updatesaldotitipan($pinjaman_id);
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
		// check perubahan data master pinjaman
		// jika ada perubahan pada data master tapi sudah ada data pembayaran
		// maka perubahan harus tidak diperbolehkan

		$q = "select count(id) from t04_angsuran where
			pinjaman_id = ".$rsold["id"]."
			and TanggalBayar is not null"; //echo $q; exit;
		$t04_reccount = ew_ExecuteScalar($q);
		if ($t04_reccount > 0) {
			if (
				$rsold["LamaAngsuran"] == $rsnew["LamaAngsuran"] and
				$rsold["AngsuranPokok"] == $rsnew["AngsuranPokok"] and
				$rsold["AngsuranBunga"] == $rsnew["AngsuranBunga"] and
				$rsold["AngsuranTotal"] == $rsnew["AngsuranTotal"]
			) {
			}
			else {
				$this->setFailureMessage("Sudah ada Transaksi Pembayaran Angsuran, data tidak bisa diubah !");
				return FALSE;
			}
		}
		/*// check data jaminan, data jaminan harus terisi
		$q = "select count(id) from t05_pinjamanjaminan where pinjaman_id = ".$rsold["id"]."";
		$rec_cnt = ew_ExecuteScalar($q);
		if ($rec_cnt > 0) {
		}
		else {
			$this->setFailureMessage("Jaminan harus terisi !");
			return false;
		}*/
		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
		// check apakah ada perubahan data pada field
		// lama angsuran
		// angs. pokok
		// angs. bunga
		// angs. total
		// jika ada perubahan :: maka detail angsuran diperbarui

		$pinjaman_id = $rsold["id"];
		if (
			$rsold["LamaAngsuran"] == $rsnew["LamaAngsuran"] and
			$rsold["AngsuranPokok"] == $rsnew["AngsuranPokok"] and
			$rsold["AngsuranBunga"] == $rsnew["AngsuranBunga"] and
			$rsold["AngsuranTotal"] == $rsnew["AngsuranTotal"]
			) {
		}
		else {

			// hapus data rincian angsuran yang lama
			$q = "delete from t04_angsuran where pinjaman_id = ".$rsold["id"].""; //echo $q; exit;
			ew_Execute($q);

			// create data rincian angsuran
			//$pinjaman_id     = $rsold["id"];

			$AngsuranTanggal = $rsnew["TglKontrak"]; //$_GET["TglKontrak"]; //$rsnew["TglKontrak"];
			$AngsuranTgl     = substr($AngsuranTanggal, -2); //substr($rsnew["TglKontrak"], -2);
			$AngsuranPokok   = $rsnew["AngsuranPokok"];
			$AngsuranBunga   = $rsnew["AngsuranBunga"];
			$AngsuranTotal   = $AngsuranPokok + $AngsuranBunga;
			$SisaHutang      = $rsnew["Pinjaman"]; // - $AngsuranTotal;
			$AngsuranPokokTotal = 0;
			$AngsuranBungaTotal = 0;
			$AngsuranTotalGrand = 0;
			for ($AngsuranKe = 1; $AngsuranKe <= $rsnew["LamaAngsuran"]; $AngsuranKe++) {
				$AngsuranTanggal     = f_TanggalAngsuran($AngsuranTanggal, $AngsuranTgl);
				$AngsuranPokokTotal += $AngsuranPokok;
				if ($AngsuranPokokTotal >= $rsnew["Pinjaman"]) {
					$AngsuranPokok      = $AngsuranPokok - ($AngsuranPokokTotal - $rsnew["Pinjaman"]);
					$AngsuranPokokTotal = $AngsuranPokokTotal - ($AngsuranPokokTotal - $rsnew["Pinjaman"]);
				}
				$SisaHutang         -= $AngsuranPokok;
				$AngsuranBunga       = $AngsuranTotal - $AngsuranPokok;
				$AngsuranBungaTotal += $AngsuranBunga;
				$AngsuranTotalGrand += $AngsuranTotal;
				$q = "insert into t04_angsuran (
					pinjaman_id,
					AngsuranKe,
					AngsuranTanggal,
					AngsuranPokok,
					AngsuranBunga,
					AngsuranTotal,
					SisaHutang
					) values (
					'".$pinjaman_id."',
					'".$AngsuranKe."',
					'".$AngsuranTanggal."',
					".$AngsuranPokok.",
					".$AngsuranBunga.",
					".$AngsuranTotal.",
					".$SisaHutang."
					)";
				ew_Execute($q); //echo $q; exit;
			}
		}
		f_updatesaldotitipan($pinjaman_id);
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
