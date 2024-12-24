<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\Skill;
use App\Models\Job;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $activeskills;
    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $company_logo, $skills = []; 

    public function mount()
    {
        $this->activeskills = Skill::all();
    }

    public function createJob()
    {
        // echo "<pre>"; print_r($this->skills); exit;
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'experience' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'extra_info' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
        ]);

        $imageName = NULL;
        if ($this->company_logo) {
            $imageName = time().'.'. $this->company_logo->extension();
            Storage::putFileAs(
                'images/',
                $this->company_logo,
                $imageName
            );
        }

        // $jobskills = NULL;
        // if ($this->skills) {
        //     $jobskills = implode(',', $this->skills);
        // }

        $job = Job::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'company_logo' => $imageName  ?? NULL,
            // 'skills' => $jobskills,
        ]);

        $jobskills = NULL;
        if ($this->skills) {
            for ($i=0; $i < count($this->skills); $i++) { 
                if (!empty($this->skills[$i])) {
                    \DB::table('job_skill')->insert([
                        'job_id'    => $job->id,
                        'skill_id'  => $this->skills[$i],
                        'created_at'  => date("Y-m-d H:i:s"),
                    ]);
                }
            }
        }

        // $job->skills()->sync($this->skills);

        $this->jobs = Job::all();
        session()->flash('info', 'Job created successfully');
        $this->reset(['title','description','experience','salary','location','extra_info','company_name','company_logo','skills']);
        $this->dispatch('job-saved');
    }

    public function render()
    {
        return view('livewire.pages.jobs.create', ['activeskills' => $this->activeskills]);
    }
}
