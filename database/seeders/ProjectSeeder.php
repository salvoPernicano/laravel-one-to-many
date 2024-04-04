<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();

            $project->nome_progetto = $faker->sentence(3);
            $project->slug = Str::slug($project->nome_progetto, '-');
            $project->descrizione_progetto = $faker->text(300);
            $project->linguaggi = implode(', ', $faker->randomElements(['PHP', 'JavaScript', 'Python', 'Java', 'C#'], rand(3, 4)));
           

            $project->save();
        }
    }
}
