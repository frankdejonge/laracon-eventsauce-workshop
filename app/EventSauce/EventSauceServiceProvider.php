<?php

namespace App\EventSauce;

use App\CatShelter\Intake\IntakeProcessCommandHandler;
use App\CatShelter\NationalCatRegistry\CatInformationRegistry;
use EventSauce\EventSourcing\AggregateRootRepository;
use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
use EventSauce\EventSourcing\MessageDispatcherChain;
use EventSauce\EventSourcing\Serialization\ConstructingMessageSerializer;
use EventSauce\EventSourcing\Serialization\MessageSerializer;
use EventSauce\EventSourcing\SynchronousMessageDispatcher;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use function array_map;
use function config;

class EventSauceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IntakeProcessCommandHandler::class, function (Container $container) {
            return new IntakeProcessCommandHandler(
                $container->make(AggregateRootRepository::class),
                $container->make(CatInformationRegistry::class)
            );
        });

        $this->app->bind(AggregateRootRepository::class, function (Container $app) {
            return new ConstructingAggregateRootRepository(
                config('eventsauce.aggregate_root'),
                $app->make(LaravelMessageRepository::class),
                new MessageDispatcherChain(
                    $app->make(LaravelMessageDispatcher::class),
                    $app->make(SynchronousMessageDispatcher::class)
                )
            );
        });

        $this->app->bind(SynchronousMessageDispatcher::class, function (Container $app) {
            $consumers = array_map(function ($consumerName) use ($app) {
                return $app->make($consumerName);
            }, config('eventsauce.sync_consumers'));

            return new SynchronousMessageDispatcher(... $consumers);
        });

        $this->app->bind('eventsauce.async_dispatcher', function (Container $container) {
            $consumers = array_map(function ($consumerName) use ($container) {
                return $container->make($consumerName);
            }, config('eventsauce.async_consumers'));

            return new SynchronousMessageDispatcher(... $consumers);
        });

        $this->app->bind(MessageSerializer::class, function () {
            return new ConstructingMessageSerializer();
        });

        $this->app->bindMethod(EventSauceJob::class . '@handle', function (EventSauceJob $job, Container $container) {
            $dispatcher = $container->make('eventsauce.async_dispatcher');

            return $job->handle($dispatcher);
        });
    }
}