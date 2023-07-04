<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //Index
    public function index(CompanyRepository $company)
    {
        // dd(Auth::user());
        $contacts = Contact::where(function ($query) {
            if ($companyId = request()->query("company_id")) {
                $query->where("company_id", $companyId);
            }
        })->where(function ($query) {
            if ($search = request()->query('search')) {
                $query->where("first_name", "LIKE", "%{$search}%");
                $query->orWhere("last_name", "LIKE", "%{$search}%");
                $query->orWhere("email", "LIKE", "%{$search}%");
            }
        })->paginate(10);
        $companies = $company->company_data();
        return view('contacts.index', ['contacts' => $contacts, 'companies' => $companies]);
    }

    //Create
    public function create()
    {
        $companies = Company::pluck('name', 'id');
        return view('contacts.create', compact('companies'));
    }


    //Show
    public function show($id)
    {
        $contacts = $this->getContacts();
        abort_if(!isset($contacts[$id]), 404);
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact', $contact);
    }


    protected function getContacts()
    {
        return [
            1 => ['firstname' => 'Sok', 'lastname' => 'Dara', 'email' => 'dara@abc.com', 'phone' => '092 293 234', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            2 => ['firstname' => 'Sok', 'lastname' => 'Pisey', 'email' => 'pisey@abc.com', 'phone' => '092 234 123', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            3 => ['firstname' => 'Chan', 'lastname' => 'Ratha', 'email' => 'ratha@xyz.com', 'phone' => '092 234 233', 'address' => 'Phnom Penh', 'company' => 'XYZ'],
            4 => ['firstname' => 'Kos', 'lastname' => 'Borey', 'email' => 'borey@mno.com', 'phone' => '092 234 343', 'address' => 'Phnom Penh', 'company' => 'MNO'],
            5 => ['firstname' => 'Sok', 'lastname' => 'Dara', 'email' => 'dara@abc.com', 'phone' => '092 293 234', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            6 => ['firstname' => 'Sok', 'lastname' => 'Pisey', 'email' => 'pisey@abc.com', 'phone' => '092 234 123', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            7 => ['firstname' => 'Chan', 'lastname' => 'Ratha', 'email' => 'ratha@xyz.com', 'phone' => '092 234 233', 'address' => 'Phnom Penh', 'company' => 'XYZ'],
            8 => ['firstname' => 'Kos', 'lastname' => 'Borey', 'email' => 'borey@mno.com', 'phone' => '092 234 343', 'address' => 'Phnom Penh', 'company' => 'MNO'],
            9 => ['firstname' => 'Sok', 'lastname' => 'Dara', 'email' => 'dara@abc.com', 'phone' => '092 293 234', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            10 => ['firstname' => 'Sok', 'lastname' => 'Pisey', 'email' => 'pisey@abc.com', 'phone' => '092 234 123', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            11 => ['firstname' => 'Chan', 'lastname' => 'Ratha', 'email' => 'ratha@xyz.com', 'phone' => '092 234 233', 'address' => 'Phnom Penh', 'company' => 'XYZ'],
            12 => ['firstname' => 'Kos', 'lastname' => 'Borey', 'email' => 'borey@mno.com', 'phone' => '092 234 343', 'address' => 'Phnom Penh', 'company' => 'MNO'],
        
        ];
    }
    protected function getCompanies()
    {
        return [
            1 => ['name' => 'Company 1'],
            2 => ['name' => 'Company 2'],
        ];
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]);
        //dd($request->all());
        Contact::create($request->all());
        $message = "Contact has been added successfully";
        return redirect()->route('contacts.index')->with('message', $message);
    }
    public function edit($id)
    {
        $companies = Company::pluck('name', 'id');
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('companies', 'contact'));
    }
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]);
        $contact->update($request->all());
        $message = "Contact has been updated successfully";
        return redirect()->route('contacts.index')->with('message', $message);
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return back()->with('message', 'Contact has been removed successfully');
    }
}
