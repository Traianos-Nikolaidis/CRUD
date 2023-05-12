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

        $person = $query->paginate(5)->withPath(env('PATH1').'/person');
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
        return redirect(env('PATH1'))->with('success', 'New person added.');
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => ['required','email', Rule::unique('people')->ignore($person)]
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $person->update($validation->validated());
        $baseUrl = request()->getSchemeAndHttpHost();

        return redirect(env('PATH1'))->with('success', 'Person info updated.');
    }

    public function delete($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();
        return redirect(env('PATH1'))->with('success', 'Person deleted.');
    }

    public function createForm()
    {
        return view('person.create');
    }

    public function updateForm($id)
    {
        $person = Person::findOrFail($id);
        return view('person.update', ['p' => $person]);
    }
}
