<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Translations
{
    /**
     * Get Translations for example: fr
     *
     * @param string $lang
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getTranslations(string $lang = 'fr'): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "web/translations/{$lang}.json";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}