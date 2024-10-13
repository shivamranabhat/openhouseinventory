<?php

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use App\Models\Faq;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;
   
 
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->title);
        Faq::create($validated+['slug'=>$slug]);
        return redirect()->route('faqs')->with('message','Faq created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.faq.create');
    }
}
