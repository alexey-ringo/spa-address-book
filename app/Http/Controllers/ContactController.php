<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\Contact\ContactCollection;
use App\Http\Resources\Contact\ContactResource;
use Auth;

class ContactController extends Controller
{
    protected $user;
    
    public function __construct()
    {
       $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty($this->user)) {
            return response()->json(['message' => 'Невозможно отобразить список контактов - не найден текущий пользователь!'], 500);
        }
       
        return new ContactCollection(Contact::where('user_id', $this->user->id)->with('phones')->paginate(3));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        if(empty($this->user)) {
            return response()->json(['message' => 'Невозможно сохранить новый контакт - не найден текущий пользователь!'], 500);
        }
        
        $contact = Contact::create([
            'name' => $request->input('name'), 
            'second_name' => $request->input('second_name'), 
            'surname' => $request->input('surname'), 
            'email' => $request->input('email'), 
            'description' => $request->input('description'), 
            'user_id' => $this->user->id,
        ]);
        
        if($contact) {
            $phone = Phone::create([
                'contact_id' => $contact->id,
                'phone' => $request->input('phone')
            ]);
            return response()->json(['message' => 'Новый контакт успешно создан']);
        }
        else {
            return response()->json(['message' => 'Внутранняя ошибка сервера при создании нового контакта!'], 500);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $contact = Contact::find($id);
        
        if($contact) {
            
            return new ContactResource($contact);
        }
        else {
            return response()->json(['message' => 'Контакт с идентификатором id ' . $id . ' не найден!'], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        if($contact->update($request->only(['name', 'second_name', 'surname', 'email', 'description']))) {
            return response()->json(['message' => 'Изменения для контакта успешно применены']);
        }
        else {
            return response()->json(['message' => 'Внутренняя ошибка сервера при сохранении изменений в контакте!'], 500);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if($contact->delete()) {
            return response()->json(['data' => 1]);
        }
        else {
            return response()->json(['data' => 0]);
        }  
    }
}
