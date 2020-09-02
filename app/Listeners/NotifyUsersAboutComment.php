<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentPosted;
use App\Jobs\NotifyUsersPostWasComment;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostedMarkdown;

class NotifyUsersAboutComment
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        ThrottledMail::dispatch(
            new CommentPostedMarkdown($event->comment), $event->comment->commentable->user
        )->onQueue('low');
        NotifyUsersPostWasComment::dispatch($event->comment)->onQueue('high');
    }
}
