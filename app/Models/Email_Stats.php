<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Email_Stats extends Model
{
    /**
     * Total amount or score.
     *
     * @var integer
     */
     public int $TotalAmount;

    /**
     * Weekly update
     *
     * @var integer
     */
    public int $WeeklyAmount;
}
