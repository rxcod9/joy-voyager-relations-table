<?php

declare(strict_types=1);

namespace Joy\VoyagerRelationsTable;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Joy\VoyagerRelationsTable\View\Components\RelationsTable;
use Joy\VoyagerRelationsTable\View\Components\RelationsTables;

/**
 * Class VoyagerRelationsTableServiceProvider
 *
 * @category  Package
 * @package   JoyVoyagerRelationsTable
 * @author    Ramakant Gangwar <gangwar.ramakant@gmail.com>
 * @copyright 2021 Copyright (c) Ramakant Gangwar (https://github.com/rxcod9)
 * @license   http://github.com/rxcod9/joy-voyager-relations-table/blob/main/LICENSE New BSD License
 * @link      https://github.com/rxcod9/joy-voyager-relations-table
 */
class VoyagerRelationsTableServiceProvider extends ServiceProvider
{
    /**
     * Boot
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishables();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'joy-voyager-relations-table');

        $this->mapApiRoutes();

        $this->mapWebRoutes();

        if (config('joy-voyager-relations-table.database.autoload_migrations', true)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'joy-voyager-relations-table');

        $this->bootComponents();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix(config('joy-voyager-relations-table.route_prefix', 'api'))
            ->middleware('api')
            ->group(__DIR__ . '/../routes/api.php');
    }

    /**
     * Boot components.
     */
    protected function bootComponents(): void
    {
        app('blade.compiler')->component('joy-voyager-relations-table', RelationsTable::class);
        app('blade.compiler')->component('joy-voyager-relations-tables', RelationsTables::class);
        app('blade.compiler')->componentNamespace('\\Joy\\VoyagerRelationsTable\\View\\Components', 'joy-voyager-relations-table');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/voyager-relations-table.php', 'joy-voyager-relations-table');

        $this->registerCommands();
    }

    /**
     * Register publishables.
     *
     * @return void
     */
    protected function registerPublishables(): void
    {
        $this->publishes([
            __DIR__ . '/../config/voyager-relations-table.php' => config_path('joy-voyager-relations-table.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/joy-voyager-relations-table'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/joy-voyager-relations-table'),
        ], 'translations');
    }

    protected function registerCommands(): void
    {
        //
    }
}
