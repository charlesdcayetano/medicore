<?php

namespace App\Http\Controllers;

use App\Models\{Billing,BillingItem,Patient,Appointment};
use App\Http\Requests\StoreBillingRequest;

use Illuminate\Support\Facades\DB;


class BillingController extends Controller
{
  public function index(){
    $q=Billing::with('patient');
    if($s=request('status')) $q->where('status',$s);
    $bills=$q->orderBy('created_at','desc')->paginate(10);
    return view('billings.index',compact('bills'));
  }
  public function create(){
    return view('billings.create',[
      'patients'=>Patient::orderBy('last_name')->get(),
      'appointments'=>Appointment::orderBy('scheduled_at','desc')->get(),
    ]);
  }
  public function store(StoreBillingRequest $r){
    DB::transaction(function() use($r){
      $bill=Billing::create($r->only('patient_id','appointment_id','status','due_date'));
      $total=0;
      foreach(($r->input('items')??[]) as $it){
        $line=($it['quantity']??1)*($it['unit_price']??0);
        BillingItem::create([
          'billing_id'=>$bill->id,
          'description'=>$it['description'],
          'quantity'=>$it['quantity'],
          'unit_price'=>$it['unit_price'],
          'line_total'=>$line
        ]);
        $total+=$line;
      }
      $bill->update(['total_amount'=>$total]);
    });
    return to_route('billings.index')->with('success','Billing created.');
  }
  public function show(Billing $billing){ $billing->load('patient','items','appointment'); return view('billings.show',compact('billing')); }
  public function edit(Billing $billing){
    $billing->load('items');
    return view('billings.edit',[
      'billing'=>$billing,
      'patients'=>Patient::orderBy('last_name')->get(),
      'appointments'=>Appointment::orderBy('scheduled_at','desc')->get(),
    ]);
  }
  public function update(StoreBillingRequest $r, Billing $billing){
    DB::transaction(function() use($r,$billing){
      $billing->update($r->only('patient_id','appointment_id','status','due_date'));
      $billing->items()->delete();
      $total=0;
      foreach(($r->input('items')??[]) as $it){
        $line=($it['quantity']??1)*($it['unit_price']??0);
        $billing->items()->create($it+['line_total'=>$line]);
        $total+=$line;
      }
      $billing->update(['total_amount'=>$total]);
    });
    return to_route('billings.show',$billing)->with('success','Billing updated.');
  }
  public function destroy(Billing $billing){ $billing->delete(); return back()->with('success','Billing deleted.'); }
}
