<?php

namespace App\Livewire\Admin\Feature;

use Livewire\Component;
use App\Models\Feature;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $icon;
    #[Validate('nullable|image|mimes:jpg,webp,jpeg,png,svg')]
    public $new_icon;
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $type;
    public $slug;
    public $feature;

    public function mount()
    {
        $this->feature = Feature::whereSlug($this->slug)->first();
        $this->icon = $this->feature->icon;
        $this->title = $this->feature->title;
        $this->type = $this->feature->type;
        $this->description = $this->feature->description;
    }

    public function updateIcon()
    {
        if ($this->new_icon) 
        {
            $fileName = $this->new_icon->getClientOriginalName();
            $filePath = $this->new_icon->storeAs('features', $fileName, 'public');
            $this->new_icon = 'features/' . $fileName;
            $this->feature->update(['icon' => $this->new_icon]);
        }
    }

    public function deleteIcon()
    {
        if (!empty($this->feature->icon)) {
            $icon_path = public_path('storage/' . $this->feature->icon);
            if (file_exists($icon_path)) {
                unlink($icon_path);
            }
            $this->feature->update(['icon' => '']);
            $this->mount();
        }
    }

    public function changeType($value)
    {
        $this->type = $value;
    }
    
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->title);
        if($this->new_icon)
        {
            $this->updateIcon();
        }
        $icon = '';
        if ($this->type !== 'Software Feature') {
            $icon = $this->new_icon ? $this->new_icon : $this->icon;
        }
        $this->feature->update([
            'title' => $this->title,
            'description'=>$this->description,
            'type'=>$this->type,
            'icon' => $icon,
            'slug' => $slug,
        ]);
        sleep(1);
        return redirect()->route('features')->with('message','Feature updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.feature.edit');
    }
}
