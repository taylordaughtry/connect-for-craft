<?php

namespace Craft;

class ConnectVariable {

	function getPosts($limit = 5)
	{
		return craft()->connect->getPosts($limit);
	}

}
