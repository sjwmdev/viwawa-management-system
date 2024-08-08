<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

trait Auditable
{
    /**
     * Get the user who created this record.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this record.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the user who deleted this record.
     */
    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Get the created_at attribute in a human-readable format.
     */
    public function getCreatedAtHumanAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * Get the updated_at attribute in a human-readable format.
     */
    public function getUpdatedAtHumanAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    /**
     * Get the deleted_at attribute in a human-readable format.
     */
    public function getDeletedAtHumanAttribute()
    {
        return $this->deleted_at ? Carbon::parse($this->deleted_at)->diffForHumans() : null;
    }
}
