<?php

namespace App\Observers;

use App\Events\ModelCreated;
use App\Events\ModelUpdated;
use App\Events\ModelDeleted;
use App\Events\ModelRestored;
use App\Events\ModelForceDeleted;
use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

class GlobalObserver
{
    public function created(Model $model)
    {
        // Add your logic to handle the "created" event here
        $log = $this->createLog($model, 'created');

        // Check if the user_id is null, if so set it to null
        if ($log->user_id === null) {
            $log->user_id = null;
        }

        $log->save();
        event(new ModelCreated($log, $log->table_name));
    }

    public function updated(Model $model)
    {
        // Add your logic to handle the "updated" event here
        $log = $this->createLog($model, 'updated');
        $log->save();
        event(new ModelUpdated($log, $log->table_name));
    }

    public function deleted(Model $model)
    {
        // Add your logic to handle the "deleted" event here
        $log = $this->createLog($model, 'deleted');
        $log->save();
        event(new ModelDeleted($log, $log->table_name));
    }

    public function restored(Model $model)
    {
        // Add your logic to handle the "restored" event here
        $log = $this->createLog($model, 'restored');
        $log->save();
        event(new ModelRestored($log, $log->table_name));
    }

    public function forceDeleted(Model $model)
    {
        // Add your logic to handle the "forceDeleted" event here
        $log = $this->createLog($model, 'force_deleted');
        $log->save();
        event(new ModelForceDeleted($log, $log->table_name));
    }

    private function createLog(Model $model, string $action): Log
    {
        $log = new Log();
        $log->action = $action;
        $log->user_id = auth()->id();
        $log->table_name = $model->getTable();
        $log->row_id = $model->id;
        $log->old_data = json_encode($model->getOriginal());
        $log->new_data = json_encode($model->getAttributes());

        $log->request_url = request()->fullUrl();
        $log->request_method = request()->method();
        $log->remote_address = request()->ip();
        $log->path = request()->path();
        $log->host = request()->getHttpHost();

        return $log;
    }
}
