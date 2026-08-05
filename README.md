# 🚀 GID-TG-PayGate: Plataforma de Gestión de Contenido de Pago vía Telegram

GID-TG-PayGate es una aplicación web SaaS robusta y segura construida con **Laravel** que permite a los creadores de contenido automatizar la venta de accesos a sus canales y grupos privados de Telegram. La plataforma gestiona de forma automática los registros, la verificación de pagos, el envío de invitaciones de un solo uso y la expulsión de miembros cuando su suscripción expira.

---

## 🎯 Características Principales

*   **Gestión Automatizada de Accesos**: Creación de enlaces de invitación únicos y temporales mediante la API de Telegram.
*   **Seguridad de Nivel Empresarial**: Cifrado nativo de tokens de bots mediante AES-256 en la base de datos.
*   **Limpieza de Expirados**: Sistema automatizado mediante *Laravel Scheduler* para revocar accesos a usuarios con suscripciones vencidas.
*   **Panel para Creadores**: Interfaz intuitiva para que los creadores vinculen sus canales, configuren precios y gestionen sus ganancias de forma segura.
*   **Módulo de Captación Email**: Registro obligatorio de correos electrónicos para campañas de remarketing, contención de valor y ofertas personalizadas.
*   **Optimización SEO Avanzada**: Renderizado del lado del servidor (SSR) con Blade, metatags dinámicos y generación automatizada de Sitemaps para indexación masiva en Google.

---

## 🛠️ Stack Tecnológico

*   **Backend**: PHP 8.2+ / Laravel 11+
*   **Base de Datos**: MySQL 8.0+
*   **Frontend (SSR)**: HTML5, CSS3 (Tailwind CSS), JavaScript (Vanilla / Alpine.js)
*   **Cola de Tareas & Tareas Programadas**: Redis / Laravel Queues & Cron Jobs
*   **Seguridad**: Laravel Eloquent Encryption (AES-256-CBC)

---

## 🔒 Arquitectura de Seguridad y Datos Sensibles

### 1. Cifrado de Tokens de Telegram
Los tokens de acceso de los bots de los creadores se almacenan completamente cifrados en la base de datos utilizando las claves criptográficas nativas del archivo `.env`. Si la base de datos se ve comprometida, los tokens serán ilegibles.

```php
// Guardado automático y seguro en el modelo CanalPago
protected \$casts = [
    'telegram_bot_token' => 'encrypted',
];
```

### 2. Manejo de Datos Bancarios (PCI-Compliance)
Para garantizar la máxima seguridad y evitar riesgos legales, **no se almacenan números de cuenta completos ni tarjetas de crédito locales**. La aplicación delega la tokenización y la dispersión de fondos a creadores a través de pasarelas seguras conectadas vía API mediante Webhooks firmados.

---

## 🔍 Estrategia de SEO Incorporada

La sección pública de la plataforma (Landing pages, listados de categorías y perfiles de creadores) utiliza un enfoque estricto de **Renderizado del lado del Servidor (SSR)** mediante Laravel Blade.
*   **URLs Amigables**: Uso exclusivo de *slugs* limpios (`/canal/finanzas-premium` en lugar de `/canal?id=45`).
*   **Metatags Abiertos (Open Graph)**: Integración automática de imágenes de previsualización, títulos y descripciones optimizadas al compartir los enlaces públicos en redes sociales o en el mismo Telegram.
*   **Sitemap Dinámico**: Un script en segundo plano actualiza diariamente el archivo `sitemap.xml` para notificar de forma inmediata a los motores de búsqueda sobre nuevos canales de pago disponibles.

---

## 📋 Kanban Board

- [Ver tablero Kanban completo](docu/kanban/todo.md) - Planificación detallada con todas las tareas organizadas por épicas, hitos y áreas funcionales.
- [Guía para agentes (AGENTS.md)](AGENTS.md) - Instrucciones técnicas para sesiones de desarrollo.

---

## 🚀 Requisitos de Instalación

Asegúrate de cumplir con los siguientes requisitos en tu servidor de producción o entorno local:

*   PHP >= 8.2 (con extensiones `openssl`, `pdo_mysql`, `mbstring`, `curl`)
*   Composer 2.x
*   Servidor Web (Nginx o Apache) con certificado **HTTPS válido** (Requisito obligatorio para los Webhooks de Telegram y Pasarelas de Pago).

### Pasos para Configurar en Local

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com
   cd tg-paygate
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar el entorno:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar la base de datos en el archivo `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tg_paygate
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

5. **Ejecutar las migraciones:**
   ```bash
   php artisan migrate
   ```

6. **Compilar recursos de Frontend:**
   ```bash
   npm install
   npm run dev
   ```

---

## ⚙️ Automatización (Cron Jobs)

Para que el sistema verifique las suscripciones vencidas y ejecute las expulsiones de usuarios de forma autónoma, debes añadir la siguiente entrada al Crontab de tu servidor:

```bash
* * * * * cd /ruta-de-tu-proyecto && php artisan schedule:run >> /dev/null 2>&1
```

Esto activará la tarea programada encargada de auditar la base de datos cada hora y realizar las llamadas HTTP pertinentes al método `banChatMember` de la API de Telegram.

---

## 📬 Contacto y Soporte

Si encuentras algún fallo de seguridad o deseas proponer una mejora en la arquitectura, por favor abre un *Issue* en el repositorio o contacta directamente al equipo técnico a través de: `soporte@tusitio.com`.

