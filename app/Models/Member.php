<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use Auditable, CommonMigrationColumns, HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gender',
        'residence',
        'occupation',
        'family_status',
        'presence_status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'gender' => 'string',
        'residence' => 'string',
        'occupation' => 'string',
        'family_status' => 'string',
        'presence_status' => 'string',
    ];

    /**
     * Get the user associated with the member.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the contributions for the member.
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * Get the donations for the member.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the attendances for the member.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
