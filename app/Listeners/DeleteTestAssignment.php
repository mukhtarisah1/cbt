<?php

namespace App\Listeners;

use App\Events\TestSubmitted;
use App\Models\TestAssignment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteTestAssignment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TestSubmitted $event)
    {
        // Delete the test assignment for the particular student on that test
        TestAssignment::where('test_id', $event->test->id)
                      ->where('student_id', $event->studentId)
                      ->delete();
    }
}
