<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\Job;

class Index extends Component
{
    public $jobs;
    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $company_logo, $skills = []; 

    public function mount()
    {
        $this->jobs = Job::with('skills')->get();
    }

    public function deleteJob($id)
    {
        Job::findOrFail($id)->delete();
        \DB::table('job_skill')->where('job_id',$id)->delete();
        $this->jobs = Job::all();
    }

    public function render()
    {
        // echo "<pre>"; print_r($this->jobs->toArray()); exit;
        // echo "<pre>"; print_r($this->jobs[0]['skills'][0]->name); exit;
        return view('livewire.pages.jobs.index', ['jobs' => $this->jobs]);
    }
}
