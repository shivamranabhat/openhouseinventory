<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\Blog;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    #[Validate('required|unique:blogs')]
    public $title;
    #[Validate('required')]
    public $author;
    #[Validate('required')]
    public $description;
    #[Validate('required|image:mimes:png,jpg,jpeg,webp')]
    public $image;

    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('blogs', $fileName, 'public');
            $this->image = 'blogs/' . $fileName;
            // Add image name to validated data
            $validated['image'] = $filePath;
        }
        $slug = Str::slug($this->title);
        Blog::create($validated+['slug'=>$slug]);
        return redirect()->route('blogs')->with('message','Blog created successfully.');
    }


    public function render()
    {
        return view('livewire.admin.blog.create');
    }
}
