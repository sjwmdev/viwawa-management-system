<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CommonMigrationColumns
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    protected static function bootCommonMigrationColumns()
    {
        // Set the created_by attribute when creating a new model
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        // Set the updated_by attribute when updating a model
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });

        // Set the deleted_by attribute when deleting a model
        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
        });
    }

    /**
     * Define the audit information columns in the database table.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $table
     * @return void
     */
    protected function auditInfoColumns($table)
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();
    }

    /**
     * Define reserved columns in the database table.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $table
     * @return void
     */
    protected function reservedColumns($table)
    {
        $table->string('rsvd_5', 1)->nullable();
        $table->string('rsvd_4', 1)->nullable();
        $table->string('rsvd_3', 1)->nullable();
        $table->string('rsvd_2', 1)->nullable();
        $table->string('rsvd_1', 1)->nullable();
    }

    /**
     * Define foreign key constraints for audit information columns.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $table
     * @return void
     */
    protected function auditInfoColumnsForeignKeys($table)
    {
        $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

        $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

        $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
    }
}