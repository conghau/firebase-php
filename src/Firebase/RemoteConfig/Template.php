<?php

declare(strict_types=1);

namespace Kreait\Firebase\RemoteConfig;

use Kreait\Firebase\Util\JSON;
use Psr\Http\Message\ResponseInterface;

class Template
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $etag;

    public static function fromResponse(ResponseInterface $response): self
    {
        $etag = $response->getHeader('ETag');

        $template = new self();
        $template->etag = array_shift($etag);
        $template->data = JSON::decode((string) $response->getBody(), true);

        return $template;
    }

    public function getRawData(): array
    {
        return $this->data;
    }

    public function withNewRawData(array $data): self
    {
        $template = clone $this;
        $template->data = $data;

        return $template;
    }

    public function getEtag(): string
    {
        return $this->etag;
    }
}
