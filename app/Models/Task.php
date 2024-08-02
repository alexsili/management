<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\Tasks\TasksObserver;

#[ObservedBy([TasksObserver::class])]
class Task extends Model
{
    protected $fillable = [
        'name',
        'project_id',
        'priority',
        'created_at',
        'updated_at',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
