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
## Webhooks
Webhooks allow you to configure a URL that will be notified every time an event occurs on your account. When one of the events you subscribe to happens, paycoins will send a json object representing that event through a HTTP POST request to your webhooks URL.

### Webhook configuration
You can either edit your existing webhook configurations, or click “Add Webhook” configurations in your paycoins developer account settings. The most important things is to provide the <b>URL</b> address that events should be sent to.

### Responding to webhook
We do not expect any response from the endpoint you configure. You can respond with a customary HTTP 200 code, however this is not required. We currently do not support resending events that were failed to be properly delivered.

### Event types
This is a list of all the types of events we currently send. We may add more at any time, so you shouldn’t rely on only these types existing in your code.

#### `New deposited payment`
Sent when new payment has been deposited to your wallet.

##### `Response results`
```javascript
data: {
  currency: "BTC",
  amount: 0.001,
  type: "payment-successful",
  reference: "INV1608644446774",
},
```

#### `Payout`
Sent when new payout/withdrawal is made on your wallet.
##### `Response results.`
N.B: This respnse may varies depending on the status of the payout action

`payout successful response`
```javascript
data: {
  currency: "BTC",
  amount: 0.001,
  type: "payout",
  status: "successful"
},
```

`payout failed response`
```javascript
data: {
  currency: "BTC",
  amount: 0.001,
  type: "payout",
  status: "failed"
},
```
`payout request expired response`
```javascript
data: {
 currency: "BTC",
  amount: 0.001,
  type: "payout",
  status: "expired"
},
```

`payout cancelled response`
```javascript
data: {
  currency: "BTC",
  amount: 0.001,
  type: "payout",
  status:"canceled"
},
```