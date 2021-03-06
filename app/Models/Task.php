<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'deadline',
        'is_disabled',
        'is_completed'
    ];

    /**
     * @return BelongsTo
     */
    public function todo(): BelongsTo
    {
        return $this->belongsTo('App\Models\Todo');
    }
}
