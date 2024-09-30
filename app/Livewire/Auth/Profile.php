<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Employee;
use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 

class Profile extends Component
{
    use WithFileUploads;
    public $user;
    #[Validate('nullable')]
    public $name;
    #[Validate('nullable')]
    public $email;
    #[Validate('nullable')]
    public $address;
    #[Validate('nullable|numeric')]
    public $age;
    public $image;
    #[Validate('required|min:6')]
    public $password;

    #[Validate('required|same:password')]
    public $password_confirmation;
    public $employee;

    #[On('image-deleted')] 
    #[On('image-updated')] 
    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        if($this->user->role != 'Company')
        {
            $this->address = $this->user->employee->address;
            $this->age = $this->user->employee->age;
            $this->employee = Employee::find($this->user->employee_id);
        }
    }
    public function save()
    {
        if($this->employee)
        {
            if($this->name || $this->address || $this->age || $this->designation)
            {
                $this->employee->update([
                    'name' => $this->name,
                    'address' => $this->address,
                    'age' => $this->age,
                ]);
                $this->dispatch('name-changed');
            }
        }
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('profiles', $fileName, 'public');
            $this->image = 'profiles/' . $fileName;
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : $this->user->password,
                'image'=>$this->image,
            ]);
            $this->dispatch('image-updated')->self();
            $this->dispatch('image-added');
            $this->dispatch('name-changed');
        }
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
        ]);
        $this->dispatch('name-changed');
        session()->flash('success', 'Profile updated successfully.');
    }

    public function deleteImage()
    {
        if (!empty($this->user->image)) {
            $image_path = public_path('storage/' . $this->user->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->user->update(['image' => '']);
            $this->dispatch('image-deleted')->self();
            $this->dispatch('image-removed');
        }
    }
    public function render()
    {
        return view('livewire.auth.profile');
    }
}
