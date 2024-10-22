<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'message', 'auth_id', 'model_info', 'deleted_at', 'read_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Mark the notification as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        $this->update(['read_at' => Carbon::now()]);
    }

    /**
     * Remove the notification from the list.
     *
     * @return void
     */
    public function removeNotification()
    {
        $this->update(['deleted_at' => Carbon::now()]);
    }

    /**
     * A one-to-many relationship.
     * A notification is generated by a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'auth_id');
    }
}
