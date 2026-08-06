<?php

namespace App\Domains\Public\Http\Controllers;

use App\Models\Category;
use App\Models\ChannelPago;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChannelController
{
    public function index(Request $request): View
    {
        $query = ChannelPago::with('category', 'owner')
            ->where('status', 'active')
            ->where('visibility', 'public');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sort = $request->get('sort', 'popular');
        match ($sort) {
            'newest' => $query->latest(),
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating' => $query->orderBy('subscribers_count', 'desc'), // Using subscribers as proxy for rating
            default => $query->orderBy('subscribers_count', 'desc'),
        };

        $channels = $query->paginate(12)->withQueryString();
        $categories = Category::active()->get();

        // Build JSON-LD ItemList for SEO
        $itemList = [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => $channels->map(function ($channel, $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1 + ($channels->currentPage() - 1) * $channels->perPage(),
                    'item' => [
                        '@type' => 'Product',
                        'name' => $channel->name,
                        'description' => $channel->description,
                        'url' => route('channels.show', $channel),
                        'image' => $channel->cover_image ? asset('storage/'.$channel->cover_image) : null,
                        'offers' => [
                            '@type' => 'Offer',
                            'price' => $channel->price,
                            'priceCurrency' => $channel->currency,
                            'availability' => 'https://schema.org/InStock',
                        ],
                    ],
                ];
            })->toArray(),
        ];

        return view('public.channels.index', compact('channels', 'categories', 'itemList'));
    }

    public function show(ChannelPago $channel): View
    {
        if (! $channel->isActive() || $channel->visibility !== 'public') {
            abort(404);
        }

        $channel->load(['category', 'owner']);

        return view('public.channels.show', compact('channel'));
    }

    public function checkout(ChannelPago $channel): View
    {
        if (! $channel->isActive() || $channel->visibility !== 'public') {
            abort(404);
        }

        $channel->load(['category', 'owner']);

        return view('public.checkout', compact('channel'));
    }

    public function landing(): View
    {
        $featuredChannels = ChannelPago::with('category', 'owner')
            ->where('status', 'active')
            ->where('visibility', 'public')
            ->latest()
            ->take(6)
            ->get();

        $features = [
            [
                'icon' => 'shield-check',
                'title' => 'Pagos seguros',
                'description' => 'Integración con MercadoPago, Stripe y PayPal. Tus ingresos protegidos.',
            ],
            [
                'icon' => 'bolt',
                'title' => 'Acceso instantáneo',
                'description' => 'Enlaces de invitación únicos generados automáticamente tras cada pago.',
            ],
            [
                'icon' => 'users',
                'title' => 'Gestión automática',
                'description' => 'Expulsión automática de suscriptores expirados vía API de Telegram.',
            ],
            [
                'icon' => 'chart-bar',
                'title' => 'Analytics en tiempo real',
                'description' => 'Dashboard con MRR, churn, LTV y cohortes de retención.',
            ],
            [
                'icon' => 'currency-dollar',
                'title' => 'Retiros flexibles',
                'description' => 'Configura ciclos de cobro (5 días, 15 días, mensual) y retiros automáticos.',
            ],
            [
                'icon' => 'document-text',
                'title' => 'Facturación legal',
                'description' => 'Facturas A/B/C automáticas con CAE AFIP para Argentina.',
            ],
        ];

        $testimonials = [
            [
                'author' => 'María González',
                'role' => 'Creadora de contenido financiero',
                'content' => 'TG-PayGate me permitió monetizar mi canal de Telegram en días. La automatización de pagos y accesos me ahorra horas cada semana.',
                'avatar' => null,
            ],
            [
                'author' => 'Carlos Rodríguez',
                'role' => 'Experto en marketing digital',
                'content' => 'La mejor plataforma para creadores de habla hispana. Soporte para MercadoPago y facturación AFIP nativa.',
                'avatar' => null,
            ],
            [
                'author' => 'Ana Martínez',
                'role' => 'Community manager',
                'content' => 'Configuré mi canal premium en 10 minutos. Los webhooks funcionan perfecto y la expulsión automática es un salvavidas.',
                'avatar' => null,
            ],
        ];

        $pricingTiers = [
            [
                'name' => 'Starter',
                'price_monthly' => 0,
                'price_yearly' => 0,
                'features' => [
                    'Hasta 1 canal de pago',
                    'Comisión 5% + gateway',
                    'Pagos: MercadoPago, Stripe, PayPal',
                    'Enlaces de invitación únicos',
                    'Expulsión automática',
                    'Dashboard básico',
                    'Soporte por email',
                ],
                'cta' => 'Empezar gratis',
                'popular' => false,
            ],
            [
                'name' => 'Profesional',
                'price_monthly' => 29,
                'price_yearly' => 290,
                'features' => [
                    'Canales ilimitados',
                    'Comisión 3% + gateway',
                    'Facturación AFIP (A/B/C)',
                    'Retiros automáticos configurables',
                    'Analytics avanzados',
                    'API tokens',
                    'Soporte prioritario',
                    'Marca blanca básica',
                ],
                'cta' => 'Comenzar ahora',
                'popular' => true,
            ],
            [
                'name' => 'Enterprise',
                'price_monthly' => 99,
                'price_yearly' => 990,
                'features' => [
                    'Todo en Profesional',
                    'Comisión 1.5% + gateway',
                    'Dominio personalizado',
                    'Marca blanca completa',
                    'SLA 99.9%',
                    'Soporte 24/7 dedicado',
                    'Onboarding personalizado',
                    'Integraciones custom',
                ],
                'cta' => 'Contactar ventas',
                'popular' => false,
            ],
        ];

        $faqs = [
            [
                'question' => '¿Qué comisión cobra TG-PayGate?',
                'answer' => 'Ofrecemos tres planes: Starter (5% + fee del gateway), Profesional (3% + fee del gateway) y Enterprise (1.5% + fee del gateway). No hay costos fijos mensuales en el plan Starter.',
            ],
            [
                'question' => '¿Qué pasarelas de pago soportan?',
                'answer' => 'Soportamos MercadoPago (ideal para Argentina/Latam), Stripe (internacional) y PayPal (global). Puedes activar varias simultáneamente.',
            ],
            [
                'question' => '¿Cómo funcionan los enlaces de invitación?',
                'answer' => 'Cada pago genera un enlace único de Telegram con member_limit=1 y expiración configurable. El usuario hace clic, se une al canal y el enlace queda inutilizado.',
            ],
            [
                'question' => '¿Qué pasa si un suscriptor deja de pagar?',
                'answer' => 'Nuestro scheduler verifica suscripciones vencidas cada hora y expulsa automáticamente al usuario del canal/grupo vía API de Telegram (banChatMember).',
            ],
            [
                'question' => '¿Emite facturas legales?',
                'answer' => 'Sí. Generamos facturas A, B y C con CAE de AFIP automáticamente para Argentina. Cumplimos con RG 4367/4368/4369.',
            ],
            [
                'question' => '¿Puedo usar mi propio dominio?',
                'answer' => 'En el plan Enterprise incluimos dominio personalizado y marca blanca completa. En Profesional tienes marca blanca básica.',
            ],
            [
                'question' => '¿Hay período de prueba?',
                'answer' => 'El plan Starter es gratis para siempre (solo pagas comisión por transacción). Los planes pagos tienen 14 días de prueba sin compromiso.',
            ],
            [
                'question' => '¿Cómo retiro mis ganancias?',
                'answer' => 'Configuras tu cuenta de MercadoPago Connect o Stripe Connect. Los retiros son automáticos según el ciclo que elijas (5 días, 15 días, mensual) con mínimo configurable.',
            ],
        ];

        return view('public.landing', compact(
            'featuredChannels',
            'features',
            'testimonials',
            'pricingTiers',
            'faqs'
        ));
    }
}
