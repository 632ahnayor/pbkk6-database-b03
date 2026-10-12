<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['judul', 'deskripsi', 'tema_agent', 'api_key_secure'])]
class Project extends Model
{
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
