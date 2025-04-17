<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'completed' => 'boolean',
    ];

    protected $fillable = ['title', 'description', 'long_description', 'completed'];

    public function toggleCompleted()
    {
        $this->update(['completed' => !$this->completed]);
    }
}
