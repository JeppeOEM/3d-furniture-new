<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sofa extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'color'];

    public function belongsComponent(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Component::class, 'component_sofa', 'sofas_id', 'components_id');
    }
}
