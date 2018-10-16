<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t01_nasabahinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t01_nasabah_addopt = NULL; // Initialize page object first

class ct01_nasabah_addopt extends ct01_nasabah {

	// Page ID
	var $PageID = 'addopt';

	// Project ID
	var $ProjectID = "{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}";

	// Table name
	var $TableName = 't01_nasabah';

	// Page object name
	var $PageObjName = 't01_nasabah_addopt';

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

		// Table object (t01_nasabah)
		if (!isset($GLOBALS["t01_nasabah"]) || get_class($GLOBALS["t01_nasabah"]) == "ct01_nasabah") {
			$GLOBALS["t01_nasabah"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t01_nasabah"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't01_nasabah', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t01_nasabahlist.php"));
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
		$this->Customer->SetVisibility();
		$this->Alamat->SetVisibility();
		$this->Pekerjaan->SetVisibility();
		$this->NoTelpHp->SetVisibility();
		$this->AlamatPekerjaan->SetVisibility();
		$this->NoTelpPekerjaan->SetVisibility();

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

			// Process auto fill for detail table 't02_jaminan'
			if (@$_POST["grid"] == "ft02_jaminangrid") {
				if (!isset($GLOBALS["t02_jaminan_grid"])) $GLOBALS["t02_jaminan_grid"] = new ct02_jaminan_grid;
				$GLOBALS["t02_jaminan_grid"]->Page_Init();
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
		global $EW_EXPORT, $t01_nasabah;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t01_nasabah);
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
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		set_error_handler("ew_ErrorHandler");

		// Set up Breadcrumb
		//$this->SetupBreadcrumb(); // Not used
		// Process form if post back

