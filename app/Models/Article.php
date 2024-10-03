<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Article",
 *     type="object",
 *     title="Article",
 *     description="An article model representing news articles",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Breaking News"),
 *     @OA\Property(property="content", type="string", example="This is the article content."),
 *     @OA\Property(property="author", type="string", example="John Doe"),
 *     @OA\Property(property="source", type="string", example="BBC"),
 *     @OA\Property(property="category", type="string", example="Politics"),
 *     @OA\Property(property="published_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 * )
 */
class Article extends Model
{
    protected $fillable = ['title', 'content', 'author', 'source', 'category', 'published_at'];
}
