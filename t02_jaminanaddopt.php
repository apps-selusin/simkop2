<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t02_jaminaninfo.php" ?>
<?php include_once "t01_nasabahinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t02_jaminan_addopt = NULL; // Initialize page object first

class ct02_jaminan_addopt extends ct02_jaminan {

	// Page ID
	var $PageID = 'addopt';

	// Project ID
	var $ProjectID = "{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}";

	// Table name
	var $TableName = 't02_jaminan';

	// Page object name
	var $PageObjName = 't02_jaminan_addopt';

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

		// Table object (t02_jaminan)
		if (!isset($GLOBALS["t02_jaminan"]) || get_class($GLOBALS["t02_jaminan"]) == "ct02_jaminan") {
			$GLOBALS["t02_jaminan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t02_jaminan"];
		}

		// Table object (t01_nasabah)
		if (!isset($GLOBALS['t01_nasabah'])) $GLOBALS['t01_nasabah'] = new ct01_nasabah();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't02_jaminan', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t02_jaminanlist.php"));
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
		$this->MerkType->SetVisibility();
		$this->NoRangka->SetVisibility();
		$this->NoMesin->SetVisibility();
		$this->Warna->SetVisibility();
		$this->NoPol->SetVisibility();
		$this->Keterangan->SetVisibility();
		$this->AtasNama->SetVisibility();

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
		global $EW_EXPORT, $t02_jaminan;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t02_jaminan);
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
					$row["x_nasabah_id"] = $this->nasabah_id->DbValue;
					$row["x_MerkType"] = $this->MerkType->DbValue;
					$row["x_NoRangka"] = $this->NoRangka->DbValue;
					$row["x_NoMesin"] = $this->NoMesin->DbValue;
					$row["x_Warna"] = $this->Warna->DbValue;
					$row["x_NoPol"] = $this->NoPol->DbValue;
					$row["x_Keterangan"] = $this->Keterangan->DbValue;
					$row["x_AtasNama"] = $this->AtasNama->DbValue;
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
		$this->MerkType->CurrentValue = NULL;
		$this->MerkType->OldValue = $this->MerkType->CurrentValue;
		$this->NoRangka->CurrentValue = NULL;
		$this->NoRangka->OldValue = $this->NoRangka->CurrentValue;
		$this->NoMesin->CurrentValue = NULL;
		$this->NoMesin->OldValue = $this->NoMesin->CurrentValue;
		$this->Warna->CurrentValue = NULL;
		$this->Warna->OldValue = $this->Warna->CurrentValue;
		$this->NoPol->CurrentValue = NULL;
		$this->NoPol->OldValue = $this->NoPol->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->AtasNama->CurrentValue = NULL;
		$this->AtasNama->OldValue = $this->AtasNama->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->MerkType->FldIsDetailKey) {
			$this->MerkType->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_MerkType")));
		}
		if (!$this->NoRangka->FldIsDetailKey) {
			$this->NoRangka->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_NoRangka")));
		}
		if (!$this->NoMesin->FldIsDetailKey) {
			$this->NoMesin->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_NoMesin")));
		}
		if (!$this->Warna->FldIsDetailKey) {
			$this->Warna->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Warna")));
		}
		if (!$this->NoPol->FldIsDetailKey) {
			$this->NoPol->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_NoPol")));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Keterangan")));
		}
		if (!$this->AtasNama->FldIsDetailKey) {
			$this->AtasNama->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_AtasNama")));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->MerkType->CurrentValue = ew_ConvertToUtf8($this->MerkType->FormValue);
		$this->NoRangka->CurrentValue = ew_ConvertToUtf8($this->NoRangka->FormValue);
		$this->NoMesin->CurrentValue = ew_ConvertToUtf8($this->NoMesin->FormValue);
		$this->Warna->CurrentValue = ew_ConvertToUtf8($this->Warna->FormValue);
		$this->NoPol->CurrentValue = ew_ConvertToUtf8($this->NoPol->FormValue);
		$this->Keterangan->CurrentValue = ew_ConvertToUtf8($this->Keterangan->FormValue);
		$this->AtasNama->CurrentValue = ew_ConvertToUtf8($this->AtasNama->FormValue);
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
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->MerkType->setDbValue($rs->fields('MerkType'));
		$this->NoRangka->setDbValue($rs->fields('NoRangka'));
		$this->NoMesin->setDbValue($rs->fields('NoMesin'));
		$this->Warna->setDbValue($rs->fields('Warna'));
		$this->NoPol->setDbValue($rs->fields('NoPol'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->AtasNama->setDbValue($rs->fields('AtasNama'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->MerkType->DbValue = $row['MerkType'];
		$this->NoRangka->DbValue = $row['NoRangka'];
		$this->NoMesin->DbValue = $row['NoMesin'];
		$this->Warna->DbValue = $row['Warna'];
		$this->NoPol->DbValue = $row['NoPol'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->AtasNama->DbValue = $row['AtasNama'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// nasabah_id
		// MerkType
		// NoRangka
		// NoMesin
		// Warna
		// NoPol
		// Keterangan
		// AtasNama

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Customer` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
		$sWhereWrk = "";
		$this->nasabah_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->nasabah_id->ViewValue = $this->nasabah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
			}
		} else {
			$this->nasabah_id->ViewValue = NULL;
		}
		$this->nasabah_id->ViewCustomAttributes = "";

		// MerkType
		$this->MerkType->ViewValue = $this->MerkType->CurrentValue;
		$this->MerkType->ViewCustomAttributes = "";

		// NoRangka
		$this->NoRangka->ViewValue = $this->NoRangka->CurrentValue;
		$this->NoRangka->ViewCustomAttributes = "";

		// NoMesin
		$this->NoMesin->ViewValue = $this->NoMesin->CurrentValue;
		$this->NoMesin->ViewCustomAttributes = "";

		// Warna
		$this->Warna->ViewValue = $this->Warna->CurrentValue;
		$this->Warna->ViewCustomAttributes = "";

		// NoPol
		$this->NoPol->ViewValue = $this->NoPol->CurrentValue;
		$this->NoPol->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// AtasNama
		$this->AtasNama->ViewValue = $this->AtasNama->CurrentValue;
		$this->AtasNama->ViewCustomAttributes = "";

			// MerkType
			$this->MerkType->LinkCustomAttributes = "";
			$this->MerkType->HrefValue = "";
			$this->MerkType->TooltipValue = "";

			// NoRangka
			$this->NoRangka->LinkCustomAttributes = "";
			$this->NoRangka->HrefValue = "";
			$this->NoRangka->TooltipValue = "";

			// NoMesin
			$this->NoMesin->LinkCustomAttributes = "";
			$this->NoMesin->HrefValue = "";
			$this->NoMesin->TooltipValue = "";

			// Warna
			$this->Warna->LinkCustomAttributes = "";
			$this->Warna->HrefValue = "";
			$this->Warna->TooltipValue = "";

			// NoPol
			$this->NoPol->LinkCustomAttributes = "";
			$this->NoPol->HrefValue = "";
			$this->NoPol->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";

			// AtasNama
			$this->AtasNama->LinkCustomAttributes = "";
			$this->AtasNama->HrefValue = "";
			$this->AtasNama->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// MerkType
			$this->MerkType->EditAttrs["class"] = "form-control";
			$this->MerkType->EditCustomAttributes = "";
			$this->MerkType->EditValue = ew_HtmlEncode($this->MerkType->CurrentValue);
			$this->MerkType->PlaceHolder = ew_RemoveHtml($this->MerkType->FldCaption());

			// NoRangka
			$this->NoRangka->EditAttrs["class"] = "form-control";
			$this->NoRangka->EditCustomAttributes = "";
			$this->NoRangka->EditValue = ew_HtmlEncode($this->NoRangka->CurrentValue);
			$this->NoRangka->PlaceHolder = ew_RemoveHtml($this->NoRangka->FldCaption());

			// NoMesin
			$this->NoMesin->EditAttrs["class"] = "form-control";
			$this->NoMesin->EditCustomAttributes = "";
			$this->NoMesin->EditValue = ew_HtmlEncode($this->NoMesin->CurrentValue);
			$this->NoMesin->PlaceHolder = ew_RemoveHtml($this->NoMesin->FldCaption());

			// Warna
			$this->Warna->EditAttrs["class"] = "form-control";
			$this->Warna->EditCustomAttributes = "";
			$this->Warna->EditValue = ew_HtmlEncode($this->Warna->CurrentValue);
			$this->Warna->PlaceHolder = ew_RemoveHtml($this->Warna->FldCaption());

			// NoPol
			$this->NoPol->EditAttrs["class"] = "form-control";
			$this->NoPol->EditCustomAttributes = "";
			$this->NoPol->EditValue = ew_HtmlEncode($this->NoPol->CurrentValue);
			$this->NoPol->PlaceHolder = ew_RemoveHtml($this->NoPol->FldCaption());

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// AtasNama
			$this->AtasNama->EditAttrs["class"] = "form-control";
			$this->AtasNama->EditCustomAttributes = "";
			$this->AtasNama->EditValue = ew_HtmlEncode($this->AtasNama->CurrentValue);
			$this->AtasNama->PlaceHolder = ew_RemoveHtml($this->AtasNama->FldCaption());

			// Add refer script
			// MerkType

			$this->MerkType->LinkCustomAttributes = "";
			$this->MerkType->HrefValue = "";

			// NoRangka
			$this->NoRangka->LinkCustomAttributes = "";
			$this->NoRangka->HrefValue = "";

			// NoMesin
			$this->NoMesin->LinkCustomAttributes = "";
			$this->NoMesin->HrefValue = "";

			// Warna
			$this->Warna->LinkCustomAttributes = "";
			$this->Warna->HrefValue = "";

			// NoPol
			$this->NoPol->LinkCustomAttributes = "";
			$this->NoPol->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// AtasNama
			$this->AtasNama->LinkCustomAttributes = "";
			$this->AtasNama->HrefValue = "";
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
		if (!$this->MerkType->FldIsDetailKey && !is_null($this->MerkType->FormValue) && $this->MerkType->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->MerkType->FldCaption(), $this->MerkType->ReqErrMsg));
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

		// Check referential integrity for master table 't01_nasabah'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_t01_nasabah();
		if ($this->nasabah_id->getSessionValue() <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->nasabah_id->getSessionValue(), "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["t01_nasabah"])) $GLOBALS["t01_nasabah"] = new ct01_nasabah();
			$rsmaster = $GLOBALS["t01_nasabah"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "t01_nasabah", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// MerkType
		$this->MerkType->SetDbValueDef($rsnew, $this->MerkType->CurrentValue, "", FALSE);

		// NoRangka
		$this->NoRangka->SetDbValueDef($rsnew, $this->NoRangka->CurrentValue, NULL, FALSE);

		// NoMesin
		$this->NoMesin->SetDbValueDef($rsnew, $this->NoMesin->CurrentValue, NULL, FALSE);

		// Warna
		$this->Warna->SetDbValueDef($rsnew, $this->Warna->CurrentValue, NULL, FALSE);

		// NoPol
		$this->NoPol->SetDbValueDef($rsnew, $this->NoPol->CurrentValue, NULL, FALSE);

		// Keterangan
		$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, FALSE);

		// AtasNama
		$this->AtasNama->SetDbValueDef($rsnew, $this->AtasNama->CurrentValue, NULL, FALSE);

		// nasabah_id
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t02_jaminanlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t02_jaminan_addopt)) $t02_jaminan_addopt = new ct02_jaminan_addopt();

// Page init
$t02_jaminan_addopt->Page_Init();

// Page main
$t02_jaminan_addopt->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t02_jaminan_addopt->Page_Render();
?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "addopt";
var CurrentForm = ft02_jaminanaddopt = new ew_Form("ft02_jaminanaddopt", "addopt");

// Validate form
ft02_jaminanaddopt.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_MerkType");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_jaminan->MerkType->FldCaption(), $t02_jaminan->MerkType->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft02_jaminanaddopt.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft02_jaminanaddopt.ValidateRequired = true;
<?php } else { ?>
ft02_jaminanaddopt.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php
$t02_jaminan_addopt->ShowMessage();
?>
<form name="ft02_jaminanaddopt" id="ft02_jaminanaddopt" class="ewForm form-horizontal" action="t02_jaminanaddopt.php" method="post">
<?php if ($t02_jaminan_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t02_jaminan_addopt->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t02_jaminan">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<?php if ($t02_jaminan->MerkType->Visible) { // MerkType ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_MerkType"><?php echo $t02_jaminan->MerkType->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t02_jaminan" data-field="x_MerkType" name="x_MerkType" id="x_MerkType" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->MerkType->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->MerkType->EditValue ?>"<?php echo $t02_jaminan->MerkType->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t02_jaminan->NoRangka->Visible) { // NoRangka ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_NoRangka"><?php echo $t02_jaminan->NoRangka->FldCaption() ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t02_jaminan" data-field="x_NoRangka" name="x_NoRangka" id="x_NoRangka" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoRangka->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoRangka->EditValue ?>"<?php echo $t02_jaminan->NoRangka->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t02_jaminan->NoMesin->Visible) { // NoMesin ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_NoMesin"><?php echo $t02_jaminan->NoMesin->FldCaption() ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t02_jaminan" data-field="x_NoMesin" name="x_NoMesin" id="x_NoMesin" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoMesin->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoMesin->EditValue ?>"<?php echo $t02_jaminan->NoMesin->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t02_jaminan->Warna->Visible) { // Warna ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_Warna"><?php echo $t02_jaminan->Warna->FldCaption() ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t02_jaminan" data-field="x_Warna" name="x_Warna" id="x_Warna" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Warna->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Warna->EditValue ?>"<?php echo $t02_jaminan->Warna->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t02_jaminan->NoPol->Visible) { // NoPol ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_NoPol"><?php echo $t02_jaminan->NoPol->FldCaption() ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t02_jaminan" data-field="x_NoPol" name="x_NoPol" id="x_NoPol" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->NoPol->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->NoPol->EditValue ?>"<?php echo $t02_jaminan->NoPol->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
<?php if ($t02_jaminan->Keterangan->Visible) { // Keterangan ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_Keterangan"><?php echo $t02_jaminan->Keterangan->FldCaption() ?></label>
		<div class="col-sm-9">
<textarea data-table="t02_jaminan" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->getPlaceHolder()) ?>"<?php echo $t02_jaminan->Keterangan->EditAttributes() ?>><?php echo $t02_jaminan->Keterangan->EditValue ?></textarea>
</div>
	</div>
<?php } ?>	
<?php if ($t02_jaminan->AtasNama->Visible) { // AtasNama ?>
	<div class="form-group">
		<label class="col-sm-3 control-label ewLabel" for="x_AtasNama"><?php echo $t02_jaminan->AtasNama->FldCaption() ?></label>
		<div class="col-sm-9">
<input type="text" data-table="t02_jaminan" data-field="x_AtasNama" name="x_AtasNama" id="x_AtasNama" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->AtasNama->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->AtasNama->EditValue ?>"<?php echo $t02_jaminan->AtasNama->EditAttributes() ?>>
</div>
	</div>
<?php } ?>	
</form>
<script type="text/javascript">
ft02_jaminanaddopt.Init();
</script>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$t02_jaminan_addopt->Page_Terminate();
?>
