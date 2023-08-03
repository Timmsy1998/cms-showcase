<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogArticleUpdatedActivity
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
    public function handle(ArticleUpdated $event): void
    {
        // Create an activity log when an article is updated
        Activity::create([
            'action' => 'updated',
            'description' => 'Article updated: ' . $event->article->title,
            'user_id' => auth()->id(),
            'model_type' => get_class($event->article),
            'model_id' => $event->article->id,
        ]);
    }
}
