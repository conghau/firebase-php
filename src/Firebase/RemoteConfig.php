<?php

declare(strict_types=1);

namespace Kreait\Firebase;
use Kreait\Firebase\RemoteConfig\ApiClient;
use Kreait\Firebase\RemoteConfig\Template;
use Kreait\Firebase\Util\JSON;

/**
 * The Firebase Remote Config
 *
 * @see https://firebase.google.com/docs/remote-config/use-config-rest
 * @see https://firebase.google.com/docs/remote-config/rest-reference
 */
class RemoteConfig
{
    /**
     * @var ApiClient
     */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function getTemplate(): Template
    {
        return Template::fromResponse($this->client->getTemplate());
    }

    public function publishTemplate(Template $template): Template
    {
        return Template::fromResponse($this->client->publishTemplate($template));
    }
}
