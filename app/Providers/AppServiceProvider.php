<?php

namespace App\Providers;

use App\Models\Qprogress;
use Closure;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Request;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {

        Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()

            $uuid = $event->job->payload ();
            $dump = (($uuid['data']['command']));
            $id = $this->get_string_between($dump, 's:2:"', '"');

            //var_dump (($uuid['data']['command']));

            Log::info('Queued...' . $event->job->getJobId ());
            Qprogress::where('chapter_id', $id)->update(['qstatus' => 'Выполнено']);
        });


        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception

            $uuid = $event->job->payload ();
            $dump = (($uuid['data']['command']));
            $id = $this->get_string_between($dump, 's:2:"', '"');

            Log::error('it didnt work again...' . $event->job->getJobId () .$id);
            Qprogress::where('chapter_id', $id)->update(['qstatus' => 'Ошибка выполнения']);
        });
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }
}
