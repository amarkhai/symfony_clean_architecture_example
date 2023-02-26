<?php

declare(strict_types=1);

namespace App\Application\Gateway\Repository\Task;

use App\Application\Gateway\Repository\FindOrFailInterface;
use App\Application\Gateway\Repository\RepositoryInterface;

interface TaskRepositoryInterface extends RepositoryInterface, FindOrFailInterface
{
}