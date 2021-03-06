<?php

namespace VKGroupParser;

require_once("../vendor/autoload.php");

use VK\Client\VKApiClient;

class Parser {
    private $accessToken;
    
    private $exitFilePath;

    private $excludedIds;

    private $q;

    private $count;

    public function setAccessToken($accessToken) 
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function setExitFilePath($exitFilePath) 
    {
        $this->exitFilePath = $exitFilePath;

        return $this;
    }

    public function setExcudedIds($excludedIds) {
        $this->excludedIds = $excludedIds;

        return $this;
    }

    public function setQ($q) 
    {
        $this->q = $q;

        return $this;
    }

    public function setCount($count) 
    {
        $this->count = $count;

        return $this;
    }

    public function parse() {
        if(!$this->accessToken) {
            echo "Error: not set access token. Use setAccessToken().\r\n";
        }

        if(!$this->exitFilePath) {
            echo "Error: not set exit file path. Use setExitFilePath().\r\n";
        }

        if(!$this->q) {
            echo "Error: not set q (query). Use setQ().\r\n";
        }

        $vk = new VKApiClient();

        $groups = $vk->groups()->search($this->accessToken, [
            'q' => $this->q,
            'count' => $this->count,
        ]);

        foreach($groups['items'] as $group) {
            if(!in_array($group['id'], $this->excludedIds)) {
                $ids_group[] = $group['id'];
            }
        }

        file_put_contents($this->exitFilePath, implode("\r\n", $ids_group));
    }
}
?>