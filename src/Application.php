<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App;

use App\Service\CaixaMatrizService;
use App\Service\SaidaService;
use App\Service\TemperaturaUmidadeService;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Identifier\IdentifierInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\Router;
use Cake\Utility\Security;
use Psr\Http\Message\ServerRequestInterface;
use App\Service\PedidoService;
use App\Service\UserService;
use App\Service\LinhagemService;
use App\Service\PesquisadorService;
use App\Service\PrevisaoService;
use App\Service\SalaService;
use App\Service\CaixaService;
use App\Service\PartoService;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface {


    public function services(\Cake\Core\ContainerInterface $container): void {
        $container->add(PedidoService::class);
        $container->add(UserService::class);
        $container->add(LinhagemService::class);
        $container->add(PesquisadorService::class);
        $container->add(PrevisaoService::class);
        $container->add(SalaService::class);
        $container->add(CaixaService::class);
        $container->add(SaidaService::class);
        $container->add(CaixaMatrizService::class);
        $container->add(PartoService::class);
        $container->add(TemperaturaUmidadeService::class);
    }

    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        $this->addPlugin('Authentication');
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue {
        $middlewareQueue
                // Catch any exceptions in the lower layers,
                // and make an error page/response
                ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

                // Handle plugin/theme assets like CakePHP normally does.
                ->add(new AssetMiddleware([
                            'cacheTime' => Configure::read('Asset.cacheTime'),
                        ]))

                // Add routing middleware.
                // If you have a large number of routes connected, turning on routes
                // caching in production could improve performance. For that when
                // creating the middleware instance specify the cache config name by
                // using it's second constructor argument:
                // `new RoutingMiddleware($this, '_cake_routes_')`
                ->add(new RoutingMiddleware($this))

                // Parse various types of encoded request bodies so that they are
                // available as array through $request->getData()
                // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
                ->add(new BodyParserMiddleware())
                ->add(new AuthenticationMiddleware($this));

        return $middlewareQueue;
    }

    /**
     * Bootstrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');

        // Load more plugins here
    }

    /**
     * Returns a service provider instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface {
        $service = new AuthenticationService();

        $fields = [
            IdentifierInterface::CREDENTIAL_USERNAME => 'username',
            IdentifierInterface::CREDENTIAL_PASSWORD => 'password'
        ];

        // Load the authenticators.
        $service->loadAuthenticator('Authentication.Jwt', [
            'secretKey' => Security::getSalt(),
            'returnPayload' => false,
        ]);
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
        ]);

        // Load identifiers
        $service->loadIdentifier('Authentication.JwtSubject');
        $service->loadIdentifier('Authentication.Password', [
            'returnPayload' => false,
            'fields' => $fields,
        ]);

        return $service;
    }

}
