<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\Auth\EditProfile;
use Illuminate\Validation\Rules\Password;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class StockPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('stock')
            ->darkMode(false)
            ->path('stock')
            ->sidebarCollapsibleOnDesktop()
            ->brandName('Stock Control Material')
            // ->profile(EditProfile::class)
            ->navigationItems([
                NavigationItem::make('Main Menu')
                    ->url('http://portal.siix-ems.co.id/admin')
                    ->icon('heroicon-o-arrow-left-start-on-rectangle')
                    ->sort(3),
                NavigationItem::make('dashboard')
                    ->label(fn (): string => __('filament-panels::pages/dashboard.title'))
                    ->url(fn (): string => Dashboard::getUrl())
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard'))
                    ->icon('heroicon-o-home'),
            ])
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make()
            )
            ->plugins([
                FilamentApexChartsPlugin::make(),
<<<<<<< HEAD
                // BreezyCore::make()
                //     ->myProfile(
                //         shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                //         shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                //         navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                //         hasAvatars: false, // Enables the avatar upload form component (default = false)
                //         slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                //     )
                //     ->enableTwoFactorAuthentication(
                //         force: false, // force the user to enable 2FA before they can use the application (default = false)
                //         // action: CustomTwoFactorPage::class // optionally, use a custom 2FA page
                //     )
                //     // ->passwordUpdateRules(
                //     //     rules: [Password::default()->mixedCase()->uncompromised(3)], // you may pass an array of validation rules as well. (default = ['min:8'])
                //     //     requiresCurrentPassword: true, // when false, the user can update their password without entering their current password. (default = true)
                //     // )
=======
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Stock/Resources'), for: 'App\\Filament\\Stock\\Resources')
            ->discoverPages(in: app_path('Filament/Stock/Pages'), for: 'App\\Filament\\Stock\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Stock/Widgets'), for: 'App\\Filament\\Stock\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
                \App\Http\Middleware\CheckStockAccess::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
