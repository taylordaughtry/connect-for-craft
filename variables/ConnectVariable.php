<?php

namespace Craft;

class ConnectVariable {

	function getPosts()
	{
		return craft()->connect->getPosts();
	}

}
