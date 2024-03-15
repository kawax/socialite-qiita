<?php

namespace Revolution\Socialite\Qiita;

use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class QiitaProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [
        'read_qiita',
        'write_qiita',
    ];

    /**
     * @var string
     */
    protected $endpoint = 'https://qiita.com/api/v2/';

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        $url = $this->endpoint.'oauth/authorize';

        return $this->buildAuthUrlFromBase($url, $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->endpoint.'access_tokens';
    }

    /**
     * Get the access token response for the given code.
     *
     * @param  string  $code
     * @return array
     */
    public function getAccessTokenResponse($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => $this->getTokenFields($code),
        ]);

        return [
            'access_token' => json_decode($response->getBody(), true)['token'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()
            ->get($this->endpoint.'authenticated_user', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => (int) Arr::get($user, 'permanent_id'),
            'nickname' => Arr::get($user, 'name', ''),
            'name' => Arr::get($user, 'id', ''),
            'email' => '',
            'avatar' => Arr::get($user, 'profile_image_url', ''),
        ]);
    }
}
