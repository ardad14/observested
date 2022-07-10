<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly string $name,
        private readonly string $surname,
        private readonly int $age,
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Customer::create([
            "name" => $this->name,
            "surname" => $this->surname,
            "age" => $this->age,
        ]);
    }
}
