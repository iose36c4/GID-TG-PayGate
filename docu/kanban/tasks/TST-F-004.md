---
tags:
  - kanban/todo
  - type/task
  - domain/TST-F
  - priority/P0
parent: "[[desarrollo]]"
children: []
depends_on:
  - "[[TST-F-003]]"
  - "[[FUN-004]]"
  - "[[FUN-005]]"
blocks:
  - "[[TST-F-006]]"
status: todo
assignee: "@dev"
created: 2026-08-04
updated: 2026-08-04
---

# [[TST-F-004]] Feature Tests: Roles + Middleware Subdominio (Matrix 4 Roles × 4 Dominios)

## Descripción
Tests de funcionalidad para roles y middleware de subdominio: matrix completa 4 roles × 4 subdominios.

## Código de Ejemplo
```php
// tests/Feature/Auth/RoleMiddlewareTest.php
uses()->group('feature', 'roles', 'middleware');

uses()->group('middleware');

test('public domain accessible without auth', function () {
    $response = $this->get('https://public.tgp.test/');
    $response->assertStatus(200);
});

test('creadores domain requires auth + creador role', function () {
    $creador = User::factory()->creador()->create();
    $staff = User::factory()->staff()->create();
    $user = User::factory()->create();
    
    $this->actingAs($creador)
         ->get('https://creadores.tgp.test/')
         ->assertStatus(200);
    
    $this->actingAs($staff)
         ->get('https://creadores.tgp.test/')
         ->assertStatus(403);
    
    $this->actingAs($user)
         ->get('https://creadores.tgp.test/')
         ->assertStatus(403);
    
    $this->get('https://creadores.tgp.test/')
         ->assertStatus(302)
         ->assertRedirect(route('login'));
});

test('crm domain requires auth + staff role', function () {
    $staff = User::factory()->staff()->create();
    $admin = User::factory()->admin()->create();
    $creador = User::factory()->creador()->create();
    
    $this->actingAs($staff)
         ->get('https://crm.tgp.test/')
         ->assertStatus(200);
    
    $this->actingAs($admin)
         ->get('https://crm.tgp.test/')
         ->assertStatus(200);
    
    $this->actingAs($creador)
         ->get('https://crm.tgp.test/')
         ->assertStatus(403);
});

test('admin domain requires auth + admin role', function () {
    $admin = User::factory()->admin()->create();
    $staff = User::factory()->staff()->create();
    
    $this->actingAs($admin)
         ->get('https://admin.tgp.test/')
         ->assertStatus(200);
    
    $this->actingAs($staff)
         ->get('https://admin.tgp.test/')
         ->assertStatus(403);
});
```

```php
// tests/Feature/Middleware/SubdomainMiddlewareTest.php
uses()->group('feature', 'middleware');

test('EnsureCorrectSubdomain redirects creador to creadores domain', function () {
    $creador = User::factory()->creador()->create();
    
    $response = $this->actingAs($creador)
         ->get('https://admin.tgp.test/');
    
    $response->assertRedirect('https://creadores.tgp.test/');
});

test('EnsureCorrectSubdomain redirects staff to crm domain', function () {
    $staff = User::factory()->staff()->create();
    
    $response = $this->actingAs($staff)
         ->get('https://creadores.tgp.test/');
    
    $response->assertRedirect('https://crm.tgp.test/');
});

test('EnsureCorrectSubdomain allows admin to access admin domain', function () {
    $admin = User::factory()->admin()->create();
    
    $response = $this->actingAs($admin)
         ->get('https://admin.tgp.test/');
    
    $response->assertStatus(200);
});

test('public domain accessible to all', function () {
    $user = User::factory()->create();
    $creador = User::factory()->creador()->create();
    
    $this->get('https://public.tgp.test/')
         ->assertStatus(200);
    
    $this->actingAs($creador)
         ->get('https://public.tgp.test/')
         ->assertStatus(200);
});

test('unauthenticated user redirected to login on protected domains', function () {
    $domains = ['creadores.tgp.test', 'crm.tgp.test', 'admin.tgp.test'];
    
    foreach ($domains as $domain) {
        $response = $this->get("https://{$domain}/");
        $response->assertStatus(302)
                ->assertRedirect(route('login'));
    }
});
```

