# laravel-paycoin

> A Laravel Package for working with paycoin easily

## Installation

[PHP](https://php.net) 5.4+ and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Paycoin, simply require it

```bash
$ composer require paycoin/paycoin-laravel
```

## Configuration

You can publish the configuration file using this command:

```bash
$ php artisan vendor:publish

"then input 0 follow by enter key"
```

## Usage
Open your .env file and add yoursecret key like so:

```bash
secret_key=xxxxxxxxxxxxxxxxxxxxxxxxxx
```

You can simply use these functons within your controllers: 

### Get All Invoices

```php
use Paycoin\Paycoins\Paycoins;

public function getAllInvoices()
{
    return Paycoins::getInvoices();
}
```

### Get Invoice By Ref

```php
use Paycoin\Paycoins\Paycoins;

public function getInvoiceByRef()
{
    return Paycoins::getInvoice("INV1626354432969");
}
```

### Create Invoice

```php
use Paycoin\Paycoins\Paycoins;

public function createInvoice()
{
    return Paycoins::create_invoice(
        (object)[
            "amount" => 1000000,
            "currency" => 'NGN',
            "redirect_url"=> 'https://abc.com',
            "customer" => [
                'firstname' => "test",
                'lastname' => "name",
                'email' => "testname@mail.com"
            ],
            "customization" => [
                "title" => "Sales"
            ]
        ]
    );
}
```

### Get Current Market Exchange Rates of 1 NGN to all other cryptos and fiat currencies

```php
use Paycoin\Paycoins\Paycoins;

public function getExchangeRates()
{
    return Paycoins::exchangeRate("NGN");
}
```
