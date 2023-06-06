<?php

namespace App\Providers;

use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Telescope::night();

        $this->hideSensitiveRequestDetails();

        if (config('app.force_https')) {
            \URL::forceScheme('https');
        }

        Telescope::tag(static function (IncomingEntry $entry) {
            if ($entry->type === 'request') {
                $needle_content_tags = [
                    'ip_address',
                    'uri',
                    'method',
                    'controller_action',
                    'response_status',
                    'response',
                    'hostname',
                ];
                $result_tags = [];

                foreach ($entry->content as $entry_content_key => $entry_content_value) {
                    if (in_array($entry_content_key, $needle_content_tags, true)) {
                        if ($entry_content_key === 'controller_action') {
                            if ($position = strrpos($entry_content_value, '\\')) {
                                $result_tags['controller_action'] = sprintf('controller_action:%s', substr($entry_content_value, $position + 1));
                            }
                        } else {
                            if (is_string($entry_content_value) || is_numeric($entry_content_value)) {
                                $result_tags[$entry_content_key] = sprintf('%s:%s', $entry_content_key, $entry_content_value);
                            }
                        }
                    }
                }

                return $result_tags;
            }

            return [];
        });

        //        Telescope::filter(function (IncomingEntry $entry) {
        //            if ($this->app->environment('local')) {
        //                return true;
        //            }
        //
        //            return $entry->isReportableException() ||
        //                   $entry->isFailedRequest() ||
        //                   $entry->isFailedJob() ||
        //                   $entry->isScheduledTask() ||
        //                   $entry->hasMonitoredTag();
        //        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     *
     * @return void
     */
    protected function hideSensitiveRequestDetails()
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        //        Gate::define('viewTelescope', function ($user) {
        //            return in_array($user->email, [
        //                //
        //            ]);
        //        });
    }
}
