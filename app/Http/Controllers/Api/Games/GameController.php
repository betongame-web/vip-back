public function index()
{
    return response()->json([
        'providers' => [
            [
                'id' => 1,
                'name' => 'Pragmatic Play',
                'slug' => 'pragmatic-play',
                'games' => [
                    [
                        'id' => 101,
                        'game_name' => 'Sweet Bonanza',
                        'slug' => 'sweet-bonanza',
                        'game_code' => 'sweet-bonanza',
                        'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                        'provider' => [
                            'id' => 1,
                            'name' => 'Pragmatic Play',
                            'slug' => 'pragmatic-play',
                        ],
                    ],
                    [
                        'id' => 102,
                        'game_name' => 'Gates of Olympus',
                        'slug' => 'gates-of-olympus',
                        'game_code' => 'gates-of-olympus',
                        'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                        'provider' => [
                            'id' => 1,
                            'name' => 'Pragmatic Play',
                            'slug' => 'pragmatic-play',
                        ],
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'PG Soft',
                'slug' => 'pg-soft',
                'games' => [
                    [
                        'id' => 201,
                        'game_name' => 'Fortune Tiger',
                        'slug' => 'fortune-tiger',
                        'game_code' => 'fortune-tiger',
                        'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                        'provider' => [
                            'id' => 2,
                            'name' => 'PG Soft',
                            'slug' => 'pg-soft',
                        ],
                    ],
                ],
            ],
        ]
    ], 200);
}