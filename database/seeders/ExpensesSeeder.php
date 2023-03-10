<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expenses;
use Faker\Factory as Faker;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i<=40; $i++)
        {
            $post = new Expenses;
        $post->daily_expenses = $faker->randomNumber();
        $post->date = $faker->date();
        $post->daily_sale = $faker->randomNumber();
        $post->daily_profit = $faker->randomNumber();
        $post->save();

        }

    }
}
