<?php
namespace Craft;

class ConnectPlugin extends BasePlugin
{
    public function init()
    {
        require CRAFT_PLUGINS_PATH.'connect/vendor/autoload.php';
    }

    public function getName()
    {
        return Craft::t('Connect');
    }

    public function getVersion()
    {
        return '0.1.0';
    }

    public function getDeveloper()
    {
        return 'Taylor Daughtry';
    }

    public function getDeveloperUrl()
    {
        return 'http://github.com/taylordaughtry/connect-for-craft';
    }

}
