<?php
namespace App\Http\Directives;

use Illuminate\Support\Facades\Blade;

class AdminDirective
{
    public function handle()
    {
        Blade::directive('admin', function () {
            return "<?php if(auth()->check() && auth()->user()->role === 'admin'): ?>";
        });

        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });
    }
}