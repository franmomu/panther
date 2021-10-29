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

namespace Symfony\Component\Panther\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class DummyKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }

    public function getRootDir(): string
    {
        return $this->getCustomProjectDir();
    }

    public function getCacheDir(): string
    {
        return $this->getCustomProjectDir().'/cache';
    }

    public function getLogDir(): string
    {
        return $this->getCustomProjectDir().'/log';
    }

    public function getProjectDir(): string
    {
        return $this->getCustomProjectDir();
    }

    public function getBuildDir(): string
    {
        return $this->getCustomProjectDir().'/build';
    }

    private function getCustomProjectDir(): string
    {
        return __DIR__;
    }
}
