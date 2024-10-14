<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $name;
    public $role;
    public $rating;
    public $description;
    #[Validate('nullable|image|mimes:jpg,webp,jpeg,png')]
    public $new_image;
    public $image;
    public $slug;
    public $testimonial;

    protected function rules()
    {
        return [
           'name' => 'required|unique:testimonials,name,' . $this->testimonial->id,
            'role' => 'required',
            'rating' => 'required|numeric|max:5',
            'description' => 'required',
        ];
    }
    
    protected function messages()
    {
        return [
            'name.unique' => 'The testimonial with name ":input" already exists',
        ];
    }

    public function mount()
    {
        $this->testimonial = Testimonial::whereSlug($this->slug)->first();
        $this->name = $this->testimonial->name;
        $this->role = $this->testimonial->role;
        $this->rating = $this->testimonial->rating;
        $this->description = $this->testimonial->description;
        $this->image = $this->testimonial->image;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->name);
        if($this->new_image)
        {
            $this->updateImage();
        }
        $this->testimonial->update([
            'name' => $this->name,
            'rating'=>$this->rating,
            'role'=>$this->role,
            'description'=>$this->description,
            'image' => $this->image ? $this->image : $this->new_image,
            'slug' => $slug,
        ]);
        sleep(1);
        return redirect()->route('testimonials')->with('message','Testimonial updated successfully.');
    }
    public function updateImage()
    {
        if ($this->new_image) 
        {
            $fileName = $this->new_image->getClientOriginalName();
            $filePath = $this->new_image->storeAs('testimonials', $fileName, 'public');
            $this->new_image = 'testimonials/' . $fileName;
            $this->testimonial->update(['image' => $this->new_image]);
        }
    }

    public function deleteImage()
    {
        if (!empty($this->testimonial->image)) {
            $image_path = public_path('storage/' . $this->testimonial->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->testimonial->update(['image' => '']);
            $this->mount();
        }
    }
    public function render()
    {
        return view('livewire.admin.testimonial.edit');
    }
}
