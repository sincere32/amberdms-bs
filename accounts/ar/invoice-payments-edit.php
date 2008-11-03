<?php
/*
	accounts/ar/invoices-payments-edit.php
	
	access: account_ar_view

	Allows adjusting or addition of new payments to an invoice.
*/

// custom includes
require("include/accounts/inc_invoices.php");
require("include/accounts/inc_invoices_items.php");
require("include/accounts/inc_charts.php");


if (user_permissions_get('accounts_ar_view'))
{
	$id = $_GET["id"];

	// nav bar options.
	$_SESSION["nav"]["active"]	= 1;
	
	$_SESSION["nav"]["title"][]	= "Invoice Details";
	$_SESSION["nav"]["query"][]	= "page=accounts/ar/invoice-view.php&id=$id";

	$_SESSION["nav"]["title"][]	= "Invoice Items";
	$_SESSION["nav"]["query"][]	= "page=accounts/ar/invoice-payments.php&id=$id";
	$_SESSION["nav"]["current"]	= "page=accounts/ar/invoice-payments.php&id=$id";
	
	$_SESSION["nav"]["title"][]	= "Invoice Payments";
	$_SESSION["nav"]["query"][]	= "page=accounts/ar/invoice-payments.php&id=$id";
	
	$_SESSION["nav"]["title"][]	= "Invoice Journal";
	$_SESSION["nav"]["query"][]	= "page=accounts/ar/journal.php&id=$id";

	if (user_permissions_get('accounts_ar_write'))
	{
		$_SESSION["nav"]["title"][]	= "Delete Invoice";
		$_SESSION["nav"]["query"][]	= "page=accounts/ar/invoice-delete.php&id=$id";
	}


	function page_render()
	{
		$id		= security_script_input('/^[0-9]*$/', $_GET["id"]);


		/*
			Title + Summary
		*/
		print "<h3>INVOICE PAYMENTS</h3><br>";
		print "<p>This page allows you to manage payments made to this invoice.</p>";

		invoice_render_summarybox("ar", $id);

		invoice_form_items_render("ar", $id, "accounts/ar/invoice-payments-edit-process.php");



	} // end page_render

} // end of if logged in
else
{
	error_render_noperms();
}

?>
