<?php

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use App\Models\Faq;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
    public $faq;

    public function mount()
    {
        $this->faq = Faq::whereSlug($this->slug)->first();
        $this->title = $this->faq->title;
        $this->description = $this->faq->description;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->title);
        $this->faq->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('faqs')->with('message','Faq updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.faq.edit');
    }
}
