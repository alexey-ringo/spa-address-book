<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Resources\Customer\PhoneCollection;


class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phone = Phone::create($request->only(['contact_id', 'phone']));
        
        if($phone) {
            return response()->json(['message' => 'Дополнительный телефон контакта успешно добавлен']);
        }
        else {
            return response()->json(['message' => 'Внутранняя ошибка при добавлении телефона!'], 500);
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
        //return new PhoneCollection(Phone::where('contact_id', $contract->id)->get());
        return new PhoneCollection($contact->phones);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        /*
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'sequence' => 'required',
            'is_super' => 'required',
            'is_final' => 'required',
        ]);
        */
        $phone->phone = $request->input('phone');
        $contact->save();
        
        if($phone) {
            return response()->json(['data' => 1]);
        }
        else {
            return response()->json(['data' => 0]);
        }  
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        if($phone->delete()) {
            return response()->json(['data' => 1]);
        }
        else {
            return response()->json(['message' => 'Внутренняя ошибка при удалении телефона контакта!']);
        }  
    }
}
