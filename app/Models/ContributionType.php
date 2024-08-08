<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContributionType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contribution_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'goal',
        'goal_amount',
        'identifier',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'goal_amount' => 'decimal:2',
    ];

    /**
     * Get the contributions for the contribution type.
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
}
