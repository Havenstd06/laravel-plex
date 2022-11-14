<?php

namespace Havenstd06\LaravelPlex\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as HttpClientException;
use GuzzleHttp\Utils;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use SimpleXMLElement;

trait PlexHttpClient
{
    /**
     * Http Client class object.
     *
     * @var HttpClient
     */
    private HttpClient $client;

    /**
     * Http Client configuration.
     *
     * @var array
     */
    private array $httpClientConfig;

    /**
     * Plex API Base URL.
     *
     * @var string
     */
    protected string $apiBaseUrl;

    /**
     * Plex API Endpoint.
     *
     * @var string
     */
    private string $apiUrl;

    /**
     * Plex API Endpoint.
     *
     * @var string
     */
    private string $apiEndPoint;

    /**
     * Http Client request body parameter name.
     *
     * @var string
     */
    private string $httpBodyParam;

    /**
     * Validate SSL details when creating HTTP client.
     *
     * @var bool
     */
    private bool $validateSSL;

    /**
     * Request type.
     *
     * @var string
     */
    protected string $verb = 'get';

    /**
     * Set curl constants if not defined.
     *
     * @return void
     */
    protected function setCurlConstants(): void
    {
        $constants = [
            'CURLOPT_SSLVERSION'        => 32,
            'CURL_SSLVERSION_TLSv1_2'   => 6,
            'CURLOPT_SSL_VERIFYPEER'    => 64,
            'CURLOPT_SSLCERT'           => 10025,
        ];

        foreach ($constants as $key => $item) {
            $this->defineCurlConstant($key, $item);
        }
    }

    /**
     * Declare a curl constant.
     *
     * @param string $key
     * @param string $value
     *
     * @return bool|string
     */
    protected function defineCurlConstant(string $key, string $value): bool|string
    {
        return defined($key) ? true : define($key, $value);
    }

    /**
     * Function to initialize/override Http Client.
     *
     * @param HttpClient|null $client
     *
     * @return void
     */
    public function setClient(HttpClient $client = null): void
    {
        if ($client instanceof HttpClient) {
            $this->client = $client;

            return;
        }

        $this->client = new HttpClient([
            'curl' => $this->httpClientConfig,
        ]);
    }

    /**
     * Function to set Http Client configuration.
     *
     * @return void
     */
    protected function setHttpClientConfiguration(): void
    {
        $this->setCurlConstants();

        $this->httpClientConfig = [
            CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_SSL_VERIFYPEER => $this->validateSSL,
        ];

        // Set default values.
        $this->setDefaultValues();

        // Initialize Http Client
        $this->setClient();
    }

    /**
     * Set default values for configuration.
     *
     * @return void
     */
    private function setDefaultValues(): void
    {
        $validateSSL = empty($this->validateSSL) ? true : $this->validateSSL;
        $this->validateSSL = $validateSSL;

        $this->apiBaseUrl = $this->config['server_api_url'];
    }

    /**
     * Check if returned string isXml
     *
     * @param string $value
     * @return bool
     */
    private function isXml(string $value): bool
    {
        $prev = libxml_use_internal_errors(true);

        $doc = simplexml_load_string($value);
        $errors = libxml_get_errors();

        libxml_clear_errors();
        libxml_use_internal_errors($prev);

        return false !== $doc && empty($errors);
    }

    /**
     * Convert XML to Json properly
     *
     * @param SimpleXMLElement $xmlNode
     * @return array
     */
    private function xmlToJson(SimpleXMLElement $xmlNode): array
    {
        $data = [];
        $nodeName = $xmlNode->getName();
        $currentObject = [];

        if (count($xmlNode->attributes()) > 0) {
            foreach($xmlNode->attributes() as $key => $value) {
                $currentObject[$key] = (string) $value;
            }
        }

        $stringContent = trim((string) $xmlNode);
        if (strlen($stringContent) > 0) {
            $currentObject["content"] = $stringContent;
        }

        if (count($xmlNode->children()) > 0) {
            $currentObject['children'] = [];

            foreach ($xmlNode->children() as $childXmlNode) {
                $currentObject['children'][] = $this->xmlToJson($childXmlNode);
            }
        }

        $data[$nodeName] = $currentObject;

        return $data;
    }

    /**
     * Perform Plex API request & return response.
     *
     * @throws \Throwable
     *
     * @return StreamInterface
     */
    private function makeHttpRequest(): StreamInterface
    {
        return $this->client->{$this->verb}(
            $this->apiUrl,
            $this->options
        )->getBody();
    }

    /**
     * Function To Perform Plex API Request.
     *
     * @param bool $decode
     *
     * @throws \Throwable
     *
     * @return array|StreamInterface|string
     */
    private function doPlexRequest(bool $decode = true): StreamInterface|array|string
    {
        try {
            $this->apiUrl = collect([$this->apiBaseUrl, $this->apiEndPoint])->implode('/');

            // Perform Plex HTTP API request.
            $response = $this->makeHttpRequest();

            $data = $response->getContents();

            if ($this->isXml($data)) {
                $content = str_replace(array("\n", "\r", "\t"), '', $data);
                $content = trim(str_replace('"', "'", $content));
                $xml = new \SimpleXMLElement($content);

                $data = Utils::jsonEncode($this->xmlToJson($xml), true);
            }

            return ($decode === false) ? $data : Utils::jsonDecode($data, true);
        } catch (RuntimeException $t) {
            return $t->getMessage();
        }
    }
}
