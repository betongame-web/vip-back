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
                    'image' => url('/favicon.ico'),
                ],
                [
                    'id' => 2,
                    'name' => 'Originals',
                    'slug' => 'originals',
                    'image' => url('/favicon.ico'),
                ],
                [
                    'id' => 3,
                    'name' => 'Popular',
                    'slug' => 'popular',
                    'image' => url('/favicon.ico'),
                ],
            ]
        ], 200);
    }
}
