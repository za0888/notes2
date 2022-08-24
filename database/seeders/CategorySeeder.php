<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $themes=['soft','house','hobby'];

        $themes = [

            'SOFT' => [
                'laravel' => ['test', 'eloquent', 'howto'],
                'js' => ['array', 'functions', 'DOM'],
                'php' => ['array', 'functions',]
            ],

            'HOUSE' => [
                'electrica' => ['switch', 'tools', 'lights'],

                'pets' => ['food', 'useful inf'],

                'kitchen' => ['recepies', 'gadgets']
            ],

            'DACHIA' => [
                'plants' => [
                    'apple',
                    'grape',
                    'chery'
                ],

                'house' => ['maintenance'],
            ],

            'HOBBY' => [

                'languages' => [
                    'spanis',
                    'english',
                    'german',
                    'franch'
                ],

                'maintenance' => [
                    'electronic',
                    'paperwals'
                ]
            ],

            'Media' => [
                'news' => [
                    'usa',
                    'europe',
                    'war',
                    'arts',
                    'people',
                    'science'
                ],
                'sciense' => [
                    'astronomy',
                    'chemistry'
                ]
            ]
        ];

    }
}
