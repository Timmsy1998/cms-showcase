<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogArticleCreatedActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleCreated $event): void
    {
        // Create an activity log when an article is created
        Activity::create([
            'action' => 'created',
            'description' => 'Article created: ' . $event->article->title,
            'user_id' => auth()->id(),
            'model_type' => get_class($event->article),
            'model_id' => $event->article->id,
        ]);
    }
}
