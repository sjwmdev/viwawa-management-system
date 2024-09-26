<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChurchContribution extends Model
{
    use Auditable, CommonMigrationColumns, HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'church_contributions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'family_name',
        'amount',
        'description',
        'contribution_date',
        'month',
        'year',
        'status',
        'contribution_type_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'contribution_date' => 'datetime:Y-m-d',
    ];

    /**
     * Get and format family name to ucwords.
     *
     * @return string
     */
    public function getFamilyNameAttribute()
    {
        $name = $this->attributes['family_name'];
        return ucwords($name);
    }

    /**
     * Get the contribution type that owns the contribution.
     */
    public function contributionType()
    {
        return $this->belongsTo(ContributionType::class);
    }
}
