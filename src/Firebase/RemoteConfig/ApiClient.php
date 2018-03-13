<?php

namespace Kreait\Firebase\RemoteConfig;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Kreait\Firebase\Exception\Auth\CredentialsMismatch;
use Kreait\Firebase\Exception\Auth\EmailNotFound;
use Kreait\Firebase\Exception\Auth\InvalidCustomToken;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\RemoteConfigException;
use Kreait\Firebase\Request;
use Kreait\Firebase\Util\JSON;
use Lcobucci\JWT\Token;
use Psr\Http\Message\ResponseInterface;

class ApiClient
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getTemplate(): ResponseInterface
    {
        return $this->request('GET', 'remoteConfig');
    }

    public function publishTemplate(Template $template): ResponseInterface
    {
        return $this->request('PUT', 'remoteConfig', [
            'headers' => [
                'If-Match' => $template->getEtag(),
            ],
            'json' => $template->getRawData(),
        ]);
    }

    private function request($method, $uri, array $options = [])
    {
        $options = array_merge($options, [
            'decode_content' => 'gzip'
        ]);

        try {
            return $this->client->request($method, $uri, $options);
        } catch (RequestException $e) {
            throw RemoteConfigException::fromRequestException($e);
        } catch (\Throwable $e) {
            throw new RemoteConfigException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
