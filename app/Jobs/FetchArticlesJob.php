<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;
use Illuminate\Support\Facades\Http;

class FetchArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sources = [
            'newsapi.org' => 'https://newsapi.org/v2/top-headlines?apiKey=your_api_key',
            // Add other sources here
        ];

        foreach ($sources as $source => $url) {
            $response = Http::get($url);
            $articles = $response->json()['articles'];

            foreach ($articles as $data) {
                Article::updateOrCreate(
                    ['title' => $data['title']],
                    [
                        'content' => $data['content'],
                        'author' => $data['author'],
                        'source' => $source,
                        'category' => $data['category'] ?? 'general',
                        'published_at' => $data['publishedAt'],
                    ]
                );
            }
        }
    }
}
