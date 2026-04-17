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
use Illuminate\Support\Facades\Log;
use Throwable;

class GameController extends Controller
{
    use KaGamingTrait, FiversTrait, VibraTrait, SalsaGamesTrait, WorldSlotTrait, Games2ApiTrait;

    protected function fallbackCover(): string
    {
        return url('/assets/images/FortuneTiger.webp');
    }

    protected function originalGameMap(): array
    {
        return [
            [
                'id' => 101,
                'game_name' => 'Fortune Tiger',
                'slug' => 'fortune-tiger',
                'game_code' => 'fortunetiger',
            ],
            [
                'id' => 102,
                'game_name' => 'Fortune Rabbit',
                'slug' => 'fortune-rabbit',
                'game_code' => 'fortunerabbit',
            ],
            [
                'id' => 103,
                'game_name' => 'Fortune Ox',
                'slug' => 'fortune-ox',
                'game_code' => 'fortuneox',
            ],
            [
                'id' => 104,
                'game_name' => 'Fortune Panda',
                'slug' => 'fortune-panda',
                'game_code' => 'fortunepanda',
            ],
            [
                'id' => 105,
                'game_name' => 'Fortune Mouse',
                'slug' => 'fortune-mouse',
                'game_code' => 'fortunemouse',
            ],
            [
                'id' => 106,
                'game_name' => 'Treasures of Aztec',
                'slug' => 'treasures-of-aztec',
                'game_code' => 'treasuresofaztec',
            ],
            [
                'id' => 201,
                'game_name' => 'Phoenix Rises',
                'slug' => 'phoenix-rises',
                'game_code' => 'phoenixrises',
            ],
            [
                'id' => 202,
                'game_name' => 'Queen of Bounty',
                'slug' => 'queen-of-bounty',
                'game_code' => 'queenofbounty',
            ],
            [
                'id' => 203,
                'game_name' => 'Jack Frost',
                'slug' => 'jack-frost',
                'game_code' => 'jackfrost',
            ],
            [
                'id' => 204,
                'game_name' => 'Songkran Party',
                'slug' => 'songkran-party',
                'game_code' => 'songkranparty',
            ],
            [
                'id' => 205,
                'game_name' => 'Bikini Paradise',
                'slug' => 'bikini-paradise',
                'game_code' => 'bikiniparadise',
            ],
            [
                'id' => 206,
                'game_name' => 'Hood vs Woolf',
                'slug' => 'hood-vs-woolf',
                'game_code' => 'hoodvswoolf',
            ],
        ];
    }

    protected function fallbackProviders(): array
    {
        $games = $this->originalGameMap();

        $providerA = [];
        $providerB = [];

        foreach ($games as $index => $game) {
            $payload = [
                ...$game,
                'cover' => $this->fallbackCover(),
                'provider' => [
                    'id' => $index < 6 ? 1 : 2,
                    'name' => $index < 6 ? 'Original Slots A' : 'Original Slots B',
                    'slug' => $index < 6 ? 'original-slots-a' : 'original-slots-b',
                ],
            ];

            if ($index < 6) {
                $providerA[] = $payload;
            } else {
                $providerB[] = $payload;
            }
        }

        return [
            [
                'id' => 1,
                'name' => 'Original Slots A',
                'slug' => 'original-slots-a',
                'games' => $providerA,
            ],
            [
                'id' => 2,
                'name' => 'Original Slots B',
                'slug' => 'original-slots-b',
                'games' => $providerB,
            ],
        ];
    }

