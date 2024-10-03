<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use App\Models\Article;

class UserPreferenceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'preferred_sources' => 'array',
            'preferred_categories' => 'array',
        ]);

        $preference = UserPreference::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['preferred_sources' => $request->preferred_sources, 'preferred_categories' => $request->preferred_categories]
        );

        return response()->json($preference);
    }

    public function personalizedFeed(Request $request)
    {
        $preference = UserPreference::where('user_id', $request->user()->id)->first();

        $query = Article::query();

        if ($preference) {
            if (!empty($preference->preferred_sources)) {
                $query->whereIn('source', $preference->preferred_sources);
            }
            if (!empty($preference->preferred_categories)) {
                $query->whereIn('category', $preference->preferred_categories);
            }
        }

        return $query->paginate(10);
    }
}
