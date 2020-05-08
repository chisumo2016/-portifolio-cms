<?php

namespace Tests\Feature;

use App\Mail\ContactSubmission;
use App\Media;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    //https://laravel.com/docs/7.x/mocking#mail-fake

    /** @test*/
    public function visitor_can_submit_a_submission()
    {
        $this->withExceptionHandling();
        Mail::fake();
        Mail::assertNothingSent();

        $submission = [
            'email' => 'test@test.com',
            'message' => 'Hallo darling'
        ];

       $this->json('POST','/contact',$submission) ->assertJson([
            'message' => 'Mail Sent Successfully',
        ]);

        Mail::assertSent(ContactSubmission::class, function ($email){
            return $email->hasTo(config('variables.contact_to_email'));
        });

    }

    /***@test **/

    public  function  submission_requires_an_email()
    {
        $this->withExceptionHandling();

        $submissionData = [
            'email' => '',
            'message' => 'Hallo darling'
        ];

        $this->json('POST','/contact',$submissionData)
            ->assertJsonValidationErrors('email');

        $submissionData = [
            'email' => 'aaaaaaaaaaaaaaaa',
            'message' => 'Hallo darling'
        ];

        $this->json('POST','/contact',$submissionData)
            ->assertJsonValidationErrors('email');

    }

    public  function  submission_requires_a_message()
    {
        $this->withExceptionHandling();

        $submissionData = [
            'email' => 'test@test.com',
            'message' => 'Hallo darling'
        ];

        $this->json('POST','/contact',$submissionData)
            ->assertJsonValidationErrors('message');

    }
}


//Send the email

//Confirm email success or failure

//Respond with JSON message

//Validation
