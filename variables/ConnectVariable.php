<?php

namespace Craft;

class ConnectVariable {

	function posts($limit = 5)
	{
		return craft()->connect->getPosts($limit);
	}

}
