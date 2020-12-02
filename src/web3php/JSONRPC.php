<?php
namespace Nawab69\Web3PHP;

use GuzzleHttp\Client;

class JSONRPC
{
	protected $host, $port, $version;
	protected $id = 0;
	
	public function __construct($host = null, $port = null, $version="2.0")
	{
		if (!$host && !$port) {
			$host = config('web3.url');
			$port = config('web3.port');
		}
		$this->host = $host;
		$this->port = $port;
		$this->version = $version;
	}

	public function setHost($url) 
	{
		$this->host = $host;
	}

	public function setPort($port) 
	{
		$this->port = $port;
	}
	
	public function rpcRequest($method, $params=array())
	{
		$data = json_encode([
			'jsonrpc' 	=> $this->version, 
			'id'		=> $this->id, 
			'method' 	=> $method, 
			'params' 	=> array_values($params)
		]);

		$data = [
			'body' => $data, 
			'headers' 	=> [
				'Content-Type' => 'application/json',
		    ]
		];

		$client = new Client();
		$response = $client->request(
			'POST', 
			$this->host . ':' . $this->port, 
			$data
		)->getBody()->getContents();

		$response = json_decode($response, true);

        if (json_last_error() > 0) {
            throw new \Exception(json_last_error_msg());
        }

        if ($response['id'] !== $this->id) {
            throw new \Exception(
                sprintf('Given ID %d, differs from expected %d', $response['id'], $this->id)
            );
        } elseif (!empty($response['error'])) {
            throw new \Exception('Error: ' . json_encode($response['error']['message']));
		}

        return $response;
	}
	
	private function format_response($response)
	{
		return @json_decode($response);
	}
}