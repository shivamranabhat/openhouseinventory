<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Content;
use App\Models\Message;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Contact extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required|email')]
    public $email;
    #[Validate('required')]
    public $mobile;
    #[Validate('required')]
    public $subject;
    #[Validate('required')]
    public $description;

    public function send()
    {
        $validated = $this->validate();
        sleep(1.2);
        $slug = Str::slug($this->name.'-'.time());
        Message::create($validated+['slug'=>$slug]);
        $this->reset();
        session()->flash('success','Employee created successfully.');
    }

    public function render()
    {
        $content = Content::where('position','Contact')->first();
        return view('livewire.home.contact',compact('content'));
    }
}
