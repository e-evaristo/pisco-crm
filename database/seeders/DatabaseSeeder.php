<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\DocumentType;
use App\Models\Product;
use App\Models\Category;
use App\Models\TransactionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/logos');
        
        Storage::makeDirectory('public/logos');
        
        $this->call(UserSeeder::class);

        Company::factory(12)->create();

        Employee::factory(20)->create();

        DocumentType::insert([
            ['name' => 'Dinheiro'],
            ['name' => 'Cheque'],
            ['name' => 'Cartão de Crédito'],
            ['name' => 'Cartão de Débito'],
        ]);

        TransactionType::insert([
            ['name' => 'Venda'],
            ['name' => 'Compra']
        ]);

        Category::insert([
            ['name' => 'Categoria 001', 'slug' => 'categoria-001', 'description' => '', 'is_visible' => true],
            ['name' => 'Categoria 002', 'slug' => 'categoria-002', 'description' => '', 'is_visible' => true],
            ['name' => 'Categoria 003', 'slug' => 'categoria-003', 'description' => '', 'is_visible' => true],
            ['name' => 'Categoria 004', 'slug' => 'categoria-004', 'description' => '', 'is_visible' => true],
        ]);

        Product::factory(60)->create();
    }
}
