<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->command->info('Таблица с правами загружена данными!');

        $this->call(RoleSeeder::class);
        $this->command->info('Таблица с ролями загружена данными!');

        // $this->call(UserTableSeeder::class);
        // $this->command->info('Таблица пользователей загружена данными!');


        // $this->call(CategoriesSeeder::class);
        // $this->command->info('Таблица с категориями загружена данными!');

        // $this->call(ProductSeeder::class);
        // $this->command->info('Таблица товаров загружена данными!');

        // $this->call(PostTableSeeder::class);
        // $this->command->info('Таблица с постами загружена данными!');


        $this->call(CreateAdminUserSeeder::class);
        $this->command->info('Администратор создан!');

        $this->call(TestUser::class);
        $this->command->info('Тестовый пользователь создан!');


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
