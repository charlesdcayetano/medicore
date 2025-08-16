<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index(){
    $q=User::with('department');
    if($r=request('role')) $q->where('role',$r);
    $users=$q->orderBy('name')->paginate(10);
    return view('users.index',compact('users'));
  }
  public function create(){ return view('users.create',['departments'=>Department::orderBy('name')->get()]); }
  public function store(StoreUserRequest $r){
    $data=$r->validated();
    if(!empty($data['password'])) $data['password']=Hash::make($data['password']);
    User::create($data);
    return to_route('users.index')->with('success','User created.');
  }
  public function show(User $user){ return view('users.show',compact('user')); }
  public function edit(User $user){ return view('users.edit',['user'=>$user,'departments'=>Department::orderBy('name')->get()]); }
  public function update(StoreUserRequest $r, User $user){
    $data=$r->validated();
    if(!empty($data['password'])) $data['password']=Hash::make($data['password']); else unset($data['password']);
    $user->update($data);
    return to_route('users.index')->with('success','User updated.');
  }
  public function destroy(User $user){ $user->delete(); return back()->with('success','User deleted.'); }
}
