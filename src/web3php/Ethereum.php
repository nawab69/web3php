<?php
namespace Nawab69\Web3PHP;

class Ethereum extends JSONRPC
{
	private function ether_request($method, $params=array())
	{
		$ret = $this->rpcRequest($method, $params);
		return $ret['result'];
	}
	
	private function decode_hex($input)
	{
		if(substr($input, 0, 2) == '0x')
			$input = substr($input, 2);
		
		if(preg_match('/[a-f0-9]+/', $input))
			return hexdec($input);
			
		return $input;
	}
	
	public function web3_clientVersion()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function web3_sha3($input)
	{
		return $this->ether_request(__FUNCTION__, array($input));
	}
	
	public function net_version()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function net_listening()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function net_peerCount()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_protocolVersion()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_coinbase()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_mining()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_hashrate()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_gasPrice()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_accounts()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_blockNumber($decode_hex=FALSE)
	{
		$block = $this->ether_request(__FUNCTION__);
		
		if($decode_hex)
			$block = $this->decode_hex($block);
		
		return $block;
	}
	
	public function eth_getBalance($address, $block='latest', $decode_hex=false)
	{	
		$balance = $this->ether_request(__FUNCTION__, array($address, $block));
		
		if($decode_hex)
			$balance = $this->decode_hex($balance);
		
		return $balance;
	}
	
	public function eth_getStorageAt($address, $at, $block='latest')
	{
		return $this->ether_request(__FUNCTION__, array($address, $at, $block));
	}
	
	public function eth_getTransactionCount($address, $block='latest', $decode_hex=FALSE)
	{
		$count = $this->ether_request(__FUNCTION__, array($address, $block));
        
        if($decode_hex)
            $count = $this->decode_hex($count);
            
        return $count;   
	}
	
	public function eth_getBlockTransactionCountByHash($tx_hash)
	{
		return $this->ether_request(__FUNCTION__, array($tx_hash));
	}
	
	public function eth_getBlockTransactionCountByNumber($tx='latest')
	{
		return $this->ether_request(__FUNCTION__, array($tx));
	}
	
	public function eth_getUncleCountByBlockHash($block_hash)
	{
		return $this->ether_request(__FUNCTION__, array($block_hash));
	}
	
	public function eth_getUncleCountByBlockNumber($block='latest')
	{
		return $this->ether_request(__FUNCTION__, array($block));
	}
	
	public function eth_getCode($address, $block='latest')
	{
		return $this->ether_request(__FUNCTION__, array($address, $block));
	}
	
	public function eth_sign($address, $input)
	{
		return $this->ether_request(__FUNCTION__, array($address, $input));
	}
	
	public function eth_sendTransaction($transaction)
	{
		if(!is_a($transaction, 'EthereumTransaction'))
		{
			throw new ErrorException('Transaction object expected');
		}
		else
		{
			return $this->ether_request(__FUNCTION__, $transaction->toArray());	
		}
	}
	
	public function eth_call($message, $block)
	{
		if(!is_a($message, 'Ethereum_Message'))
		{
			throw new ErrorException('Message object expected');
		}
		else
		{
			return $this->ether_request(__FUNCTION__, $message->toArray());
		}
	}
	
	public function eth_estimateGas($message, $block)
	{
		if(!is_a($message, 'Ethereum_Message'))
		{
			throw new ErrorException('Message object expected');
		}
		else
		{
			return $this->ether_request(__FUNCTION__, $message->toArray());
		}
	}
	
	public function eth_getBlockByHash($hash, $full_tx=TRUE)
	{
		return $this->ether_request(__FUNCTION__, array($hash, $full_tx));
	}
	
	public function eth_getBlockByNumber($block='latest', $full_tx=TRUE)
	{
		return $this->ether_request(__FUNCTION__, array($block, $full_tx));
	}
	
	public function eth_getTransactionByHash($hash)
	{
		return $this->ether_request(__FUNCTION__, array($hash));
	}
	
	public function eth_getTransactionByBlockHashAndIndex($hash, $index)
	{
		return $this->ether_request(__FUNCTION__, array($hash, $index));
	}
	
	public function eth_getTransactionByBlockNumberAndIndex($block, $index)
	{
		return $this->ether_request(__FUNCTION__, array($block, $index));
	}
	
	public function eth_getTransactionReceipt($tx_hash)
	{
		return $this->ether_request(__FUNCTION__, array($tx_hash));
	}
	
	public function eth_getUncleByBlockHashAndIndex($hash, $index)
	{
		return $this->ether_request(__FUNCTION__, array($hash, $index));
	}
	
	public function eth_getUncleByBlockNumberAndIndex($block, $index)
	{
		return $this->ether_request(__FUNCTION__, array($block, $index));
	}
	
	public function eth_getCompilers()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_compileSolidity($code)
	{
		return $this->ether_request(__FUNCTION__, array($code));
	}
	
	public function eth_compileLLL($code)
	{
		return $this->ether_request(__FUNCTION__, array($code));
	}
	
	public function eth_compileSerpent($code)
	{
		return $this->ether_request(__FUNCTION__, array($code));
	}
	
