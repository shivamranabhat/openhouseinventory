<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    #[Validate('required|unique:testimonials')]
    public $name;
    #[Validate('required')]
    public $role;
    #[Validate('required|numeric|max:5')]
    public $rating;
    #[Validate('required')]
    public $description;
    #[Validate('required|image:mimes:png,jpg,jpeg,webp')]
    public $image;

    public function messages()
    {
        return [
            'name.unique' => 'The testimonial with name ":input" already exists',
            'name.required' => 'Please choose a valid name.',
        ];
    }
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $folderPath = 'testimonials/' ;
            $filePath = $this->image->storeAs($folderPath, $fileName, 'public');
            $this->image = 'testimonials/'.'/' . $fileName;
            // Add image name to validated data
            $validated['image'] = $filePath;
        }
        $slug = Str::slug($this->name);
        Testimonial::create($validated+['slug'=>$slug]);
        return redirect()->route('testimonials')->with('message','Testimonial created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.testimonial.create');
    }
}
