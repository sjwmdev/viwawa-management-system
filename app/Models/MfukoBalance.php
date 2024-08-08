<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MfukoBalance extends Model
{
    use Auditable, CommonMigrationColumns, HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mfuko_balance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contribution_balance',
        'income_balance',
        'expenditure_balance',
        'total_balance',
        'date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'contribution_balance' => 'decimal:2',
        'income_balance' => 'decimal:2',
        'expenditure_balance' => 'decimal:2',
        'total_balance' => 'decimal:2',
        'date' => 'date',
    ];
}
