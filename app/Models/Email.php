<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $table = 'emails';
    protected $fillable = [
        'to',
        'from',
        'message',
        'estate',
        ''
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
