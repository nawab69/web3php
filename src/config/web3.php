<?php

return [
    /*
     * Please provide a valid url to connect to a Ethereum node.
     * If you can't run a private Geth/Parity node you could use https://infura.io.
     */
    'url' => env('WEB3_URL', '127.0.0.1'),
    'port' => env('WEB3_PORT', 8545)

]; 