<?php
namespace Wizzaro\Slider\Config;

use Wizzaro\WPFramework\v1\Config\AbstractPluginConfig;

class PluginConfig extends AbstractPluginConfig {

    private $unique_id = 0;

    public function generateSliderUniqueId() {
        $this->unique_id++;
        return $this->unique_id;
    }
}
