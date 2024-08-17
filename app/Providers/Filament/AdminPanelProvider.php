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
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->darkMode(false)
            ->brandLogo(asset('images/logo_siix.png'))
            ->favicon(asset('images/logo_siix.png'))
            ->brandLogoHeight('3rem')
            ->sidebarCollapsibleOnDesktop()
            ->brandName('Admin Portal')
            ->navigationItems([
                NavigationItem::make('dashboard')
                    ->label(fn (): string => __('filament-panels::pages/dashboard.title'))
                    ->url(fn (): string => Dashboard::getUrl())
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard'))
                    ->icon('heroicon-o-home')
            ])
            ->id('admin')
            ->path('admin')
            // ->login()
            ->profile(EditProfile::class)
            ->registration()
            ->colors([
                'primary' => Color::Amber,
            ])
            // ->authGuard('web')
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make(),
                FilamentSpatieRolesPermissionsPlugin::make(),
            )
            ->plugins([
                FilamentApexChartsPlugin::make(),
                // BreezyCore::make()
                //     ->myProfile(
                //         // shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                //         // shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                //         // navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                //         // hasAvatars: false, // Enables the avatar upload form component (default = false)
                //         slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                //     )
                //     ->enableTwoFactorAuthentication(
                //         force: false, // force the user to enable 2FA before they can use the application (default = false)
                //         // action: CustomTwoFactorPage::class // optionally, use a custom 2FA page
                //     )
                //     ->withoutMyProfileComponents([
                //         'update_password'
                //     ])
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                //
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
