<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'document_name', 'document_type', 'document_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
