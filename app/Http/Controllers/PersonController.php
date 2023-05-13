<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{

    public function index(Request $request)
    {
        $searchName = $request->input("searchName");
        $query = Person::query();

        if ($searchName) $query->where('name', 'LIKE', "%{$searchName}%");

        $person = $query->orderBy('name', 'asc')->paginate(5)->withPath(config('app.url') . '/person');
        return view('person.index', ['person' => $person, 'searchName' => $searchName]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:people',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $person = Person::create($validation->validated());
        return redirect(config('app.url') . '/person/create')->with('success', 'New person added.');
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => ['required', 'email', Rule::unique('people')->ignore($person)]
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $person->update($validation->validated());

        return redirect(config('app.url') . '/person/' . $id . '/edit')->with('success', 'Person info updated.');
    }

    public function show($id)
    {
        $p = Person::findOrFail($id);
        return view('person.show', ['p' => $p]);
    }

    public function create()
    {
        return view('person.create');
    }

    public function edit($id)
    {
        $person = Person::findOrFail($id);
        return view('person.edit', ['person' => $person]);
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $name = $person->name;
        $email = $person->email;
        if ($person->delete())
            return redirect(config('app.url'))->with(['user' => "$name, $email", 'success' => 'Person deleted successfully.']);
    }
}