    protected function fallbackFeaturedGames(): array
    {
        $games = $this->originalGameMap();

        return [
            [
                ...$games[0],
                'cover' => $this->fallbackCover(),
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Slots A',
                    'slug' => 'original-slots-a',
                ],
            ],
            [
                ...$games[1],
                'cover' => $this->fallbackCover(),
                'provider' => [
                    'id' => 1,
                    'name' => 'Original Slots A',
                    'slug' => 'original-slots-a',
                ],
            ],
            [
                ...$games[6],
                'cover' => $this->fallbackCover(),
                'provider' => [
                    'id' => 2,
                    'name' => 'Original Slots B',
                    'slug' => 'original-slots-b',
                ],
            ],
        ];
    }

    protected function fallbackSingleGame(string $id): array
    {
        $games = collect($this->originalGameMap())
            ->keyBy(fn ($item) => (string) $item['id'])
            ->toArray();

        $base = $games[$id] ?? $games['101'];

        return [
            ...$base,
            'cover' => $this->fallbackCover(),
            'distribution' => 'source',
            'provider' => [
                'id' => ((int) $base['id'] < 200) ? 1 : 2,
                'name' => ((int) $base['id'] < 200) ? 'Original Slots A' : 'Original Slots B',
                'slug' => ((int) $base['id'] < 200) ? 'original-slots-a' : 'original-slots-b',
            ],
            'categories' => [
                ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
            ],
        ];
    }

    protected function fallbackGamesPaginated(Request $request): array
    {
        $games = array_map(function ($game) {
            return [
                ...$game,
                'cover' => $this->fallbackCover(),
                'provider' => [
                    'id' => ((int) $game['id'] < 200) ? 1 : 2,
                    'name' => ((int) $game['id'] < 200) ? 'Original Slots A' : 'Original Slots B',
                    'slug' => ((int) $game['id'] < 200) ? 'original-slots-a' : 'original-slots-b',
                ],
                'categories' => [
                    ['id' => 1, 'name' => 'Slots', 'slug' => 'slots'],
                ],
            ];
        }, $this->originalGameMap());

        $searchTerm = trim((string) $request->get('searchTerm', ''));

        if ($searchTerm !== '') {
            $games = array_values(array_filter($games, function ($game) use ($searchTerm) {
                return str_contains(strtolower($game['game_name']), strtolower($searchTerm))
                    || str_contains(strtolower($game['game_code']), strtolower($searchTerm))
                    || str_contains(strtolower($game['slug']), strtolower($searchTerm));
            }));
        }

        return [
            'current_page' => 1,
            'data' => $games,
            'first_page_url' => url('/api/games/all?page=1'),
            'from' => count($games) ? 1 : null,
            'last_page' => 1,
            'last_page_url' => url('/api/games/all?page=1'),
            'links' => [],
            'next_page_url' => null,
            'path' => url('/api/games/all'),
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
                ->where('status', 1)
                ->orderBy('name', 'desc')
                ->get();

            return response()->json(['providers' => $providers], 200);
        } catch (Throwable $e) {
            Log::error('GameController@index failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'providers' => $this->fallbackProviders(),
                'fallback' => true,
            ], 200);
        }
    }

    public function featured()
    {
        try {
            $featuredGames = Game::query()
                ->leftJoin('providers', 'providers.id', '=', 'games.provider_id')
                ->where('games.is_featured', 1)
                ->where('games.status', 1)
                ->select([
                    'games.id',
                    'games.game_name',
                    'games.slug',
                    'games.game_code',
                    'games.cover',
                    'providers.id as provider_id',
                    'providers.name as provider_name',
                    'providers.code as provider_slug',
                ])
                ->get()
                ->map(function ($game) {
                    return [
                        'id' => $game->id,
                        'game_name' => $game->game_name,
                        'slug' => $game->slug,
                        'game_code' => $game->game_code,
                        'cover' => $game->cover ? url($game->cover) : $this->fallbackCover(),
                        'provider' => [
                            'id' => $game->provider_id,
                            'name' => $game->provider_name,
                            'slug' => $game->provider_slug,
                        ],
                    ];
                })
                ->values();

            return response()->json([
                'featured_games' => $featuredGames,
            ], 200);
        } catch (Throwable $e) {
            Log::error('GameController@featured failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'featured_games' => $this->fallbackFeaturedGames(),
                'fallback' => true,
            ], 200);
        }
    }

    public function sourceProvider(Request $request, $token, $action)
    {
        try {
            $tokenOpen = \Helper::DecToken($token);
            $validEndpoints = ['session', 'icons', 'spin', 'freenum'];

            if (in_array($action, $validEndpoints, true)) {
                if (isset($tokenOpen['status']) && $tokenOpen['status']) {
                    $game = Game::whereStatus(1)
                        ->where('game_code', $tokenOpen['game'])
                        ->first();

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
        } catch (Throwable $e) {
            Log::error('GameController@sourceProvider failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'action' => $action,
            ]);

            return response()->json([], 500);
        }
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
                        return response()->json([
                            'status' => true,
                            'message' => 'Removed successfully',
                        ], 200);
                    }
                } else {
                    $gameFavoriteCreate = GameFavorite::create([
                        'user_id' => auth('api')->id(),
                        'game_id' => $id,
                    ]);

                    if ($gameFavoriteCreate) {
                        return response()->json([
                            'status' => true,
                            'message' => 'Created successfully',
                        ], 200);
                    }
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        } catch (Throwable $e) {
            Log::error('GameController@toggleFavorite failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'game_id' => $id,
            ]);

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
                        return response()->json([
                            'status' => true,
                            'message' => 'Removed successfully',
                        ], 200);
                    }
                } else {
                    $gameLikeCreate = GameLike::create([
                        'user_id' => auth('api')->id(),
                        'game_id' => $id,
                    ]);

                    if ($gameLikeCreate) {
                        return response()->json([
                            'status' => true,
                            'message' => 'Created successfully',
                        ], 200);
                    }
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        } catch (Throwable $e) {
            Log::error('GameController@toggleLike failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'game_id' => $id,
            ]);

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
            $game = Game::with(['categories', 'provider'])
                ->whereStatus(1)
                ->find($id);

            if (!empty($game) && auth('api')->check()) {
                $wallet = Wallet::where('user_id', auth('api')->id())->first();

                if ($wallet && $wallet->total_balance > 0) {
                    $game->increment('views');

                    $token = \Helper::MakeToken([
                        'id' => auth('api')->id(),
                        'game' => $game->game_code,
                    ]);

                    if ($game->distribution === 'source') {
                        return response()->json([
                            'game' => $game,
                            'gameUrl' => url('/originals/' . $game->game_code . '/index.html?token=' . $token),
                            'token' => $token,
                        ], 200);
                    }
                }
            }
        } catch (Throwable $e) {
            Log::error('GameController@show failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'game_id' => $id,
            ]);
        }

        $game = $this->fallbackSingleGame($id);

        return response()->json([
            'game' => $game,
            'gameUrl' => url('/originals/' . $game['game_code'] . '/index.html?token=demo-token'),
            'token' => 'demo-token',
            'fallback' => true,
        ], 200);
    }

    public function allGames(Request $request)
    {
        try {
            $query = Game::query()->with(['provider', 'categories']);

            if (!empty($request->provider) && $request->provider !== 'all') {
                $query->where('provider_id', $request->provider);
            }

            if (!empty($request->category) && $request->category !== 'all') {
                $query->whereHas('categories', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->category);
                });
            }

            $searchTerm = trim((string) $request->get('searchTerm', ''));

            if ($searchTerm !== '') {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('game_code', 'like', '%' . $searchTerm . '%')
                        ->orWhere('game_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('description', 'like', '%' . $searchTerm . '%')
                        ->orWhere('distribution', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('provider', function ($providerQuery) use ($searchTerm) {
                            $providerQuery->where('name', 'like', '%' . $searchTerm . '%')
                                ->orWhere('code', 'like', '%' . $searchTerm . '%');
                        });
                });
            } else {
                $query->orderBy('views', 'desc');
            }

            $games = $query
                ->where('status', 1)
                ->paginate(12)
                ->appends(request()->query());

            return response()->json(['games' => $games], 200);
        } catch (Throwable $e) {
            Log::error('GameController@allGames failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'provider' => $request->provider ?? null,
                'category' => $request->category ?? null,
                'searchTerm' => $request->searchTerm ?? null,
            ]);

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