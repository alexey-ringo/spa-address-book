<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Process;
use App\Models\Group;
use App\Models\User;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Tariff;
use App\Models\Role;
use App\Models\Permission;
use Gate;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.app');
    }
    
    public function loggedUser(Request $request) {
        return response()->json(['data' => $request->user('api')]);
    }
    
    
}
