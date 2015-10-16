<?php

namespace Craft;

use Facebook\Facebook;
use Facebook\FacebookRequest;
use \Guzzle\Http\Client;

class ConnectService extends BaseApplicationComponent
{
	private $accessToken;
	private $appId = '526715080828830';
	private $appSecret = '65c392edf63064a6c8c820eeb8713083';
	private $baseUrl = 'https://graph.facebook.com/v2.5/';
	private $pageId = '881444838597214';

	public function __construct() {
		$this->accessToken = $this->appId . '%7C' . $this->appSecret;
	}
	/**
	 * Get the most recent posts from a certain Facebook Page and wraps all
	 * links with HTML anchor links.
	 *
	 * @param int $limit The number of posts to get.
	 * @return array Page posts with keys of 'message, created_time, id'
	 */
	public function getPosts($limit)
	{
		$cache = craft()->cache->get('connectPosts');

		if ($cache) {
			return $cache;
		}

		$client = new Client();

		$request = $client
			->get($this->baseUrl . '/' . $this->pageId . '/feed?limit=' . $limit . '&access_token=' . $this->accessToken)
			->send()
			->json();

		$posts = $request['data'];

		if ($posts) {
			$pattern = '/(http:\/\/[a-z0-9\.\/]+)/i';
			$replacement = '<a href="$1" target="_blank">$1</a>';

			foreach ($posts as $key => $val) {
				$posts[$key]['message'] = preg_replace($pattern, $replacement, $val['message']);
			}

			// Cache in 5-minute increments
			craft()->cache->set('connectPosts', $posts, 600);

			return $posts;
		} else {
			return 'Something went wrong.';
		}
	}
}