<?php

/*
 * This file is part of Share-Links.biz PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ShareLinksBiz\Api;

class Folder extends AbstractApi
{
    public function insert($links, $folderName = null, $blinks = null, $backup = false, $backup_mode = false, $captcha = false, $pass_user = false, $pass_admin = null, $c_web = false, $c_dlc = false, $c_cnl = false, $c_ccf = false, $c_rsdf = false, $comment = null, $non_profit = false)
    {
        $params = compact('links', 'folderName', 'blinks', 'backup', 'backup_mode', 'captcha', 'pass_user', 'pass_admin', 'c_web', 'c_dlc', 'c_cnl', 'c_ccf', 'c_rsdf', 'comment', 'non_profit');
        $params['links'] = implode("\n", $params['links']);

        if (! empty($blinks)) {
            for ($i = 0; $i < count($mirrors); ++$i) {
                $params["mirrors[$i]"] = implode("\n", $mirrors[$i]);
            }
        }

        return $this->post('insert', $params);
    }

    public function edit($folderCode, $folderName = null, $links = null, $blinks = null, $backup = false, $backup_mode = false, $captcha = false, $pass_user = false, $pass_admin = null, $c_web = false, $c_dlc = false, $c_cnl = false, $c_ccf = false, $c_rsdf = false, $comment = null, $non_profit = false)
    {
        $params = compact('folderCode', 'folderName', 'links', 'blinks', 'backup', 'backup_mode', 'captcha', 'pass_user', 'pass_admin', 'c_web', 'c_dlc', 'c_cnl', 'c_ccf', 'c_rsdf', 'comment', 'non_profit');

        if (! empty($links)) {
            $params['links'] = implode("\n", $params['links']);
        }

        if (! empty($blinks)) {
            for ($i = 0; $i < count($mirrors); ++$i) {
                $params["mirrors[$i]"] = implode("\n", $mirrors[$i]);
            }
        }

        return $this->post('edit', $params);
    }

    public function content($folderCode)
    {
        $response = $this->post('content', compact('folderCode'));
        $response = explode(';', $response);

        return [
            'url' => $response[0],
            'filename' => $response[1],
            'filesize' => $response[2],
            'provider_shortcut' => $response[3],
            'backup_number' => $response[4],
            'status' => $response[5],
        ];
    }

    public function listing()
    {
        return $this->post('list');
    }

    public function remove($folderCode, $pass_admin)
    {
        return $this->post('remove', compact('folderCode', 'pass_admin'));
    }

    public function status($folderCodes)
    {
        if (is_array($folderCodes)) {
            $folderCodes = implode("\n", $folderCodes);
        }

        $response = $this->post('status', compact('folderCodes'));
        $response = explode(';', $response);

        return [
            'folder_code' => $response[0],
            'folder_name' => $response[1],
            'folder_status' => $response[2],
            'all_links' => [
                'with_backups' => $response[3],
                'without_backups' => $response[4],
            ],
            'this_folder' => [
                'with_backups' => $response[5],
                'without_backups' => $response[6],
            ],
            'hoster' => $response[7],
            'created_at' => $response[8],
            'last_access' => $response[9],
            'clicks' => $response[10],
        ];
    }
}
