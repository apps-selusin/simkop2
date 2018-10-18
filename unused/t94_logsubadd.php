<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t94_logsubinfo.php" ?>
<?php include_once "t93_logmaininfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t94_logsub_add = NULL; // Initialize page object first

class ct94_logsub_add extends ct94_logsub {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}";

	// Table name
	var $TableName = 't94_logsub';

	// Page object name
	var $PageObjName = 't94_logsub_add';

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

		// Table object (t94_logsub)
		if (!isset($GLOBALS["t94_logsub"]) || get_class($GLOBALS["t94_logsub"]) == "ct94_logsub") {
			$GLOBALS["t94_logsub"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t94_logsub"];
		}

		// Table object (t93_logmain)
		if (!isset($GLOBALS['t93_logmain'])) $GLOBALS['t93_logmain'] = new ct93_logmain();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't94_logsub', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t94_logsublist.php"));
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
		$this->logmain_id->SetVisibility();
		$this->index_->SetVisibility();
		$this->subj_->SetVisibility();

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
		global $EW_EXPORT, $t94_logsub;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t94_logsub);
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

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

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t94_logsublist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t94_logsublist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t94_logsubview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
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
		$this->logmain_id->CurrentValue = NULL;
		$this->logmain_id->OldValue = $this->logmain_id->CurrentValue;
		$this->index_->CurrentValue = NULL;
		$this->index_->OldValue = $this->index_->CurrentValue;
		$this->subj_->CurrentValue = NULL;
		$this->subj_->OldValue = $this->subj_->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->logmain_id->FldIsDetailKey) {
			$this->logmain_id->setFormValue($objForm->GetValue("x_logmain_id"));
		}
		if (!$this->index_->FldIsDetailKey) {
			$this->index_->setFormValue($objForm->GetValue("x_index_"));
		}
		if (!$this->subj_->FldIsDetailKey) {
			$this->subj_->setFormValue($objForm->GetValue("x_subj_"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->logmain_id->CurrentValue = $this->logmain_id->FormValue;
		$this->index_->CurrentValue = $this->index_->FormValue;
		$this->subj_->CurrentValue = $this->subj_->FormValue;
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
		$this->logmain_id->setDbValue($rs->fields('logmain_id'));
		$this->index_->setDbValue($rs->fields('index_'));
		$this->subj_->setDbValue($rs->fields('subj_'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->logmain_id->DbValue = $row['logmain_id'];
		$this->index_->DbValue = $row['index_'];
		$this->subj_->DbValue = $row['subj_'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// logmain_id
		// index_
		// subj_

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// logmain_id
		$this->logmain_id->ViewValue = $this->logmain_id->CurrentValue;
		if (strval($this->logmain_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->logmain_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `subj_` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t93_logmain`";
		$sWhereWrk = "";
		$this->logmain_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->logmain_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->logmain_id->ViewValue = $this->logmain_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->logmain_id->ViewValue = $this->logmain_id->CurrentValue;
			}
		} else {
			$this->logmain_id->ViewValue = NULL;
		}
		$this->logmain_id->ViewCustomAttributes = "";

		// index_
		$this->index_->ViewValue = $this->index_->CurrentValue;
		$this->index_->ViewCustomAttributes = "";

		// subj_
		$this->subj_->ViewValue = $this->subj_->CurrentValue;
		$this->subj_->ViewCustomAttributes = "";

			// logmain_id
			$this->logmain_id->LinkCustomAttributes = "";
			$this->logmain_id->HrefValue = "";
			$this->logmain_id->TooltipValue = "";

			// index_
			$this->index_->LinkCustomAttributes = "";
			$this->index_->HrefValue = "";
			$this->index_->TooltipValue = "";

			// subj_
			$this->subj_->LinkCustomAttributes = "";
			$this->subj_->HrefValue = "";
			$this->subj_->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// logmain_id
			$this->logmain_id->EditAttrs["class"] = "form-control";
			$this->logmain_id->EditCustomAttributes = "";
			if ($this->logmain_id->getSessionValue() <> "") {
				$this->logmain_id->CurrentValue = $this->logmain_id->getSessionValue();
			$this->logmain_id->ViewValue = $this->logmain_id->CurrentValue;
			if (strval($this->logmain_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->logmain_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `subj_` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t93_logmain`";
			$sWhereWrk = "";
			$this->logmain_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->logmain_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->logmain_id->ViewValue = $this->logmain_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->logmain_id->ViewValue = $this->logmain_id->CurrentValue;
				}
			} else {
				$this->logmain_id->ViewValue = NULL;
			}
			$this->logmain_id->ViewCustomAttributes = "";
			} else {
			$this->logmain_id->EditValue = ew_HtmlEncode($this->logmain_id->CurrentValue);
			if (strval($this->logmain_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->logmain_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `subj_` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t93_logmain`";
			$sWhereWrk = "";
			$this->logmain_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->logmain_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->logmain_id->EditValue = $this->logmain_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->logmain_id->EditValue = ew_HtmlEncode($this->logmain_id->CurrentValue);
				}
			} else {
				$this->logmain_id->EditValue = NULL;
			}
			$this->logmain_id->PlaceHolder = ew_RemoveHtml($this->logmain_id->FldCaption());
			}

			// index_
			$this->index_->EditAttrs["class"] = "form-control";
			$this->index_->EditCustomAttributes = "";
			$this->index_->EditValue = ew_HtmlEncode($this->index_->CurrentValue);
			$this->index_->PlaceHolder = ew_RemoveHtml($this->index_->FldCaption());

			// subj_
			$this->subj_->EditAttrs["class"] = "form-control";
			$this->subj_->EditCustomAttributes = "";
			$this->subj_->EditValue = ew_HtmlEncode($this->subj_->CurrentValue);
			$this->subj_->PlaceHolder = ew_RemoveHtml($this->subj_->FldCaption());

			// Add refer script
			// logmain_id

			$this->logmain_id->LinkCustomAttributes = "";
			$this->logmain_id->HrefValue = "";

			// index_
			$this->index_->LinkCustomAttributes = "";
			$this->index_->HrefValue = "";

			// subj_
			$this->subj_->LinkCustomAttributes = "";
			$this->subj_->HrefValue = "";
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
		if (!$this->logmain_id->FldIsDetailKey && !is_null($this->logmain_id->FormValue) && $this->logmain_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->logmain_id->FldCaption(), $this->logmain_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->logmain_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->logmain_id->FldErrMsg());
		}
		if (!$this->index_->FldIsDetailKey && !is_null($this->index_->FormValue) && $this->index_->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->index_->FldCaption(), $this->index_->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->index_->FormValue)) {
			ew_AddMessage($gsFormError, $this->index_->FldErrMsg());
		}
		if (!$this->subj_->FldIsDetailKey && !is_null($this->subj_->FormValue) && $this->subj_->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->subj_->FldCaption(), $this->subj_->ReqErrMsg));
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

		// logmain_id
		$this->logmain_id->SetDbValueDef($rsnew, $this->logmain_id->CurrentValue, 0, FALSE);

		// index_
		$this->index_->SetDbValueDef($rsnew, $this->index_->CurrentValue, 0, FALSE);

		// subj_
		$this->subj_->SetDbValueDef($rsnew, $this->subj_->CurrentValue, "", FALSE);

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
			if ($sMasterTblVar == "t93_logmain") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t93_logmain"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->logmain_id->setQueryStringValue($GLOBALS["t93_logmain"]->id->QueryStringValue);
					$this->logmain_id->setSessionValue($this->logmain_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t93_logmain"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "t93_logmain") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t93_logmain"]->id->setFormValue($_POST["fk_id"]);
					$this->logmain_id->setFormValue($GLOBALS["t93_logmain"]->id->FormValue);
					$this->logmain_id->setSessionValue($this->logmain_id->FormValue);
					if (!is_numeric($GLOBALS["t93_logmain"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t93_logmain") {
				if ($this->logmain_id->CurrentValue == "") $this->logmain_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t94_logsublist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_logmain_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `subj_` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t93_logmain`";
			$sWhereWrk = "{filter}";
			$this->logmain_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->logmain_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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
		case "x_logmain_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `subj_` AS `DispFld` FROM `t93_logmain`";
			$sWhereWrk = "`subj_` LIKE '{query_value}%'";
			$this->logmain_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->logmain_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t94_logsub_add)) $t94_logsub_add = new ct94_logsub_add();

// Page init
$t94_logsub_add->Page_Init();

// Page main
$t94_logsub_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t94_logsub_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft94_logsubadd = new ew_Form("ft94_logsubadd", "add");

// Validate form
ft94_logsubadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_logmain_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t94_logsub->logmain_id->FldCaption(), $t94_logsub->logmain_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_logmain_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t94_logsub->logmain_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_index_");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t94_logsub->index_->FldCaption(), $t94_logsub->index_->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_index_");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t94_logsub->index_->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_subj_");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t94_logsub->subj_->FldCaption(), $t94_logsub->subj_->ReqErrMsg)) ?>");

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
ft94_logsubadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft94_logsubadd.ValidateRequired = true;
<?php } else { ?>
ft94_logsubadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft94_logsubadd.Lists["x_logmain_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_subj_","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t93_logmain"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t94_logsub_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t94_logsub_add->ShowPageHeader(); ?>
<?php
$t94_logsub_add->ShowMessage();
?>
<form name="ft94_logsubadd" id="ft94_logsubadd" class="<?php echo $t94_logsub_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t94_logsub_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t94_logsub_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t94_logsub">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t94_logsub_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t94_logsub->getCurrentMasterTable() == "t93_logmain") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t93_logmain">
<input type="hidden" name="fk_id" value="<?php echo $t94_logsub->logmain_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t94_logsub->logmain_id->Visible) { // logmain_id ?>
	<div id="r_logmain_id" class="form-group">
		<label id="elh_t94_logsub_logmain_id" class="col-sm-2 control-label ewLabel"><?php echo $t94_logsub->logmain_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t94_logsub->logmain_id->CellAttributes() ?>>
<?php if ($t94_logsub->logmain_id->getSessionValue() <> "") { ?>
<span id="el_t94_logsub_logmain_id">
<span<?php echo $t94_logsub->logmain_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t94_logsub->logmain_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_logmain_id" name="x_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t94_logsub_logmain_id">
<?php
$wrkonchange = trim(" " . @$t94_logsub->logmain_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t94_logsub->logmain_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_logmain_id" style="white-space: nowrap; z-index: 8980">
	<input type="text" name="sv_x_logmain_id" id="sv_x_logmain_id" value="<?php echo $t94_logsub->logmain_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->getPlaceHolder()) ?>"<?php echo $t94_logsub->logmain_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t94_logsub" data-field="x_logmain_id" data-value-separator="<?php echo $t94_logsub->logmain_id->DisplayValueSeparatorAttribute() ?>" name="x_logmain_id" id="x_logmain_id" value="<?php echo ew_HtmlEncode($t94_logsub->logmain_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_logmain_id" id="q_x_logmain_id" value="<?php echo $t94_logsub->logmain_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft94_logsubadd.CreateAutoSuggest({"id":"x_logmain_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $t94_logsub->logmain_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t94_logsub->index_->Visible) { // index_ ?>
	<div id="r_index_" class="form-group">
		<label id="elh_t94_logsub_index_" for="x_index_" class="col-sm-2 control-label ewLabel"><?php echo $t94_logsub->index_->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t94_logsub->index_->CellAttributes() ?>>
<span id="el_t94_logsub_index_">
<input type="text" data-table="t94_logsub" data-field="x_index_" name="x_index_" id="x_index_" size="30" placeholder="<?php echo ew_HtmlEncode($t94_logsub->index_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->index_->EditValue ?>"<?php echo $t94_logsub->index_->EditAttributes() ?>>
</span>
<?php echo $t94_logsub->index_->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t94_logsub->subj_->Visible) { // subj_ ?>
	<div id="r_subj_" class="form-group">
		<label id="elh_t94_logsub_subj_" for="x_subj_" class="col-sm-2 control-label ewLabel"><?php echo $t94_logsub->subj_->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t94_logsub->subj_->CellAttributes() ?>>
<span id="el_t94_logsub_subj_">
<input type="text" data-table="t94_logsub" data-field="x_subj_" name="x_subj_" id="x_subj_" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t94_logsub->subj_->getPlaceHolder()) ?>" value="<?php echo $t94_logsub->subj_->EditValue ?>"<?php echo $t94_logsub->subj_->EditAttributes() ?>>
</span>
<?php echo $t94_logsub->subj_->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (!$t94_logsub_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t94_logsub_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft94_logsubadd.Init();
</script>
<?php
$t94_logsub_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t94_logsub_add->Page_Terminate();
?>
