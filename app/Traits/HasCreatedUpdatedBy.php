<?php

namespace App\Traits;

trait HasCreatedUpdatedBy
{
    public static function bootHasCreatedUpdatedBy()
    {
        // updating created_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }

    /**
     * Get the created by that owns the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @user App\Models\User
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the updated by that owns the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @user App\Models\User
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
