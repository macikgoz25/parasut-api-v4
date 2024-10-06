<?php
namespace Parasut;

class Account extends Base
{ 
    public function search($data = [])
	{
		$filter = null;

		foreach ($data as $key => $value)
		{
			if (end($data) == $value)
				$filter .= "filter[$key]=".urlencode($value);
			else
				$filter .= "filter[$key]=".urlencode($value)."&";
		}

		return $this->client->request(
			"accounts?$filter",
			[],
			'GET'
		);
	}

    public function show($id, $params = [])
    {
        return $this->client->request(
          'accounts/'.$id,
          $params,
          'GET'
        );
    }

    public function transactions($id, $params = [])
    {
        return $this->client->request(
          'accounts/'.$id.'/transactions',
          $params,
          'GET'
        );
    } 

    public function deleteTransaction($transaction_id, $params = [])
    {
        return $this->client->request(
          'transactions/'.$transaction_id,
          $params,
          'DELETE'
        );
    }
 
}