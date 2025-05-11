<?php
/**
 * BiglyPay Payment Gateway for HostBill
 * Ported directly from WHMCS version
 */
define('BIGLYPAY_MODULE_VERSION', '1.0.0');

if (!defined("HOSTBILL_PATH")) {
    die("This file cannot be accessed directly");
}

/**
 * Module configuration
 */
function biglypay_config()
{
    return [
        "FriendlyName" => [
            "Type"  => "System",
            "Value" => "BiglyPay Crypto Gateway"
        ],
        "apiKey" => [
            "FriendlyName" => "API Key",
            "Type"         => "text",
            "Description"  => "Enter the API Key provided by BiglyPay"
        ],
        "ipnKey" => [
            "FriendlyName" => "IPN Key",
            "Type"         => "text",
            "Description"  => "Enter the IPN Key for callback validation"
        ],
        "clogo" => [
            "FriendlyName" => "Company Logo URL",
            "Type"         => "text",
            "Description"  => "Optional: Logo to display on BiglyPay remote checkout page"
        ],
    ];
}

/**
 * Link generation - displays the Pay button and posts data to BiglyPay
 */
function biglypay_link($params)
{
    $invoiceId   = $params['invoiceid'];
    $amount      = $params['amount'];
    $currency    = $params['currency'];
    $client      = $params['client'];
    $clientEmail = $client['email'];
    $clientId    = $client['id'];
    $domain      = $_SERVER['HTTP_HOST'];

    $apiKey  = $params['apiKey'];
    $logo    = $params['clogo'];

    $returnUrl = $params['systemurl'] . 'index.php?cmd=invoices';

    $postFields = [
        'userid'      => $clientId,
        'invoiceid'   => $invoiceId,
        'amount'      => $amount,
        'currency'    => $currency,
        'returnurl'   => $returnUrl,
        'apiKey'      => $apiKey,
        'logo'        => filter_var($logo, FILTER_VALIDATE_URL) ? $logo : '',
        'domain'      => $domain,
        'email'       => $clientEmail,
    ];

    $remoteUrl = "https://biglypay.com/remote_payment.php";

    $html = "<div style='text-align:center;padding:15px;'>
                <form action='{$remoteUrl}' method='POST'>";

    foreach ($postFields as $key => $val) {
        $html .= "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($val) . "' />";
    }

    $html .= "<p>Please click the button below to pay using BiglyPay.</p>
              <button type='submit' style='padding:10px 20px;font-weight:bold;'>Pay with BiglyPay</button>
              </form>
             </div>";

    return $html;
}
