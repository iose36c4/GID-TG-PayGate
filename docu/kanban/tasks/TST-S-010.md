---
tags:
  - kanban/todo
  - type/task
  - domain/TST-S
  - priority/P1
parent: "[[desarrollo]]"
children: []
depends_on:
  - "[[TST-S-008]]"
blocks: []
status: todo
assignee: "@dev"
created: 2026-08-04
updated: 2026-08-04
---

# [[TST-S-010]] Headers: CSP, HSTS, X-Frame-Options, Referrer-Policy, Permissions-Policy

## Descripción
Tests de headers de seguridad HTTP: CSP, HSTS, X-Frame-Options, Referrer-Policy, Permissions-Policy.

## Código de Ejemplo
```php
// tests/Feature/Security/HeadersTest.php
uses()->group('security', 'headers');

test('CSP header configured correctly', function () {
    $response = $this->get('/');
    
    $csp = $response->headers->get('Content-Security-Policy');
    expect($csp)->toContain("default-src 'self'");
    expect($csp)->toContain("script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net");
    expect($csp)->toContain("style-src 'self' 'unsafe-inline' https://fonts.googleapis.com");
    expect($csp)->toContain("font-src 'self' https://fonts.gstatic.com");
    expect($csp)->toContain("img-src 'self' data: https:");
    expect($csp)->toContain("connect-src 'self' https://api.mercadopago.com https://api.stripe.com");
    expect($csp)->toContain("frame-ancestors 'none'");
    expect($csp)->toContain("base-uri 'self'");
    expect($csp)->toContain("form-action 'self'");
});

test('HSTS header present in production', function () {
    config(['app.env' => 'production']);
    
    $response = $this->get('/');
    
    $hsts = $response->headers->get('Strict-Transport-Security');
    expect($hsts)->toContain('max-age=31536000');
    expect($hsts)->toContain('includeSubDomains');
    expect($hsts)->toContain('preload');
});

test('X-Frame-Options header set to DENY', function () {
    $response = $this->get('/');
    
    $xfo = $response->headers->get('X-Frame-Options');
    expect($xfo)->toBe('DENY');
});

test('Referrer-Policy set to strict-origin-when-cross-origin', function () {
    $response = $this->get('/');
    
    $referrerPolicy = $response->headers->get('Referrer-Policy');
    expect($referrerPolicy)->toBe('strict-origin-when-cross-origin');
});

test('Permissions-Policy configured', function () {
    $response = $this->get('/');
    
    $permissionsPolicy = $response->headers->get('Permissions-Policy');
    expect($permissionsPolicy)->toContain('geolocation=()');
    expect($permissionsPolicy)->toContain('camera=()');
    expect($permissionsPolicy)->toContain('microphone=()');
    expect($permissionsPolicy)->toContain('payment=(self)');
    expect($permissionsPolicy)->toContain('fullscreen=(self)');
});

test('X-Content-Type-Options header set to nosniff', function () {
    $response = $this->get('/');
    
    $xcto = $response->headers->get('X-Content-Type-Options');
    expect($xcto)->toBe('nosniff');
});

test('X-XSS-Protection header (legacy but present)', function () {
    $response = $this->get('/');
    
    $xxss = $response->headers->get('X-XSS-Protection');
    expect($xxss)->toBe('1; mode=block');
});

test('Cache-Control headers for sensitive pages', function () {
    $response = $this->actingAs($user)->get(route('client.dashboard'));
    
    $cacheControl = $response->headers->get('Cache-Control');
    expect($cacheControl)->toContain('no-store');
    expect($response->headers->get('Pragma'))->toBe('no-cache');
    expect($response->headers->get('Expires'))->toBe('0');
});

test('Security headers absent in development', function () {
    config(['app.env' => 'local']);
    
    $response = $this->get('/');
    
    // HSTS should not be present in local
    $hsts = $response->headers->get('Strict-Transport-Security');
    expect($hsts)->toBeNull();
    
    // CSP can be in report-only mode
    $csp = $response->headers->get('Content-Security-Policy');
    expect($csp)->toContain('report-only');
});
```

## Diagramas Mermaid
```mermaid
graph TD
    A[Security Headers] --> B[CSP]
    A --> B[HSTS]
    A --> C[X-Frame-Options]
    A --> C[Referrer-Policy]
    A --> D[Permissions-Policy]
    A --> E[X-Content-Type-Options]
    A --> B[X-XSS-Protection]
    A --> C[Cache-Control]
    
    B[CSP] --> B1[default-src 'self']
    B --> B2[script-src: self + cdn]
    B --> B3[style-src: self + fonts.googleapis.com]
    B --> B4[font-src: self + fonts.gstatic.com]
    B --> B4[img-src: self data: https:]
    B --> B4[connect-src: self + APIs]
    B --> B5[frame-ancestors: none]
    B --> B5[base-uri: self]
    B --> B5[form-action: self]
    
    B[HSTS] --> B1[max-age=31536000]
    B --> B2[includeSubDomains]
    B --> B3[preload]
    
    C[X-Frame-Options] --> C1[DENY]
    
    D[Referrer-Policy] --> D1[strict-origin-when-cross-origin]
    
    E[Permissions-Policy] --> E1[geolocation=()]
    E --> E2[camera=(), microphone=()]
    E --> E3[payment=(self)]
    E --> E4[fullscreen=(self)]
    
    E[X-Content-Type-Options] --> E1[nosniff]
    
    F[X-XSS-Protection] --> F1[1; mode=block]
    
    G[Cache-Control] --> G1[no-store, no-cache, must-revalidate]
    B --> B2[private pages: no-store]
```

## Criterios de Aceptación
- [ ] CSP: default-src 'self', script-src con CDN, style-src con fonts.googleapis.com, font-src con fonts.gstatic.com, img-src con data: y https:, connect-src con APIs, frame-ancestors none, base-uri self, form-action self
- [ ] HSTS: max-age=31536000, includeSubDomains, preload (solo production)
- [ ] X-Frame-Options: DENY
- [ ] Referrer-Policy: strict-origin-when-cross-origin
- [ ] Permissions-Policy: geolocation=(), camera=(), microphone=(), payment=(self), fullscreen=(self)
- [ ] X-Content-Type-Options: nosniff
- [ ] X-XSS-Protection: 1; mode=block (legacy)
- [ ] Cache-Control: no-store, no-cache, must-revalidate, private en páginas sensibles
- [ ] HSTS solo en production (no local/staging)
- [ ] CSP report-only mode en desarrollo

## Notas Técnicas
- CSP: usar nonces para inline scripts si necesarios
- CSP report-only mode en development
- HSTS: max-age=31536000 (1 año), includeSubDomains, preload
- CSP: nonces para inline scripts críticos
- Permissions-Policy: anteriormente Feature-Policy
- Cache-Control: no-store, no-cache, must-revalidate, private para páginas autenticadas
- X-Content-Type-Options: nosniff previene MIME sniffing
- X-XSS-Protection: legacy pero útil para navegadores antiguos

## Enlaces
- [[TST-S-007]] API Security
- [[TST-S-008]] File Upload
- [[TST-S-009]] Encryption
- [[TST-S-011]] Logging