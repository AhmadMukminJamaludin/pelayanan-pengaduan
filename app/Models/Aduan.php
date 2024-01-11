<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aduan extends Model
{
    use SoftDeletes;

    protected $table = 'aduan';

    protected $guarded = [];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->no_tracking = generateNoTracking();
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->id();
            $model->save();
        });
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function respon(): HasMany
    {
        return $this->hasMany(Respon::class);
    }

    public function responLatest()
    {
        return $this->hasOne(Respon::class)->latestOfMany();
    }
}
