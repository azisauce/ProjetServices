<?php

use App\Project;
use App\ProjectBox;
use App\ProjectRequirement;
use App\ProjectSkill;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $lecturers = User::where('role', 'Lecturer')->get();
        $lecturers_id = $lecturers->pluck('id')->toArray();

        $projectName = [
            '', '',
            'StoryDay',
            'Hala Maak',
            'Toujours',
            'WhatUpz',
            'Random Project Name',
            'Freemium',
            'K-Pay',
            'SahaBeach',
            'Random Project Name',
            'SicamClean',
            'Dhawili',
        ];

        $projectsDummy = [
            [], [], [], [], [], [], [], [], [], [], [], [], [],
            [
                'title' => 'CleanMe',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'TestwithMe',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Testonemoretime',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Karhabti',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Dari',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Biti',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Aweni',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'IjaLena',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Bonjour24',
                'description' => 'ALorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => '+2Ici',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'FamaMenou',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
            [
                'title' => 'Photocopie',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ],
        ];


        $applicant_type = [
            'Individual & Team',
            'Individual',
            'Team'
        ];

        $skills = [
            'Friendly', 'Skilled', 'Rapid', 'Amical', 'Cheap','Popular'
        ];

        $requirements = [
            'You need to be present the day we come to see your need',
            'Pay is always before',
            'Some privacy is needed sometimes',
            'A big company have some responsiblity sometimes',
            'No need to worry if you are not with us',
            'Eager to be amical'
        ];

        $salary = [
            '150', '250', '450', '725', '120', '0'
        ];

        // $min_points = [
        //     '1000', '500', '5000', '2000', '2500', '10000', '7000'
        // ];

        $level_applicant = [
            'Easy',
            'Medium',
            'Hard',
            'Expert'
        ];

        $payment_type = [
            'person',
            'project'
        ];

        /////////////////////////////////////////////////////////////////////////////////
        // For Mr. Covey
        $randSalary = $salary[array_rand($salary)];
        if ($randSalary === '0') {
            $certificate = 1;
            $has_salary = false;
        } else {
            $certificate = $faker->boolean;
            $has_salary = true;
        }
        $salary_amount = $randSalary;

        $projects = [];
        $projectBoxes = [];
        $projectSkills = [];
        $projectRequirements = [];

        $project_title = 'PlombierAriena';
        $projects[] = [
            'user_id' => 2,
            'title' => $project_title,
            'description' => $faker->text,
            'salary' => $has_salary,
            'currency' => 'IDR',
            'salary_amount' => $salary_amount,
            'payment_type' => $payment_type[array_rand($payment_type)],
            'certificate' => $certificate,
            'ui_ux_designer' => true,
            'front_end_engineer' => $faker->boolean,
            'back_end_engineer' => $faker->boolean,
            'data_expert' => $faker->boolean,
            'max_person' => $faker->numberBetween($min = 1, $max = 9),
            'thumbnail' => null,
            'applicant_type' => 'Individual & Team',
            'level_applicant' => $level_applicant[0],
            'project_url' => implode('-', explode(' ', strtolower($project_title))) . '-' . $faker->regexify('[a-z0-9]{8}'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $projectBoxes[] = [
            'project_id' => 1,
            'user_id' => 2,
            'status' => 'Hiring',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        shuffle($skills);
        shuffle($requirements);

        for ($j = 0; $j < 6; $j++) {
            $projectSkills[] = [
                'project_id' => 1,
                'name' => $skills[$j],
            ];

            $projectRequirements[] = [
                'project_id' => 1,
                'requirement' => $requirements[$j],
            ];
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////

        for ($i = 2; $i <= 24; $i++) {
            $randSalary = $salary[array_rand($salary)];
            if ($randSalary === '0') {
                $certificate = 1;
                $has_salary = false;
            } else {
                $certificate = $faker->boolean;
                $has_salary = true;
            }
            $salary_amount = $randSalary;
            $month = $faker->numberBetween($min = 8, $max = 9);
            $day = $faker->numberBetween($min = 1, $max = 24);

            $lecturer_id = $lecturers_id[array_rand($lecturers_id)];

            $projectTitle = $i <= 12 ? $projectName[$i] : $projectsDummy[$i]['title'];
            $projectUrl = str_replace('/', '-', $projectTitle);
            $projects[] = [
                'user_id' => $lecturer_id,
                'title' => $projectTitle,
                'description' => $i <= 12 ? $faker->text : $projectsDummy[$i]['description'],
                'salary' => $has_salary,
                'currency' => 'IDR',
                'salary_amount' => $salary_amount,
                'payment_type' => $payment_type[array_rand($payment_type)],
                'certificate' => $certificate,
                'ui_ux_designer' => true,
                'front_end_engineer' => $faker->boolean,
                'back_end_engineer' => $faker->boolean,
                'data_expert' => $faker->boolean,
                'max_person' => $faker->numberBetween($min = 1, $max = 9),
                'thumbnail' => null,
                'applicant_type' => $applicant_type[array_rand($applicant_type)],
                'level_applicant' => $level_applicant[array_rand($level_applicant)],
                'project_url' => implode('-', explode(' ', strtolower($projectUrl))) . '-' . $faker->regexify('[a-z0-9]{8}'),
                'created_at' => Carbon::createFromDate(2020, $month, $day, 'Africa/Tunis'),
                'updated_at' => Carbon::createFromDate(2020, $month, $day, 'Africa/Tunis'),
            ];

            $projectBoxes[] = [
                'project_id' => $i,
                'user_id' => $lecturer_id,
                'status' => 'Hiring',
                'created_at' => Carbon::createFromDate(2020, $month, $day, 'Africa/Tunis'),
                'updated_at' => Carbon::createFromDate(2020, $month, $day, 'Africa/Tunis'),
            ];

            shuffle($skills);
            shuffle($requirements);

            for ($j = 0; $j < 6; $j++) {
                $projectSkills[] = [
                    'project_id' => $i,
                    'name' => $skills[$j],
                ];

                $projectRequirements[] = [
                    'project_id' => $i,
                    'requirement' => $requirements[$j],
                ];
            }
        }

        Project::insert($projects);
        ProjectBox::insert($projectBoxes);
        ProjectSkill::insert($projectSkills);
        ProjectRequirement::insert($projectRequirements);
    }
}
