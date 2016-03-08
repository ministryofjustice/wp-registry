<?php

namespace App\Services;

use GuzzleHttp\Client;
use Cache;

class WordPressVersion
{
    /**
     * Number of minutes to cache responses from the WordPress.org API
     *
     * @var int
     */
    public $cacheMinutes = 60;

    /**
     * Return the current version of WordPress core.
     *
     * @return string
     */
    public function core()
    {
        return Cache::remember('WordPressVersion_core', $this->cacheMinutes, function() {
            $response = $this->apiCall('/core/version-check/1.7/');
            return $response->offers[0]->current;
        });
    }

    /**
     * Return the current version of the specified WordPress plugin.
     *
     * @param string $slug The plugin slug
     * @return string
     */
    public function plugin($slug)
    {
        return Cache::remember('WordPressVersion_plugin_' . $slug, $this->cacheMinutes, function() use ($slug) {
            $response = $this->apiCall('/plugins/info/1.0/' . $slug . '.json');
            if (is_null($response)) {
                return false;
            } else {
                return $response->version;
            }
        });
    }

    /**
     * Perform a call to the WordPress.org API
     *
     * @param string $path URL path to call - e.g. /core/version-check/1.7/
     * @return mixed Object representing the JSON response
     */
    protected function apiCall($path)
    {
        $client = new Client();
        $requestUrl = 'https://api.wordpress.org' . $path;
        $res = $client->request('GET', $requestUrl);
        if ($res->getStatusCode() !== 200) {
            throw new \RuntimeException('The WordPress.org API returned a non-200 response');
        }
        if (!starts_with($res->getHeaderLine('Content-Type'), 'application/json')) {
            throw new \RuntimeException('The WordPress.org API responded with unexpected content type "' . $res->getHeaderLine('Content-Type') . '"');
        }
        $response = json_decode($res->getBody());
        return $response;
    }
}