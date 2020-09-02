<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BlogPostPosted;
use App\User;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;

class NotifyAdminWhenBlogPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::thatIsAdmin()->get()->map(function(User $user){
            ThrottledMail::dispatch(new BlogPostAdded(), $user);
        });
    }
}
