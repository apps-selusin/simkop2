<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t04_angsurangridcls.php" ?>
<?php include_once "t05_pinjamanjaminangridcls.php" ?>
<?php include_once "t06_pinjamantitipangridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t03_pinjaman_edit = NULL; // Initialize page object first

class ct03_pinjaman_edit extends ct03_pinjaman {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}";

	// Table name
	var $TableName = 't03_pinjaman';

	// Page object name
	var $PageObjName = 't03_pinjaman_edit';

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

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS["t03_pinjaman"]) || get_class($GLOBALS["t03_pinjaman"]) == "ct03_pinjaman") {
			$GLOBALS["t03_pinjaman"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t03_pinjaman"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't03_pinjaman', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t03_pinjamanlist.php"));
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
		$this->NoKontrak->SetVisibility();
		$this->TglKontrak->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->Pinjaman->SetVisibility();
		$this->LamaAngsuran->SetVisibility();
		$this->Bunga->SetVisibility();
		$this->Denda->SetVisibility();
		$this->DispensasiDenda->SetVisibility();
		$this->AngsuranPokok->SetVisibility();
		$this->AngsuranBunga->SetVisibility();
		$this->AngsuranTotal->SetVisibility();
		$this->NoKontrakRefTo->SetVisibility();

		// Set up detail page object
		$this->SetupDetailPages();

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

			// Process auto fill for detail table 't04_angsuran'
			if (@$_POST["grid"] == "ft04_angsurangrid") {
				if (!isset($GLOBALS["t04_angsuran_grid"])) $GLOBALS["t04_angsuran_grid"] = new ct04_angsuran_grid;
				$GLOBALS["t04_angsuran_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}

			// Process auto fill for detail table 't05_pinjamanjaminan'
			if (@$_POST["grid"] == "ft05_pinjamanjaminangrid") {
				if (!isset($GLOBALS["t05_pinjamanjaminan_grid"])) $GLOBALS["t05_pinjamanjaminan_grid"] = new ct05_pinjamanjaminan_grid;
				$GLOBALS["t05_pinjamanjaminan_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}

			// Process auto fill for detail table 't06_pinjamantitipan'
			if (@$_POST["grid"] == "ft06_pinjamantitipangrid") {
				if (!isset($GLOBALS["t06_pinjamantitipan_grid"])) $GLOBALS["t06_pinjamantitipan_grid"] = new ct06_pinjamantitipan_grid;
				$GLOBALS["t06_pinjamantitipan_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}
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
		global $EW_EXPORT, $t03_pinjaman;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t03_pinjaman);
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
	var $DetailPages; // Detail pages object

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

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t03_pinjamanlist.php"); // Return to list page
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

			// Set up detail parameters
			$this->SetUpDetailParms();
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
					$this->Page_Terminate("t03_pinjamanlist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			Case "U": // Update
				$sReturnUrl = "t03_pinjamanedit.php?showdetail=t04_angsuran,t05_pinjamanjaminan,t06_pinjamantitipan&id=".urlencode($this->id->CurrentValue);
				if (ew_GetPageName($sReturnUrl) == "t03_pinjamanlist.php")
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

					// Set up detail parameters
					$this->SetUpDetailParms();
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
		if (!$this->NoKontrak->FldIsDetailKey) {
			$this->NoKontrak->setFormValue($objForm->GetValue("x_NoKontrak"));
		}
		if (!$this->TglKontrak->FldIsDetailKey) {
			$this->TglKontrak->setFormValue($objForm->GetValue("x_TglKontrak"));
			$this->TglKontrak->CurrentValue = ew_UnFormatDateTime($this->TglKontrak->CurrentValue, 7);
		}
		if (!$this->nasabah_id->FldIsDetailKey) {
			$this->nasabah_id->setFormValue($objForm->GetValue("x_nasabah_id"));
		}
		if (!$this->Pinjaman->FldIsDetailKey) {
			$this->Pinjaman->setFormValue($objForm->GetValue("x_Pinjaman"));
		}
		if (!$this->LamaAngsuran->FldIsDetailKey) {
			$this->LamaAngsuran->setFormValue($objForm->GetValue("x_LamaAngsuran"));
		}
		if (!$this->Bunga->FldIsDetailKey) {
			$this->Bunga->setFormValue($objForm->GetValue("x_Bunga"));
		}
		if (!$this->Denda->FldIsDetailKey) {
			$this->Denda->setFormValue($objForm->GetValue("x_Denda"));
		}
		if (!$this->DispensasiDenda->FldIsDetailKey) {
			$this->DispensasiDenda->setFormValue($objForm->GetValue("x_DispensasiDenda"));
		}
		if (!$this->AngsuranPokok->FldIsDetailKey) {
			$this->AngsuranPokok->setFormValue($objForm->GetValue("x_AngsuranPokok"));
		}
		if (!$this->AngsuranBunga->FldIsDetailKey) {
			$this->AngsuranBunga->setFormValue($objForm->GetValue("x_AngsuranBunga"));
		}
		if (!$this->AngsuranTotal->FldIsDetailKey) {
			$this->AngsuranTotal->setFormValue($objForm->GetValue("x_AngsuranTotal"));
		}
		if (!$this->NoKontrakRefTo->FldIsDetailKey) {
			$this->NoKontrakRefTo->setFormValue($objForm->GetValue("x_NoKontrakRefTo"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->NoKontrak->CurrentValue = $this->NoKontrak->FormValue;
		$this->TglKontrak->CurrentValue = $this->TglKontrak->FormValue;
		$this->TglKontrak->CurrentValue = ew_UnFormatDateTime($this->TglKontrak->CurrentValue, 7);
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
		$this->Pinjaman->CurrentValue = $this->Pinjaman->FormValue;
		$this->LamaAngsuran->CurrentValue = $this->LamaAngsuran->FormValue;
		$this->Bunga->CurrentValue = $this->Bunga->FormValue;
		$this->Denda->CurrentValue = $this->Denda->FormValue;
		$this->DispensasiDenda->CurrentValue = $this->DispensasiDenda->FormValue;
		$this->AngsuranPokok->CurrentValue = $this->AngsuranPokok->FormValue;
		$this->AngsuranBunga->CurrentValue = $this->AngsuranBunga->FormValue;
		$this->AngsuranTotal->CurrentValue = $this->AngsuranTotal->FormValue;
		$this->NoKontrakRefTo->CurrentValue = $this->NoKontrakRefTo->FormValue;
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
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
		$this->NoKontrak->setDbValue($rs->fields('NoKontrak'));
		$this->TglKontrak->setDbValue($rs->fields('TglKontrak'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		if (array_key_exists('EV__nasabah_id', $rs->fields)) {
			$this->nasabah_id->VirtualValue = $rs->fields('EV__nasabah_id'); // Set up virtual field value
		} else {
			$this->nasabah_id->VirtualValue = ""; // Clear value
		}
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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->NoKontrak->DbValue = $row['NoKontrak'];
		$this->TglKontrak->DbValue = $row['TglKontrak'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->Pinjaman->DbValue = $row['Pinjaman'];
		$this->LamaAngsuran->DbValue = $row['LamaAngsuran'];
		$this->Bunga->DbValue = $row['Bunga'];
		$this->Denda->DbValue = $row['Denda'];
		$this->DispensasiDenda->DbValue = $row['DispensasiDenda'];
		$this->AngsuranPokok->DbValue = $row['AngsuranPokok'];
		$this->AngsuranBunga->DbValue = $row['AngsuranBunga'];
		$this->AngsuranTotal->DbValue = $row['AngsuranTotal'];
		$this->NoKontrakRefTo->DbValue = $row['NoKontrakRefTo'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Pinjaman->FormValue == $this->Pinjaman->CurrentValue && is_numeric(ew_StrToFloat($this->Pinjaman->CurrentValue)))
			$this->Pinjaman->CurrentValue = ew_StrToFloat($this->Pinjaman->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga->FormValue == $this->Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga->CurrentValue)))
			$this->Bunga->CurrentValue = ew_StrToFloat($this->Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Denda->FormValue == $this->Denda->CurrentValue && is_numeric(ew_StrToFloat($this->Denda->CurrentValue)))
			$this->Denda->CurrentValue = ew_StrToFloat($this->Denda->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AngsuranPokok->FormValue == $this->AngsuranPokok->CurrentValue && is_numeric(ew_StrToFloat($this->AngsuranPokok->CurrentValue)))
			$this->AngsuranPokok->CurrentValue = ew_StrToFloat($this->AngsuranPokok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AngsuranBunga->FormValue == $this->AngsuranBunga->CurrentValue && is_numeric(ew_StrToFloat($this->AngsuranBunga->CurrentValue)))
			$this->AngsuranBunga->CurrentValue = ew_StrToFloat($this->AngsuranBunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AngsuranTotal->FormValue == $this->AngsuranTotal->CurrentValue && is_numeric(ew_StrToFloat($this->AngsuranTotal->CurrentValue)))
			$this->AngsuranTotal->CurrentValue = ew_StrToFloat($this->AngsuranTotal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// NoKontrak
			$this->NoKontrak->EditAttrs["class"] = "form-control";
			$this->NoKontrak->EditCustomAttributes = "";
			$this->NoKontrak->EditValue = ew_HtmlEncode($this->NoKontrak->CurrentValue);
			$this->NoKontrak->PlaceHolder = ew_RemoveHtml($this->NoKontrak->FldCaption());

			// TglKontrak
			$this->TglKontrak->EditAttrs["class"] = "form-control";
			$this->TglKontrak->EditCustomAttributes = "";
			$this->TglKontrak->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TglKontrak->CurrentValue, 7));
			$this->TglKontrak->PlaceHolder = ew_RemoveHtml($this->TglKontrak->FldCaption());

			// nasabah_id
			$this->nasabah_id->EditCustomAttributes = "";
			if (trim(strval($this->nasabah_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Customer` AS `DispFld`, `Pekerjaan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t01_nasabah`";
			$sWhereWrk = "";
			$this->nasabah_id->LookupFilters = array("dx1" => '`Customer`', "dx2" => '`Pekerjaan`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Customer` ASC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->nasabah_id->ViewValue = $this->nasabah_id->DisplayValue($arwrk);
			} else {
				$this->nasabah_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->nasabah_id->EditValue = $arwrk;

			// Pinjaman
			$this->Pinjaman->EditAttrs["class"] = "form-control";
			$this->Pinjaman->EditCustomAttributes = "";
			$this->Pinjaman->EditValue = ew_HtmlEncode($this->Pinjaman->CurrentValue);
			$this->Pinjaman->PlaceHolder = ew_RemoveHtml($this->Pinjaman->FldCaption());
			if (strval($this->Pinjaman->EditValue) <> "" && is_numeric($this->Pinjaman->EditValue)) $this->Pinjaman->EditValue = ew_FormatNumber($this->Pinjaman->EditValue, -2, -2, -2, -2);

			// LamaAngsuran
			$this->LamaAngsuran->EditAttrs["class"] = "form-control";
			$this->LamaAngsuran->EditCustomAttributes = "";
			$this->LamaAngsuran->EditValue = ew_HtmlEncode($this->LamaAngsuran->CurrentValue);
			$this->LamaAngsuran->PlaceHolder = ew_RemoveHtml($this->LamaAngsuran->FldCaption());

			// Bunga
			$this->Bunga->EditAttrs["class"] = "form-control";
			$this->Bunga->EditCustomAttributes = "";
			$this->Bunga->EditValue = ew_HtmlEncode($this->Bunga->CurrentValue);
			$this->Bunga->PlaceHolder = ew_RemoveHtml($this->Bunga->FldCaption());
			if (strval($this->Bunga->EditValue) <> "" && is_numeric($this->Bunga->EditValue)) $this->Bunga->EditValue = ew_FormatNumber($this->Bunga->EditValue, -2, -2, -2, -2);

			// Denda
			$this->Denda->EditAttrs["class"] = "form-control";
			$this->Denda->EditCustomAttributes = "";
			$this->Denda->EditValue = ew_HtmlEncode($this->Denda->CurrentValue);
			$this->Denda->PlaceHolder = ew_RemoveHtml($this->Denda->FldCaption());
			if (strval($this->Denda->EditValue) <> "" && is_numeric($this->Denda->EditValue)) $this->Denda->EditValue = ew_FormatNumber($this->Denda->EditValue, -2, -2, -2, -2);

			// DispensasiDenda
			$this->DispensasiDenda->EditAttrs["class"] = "form-control";
			$this->DispensasiDenda->EditCustomAttributes = "";
			$this->DispensasiDenda->EditValue = ew_HtmlEncode($this->DispensasiDenda->CurrentValue);
			$this->DispensasiDenda->PlaceHolder = ew_RemoveHtml($this->DispensasiDenda->FldCaption());

			// AngsuranPokok
			$this->AngsuranPokok->EditAttrs["class"] = "form-control";
			$this->AngsuranPokok->EditCustomAttributes = "";
			$this->AngsuranPokok->EditValue = ew_HtmlEncode($this->AngsuranPokok->CurrentValue);
			$this->AngsuranPokok->PlaceHolder = ew_RemoveHtml($this->AngsuranPokok->FldCaption());
			if (strval($this->AngsuranPokok->EditValue) <> "" && is_numeric($this->AngsuranPokok->EditValue)) $this->AngsuranPokok->EditValue = ew_FormatNumber($this->AngsuranPokok->EditValue, -2, -2, -2, -2);

			// AngsuranBunga
			$this->AngsuranBunga->EditAttrs["class"] = "form-control";
			$this->AngsuranBunga->EditCustomAttributes = "";
			$this->AngsuranBunga->EditValue = ew_HtmlEncode($this->AngsuranBunga->CurrentValue);
			$this->AngsuranBunga->PlaceHolder = ew_RemoveHtml($this->AngsuranBunga->FldCaption());
			if (strval($this->AngsuranBunga->EditValue) <> "" && is_numeric($this->AngsuranBunga->EditValue)) $this->AngsuranBunga->EditValue = ew_FormatNumber($this->AngsuranBunga->EditValue, -2, -2, -2, -2);

			// AngsuranTotal
			$this->AngsuranTotal->EditAttrs["class"] = "form-control";
			$this->AngsuranTotal->EditCustomAttributes = "";
			$this->AngsuranTotal->EditValue = ew_HtmlEncode($this->AngsuranTotal->CurrentValue);
			$this->AngsuranTotal->PlaceHolder = ew_RemoveHtml($this->AngsuranTotal->FldCaption());
			if (strval($this->AngsuranTotal->EditValue) <> "" && is_numeric($this->AngsuranTotal->EditValue)) $this->AngsuranTotal->EditValue = ew_FormatNumber($this->AngsuranTotal->EditValue, -2, -2, -2, -2);

			// NoKontrakRefTo
			$this->NoKontrakRefTo->EditAttrs["class"] = "form-control";
			$this->NoKontrakRefTo->EditCustomAttributes = "";
			$this->NoKontrakRefTo->EditValue = ew_HtmlEncode($this->NoKontrakRefTo->CurrentValue);
			$this->NoKontrakRefTo->PlaceHolder = ew_RemoveHtml($this->NoKontrakRefTo->FldCaption());

			// Edit refer script
			// NoKontrak

			$this->NoKontrak->LinkCustomAttributes = "";
			$this->NoKontrak->HrefValue = "";

			// TglKontrak
			$this->TglKontrak->LinkCustomAttributes = "";
			$this->TglKontrak->HrefValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";

			// Pinjaman
			$this->Pinjaman->LinkCustomAttributes = "";
			$this->Pinjaman->HrefValue = "";

			// LamaAngsuran
			$this->LamaAngsuran->LinkCustomAttributes = "";
			$this->LamaAngsuran->HrefValue = "";

			// Bunga
			$this->Bunga->LinkCustomAttributes = "";
			$this->Bunga->HrefValue = "";

			// Denda
			$this->Denda->LinkCustomAttributes = "";
			$this->Denda->HrefValue = "";

			// DispensasiDenda
			$this->DispensasiDenda->LinkCustomAttributes = "";
			$this->DispensasiDenda->HrefValue = "";

			// AngsuranPokok
			$this->AngsuranPokok->LinkCustomAttributes = "";
			$this->AngsuranPokok->HrefValue = "";

			// AngsuranBunga
			$this->AngsuranBunga->LinkCustomAttributes = "";
			$this->AngsuranBunga->HrefValue = "";

			// AngsuranTotal
			$this->AngsuranTotal->LinkCustomAttributes = "";
			$this->AngsuranTotal->HrefValue = "";

			// NoKontrakRefTo
			$this->NoKontrakRefTo->LinkCustomAttributes = "";
			$this->NoKontrakRefTo->HrefValue = "";
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
		if (!$this->NoKontrak->FldIsDetailKey && !is_null($this->NoKontrak->FormValue) && $this->NoKontrak->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoKontrak->FldCaption(), $this->NoKontrak->ReqErrMsg));
		}
		if (!$this->TglKontrak->FldIsDetailKey && !is_null($this->TglKontrak->FormValue) && $this->TglKontrak->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->TglKontrak->FldCaption(), $this->TglKontrak->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->TglKontrak->FormValue)) {
			ew_AddMessage($gsFormError, $this->TglKontrak->FldErrMsg());
		}
		if (!$this->nasabah_id->FldIsDetailKey && !is_null($this->nasabah_id->FormValue) && $this->nasabah_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nasabah_id->FldCaption(), $this->nasabah_id->ReqErrMsg));
		}
		if (!$this->Pinjaman->FldIsDetailKey && !is_null($this->Pinjaman->FormValue) && $this->Pinjaman->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Pinjaman->FldCaption(), $this->Pinjaman->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Pinjaman->FormValue)) {
			ew_AddMessage($gsFormError, $this->Pinjaman->FldErrMsg());
		}
		if (!$this->LamaAngsuran->FldIsDetailKey && !is_null($this->LamaAngsuran->FormValue) && $this->LamaAngsuran->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->LamaAngsuran->FldCaption(), $this->LamaAngsuran->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->LamaAngsuran->FormValue)) {
			ew_AddMessage($gsFormError, $this->LamaAngsuran->FldErrMsg());
		}
		if (!$this->Bunga->FldIsDetailKey && !is_null($this->Bunga->FormValue) && $this->Bunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Bunga->FldCaption(), $this->Bunga->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Bunga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bunga->FldErrMsg());
		}
		if (!$this->Denda->FldIsDetailKey && !is_null($this->Denda->FormValue) && $this->Denda->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Denda->FldCaption(), $this->Denda->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Denda->FormValue)) {
			ew_AddMessage($gsFormError, $this->Denda->FldErrMsg());
		}
		if (!$this->DispensasiDenda->FldIsDetailKey && !is_null($this->DispensasiDenda->FormValue) && $this->DispensasiDenda->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->DispensasiDenda->FldCaption(), $this->DispensasiDenda->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->DispensasiDenda->FormValue)) {
			ew_AddMessage($gsFormError, $this->DispensasiDenda->FldErrMsg());
		}
		if (!$this->AngsuranPokok->FldIsDetailKey && !is_null($this->AngsuranPokok->FormValue) && $this->AngsuranPokok->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranPokok->FldCaption(), $this->AngsuranPokok->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->AngsuranPokok->FormValue)) {
			ew_AddMessage($gsFormError, $this->AngsuranPokok->FldErrMsg());
		}
		if (!$this->AngsuranBunga->FldIsDetailKey && !is_null($this->AngsuranBunga->FormValue) && $this->AngsuranBunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranBunga->FldCaption(), $this->AngsuranBunga->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->AngsuranBunga->FormValue)) {
			ew_AddMessage($gsFormError, $this->AngsuranBunga->FldErrMsg());
		}
		if (!$this->AngsuranTotal->FldIsDetailKey && !is_null($this->AngsuranTotal->FormValue) && $this->AngsuranTotal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranTotal->FldCaption(), $this->AngsuranTotal->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->AngsuranTotal->FormValue)) {
			ew_AddMessage($gsFormError, $this->AngsuranTotal->FldErrMsg());
		}
		if (!ew_CheckInteger($this->NoKontrakRefTo->FormValue)) {
			ew_AddMessage($gsFormError, $this->NoKontrakRefTo->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t04_angsuran", $DetailTblVar) && $GLOBALS["t04_angsuran"]->DetailEdit) {
			if (!isset($GLOBALS["t04_angsuran_grid"])) $GLOBALS["t04_angsuran_grid"] = new ct04_angsuran_grid(); // get detail page object
			$GLOBALS["t04_angsuran_grid"]->ValidateGridForm();
		}
		if (in_array("t05_pinjamanjaminan", $DetailTblVar) && $GLOBALS["t05_pinjamanjaminan"]->DetailEdit) {
			if (!isset($GLOBALS["t05_pinjamanjaminan_grid"])) $GLOBALS["t05_pinjamanjaminan_grid"] = new ct05_pinjamanjaminan_grid(); // get detail page object
			$GLOBALS["t05_pinjamanjaminan_grid"]->ValidateGridForm();
		}
		if (in_array("t06_pinjamantitipan", $DetailTblVar) && $GLOBALS["t06_pinjamantitipan"]->DetailEdit) {
			if (!isset($GLOBALS["t06_pinjamantitipan_grid"])) $GLOBALS["t06_pinjamantitipan_grid"] = new ct06_pinjamantitipan_grid(); // get detail page object
			$GLOBALS["t06_pinjamantitipan_grid"]->ValidateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// NoKontrak
			$this->NoKontrak->SetDbValueDef($rsnew, $this->NoKontrak->CurrentValue, "", $this->NoKontrak->ReadOnly);

			// TglKontrak
			$this->TglKontrak->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TglKontrak->CurrentValue, 7), ew_CurrentDate(), $this->TglKontrak->ReadOnly);

			// nasabah_id
			$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, $this->nasabah_id->ReadOnly);

			// Pinjaman
			$this->Pinjaman->SetDbValueDef($rsnew, $this->Pinjaman->CurrentValue, 0, $this->Pinjaman->ReadOnly);

			// LamaAngsuran
			$this->LamaAngsuran->SetDbValueDef($rsnew, $this->LamaAngsuran->CurrentValue, 0, $this->LamaAngsuran->ReadOnly);

			// Bunga
			$this->Bunga->SetDbValueDef($rsnew, $this->Bunga->CurrentValue, 0, $this->Bunga->ReadOnly);

			// Denda
			$this->Denda->SetDbValueDef($rsnew, $this->Denda->CurrentValue, 0, $this->Denda->ReadOnly);

			// DispensasiDenda
			$this->DispensasiDenda->SetDbValueDef($rsnew, $this->DispensasiDenda->CurrentValue, 0, $this->DispensasiDenda->ReadOnly);

			// AngsuranPokok
			$this->AngsuranPokok->SetDbValueDef($rsnew, $this->AngsuranPokok->CurrentValue, 0, $this->AngsuranPokok->ReadOnly);

			// AngsuranBunga
			$this->AngsuranBunga->SetDbValueDef($rsnew, $this->AngsuranBunga->CurrentValue, 0, $this->AngsuranBunga->ReadOnly);

			// AngsuranTotal
			$this->AngsuranTotal->SetDbValueDef($rsnew, $this->AngsuranTotal->CurrentValue, 0, $this->AngsuranTotal->ReadOnly);

			// NoKontrakRefTo
			$this->NoKontrakRefTo->SetDbValueDef($rsnew, $this->NoKontrakRefTo->CurrentValue, NULL, $this->NoKontrakRefTo->ReadOnly);

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

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("t04_angsuran", $DetailTblVar) && $GLOBALS["t04_angsuran"]->DetailEdit) {
						if (!isset($GLOBALS["t04_angsuran_grid"])) $GLOBALS["t04_angsuran_grid"] = new ct04_angsuran_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t04_angsuran"); // Load user level of detail table
						$EditRow = $GLOBALS["t04_angsuran_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($EditRow) {
					if (in_array("t05_pinjamanjaminan", $DetailTblVar) && $GLOBALS["t05_pinjamanjaminan"]->DetailEdit) {
						if (!isset($GLOBALS["t05_pinjamanjaminan_grid"])) $GLOBALS["t05_pinjamanjaminan_grid"] = new ct05_pinjamanjaminan_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t05_pinjamanjaminan"); // Load user level of detail table
						$EditRow = $GLOBALS["t05_pinjamanjaminan_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($EditRow) {
					if (in_array("t06_pinjamantitipan", $DetailTblVar) && $GLOBALS["t06_pinjamantitipan"]->DetailEdit) {
						if (!isset($GLOBALS["t06_pinjamantitipan_grid"])) $GLOBALS["t06_pinjamantitipan_grid"] = new ct06_pinjamantitipan_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t06_pinjamantitipan"); // Load user level of detail table
						$EditRow = $GLOBALS["t06_pinjamantitipan_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
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

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t04_angsuran", $DetailTblVar)) {
				if (!isset($GLOBALS["t04_angsuran_grid"]))
					$GLOBALS["t04_angsuran_grid"] = new ct04_angsuran_grid;
				if ($GLOBALS["t04_angsuran_grid"]->DetailEdit) {
					$GLOBALS["t04_angsuran_grid"]->CurrentMode = "edit";
					$GLOBALS["t04_angsuran_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t04_angsuran_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t04_angsuran_grid"]->setStartRecordNumber(1);
					$GLOBALS["t04_angsuran_grid"]->pinjaman_id->FldIsDetailKey = TRUE;
					$GLOBALS["t04_angsuran_grid"]->pinjaman_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t04_angsuran_grid"]->pinjaman_id->setSessionValue($GLOBALS["t04_angsuran_grid"]->pinjaman_id->CurrentValue);
				}
			}
			if (in_array("t05_pinjamanjaminan", $DetailTblVar)) {
				if (!isset($GLOBALS["t05_pinjamanjaminan_grid"]))
					$GLOBALS["t05_pinjamanjaminan_grid"] = new ct05_pinjamanjaminan_grid;
				if ($GLOBALS["t05_pinjamanjaminan_grid"]->DetailEdit) {
					$GLOBALS["t05_pinjamanjaminan_grid"]->CurrentMode = "edit";
					$GLOBALS["t05_pinjamanjaminan_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t05_pinjamanjaminan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t05_pinjamanjaminan_grid"]->setStartRecordNumber(1);
					$GLOBALS["t05_pinjamanjaminan_grid"]->pinjaman_id->FldIsDetailKey = TRUE;
					$GLOBALS["t05_pinjamanjaminan_grid"]->pinjaman_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t05_pinjamanjaminan_grid"]->pinjaman_id->setSessionValue($GLOBALS["t05_pinjamanjaminan_grid"]->pinjaman_id->CurrentValue);
				}
			}
			if (in_array("t06_pinjamantitipan", $DetailTblVar)) {
				if (!isset($GLOBALS["t06_pinjamantitipan_grid"]))
					$GLOBALS["t06_pinjamantitipan_grid"] = new ct06_pinjamantitipan_grid;
				if ($GLOBALS["t06_pinjamantitipan_grid"]->DetailEdit) {
					$GLOBALS["t06_pinjamantitipan_grid"]->CurrentMode = "edit";
					$GLOBALS["t06_pinjamantitipan_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t06_pinjamantitipan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t06_pinjamantitipan_grid"]->setStartRecordNumber(1);
					$GLOBALS["t06_pinjamantitipan_grid"]->pinjaman_id->FldIsDetailKey = TRUE;
					$GLOBALS["t06_pinjamantitipan_grid"]->pinjaman_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t06_pinjamantitipan_grid"]->pinjaman_id->setSessionValue($GLOBALS["t06_pinjamantitipan_grid"]->pinjaman_id->CurrentValue);
					$GLOBALS["t06_pinjamantitipan_grid"]->nasabah_id->FldIsDetailKey = TRUE;
					$GLOBALS["t06_pinjamantitipan_grid"]->nasabah_id->CurrentValue = $this->nasabah_id->CurrentValue;
					$GLOBALS["t06_pinjamantitipan_grid"]->nasabah_id->setSessionValue($GLOBALS["t06_pinjamantitipan_grid"]->nasabah_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t03_pinjamanlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up detail pages
	function SetupDetailPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add('t04_angsuran');
		$pages->Add('t05_pinjamanjaminan');
		$pages->Add('t06_pinjamantitipan');
		$this->DetailPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_nasabah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Customer` AS `DispFld`, `Pekerjaan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
			$sWhereWrk = "{filter}";
			$this->nasabah_id->LookupFilters = array("dx1" => '`Customer`', "dx2" => '`Pekerjaan`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Customer` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
		//$header = "<form><button class='btn ewButton' name='myFirstBtn' id='myFirstBtn' type='submit' formmethod='post' formaction='xxx.php'>My First Button</button>&nbsp;<button class='btn ewButton' name='mySecondBtn' id='mySecondtBtn' type='submit'>My Second Button</button>&nbsp;<button class='btn ewButton' name='myThirdBtn' id='myThirdBtn' type='submit'>My Third Button</button></form>";

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
if (!isset($t03_pinjaman_edit)) $t03_pinjaman_edit = new ct03_pinjaman_edit();

// Page init
$t03_pinjaman_edit->Page_Init();

// Page main
$t03_pinjaman_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_pinjaman_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft03_pinjamanedit = new ew_Form("ft03_pinjamanedit", "edit");

// Validate form
ft03_pinjamanedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_NoKontrak");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->NoKontrak->FldCaption(), $t03_pinjaman->NoKontrak->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TglKontrak");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->TglKontrak->FldCaption(), $t03_pinjaman->TglKontrak->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TglKontrak");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->TglKontrak->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->nasabah_id->FldCaption(), $t03_pinjaman->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pinjaman");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Pinjaman->FldCaption(), $t03_pinjaman->Pinjaman->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pinjaman");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Pinjaman->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_LamaAngsuran");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->LamaAngsuran->FldCaption(), $t03_pinjaman->LamaAngsuran->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_LamaAngsuran");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->LamaAngsuran->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Bunga->FldCaption(), $t03_pinjaman->Bunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bunga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Bunga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Denda");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Denda->FldCaption(), $t03_pinjaman->Denda->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Denda");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Denda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_DispensasiDenda");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->DispensasiDenda->FldCaption(), $t03_pinjaman->DispensasiDenda->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_DispensasiDenda");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->DispensasiDenda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranPokok");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->AngsuranPokok->FldCaption(), $t03_pinjaman->AngsuranPokok->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranPokok");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->AngsuranPokok->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranBunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->AngsuranBunga->FldCaption(), $t03_pinjaman->AngsuranBunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranBunga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->AngsuranBunga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranTotal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->AngsuranTotal->FldCaption(), $t03_pinjaman->AngsuranTotal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AngsuranTotal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->AngsuranTotal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_NoKontrakRefTo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->NoKontrakRefTo->FldErrMsg()) ?>");

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
ft03_pinjamanedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_pinjamanedit.ValidateRequired = true;
<?php } else { ?>
ft03_pinjamanedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_pinjamanedit.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Customer","x_Pekerjaan","",""],"ParentFields":[],"ChildFields":["t04_angsuran x_pinjamantitipan_id","t05_pinjamanjaminan x_jaminan_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_nasabah"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t03_pinjaman_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t03_pinjaman_edit->ShowPageHeader(); ?>
<?php
$t03_pinjaman_edit->ShowMessage();
?>
<?php if (!$t03_pinjaman_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t03_pinjaman_edit->Pager)) $t03_pinjaman_edit->Pager = new cPrevNextPager($t03_pinjaman_edit->StartRec, $t03_pinjaman_edit->DisplayRecs, $t03_pinjaman_edit->TotalRecs) ?>
<?php if ($t03_pinjaman_edit->Pager->RecordCount > 0 && $t03_pinjaman_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t03_pinjaman_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t03_pinjaman_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t03_pinjaman_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t03_pinjaman_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t03_pinjaman_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t03_pinjaman_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft03_pinjamanedit" id="ft03_pinjamanedit" class="<?php echo $t03_pinjaman_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_pinjaman_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_pinjaman_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_pinjaman">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t03_pinjaman_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t03_pinjaman->NoKontrak->Visible) { // NoKontrak ?>
	<div id="r_NoKontrak" class="form-group">
		<label id="elh_t03_pinjaman_NoKontrak" for="x_NoKontrak" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->NoKontrak->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->NoKontrak->CellAttributes() ?>>
<span id="el_t03_pinjaman_NoKontrak">
<input type="text" data-table="t03_pinjaman" data-field="x_NoKontrak" name="x_NoKontrak" id="x_NoKontrak" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->NoKontrak->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->NoKontrak->EditValue ?>"<?php echo $t03_pinjaman->NoKontrak->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->NoKontrak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->TglKontrak->Visible) { // TglKontrak ?>
	<div id="r_TglKontrak" class="form-group">
		<label id="elh_t03_pinjaman_TglKontrak" for="x_TglKontrak" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->TglKontrak->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->TglKontrak->CellAttributes() ?>>
<span id="el_t03_pinjaman_TglKontrak">
<input type="text" data-table="t03_pinjaman" data-field="x_TglKontrak" data-format="7" name="x_TglKontrak" id="x_TglKontrak" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->TglKontrak->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->TglKontrak->EditValue ?>"<?php echo $t03_pinjaman->TglKontrak->EditAttributes() ?>>
<?php if (!$t03_pinjaman->TglKontrak->ReadOnly && !$t03_pinjaman->TglKontrak->Disabled && !isset($t03_pinjaman->TglKontrak->EditAttrs["readonly"]) && !isset($t03_pinjaman->TglKontrak->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft03_pinjamanedit", "x_TglKontrak", 7);
</script>
<?php } ?>
</span>
<?php echo $t03_pinjaman->TglKontrak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t03_pinjaman_nasabah_id" for="x_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->nasabah_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_nasabah_id">
<?php $t03_pinjaman->nasabah_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t03_pinjaman->nasabah_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_nasabah_id"><?php echo (strval($t03_pinjaman->nasabah_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t03_pinjaman->nasabah_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t03_pinjaman->nasabah_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_nasabah_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t03_pinjaman" data-field="x_nasabah_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t03_pinjaman->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x_nasabah_id" id="x_nasabah_id" value="<?php echo $t03_pinjaman->nasabah_id->CurrentValue ?>"<?php echo $t03_pinjaman->nasabah_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t01_nasabah")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t03_pinjaman->nasabah_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_nasabah_id',url:'t01_nasabahaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_nasabah_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x_nasabah_id" id="s_x_nasabah_id" value="<?php echo $t03_pinjaman->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php echo $t03_pinjaman->nasabah_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
	<div id="r_Pinjaman" class="form-group">
		<label id="elh_t03_pinjaman_Pinjaman" for="x_Pinjaman" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Pinjaman->CellAttributes() ?>>
<span id="el_t03_pinjaman_Pinjaman">
<input type="text" data-table="t03_pinjaman" data-field="x_Pinjaman" name="x_Pinjaman" id="x_Pinjaman" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Pinjaman->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Pinjaman->EditValue ?>"<?php echo $t03_pinjaman->Pinjaman->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Pinjaman->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->LamaAngsuran->Visible) { // LamaAngsuran ?>
	<div id="r_LamaAngsuran" class="form-group">
		<label id="elh_t03_pinjaman_LamaAngsuran" for="x_LamaAngsuran" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->LamaAngsuran->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->LamaAngsuran->CellAttributes() ?>>
<span id="el_t03_pinjaman_LamaAngsuran">
<input type="text" data-table="t03_pinjaman" data-field="x_LamaAngsuran" name="x_LamaAngsuran" id="x_LamaAngsuran" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->LamaAngsuran->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->LamaAngsuran->EditValue ?>"<?php echo $t03_pinjaman->LamaAngsuran->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->LamaAngsuran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Bunga->Visible) { // Bunga ?>
	<div id="r_Bunga" class="form-group">
		<label id="elh_t03_pinjaman_Bunga" for="x_Bunga" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Bunga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Bunga->CellAttributes() ?>>
<span id="el_t03_pinjaman_Bunga">
<input type="text" data-table="t03_pinjaman" data-field="x_Bunga" name="x_Bunga" id="x_Bunga" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Bunga->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Bunga->EditValue ?>"<?php echo $t03_pinjaman->Bunga->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Bunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Denda->Visible) { // Denda ?>
	<div id="r_Denda" class="form-group">
		<label id="elh_t03_pinjaman_Denda" for="x_Denda" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Denda->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Denda->CellAttributes() ?>>
<span id="el_t03_pinjaman_Denda">
<input type="text" data-table="t03_pinjaman" data-field="x_Denda" name="x_Denda" id="x_Denda" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Denda->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Denda->EditValue ?>"<?php echo $t03_pinjaman->Denda->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Denda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->DispensasiDenda->Visible) { // DispensasiDenda ?>
	<div id="r_DispensasiDenda" class="form-group">
		<label id="elh_t03_pinjaman_DispensasiDenda" for="x_DispensasiDenda" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->DispensasiDenda->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->DispensasiDenda->CellAttributes() ?>>
<span id="el_t03_pinjaman_DispensasiDenda">
<input type="text" data-table="t03_pinjaman" data-field="x_DispensasiDenda" name="x_DispensasiDenda" id="x_DispensasiDenda" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->DispensasiDenda->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->DispensasiDenda->EditValue ?>"<?php echo $t03_pinjaman->DispensasiDenda->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->DispensasiDenda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->AngsuranPokok->Visible) { // AngsuranPokok ?>
	<div id="r_AngsuranPokok" class="form-group">
		<label id="elh_t03_pinjaman_AngsuranPokok" for="x_AngsuranPokok" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->AngsuranPokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->AngsuranPokok->CellAttributes() ?>>
<span id="el_t03_pinjaman_AngsuranPokok">
<input type="text" data-table="t03_pinjaman" data-field="x_AngsuranPokok" name="x_AngsuranPokok" id="x_AngsuranPokok" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->AngsuranPokok->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->AngsuranPokok->EditValue ?>"<?php echo $t03_pinjaman->AngsuranPokok->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->AngsuranPokok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->AngsuranBunga->Visible) { // AngsuranBunga ?>
	<div id="r_AngsuranBunga" class="form-group">
		<label id="elh_t03_pinjaman_AngsuranBunga" for="x_AngsuranBunga" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->AngsuranBunga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->AngsuranBunga->CellAttributes() ?>>
<span id="el_t03_pinjaman_AngsuranBunga">
<input type="text" data-table="t03_pinjaman" data-field="x_AngsuranBunga" name="x_AngsuranBunga" id="x_AngsuranBunga" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->AngsuranBunga->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->AngsuranBunga->EditValue ?>"<?php echo $t03_pinjaman->AngsuranBunga->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->AngsuranBunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->AngsuranTotal->Visible) { // AngsuranTotal ?>
	<div id="r_AngsuranTotal" class="form-group">
		<label id="elh_t03_pinjaman_AngsuranTotal" for="x_AngsuranTotal" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->AngsuranTotal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->AngsuranTotal->CellAttributes() ?>>
<span id="el_t03_pinjaman_AngsuranTotal">
<input type="text" data-table="t03_pinjaman" data-field="x_AngsuranTotal" name="x_AngsuranTotal" id="x_AngsuranTotal" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->AngsuranTotal->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->AngsuranTotal->EditValue ?>"<?php echo $t03_pinjaman->AngsuranTotal->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->AngsuranTotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->NoKontrakRefTo->Visible) { // NoKontrakRefTo ?>
	<div id="r_NoKontrakRefTo" class="form-group">
		<label id="elh_t03_pinjaman_NoKontrakRefTo" for="x_NoKontrakRefTo" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->NoKontrakRefTo->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->NoKontrakRefTo->CellAttributes() ?>>
<span id="el_t03_pinjaman_NoKontrakRefTo">
<input type="text" data-table="t03_pinjaman" data-field="x_NoKontrakRefTo" name="x_NoKontrakRefTo" id="x_NoKontrakRefTo" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->NoKontrakRefTo->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->NoKontrakRefTo->EditValue ?>"<?php echo $t03_pinjaman->NoKontrakRefTo->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->NoKontrakRefTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t03_pinjaman" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t03_pinjaman->id->CurrentValue) ?>">
<?php if ($t03_pinjaman->getCurrentDetailTable() <> "") { ?>
<?php
	$t03_pinjaman_edit->DetailPages->ValidKeys = explode(",", $t03_pinjaman->getCurrentDetailTable());
	$FirstActiveDetailTable = $t03_pinjaman_edit->DetailPages->ActivePageIndex();
?>
<div class="ewDetailPages">
<div class="tabbable" id="t03_pinjaman_edit_details">
	<ul class="nav<?php echo $t03_pinjaman_edit->DetailPages->NavStyle() ?>">
<?php
	if (in_array("t04_angsuran", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t04_angsuran->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t04_angsuran") {
			$FirstActiveDetailTable = "t04_angsuran";
		}
?>
		<li<?php echo $t03_pinjaman_edit->DetailPages->TabStyle("t04_angsuran") ?>><a href="#tab_t04_angsuran" data-toggle="tab"><?php echo $Language->TablePhrase("t04_angsuran", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t05_pinjamanjaminan", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t05_pinjamanjaminan->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t05_pinjamanjaminan") {
			$FirstActiveDetailTable = "t05_pinjamanjaminan";
		}
?>
		<li<?php echo $t03_pinjaman_edit->DetailPages->TabStyle("t05_pinjamanjaminan") ?>><a href="#tab_t05_pinjamanjaminan" data-toggle="tab"><?php echo $Language->TablePhrase("t05_pinjamanjaminan", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t06_pinjamantitipan", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t06_pinjamantitipan->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t06_pinjamantitipan") {
			$FirstActiveDetailTable = "t06_pinjamantitipan";
		}
?>
		<li<?php echo $t03_pinjaman_edit->DetailPages->TabStyle("t06_pinjamantitipan") ?>><a href="#tab_t06_pinjamantitipan" data-toggle="tab"><?php echo $Language->TablePhrase("t06_pinjamantitipan", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul>
	<div class="tab-content">
<?php
	if (in_array("t04_angsuran", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t04_angsuran->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t04_angsuran") {
			$FirstActiveDetailTable = "t04_angsuran";
		}
?>
		<div class="tab-pane<?php echo $t03_pinjaman_edit->DetailPages->PageStyle("t04_angsuran") ?>" id="tab_t04_angsuran">
<?php include_once "t04_angsurangrid.php" ?>
		</div>
<?php } ?>
<?php
	if (in_array("t05_pinjamanjaminan", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t05_pinjamanjaminan->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t05_pinjamanjaminan") {
			$FirstActiveDetailTable = "t05_pinjamanjaminan";
		}
?>
		<div class="tab-pane<?php echo $t03_pinjaman_edit->DetailPages->PageStyle("t05_pinjamanjaminan") ?>" id="tab_t05_pinjamanjaminan">
<?php include_once "t05_pinjamanjaminangrid.php" ?>
		</div>
<?php } ?>
<?php
	if (in_array("t06_pinjamantitipan", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t06_pinjamantitipan->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t06_pinjamantitipan") {
			$FirstActiveDetailTable = "t06_pinjamantitipan";
		}
?>
		<div class="tab-pane<?php echo $t03_pinjaman_edit->DetailPages->PageStyle("t06_pinjamantitipan") ?>" id="tab_t06_pinjamantitipan">
<?php include_once "t06_pinjamantitipangrid.php" ?>
		</div>
<?php } ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$t03_pinjaman_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t03_pinjaman_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php if (!isset($t03_pinjaman_edit->Pager)) $t03_pinjaman_edit->Pager = new cPrevNextPager($t03_pinjaman_edit->StartRec, $t03_pinjaman_edit->DisplayRecs, $t03_pinjaman_edit->TotalRecs) ?>
<?php if ($t03_pinjaman_edit->Pager->RecordCount > 0 && $t03_pinjaman_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t03_pinjaman_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t03_pinjaman_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t03_pinjaman_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t03_pinjaman_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t03_pinjaman_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t03_pinjaman_edit->PageUrl() ?>start=<?php echo $t03_pinjaman_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t03_pinjaman_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft03_pinjamanedit.Init();
</script>
<?php
$t03_pinjaman_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t03_pinjaman_edit->Page_Terminate();
?>
