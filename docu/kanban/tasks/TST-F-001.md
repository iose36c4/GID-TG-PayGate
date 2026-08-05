---
tags:
  - kanban/todo
  - type/task
  - domain/TST-F
  - priority/P0
parent: "[[desarrollo]]"
children: []
depends_on:
  - "[[FUN-009]]"
blocks:
  - "[[TST-F-002]]"
  - "[[TST-F-003]]"
status: todo
assignee: "@dev"
created: 2026-08-04
updated: 2026-08-04
---

# [[TST-F-001]] Config Pest + Pest Plugin Laravel + Parallel Testing

## Descripción
Configurar Pest PHP como framework de testing principal con Pest Plugin Laravel y testing paralelo para máxima velocidad.

## Código de Ejemplo
```bash
# Instalación
composer require pestphp/pest pestphp/pest-plugin-laravel --dev
./vendor/bin/pest --init
```

```php
// tests/Pest.php
use Pest\Laravel\Pest;

uses()->group('feature')->in('Feature');
uses()->group('unit')->in('Unit');
uses()->group('browser')->in('Browser');

// Configuración global
beforeEach(function () {
    $this->artisan('migrate:fresh --seed');
    $this->withoutExceptionHandling();
});

// Helpers globales
function actingAsAdmin(User $user = null): User {
    $user = $user ?? User::factory()->create(['role' => 'admin']);
    return auth()->login($user);
}

function actingAsCreador(User $user = null): User {
    $user = $user ?? User::factory()->create(['role' => 'creador']);
    return auth()->login($user);
}

function actingAsCliente(User $user = null): User {
    $user = $user ?? User::factory()->create(['role' => 'user']);
    return auth()->login($user);
}
```

```php
// phpunit.xml - Configuración paralelismo
<phpunit>
    <testsuites>
        <testsuite name="Unit">
            <directory>./tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>./tests/Feature</directory>
        </testsuite>
        <testsuite name="Browser">
            <directory>./tests/Browser</directory>
        </testsuite>
    </testsuites>
    
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
    </php>
    
    <!-- Paralelismo -->
    <parallel>
        <processes>4</processes>
    </parallel>
</phpunit>
```

```php
// tests/Feature/ExampleTest.php
uses()->group('feature');

test('home page loads', function () {
    $this->get('/')
         ->assertStatus(200)
         ->assertSee('TG-PayGate');
})->group('smoke');

test('user can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'timezone' => 'America/Argentina/Buenos_Aires',
    ]);
    
    $response->assertRedirect(route('verification.notice'));
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});
```

## Diagramas Mermaid
```mermaid
graph TD
    A[Pest Config] --> B[PestPlugin Laravel]
    A --> B[Parallel Testing]
    A --> C[Test Suites]
    A --> C[Global Helpers]
    
    B --> B1[RefreshDatabase trait]
    B --> B1[Laravel helpers]
    
    C --> C1[Unit: tests/Unit]
    C --> C2[Feature: tests/Feature]
    C --> C3[Browser: tests/Browser]
    
    D[Global Helpers] --> D1[actingAsAdmin()]
    C --> D2[actingAsCreador()]
    C --> D3[actingAsCliente()]
    
    E[Parallel] --> E1[processes: 4]
    E --> E2[sqlite :memory:]
```

## Criterios de Aceptación
- [ ] Pest instalado con `pestphp/pest` y `pestphp/pest-plugin-laravel`
- [ ] `php artisan test` ejecuta tests correctamente
- [ ] Paralelismo configurado: 4 procesos (configurable via `--parallel --processes=N`)
- [ ] Base de datos SQLite en memoria para tests
- [ ] Helpers globales: `actingAsAdmin()`, `actingAsCreador()`, `actingAsCliente()`
- [ ] Suites configuradas: Unit, Feature, Browser
- [ ] Groups: `smoke`, `feature`, `unit`, `browser`
- [ ] Coverage: `--coverage` genera reporte HTML
- [ ] `pest --parallel --processes=4` ejecuta en paralelo

## Notas Técnicas
- SQLite en memoria para velocidad máxima
- `RefreshDatabase` trait en tests que usan BD
- `RefreshDatabase` vs `DatabaseTransactions` según necesidad
- Paralelismo: `--parallel --processes=4` (ajustable según CPU)
- `pest --coverage --min=80` para enforcer coverage mínimo
- `pest --filter=smoke` para smoke tests rápidos

## Enlaces
- [[TST-F-002]] Unit tests
- [[TST-F-003]] Feature tests Auth
- [[TST-F-014]] CI Pipeline