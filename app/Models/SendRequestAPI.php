<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendRequestAPI extends Model
{
    use HasFactory;

    static function sendGet($endpoint, $token = null)
    {
        $url = env('API_URL').'/api/v1/'.$endpoint;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json'
            ]
        ]);

        $body = $response->getBody();
        $result = json_decode($body);

        if ($result->meta->code == 401) {
            session()->flush();
            return $result;
        } else {
            return $result;
        }
    }

    static function sendPost($endpoint, $token = null, $request)
    {
        $url = env('API_URL').'/api/v1/'.$endpoint;
        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json'
            ],
            'form_params' => $request->all()
        ]);

        $body = $response->getBody();
        $result = json_decode($body);

        if ($result->meta->code == 401) {
            session()->flush();
            return $result;

        } else {
            return $result;
        }
    }

    static function sendPostIntro($endpoint, $token = null, $request)
    {
        // dd(fopen($request->image->getRealPath(), 'r'));
        $url = env('API_URL').'/api/v1/'.$endpoint;
        $client = new Client();
        $image = fopen($request->image->getRealPath(), 'r');
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json'
            ],
            // 'form_params' => $request->all()
            'multipart' => [
                [
                    'name' => 'title',
                    'contents' => $request->title
                ],
                [
                    'name' => 'description',
                    'contents' => $request->description
                ],
                [
                    'name' => 'image',
                    'contents' => $image
                ],
                [
                    'name' => 'display_order',
                    'contents' => $request->display_order
                ]
            ]
        ]);

        $body = $response->getBody();
        $result = json_decode($body);

        if ($result->meta->code == 401) {
            session()->flush();
            return $result;

        } else {
            return $result;
        }
    }


}
