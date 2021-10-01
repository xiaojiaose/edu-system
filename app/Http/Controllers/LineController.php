<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LineController
{
    /**
     * @see https://developers.line.biz/en/docs/line-login/integrate-line-login/#making-an-authorization-request
     */
    public function redirect()
    {
        $url = 'https://access.line.me/oauth2/v2.1/authorize?';
        $url .= http_build_query([
            'response_type' => 'code',
            'client_id' => config('services.line.channel_id'),
            'redirect_uri' => "https://edu-hebei.herokuapp.com/callback/line",
            'state' => Str::random(8),
            'scope' => 'profile openid',
        ]);
        logger(__METHOD__, [$url]);
        return redirect($url);
    }

    public function callback(Request $request)
    {
        logger(__METHOD__, [$request]);
        if ($error = $request->query('error')) {
            return "{$error} " . $request->query('error_description');
        }

        $client = new Client();
        $response = $client->post('https://api.line.me/oauth2/v2.1/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $request->query('code'),
                'redirect_uri' => "https://edu-hebei.herokuapp.com/callback/line",
                'client_id' => config('services.line.channel_id'),
                'client_secret' => config('services.line.channel_secret'),
            ]
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        logger(__METHOD__, $data);
        return redirect(config('app.frontend_url') . "?token={$data['id_token']}#/line");
    }

}