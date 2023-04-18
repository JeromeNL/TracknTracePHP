<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Webshop;
use App\Http\Requests\StorewebshopRequest;
use App\Http\Requests\UpdatewebshopRequest;

class WebshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webshops = Webshop::sortable()->paginate(15);
        return view('webshops.index', compact('webshops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('webshops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorewebshopRequest $request)
    {
        $validatedRequest = $request->validated();
        $address = new Address();
        $address->street = $validatedRequest['street'];
        $address->number = $validatedRequest['number'];
        $address->postal_code = $validatedRequest['postal_code'];
        $address->city = $validatedRequest['city'];
        $address->country = $validatedRequest['country'];
        $address->save();

        $webshop = new Webshop();
        $webshop->name = $validatedRequest['name'];
        $webshop->address_id = $address->id;
        $webshop->email = $validatedRequest['email'];
        $webshop->phone = $validatedRequest['phone'];
        $webshop->website = $validatedRequest['website'];
        $webshop->save();

        flash(trans('webshops.webshop_create_success'));
        return redirect()->route('webshops.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Webshop $webshop)
    {
        return view('webshops.show', compact('webshop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Webshop $webshop)
    {
        return view('webshops.edit', compact('webshop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatewebshopRequest $request, Webshop $webshop)
    {
        $validatedRequest = $request->validated();
        $webshop->update($validatedRequest);
        $webshop->address()->update([
            'street' => $validatedRequest['street'],
            'number' => $validatedRequest['number'],
            'postal_code' => $validatedRequest['postal_code'],
            'city' => $validatedRequest['city'],
            'country' => $validatedRequest['country'],
        ]);

        flash(trans('webshops.webshop_edit_success'));
        return redirect()->route('webshops.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Webshop $webshop)
    {
        // Soft deletes webshop
        $webshop->delete();
        flash(trans('webshops.webshop_delete_success'));
        return redirect()->route('webshops.index');
    }
}
