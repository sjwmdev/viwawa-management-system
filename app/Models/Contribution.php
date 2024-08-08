<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribution extends Model
{
    use Auditable, CommonMigrationColumns, HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contributions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contribution_type_id',
        'member_id',
        'paid_amount',
        'date',
        'remaining_amount',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'date' => 'date',
        'status' => 'string',
    ];

    /**
     * Get the contribution type that owns the contribution.
     */
    public function contributionType()
    {
        return $this->belongsTo(ContributionType::class, 'contribution_type_id');
    }

    /**
     * Get the member that owns the contribution.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
