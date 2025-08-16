<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;

class RoomController extends Controller
{
  public function index(){ $rooms=Room::orderBy('number')->paginate(10); return view('rooms.index',compact('rooms')); }
  public function create(){ return view('rooms.create'); }
  public function store(StoreRoomRequest $r){ Room::create($r->validated()+['is_available'=>$r->boolean('is_available')]); return to_route('rooms.index')->with('success','Room created.'); }
  public function show(Room $room){ return view('rooms.show',compact('room')); }
  public function edit(Room $room){ return view('rooms.edit',compact('room')); }
  public function update(StoreRoomRequest $r, Room $room){ $room->update($r->validated()+['is_available'=>$r->boolean('is_available')]); return to_route('rooms.index')->with('success','Room updated.'); }
  public function destroy(Room $room){ $room->delete(); return back()->with('success','Room deleted.'); }
}