	public function eth_newFilter($filter, $decode_hex=FALSE)
	{
		if(!is_a($filter, 'EthereumFilter'))
		{
			throw new ErrorException('Expected a Filter object');
		}
		else
		{
			$id = $this->ether_request(__FUNCTION__, $filter->toArray());
			
			if($decode_hex)
				$id = $this->decode_hex($id);
			
			return $id;
		}
	}
	
	public function eth_newBlockFilter($decode_hex=FALSE)
	{
		$id = $this->ether_request(__FUNCTION__);
		
		if($decode_hex)
			$id = $this->decode_hex($id);
		
		return $id;
	}
	
	public function eth_newPendingTransactionFilter($decode_hex=FALSE)
	{
		$id = $this->ether_request(__FUNCTION__);
		
		if($decode_hex)
			$id = $this->decode_hex($id);
		
		return $id;
	}
	
	public function eth_uninstallFilter($id)
	{
		return $this->ether_request(__FUNCTION__, array($id));
	}
	
	public function eth_getFilterChanges($id)
	{
		return $this->ether_request(__FUNCTION__, array($id));
	}
	
	public function eth_getFilterLogs($id)
	{
		return $this->ether_request(__FUNCTION__, array($id));
	}
	
	public function eth_getLogs($filter)
	{
		if(!is_a($filter, 'EthereumFilter'))
		{
			throw new ErrorException('Expected a Filter object');
		}
		else
		{
			return $this->ether_request(__FUNCTION__, $filter->toArray());
		}
	}
	
	public function eth_getWork()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function eth_submitWork($nonce, $pow_hash, $mix_digest)
	{
		return $this->ether_request(__FUNCTION__, array($nonce, $pow_hash, $mix_digest));
	}
	
	public function db_putString($db, $key, $value)
	{
		return $this->ether_request(__FUNCTION__, array($db, $key, $value));
	}
	
	public function db_getString($db, $key)
	{
		return $this->ether_request(__FUNCTION__, array($db, $key));
	}
	
	public function db_putHex($db, $key, $value)
	{
		return $this->ether_request(__FUNCTION__, array($db, $key, $value));
	}
	
	public function db_getHex($db, $key)
	{
		return $this->ether_request(__FUNCTION__, array($db, $key));
	}
	
	public function shh_version()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function shh_post($post)
	{
		if(!is_a($post, 'WhisperPost'))
		{
			throw new ErrorException('Expected a Whisper post');
		}
		else
		{
			return $this->ether_request(__FUNCTION__, $post->toArray());
		}
	}
	
	public function shh_newIdentinty()
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function shh_hasIdentity($id)
	{
		return $this->ether_request(__FUNCTION__);
	}
	
	public function shh_newFilter($to=NULL, $topics=array())
	{
		return $this->ether_request(__FUNCTION__, array(array('to'=>$to, 'topics'=>$topics)));
	}
	
	public function shh_uninstallFilter($id)
	{
		return $this->ether_request(__FUNCTION__, array($id));
	}
	
	public function shh_getFilterChanges($id)
	{
		return $this->ether_request(__FUNCTION__, array($id));
	}
	
	public function shh_getMessages($id)
	{
		return $this->ether_request(__FUNCTION__, array($id));
	}
}

/**
 *	Ethereum transaction object
 */
class EthereumTransaction
{
	private $to, $from, $gas, $gasPrice, $value, $data, $nonce;
	
	function __construct($from, $to, $gas, $gasPrice, $value, $data='', $nonce=NULL)
	{
		$this->from = $from;
		$this->to = $to;
		$this->gas = $gas;
		$this->gasPrice = $gasPrice;
		$this->value = $value;
		$this->data = $data;
		$this->nonce = $nonce;
	}
	
	function toArray()
	{
		return array(
			array
			(
				'from'=>$this->from,
				'to'=>$this->to,
				'gas'=>$this->gas,
				'gasPrice'=>$this->gasPrice,
				'value'=>$this->value,
				'data'=>$this->data,
				'nonce'=>$this->nonce
			)
		);
	}
}

/**
 *	Ethereum transaction filter object
 */
class EthereumFilter
{
	private $fromBlock, $toBlock, $address, $topics;
	
	function __construct($fromBlock, $toBlock, $address, $topics)
	{
		$this->fromBlock = $fromBlock;
		$this->toBlock = $toBlock;
		$this->address = $address;
		$this->topics = $topics;
	}
	
	function toArray()
	{
		return array(
			array
			(
				'fromBlock'=>$this->fromBlock,
				'toBlock'=>$this->toBlock,
				'address'=>$this->address,
				'topics'=>$this->topics
			)
		);
	}
}

/**
 * 	Ethereum whisper post object
 */
class WhisperPost
{
	private $from, $to, $topics, $payload, $priority, $ttl;
	
	function __construct($from, $to, $topics, $payload, $priority, $ttl)
	{
		$this->from = $from;
		$this->to = $to;
		$this->topics = $topics;
		$this->payload = $payload;
		$this->priority = $priority;
		$this->ttl = $ttl;
	}
	
	function toArray()
	{
		return array(
			array
			(
				'from'=>$this->from,
				'to'=>$this->to,
				'topics'=>$this->topics,
				'payload'=>$this->payload,
				'priority'=>$this->priority,
				'ttl'=>$this->ttl
			)
		);
	}
}