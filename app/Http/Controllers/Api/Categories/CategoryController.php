<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'categories' => [
                [
                    'id' => 1,
                    'name' => 'Slots',
                    'slug' => 'slots',
                    'image' => '/assets/images/wager_1_6ec39cf4.png',
                ],
                [
                    'id' => 2,
                    'name' => 'Live Casino',
                    'slug' => 'live-casino',
                    'image' => '/assets/images/wager_2_8af53176.png',
                ],
                [
                    'id' => 3,
                    'name' => 'Crash',
                    'slug' => 'crash',
                    'image' => '/assets/images/wager_3_ee25b52f.png',
                ],
            ]
        ], 200);
    }
}