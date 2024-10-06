<?php
namespace Parasut;

class Contact extends Base
{
    public function create($data)
    {
        return $this->client->request(
            'contacts',
            $data,
            'POST'
        );
    }

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
			"contacts?$filter",
			[],
			'GET'
		);
	}

    public function show($id , $data = [])
    {
        return $this->client->request(
            'contacts/' . $id,
            $data,
            'GET'
        );
    }

    public function update($id , $data = [])
    {
        return $this->client->request(
            'contacts/' . $id,
            $data,
            'PUT'
        );
    }
}