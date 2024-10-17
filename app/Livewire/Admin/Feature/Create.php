<?php

namespace App\Livewire\Admin\Feature;

use Livewire\Component;
use App\Models\Feature;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    #[Validate('nullable|image:mimes:png,jpg,jpeg,svg,webp')]
    public $icon;
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $type;

    public function changeType($value)
    {
        $this->type = $value;
    }

    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        if ($this->icon) {
            $fileName = $this->icon->getClientOriginalName();
            $filePath = $this->icon->storeAs('services', $fileName, 'public');
            $this->icon = 'services/' . $fileName;
            $validated['icon'] = $filePath;
        }
        $slug = Str::slug($this->title);
        Feature::create($validated+['slug'=>$slug]);
        return redirect()->route('features')->with('message','Testimonial created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.feature.create');
    }
}
