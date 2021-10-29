<?php

/*
 * This file is part of the Panther project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\Panther;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

// BC Layer to support Symfony 6
if (!method_exists(AbstractController::class, 'getDoctrine')) {
    trait WebTestCaseBCTrait
    {
        // Copied from WebTestCase to allow assertions to work with createClient

        /**
         * Creates a KernelBrowser.
         *
         * @param array $options An array of options to pass to the createKernel method
         * @param array $server  An array of server parameters
         *
         * @return KernelBrowser A browser instance
         */
        protected static function createClient(array $options = [], array $server = []): KernelBrowser
        {
            $kernel = static::bootKernel($options);

            try {
                /** @var KernelBrowser $client */
                $client = $kernel->getContainer()->get('test.client');
            } catch (ServiceNotFoundException $e) {
                if (class_exists(KernelBrowser::class)) {
                    throw new \LogicException('You cannot create the client used in functional tests if the "framework.test" config is not set to true.');
                }
                throw new \LogicException('You cannot create the client used in functional tests if the BrowserKit component is not available. Try running "composer require symfony/browser-kit"');
            }

            $client->setServerParameters($server);

            return self::getClient($client);
        }
    }
} else {
    trait WebTestCaseBCTrait
    {
        // Copied from WebTestCase to allow assertions to work with createClient

        /**
         * Creates a KernelBrowser.
         *
         * @param array $options An array of options to pass to the createKernel method
         * @param array $server  An array of server parameters
         *
         * @return AbstractBrowser A browser instance
         */
        protected static function createClient(array $options = [], array $server = []): AbstractBrowser
        {
            $kernel = static::bootKernel($options);

            try {
                /** @var KernelBrowser $client */
                $client = $kernel->getContainer()->get('test.client');
            } catch (ServiceNotFoundException $e) {
                if (class_exists(KernelBrowser::class)) {
                    throw new \LogicException('You cannot create the client used in functional tests if the "framework.test" config is not set to true.');
                }
                throw new \LogicException('You cannot create the client used in functional tests if the BrowserKit component is not available. Try running "composer require symfony/browser-kit"');
            }

            $client->setServerParameters($server);

            return self::getClient($client);
        }
    }
}