		if ($objForm->GetValue("a_addopt") <> "") {
			$this->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back
			$this->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$row = array();
					$row["x_id"] = $this->id->DbValue;
					$row["x_Customer"] = $this->Customer->DbValue;
					$row["x_Alamat"] = $this->Alamat->DbValue;
					$row["x_Pekerjaan"] = $this->Pekerjaan->DbValue;
					$row["x_NoTelpHp"] = $this->NoTelpHp->DbValue;
					$row["x_AlamatPekerjaan"] = $this->AlamatPekerjaan->DbValue;
					$row["x_NoTelpPekerjaan"] = $this->NoTelpPekerjaan->DbValue;
					if (!EW_DEBUG_ENABLED && ob_get_length())
						ob_end_clean();
					echo ew_ArrayToJson(array($row));
				} else {
					$this->ShowMessage();
				}
				$this->Page_Terminate();
				exit();
		}

		// Render row
		$this->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->Customer->CurrentValue = NULL;
		$this->Customer->OldValue = $this->Customer->CurrentValue;
		$this->Alamat->CurrentValue = NULL;
		$this->Alamat->OldValue = $this->Alamat->CurrentValue;
		$this->Pekerjaan->CurrentValue = NULL;
		$this->Pekerjaan->OldValue = $this->Pekerjaan->CurrentValue;
		$this->NoTelpHp->CurrentValue = NULL;
		$this->NoTelpHp->OldValue = $this->NoTelpHp->CurrentValue;
		$this->AlamatPekerjaan->CurrentValue = NULL;
		$this->AlamatPekerjaan->OldValue = $this->AlamatPekerjaan->CurrentValue;
		$this->NoTelpPekerjaan->CurrentValue = NULL;
		$this->NoTelpPekerjaan->OldValue = $this->NoTelpPekerjaan->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Customer->FldIsDetailKey) {
			$this->Customer->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Customer")));
		}
		if (!$this->Alamat->FldIsDetailKey) {
			$this->Alamat->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Alamat")));
		}
		if (!$this->Pekerjaan->FldIsDetailKey) {
			$this->Pekerjaan->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Pekerjaan")));
		}
		if (!$this->NoTelpHp->FldIsDetailKey) {
			$this->NoTelpHp->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_NoTelpHp")));
		}
		if (!$this->AlamatPekerjaan->FldIsDetailKey) {
			$this->AlamatPekerjaan->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_AlamatPekerjaan")));
		}
		if (!$this->NoTelpPekerjaan->FldIsDetailKey) {
			$this->NoTelpPekerjaan->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_NoTelpPekerjaan")));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->Customer->CurrentValue = ew_ConvertToUtf8($this->Customer->FormValue);
		$this->Alamat->CurrentValue = ew_ConvertToUtf8($this->Alamat->FormValue);
		$this->Pekerjaan->CurrentValue = ew_ConvertToUtf8($this->Pekerjaan->FormValue);
		$this->NoTelpHp->CurrentValue = ew_ConvertToUtf8($this->NoTelpHp->FormValue);
		$this->AlamatPekerjaan->CurrentValue = ew_ConvertToUtf8($this->AlamatPekerjaan->FormValue);
		$this->NoTelpPekerjaan->CurrentValue = ew_ConvertToUtf8($this->NoTelpPekerjaan->FormValue);
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
		$this->Customer->setDbValue($rs->fields('Customer'));
		$this->Alamat->setDbValue($rs->fields('Alamat'));
		$this->Pekerjaan->setDbValue($rs->fields('Pekerjaan'));
		$this->NoTelpHp->setDbValue($rs->fields('NoTelpHp'));
		$this->AlamatPekerjaan->setDbValue($rs->fields('AlamatPekerjaan'));
		$this->NoTelpPekerjaan->setDbValue($rs->fields('NoTelpPekerjaan'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Customer->DbValue = $row['Customer'];
		$this->Alamat->DbValue = $row['Alamat'];
		$this->Pekerjaan->DbValue = $row['Pekerjaan'];
		$this->NoTelpHp->DbValue = $row['NoTelpHp'];
		$this->AlamatPekerjaan->DbValue = $row['AlamatPekerjaan'];
		$this->NoTelpPekerjaan->DbValue = $row['NoTelpPekerjaan'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// Customer
		// Alamat
		// Pekerjaan
		// NoTelpHp
		// AlamatPekerjaan
		// NoTelpPekerjaan

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Customer
		$this->Customer->ViewValue = $this->Customer->CurrentValue;
		$this->Customer->ViewCustomAttributes = "";

		// Alamat
		$this->Alamat->ViewValue = $this->Alamat->CurrentValue;
		$this->Alamat->ViewCustomAttributes = "";

		// Pekerjaan
		$this->Pekerjaan->ViewValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan->ViewCustomAttributes = "";

		// NoTelpHp
		$this->NoTelpHp->ViewValue = $this->NoTelpHp->CurrentValue;
		$this->NoTelpHp->ViewCustomAttributes = "";

		// AlamatPekerjaan
		$this->AlamatPekerjaan->ViewValue = $this->AlamatPekerjaan->CurrentValue;
		$this->AlamatPekerjaan->ViewCustomAttributes = "";

		// NoTelpPekerjaan
		$this->NoTelpPekerjaan->ViewValue = $this->NoTelpPekerjaan->CurrentValue;
		$this->NoTelpPekerjaan->ViewCustomAttributes = "";

			// Customer
			$this->Customer->LinkCustomAttributes = "";
			$this->Customer->HrefValue = "";
			$this->Customer->TooltipValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";
			$this->Alamat->TooltipValue = "";

			// Pekerjaan
			$this->Pekerjaan->LinkCustomAttributes = "";
			$this->Pekerjaan->HrefValue = "";
			$this->Pekerjaan->TooltipValue = "";

			// NoTelpHp
			$this->NoTelpHp->LinkCustomAttributes = "";
			$this->NoTelpHp->HrefValue = "";
			$this->NoTelpHp->TooltipValue = "";

			// AlamatPekerjaan
			$this->AlamatPekerjaan->LinkCustomAttributes = "";
			$this->AlamatPekerjaan->HrefValue = "";
			$this->AlamatPekerjaan->TooltipValue = "";

			// NoTelpPekerjaan
			$this->NoTelpPekerjaan->LinkCustomAttributes = "";
			$this->NoTelpPekerjaan->HrefValue = "";
			$this->NoTelpPekerjaan->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Customer
			$this->Customer->EditAttrs["class"] = "form-control";
			$this->Customer->EditCustomAttributes = "";
			$this->Customer->EditValue = ew_HtmlEncode($this->Customer->CurrentValue);
			$this->Customer->PlaceHolder = ew_RemoveHtml($this->Customer->FldCaption());

			// Alamat
			$this->Alamat->EditAttrs["class"] = "form-control";
			$this->Alamat->EditCustomAttributes = "";
			$this->Alamat->EditValue = ew_HtmlEncode($this->Alamat->CurrentValue);
			$this->Alamat->PlaceHolder = ew_RemoveHtml($this->Alamat->FldCaption());

			// Pekerjaan
			$this->Pekerjaan->EditAttrs["class"] = "form-control";
			$this->Pekerjaan->EditCustomAttributes = "";
			$this->Pekerjaan->EditValue = ew_HtmlEncode($this->Pekerjaan->CurrentValue);
			$this->Pekerjaan->PlaceHolder = ew_RemoveHtml($this->Pekerjaan->FldCaption());

			// NoTelpHp
			$this->NoTelpHp->EditAttrs["class"] = "form-control";
			$this->NoTelpHp->EditCustomAttributes = "";
			$this->NoTelpHp->EditValue = ew_HtmlEncode($this->NoTelpHp->CurrentValue);
			$this->NoTelpHp->PlaceHolder = ew_RemoveHtml($this->NoTelpHp->FldCaption());

			// AlamatPekerjaan
			$this->AlamatPekerjaan->EditAttrs["class"] = "form-control";
			$this->AlamatPekerjaan->EditCustomAttributes = "";
			$this->AlamatPekerjaan->EditValue = ew_HtmlEncode($this->AlamatPekerjaan->CurrentValue);
			$this->AlamatPekerjaan->PlaceHolder = ew_RemoveHtml($this->AlamatPekerjaan->FldCaption());

			// NoTelpPekerjaan
			$this->NoTelpPekerjaan->EditAttrs["class"] = "form-control";
			$this->NoTelpPekerjaan->EditCustomAttributes = "";
			$this->NoTelpPekerjaan->EditValue = ew_HtmlEncode($this->NoTelpPekerjaan->CurrentValue);
			$this->NoTelpPekerjaan->PlaceHolder = ew_RemoveHtml($this->NoTelpPekerjaan->FldCaption());

			// Add refer script
			// Customer

			$this->Customer->LinkCustomAttributes = "";
			$this->Customer->HrefValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";

			// Pekerjaan
			$this->Pekerjaan->LinkCustomAttributes = "";
			$this->Pekerjaan->HrefValue = "";

			// NoTelpHp
			$this->NoTelpHp->LinkCustomAttributes = "";
			$this->NoTelpHp->HrefValue = "";

			// AlamatPekerjaan
			$this->AlamatPekerjaan->LinkCustomAttributes = "";
			$this->AlamatPekerjaan->HrefValue = "";

			// NoTelpPekerjaan
			$this->NoTelpPekerjaan->LinkCustomAttributes = "";
			$this->NoTelpPekerjaan->HrefValue = "";
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
		if (!$this->Customer->FldIsDetailKey && !is_null($this->Customer->FormValue) && $this->Customer->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Customer->FldCaption(), $this->Customer->ReqErrMsg));
		}
		if (!$this->Alamat->FldIsDetailKey && !is_null($this->Alamat->FormValue) && $this->Alamat->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Alamat->FldCaption(), $this->Alamat->ReqErrMsg));
		}
		if (!$this->Pekerjaan->FldIsDetailKey && !is_null($this->Pekerjaan->FormValue) && $this->Pekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Pekerjaan->FldCaption(), $this->Pekerjaan->ReqErrMsg));
		}
		if (!$this->NoTelpHp->FldIsDetailKey && !is_null($this->NoTelpHp->FormValue) && $this->NoTelpHp->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoTelpHp->FldCaption(), $this->NoTelpHp->ReqErrMsg));
		}
		if (!$this->AlamatPekerjaan->FldIsDetailKey && !is_null($this->AlamatPekerjaan->FormValue) && $this->AlamatPekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AlamatPekerjaan->FldCaption(), $this->AlamatPekerjaan->ReqErrMsg));
		}
		if (!$this->NoTelpPekerjaan->FldIsDetailKey && !is_null($this->NoTelpPekerjaan->FormValue) && $this->NoTelpPekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoTelpPekerjaan->FldCaption(), $this->NoTelpPekerjaan->ReqErrMsg));
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// Customer
		$this->Customer->SetDbValueDef($rsnew, $this->Customer->CurrentValue, "", FALSE);

		// Alamat
		$this->Alamat->SetDbValueDef($rsnew, $this->Alamat->CurrentValue, "", FALSE);

		// Pekerjaan
		$this->Pekerjaan->SetDbValueDef($rsnew, $this->Pekerjaan->CurrentValue, "", FALSE);

		// NoTelpHp
		$this->NoTelpHp->SetDbValueDef($rsnew, $this->NoTelpHp->CurrentValue, "", FALSE);

		// AlamatPekerjaan
		$this->AlamatPekerjaan->SetDbValueDef($rsnew, $this->AlamatPekerjaan->CurrentValue, "", FALSE);

		// NoTelpPekerjaan
		$this->NoTelpPekerjaan->SetDbValueDef($rsnew, $this->NoTelpPekerjaan->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t01_nasabahlist.php"), "", $this->TableVar, TRUE);
		$PageId = "addopt";
		$Breadcrumb->Add("addopt", $PageId, $url);
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

	// Custom validate event
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
if (!isset($t01_nasabah_addopt)) $t01_nasabah_addopt = new ct01_nasabah_addopt();

// Page init
$t01_nasabah_addopt->Page_Init();

// Page main
$t01_nasabah_addopt->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t01_nasabah_addopt->Page_Render();
?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "addopt";
var CurrentForm = ft01_nasabahaddopt = new ew_Form("ft01_nasabahaddopt", "addopt");

// Validate form
ft01_nasabahaddopt.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Customer");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Customer->FldCaption(), $t01_nasabah->Customer->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Alamat");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Alamat->FldCaption(), $t01_nasabah->Alamat->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pekerjaan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Pekerjaan->FldCaption(), $t01_nasabah->Pekerjaan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_NoTelpHp");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->NoTelpHp->FldCaption(), $t01_nasabah->NoTelpHp->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AlamatPekerjaan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->AlamatPekerjaan->FldCaption(), $t01_nasabah->AlamatPekerjaan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_NoTelpPekerjaan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->NoTelpPekerjaan->FldCaption(), $t01_nasabah->NoTelpPekerjaan->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft01_nasabahaddopt.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft01_nasabahaddopt.ValidateRequired = true;
<?php } else { ?>
ft01_nasabahaddopt.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php
$t01_nasabah_addopt->ShowMessage();
?>
<form name="ft01_nasabahaddopt" id="ft01_nasabahaddopt" class="ewForm form-horizontal" action="t01_nasabahaddopt.php" method="post">
<?php if ($t01_nasabah_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t01_nasabah_addopt->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t01_nasabah">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<?php if ($t01_nasabah->Customer->Visible) { // Customer ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_Customer"><?php echo $t01_nasabah->Customer->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t01_nasabah" data-field="x_Customer" name="x_Customer" id="x_Customer" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Customer->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->Customer->EditValue ?>"<?php echo $t01_nasabah->Customer->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t01_nasabah->Alamat->Visible) { // Alamat ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_Alamat"><?php echo $t01_nasabah->Alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<textarea data-table="t01_nasabah" data-field="x_Alamat" name="x_Alamat" id="x_Alamat" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Alamat->getPlaceHolder()) ?>"<?php echo $t01_nasabah->Alamat->EditAttributes() ?>><?php echo $t01_nasabah->Alamat->EditValue ?></textarea>
</div>
	</div>
<?php } ?>	
<?php if ($t01_nasabah->Pekerjaan->Visible) { // Pekerjaan ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_Pekerjaan"><?php echo $t01_nasabah->Pekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t01_nasabah" data-field="x_Pekerjaan" name="x_Pekerjaan" id="x_Pekerjaan" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Pekerjaan->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->Pekerjaan->EditValue ?>"<?php echo $t01_nasabah->Pekerjaan->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t01_nasabah->NoTelpHp->Visible) { // NoTelpHp ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_NoTelpHp"><?php echo $t01_nasabah->NoTelpHp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t01_nasabah" data-field="x_NoTelpHp" name="x_NoTelpHp" id="x_NoTelpHp" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->NoTelpHp->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->NoTelpHp->EditValue ?>"<?php echo $t01_nasabah->NoTelpHp->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t01_nasabah->AlamatPekerjaan->Visible) { // AlamatPekerjaan ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_AlamatPekerjaan"><?php echo $t01_nasabah->AlamatPekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<textarea data-table="t01_nasabah" data-field="x_AlamatPekerjaan" name="x_AlamatPekerjaan" id="x_AlamatPekerjaan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->AlamatPekerjaan->getPlaceHolder()) ?>"<?php echo $t01_nasabah->AlamatPekerjaan->EditAttributes() ?>><?php echo $t01_nasabah->AlamatPekerjaan->EditValue ?></textarea>
</div>
	</div>
<?php } ?>	
<?php if ($t01_nasabah->NoTelpPekerjaan->Visible) { // NoTelpPekerjaan ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_NoTelpPekerjaan"><?php echo $t01_nasabah->NoTelpPekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t01_nasabah" data-field="x_NoTelpPekerjaan" name="x_NoTelpPekerjaan" id="x_NoTelpPekerjaan" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->NoTelpPekerjaan->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->NoTelpPekerjaan->EditValue ?>"<?php echo $t01_nasabah->NoTelpPekerjaan->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
</form>
<script type="text/javascript">
ft01_nasabahaddopt.Init();
</script>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$t01_nasabah_addopt->Page_Terminate();
?>
