<?php

namespace Craft;

use Facebook\Facebook;
use Facebook\FacebookRequest;
use \Guzzle\Http\Client;

class ConnectService extends BaseApplicationComponent
{
	/**
	 * Get the most recent posts from a certain Facebook Page and wraps all
	 * links with HTML anchor links.
	 *
	 * @method getPosts
	 *
	 * @param int $limit The number of posts to get.
	 *
	 * @return array Page posts with keys of 'message, created_time, id'
	 */
	public function getPosts($limit)
	{
		$appId = '526715080828830';
		$appSecret = '65c392edf63064a6c8c820eeb8713083';
		$baseUrl = 'https://graph.facebook.com/v2.5/';
		$pageId = '881444838597214';
		$accessToken = $appId . '%7C' . $appSecret;

		if (craft()->cache->get('connectPosts')) {
			return craft()->cache->get('connectPosts');
		}

		$client = new Client();

		$posts = $client
			->get($baseUrl . '/' . $pageId . '/feed?limit=' . $limit . '&access_token=' . $accessToken)
			->send()
			->json()['data'];

		$pattern = '/(http:\/\/[a-z0-9\.\/]+)/i';

		$replacement = '<a href="$1" target="_blank">$1</a>';

		for($i = 0; $i < count($posts); $i++) {
			$source = $posts[$i]['message'];

			$linkedMessage = preg_replace($pattern, $replacement, $source);

			$posts[$i]['message'] = $linkedMessage;
		}

		// Cache in 5-minute increments
		craft()->cache->set('connectPosts', $posts, 600);

		return $posts;
	}
}