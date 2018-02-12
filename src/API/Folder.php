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

namespace BrianFaust\ShareLinksBiz\API;

use BrianFaust\Http\HttpResponse;

class Folder extends AbstractAPI
{
    public function insert($links, array $parameters = []): HttpResponse
    {
        $params = compact('links') + $parameters;
        $params['links'] = implode("\n", $params['links']);

        if (!empty($params['blinks'])) {
            for ($i = 0; $i < count($params['mirrors']); $i++) {
                $params["mirrors[$i]"] = implode("\n", $params['mirrors'][$i]);
            }
        }

        return $this->post('insert', $params);
    }

    public function edit($folderCode, array $parameters): HttpResponse
    {
        $params = compact('folderCode') + $parameters;

        if (!empty($links)) {
            $params['links'] = implode("\n", $params['links']);
        }

        if (!empty($params['blinks'])) {
            for ($i = 0; $i < count($params['mirrors']); $i++) {
                $params["mirrors[$i]"] = implode("\n", $params['mirrors'][$i]);
            }
        }

        return $this->post('edit', $params);
    }

    public function content($folderCode): HttpResponse
    {
        return $this->post('content', compact('folderCode'));
    }

    public function listing(): HttpResponse
    {
        return $this->post('list');
    }

    public function remove($folderCode, $pass_admin): HttpResponse
    {
        return $this->client->post('remove', compact('folderCode', 'pass_admin'));
    }

    public function status($folderCodes): HttpResponse
    {
        if (is_array($folderCodes)) {
            $folderCodes = implode("\n", $folderCodes);
        }

        return $this->client->post('status', compact('folderCodes'));
    }
}
