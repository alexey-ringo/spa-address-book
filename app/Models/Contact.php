<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'name', 'second_name', 'surname', 'email', 'description', 'user_id'
    ];
    
    public function phones() {
      return $this->hasMany(Phone::class, 'contact_id', 'id');
    }
    
    public function user() {
        //return $this->belongsTo(Tariff::class, 'id');
        return $this->belongsTo(User::class);
    }
}
