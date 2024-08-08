<?php

namespace App\Listeners;

use App\Events\ModelCreated;
use App\Events\ModelUpdated;
use App\Events\ModelDeleted;
use App\Events\ModelForceDeleted;
use App\Events\ModelRestored;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class ActivityLogListener implements ShouldQueue
{
    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Events\Dispatcher
     */
    protected $events;

    /**
     * Create the event listener.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * Handle the event.
     *
     * @param  mixed  $event
     * @return void
     */

    public function handle($event)
    {
        $singularTableName = $event->log_table_name;
        $message = '';

        switch (get_class($event)) {
            case ModelCreated::class:
                $message = 'Taarifa mpya ya ' . $singularTableName . ' kuundwa';
                break;
            case ModelUpdated::class:
                $message = 'Taarifa ya ' . $singularTableName . ' kubadilishwa.';
                break;
            case ModelDeleted::class:
                $message = 'Taarifa ya ' . $singularTableName . ' kufutwa.';
                break;
            case ModelRestored::class:
                $message = 'Taarifa ya ' . $singularTableName . ' kurejeshwa.';
                break;
            case ModelForceDeleted::class:
                $message = 'Taarifa ya ' . $singularTableName . ' kufutwa.';
                break;
        }

        Notification::create([
            'type' => strtolower($singularTableName) . '_notification',
            'message' => $message,
            'auth_id' => Auth::user()->id ?? null,
            'model_info' => json_encode([
                'model_id' => $event->model->id,
                'model_type' => get_class($event->model),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(ModelCreated::class, 'App\Listeners\ActivityLogListener@handle');
        $events->listen(ModelUpdated::class, 'App\Listeners\ActivityLogListener@handle');
        $events->listen(ModelDeleted::class, 'App\Listeners\ActivityLogListener@handle');
        $events->listen(ModelRestored::class, 'App\Listeners\ActivityLogListener@handle');
        $events->listen(ModelForceDeleted::class, 'App\Listeners\ActivityLogListener@handle');
    }
}
