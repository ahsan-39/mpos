<?php 

namespace App\Contracts;

interface ActiveStatus
{
    public function markActive(bool $status= true);
    public function isActive(): bool;
}