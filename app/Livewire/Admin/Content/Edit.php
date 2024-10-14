<?php

namespace App\Livewire\Admin\Content;

use Livewire\Component;
use App\Models\Content;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $slug;
    public $content;
    public $title;
    public $subtitle;
    public $image;
    public $position;
    #[Validate('nullable|image|mimes:jpg,webp,jpeg,png')]
    public $new_image;

    protected function rules()
    {
        return [
            'title' => 'nullable|unique:contents,title,' . $this->content->id,
            'subtitle' => 'nullable',
            'position' => 'required',
        ];
    }
    
    protected function messages()
    {
        return [
            'title.unique' => 'The content with title ":input" already exists',
        ];
    }

    public function mount()
    {
        $this->content = Content::whereSlug($this->slug)->first();
        $this->title = $this->content->title;
        $this->subtitle = $this->content->subtitle;
        $this->position = $this->content->position;
        $this->image = $this->content->image;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->position);
        if($this->new_image)
        {
            $this->updateImage();
        }
        $this->content->update([
            'title' => $this->title,
            'subtitle'=>$this->subtitle,
            'position'=>$this->position,
            'image' => $this->image ? $this->image : $this->new_image,
            'slug' => $slug,
        ]);
        sleep(1);
        return redirect()->route('contents')->with('message','Content updated successfully.');
    }
    public function updateImage()
    {
        if ($this->new_image) 
        {
            $fileName = $this->new_image->getClientOriginalName();
            $filePath = $this->new_image->storeAs('contents', $fileName, 'public');
            $this->new_image = 'contents/' . $fileName;
            $this->content->update(['image' => $this->new_image]);
        }
    }

    public function deleteImage()
    {
        if (!empty($this->content->image)) {
            $image_path = public_path('storage/' . $this->content->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->content->update(['image' => '']);
            $this->mount();
        }
    }
    public function render()
    {
        return view('livewire.admin.content.edit');
    }
}
