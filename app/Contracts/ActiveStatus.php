<?php 

namespace App\Contracts;

interface ActiveStatus
{
    public function markActive(bool $status= true);
    public function isActive(): bool;

    public function markApprove(bool $status= true);
    public function isApproved(): bool;
}