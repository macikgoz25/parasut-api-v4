# Parasut PHP Client

**Parasut Php Api V4 with PHP**

## Install
```
composer require macikgozzz/parasut-api-v4
```

## Usage
```php
<?php
use Parasut;

require_once __DIR__ . '/vendor/autoload.php';

$client = new Client([
    "client_id" => "xxxxxxx",
	"username" => "xxxxxx",
	"password" => "xxxxxxxx",
	"grant_type" => "password",
	"redirect_uri" => "urn:ietf:wg:oauth:2.0:oob",
    'company_id' => "xxxxx"
]);

// automatically get access token and save src/token.ini
```

* Create a new Customer Account

```php
$customer = array (
    'data' =>
        array (
            'type' => 'contacts',
            'attributes' => array (
                    'email' => 'email-address',
                    'name' => 'username', // REQUIRED
                    'short_name' => 'xxxx',
                    'contact_type' => 'person', // or company
                    'district' => 'Bagcilar',
                    'city' => 'İstanbul',
                    'address' => 'xxxxxxx',
                    'phone' => '+90xxxxxxxxxx',
                    'account_type' => 'customer', // REQUIRED
                    'tax_number' => 'xxxxxxxx ', // TC no for person
                    'tax_office' => 'Istanbul'
            ),
            "relationships" => array (  // not required
                "category" => array (
                    "data" => array (
                        "id" => "xxx",
                        "type" => "item_categories"
                    )
                )
            )
        ),
);
$client->call(Parasut\Account::class)->create($customer);
// or
$account = new Parasut\Account($client);
$account->create($customer);
```

* Create Invoice

```php
$invoice = array (
    'data' => array (
       'type' => 'sales_invoices', // Required
       'attributes' => array (
           'item_type' => 'invoice', // Required
           'description' => 'Description',
           'issue_date' => '2024-10-06', // Required
           'due_date' => '2024-11-06',
           'invoice_series' => 'test',
           'invoice_id' => 1,
           'currency' => 'TRL'
       ),
       'relationships' => array (
           'details' => array (
               'data' =>array (
                   0 => array (
                       'type' => 'sales_invoice_details',
                       'attributes' => array (
                           'quantity' => 1,
                           'unit_price' => 999.90,
                           'vat_rate' => 20,
                           'description' => 'Water Pump'
                       ),
                       "relationships" => array (
                           "product" => array (
                               "data" => array (
                                   "id" => "xxxxx", 
                                   "type" => "products"
                               )
                           )
                       )
                   ),
                   1 => array (
                       'type' => 'sales_invoice_details',
                       'attributes' => array (
                           'quantity' => 1,
                           'unit_price' => 225.90,
                           'vat_rate' => 20,
                           'discount_type' => 'percentage',
                           'discount_value' => 10,
                           'description' => 'PISTON RING'
                       ),
                       "relationships" => array (
                           "product" => array (
                               "data" => array (
                                   "id" => "xxxxxx",
                                   "type" => "products"
                               )
                           )
                       )
                   ),
               ),
           ),
           'contact' => array (
               'data' => array (
                   'id' => 'xxxx',
                   'type' => 'contacts'
               )
           )
       ),
    )
);
$client->call(Parasut\Invoice::class)->create($invoice);
```

* Add Payment

```php
$payment = array(
    "data" => array(
        "type" => "payments",
        "attributes" => array(
            "description" => "Payment desc",
            "account_id" => "xxx",
            "date" => "2024-10-06",
            "amount" => 99.42,
            "exchange_rate" => 1.0
        )
    )
);
$invoice_id = xxx;
$client->call(Parasut\Invoice::class)->pay($id, $payment);
```

* Create E Archive Invoice

```php
$invoice = array (
    "data" => array(
        "type" => "e_archives",
        "relationships" => array (
            "sales_invoice" => array (
                "data" => array (
                    "id" => xxxx, // Invoice Id
                    "type" => "sales_invoices"
                )
            )
        )
    )
);
$client->call(Parasut\Invoice::class)->create_e_archive($invoice);
```

* Create Product

```php
$product = array(
    'data' => array (
        'type' => 'products',
        'attributes' => array (
            'name' => 'Product Name'
        )
    )
);
$client->call(Parasut\Product::class)->create($product);
```


