<?php

namespace App\Repositories;

use App\Models\Ticket;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class rolesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TicketRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ticket::class;
    }
}
