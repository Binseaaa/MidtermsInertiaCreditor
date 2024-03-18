<?php

namespace App\Http\Controllers;

use App\Models\Creditor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreditorController extends Controller
{
    public function index() {
        $creditor = Creditor::orderBy('id')->get();

        return Inertia::render('Creditors/Index', [
            'creditor' => $creditor
        ]);
    }

    public function create() {
        return Inertia::render('Creditors/Create');
    }

    public function show(Creditor $creditor) {
        // sleep(3);
        return inertia('Creditors/Show', [
            'creditor' => $creditor]);
    }

    public function update(Request $request, Creditor $creditor) {
        $fields = $request->validate([
            'last_name'   => 'required',
            'first_name'  => 'required',
            'gender'      => 'required',
            'address'     => 'required',
            'phone'       => 'required',
            'birth_date'  => 'required',
            'credit_limit'=> 'required'
        ]);
        $creditor->update($fields);

        return back();
    }

    public function store (Request $request) {
        $request->validate([
            'last_name'   => 'required',
            'first_name'  => 'required',
            'gender'      => 'required',
            'address'     => 'required',
            'phone'       => 'required',
            'birth_date'  => 'required',
            'credit_limit'=> 'required'
        ]);

        Creditor::create($request->all());

        return redirect('/creditors');
    }

    public function destroy(Creditor $creditor) {
        $creditor->delete();

        return redirect('/creditors');
    }
}
