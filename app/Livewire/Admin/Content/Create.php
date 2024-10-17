<?php

namespace App\Livewire\Admin\Content;

use Livewire\Component;
use App\Models\Content;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    #[Validate('nullable')]
    public $title;
    #[Validate('nullable')]
    public $subtitle;
    #[Validate('required|unique:contents')]
    public $position;
    #[Validate('nullable|image:mimes:png,jpg,jpeg,webp')]
    public $image;

    public function messages()
    {
        return [
            'position.unique' => 'The content with position ":input" already exists',
            'position.required' => 'Please choose a position.',
        ];
    }

    public function showPosition($value)
    {
        $this->position = $value;
    }

    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('contents', $fileName, 'public');
            $this->image = 'contents/' . $fileName;
            // Add image name to validated data
            $validated['image'] = $filePath;
        }
        $slug = Str::slug($this->position);
        Content::create($validated+['slug'=>$slug]);
        return redirect()->route('contents')->with('message','Content created successfully.');
    }


    public function render()
    {
        return view('livewire.admin.content.create');
    }
}
