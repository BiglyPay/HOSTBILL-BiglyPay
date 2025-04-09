<?php
/**
 * BiglyPay Callback Handler for HostBill
 * Based on WHMCS callback structure, adapted for HostBill
 */

require_once '../../../init.php';
require_once '../../../includes/hosting.php';

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die("Method Not Allowed");
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['invoice_id'], $input['related_invoice_id'], $input['status'], $input['received_amount'], $input['ipn_key'], $input['tx_hash'])) {
    http_response_code(400);
    die("Missing required parameters");
}

// Load gateway config
$gateway = 'biglypay';
$gatewayParams = get_module_params($gateway);

if (!$gatewayParams || empty($gatewayParams['ipnKey'])) {
    http_response_code(400);
    die("Module not configured");
}

if ($input['ipn_key'] !== $gatewayParams['ipnKey']) {
    http_response_code(403);
    die("Invalid IPN Key");
}

$invoiceId = (int) $input['related_invoice_id'];
$amount    = (float) $input['received_amount'];
$txId      = $input['tx_hash'];
$status    = $input['status'];

// Ensure invoice exists
$invoice = get_invoice($invoiceId);
if (!$invoice) {
    http_response_code(404);
    die("Invoice not found");
}

// Check if transaction ID already used
if (transaction_exists($txId)) {
    http_response_code(409);
    die("Duplicate transaction");
}

// Handle confirmed payment
if ($status === 'Confirmed') {
    add_invoice_payment($invoiceId, $txId, $amount, 0, $gateway);
    log_gateway_callback($gateway, $input, "Confirmed payment of $amount");
    http_response_code(200);
    echo "OK";
} else {
    log_gateway_callback($gateway, $input, "Unconfirmed or failed payment");
    http_response_code(202);
    echo "Pending";
}
