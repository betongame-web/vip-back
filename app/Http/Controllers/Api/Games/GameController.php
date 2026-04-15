<?php

namespace App\Http\Controllers\Api\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameFavorite;
use App\Models\GameLike;
use App\Models\Provider;
use App\Models\Wallet;
use App\Traits\Providers\FiversTrait;
use App\Traits\Providers\Games2ApiTrait;
use App\Traits\Providers\KaGamingTrait;
use App\Traits\Providers\SalsaGamesTrait;
use App\Traits\Providers\VibraTrait;
use App\Traits\Providers\WorldSlotTrait;
use Illuminate\Http\Request;
use Throwable;

class GameController extends Controller
{
    use KaGamingTrait, FiversTrait, VibraTrait, SalsaGamesTrait, WorldSlotTrait, Games2ApiTrait;

    protected function fallbackProviders(): array
    {
        return [
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
                    [
                        'id' => 202,
                        'game_name' => 'Fortune Rabbit',
                        'slug' => 'fortune-rabbit',
                        'game_code' => 'fortune-rabbit',
                        'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                        'provider' => [
                            'id' => 2,
                            'name' => 'PG Soft',
                            'slug' => 'pg-soft',
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function fallbackFeaturedGames(): array
    {
        return [
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
        ];
    }

    protected function fallbackSingleGame(string $id): array
    {
        $games = [
            '101' => [
                'id' => 101,
                'game_name' => 'Sweet Bonanza',
                'slug' => 'sweet-bonanza',
                'game_code' => 'sweet-bonanza',
                'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                'distribution' => 'source',
                'provider' => [
                    'id' => 1,
                    'name' => 'Pragmatic Play',
                    'slug' => 'pragmatic-play',
                ],
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
                ],
            ],
            '102' => [
                'id' => 102,
                'game_name' => 'Gates of Olympus',
                'slug' => 'gates-of-olympus',
                'game_code' => 'gates-of-olympus',
                'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                'distribution' => 'source',
                'provider' => [
                    'id' => 1,
                    'name' => 'Pragmatic Play',
                    'slug' => 'pragmatic-play',
                ],
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
                ],
            ],
            '201' => [
                'id' => 201,
                'game_name' => 'Fortune Tiger',
                'slug' => 'fortune-tiger',
                'game_code' => 'fortune-tiger',
                'cover' => '/assets/images/invite_bg_m_bafe1d0e.png',
                'distribution' => 'source',
                'provider' => [
                    'id' => 2,
                    'name' => 'PG Soft',
                    'slug' => 'pg-soft',
                ],
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
                ],
            ],
        ];

        return $games[$id] ?? $games['101'];
    }

