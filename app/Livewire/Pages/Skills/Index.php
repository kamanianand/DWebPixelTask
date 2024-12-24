<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public $skills, $newSkill;
    public $skillId, $name;

    public function mount() {
        $this->skills = Skill::all();
    }
    
    public function addSkill()
    {
        // Validate input
        $this->validate([
            'newSkill' => 'required|string|max:255',
        ]);

        Skill::create(['name' => $this->newSkill]);

        $this->skills = Skill::all();
        // $this->resetForm();
        $this->reset(['name']);
    }
    
    public function loadSkills()
    {
        $this->skills = Skill::all();
    }

    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skillId = $skill->id;
        $this->name = $skill->name;
    }

    public function updateSkill()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $skill = Skill::findOrFail($this->skillId);
        $skill->name = $this->name;
        $skill->save();

        $this->resetForm();
        $this->loadSkills();
        session()->flash('message', 'Skill updated successfully.');
    }

    public function resetForm()
    {
        $this->skillId = null;
        $this->name = '';
    }

    public function deleteSkill($id)
    {
        Skill::findOrFail($id)->delete();
        $this->skills = Skill::all();
    }

    public function render() 
    {
        return view('livewire.pages.skills.index', ['skills' => $this->skills]);
    }

}
