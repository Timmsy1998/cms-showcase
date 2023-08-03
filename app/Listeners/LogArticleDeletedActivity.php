<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogArticleDeletedActivity
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
    public function handle(ArticleDeleted $event): void
    {
        // Create an activity log when an article is deleted
        Activity::create([
            'action' => 'deleted',
            'description' => 'Article deleted: ' . $event->article->title,
            'user_id' => auth()->id(),
            'model_type' => get_class($event->article),
            'model_id' => $event->article->id,
        ]);
    }
}