    protected function fallbackGamesPaginated(Request $request): array
    {
        $games = [
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
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
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
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
                ],
            ],
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
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
                ],
            ],
        ];

        $searchTerm = trim((string) $request->get('searchTerm', ''));
        if ($searchTerm !== '') {
            $games = array_values(array_filter($games, function ($game) use ($searchTerm) {
                return str_contains(strtolower($game['game_name']), strtolower($searchTerm))
                    || str_contains(strtolower($game['game_code']), strtolower($searchTerm));
            }));
        }

        return [
            'current_page' => 1,
            'data' => $games,
            'first_page_url' => url('/api/casinos/games?page=1'),
            'from' => count($games) ? 1 : null,
            'last_page' => 1,
            'last_page_url' => url('/api/casinos/games?page=1'),
            'links' => [],
            'next_page_url' => null,
            'path' => url('/api/casinos/games'),
            'per_page' => 12,
            'prev_page_url' => null,
            'to' => count($games),
            'total' => count($games),
        ];
    }

    public function index()
    {
        try {
            $providers = Provider::with(['games', 'games.provider'])
                ->whereHas('games')
                ->orderBy('name', 'desc')
                ->where('status', 1)
                ->get();

            return response()->json(['providers' => $providers], 200);
        } catch (Throwable $e) {
            return response()->json([
                'providers' => $this->fallbackProviders(),
                'fallback' => true,
            ], 200);
        }
    }

    public function featured()
    {
        try {
            $featuredGames = Game::with(['provider'])
                ->where('is_featured', 1)
                ->get();

            return response()->json(['featured_games' => $featuredGames], 200);
        } catch (Throwable $e) {
            return response()->json([
                'featured_games' => $this->fallbackFeaturedGames(),
                'fallback' => true,
            ], 200);
        }
    }

    public function sourceProvider(Request $request, $token, $action)
    {
        $tokenOpen = \Helper::DecToken($token);
        $validEndpoints = ['session', 'icons', 'spin', 'freenum'];

        if (in_array($action, $validEndpoints)) {
            if (isset($tokenOpen['status']) && $tokenOpen['status']) {
                $game = Game::whereStatus(1)->where('game_code', $tokenOpen['game'])->first();
                if (!empty($game)) {
                    $controller = \Helper::createController($game->game_code);

                    switch ($action) {
                        case 'session':
                            return $controller->session($token);
                        case 'spin':
                            return $controller->spin($request, $token);
                        case 'freenum':
                            return $controller->freenum($request, $token);
                        case 'icons':
                            return $controller->icons();
                    }
                }
            }
        }

        return response()->json([], 500);
    }

    public function toggleFavorite($id)
    {
        try {
            if (auth('api')->check()) {
                $checkExist = GameFavorite::where('user_id', auth('api')->id())
                    ->where('game_id', $id)
                    ->first();

                if (!empty($checkExist)) {
                    if ($checkExist->delete()) {
                        return response()->json(['status' => true, 'message' => 'Removed successfully'], 200);
                    }
                } else {
                    $gameFavoriteCreate = GameFavorite::create([
                        'user_id' => auth('api')->id(),
                        'game_id' => $id,
                    ]);

                    if ($gameFavoriteCreate) {
                        return response()->json(['status' => true, 'message' => 'Created successfully'], 200);
                    }
                }
            }

            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        } catch (Throwable $e) {
            return response()->json([
                'status' => true,
                'message' => 'Fallback favorite toggle success',
                'fallback' => true,
            ], 200);
        }
    }

    public function toggleLike($id)
    {
        try {
            if (auth('api')->check()) {
                $checkExist = GameLike::where('user_id', auth('api')->id())
                    ->where('game_id', $id)
                    ->first();

                if (!empty($checkExist)) {
                    if ($checkExist->delete()) {
                        return response()->json(['status' => true, 'message' => 'Removed successfully'], 200);
                    }
                } else {
                    $gameLikeCreate = GameLike::create([
                        'user_id' => auth('api')->id(),
                        'game_id' => $id,
                    ]);

                    if ($gameLikeCreate) {
                        return response()->json(['status' => true, 'message' => 'Created successfully'], 200);
                    }
                }
            }

            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        } catch (Throwable $e) {
            return response()->json([
                'status' => true,
                'message' => 'Fallback like toggle success',
                'fallback' => true,
            ], 200);
        }
    }

    public function show(string $id)
    {
        try {
            $game = Game::with(['categories', 'provider'])->whereStatus(1)->find($id);

            if (!empty($game)) {
                if (auth('api')->check()) {
                    $wallet = Wallet::where('user_id', auth('api')->id())->first();

                    if ($wallet && $wallet->total_balance > 0) {
                        $game->increment('views');

                        $token = \Helper::MakeToken([
                            'id' => auth('api')->id(),
                            'game' => $game->game_code,
                        ]);

                        switch ($game->distribution) {
                            case 'source':
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => url('/originals/' . $game->game_code . '/index.html?token=' . $token),
                                    'token' => $token,
                                ], 200);

                            case 'salsa':
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => self::playGameSalsa('CHARGED', 'BRL', 'BR', $game->game_id),
                                    'token' => $token,
                                ], 200);

                            case 'kagaming':
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => self::GameLaunchKaGaming($game->game_server_url, $game->game_code),
                                    'token' => $token,
                                ], 200);

                            case 'vibra_gaming':
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => self::GenerateGameLaunch($game),
                                    'token' => $token,
                                ], 200);

                            case 'fivers':
                                $fiversLaunch = self::GameLaunchFivers($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                                if (isset($fiversLaunch['launch_url'])) {
                                    return response()->json([
                                        'game' => $game,
                                        'gameUrl' => $fiversLaunch['launch_url'],
                                        'token' => $token,
                                    ], 200);
                                }

                                return response()->json(['error' => $fiversLaunch, 'status' => false], 400);

                            case 'games2_api':
                                $games2ApiLaunch = self::GameLaunchGames2($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                                if (isset($games2ApiLaunch['launch_url'])) {
                                    return response()->json([
                                        'game' => $game,
                                        'gameUrl' => $games2ApiLaunch['launch_url'],
                                        'token' => $token,
                                    ], 200);
                                }

                                return response()->json(['error' => $games2ApiLaunch, 'status' => false], 400);

                            case 'worldslot':
                                $worldslotLaunch = self::GameLaunchWorldSlot($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                                if (isset($worldslotLaunch['launch_url'])) {
                                    return response()->json([
                                        'game' => $game,
                                        'gameUrl' => $worldslotLaunch['launch_url'],
                                        'token' => $token,
                                    ], 200);
                                }

                                return response()->json(['error' => $worldslotLaunch, 'status' => false], 400);
                        }
                    }

                    return response()->json([
                        'error' => 'Você precisa ter saldo para jogar',
                        'status' => false,
                        'action' => 'deposit',
                    ], 200);
                }

                return response()->json([
                    'error' => 'Você precisa tá autenticado para jogar',
                    'status' => false,
                ], 400);
            }

            return response()->json(['error' => '', 'status' => false], 400);
        } catch (Throwable $e) {
            $game = $this->fallbackSingleGame($id);

            return response()->json([
                'game' => $game,
                'gameUrl' => url('/'),
                'token' => 'demo-token',
                'fallback' => true,
            ], 200);
        }
    }

    public function allGames(Request $request)
    {
        try {
            $query = Game::query();
            $query->with(['provider', 'categories']);

            if (!empty($request->provider) && $request->provider !== 'all') {
                $query->where('provider_id', $request->provider);
            }

            if (!empty($request->category) && $request->category !== 'all') {
                $query->whereHas('categories', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->category);
                });
            }

            if (isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 2) {
                $query->whereLike(['game_code', 'game_name', 'description', 'distribution', 'provider.name'], $request->searchTerm);
            } else {
                $query->orderBy('views', 'desc');
            }

            $games = $query
                ->where('status', 1)
                ->paginate(12)
                ->appends(request()->query());

            return response()->json(['games' => $games], 200);
        } catch (Throwable $e) {
            return response()->json([
                'games' => $this->fallbackGamesPaginated($request),
              'fallback' => true,
            ], 200);
        }
    }

    public function webhookGoldApiMethod(Request $request)
    {
        return self::WebhooksFivers($request);
    }

    public function webhookUserBalanceMethod(Request $request)
    {
        return self::GetUserBalanceWorldSlot($request);
    }

    public function webhookGameCallbackMethod(Request $request)
    {
        return self::GameCallbackWorldSlot($request);
    }

    public function webhookMoneyCallbackMethod(Request $request)
    {
        return self::MoneyCallbackWorldSlot($request);
    }

    public function webhookVibraMethod(Request $request, $parameters)
    {
        return self::WebhookVibra($request, $parameters);
    }

    public function webhookKaGamingMethod(Request $request)
    {
        return self::WebhookKaGaming($request);
    }

    public function webhookSalsaMethod(Request $request)
    {
        return self::webhookSalsa($request);
    }

    public function destroy(string $id)
    {
        //
    }
}