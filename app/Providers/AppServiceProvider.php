<?php

namespace App\Providers;

use Blade;
use DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Log;
use function implode;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(static function (QueryExecuted $query) {
            Log::info(implode(' ', [
                $query->sql,
                '[' . implode(', ', $query->bindings) . ']',
                $query->time,
            ]));
        });

        Blade::directive('jsmodule', static function (string $expression) {
            return "<?php echo \js_module($expression); ?>";
        });
    }
}
