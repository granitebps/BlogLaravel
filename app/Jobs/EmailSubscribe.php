<?php

namespace App\Jobs;

use App\Mail\SubsciberEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EmailSubscribe implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $value;
    public $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post, $value)
    {
        $this->post = $post;
        $this->value = $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->value->email)->send(new SubsciberEmail($this->post));
    }
}
