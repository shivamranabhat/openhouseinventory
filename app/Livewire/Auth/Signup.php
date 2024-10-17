<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Signup extends Component
{
    use WithFileUploads;
    #[Validate('required|unique:companies')]
    public $name;
    #[Validate('required|unique:users')]
    public $email;
    #[Validate('required|min:6')]
    public $password;
    #[Validate('required|same:password')]
    public $password_confirmation;
    #[Validate('required|image:mimes:png,jpg,jpeg,svg,webp')]
    public $image;

    public function save()
    {
        // Validate the input
        $validatedData = $this->validate();

        // Hash the password before storing it
        $validatedData['password'] = Hash::make($this->password);
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $companyName = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->name);
            $folderPath = 'profiles/' . $companyName;
            $filePath = $this->image->storeAs($folderPath, $fileName, 'public');
            $validated['image'] = $filePath;
        }
        $slug = Str::slug($this->name);
        $company = Company::create([
            'name'=>$this->name,
            'image'=>$validated['image'],
            'slug'=>$slug,
        ]);
        // Create the user with hashed password
        User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'image'=>$validated['image'],
            'company_id'=>$company->id,
            'role'=>'Company',
            'can_create'=>'Yes',
            'can_edit'=>'Yes',
            'can_delete'=>'Yes',
            'can_approve'=>'Yes',
            'can_decline'=>'Yes',
            'slug'=>$slug,
        ]);
        

        // Optionally, redirect or show a success message
        session()->flash('success', 'User registered successfully!');

        // Reset the fields after successful registration
       return redirect()->route('login')->with('message','Account created successfully');
    }
    public function render()
    {
        return view('livewire.auth.signup');
    }
}
