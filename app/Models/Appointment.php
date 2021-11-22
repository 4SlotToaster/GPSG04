<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function path()
    {
        return route('appointment.show', $this);
    }
}