```php
// tests/Feature/Middleware/RoleMiddlewareTest.php
uses()->group('feature', 'middleware');

test('role middleware allows correct role', function () {
    $creador = User::factory()->creador()->create();
    
    $response = $this->actingAs($creador)
         ->get('https://creadores.tgp.test/dashboard');
    
    $response->assertStatus(200);
});

test('role middleware blocks wrong role', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
         ->get('https://creadores.tgp.test/');
    
    $response->assertStatus(403);
});

test('role middleware with multiple allowed roles', function () {
    $admin = User::factory()->admin()->create();
    $staff = User::factory()->staff()->create();
    
    // admin can access staff routes (hierarchy)
    $response = $this->actingAs($admin)
         ->get('https://crm.tgp.test/');
    
    $response->assertStatus(200);
});
```

```php
// tests/Unit/Middleware/EnsureCorrectSubdomainTest.php
uses()->group('unit', 'middleware');

test('EnsureCorrectSubdomain returns 403 for wrong domain', function () {
    $middleware = new \App\Http\Middleware\EnsureCorrectSubdomain();
    
    $request = Request::create('https://admin.tgp.test/', 'GET');
    $request->setUserResolver(fn() => User::factory()->creador()->create());
    
    $response = $middleware->handle($request, fn($req) => response('OK'));
    
    expect($response->getStatusCode())->toBe(302);
    expect($response->headers->get('Location'))->toContain('creadores.tgp.test');
});

test('EnsureCorrectSubdomain allows correct domain', function () {
    $middleware = new \App\Http\Middleware\EnsureCorrectSubdomain();
    
    $request = Request::create('https://creadores.tgp.test/', 'GET');
    $request->setUserResolver(fn() => User::factory()->creador()->create());
    
    $response = $middleware->handle($request, fn($req) => response('OK'));
    
    expect($response->getStatusCode())->toBe(200);
});
```

## Diagramas Mermaid
```mermaid
graph TD
    A[Middleware Tests] --> B[Subdomain Matrix 4x4]
    A --> C[Role Middleware]
    
    B --> B1[public: all roles]
    B --> B2[creadores: creador only]
    B --> B3[crm: staff+admin]
    B --> B4[admin: admin only]
    
    B[Matrix] --> B1[user(anon) -> public ok, others 302->login]
    B --> B2[user(role=user) -> public ok, others 403]
    B --> B3[creador -> creadores ok, others 403]
    B --> B3[staff -> crm ok, others 403]
    B --> B4[admin -> admin ok, crm ok, others 403]
    
    C[Role Middleware] --> C1[role:creador -> creadores ok]
    C --> C2[role:staff -> crm ok]
    C --> C3[role:admin -> admin,crm ok]
    C --> C4[wrong role -> 403]
```

## Criterios de Aceptación
- [ ] Matrix 4x4: 4 roles (user, creador, staff, admin) × 4 dominios (public, creadores, crm, admin)
- [ ] Public: accesible a todos (incluye anonimos)
- [ ] Creadores: solo role=creador (403 otros)
- [ ] CRM: solo role=staff,admin (403 otros)
- [ ] Admin: solo role=admin (403 otros)
- [ ] No auth: public ok, otros -> 302 login
- [ ] Middleware EnsureCorrectSubdomain: redirect a dominio correcto
- [ ] Role middleware: permite/deniega según rol
- [ ] Tests cubren matrix completa 4x4 = 16 combinaciones

## Notas Técnicas
- Configurar `APP_DOMAIN` en testing: `tgp.test`
- Subdominios en testing: usar `Http::fake()` o configurar `app.url`
- `Route::domain()` en RouteServiceProvider
- Middleware order: `EnsureCorrectSubdomain` antes que `role:`
- `Route::domain()` parsing para extraer subdominio

## Enlaces
- [[TST-F-003]] Feature tests Auth
- [[TST-F-005]] Feature tests Public
- [[FUN-004]] Middleware EnsureCorrectSubdomain