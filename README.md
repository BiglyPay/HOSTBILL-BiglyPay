# HOSTBILL-BiglyPay
# BiglyPay Crypto Payment Gateway for HostBill

BiglyPay is a cryptocurrency payment gateway module for HostBill that enables your business to accept crypto payments seamlessly. This module monitors blockchain transactions, updates invoice statuses (e.g., Partially Paid or Fully Paid), and logs transaction details in HostBill. For fee details, visit https://biglypay.com/#Fees

## Register
https://biglypay.com/register.php

## Features

- **Seamless Integration:** Easily integrate with HostBill using its native gateway system.
- **Multi-Crypto Support:** Accept payments in various cryptocurrencies (e.g., ETH, BNB, BIGLY, USDT, DOGE, TRX, BTC/LTC, etc.) through BiglyPay’s infrastructure.
- **Automatic Invoice Updates:** Automatically update invoice statuses based on blockchain payment confirmations.
- **Transaction Logging:** All transaction details are recorded in HostBill for audit and reporting purposes.
- **Centralized Settings:** Configure your API key, IPN key, and logo directly through the HostBill module settings.

## Requirements

- **HostBill:** A compatible version with module support (consult your HostBill documentation for version specifics).
- **PHP:** Version 7.2 or above.
- **MySQL:** For storing transaction and invoice data.

## Installation

1. **Clone the Repository:**

   git clone https://github.com/BiglyPay/HOSTBILL-BiglyPay.git

2. **Copy Files:**

   - Copy the contents of the `includes/modules/gateways/` folder from the repository into your HostBill installation directory under `includes/modules/gateways/`.
   - Copy the callback handler file (`callback_biglypay.php`) into the same modules subdirectory or as specified by your HostBill installation guidelines.

3. **Set Permissions:**

   Ensure that all module files are readable by your web server.

## Activate and Configure the Gateway Module

1. **Activate the Module:**

   - Log in to your HostBill admin area.
   - Navigate to **Setup > Payment Gateways**.
   - Locate and activate **BiglyPay Crypto Gateway**.

2. **Configure Module Settings:**

   Once activated, you will be able to set the following configuration options from the HostBill admin panel:

   - **API Key:**  
     Enter the API Key provided by your BiglyPay account. This is required to authenticate your transactions.
   
   - **IPN Key:**  
     Enter the IPN Key for secure callback validation. (This key must also be set in your BiglyPay Merchant Settings.)

   - **Company Logo URL:**  
     Optionally, specify the URL of your logo that will display on the BiglyPay remote checkout page.

## Usage

Once activated and configured, the BiglyPay module will:

- Monitor cryptocurrency transactions corresponding to each invoice.
- Automatically update invoice statuses (e.g., "Partially Paid" or "Fully Paid") based on the amount received.
- Log all transaction details in HostBill for reporting and reconciliation purposes.

## Contributing

Contributions are welcome! If you have suggestions or improvements, please open an issue or submit a pull request. Make sure to follow the project’s coding standards and include appropriate tests for any new functionality.

## License

This project is licensed under the MIT License. See the LICENSE file for further details.

## Support

For additional support or inquiries, please visit the BiglyPay website or contact support via the BiglyPay control panel.
