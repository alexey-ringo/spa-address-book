<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Resources\Contact\ContactCollection;
use Auth;


class SearchController extends Controller
{
    protected $user;
    
    public function __construct()
    {
       $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    
    public function search(Request $request)
    {
        if(empty($this->user)) {
            return response()->json(['message' => 'Поиск невозможен - не найден текущий пользователь!'], 500);
        }
        $search = $request->input('keywords');
        $contacts = Contact::latest()
                    ->where('user_id', $this->user->id)
                    ->where('surname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('phones', function($q) use($search) {
                        $q->where('phone', 'like', '%' . $search . '%');
                    })
        ->with('phones')->paginate(1);
        
        return new ContactCollection($contacts);
    }
}
