<?php

namespace App\Providers;

use App\Models\Qprogress;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
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

        Queue::before(function (JobProcessing $event, Request $request) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
            $sees = $request->get('ChapterIdForAppServiceProvider');
            Log::info('Queued...' . $sees);
            //Qprogress::where('chapter_id', $id)->update(['qstatus' => 'job is queued - из сервиспровайдера']);
        });


        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
            Log::error('it didnt work again...' . $event->job->getJobId ());
            //Qprogress::where('payload', $event->job->payload ())->update(['qstatus' => 'job is failed - из сервиспровайдера']);
        });
    }
}
