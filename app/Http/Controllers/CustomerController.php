<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $fields = $request->validated();
        $customer = Customer::where('email', $request->email)->first();

        if ($customer === null) {
            flash('Er is geen klant gevonden met dit e-mailadres.');
            return redirect()->back();
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $user->customer()->associate($customer);
        $user->assignRole('Customer');
        $user->save();

        Auth::login($user);
        return view('home');
    }
}
