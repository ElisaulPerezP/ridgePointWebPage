<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingMatter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'message',
        'creation_date',
        'creation_place',
        'client_id',
        'responsible_id', 
    ];

    protected $dates = ['creation_date'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }
}
