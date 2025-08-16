<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryItemRequest;

class InventoryController extends Controller
{
    public function index()
    {
        $q = Inventory::query();

        if ($s = request('q')) {
            $q->where(function ($query) use ($s) {
                $query->where('name', 'like', "%$s%")
                      ->orWhere('sku', 'like', "%$s%");
            });
        }

        $items = $q->paginate(10);

        // FIX: point to the right folder
        return view('inventory.index', compact('items'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(StoreInventoryItemRequest $r)
    {
        Inventory::create($r->validated());

        return to_route('inventory.index')->with('success', 'Item added.');
    }

    public function show(Inventory $inventory)
    {
        return view('inventory.show', ['item' => $inventory]);
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', ['item' => $inventory]);
    }

    public function update(StoreInventoryItemRequest $r, Inventory $inventory)
    {
        $inventory->update($r->validated());

        return to_route('inventory.index')->with('success', 'Item updated.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return back()->with('success', 'Item deleted.');
    }
}
