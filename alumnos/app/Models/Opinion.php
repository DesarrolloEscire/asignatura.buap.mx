<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $table = "opinions";
    public $timestamps = true;

    protected $fillable = [
        'message',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function userOpinion(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
