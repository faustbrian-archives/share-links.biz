<?php

/*
 * This file is part of Share-Links.biz PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ShareLinks;

use BrianFaust\Unified\AbstractHttpClient;
use BrianFaust\ShareLinks\Request\Modifiers\ApiKeyModifier;

class HttpClient extends AbstractHttpClient
{
    protected $options = [
        'base_uri' => 'https://www.share-links.com/vtapi/v2/',
        'headers' => [
           'User-Agent' => 'ShareLinks-PHP-Client/0.1.0',
        ],
    ];

    protected $requestModifiers = [ApiKeyModifier::class];
}
