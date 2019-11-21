<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;

class Phone extends Model
{
    protected $table = 'phones';
    protected $fillable = [
        'contact_id', 'phone', 'description'
    ];
    
    public function contact() {
        //return $this->belongsTo(Customer::class, 'id');
        return $this->belongsTo(Contact::class);
    }
}
