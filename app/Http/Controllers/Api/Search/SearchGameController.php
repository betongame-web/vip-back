<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchGameController extends Controller
{
    protected function fallbackGames(): array
    {
        return [
            [
                'id' => 101,
                'game_name' => 'Fortune Tiger',
                'slug' => 'fortune-tiger',
                'game_code' => 'fortunetiger',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Games',
                    'slug' => 'original-games',
                ],
            ],
            [
                'id' => 102,
                'game_name' => 'Fortune Rabbit',
                'slug' => 'fortune-rabbit',
                'game_code' => 'fortunerabbit',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Games',
                    'slug' => 'original-games',
                ],
            ],
            [
                'id' => 103,
                'game_name' => 'Fortune Ox',
                'slug' => 'fortune-ox',
                'game_code' => 'fortuneox',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Games',
                    'slug' => 'original-games',
                ],
            ],
            [
                'id' => 104,
                'game_name' => 'Fortune Panda',
                'slug' => 'fortune-panda',
                'game_code' => 'fortunepanda',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Games',
                    'slug' => 'original-games',
                ],
            ],
            [
                'id' => 105,
                'game_name' => 'Fortune Mouse',
                'slug' => 'fortune-mouse',
                'game_code' => 'fortunemouse',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Games',
                    'slug' => 'original-games',
                ],
            ],
            [
                'id' => 106,
                'game_name' => 'Treasures of Aztec',
                'slug' => 'treasures-of-aztec',
                'game_code' => 'treasuresofaztec',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Games',
                    'slug' => 'original-games',
                ],
            ],
            [
                'id' => 201,
                'game_name' => 'Phoenix Rises',
                'slug' => 'phoenix-rises',
                'game_code' => 'phoenixrises',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 2,
                    'name' => 'Special Originals',
                    'slug' => 'special-originals',
                ],
            ],
            [
                'id' => 202,
                'game_name' => 'Queen of Bounty',
                'slug' => 'queen-of-bounty',
                'game_code' => 'queenofbounty',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 2,
                    'name' => 'Special Originals',
                    'slug' => 'special-originals',
                ],
            ],
            [
                'id' => 203,
                'game_name' => 'Jack Frost',
                'slug' => 'jack-frost',
                'game_code' => 'jackfrost',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 2,
                    'name' => 'Special Originals',
                    'slug' => 'special-originals',
                ],
            ],
            [
                'id' => 204,
                'game_name' => 'Songkran Party',
                'slug' => 'songkran-party',
                'game_code' => 'songkranparty',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 2,
                    'name' => 'Special Originals',
                    'slug' => 'special-originals',
                ],
            ],
            [
                'id' => 205,
                'game_name' => 'Bikini Paradise',
                'slug' => 'bikini-paradise',
                'game_code' => 'bikiniparadise',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 2,
                    'name' => 'Special Originals',
                    'slug' => 'special-originals',
                ],
            ],
            [
                'id' => 206,
                'game_name' => 'Hood vs Woolf',
                'slug' => 'hood-vs-woolf',
                'game_code' => 'hoodvswoolf',
                'cover' => '/favicon.ico',
                'provider' => [
                    'id' => 2,
                    'name' => 'Special Originals',
                    'slug' => 'special-originals',
                ],
            ],
        ];
    }

    public function index(Request $request)
    {
        $games = $this->fallbackGames();

        $searchTerm = trim((string) $request->get('searchTerm', ''));

        if ($searchTerm !== '') {
            $games = array_values(array_filter($games, function ($game) use ($searchTerm) {
                return str_contains(strtolower($game['game_name']), strtolower($searchTerm))
                    || str_contains(strtolower($game['game_code']), strtolower($searchTerm))
                    || str_contains(strtolower($game['slug']), strtolower($searchTerm));
            }));
        }

        return response()->json([
            'games' => [
                'current_page' => 1,
                'data' => $games,
                'first_page_url' => url('/api/search/games?page=1'),
                'from' => count($games) ? 1 : null,
                'last_page' => 1,
                'last_page_url' => url('/api/search/games?page=1'),
                'links' => [],
                'next_page_url' => null,
                'path' => url('/api/search/games'),
                'per_page' => 12,
                'prev_page_url' => null,
                'to' => count($games),
                'total' => count($games),
            ],
            'fallback' => true,
        ], 200);
    }
}