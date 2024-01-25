<?php

namespace App\Providers;

use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\SubMenuRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\MenuRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SubMenuRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
    $this->app->bind(SubMenuRepositoryInterface::class, SubMenuRepository::class);
    $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
  }
}
