<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t06_pinjamantitipaninfo.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t06_pinjamantitipan_edit = NULL; // Initialize page object first

class ct06_pinjamantitipan_edit extends ct06_pinjamantitipan {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}";

	// Table name
	var $TableName = 't06_pinjamantitipan';

	// Page object name
	var $PageObjName = 't06_pinjamantitipan_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t06_pinjamantitipan)
		if (!isset($GLOBALS["t06_pinjamantitipan"]) || get_class($GLOBALS["t06_pinjamantitipan"]) == "ct06_pinjamantitipan") {
			$GLOBALS["t06_pinjamantitipan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t06_pinjamantitipan"];
		}

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS['t03_pinjaman'])) $GLOBALS['t03_pinjaman'] = new ct03_pinjaman();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't06_pinjamantitipan', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t06_pinjamantitipanlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->Tanggal->SetVisibility();
		$this->Keterangan->SetVisibility();
		$this->Masuk->SetVisibility();
		$this->Keluar->SetVisibility();
		$this->Sisa->SetVisibility();
		$this->nasabah_id->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t06_pinjamantitipan;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t06_pinjamantitipan);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
			$this->RecKey["id"] = $this->id->QueryStringValue;
		} else {
			$bLoadCurrentRecord = TRUE;
		}

		// Set up master detail parameters
		$this->SetUpMasterParms();

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t06_pinjamantitipanlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->id->CurrentValue) == strval($this->Recordset->fields('id'))) {
					$this->setStartRecordNumber($this->StartRec); // Save record position
					$bMatchRecord = TRUE;
					break;
				} else {
					$this->StartRec++;
					$this->Recordset->MoveNext();
				}
			}
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$bMatchRecord) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("t06_pinjamantitipanlist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t06_pinjamantitipanlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Tanggal->FldIsDetailKey) {
			$this->Tanggal->setFormValue($objForm->GetValue("x_Tanggal"));
			$this->Tanggal->CurrentValue = ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7);
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$this->Masuk->FldIsDetailKey) {
			$this->Masuk->setFormValue($objForm->GetValue("x_Masuk"));
		}
		if (!$this->Keluar->FldIsDetailKey) {
			$this->Keluar->setFormValue($objForm->GetValue("x_Keluar"));
		}
		if (!$this->Sisa->FldIsDetailKey) {
			$this->Sisa->setFormValue($objForm->GetValue("x_Sisa"));
		}
		if (!$this->nasabah_id->FldIsDetailKey) {
			$this->nasabah_id->setFormValue($objForm->GetValue("x_nasabah_id"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->Tanggal->CurrentValue = $this->Tanggal->FormValue;
		$this->Tanggal->CurrentValue = ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7);
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->Masuk->CurrentValue = $this->Masuk->FormValue;
		$this->Keluar->CurrentValue = $this->Keluar->FormValue;
		$this->Sisa->CurrentValue = $this->Sisa->FormValue;
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
		$this->Tanggal->setDbValue($rs->fields('Tanggal'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->Masuk->setDbValue($rs->fields('Masuk'));
		$this->Keluar->setDbValue($rs->fields('Keluar'));
		$this->Sisa->setDbValue($rs->fields('Sisa'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->pinjaman_id->DbValue = $row['pinjaman_id'];
		$this->Tanggal->DbValue = $row['Tanggal'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->Masuk->DbValue = $row['Masuk'];
		$this->Keluar->DbValue = $row['Keluar'];
		$this->Sisa->DbValue = $row['Sisa'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Masuk->FormValue == $this->Masuk->CurrentValue && is_numeric(ew_StrToFloat($this->Masuk->CurrentValue)))
			$this->Masuk->CurrentValue = ew_StrToFloat($this->Masuk->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Keluar->FormValue == $this->Keluar->CurrentValue && is_numeric(ew_StrToFloat($this->Keluar->CurrentValue)))
			$this->Keluar->CurrentValue = ew_StrToFloat($this->Keluar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Sisa->FormValue == $this->Sisa->CurrentValue && is_numeric(ew_StrToFloat($this->Sisa->CurrentValue)))
			$this->Sisa->CurrentValue = ew_StrToFloat($this->Sisa->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// pinjaman_id
		// Tanggal
		// Keterangan
		// Masuk
		// Keluar
		// Sisa
		// nasabah_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pinjaman_id
		$this->pinjaman_id->ViewValue = $this->pinjaman_id->CurrentValue;
		$this->pinjaman_id->ViewCustomAttributes = "";

		// Tanggal
		$this->Tanggal->ViewValue = $this->Tanggal->CurrentValue;
		$this->Tanggal->ViewValue = ew_FormatDateTime($this->Tanggal->ViewValue, 7);
		$this->Tanggal->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// Masuk
		$this->Masuk->ViewValue = $this->Masuk->CurrentValue;
		$this->Masuk->ViewValue = ew_FormatNumber($this->Masuk->ViewValue, 2, -2, -2, -2);
		$this->Masuk->CellCssStyle .= "text-align: right;";
		$this->Masuk->ViewCustomAttributes = "";

		// Keluar
		$this->Keluar->ViewValue = $this->Keluar->CurrentValue;
		$this->Keluar->ViewValue = ew_FormatNumber($this->Keluar->ViewValue, 2, -2, -2, -2);
		$this->Keluar->CellCssStyle .= "text-align: right;";
		$this->Keluar->ViewCustomAttributes = "";

		// Sisa
		$this->Sisa->ViewValue = $this->Sisa->CurrentValue;
		$this->Sisa->ViewValue = ew_FormatNumber($this->Sisa->ViewValue, 2, -2, -2, -2);
		$this->Sisa->CellCssStyle .= "text-align: right;";
		$this->Sisa->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->ViewCustomAttributes = "";

			// Tanggal
			$this->Tanggal->LinkCustomAttributes = "";
			$this->Tanggal->HrefValue = "";
			$this->Tanggal->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";

			// Masuk
			$this->Masuk->LinkCustomAttributes = "";
			$this->Masuk->HrefValue = "";
			$this->Masuk->TooltipValue = "";

			// Keluar
			$this->Keluar->LinkCustomAttributes = "";
			$this->Keluar->HrefValue = "";
			$this->Keluar->TooltipValue = "";

			// Sisa
			$this->Sisa->LinkCustomAttributes = "";
			$this->Sisa->HrefValue = "";
			$this->Sisa->TooltipValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
			$this->nasabah_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Tanggal
			$this->Tanggal->EditAttrs["class"] = "form-control";
			$this->Tanggal->EditCustomAttributes = "";
			$this->Tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Tanggal->CurrentValue, 7));
			$this->Tanggal->PlaceHolder = ew_RemoveHtml($this->Tanggal->FldCaption());

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// Masuk
			$this->Masuk->EditAttrs["class"] = "form-control";
			$this->Masuk->EditCustomAttributes = "";
			$this->Masuk->EditValue = ew_HtmlEncode($this->Masuk->CurrentValue);
			$this->Masuk->PlaceHolder = ew_RemoveHtml($this->Masuk->FldCaption());
			if (strval($this->Masuk->EditValue) <> "" && is_numeric($this->Masuk->EditValue)) $this->Masuk->EditValue = ew_FormatNumber($this->Masuk->EditValue, -2, -2, -2, -2);

			// Keluar
			$this->Keluar->EditAttrs["class"] = "form-control";
			$this->Keluar->EditCustomAttributes = "";
			$this->Keluar->EditValue = ew_HtmlEncode($this->Keluar->CurrentValue);
			$this->Keluar->PlaceHolder = ew_RemoveHtml($this->Keluar->FldCaption());
			if (strval($this->Keluar->EditValue) <> "" && is_numeric($this->Keluar->EditValue)) $this->Keluar->EditValue = ew_FormatNumber($this->Keluar->EditValue, -2, -2, -2, -2);

			// Sisa
			$this->Sisa->EditAttrs["class"] = "form-control";
			$this->Sisa->EditCustomAttributes = "";
			$this->Sisa->EditValue = $this->Sisa->CurrentValue;
			$this->Sisa->EditValue = ew_FormatNumber($this->Sisa->EditValue, 2, -2, -2, -2);
			$this->Sisa->CellCssStyle .= "text-align: right;";
			$this->Sisa->ViewCustomAttributes = "";

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			if ($this->nasabah_id->getSessionValue() <> "") {
				$this->nasabah_id->CurrentValue = $this->nasabah_id->getSessionValue();
			$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
			$this->nasabah_id->ViewCustomAttributes = "";
			} else {
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->CurrentValue);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());
			}

			// Edit refer script
			// Tanggal

			$this->Tanggal->LinkCustomAttributes = "";
			$this->Tanggal->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// Masuk
			$this->Masuk->LinkCustomAttributes = "";
			$this->Masuk->HrefValue = "";

			// Keluar
			$this->Keluar->LinkCustomAttributes = "";
			$this->Keluar->HrefValue = "";

			// Sisa
			$this->Sisa->LinkCustomAttributes = "";
			$this->Sisa->HrefValue = "";
			$this->Sisa->TooltipValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->Tanggal->FldIsDetailKey && !is_null($this->Tanggal->FormValue) && $this->Tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tanggal->FldCaption(), $this->Tanggal->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tanggal->FldErrMsg());
		}
		if (!$this->Masuk->FldIsDetailKey && !is_null($this->Masuk->FormValue) && $this->Masuk->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Masuk->FldCaption(), $this->Masuk->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Masuk->FormValue)) {
			ew_AddMessage($gsFormError, $this->Masuk->FldErrMsg());
		}
		if (!$this->Keluar->FldIsDetailKey && !is_null($this->Keluar->FormValue) && $this->Keluar->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Keluar->FldCaption(), $this->Keluar->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Keluar->FormValue)) {
			ew_AddMessage($gsFormError, $this->Keluar->FldErrMsg());
		}
		if (!$this->nasabah_id->FldIsDetailKey && !is_null($this->nasabah_id->FormValue) && $this->nasabah_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nasabah_id->FldCaption(), $this->nasabah_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->nasabah_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->nasabah_id->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// Tanggal
			$this->Tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7), ew_CurrentDate(), $this->Tanggal->ReadOnly);

			// Keterangan
			$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, $this->Keterangan->ReadOnly);

			// Masuk
			$this->Masuk->SetDbValueDef($rsnew, $this->Masuk->CurrentValue, 0, $this->Masuk->ReadOnly);

			// Keluar
			$this->Keluar->SetDbValueDef($rsnew, $this->Keluar->CurrentValue, 0, $this->Keluar->ReadOnly);

			// nasabah_id
			$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, $this->nasabah_id->ReadOnly);

			// Check referential integrity for master table 't03_pinjaman'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_t03_pinjaman();
			$KeyValue = isset($rsnew['pinjaman_id']) ? $rsnew['pinjaman_id'] : $rsold['pinjaman_id'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			$KeyValue = isset($rsnew['nasabah_id']) ? $rsnew['nasabah_id'] : $rsold['nasabah_id'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@nasabah_id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["t03_pinjaman"])) $GLOBALS["t03_pinjaman"] = new ct03_pinjaman();
				$rsmaster = $GLOBALS["t03_pinjaman"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "t03_pinjaman", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
			}

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_pinjaman") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->pinjaman_id->setQueryStringValue($GLOBALS["t03_pinjaman"]->id->QueryStringValue);
					$this->pinjaman_id->setSessionValue($this->pinjaman_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["fk_nasabah_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->nasabah_id->setQueryStringValue($_GET["fk_nasabah_id"]);
					$this->nasabah_id->setQueryStringValue($GLOBALS["t03_pinjaman"]->nasabah_id->QueryStringValue);
					$this->nasabah_id->setSessionValue($this->nasabah_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->nasabah_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_pinjaman") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->id->setFormValue($_POST["fk_id"]);
					$this->pinjaman_id->setFormValue($GLOBALS["t03_pinjaman"]->id->FormValue);
					$this->pinjaman_id->setSessionValue($this->pinjaman_id->FormValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_POST["fk_nasabah_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->nasabah_id->setFormValue($_POST["fk_nasabah_id"]);
					$this->nasabah_id->setFormValue($GLOBALS["t03_pinjaman"]->nasabah_id->FormValue);
					$this->nasabah_id->setSessionValue($this->nasabah_id->FormValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->nasabah_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t03_pinjaman") {
				if ($this->pinjaman_id->CurrentValue == "") $this->pinjaman_id->setSessionValue("");
				if ($this->nasabah_id->CurrentValue == "") $this->nasabah_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t06_pinjamantitipanlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t06_pinjamantitipan_edit)) $t06_pinjamantitipan_edit = new ct06_pinjamantitipan_edit();

// Page init
$t06_pinjamantitipan_edit->Page_Init();

// Page main
$t06_pinjamantitipan_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_pinjamantitipan_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft06_pinjamantitipanedit = new ew_Form("ft06_pinjamantitipanedit", "edit");

// Validate form
ft06_pinjamantitipanedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_pinjamantitipan->nasabah_id->FldCaption(), $t06_pinjamantitipan->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_pinjamantitipan->nasabah_id->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft06_pinjamantitipanedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_pinjamantitipanedit.ValidateRequired = true;
<?php } else { ?>
ft06_pinjamantitipanedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t06_pinjamantitipan_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t06_pinjamantitipan_edit->ShowPageHeader(); ?>
<?php
$t06_pinjamantitipan_edit->ShowMessage();
?>
<?php if (!$t06_pinjamantitipan_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t06_pinjamantitipan_edit->Pager)) $t06_pinjamantitipan_edit->Pager = new cPrevNextPager($t06_pinjamantitipan_edit->StartRec, $t06_pinjamantitipan_edit->DisplayRecs, $t06_pinjamantitipan_edit->TotalRecs) ?>
<?php if ($t06_pinjamantitipan_edit->Pager->RecordCount > 0 && $t06_pinjamantitipan_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t06_pinjamantitipan_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t06_pinjamantitipan_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft06_pinjamantitipanedit" id="ft06_pinjamantitipanedit" class="<?php echo $t06_pinjamantitipan_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t06_pinjamantitipan_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t06_pinjamantitipan_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t06_pinjamantitipan">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t06_pinjamantitipan_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t06_pinjamantitipan->getCurrentMasterTable() == "t03_pinjaman") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_pinjaman">
<input type="hidden" name="fk_id" value="<?php echo $t06_pinjamantitipan->pinjaman_id->getSessionValue() ?>">
<input type="hidden" name="fk_nasabah_id" value="<?php echo $t06_pinjamantitipan->nasabah_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t06_pinjamantitipan->Tanggal->Visible) { // Tanggal ?>
	<div id="r_Tanggal" class="form-group">
		<label id="elh_t06_pinjamantitipan_Tanggal" for="x_Tanggal" class="col-sm-2 control-label ewLabel"><?php echo $t06_pinjamantitipan->Tanggal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t06_pinjamantitipan->Tanggal->CellAttributes() ?>>
<span id="el_t06_pinjamantitipan_Tanggal">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Tanggal" data-format="7" name="x_Tanggal" id="x_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Tanggal->EditValue ?>"<?php echo $t06_pinjamantitipan->Tanggal->EditAttributes() ?>>
<?php if (!$t06_pinjamantitipan->Tanggal->ReadOnly && !$t06_pinjamantitipan->Tanggal->Disabled && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["readonly"]) && !isset($t06_pinjamantitipan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_pinjamantitipanedit", "x_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php echo $t06_pinjamantitipan->Tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_pinjamantitipan->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group">
		<label id="elh_t06_pinjamantitipan_Keterangan" for="x_Keterangan" class="col-sm-2 control-label ewLabel"><?php echo $t06_pinjamantitipan->Keterangan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_pinjamantitipan->Keterangan->CellAttributes() ?>>
<span id="el_t06_pinjamantitipan_Keterangan">
<textarea data-table="t06_pinjamantitipan" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keterangan->getPlaceHolder()) ?>"<?php echo $t06_pinjamantitipan->Keterangan->EditAttributes() ?>><?php echo $t06_pinjamantitipan->Keterangan->EditValue ?></textarea>
</span>
<?php echo $t06_pinjamantitipan->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_pinjamantitipan->Masuk->Visible) { // Masuk ?>
	<div id="r_Masuk" class="form-group">
		<label id="elh_t06_pinjamantitipan_Masuk" for="x_Masuk" class="col-sm-2 control-label ewLabel"><?php echo $t06_pinjamantitipan->Masuk->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t06_pinjamantitipan->Masuk->CellAttributes() ?>>
<span id="el_t06_pinjamantitipan_Masuk">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Masuk" name="x_Masuk" id="x_Masuk" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Masuk->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Masuk->EditValue ?>"<?php echo $t06_pinjamantitipan->Masuk->EditAttributes() ?>>
</span>
<?php echo $t06_pinjamantitipan->Masuk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_pinjamantitipan->Keluar->Visible) { // Keluar ?>
	<div id="r_Keluar" class="form-group">
		<label id="elh_t06_pinjamantitipan_Keluar" for="x_Keluar" class="col-sm-2 control-label ewLabel"><?php echo $t06_pinjamantitipan->Keluar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t06_pinjamantitipan->Keluar->CellAttributes() ?>>
<span id="el_t06_pinjamantitipan_Keluar">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_Keluar" name="x_Keluar" id="x_Keluar" size="10" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Keluar->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->Keluar->EditValue ?>"<?php echo $t06_pinjamantitipan->Keluar->EditAttributes() ?>>
</span>
<?php echo $t06_pinjamantitipan->Keluar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_pinjamantitipan->Sisa->Visible) { // Sisa ?>
	<div id="r_Sisa" class="form-group">
		<label id="elh_t06_pinjamantitipan_Sisa" for="x_Sisa" class="col-sm-2 control-label ewLabel"><?php echo $t06_pinjamantitipan->Sisa->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_pinjamantitipan->Sisa->CellAttributes() ?>>
<span id="el_t06_pinjamantitipan_Sisa">
<span<?php echo $t06_pinjamantitipan->Sisa->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->Sisa->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_Sisa" name="x_Sisa" id="x_Sisa" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->Sisa->CurrentValue) ?>">
<?php echo $t06_pinjamantitipan->Sisa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_pinjamantitipan->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t06_pinjamantitipan_nasabah_id" for="x_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t06_pinjamantitipan->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t06_pinjamantitipan->nasabah_id->CellAttributes() ?>>
<?php if ($t06_pinjamantitipan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el_t06_pinjamantitipan_nasabah_id">
<span<?php echo $t06_pinjamantitipan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_pinjamantitipan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_nasabah_id" name="x_nasabah_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t06_pinjamantitipan_nasabah_id">
<input type="text" data-table="t06_pinjamantitipan" data-field="x_nasabah_id" name="x_nasabah_id" id="x_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_pinjamantitipan->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t06_pinjamantitipan->nasabah_id->EditValue ?>"<?php echo $t06_pinjamantitipan->nasabah_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $t06_pinjamantitipan->nasabah_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t06_pinjamantitipan" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t06_pinjamantitipan->id->CurrentValue) ?>">
<?php if (!$t06_pinjamantitipan_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t06_pinjamantitipan_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php if (!isset($t06_pinjamantitipan_edit->Pager)) $t06_pinjamantitipan_edit->Pager = new cPrevNextPager($t06_pinjamantitipan_edit->StartRec, $t06_pinjamantitipan_edit->DisplayRecs, $t06_pinjamantitipan_edit->TotalRecs) ?>
<?php if ($t06_pinjamantitipan_edit->Pager->RecordCount > 0 && $t06_pinjamantitipan_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t06_pinjamantitipan_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t06_pinjamantitipan_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t06_pinjamantitipan_edit->PageUrl() ?>start=<?php echo $t06_pinjamantitipan_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t06_pinjamantitipan_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft06_pinjamantitipanedit.Init();
</script>
<?php
$t06_pinjamantitipan_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t06_pinjamantitipan_edit->Page_Terminate();
?>
