<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $categories = [
            ['name' => 'Finanzas', 'slug' => 'finanzas', 'description' => 'Mercados, inversiones y economía', 'color' => '#0284c7', 'sort_order' => 1],
            ['name' => 'Trading', 'slug' => 'trading', 'description' => 'Trading, cripto y análisis técnico', 'color' => '#c026d3', 'sort_order' => 2],
            ['name' => 'Educación', 'slug' => 'educacion', 'description' => 'Cursos, tutoriales y aprendizaje', 'color' => '#059669', 'sort_order' => 3],
            ['name' => 'Entretenimiento', 'slug' => 'entretenimiento', 'description' => 'Noticias, chismes y humor', 'color' => '#d97706', 'sort_order' => 4],
            ['name' => 'Tecnología', 'slug' => 'tecnologia', 'description' => 'IA, software y gadgets', 'color' => '#7c3aed', 'sort_order' => 5],
            ['name' => 'Estilo de Vida', 'slug' => 'estilo-de-vida', 'description' => 'Fitness, viajes y bienestar', 'color' => '#e11d48', 'sort_order' => 6],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        User::factory()->withRole('admin')->create([
            'name' => 'Admin TG-PayGate',
            'email' => 'admin@tg-paygate.com',
        ]);

        User::factory()->withRole('staff')->create([
            'name' => 'Staff TG-PayGate',
            'email' => 'staff@tg-paygate.com',
        ]);

        User::factory()->withRole('creador')->create([
            'name' => 'Creador Demo',
            'email' => 'creador@tg-paygate.com',
        ]);

        User::factory()->create([
            'name' => 'Comprador Demo',
            'email' => 'comprador@tg-paygate.com',
        ]);
    }
}
