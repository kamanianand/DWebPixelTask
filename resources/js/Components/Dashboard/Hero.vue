<script setup lang="ts"></script>

<template>
    <div class="bg-slate-100 relative">
        <div class="container py-32 text-center flex flex-col gap-8 relative">
            <div class="space-y-4">
                <h1 class="text-3xl lg:text-6xl font-bold">Find your dream job</h1>
                <p class="text-sm lg:text-base text-slate-600">Looking for jobs? Browse our latest job openings to
                    view & apply to
                    the best jobs today!</p>
            </div>
            <!-- Search -->
            <div>
                <div
                    class="bg-white w-full border rounded-full overflow-hidden border-gray-200 max-w-3xl mx-auto flex items-center justify-center">
                    <div class="flex-1 flex items-center border-r">
                        <span class="pl-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </span>
                        <input placeholder="Job title or keyword"
                            class="py-4 shadow-none border-none focus:outline-none focus:ring-0 outline-none ring-0"
                            type="text" v-model="form_data.title">
                    </div>
                    <div class="flex-1 flex items-center">
                        <span class="pl-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </span>
                        <input placeholder="Location"
                            class="py-4 shadow-none border-none focus:outline-none focus:ring-0 outline-none ring-0"
                            type="text" v-model="form_data.location" >
                    </div>
                    <button class="bg-brand px-6 text-sm font-medium py-2 rounded-full text-white mr-3" v-on:click="find_jobs()">Find
                        jobs</button>
                </div>
            </div>
            
        </div>
    </div>

    <div class="job-listings">
        <div class="job-card" v-for="(job, i) in jobs" :key="job.id">
        <div class="job-header">
            <img :src="getImagePath(job.full_image_path)" :alt="'Image ' + i" />
            <h3>{{ job.title }}</h3>
            <p>{{ job.company_name }}</p>
            <p>{{ job.extra_info }}</p>
        </div>
        <div class="job-details">
            <p><strong>Experience:</strong> {{ job.experience }}</p>
            <p><strong>Salary:</strong> {{ job.salary }}</p>
            <p><strong>Location:</strong> {{ job.location }}</p>
        </div>
        <div class="job-description">
            <p>{{ job.description }}</p>
        </div>
        <div class="job-skills">
            <li v-for="skill in job.skills" :key="skill.id">{{ skill.name }}</li>
        </div>
        <p class="timestamp">{{ calculateTimeAgo(job.created_at) }}</p>
        </div>
    </div>
    
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
        form_data:{
            title:"",
            location:"",
        },
      jobs: [],
    };
  },
    mounted(){
        this.get_jobs();
    },
    methods:{
        async get_jobs()
        {
            await axios.get("api/jobs")
            .then((res) => {
                this.jobs = res.data;
            })
            .catch((error) => {
                console.error(error);
            });
        },
        async find_jobs(){
            await axios.post("api/searchjobs",this.form_data)
            .then((res) => {
                this.jobs = res.data;
            })
            .catch((error) => {
                console.error(error);
            });
        },
        calculateTimeAgo(timestamp) {
            const entryDate = new Date(timestamp);
            const currentDate = new Date();
            const differenceInMilliseconds = currentDate - entryDate;
            const differenceInHours = Math.floor(differenceInMilliseconds / (1000 * 60 * 60));

            if (differenceInHours < 1) {
                const differenceInMinutes = Math.floor(differenceInMilliseconds / (1000 * 60));
                return `${differenceInMinutes} minute(s) ago`;
            }

            return `${differenceInHours} hour(s) ago`;
        },
        getImagePath(image) {
            return image;
        },
        
    }
};

</script>

<style>
body {
  font-family: Arial, sans-serif;
  background-color: transparent;
  margin: 0;
  padding: 20px;
}

.job-listings {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.job-card {
  border: 1px solid #ddd;
  padding: 20px;
  width: 49%;
}

.job-header img {
 height: 60px;
}

.job-header h3 {
  margin: 0;
  font-size: 18px;
  color: #333;
}

.job-header p {
  margin: 4px 0 12px;
  font-size: 14px;
  color: #666;
}

.job-details p {
  margin: 6px 0;
  font-size: 14px;
  color: #333;
}

.job-description {
  margin: 12px 0;
  font-size: 13px;
  color: #555;
}

.job-skills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 12px;
}

.job-skills span {
  background-color: #eaf4ff;
  color: #007bff;
  padding: 6px 10px;
  font-size: 12px;
  border-radius: 4px;
}

.timestamp {
  margin-top: 16px;
  font-size: 12px;
  color: #999;
}

</style>