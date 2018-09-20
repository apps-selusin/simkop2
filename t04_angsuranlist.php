<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t04_angsuraninfo.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t04_angsuran_list = NULL; // Initialize page object first

class ct04_angsuran_list extends ct04_angsuran {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}";

	// Table name
	var $TableName = 't04_angsuran';

	// Page object name
	var $PageObjName = 't04_angsuran_list';

	// Grid form hidden field names
	var $FormName = 'ft04_angsuranlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Table object (t04_angsuran)
		if (!isset($GLOBALS["t04_angsuran"]) || get_class($GLOBALS["t04_angsuran"]) == "ct04_angsuran") {
			$GLOBALS["t04_angsuran"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t04_angsuran"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t04_angsuranadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t04_angsurandelete.php";
		$this->MultiUpdateUrl = "t04_angsuranupdate.php";

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS['t03_pinjaman'])) $GLOBALS['t03_pinjaman'] = new ct03_pinjaman();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't04_angsuran', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption ft04_angsuranlistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->pinjaman_id->SetVisibility();
		$this->AngsuranKe->SetVisibility();
		$this->AngsuranTanggal->SetVisibility();
		$this->AngsuranPokok->SetVisibility();
		$this->AngsuranBunga->SetVisibility();
		$this->AngsuranTotal->SetVisibility();
		$this->SisaHutang->SetVisibility();
		$this->TanggalBayar->SetVisibility();
		$this->Terlambat->SetVisibility();
		$this->TotalDenda->SetVisibility();
		$this->Bayar_Titipan->SetVisibility();
		$this->Bayar_Non_Titipan->SetVisibility();
		$this->Bayar_Total->SetVisibility();
		$this->Keterangan->SetVisibility();
		$this->pinjamantitipan_id->SetVisibility();

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

		// Set up master detail parameters
		$this->SetUpMasterParms();

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
		global $EW_EXPORT, $t04_angsuran;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t04_angsuran);
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$bGridUpdate = $this->GridUpdate();
						} else {
							$bGridUpdate = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridUpdate) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "t03_pinjaman") {
			global $t03_pinjaman;
			$rsmaster = $t03_pinjaman->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("t03_pinjamanlist.php"); // Return to master page
			} else {
				$t03_pinjaman->LoadListRowValues($rsmaster);
				$t03_pinjaman->RowType = EW_ROWTYPE_MASTER; // Master row
				$t03_pinjaman->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->SelectRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	//  Exit inline mode
	function ClearInlineMode() {
		$this->setKey("id", ""); // Clear inline edit key
		$this->AngsuranPokok->FormValue = ""; // Clear form value
		$this->AngsuranBunga->FormValue = ""; // Clear form value
		$this->AngsuranTotal->FormValue = ""; // Clear form value
		$this->SisaHutang->FormValue = ""; // Clear form value
		$this->TotalDenda->FormValue = ""; // Clear form value
		$this->Bayar_Titipan->FormValue = ""; // Clear form value
		$this->Bayar_Non_Titipan->FormValue = ""; // Clear form value
		$this->Bayar_Total->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("id", $this->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("id")) <> strval($this->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();
		if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_pinjaman_id") && $objForm->HasValue("o_pinjaman_id") && $this->pinjaman_id->CurrentValue <> $this->pinjaman_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_AngsuranKe") && $objForm->HasValue("o_AngsuranKe") && $this->AngsuranKe->CurrentValue <> $this->AngsuranKe->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_AngsuranTanggal") && $objForm->HasValue("o_AngsuranTanggal") && $this->AngsuranTanggal->CurrentValue <> $this->AngsuranTanggal->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_AngsuranPokok") && $objForm->HasValue("o_AngsuranPokok") && $this->AngsuranPokok->CurrentValue <> $this->AngsuranPokok->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_AngsuranBunga") && $objForm->HasValue("o_AngsuranBunga") && $this->AngsuranBunga->CurrentValue <> $this->AngsuranBunga->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_AngsuranTotal") && $objForm->HasValue("o_AngsuranTotal") && $this->AngsuranTotal->CurrentValue <> $this->AngsuranTotal->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_SisaHutang") && $objForm->HasValue("o_SisaHutang") && $this->SisaHutang->CurrentValue <> $this->SisaHutang->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_TanggalBayar") && $objForm->HasValue("o_TanggalBayar") && $this->TanggalBayar->CurrentValue <> $this->TanggalBayar->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Terlambat") && $objForm->HasValue("o_Terlambat") && $this->Terlambat->CurrentValue <> $this->Terlambat->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_TotalDenda") && $objForm->HasValue("o_TotalDenda") && $this->TotalDenda->CurrentValue <> $this->TotalDenda->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bayar_Titipan") && $objForm->HasValue("o_Bayar_Titipan") && $this->Bayar_Titipan->CurrentValue <> $this->Bayar_Titipan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bayar_Non_Titipan") && $objForm->HasValue("o_Bayar_Non_Titipan") && $this->Bayar_Non_Titipan->CurrentValue <> $this->Bayar_Non_Titipan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bayar_Total") && $objForm->HasValue("o_Bayar_Total") && $this->Bayar_Total->CurrentValue <> $this->Bayar_Total->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Keterangan") && $objForm->HasValue("o_Keterangan") && $this->Keterangan->CurrentValue <> $this->Keterangan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pinjamantitipan_id") && $objForm->HasValue("o_pinjamantitipan_id") && $this->pinjamantitipan_id->CurrentValue <> $this->pinjamantitipan_id->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "ft04_angsuranlistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJSON(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->pinjaman_id->AdvancedSearch->ToJSON(), ","); // Field pinjaman_id
		$sFilterList = ew_Concat($sFilterList, $this->AngsuranKe->AdvancedSearch->ToJSON(), ","); // Field AngsuranKe
		$sFilterList = ew_Concat($sFilterList, $this->AngsuranTanggal->AdvancedSearch->ToJSON(), ","); // Field AngsuranTanggal
		$sFilterList = ew_Concat($sFilterList, $this->AngsuranPokok->AdvancedSearch->ToJSON(), ","); // Field AngsuranPokok
		$sFilterList = ew_Concat($sFilterList, $this->AngsuranBunga->AdvancedSearch->ToJSON(), ","); // Field AngsuranBunga
		$sFilterList = ew_Concat($sFilterList, $this->AngsuranTotal->AdvancedSearch->ToJSON(), ","); // Field AngsuranTotal
		$sFilterList = ew_Concat($sFilterList, $this->SisaHutang->AdvancedSearch->ToJSON(), ","); // Field SisaHutang
		$sFilterList = ew_Concat($sFilterList, $this->TanggalBayar->AdvancedSearch->ToJSON(), ","); // Field TanggalBayar
		$sFilterList = ew_Concat($sFilterList, $this->Terlambat->AdvancedSearch->ToJSON(), ","); // Field Terlambat
		$sFilterList = ew_Concat($sFilterList, $this->TotalDenda->AdvancedSearch->ToJSON(), ","); // Field TotalDenda
		$sFilterList = ew_Concat($sFilterList, $this->Bayar_Titipan->AdvancedSearch->ToJSON(), ","); // Field Bayar_Titipan
		$sFilterList = ew_Concat($sFilterList, $this->Bayar_Non_Titipan->AdvancedSearch->ToJSON(), ","); // Field Bayar_Non_Titipan
		$sFilterList = ew_Concat($sFilterList, $this->Bayar_Total->AdvancedSearch->ToJSON(), ","); // Field Bayar_Total
		$sFilterList = ew_Concat($sFilterList, $this->Keterangan->AdvancedSearch->ToJSON(), ","); // Field Keterangan
		$sFilterList = ew_Concat($sFilterList, $this->pinjamantitipan_id->AdvancedSearch->ToJSON(), ","); // Field pinjamantitipan_id
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = ew_StripSlashes(@$_POST["filters"]);
			$UserProfile->SetSearchFilters(CurrentUserName(), "ft04_angsuranlistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ew_StripSlashes(@$_POST["filter"]), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->Save();

		// Field pinjaman_id
		$this->pinjaman_id->AdvancedSearch->SearchValue = @$filter["x_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchOperator = @$filter["z_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchCondition = @$filter["v_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchValue2 = @$filter["y_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchOperator2 = @$filter["w_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->Save();

		// Field AngsuranKe
		$this->AngsuranKe->AdvancedSearch->SearchValue = @$filter["x_AngsuranKe"];
		$this->AngsuranKe->AdvancedSearch->SearchOperator = @$filter["z_AngsuranKe"];
		$this->AngsuranKe->AdvancedSearch->SearchCondition = @$filter["v_AngsuranKe"];
		$this->AngsuranKe->AdvancedSearch->SearchValue2 = @$filter["y_AngsuranKe"];
		$this->AngsuranKe->AdvancedSearch->SearchOperator2 = @$filter["w_AngsuranKe"];
		$this->AngsuranKe->AdvancedSearch->Save();

		// Field AngsuranTanggal
		$this->AngsuranTanggal->AdvancedSearch->SearchValue = @$filter["x_AngsuranTanggal"];
		$this->AngsuranTanggal->AdvancedSearch->SearchOperator = @$filter["z_AngsuranTanggal"];
		$this->AngsuranTanggal->AdvancedSearch->SearchCondition = @$filter["v_AngsuranTanggal"];
		$this->AngsuranTanggal->AdvancedSearch->SearchValue2 = @$filter["y_AngsuranTanggal"];
		$this->AngsuranTanggal->AdvancedSearch->SearchOperator2 = @$filter["w_AngsuranTanggal"];
		$this->AngsuranTanggal->AdvancedSearch->Save();

		// Field AngsuranPokok
		$this->AngsuranPokok->AdvancedSearch->SearchValue = @$filter["x_AngsuranPokok"];
		$this->AngsuranPokok->AdvancedSearch->SearchOperator = @$filter["z_AngsuranPokok"];
		$this->AngsuranPokok->AdvancedSearch->SearchCondition = @$filter["v_AngsuranPokok"];
		$this->AngsuranPokok->AdvancedSearch->SearchValue2 = @$filter["y_AngsuranPokok"];
		$this->AngsuranPokok->AdvancedSearch->SearchOperator2 = @$filter["w_AngsuranPokok"];
		$this->AngsuranPokok->AdvancedSearch->Save();

		// Field AngsuranBunga
		$this->AngsuranBunga->AdvancedSearch->SearchValue = @$filter["x_AngsuranBunga"];
		$this->AngsuranBunga->AdvancedSearch->SearchOperator = @$filter["z_AngsuranBunga"];
		$this->AngsuranBunga->AdvancedSearch->SearchCondition = @$filter["v_AngsuranBunga"];
		$this->AngsuranBunga->AdvancedSearch->SearchValue2 = @$filter["y_AngsuranBunga"];
		$this->AngsuranBunga->AdvancedSearch->SearchOperator2 = @$filter["w_AngsuranBunga"];
		$this->AngsuranBunga->AdvancedSearch->Save();

		// Field AngsuranTotal
		$this->AngsuranTotal->AdvancedSearch->SearchValue = @$filter["x_AngsuranTotal"];
		$this->AngsuranTotal->AdvancedSearch->SearchOperator = @$filter["z_AngsuranTotal"];
		$this->AngsuranTotal->AdvancedSearch->SearchCondition = @$filter["v_AngsuranTotal"];
		$this->AngsuranTotal->AdvancedSearch->SearchValue2 = @$filter["y_AngsuranTotal"];
		$this->AngsuranTotal->AdvancedSearch->SearchOperator2 = @$filter["w_AngsuranTotal"];
		$this->AngsuranTotal->AdvancedSearch->Save();

		// Field SisaHutang
		$this->SisaHutang->AdvancedSearch->SearchValue = @$filter["x_SisaHutang"];
		$this->SisaHutang->AdvancedSearch->SearchOperator = @$filter["z_SisaHutang"];
		$this->SisaHutang->AdvancedSearch->SearchCondition = @$filter["v_SisaHutang"];
		$this->SisaHutang->AdvancedSearch->SearchValue2 = @$filter["y_SisaHutang"];
		$this->SisaHutang->AdvancedSearch->SearchOperator2 = @$filter["w_SisaHutang"];
		$this->SisaHutang->AdvancedSearch->Save();

		// Field TanggalBayar
		$this->TanggalBayar->AdvancedSearch->SearchValue = @$filter["x_TanggalBayar"];
		$this->TanggalBayar->AdvancedSearch->SearchOperator = @$filter["z_TanggalBayar"];
		$this->TanggalBayar->AdvancedSearch->SearchCondition = @$filter["v_TanggalBayar"];
		$this->TanggalBayar->AdvancedSearch->SearchValue2 = @$filter["y_TanggalBayar"];
		$this->TanggalBayar->AdvancedSearch->SearchOperator2 = @$filter["w_TanggalBayar"];
		$this->TanggalBayar->AdvancedSearch->Save();

		// Field Terlambat
		$this->Terlambat->AdvancedSearch->SearchValue = @$filter["x_Terlambat"];
		$this->Terlambat->AdvancedSearch->SearchOperator = @$filter["z_Terlambat"];
		$this->Terlambat->AdvancedSearch->SearchCondition = @$filter["v_Terlambat"];
		$this->Terlambat->AdvancedSearch->SearchValue2 = @$filter["y_Terlambat"];
		$this->Terlambat->AdvancedSearch->SearchOperator2 = @$filter["w_Terlambat"];
		$this->Terlambat->AdvancedSearch->Save();

		// Field TotalDenda
		$this->TotalDenda->AdvancedSearch->SearchValue = @$filter["x_TotalDenda"];
		$this->TotalDenda->AdvancedSearch->SearchOperator = @$filter["z_TotalDenda"];
		$this->TotalDenda->AdvancedSearch->SearchCondition = @$filter["v_TotalDenda"];
		$this->TotalDenda->AdvancedSearch->SearchValue2 = @$filter["y_TotalDenda"];
		$this->TotalDenda->AdvancedSearch->SearchOperator2 = @$filter["w_TotalDenda"];
		$this->TotalDenda->AdvancedSearch->Save();

		// Field Bayar_Titipan
		$this->Bayar_Titipan->AdvancedSearch->SearchValue = @$filter["x_Bayar_Titipan"];
		$this->Bayar_Titipan->AdvancedSearch->SearchOperator = @$filter["z_Bayar_Titipan"];
		$this->Bayar_Titipan->AdvancedSearch->SearchCondition = @$filter["v_Bayar_Titipan"];
		$this->Bayar_Titipan->AdvancedSearch->SearchValue2 = @$filter["y_Bayar_Titipan"];
		$this->Bayar_Titipan->AdvancedSearch->SearchOperator2 = @$filter["w_Bayar_Titipan"];
		$this->Bayar_Titipan->AdvancedSearch->Save();

		// Field Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->AdvancedSearch->SearchValue = @$filter["x_Bayar_Non_Titipan"];
		$this->Bayar_Non_Titipan->AdvancedSearch->SearchOperator = @$filter["z_Bayar_Non_Titipan"];
		$this->Bayar_Non_Titipan->AdvancedSearch->SearchCondition = @$filter["v_Bayar_Non_Titipan"];
		$this->Bayar_Non_Titipan->AdvancedSearch->SearchValue2 = @$filter["y_Bayar_Non_Titipan"];
		$this->Bayar_Non_Titipan->AdvancedSearch->SearchOperator2 = @$filter["w_Bayar_Non_Titipan"];
		$this->Bayar_Non_Titipan->AdvancedSearch->Save();

		// Field Bayar_Total
		$this->Bayar_Total->AdvancedSearch->SearchValue = @$filter["x_Bayar_Total"];
		$this->Bayar_Total->AdvancedSearch->SearchOperator = @$filter["z_Bayar_Total"];
		$this->Bayar_Total->AdvancedSearch->SearchCondition = @$filter["v_Bayar_Total"];
		$this->Bayar_Total->AdvancedSearch->SearchValue2 = @$filter["y_Bayar_Total"];
		$this->Bayar_Total->AdvancedSearch->SearchOperator2 = @$filter["w_Bayar_Total"];
		$this->Bayar_Total->AdvancedSearch->Save();

		// Field Keterangan
		$this->Keterangan->AdvancedSearch->SearchValue = @$filter["x_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchOperator = @$filter["z_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchCondition = @$filter["v_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchValue2 = @$filter["y_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchOperator2 = @$filter["w_Keterangan"];
		$this->Keterangan->AdvancedSearch->Save();

		// Field pinjamantitipan_id
		$this->pinjamantitipan_id->AdvancedSearch->SearchValue = @$filter["x_pinjamantitipan_id"];
		$this->pinjamantitipan_id->AdvancedSearch->SearchOperator = @$filter["z_pinjamantitipan_id"];
		$this->pinjamantitipan_id->AdvancedSearch->SearchCondition = @$filter["v_pinjamantitipan_id"];
		$this->pinjamantitipan_id->AdvancedSearch->SearchValue2 = @$filter["y_pinjamantitipan_id"];
		$this->pinjamantitipan_id->AdvancedSearch->SearchOperator2 = @$filter["w_pinjamantitipan_id"];
		$this->pinjamantitipan_id->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->Keterangan, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .=  "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "=") {
				$ar = array();

				// Match quoted keywords (i.e.: "...")
				if (preg_match_all('/"([^"]*)"/i', $sSearch, $matches, PREG_SET_ORDER)) {
					foreach ($matches as $match) {
						$p = strpos($sSearch, $match[0]);
						$str = substr($sSearch, 0, $p);
						$sSearch = substr($sSearch, $p + strlen($match[0]));
						if (strlen(trim($str)) > 0)
							$ar = array_merge($ar, explode(" ", trim($str)));
						$ar[] = $match[1]; // Save quoted keyword
					}
				}

				// Match individual keywords
				if (strlen(trim($sSearch)) > 0)
					$ar = array_merge($ar, explode(" ", trim($sSearch)));

				// Search keyword in any fields
				if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
					foreach ($ar as $sKeyword) {
						if ($sKeyword <> "") {
							if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
							$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
						}
					}
				} else {
					$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL(array($sSearch), $sSearchType);
			}
			if (!$Default) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->pinjaman_id, $bCtrl); // pinjaman_id
			$this->UpdateSort($this->AngsuranKe, $bCtrl); // AngsuranKe
			$this->UpdateSort($this->AngsuranTanggal, $bCtrl); // AngsuranTanggal
			$this->UpdateSort($this->AngsuranPokok, $bCtrl); // AngsuranPokok
			$this->UpdateSort($this->AngsuranBunga, $bCtrl); // AngsuranBunga
			$this->UpdateSort($this->AngsuranTotal, $bCtrl); // AngsuranTotal
			$this->UpdateSort($this->SisaHutang, $bCtrl); // SisaHutang
			$this->UpdateSort($this->TanggalBayar, $bCtrl); // TanggalBayar
			$this->UpdateSort($this->Terlambat, $bCtrl); // Terlambat
			$this->UpdateSort($this->TotalDenda, $bCtrl); // TotalDenda
			$this->UpdateSort($this->Bayar_Titipan, $bCtrl); // Bayar_Titipan
			$this->UpdateSort($this->Bayar_Non_Titipan, $bCtrl); // Bayar_Non_Titipan
			$this->UpdateSort($this->Bayar_Total, $bCtrl); // Bayar_Total
			$this->UpdateSort($this->Keterangan, $bCtrl); // Keterangan
			$this->UpdateSort($this->pinjamantitipan_id, $bCtrl); // pinjamantitipan_id
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->pinjaman_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->pinjaman_id->setSort("");
				$this->AngsuranKe->setSort("");
				$this->AngsuranTanggal->setSort("");
				$this->AngsuranPokok->setSort("");
				$this->AngsuranBunga->setSort("");
				$this->AngsuranTotal->setSort("");
				$this->SisaHutang->setSort("");
				$this->TanggalBayar->setSort("");
				$this->Terlambat->setSort("");
				$this->TotalDenda->setSort("");
				$this->Bayar_Titipan->setSort("");
				$this->Bayar_Non_Titipan->setSort("");
				$this->Bayar_Total->setSort("");
				$this->Keterangan->setSort("");
				$this->pinjamantitipan_id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssStyle = "white-space: nowrap;";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_GetHashUrl($this->PageName(), $this->PageObjName . "_row_" . $this->RowCnt) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\">";
			return;
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_GetHashUrl($this->InlineEditUrl, $this->PageObjName . "_row_" . $this->RowCnt)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft04_angsuranlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft04_angsuranlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft04_angsuranlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = FALSE;
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" title=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft04_angsuranlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load default values
	function LoadDefaultValues() {
		$this->pinjaman_id->CurrentValue = NULL;
		$this->pinjaman_id->OldValue = $this->pinjaman_id->CurrentValue;
		$this->AngsuranKe->CurrentValue = NULL;
		$this->AngsuranKe->OldValue = $this->AngsuranKe->CurrentValue;
		$this->AngsuranTanggal->CurrentValue = NULL;
		$this->AngsuranTanggal->OldValue = $this->AngsuranTanggal->CurrentValue;
		$this->AngsuranPokok->CurrentValue = NULL;
		$this->AngsuranPokok->OldValue = $this->AngsuranPokok->CurrentValue;
		$this->AngsuranBunga->CurrentValue = NULL;
		$this->AngsuranBunga->OldValue = $this->AngsuranBunga->CurrentValue;
		$this->AngsuranTotal->CurrentValue = NULL;
		$this->AngsuranTotal->OldValue = $this->AngsuranTotal->CurrentValue;
		$this->SisaHutang->CurrentValue = NULL;
		$this->SisaHutang->OldValue = $this->SisaHutang->CurrentValue;
		$this->TanggalBayar->CurrentValue = NULL;
		$this->TanggalBayar->OldValue = $this->TanggalBayar->CurrentValue;
		$this->Terlambat->CurrentValue = NULL;
		$this->Terlambat->OldValue = $this->Terlambat->CurrentValue;
		$this->TotalDenda->CurrentValue = NULL;
		$this->TotalDenda->OldValue = $this->TotalDenda->CurrentValue;
		$this->Bayar_Titipan->CurrentValue = NULL;
		$this->Bayar_Titipan->OldValue = $this->Bayar_Titipan->CurrentValue;
		$this->Bayar_Non_Titipan->CurrentValue = NULL;
		$this->Bayar_Non_Titipan->OldValue = $this->Bayar_Non_Titipan->CurrentValue;
		$this->Bayar_Total->CurrentValue = NULL;
		$this->Bayar_Total->OldValue = $this->Bayar_Total->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->pinjamantitipan_id->CurrentValue = NULL;
		$this->pinjamantitipan_id->OldValue = $this->pinjamantitipan_id->CurrentValue;
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pinjaman_id->FldIsDetailKey) {
			$this->pinjaman_id->setFormValue($objForm->GetValue("x_pinjaman_id"));
		}
		if (!$this->AngsuranKe->FldIsDetailKey) {
			$this->AngsuranKe->setFormValue($objForm->GetValue("x_AngsuranKe"));
		}
		if (!$this->AngsuranTanggal->FldIsDetailKey) {
			$this->AngsuranTanggal->setFormValue($objForm->GetValue("x_AngsuranTanggal"));
			$this->AngsuranTanggal->CurrentValue = ew_UnFormatDateTime($this->AngsuranTanggal->CurrentValue, 7);
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
		if (!$this->SisaHutang->FldIsDetailKey) {
			$this->SisaHutang->setFormValue($objForm->GetValue("x_SisaHutang"));
		}
		if (!$this->TanggalBayar->FldIsDetailKey) {
			$this->TanggalBayar->setFormValue($objForm->GetValue("x_TanggalBayar"));
			$this->TanggalBayar->CurrentValue = ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 7);
		}
		if (!$this->Terlambat->FldIsDetailKey) {
			$this->Terlambat->setFormValue($objForm->GetValue("x_Terlambat"));
		}
		if (!$this->TotalDenda->FldIsDetailKey) {
			$this->TotalDenda->setFormValue($objForm->GetValue("x_TotalDenda"));
		}
		if (!$this->Bayar_Titipan->FldIsDetailKey) {
			$this->Bayar_Titipan->setFormValue($objForm->GetValue("x_Bayar_Titipan"));
		}
		if (!$this->Bayar_Non_Titipan->FldIsDetailKey) {
			$this->Bayar_Non_Titipan->setFormValue($objForm->GetValue("x_Bayar_Non_Titipan"));
		}
		if (!$this->Bayar_Total->FldIsDetailKey) {
			$this->Bayar_Total->setFormValue($objForm->GetValue("x_Bayar_Total"));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$this->pinjamantitipan_id->FldIsDetailKey) {
			$this->pinjamantitipan_id->setFormValue($objForm->GetValue("x_pinjamantitipan_id"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->pinjaman_id->CurrentValue = $this->pinjaman_id->FormValue;
		$this->AngsuranKe->CurrentValue = $this->AngsuranKe->FormValue;
		$this->AngsuranTanggal->CurrentValue = $this->AngsuranTanggal->FormValue;
		$this->AngsuranTanggal->CurrentValue = ew_UnFormatDateTime($this->AngsuranTanggal->CurrentValue, 7);
		$this->AngsuranPokok->CurrentValue = $this->AngsuranPokok->FormValue;
		$this->AngsuranBunga->CurrentValue = $this->AngsuranBunga->FormValue;
		$this->AngsuranTotal->CurrentValue = $this->AngsuranTotal->FormValue;
		$this->SisaHutang->CurrentValue = $this->SisaHutang->FormValue;
		$this->TanggalBayar->CurrentValue = $this->TanggalBayar->FormValue;
		$this->TanggalBayar->CurrentValue = ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 7);
		$this->Terlambat->CurrentValue = $this->Terlambat->FormValue;
		$this->TotalDenda->CurrentValue = $this->TotalDenda->FormValue;
		$this->Bayar_Titipan->CurrentValue = $this->Bayar_Titipan->FormValue;
		$this->Bayar_Non_Titipan->CurrentValue = $this->Bayar_Non_Titipan->FormValue;
		$this->Bayar_Total->CurrentValue = $this->Bayar_Total->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->pinjamantitipan_id->CurrentValue = $this->pinjamantitipan_id->FormValue;
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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->pinjaman_id->DbValue = $row['pinjaman_id'];
		$this->AngsuranKe->DbValue = $row['AngsuranKe'];
		$this->AngsuranTanggal->DbValue = $row['AngsuranTanggal'];
		$this->AngsuranPokok->DbValue = $row['AngsuranPokok'];
		$this->AngsuranBunga->DbValue = $row['AngsuranBunga'];
		$this->AngsuranTotal->DbValue = $row['AngsuranTotal'];
		$this->SisaHutang->DbValue = $row['SisaHutang'];
		$this->TanggalBayar->DbValue = $row['TanggalBayar'];
		$this->Terlambat->DbValue = $row['Terlambat'];
		$this->TotalDenda->DbValue = $row['TotalDenda'];
		$this->Bayar_Titipan->DbValue = $row['Bayar_Titipan'];
		$this->Bayar_Non_Titipan->DbValue = $row['Bayar_Non_Titipan'];
		$this->Bayar_Total->DbValue = $row['Bayar_Total'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->pinjamantitipan_id->DbValue = $row['pinjamantitipan_id'];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->AngsuranPokok->FormValue == $this->AngsuranPokok->CurrentValue && is_numeric(ew_StrToFloat($this->AngsuranPokok->CurrentValue)))
			$this->AngsuranPokok->CurrentValue = ew_StrToFloat($this->AngsuranPokok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AngsuranBunga->FormValue == $this->AngsuranBunga->CurrentValue && is_numeric(ew_StrToFloat($this->AngsuranBunga->CurrentValue)))
			$this->AngsuranBunga->CurrentValue = ew_StrToFloat($this->AngsuranBunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AngsuranTotal->FormValue == $this->AngsuranTotal->CurrentValue && is_numeric(ew_StrToFloat($this->AngsuranTotal->CurrentValue)))
			$this->AngsuranTotal->CurrentValue = ew_StrToFloat($this->AngsuranTotal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SisaHutang->FormValue == $this->SisaHutang->CurrentValue && is_numeric(ew_StrToFloat($this->SisaHutang->CurrentValue)))
			$this->SisaHutang->CurrentValue = ew_StrToFloat($this->SisaHutang->CurrentValue);

		// Convert decimal values if posted back
		if ($this->TotalDenda->FormValue == $this->TotalDenda->CurrentValue && is_numeric(ew_StrToFloat($this->TotalDenda->CurrentValue)))
			$this->TotalDenda->CurrentValue = ew_StrToFloat($this->TotalDenda->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Titipan->FormValue == $this->Bayar_Titipan->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Titipan->CurrentValue)))
			$this->Bayar_Titipan->CurrentValue = ew_StrToFloat($this->Bayar_Titipan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Non_Titipan->FormValue == $this->Bayar_Non_Titipan->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Non_Titipan->CurrentValue)))
			$this->Bayar_Non_Titipan->CurrentValue = ew_StrToFloat($this->Bayar_Non_Titipan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Total->FormValue == $this->Bayar_Total->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Total->CurrentValue)))
			$this->Bayar_Total->CurrentValue = ew_StrToFloat($this->Bayar_Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		$sSqlWrk = "SELECT `id`, `Sisa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_pinjamantitipan`";
		$sWhereWrk = "";
		$this->pinjamantitipan_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pinjamantitipan_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatNumber($rswrk->fields('DispFld'), 2, -2, -2, -2);
				$this->pinjamantitipan_id->ViewValue = $this->pinjamantitipan_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pinjamantitipan_id->ViewValue = $this->pinjamantitipan_id->CurrentValue;
			}
		} else {
			$this->pinjamantitipan_id->ViewValue = NULL;
		}
		$this->pinjamantitipan_id->ViewCustomAttributes = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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
			$this->AngsuranKe->EditValue = ew_HtmlEncode($this->AngsuranKe->CurrentValue);
			$this->AngsuranKe->PlaceHolder = ew_RemoveHtml($this->AngsuranKe->FldCaption());

			// AngsuranTanggal
			$this->AngsuranTanggal->EditAttrs["class"] = "form-control";
			$this->AngsuranTanggal->EditCustomAttributes = "";
			$this->AngsuranTanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->AngsuranTanggal->CurrentValue, 7));
			$this->AngsuranTanggal->PlaceHolder = ew_RemoveHtml($this->AngsuranTanggal->FldCaption());

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

			// SisaHutang
			$this->SisaHutang->EditAttrs["class"] = "form-control";
			$this->SisaHutang->EditCustomAttributes = "";
			$this->SisaHutang->EditValue = ew_HtmlEncode($this->SisaHutang->CurrentValue);
			$this->SisaHutang->PlaceHolder = ew_RemoveHtml($this->SisaHutang->FldCaption());
			if (strval($this->SisaHutang->EditValue) <> "" && is_numeric($this->SisaHutang->EditValue)) $this->SisaHutang->EditValue = ew_FormatNumber($this->SisaHutang->EditValue, -2, -2, -2, -2);

			// TanggalBayar
			$this->TanggalBayar->EditAttrs["class"] = "form-control";
			$this->TanggalBayar->EditCustomAttributes = "style='width: 115px;'";
			$this->TanggalBayar->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TanggalBayar->CurrentValue, 7));
			$this->TanggalBayar->PlaceHolder = ew_RemoveHtml($this->TanggalBayar->FldCaption());

			// Terlambat
			$this->Terlambat->EditAttrs["class"] = "form-control";
			$this->Terlambat->EditCustomAttributes = "";
			$this->Terlambat->EditValue = ew_HtmlEncode($this->Terlambat->CurrentValue);
			$this->Terlambat->PlaceHolder = ew_RemoveHtml($this->Terlambat->FldCaption());

			// TotalDenda
			$this->TotalDenda->EditAttrs["class"] = "form-control";
			$this->TotalDenda->EditCustomAttributes = "";
			$this->TotalDenda->EditValue = ew_HtmlEncode($this->TotalDenda->CurrentValue);
			$this->TotalDenda->PlaceHolder = ew_RemoveHtml($this->TotalDenda->FldCaption());
			if (strval($this->TotalDenda->EditValue) <> "" && is_numeric($this->TotalDenda->EditValue)) $this->TotalDenda->EditValue = ew_FormatNumber($this->TotalDenda->EditValue, -2, -2, -2, -2);

			// Bayar_Titipan
			$this->Bayar_Titipan->EditAttrs["class"] = "form-control";
			$this->Bayar_Titipan->EditCustomAttributes = "";
			$this->Bayar_Titipan->EditValue = ew_HtmlEncode($this->Bayar_Titipan->CurrentValue);
			$this->Bayar_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Titipan->FldCaption());
			if (strval($this->Bayar_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Titipan->EditValue)) $this->Bayar_Titipan->EditValue = ew_FormatNumber($this->Bayar_Titipan->EditValue, -2, -2, -2, -2);

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->EditAttrs["class"] = "form-control";
			$this->Bayar_Non_Titipan->EditCustomAttributes = "";
			$this->Bayar_Non_Titipan->EditValue = ew_HtmlEncode($this->Bayar_Non_Titipan->CurrentValue);
			$this->Bayar_Non_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Non_Titipan->FldCaption());
			if (strval($this->Bayar_Non_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Non_Titipan->EditValue)) $this->Bayar_Non_Titipan->EditValue = ew_FormatNumber($this->Bayar_Non_Titipan->EditValue, -2, -2, -2, -2);

			// Bayar_Total
			$this->Bayar_Total->EditAttrs["class"] = "form-control";
			$this->Bayar_Total->EditCustomAttributes = "";
			$this->Bayar_Total->EditValue = ew_HtmlEncode($this->Bayar_Total->CurrentValue);
			$this->Bayar_Total->PlaceHolder = ew_RemoveHtml($this->Bayar_Total->FldCaption());
			if (strval($this->Bayar_Total->EditValue) <> "" && is_numeric($this->Bayar_Total->EditValue)) $this->Bayar_Total->EditValue = ew_FormatNumber($this->Bayar_Total->EditValue, -2, -2, -2, -2);

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// pinjamantitipan_id
			$this->pinjamantitipan_id->EditAttrs["class"] = "form-control";
			$this->pinjamantitipan_id->EditCustomAttributes = "";
			if (trim(strval($this->pinjamantitipan_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->pinjamantitipan_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Sisa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `nasabah_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t06_pinjamantitipan`";
			$sWhereWrk = "";
			$this->pinjamantitipan_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pinjamantitipan_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$rowswrk = count($arwrk);
			for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
				$arwrk[$rowcntwrk][1] = ew_FormatNumber($arwrk[$rowcntwrk][1], 2, -2, -2, -2);
			}
			$this->pinjamantitipan_id->EditValue = $arwrk;

			// Add refer script
			// pinjaman_id

			$this->pinjaman_id->LinkCustomAttributes = "";
			$this->pinjaman_id->HrefValue = "";

			// AngsuranKe
			$this->AngsuranKe->LinkCustomAttributes = "";
			$this->AngsuranKe->HrefValue = "";

			// AngsuranTanggal
			$this->AngsuranTanggal->LinkCustomAttributes = "";
			$this->AngsuranTanggal->HrefValue = "";

			// AngsuranPokok
			$this->AngsuranPokok->LinkCustomAttributes = "";
			$this->AngsuranPokok->HrefValue = "";

			// AngsuranBunga
			$this->AngsuranBunga->LinkCustomAttributes = "";
			$this->AngsuranBunga->HrefValue = "";

			// AngsuranTotal
			$this->AngsuranTotal->LinkCustomAttributes = "";
			$this->AngsuranTotal->HrefValue = "";

			// SisaHutang
			$this->SisaHutang->LinkCustomAttributes = "";
			$this->SisaHutang->HrefValue = "";

			// TanggalBayar
			$this->TanggalBayar->LinkCustomAttributes = "";
			$this->TanggalBayar->HrefValue = "";

			// Terlambat
			$this->Terlambat->LinkCustomAttributes = "";
			$this->Terlambat->HrefValue = "";

			// TotalDenda
			$this->TotalDenda->LinkCustomAttributes = "";
			$this->TotalDenda->HrefValue = "";

			// Bayar_Titipan
			$this->Bayar_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Titipan->HrefValue = "";

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Non_Titipan->HrefValue = "";

			// Bayar_Total
			$this->Bayar_Total->LinkCustomAttributes = "";
			$this->Bayar_Total->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// pinjamantitipan_id
			$this->pinjamantitipan_id->LinkCustomAttributes = "";
			$this->pinjamantitipan_id->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
			$this->TanggalBayar->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TanggalBayar->CurrentValue, 7));
			$this->TanggalBayar->PlaceHolder = ew_RemoveHtml($this->TanggalBayar->FldCaption());

			// Terlambat
			$this->Terlambat->EditAttrs["class"] = "form-control";
			$this->Terlambat->EditCustomAttributes = "";
			$this->Terlambat->EditValue = ew_HtmlEncode($this->Terlambat->CurrentValue);
			$this->Terlambat->PlaceHolder = ew_RemoveHtml($this->Terlambat->FldCaption());

			// TotalDenda
			$this->TotalDenda->EditAttrs["class"] = "form-control";
			$this->TotalDenda->EditCustomAttributes = "";
			$this->TotalDenda->EditValue = ew_HtmlEncode($this->TotalDenda->CurrentValue);
			$this->TotalDenda->PlaceHolder = ew_RemoveHtml($this->TotalDenda->FldCaption());
			if (strval($this->TotalDenda->EditValue) <> "" && is_numeric($this->TotalDenda->EditValue)) $this->TotalDenda->EditValue = ew_FormatNumber($this->TotalDenda->EditValue, -2, -2, -2, -2);

			// Bayar_Titipan
			$this->Bayar_Titipan->EditAttrs["class"] = "form-control";
			$this->Bayar_Titipan->EditCustomAttributes = "";
			$this->Bayar_Titipan->EditValue = ew_HtmlEncode($this->Bayar_Titipan->CurrentValue);
			$this->Bayar_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Titipan->FldCaption());
			if (strval($this->Bayar_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Titipan->EditValue)) $this->Bayar_Titipan->EditValue = ew_FormatNumber($this->Bayar_Titipan->EditValue, -2, -2, -2, -2);

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->EditAttrs["class"] = "form-control";
			$this->Bayar_Non_Titipan->EditCustomAttributes = "";
			$this->Bayar_Non_Titipan->EditValue = ew_HtmlEncode($this->Bayar_Non_Titipan->CurrentValue);
			$this->Bayar_Non_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Non_Titipan->FldCaption());
			if (strval($this->Bayar_Non_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Non_Titipan->EditValue)) $this->Bayar_Non_Titipan->EditValue = ew_FormatNumber($this->Bayar_Non_Titipan->EditValue, -2, -2, -2, -2);

			// Bayar_Total
			$this->Bayar_Total->EditAttrs["class"] = "form-control";
			$this->Bayar_Total->EditCustomAttributes = "";
			$this->Bayar_Total->EditValue = ew_HtmlEncode($this->Bayar_Total->CurrentValue);
			$this->Bayar_Total->PlaceHolder = ew_RemoveHtml($this->Bayar_Total->FldCaption());
			if (strval($this->Bayar_Total->EditValue) <> "" && is_numeric($this->Bayar_Total->EditValue)) $this->Bayar_Total->EditValue = ew_FormatNumber($this->Bayar_Total->EditValue, -2, -2, -2, -2);

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// pinjamantitipan_id
			$this->pinjamantitipan_id->EditAttrs["class"] = "form-control";
			$this->pinjamantitipan_id->EditCustomAttributes = "";
			if (trim(strval($this->pinjamantitipan_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->pinjamantitipan_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Sisa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `nasabah_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t06_pinjamantitipan`";
			$sWhereWrk = "";
			$this->pinjamantitipan_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pinjamantitipan_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$rowswrk = count($arwrk);
			for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
				$arwrk[$rowcntwrk][1] = ew_FormatNumber($arwrk[$rowcntwrk][1], 2, -2, -2, -2);
			}
			$this->pinjamantitipan_id->EditValue = $arwrk;

			// Edit refer script
			// pinjaman_id

			$this->pinjaman_id->LinkCustomAttributes = "";
			$this->pinjaman_id->HrefValue = "";

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

			// Terlambat
			$this->Terlambat->LinkCustomAttributes = "";
			$this->Terlambat->HrefValue = "";

			// TotalDenda
			$this->TotalDenda->LinkCustomAttributes = "";
			$this->TotalDenda->HrefValue = "";

			// Bayar_Titipan
			$this->Bayar_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Titipan->HrefValue = "";

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Non_Titipan->HrefValue = "";

			// Bayar_Total
			$this->Bayar_Total->LinkCustomAttributes = "";
			$this->Bayar_Total->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// pinjamantitipan_id
			$this->pinjamantitipan_id->LinkCustomAttributes = "";
			$this->pinjamantitipan_id->HrefValue = "";
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
		if (!$this->pinjaman_id->FldIsDetailKey && !is_null($this->pinjaman_id->FormValue) && $this->pinjaman_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pinjaman_id->FldCaption(), $this->pinjaman_id->ReqErrMsg));
		}
		if (!$this->AngsuranKe->FldIsDetailKey && !is_null($this->AngsuranKe->FormValue) && $this->AngsuranKe->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranKe->FldCaption(), $this->AngsuranKe->ReqErrMsg));
		}
		if (!$this->AngsuranTanggal->FldIsDetailKey && !is_null($this->AngsuranTanggal->FormValue) && $this->AngsuranTanggal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranTanggal->FldCaption(), $this->AngsuranTanggal->ReqErrMsg));
		}
		if (!$this->AngsuranPokok->FldIsDetailKey && !is_null($this->AngsuranPokok->FormValue) && $this->AngsuranPokok->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranPokok->FldCaption(), $this->AngsuranPokok->ReqErrMsg));
		}
		if (!$this->AngsuranBunga->FldIsDetailKey && !is_null($this->AngsuranBunga->FormValue) && $this->AngsuranBunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranBunga->FldCaption(), $this->AngsuranBunga->ReqErrMsg));
		}
		if (!$this->AngsuranTotal->FldIsDetailKey && !is_null($this->AngsuranTotal->FormValue) && $this->AngsuranTotal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AngsuranTotal->FldCaption(), $this->AngsuranTotal->ReqErrMsg));
		}
		if (!$this->SisaHutang->FldIsDetailKey && !is_null($this->SisaHutang->FormValue) && $this->SisaHutang->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->SisaHutang->FldCaption(), $this->SisaHutang->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->TanggalBayar->FormValue)) {
			ew_AddMessage($gsFormError, $this->TanggalBayar->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Terlambat->FormValue)) {
			ew_AddMessage($gsFormError, $this->Terlambat->FldErrMsg());
		}
		if (!ew_CheckNumber($this->TotalDenda->FormValue)) {
			ew_AddMessage($gsFormError, $this->TotalDenda->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Titipan->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Titipan->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Non_Titipan->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Non_Titipan->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Total->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Total->FldErrMsg());
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

			// pinjaman_id
			$this->pinjaman_id->SetDbValueDef($rsnew, $this->pinjaman_id->CurrentValue, 0, $this->pinjaman_id->ReadOnly);

			// TanggalBayar
			$this->TanggalBayar->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 7), NULL, $this->TanggalBayar->ReadOnly);

			// Terlambat
			$this->Terlambat->SetDbValueDef($rsnew, $this->Terlambat->CurrentValue, NULL, $this->Terlambat->ReadOnly);

			// TotalDenda
			$this->TotalDenda->SetDbValueDef($rsnew, $this->TotalDenda->CurrentValue, NULL, $this->TotalDenda->ReadOnly);

			// Bayar_Titipan
			$this->Bayar_Titipan->SetDbValueDef($rsnew, $this->Bayar_Titipan->CurrentValue, NULL, $this->Bayar_Titipan->ReadOnly);

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->SetDbValueDef($rsnew, $this->Bayar_Non_Titipan->CurrentValue, NULL, $this->Bayar_Non_Titipan->ReadOnly);

			// Bayar_Total
			$this->Bayar_Total->SetDbValueDef($rsnew, $this->Bayar_Total->CurrentValue, NULL, $this->Bayar_Total->ReadOnly);

			// Keterangan
			$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, $this->Keterangan->ReadOnly);

			// pinjamantitipan_id
			$this->pinjamantitipan_id->SetDbValueDef($rsnew, $this->pinjamantitipan_id->CurrentValue, NULL, $this->pinjamantitipan_id->ReadOnly);

			// Check referential integrity for master table 't03_pinjaman'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_t03_pinjaman();
			$KeyValue = isset($rsnew['pinjaman_id']) ? $rsnew['pinjaman_id'] : $rsold['pinjaman_id'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Check referential integrity for master table 't03_pinjaman'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_t03_pinjaman();
		if (strval($this->pinjaman_id->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->pinjaman_id->CurrentValue, "DB"), $sMasterFilter);
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
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// pinjaman_id
		$this->pinjaman_id->SetDbValueDef($rsnew, $this->pinjaman_id->CurrentValue, 0, FALSE);

		// AngsuranKe
		$this->AngsuranKe->SetDbValueDef($rsnew, $this->AngsuranKe->CurrentValue, 0, FALSE);

		// AngsuranTanggal
		$this->AngsuranTanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->AngsuranTanggal->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// AngsuranPokok
		$this->AngsuranPokok->SetDbValueDef($rsnew, $this->AngsuranPokok->CurrentValue, 0, FALSE);

		// AngsuranBunga
		$this->AngsuranBunga->SetDbValueDef($rsnew, $this->AngsuranBunga->CurrentValue, 0, FALSE);

		// AngsuranTotal
		$this->AngsuranTotal->SetDbValueDef($rsnew, $this->AngsuranTotal->CurrentValue, 0, FALSE);

		// SisaHutang
		$this->SisaHutang->SetDbValueDef($rsnew, $this->SisaHutang->CurrentValue, 0, FALSE);

		// TanggalBayar
		$this->TanggalBayar->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 7), NULL, FALSE);

		// Terlambat
		$this->Terlambat->SetDbValueDef($rsnew, $this->Terlambat->CurrentValue, NULL, FALSE);

		// TotalDenda
		$this->TotalDenda->SetDbValueDef($rsnew, $this->TotalDenda->CurrentValue, NULL, FALSE);

		// Bayar_Titipan
		$this->Bayar_Titipan->SetDbValueDef($rsnew, $this->Bayar_Titipan->CurrentValue, NULL, FALSE);

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->SetDbValueDef($rsnew, $this->Bayar_Non_Titipan->CurrentValue, NULL, FALSE);

		// Bayar_Total
		$this->Bayar_Total->SetDbValueDef($rsnew, $this->Bayar_Total->CurrentValue, NULL, FALSE);

		// Keterangan
		$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, FALSE);

		// pinjamantitipan_id
		$this->pinjamantitipan_id->SetDbValueDef($rsnew, $this->pinjamantitipan_id->CurrentValue, NULL, FALSE);

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

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_t04_angsuran\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t04_angsuran',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft04_angsuranlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->SelectRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "t03_pinjaman") {
			global $t03_pinjaman;
			if (!isset($t03_pinjaman)) $t03_pinjaman = new ct03_pinjaman;
			$rsmaster = $t03_pinjaman->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$t03_pinjaman;
					$t03_pinjaman->ExportDocument($Doc, $rsmaster, 1, 1);
					$Doc->ExportEmptyRow();
					$Doc->Table = &$this;
				}
				$Doc->SetStyle($ExportStyle); // Restore
				$rsmaster->Close();
			}
		}
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($Doc->Text);
		} else {
			$Doc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_POST["sender"];
		$sRecipient = @$_POST["recipient"];
		$sCc = @$_POST["cc"];
		$sBcc = @$_POST["bcc"];
		$sContentType = @$_POST["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_POST["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_POST["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // Send URL only
		} else {
			foreach ($gTmpImages as $tmpimage)
				$Email->AddEmbeddedImage($tmpimage);
			$sEmailMessage .= ew_CleanEmailContent($EmailContent); // Send HTML
		}
		$Email->Content = $sEmailMessage; // Content
		$EventArgs = array();
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->MoveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->Move($this->StartRec - 1);
			$EventArgs["rs"] = &$this->Recordset;
		}
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		if ($this->BasicSearch->getKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . urlencode($this->BasicSearch->getKeyword()) . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . urlencode($this->BasicSearch->getType());
		}

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
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
			}
		}
		if ($bValidMaster) {

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t03_pinjaman") {
				if ($this->pinjaman_id->CurrentValue == "") $this->pinjaman_id->setSessionValue("");
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_pinjamantitipan_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Sisa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_pinjamantitipan`";
			$sWhereWrk = "";
			$this->pinjamantitipan_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pinjamantitipan_id, $sWhereWrk); // Call Lookup selecting
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t04_angsuran_list)) $t04_angsuran_list = new ct04_angsuran_list();

// Page init
$t04_angsuran_list->Page_Init();

// Page main
$t04_angsuran_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t04_angsuran_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t04_angsuran->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft04_angsuranlist = new ew_Form("ft04_angsuranlist", "list");
ft04_angsuranlist.FormKeyCountName = '<?php echo $t04_angsuran_list->FormKeyCountName ?>';

// Validate form
ft04_angsuranlist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_pinjaman_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_angsuran->pinjaman_id->FldCaption(), $t04_angsuran->pinjaman_id->ReqErrMsg)) ?>");
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
			elm = this.GetElements("x" + infix + "_Terlambat");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->Terlambat->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_TotalDenda");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->TotalDenda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Titipan");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->Bayar_Titipan->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Non_Titipan");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->Bayar_Non_Titipan->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_angsuran->Bayar_Total->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft04_angsuranlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft04_angsuranlist.ValidateRequired = true;
<?php } else { ?>
ft04_angsuranlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft04_angsuranlist.Lists["x_pinjamantitipan_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Sisa","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_pinjamantitipan"};

// Form object for search
var CurrentSearchForm = ft04_angsuranlistsrch = new ew_Form("ft04_angsuranlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t04_angsuran->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t04_angsuran->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($t04_angsuran_list->TotalRecs > 0 && $t04_angsuran_list->ExportOptions->Visible()) { ?>
<?php $t04_angsuran_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t04_angsuran_list->SearchOptions->Visible()) { ?>
<?php $t04_angsuran_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($t04_angsuran_list->FilterOptions->Visible()) { ?>
<?php $t04_angsuran_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($t04_angsuran->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($t04_angsuran->Export == "") || (EW_EXPORT_MASTER_RECORD && $t04_angsuran->Export == "print")) { ?>
<?php
if ($t04_angsuran_list->DbMasterFilter <> "" && $t04_angsuran->getCurrentMasterTable() == "t03_pinjaman") {
	if ($t04_angsuran_list->MasterRecordExists) {
?>
<?php include_once "t03_pinjamanmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $t04_angsuran_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t04_angsuran_list->TotalRecs <= 0)
			$t04_angsuran_list->TotalRecs = $t04_angsuran->SelectRecordCount();
	} else {
		if (!$t04_angsuran_list->Recordset && ($t04_angsuran_list->Recordset = $t04_angsuran_list->LoadRecordset()))
			$t04_angsuran_list->TotalRecs = $t04_angsuran_list->Recordset->RecordCount();
	}
	$t04_angsuran_list->StartRec = 1;
	if ($t04_angsuran_list->DisplayRecs <= 0 || ($t04_angsuran->Export <> "" && $t04_angsuran->ExportAll)) // Display all records
		$t04_angsuran_list->DisplayRecs = $t04_angsuran_list->TotalRecs;
	if (!($t04_angsuran->Export <> "" && $t04_angsuran->ExportAll))
		$t04_angsuran_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t04_angsuran_list->Recordset = $t04_angsuran_list->LoadRecordset($t04_angsuran_list->StartRec-1, $t04_angsuran_list->DisplayRecs);

	// Set no record found message
	if ($t04_angsuran->CurrentAction == "" && $t04_angsuran_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t04_angsuran_list->setWarningMessage(ew_DeniedMsg());
		if ($t04_angsuran_list->SearchWhere == "0=101")
			$t04_angsuran_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t04_angsuran_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($t04_angsuran_list->AuditTrailOnSearch && $t04_angsuran_list->Command == "search" && !$t04_angsuran_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $t04_angsuran_list->getSessionWhere();
		$t04_angsuran_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$t04_angsuran_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($t04_angsuran->Export == "" && $t04_angsuran->CurrentAction == "") { ?>
<form name="ft04_angsuranlistsrch" id="ft04_angsuranlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($t04_angsuran_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="ft04_angsuranlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t04_angsuran">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($t04_angsuran_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($t04_angsuran_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $t04_angsuran_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($t04_angsuran_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($t04_angsuran_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($t04_angsuran_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($t04_angsuran_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t04_angsuran_list->ShowPageHeader(); ?>
<?php
$t04_angsuran_list->ShowMessage();
?>
<?php if ($t04_angsuran_list->TotalRecs > 0 || $t04_angsuran->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t04_angsuran">
<?php if ($t04_angsuran->Export == "") { ?>
<div class="panel-heading ewGridUpperPanel">
<?php if ($t04_angsuran->CurrentAction <> "gridadd" && $t04_angsuran->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t04_angsuran_list->Pager)) $t04_angsuran_list->Pager = new cPrevNextPager($t04_angsuran_list->StartRec, $t04_angsuran_list->DisplayRecs, $t04_angsuran_list->TotalRecs) ?>
<?php if ($t04_angsuran_list->Pager->RecordCount > 0 && $t04_angsuran_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t04_angsuran_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t04_angsuran_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t04_angsuran_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t04_angsuran_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t04_angsuran_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_angsuran_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft04_angsuranlist" id="ft04_angsuranlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t04_angsuran_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t04_angsuran_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t04_angsuran">
<?php if ($t04_angsuran->getCurrentMasterTable() == "t03_pinjaman" && $t04_angsuran->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_pinjaman">
<input type="hidden" name="fk_id" value="<?php echo $t04_angsuran->pinjaman_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_t04_angsuran" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t04_angsuran_list->TotalRecs > 0 || $t04_angsuran->CurrentAction == "gridedit") { ?>
<table id="tbl_t04_angsuranlist" class="table ewTable">
<?php echo $t04_angsuran->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t04_angsuran_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t04_angsuran_list->RenderListOptions();

// Render list options (header, left)
$t04_angsuran_list->ListOptions->Render("header", "left");
?>
<?php if ($t04_angsuran->pinjaman_id->Visible) { // pinjaman_id ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->pinjaman_id) == "") { ?>
		<th data-name="pinjaman_id"><div id="elh_t04_angsuran_pinjaman_id" class="t04_angsuran_pinjaman_id"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->pinjaman_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pinjaman_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->pinjaman_id) ?>',2);"><div id="elh_t04_angsuran_pinjaman_id" class="t04_angsuran_pinjaman_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->pinjaman_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->pinjaman_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->pinjaman_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranKe->Visible) { // AngsuranKe ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranKe) == "") { ?>
		<th data-name="AngsuranKe"><div id="elh_t04_angsuran_AngsuranKe" class="t04_angsuran_AngsuranKe"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranKe->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranKe"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->AngsuranKe) ?>',2);"><div id="elh_t04_angsuran_AngsuranKe" class="t04_angsuran_AngsuranKe">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranKe->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranKe->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranKe->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranTanggal->Visible) { // AngsuranTanggal ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranTanggal) == "") { ?>
		<th data-name="AngsuranTanggal"><div id="elh_t04_angsuran_AngsuranTanggal" class="t04_angsuran_AngsuranTanggal"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $t04_angsuran->AngsuranTanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranTanggal"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->AngsuranTanggal) ?>',2);"><div id="elh_t04_angsuran_AngsuranTanggal" class="t04_angsuran_AngsuranTanggal">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranTanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranTanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranPokok->Visible) { // AngsuranPokok ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranPokok) == "") { ?>
		<th data-name="AngsuranPokok"><div id="elh_t04_angsuran_AngsuranPokok" class="t04_angsuran_AngsuranPokok"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranPokok->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranPokok"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->AngsuranPokok) ?>',2);"><div id="elh_t04_angsuran_AngsuranPokok" class="t04_angsuran_AngsuranPokok">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranPokok->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranPokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranPokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranBunga->Visible) { // AngsuranBunga ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranBunga) == "") { ?>
		<th data-name="AngsuranBunga"><div id="elh_t04_angsuran_AngsuranBunga" class="t04_angsuran_AngsuranBunga"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranBunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranBunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->AngsuranBunga) ?>',2);"><div id="elh_t04_angsuran_AngsuranBunga" class="t04_angsuran_AngsuranBunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranBunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranBunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranBunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->AngsuranTotal->Visible) { // AngsuranTotal ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->AngsuranTotal) == "") { ?>
		<th data-name="AngsuranTotal"><div id="elh_t04_angsuran_AngsuranTotal" class="t04_angsuran_AngsuranTotal"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTotal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AngsuranTotal"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->AngsuranTotal) ?>',2);"><div id="elh_t04_angsuran_AngsuranTotal" class="t04_angsuran_AngsuranTotal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->AngsuranTotal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->AngsuranTotal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->AngsuranTotal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->SisaHutang->Visible) { // SisaHutang ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->SisaHutang) == "") { ?>
		<th data-name="SisaHutang"><div id="elh_t04_angsuran_SisaHutang" class="t04_angsuran_SisaHutang"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->SisaHutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SisaHutang"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->SisaHutang) ?>',2);"><div id="elh_t04_angsuran_SisaHutang" class="t04_angsuran_SisaHutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->SisaHutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->SisaHutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->SisaHutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->TanggalBayar->Visible) { // TanggalBayar ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->TanggalBayar) == "") { ?>
		<th data-name="TanggalBayar"><div id="elh_t04_angsuran_TanggalBayar" class="t04_angsuran_TanggalBayar"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->TanggalBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TanggalBayar"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->TanggalBayar) ?>',2);"><div id="elh_t04_angsuran_TanggalBayar" class="t04_angsuran_TanggalBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->TanggalBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->TanggalBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->TanggalBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->Terlambat->Visible) { // Terlambat ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->Terlambat) == "") { ?>
		<th data-name="Terlambat"><div id="elh_t04_angsuran_Terlambat" class="t04_angsuran_Terlambat"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->Terlambat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terlambat"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->Terlambat) ?>',2);"><div id="elh_t04_angsuran_Terlambat" class="t04_angsuran_Terlambat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->Terlambat->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->Terlambat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->Terlambat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->TotalDenda->Visible) { // TotalDenda ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->TotalDenda) == "") { ?>
		<th data-name="TotalDenda"><div id="elh_t04_angsuran_TotalDenda" class="t04_angsuran_TotalDenda"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->TotalDenda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDenda"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->TotalDenda) ?>',2);"><div id="elh_t04_angsuran_TotalDenda" class="t04_angsuran_TotalDenda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->TotalDenda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->TotalDenda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->TotalDenda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->Bayar_Titipan) == "") { ?>
		<th data-name="Bayar_Titipan"><div id="elh_t04_angsuran_Bayar_Titipan" class="t04_angsuran_Bayar_Titipan"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->Bayar_Titipan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Titipan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->Bayar_Titipan) ?>',2);"><div id="elh_t04_angsuran_Bayar_Titipan" class="t04_angsuran_Bayar_Titipan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->Bayar_Titipan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->Bayar_Titipan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->Bayar_Titipan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->Bayar_Non_Titipan) == "") { ?>
		<th data-name="Bayar_Non_Titipan"><div id="elh_t04_angsuran_Bayar_Non_Titipan" class="t04_angsuran_Bayar_Non_Titipan"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->Bayar_Non_Titipan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Non_Titipan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->Bayar_Non_Titipan) ?>',2);"><div id="elh_t04_angsuran_Bayar_Non_Titipan" class="t04_angsuran_Bayar_Non_Titipan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->Bayar_Non_Titipan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->Bayar_Non_Titipan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->Bayar_Non_Titipan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->Bayar_Total->Visible) { // Bayar_Total ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->Bayar_Total) == "") { ?>
		<th data-name="Bayar_Total"><div id="elh_t04_angsuran_Bayar_Total" class="t04_angsuran_Bayar_Total"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->Bayar_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Total"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->Bayar_Total) ?>',2);"><div id="elh_t04_angsuran_Bayar_Total" class="t04_angsuran_Bayar_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->Bayar_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->Bayar_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->Bayar_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t04_angsuran_Keterangan" class="t04_angsuran_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->Keterangan) ?>',2);"><div id="elh_t04_angsuran_Keterangan" class="t04_angsuran_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->Keterangan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_angsuran->pinjamantitipan_id->Visible) { // pinjamantitipan_id ?>
	<?php if ($t04_angsuran->SortUrl($t04_angsuran->pinjamantitipan_id) == "") { ?>
		<th data-name="pinjamantitipan_id"><div id="elh_t04_angsuran_pinjamantitipan_id" class="t04_angsuran_pinjamantitipan_id"><div class="ewTableHeaderCaption"><?php echo $t04_angsuran->pinjamantitipan_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pinjamantitipan_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_angsuran->SortUrl($t04_angsuran->pinjamantitipan_id) ?>',2);"><div id="elh_t04_angsuran_pinjamantitipan_id" class="t04_angsuran_pinjamantitipan_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_angsuran->pinjamantitipan_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_angsuran->pinjamantitipan_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_angsuran->pinjamantitipan_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t04_angsuran_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t04_angsuran->ExportAll && $t04_angsuran->Export <> "") {
	$t04_angsuran_list->StopRec = $t04_angsuran_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t04_angsuran_list->TotalRecs > $t04_angsuran_list->StartRec + $t04_angsuran_list->DisplayRecs - 1)
		$t04_angsuran_list->StopRec = $t04_angsuran_list->StartRec + $t04_angsuran_list->DisplayRecs - 1;
	else
		$t04_angsuran_list->StopRec = $t04_angsuran_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t04_angsuran_list->FormKeyCountName) && ($t04_angsuran->CurrentAction == "gridadd" || $t04_angsuran->CurrentAction == "gridedit" || $t04_angsuran->CurrentAction == "F")) {
		$t04_angsuran_list->KeyCount = $objForm->GetValue($t04_angsuran_list->FormKeyCountName);
		$t04_angsuran_list->StopRec = $t04_angsuran_list->StartRec + $t04_angsuran_list->KeyCount - 1;
	}
}
$t04_angsuran_list->RecCnt = $t04_angsuran_list->StartRec - 1;
if ($t04_angsuran_list->Recordset && !$t04_angsuran_list->Recordset->EOF) {
	$t04_angsuran_list->Recordset->MoveFirst();
	$bSelectLimit = $t04_angsuran_list->UseSelectLimit;
	if (!$bSelectLimit && $t04_angsuran_list->StartRec > 1)
		$t04_angsuran_list->Recordset->Move($t04_angsuran_list->StartRec - 1);
} elseif (!$t04_angsuran->AllowAddDeleteRow && $t04_angsuran_list->StopRec == 0) {
	$t04_angsuran_list->StopRec = $t04_angsuran->GridAddRowCount;
}

// Initialize aggregate
$t04_angsuran->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t04_angsuran->ResetAttrs();
$t04_angsuran_list->RenderRow();
$t04_angsuran_list->EditRowCnt = 0;
if ($t04_angsuran->CurrentAction == "edit")
	$t04_angsuran_list->RowIndex = 1;
if ($t04_angsuran->CurrentAction == "gridedit")
	$t04_angsuran_list->RowIndex = 0;
while ($t04_angsuran_list->RecCnt < $t04_angsuran_list->StopRec) {
	$t04_angsuran_list->RecCnt++;
	if (intval($t04_angsuran_list->RecCnt) >= intval($t04_angsuran_list->StartRec)) {
		$t04_angsuran_list->RowCnt++;
		if ($t04_angsuran->CurrentAction == "gridadd" || $t04_angsuran->CurrentAction == "gridedit" || $t04_angsuran->CurrentAction == "F") {
			$t04_angsuran_list->RowIndex++;
			$objForm->Index = $t04_angsuran_list->RowIndex;
			if ($objForm->HasValue($t04_angsuran_list->FormActionName))
				$t04_angsuran_list->RowAction = strval($objForm->GetValue($t04_angsuran_list->FormActionName));
			elseif ($t04_angsuran->CurrentAction == "gridadd")
				$t04_angsuran_list->RowAction = "insert";
			else
				$t04_angsuran_list->RowAction = "";
		}

		// Set up key count
		$t04_angsuran_list->KeyCount = $t04_angsuran_list->RowIndex;

		// Init row class and style
		$t04_angsuran->ResetAttrs();
		$t04_angsuran->CssClass = "";
		if ($t04_angsuran->CurrentAction == "gridadd") {
			$t04_angsuran_list->LoadDefaultValues(); // Load default values
		} else {
			$t04_angsuran_list->LoadRowValues($t04_angsuran_list->Recordset); // Load row values
		}
		$t04_angsuran->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t04_angsuran->CurrentAction == "edit") {
			if ($t04_angsuran_list->CheckInlineEditKey() && $t04_angsuran_list->EditRowCnt == 0) { // Inline edit
				$t04_angsuran->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t04_angsuran->CurrentAction == "gridedit") { // Grid edit
			if ($t04_angsuran->EventCancelled) {
				$t04_angsuran_list->RestoreCurrentRowFormValues($t04_angsuran_list->RowIndex); // Restore form values
			}
			if ($t04_angsuran_list->RowAction == "insert")
				$t04_angsuran->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t04_angsuran->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t04_angsuran->CurrentAction == "edit" && $t04_angsuran->RowType == EW_ROWTYPE_EDIT && $t04_angsuran->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t04_angsuran_list->RestoreFormValues(); // Restore form values
		}
		if ($t04_angsuran->CurrentAction == "gridedit" && ($t04_angsuran->RowType == EW_ROWTYPE_EDIT || $t04_angsuran->RowType == EW_ROWTYPE_ADD) && $t04_angsuran->EventCancelled) // Update failed
			$t04_angsuran_list->RestoreCurrentRowFormValues($t04_angsuran_list->RowIndex); // Restore form values
		if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t04_angsuran_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t04_angsuran->RowAttrs = array_merge($t04_angsuran->RowAttrs, array('data-rowindex'=>$t04_angsuran_list->RowCnt, 'id'=>'r' . $t04_angsuran_list->RowCnt . '_t04_angsuran', 'data-rowtype'=>$t04_angsuran->RowType));

		// Render row
		$t04_angsuran_list->RenderRow();

		// Render list options
		$t04_angsuran_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t04_angsuran_list->RowAction <> "delete" && $t04_angsuran_list->RowAction <> "insertdelete" && !($t04_angsuran_list->RowAction == "insert" && $t04_angsuran->CurrentAction == "F" && $t04_angsuran_list->EmptyRow())) {
?>
	<tr<?php echo $t04_angsuran->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_angsuran_list->ListOptions->Render("body", "left", $t04_angsuran_list->RowCnt);
?>
	<?php if ($t04_angsuran->pinjaman_id->Visible) { // pinjaman_id ?>
		<td data-name="pinjaman_id"<?php echo $t04_angsuran->pinjaman_id->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t04_angsuran->pinjaman_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<select data-table="t04_angsuran" data-field="x_pinjaman_id" data-value-separator="<?php echo $t04_angsuran->pinjaman_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id"<?php echo $t04_angsuran->pinjaman_id->EditAttributes() ?>>
<?php echo $t04_angsuran->pinjaman_id->SelectOptionListHtml("x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" id="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t04_angsuran->pinjaman_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<select data-table="t04_angsuran" data-field="x_pinjaman_id" data-value-separator="<?php echo $t04_angsuran->pinjaman_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id"<?php echo $t04_angsuran->pinjaman_id->EditAttributes() ?>>
<?php echo $t04_angsuran->pinjaman_id->SelectOptionListHtml("x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjaman_id" class="t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<?php echo $t04_angsuran->pinjaman_id->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t04_angsuran_list->PageObjName . "_row_" . $t04_angsuran_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_id" id="x<?php echo $t04_angsuran_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_angsuran->id->CurrentValue) ?>">
<input type="hidden" data-table="t04_angsuran" data-field="x_id" name="o<?php echo $t04_angsuran_list->RowIndex ?>_id" id="o<?php echo $t04_angsuran_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_angsuran->id->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT || $t04_angsuran->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_id" id="x<?php echo $t04_angsuran_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_angsuran->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t04_angsuran->AngsuranKe->Visible) { // AngsuranKe ?>
		<td data-name="AngsuranKe"<?php echo $t04_angsuran->AngsuranKe->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranKe->EditValue ?>"<?php echo $t04_angsuran->AngsuranKe->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<span<?php echo $t04_angsuran->AngsuranKe->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranKe->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranKe" class="t04_angsuran_AngsuranKe">
<span<?php echo $t04_angsuran->AngsuranKe->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranKe->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTanggal->Visible) { // AngsuranTanggal ?>
		<td data-name="AngsuranTanggal"<?php echo $t04_angsuran->AngsuranTanggal->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTanggal" data-format="7" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTanggal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTanggal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<span<?php echo $t04_angsuran->AngsuranTanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranTanggal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranTanggal" class="t04_angsuran_AngsuranTanggal">
<span<?php echo $t04_angsuran->AngsuranTanggal->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranTanggal->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranPokok->Visible) { // AngsuranPokok ?>
		<td data-name="AngsuranPokok"<?php echo $t04_angsuran->AngsuranPokok->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranPokok->EditValue ?>"<?php echo $t04_angsuran->AngsuranPokok->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<span<?php echo $t04_angsuran->AngsuranPokok->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranPokok->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranPokok" class="t04_angsuran_AngsuranPokok">
<span<?php echo $t04_angsuran->AngsuranPokok->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranPokok->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranBunga->Visible) { // AngsuranBunga ?>
		<td data-name="AngsuranBunga"<?php echo $t04_angsuran->AngsuranBunga->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranBunga->EditValue ?>"<?php echo $t04_angsuran->AngsuranBunga->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<span<?php echo $t04_angsuran->AngsuranBunga->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranBunga->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranBunga" class="t04_angsuran_AngsuranBunga">
<span<?php echo $t04_angsuran->AngsuranBunga->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranBunga->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTotal->Visible) { // AngsuranTotal ?>
		<td data-name="AngsuranTotal"<?php echo $t04_angsuran->AngsuranTotal->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTotal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTotal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<span<?php echo $t04_angsuran->AngsuranTotal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->AngsuranTotal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_AngsuranTotal" class="t04_angsuran_AngsuranTotal">
<span<?php echo $t04_angsuran->AngsuranTotal->ViewAttributes() ?>>
<?php echo $t04_angsuran->AngsuranTotal->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->SisaHutang->Visible) { // SisaHutang ?>
		<td data-name="SisaHutang"<?php echo $t04_angsuran->SisaHutang->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<input type="text" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->SisaHutang->EditValue ?>"<?php echo $t04_angsuran->SisaHutang->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="o<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" id="o<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<span<?php echo $t04_angsuran->SisaHutang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->SisaHutang->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_SisaHutang" class="t04_angsuran_SisaHutang">
<span<?php echo $t04_angsuran->SisaHutang->ViewAttributes() ?>>
<?php echo $t04_angsuran->SisaHutang->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TanggalBayar->Visible) { // TanggalBayar ?>
		<td data-name="TanggalBayar"<?php echo $t04_angsuran->TanggalBayar->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<input type="text" data-table="t04_angsuran" data-field="x_TanggalBayar" data-format="7" name="x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TanggalBayar->EditValue ?>"<?php echo $t04_angsuran->TanggalBayar->EditAttributes() ?>>
<?php if (!$t04_angsuran->TanggalBayar->ReadOnly && !$t04_angsuran->TanggalBayar->Disabled && !isset($t04_angsuran->TanggalBayar->EditAttrs["readonly"]) && !isset($t04_angsuran->TanggalBayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_angsuranlist", "x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="o<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" id="o<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<input type="text" data-table="t04_angsuran" data-field="x_TanggalBayar" data-format="7" name="x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TanggalBayar->EditValue ?>"<?php echo $t04_angsuran->TanggalBayar->EditAttributes() ?>>
<?php if (!$t04_angsuran->TanggalBayar->ReadOnly && !$t04_angsuran->TanggalBayar->Disabled && !isset($t04_angsuran->TanggalBayar->EditAttrs["readonly"]) && !isset($t04_angsuran->TanggalBayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_angsuranlist", "x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_TanggalBayar" class="t04_angsuran_TanggalBayar">
<span<?php echo $t04_angsuran->TanggalBayar->ViewAttributes() ?>>
<?php echo $t04_angsuran->TanggalBayar->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat"<?php echo $t04_angsuran->Terlambat->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<input type="text" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" size="7" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Terlambat->EditValue ?>"<?php echo $t04_angsuran->Terlambat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<input type="text" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" size="7" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Terlambat->EditValue ?>"<?php echo $t04_angsuran->Terlambat->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Terlambat" class="t04_angsuran_Terlambat">
<span<?php echo $t04_angsuran->Terlambat->ViewAttributes() ?>>
<?php echo $t04_angsuran->Terlambat->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TotalDenda->Visible) { // TotalDenda ?>
		<td data-name="TotalDenda"<?php echo $t04_angsuran->TotalDenda->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<input type="text" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TotalDenda->EditValue ?>"<?php echo $t04_angsuran->TotalDenda->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="o<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" id="o<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<input type="text" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TotalDenda->EditValue ?>"<?php echo $t04_angsuran->TotalDenda->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_TotalDenda" class="t04_angsuran_TotalDenda">
<span<?php echo $t04_angsuran->TotalDenda->ViewAttributes() ?>>
<?php echo $t04_angsuran->TotalDenda->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
		<td data-name="Bayar_Titipan"<?php echo $t04_angsuran->Bayar_Titipan->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Titipan" class="form-group t04_angsuran_Bayar_Titipan">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Titipan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Titipan->EditValue ?>"<?php echo $t04_angsuran->Bayar_Titipan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Bayar_Titipan" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Titipan->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Titipan" class="form-group t04_angsuran_Bayar_Titipan">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Titipan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Titipan->EditValue ?>"<?php echo $t04_angsuran->Bayar_Titipan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Titipan" class="t04_angsuran_Bayar_Titipan">
<span<?php echo $t04_angsuran->Bayar_Titipan->ViewAttributes() ?>>
<?php echo $t04_angsuran->Bayar_Titipan->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
		<td data-name="Bayar_Non_Titipan"<?php echo $t04_angsuran->Bayar_Non_Titipan->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Non_Titipan" class="form-group t04_angsuran_Bayar_Non_Titipan">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_angsuran->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Bayar_Non_Titipan" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Non_Titipan->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Non_Titipan" class="form-group t04_angsuran_Bayar_Non_Titipan">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_angsuran->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Non_Titipan" class="t04_angsuran_Bayar_Non_Titipan">
<span<?php echo $t04_angsuran->Bayar_Non_Titipan->ViewAttributes() ?>>
<?php echo $t04_angsuran->Bayar_Non_Titipan->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Bayar_Total->Visible) { // Bayar_Total ?>
		<td data-name="Bayar_Total"<?php echo $t04_angsuran->Bayar_Total->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Total" class="form-group t04_angsuran_Bayar_Total">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Total" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Total->EditValue ?>"<?php echo $t04_angsuran->Bayar_Total->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Bayar_Total" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Total->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Total" class="form-group t04_angsuran_Bayar_Total">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Total" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Total->EditValue ?>"<?php echo $t04_angsuran->Bayar_Total->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Bayar_Total" class="t04_angsuran_Bayar_Total">
<span<?php echo $t04_angsuran->Bayar_Total->ViewAttributes() ?>>
<?php echo $t04_angsuran->Bayar_Total->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t04_angsuran->Keterangan->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Keterangan" class="form-group t04_angsuran_Keterangan">
<textarea data-table="t04_angsuran" data-field="x_Keterangan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" cols="15" rows="4" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_angsuran->Keterangan->EditAttributes() ?>><?php echo $t04_angsuran->Keterangan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Keterangan" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_angsuran->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Keterangan" class="form-group t04_angsuran_Keterangan">
<textarea data-table="t04_angsuran" data-field="x_Keterangan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" cols="15" rows="4" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_angsuran->Keterangan->EditAttributes() ?>><?php echo $t04_angsuran->Keterangan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_Keterangan" class="t04_angsuran_Keterangan">
<span<?php echo $t04_angsuran->Keterangan->ViewAttributes() ?>>
<?php echo $t04_angsuran->Keterangan->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_angsuran->pinjamantitipan_id->Visible) { // pinjamantitipan_id ?>
		<td data-name="pinjamantitipan_id"<?php echo $t04_angsuran->pinjamantitipan_id->CellAttributes() ?>>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjamantitipan_id" class="form-group t04_angsuran_pinjamantitipan_id">
<select data-table="t04_angsuran" data-field="x_pinjamantitipan_id" data-value-separator="<?php echo $t04_angsuran->pinjamantitipan_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id"<?php echo $t04_angsuran->pinjamantitipan_id->EditAttributes() ?>>
<?php echo $t04_angsuran->pinjamantitipan_id->SelectOptionListHtml("x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" id="s_x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" value="<?php echo $t04_angsuran->pinjamantitipan_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjamantitipan_id" name="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" id="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjamantitipan_id->OldValue) ?>">
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjamantitipan_id" class="form-group t04_angsuran_pinjamantitipan_id">
<select data-table="t04_angsuran" data-field="x_pinjamantitipan_id" data-value-separator="<?php echo $t04_angsuran->pinjamantitipan_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id"<?php echo $t04_angsuran->pinjamantitipan_id->EditAttributes() ?>>
<?php echo $t04_angsuran->pinjamantitipan_id->SelectOptionListHtml("x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" id="s_x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" value="<?php echo $t04_angsuran->pinjamantitipan_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_angsuran_list->RowCnt ?>_t04_angsuran_pinjamantitipan_id" class="t04_angsuran_pinjamantitipan_id">
<span<?php echo $t04_angsuran->pinjamantitipan_id->ViewAttributes() ?>>
<?php echo $t04_angsuran->pinjamantitipan_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_angsuran_list->ListOptions->Render("body", "right", $t04_angsuran_list->RowCnt);
?>
	</tr>
<?php if ($t04_angsuran->RowType == EW_ROWTYPE_ADD || $t04_angsuran->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft04_angsuranlist.UpdateOpts(<?php echo $t04_angsuran_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t04_angsuran->CurrentAction <> "gridadd")
		if (!$t04_angsuran_list->Recordset->EOF) $t04_angsuran_list->Recordset->MoveNext();
}
?>
<?php
	if ($t04_angsuran->CurrentAction == "gridadd" || $t04_angsuran->CurrentAction == "gridedit") {
		$t04_angsuran_list->RowIndex = '$rowindex$';
		$t04_angsuran_list->LoadDefaultValues();

		// Set row properties
		$t04_angsuran->ResetAttrs();
		$t04_angsuran->RowAttrs = array_merge($t04_angsuran->RowAttrs, array('data-rowindex'=>$t04_angsuran_list->RowIndex, 'id'=>'r0_t04_angsuran', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t04_angsuran->RowAttrs["class"], "ewTemplate");
		$t04_angsuran->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t04_angsuran_list->RenderRow();

		// Render list options
		$t04_angsuran_list->RenderListOptions();
		$t04_angsuran_list->StartRowCnt = 0;
?>
	<tr<?php echo $t04_angsuran->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_angsuran_list->ListOptions->Render("body", "left", $t04_angsuran_list->RowIndex);
?>
	<?php if ($t04_angsuran->pinjaman_id->Visible) { // pinjaman_id ?>
		<td data-name="pinjaman_id">
<?php if ($t04_angsuran->pinjaman_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<span<?php echo $t04_angsuran->pinjaman_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_angsuran->pinjaman_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t04_angsuran_pinjaman_id" class="form-group t04_angsuran_pinjaman_id">
<select data-table="t04_angsuran" data-field="x_pinjaman_id" data-value-separator="<?php echo $t04_angsuran->pinjaman_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id"<?php echo $t04_angsuran->pinjaman_id->EditAttributes() ?>>
<?php echo $t04_angsuran->pinjaman_id->SelectOptionListHtml("x<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjaman_id" name="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" id="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjaman_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjaman_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranKe->Visible) { // AngsuranKe ?>
		<td data-name="AngsuranKe">
<span id="el$rowindex$_t04_angsuran_AngsuranKe" class="form-group t04_angsuran_AngsuranKe">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranKe" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranKe->EditValue ?>"<?php echo $t04_angsuran->AngsuranKe->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranKe" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranKe" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranKe->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTanggal->Visible) { // AngsuranTanggal ?>
		<td data-name="AngsuranTanggal">
<span id="el$rowindex$_t04_angsuran_AngsuranTanggal" class="form-group t04_angsuran_AngsuranTanggal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTanggal" data-format="7" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTanggal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTanggal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTanggal" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTanggal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranPokok->Visible) { // AngsuranPokok ?>
		<td data-name="AngsuranPokok">
<span id="el$rowindex$_t04_angsuran_AngsuranPokok" class="form-group t04_angsuran_AngsuranPokok">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranPokok->EditValue ?>"<?php echo $t04_angsuran->AngsuranPokok->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranPokok" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranPokok" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranPokok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranBunga->Visible) { // AngsuranBunga ?>
		<td data-name="AngsuranBunga">
<span id="el$rowindex$_t04_angsuran_AngsuranBunga" class="form-group t04_angsuran_AngsuranBunga">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranBunga->EditValue ?>"<?php echo $t04_angsuran->AngsuranBunga->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranBunga" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranBunga" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranBunga->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->AngsuranTotal->Visible) { // AngsuranTotal ?>
		<td data-name="AngsuranTotal">
<span id="el$rowindex$_t04_angsuran_AngsuranTotal" class="form-group t04_angsuran_AngsuranTotal">
<input type="text" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" id="x<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->AngsuranTotal->EditValue ?>"<?php echo $t04_angsuran->AngsuranTotal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_AngsuranTotal" name="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" id="o<?php echo $t04_angsuran_list->RowIndex ?>_AngsuranTotal" value="<?php echo ew_HtmlEncode($t04_angsuran->AngsuranTotal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->SisaHutang->Visible) { // SisaHutang ?>
		<td data-name="SisaHutang">
<span id="el$rowindex$_t04_angsuran_SisaHutang" class="form-group t04_angsuran_SisaHutang">
<input type="text" data-table="t04_angsuran" data-field="x_SisaHutang" name="x<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" id="x<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" size="30" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->SisaHutang->EditValue ?>"<?php echo $t04_angsuran->SisaHutang->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_SisaHutang" name="o<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" id="o<?php echo $t04_angsuran_list->RowIndex ?>_SisaHutang" value="<?php echo ew_HtmlEncode($t04_angsuran->SisaHutang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TanggalBayar->Visible) { // TanggalBayar ?>
		<td data-name="TanggalBayar">
<span id="el$rowindex$_t04_angsuran_TanggalBayar" class="form-group t04_angsuran_TanggalBayar">
<input type="text" data-table="t04_angsuran" data-field="x_TanggalBayar" data-format="7" name="x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" id="x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TanggalBayar->EditValue ?>"<?php echo $t04_angsuran->TanggalBayar->EditAttributes() ?>>
<?php if (!$t04_angsuran->TanggalBayar->ReadOnly && !$t04_angsuran->TanggalBayar->Disabled && !isset($t04_angsuran->TanggalBayar->EditAttrs["readonly"]) && !isset($t04_angsuran->TanggalBayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_angsuranlist", "x<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TanggalBayar" name="o<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" id="o<?php echo $t04_angsuran_list->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t04_angsuran->TanggalBayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat">
<span id="el$rowindex$_t04_angsuran_Terlambat" class="form-group t04_angsuran_Terlambat">
<input type="text" data-table="t04_angsuran" data-field="x_Terlambat" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" size="7" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Terlambat->EditValue ?>"<?php echo $t04_angsuran->Terlambat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Terlambat" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_angsuran->Terlambat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->TotalDenda->Visible) { // TotalDenda ?>
		<td data-name="TotalDenda">
<span id="el$rowindex$_t04_angsuran_TotalDenda" class="form-group t04_angsuran_TotalDenda">
<input type="text" data-table="t04_angsuran" data-field="x_TotalDenda" name="x<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" id="x<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->TotalDenda->EditValue ?>"<?php echo $t04_angsuran->TotalDenda->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_TotalDenda" name="o<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" id="o<?php echo $t04_angsuran_list->RowIndex ?>_TotalDenda" value="<?php echo ew_HtmlEncode($t04_angsuran->TotalDenda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
		<td data-name="Bayar_Titipan">
<span id="el$rowindex$_t04_angsuran_Bayar_Titipan" class="form-group t04_angsuran_Bayar_Titipan">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Titipan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Titipan->EditValue ?>"<?php echo $t04_angsuran->Bayar_Titipan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Bayar_Titipan" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Titipan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
		<td data-name="Bayar_Non_Titipan">
<span id="el$rowindex$_t04_angsuran_Bayar_Non_Titipan" class="form-group t04_angsuran_Bayar_Non_Titipan">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_angsuran->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Bayar_Non_Titipan" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Non_Titipan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Bayar_Total->Visible) { // Bayar_Total ?>
		<td data-name="Bayar_Total">
<span id="el$rowindex$_t04_angsuran_Bayar_Total" class="form-group t04_angsuran_Bayar_Total">
<input type="text" data-table="t04_angsuran" data-field="x_Bayar_Total" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_angsuran->Bayar_Total->EditValue ?>"<?php echo $t04_angsuran->Bayar_Total->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Bayar_Total" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_angsuran->Bayar_Total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<span id="el$rowindex$_t04_angsuran_Keterangan" class="form-group t04_angsuran_Keterangan">
<textarea data-table="t04_angsuran" data-field="x_Keterangan" name="x<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" id="x<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" cols="15" rows="4" placeholder="<?php echo ew_HtmlEncode($t04_angsuran->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_angsuran->Keterangan->EditAttributes() ?>><?php echo $t04_angsuran->Keterangan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_Keterangan" name="o<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" id="o<?php echo $t04_angsuran_list->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_angsuran->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_angsuran->pinjamantitipan_id->Visible) { // pinjamantitipan_id ?>
		<td data-name="pinjamantitipan_id">
<span id="el$rowindex$_t04_angsuran_pinjamantitipan_id" class="form-group t04_angsuran_pinjamantitipan_id">
<select data-table="t04_angsuran" data-field="x_pinjamantitipan_id" data-value-separator="<?php echo $t04_angsuran->pinjamantitipan_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" name="x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id"<?php echo $t04_angsuran->pinjamantitipan_id->EditAttributes() ?>>
<?php echo $t04_angsuran->pinjamantitipan_id->SelectOptionListHtml("x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" id="s_x<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" value="<?php echo $t04_angsuran->pinjamantitipan_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t04_angsuran" data-field="x_pinjamantitipan_id" name="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" id="o<?php echo $t04_angsuran_list->RowIndex ?>_pinjamantitipan_id" value="<?php echo ew_HtmlEncode($t04_angsuran->pinjamantitipan_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_angsuran_list->ListOptions->Render("body", "right", $t04_angsuran_list->RowCnt);
?>
<script type="text/javascript">
ft04_angsuranlist.UpdateOpts(<?php echo $t04_angsuran_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t04_angsuran->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t04_angsuran_list->FormKeyCountName ?>" id="<?php echo $t04_angsuran_list->FormKeyCountName ?>" value="<?php echo $t04_angsuran_list->KeyCount ?>">
<?php } ?>
<?php if ($t04_angsuran->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t04_angsuran_list->FormKeyCountName ?>" id="<?php echo $t04_angsuran_list->FormKeyCountName ?>" value="<?php echo $t04_angsuran_list->KeyCount ?>">
<?php echo $t04_angsuran_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t04_angsuran->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t04_angsuran_list->Recordset)
	$t04_angsuran_list->Recordset->Close();
?>
<?php if ($t04_angsuran->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t04_angsuran->CurrentAction <> "gridadd" && $t04_angsuran->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t04_angsuran_list->Pager)) $t04_angsuran_list->Pager = new cPrevNextPager($t04_angsuran_list->StartRec, $t04_angsuran_list->DisplayRecs, $t04_angsuran_list->TotalRecs) ?>
<?php if ($t04_angsuran_list->Pager->RecordCount > 0 && $t04_angsuran_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t04_angsuran_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t04_angsuran_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t04_angsuran_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t04_angsuran_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t04_angsuran_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t04_angsuran_list->PageUrl() ?>start=<?php echo $t04_angsuran_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t04_angsuran_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_angsuran_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t04_angsuran_list->TotalRecs == 0 && $t04_angsuran->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_angsuran_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t04_angsuran->Export == "") { ?>
<script type="text/javascript">
ft04_angsuranlistsrch.FilterList = <?php echo $t04_angsuran_list->GetFilterList() ?>;
ft04_angsuranlistsrch.Init();
ft04_angsuranlist.Init();
</script>
<?php } ?>
<?php
$t04_angsuran_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t04_angsuran->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t04_angsuran_list->Page_Terminate();
?>
