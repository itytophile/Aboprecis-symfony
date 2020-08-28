<?php

namespace App\Service;

use Google_Client;
use Google_Service_YouTube;

class YoutubeApi {
    private $service;

    function __construct(string $apiFilePath)
    {
        $json = file_get_contents($apiFilePath);
        $key = json_decode($json)->key;

        $client = new Google_Client();
        $client->setApplicationName('Aboprecis');
        $client->setDeveloperKey($key);

        $this->service = new Google_Service_YouTube($client);
    }

    function getChannelsByName(string $channelName, int $maxResults)
    {
        $params = [
            'type' => 'channel',
            'q' => $channelName,
            'maxResults' => $maxResults
        ];

        $results = $this->service->search->listSearch('snippet', $params);

        $channels = [];

        foreach($results->getItems() as $item) {
            $snippet = $item->snippet;
            $channels[] = [
                'url' => 'https://www.youtube.com/channel/'.$snippet->channelId,
                'img' => $snippet->thumbnails->default->url,
                'title' => $snippet->title,
            ];
        }

        return $channels;
    }
}