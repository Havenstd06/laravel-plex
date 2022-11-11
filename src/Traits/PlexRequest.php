<?php

namespace Hav2nstd06\LaravelPlex\Traits;

use Hav2nstd06\LaravelPlex\Services\Plex;
use RuntimeException;

trait PlexRequest
{
    use PlexHttpClient;
    use PlexAPI;

    /**
     * Plex API Token.
     *
     * @var string
     */
    public string $token;

    /**
     * Plex API configuration.
     *
     * @var array
     */
    private array $config;

    /**
     * Additional options for Plex API request.
     *
     * @var array
     */
    protected array $options = [];

    /**
     * Set Plex API Credentials.
     *
     * @param array $credentials
     * @throws \Exception
     */
    public function setApiCredentials(array $credentials): void
    {
        if (empty($credentials)) {
            $this->throwConfigurationException();
        }

        // Set API configuration for the Plex provider
        $this->setApiProviderConfiguration($credentials);

        // Set Http Client configuration.
        $this->setHttpClientConfiguration();
    }

    /**
     * Set configuration details for the provider.
     *
     * @param array $credentials
     *
     * @throws \Exception
     */
    private function setApiProviderConfiguration(array $credentials): void
    {
        // Setting Plex API Credentials
        if (empty($credentials['server_url'])) {
            throw new RuntimeException("Servers URL missing from the provided configuration. Please add your application server URL.");
        }

        if (empty($credentials['token'])) {
            throw new RuntimeException("Token missing from the provided configuration. Please add your application token.");
        }

        collect($credentials)->map(function ($value, $key) {
            $this->config[$key] = $value;
        });

        $this->validateSSL = $this->config['validate_ssl'];

        $this->token = $this->config['token'];

        $this->setRequestHeader('X-Plex-Token', $this->token);

        $this->setOptions($this->config);
    }

    /**
     * Function to add request header.
     *
     * @param string $key
     * @param string $value
     *
     * @return Plex
     */
    public function setRequestHeader(string $key, string $value): Plex
    {
        $this->options['headers'][$key] = $value;

        return $this;
    }

    /**
     * Return request options header.
     *
     * @param string $key
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function getRequestHeader(string $key): string
    {
        if (isset($this->options['headers'][$key])) {
            return $this->options['headers'][$key];
        }

        throw new RuntimeException('Options header is not set.');
    }

    /**
     * Function to add request query.
     *
     * @param string $key
     * @param string $value
     *
     * @return Plex
     */
    public function setRequestQuery(string $key, string $value): Plex
    {
        $this->options['query'][$key] = $value;

        return $this;
    }

    /**
     * Return request options header.
     *
     * @param string $key
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function getRequestQuery(string $key): string
    {
        if (isset($this->options['query'][$key])) {
            return $this->options['query'][$key];
        }

        throw new RuntimeException('Options query is not set.');
    }

    /**
     * Function To Set Plex API Configuration.
     *
     * @param array $config
     *
     * @throws \Exception
     */
    private function setConfig(array $config): void
    {
        $apiConfig = function_exists('config') && !empty(config('plex')) ? config('plex') : $config;

        // Set Api Credentials
        $this->setApiCredentials($apiConfig);
    }

    /**
     * @throws RuntimeException
     */
    private function throwConfigurationException()
    {
        throw new RuntimeException('Invalid configuration provided. Please provide valid configuration for Plex API.');
    }
}
