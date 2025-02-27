<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP'); // 日本語設定

        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        for ($i = 0; $i < 1; $i++) { // 50件のダミーデータを作成
            DB::table('contacts')->insert([
                'first_name' => $faker->firstName, // 日本の名前
                'last_name' => $faker->lastName,
                'category_id' => $faker->randomElement($categoryIds),
                'gender' => $faker->randomElement([1, 2, 3]), // 1: 男性, 2: 女性, 3: その他
                'email' => $faker->unique()->safeEmail,
                'tel' => $faker->phoneNumber,
                'address' => $faker->address,
                'building' => $faker->secondaryAddress,
                'detail' => $faker->realText(50), // 50文字程度のテキスト
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
