<?php

declare(strict_types=1);

/*
 * This file is part of Share-Links.biz PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ShareLinks;

use BrianFaust\Http\Http;

class Client
{
    /**
     * @var string
     */
    public $key;

    /**
     * Create a new client instance.
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Create a new API service instance.
     *
     * @param string $name
     *
     * @return \BrianFaust\ShareLinks\API\AbstractAPI
     */
    public function api(string $name): API\AbstractAPI
    {
        $client = Http::withBaseUri('http://share-links.biz/api/');

        $class = "BrianFaust\\ShareLinks\\API\\{$name}";

        return new $class($client);
    }
}
