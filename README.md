# Web3PHP
A PHP/Laravel wrapper around web3 JavaScript API.

## Installation
``` bash
composer require ilyasdeckers/web3php
```

### Further steps for Laravel
When using Laravel, add the following lines to your `config/app.php`
``` php
'providers' => [
    ...
    IlyasDeckers\Web3PHP\Providers\Web3PHPServiceProvider::class,
    ...
],
'aliases' => [
    ...
    'Ethereum' => IlyasDeckers\Web3PHP\EthereumFacade::class,
    ...
],
```
then generate the config file
``` bash
# When using Laravel
php artisan vendor:publish
```
And edit your .env file with the following values
```
WEB3_URL='127.0.0.1'
WEB3_PORT=8545
```

## Usage
This example shows you how to get the balance for a given address.
### Laravel with facades
``` php
$eth = Ethereum::eth_getBalance('0x8fbb99e9e73cd62bb3adea5365ff0f9d90c9e532')
print $eth // Prints the account balance in hex.
```
### PHP
``` php
$eth = new \IlyasDeckers\Web3PHP\Ethereum($url, $port);
$eth = $eth->eth_getBalance('0x8fbb99e9e73cd62bb3adea5365ff0f9d90c9e532', $block='latest', $decode_hex=false);

print $eth // Prints the account balance in hex.
```

Full reference: https://github.com/ethereum/wiki/wiki/JavaScript-API#web3js-api-reference