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
        $person = $query->orderByRaw('LOWER(name) asc')->paginate(5)->withPath(env('APP_URL') . '/person');
        return view('person.index', ['people' => $person, 'searchName' => $searchName]);
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
        return redirect(env('APP_URL') . '/person/create')->with('success', 'New person added.');
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

        return redirect(env('APP_URL') . '/person/' . $id . '/edit')->with('success', 'Person info updated.');
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);
        return view('person.show', ['person' => $person]);
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
        $person->delete();
        return redirect(env('APP_URL'))->with(['user' => "$name, $email", 'success' => 'Person deleted successfully.']);
    }
}
