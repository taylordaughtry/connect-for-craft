<?php

namespace Craft;

use Facebook\Facebook;
use Facebook\FacebookRequest;
use \Guzzle\Http\Client;

class ConnectService extends BaseApplicationComponent
{

	public function getPosts()
	{
		$appId = '526715080828830';
		$appSecret = '65c392edf63064a6c8c820eeb8713083';
		$baseUrl = 'https://graph.facebook.com/v2.5/';
		$pageId = '1494584574175100';
		$accessToken = $appId . '%7C' . $appSecret;

		$client = new Client();
		$response = $client->get($baseUrl . '/' . $pageId . '/feed?access_token=' . $accessToken)->send();

		$items = $response->json();

		return $items['data'];
	}

	/**
	 * Use Craft's included Guzzle library to make an API request
	 *
	 * @param  string $url  The URL to query
	 *
	 * @return void
	 */

	private function _curlRequest($url = '')
	{
		try
		{
			$client  = new \Guzzle\Http\Client($url);
			$request = $client->get($url, array(
					'Accept' => 'application/rss+xml',
					'Accept' => 'application/rdf+xml',
					'Accept' => 'application/xml',
					'Accept' => 'text/xml'
				)
			);

			$response = $request->send();

			return $response->getBody(true);
		}
		catch(\Exception $e)
		{
			FeederPlugin::log($e->getResponse(), LogLevel::Error, true);

			$response = $e->getResponse();

			return $response;
		}
	}

}