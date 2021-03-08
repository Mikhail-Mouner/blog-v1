<?php

namespace App\Notifications;

use App\Comment;
use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NotifyOwner extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $comment_owner;
    public $commented_at;
    public $post;

    /**
     * Create a new notification instance.
     *
     * @param Comment $comment
     * @param Post $post
     * @return void
     */
    public function __construct(Comment $comment,Post $post)
    {
        $this->comment_owner = $comment->user;
        $this->commented_at = $comment->created_at;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail','broadcast','database','slack'];
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "comment_owner" => $this->comment_owner,
            "commented_at" => $this->commented_at,
            "post" => $this->post,
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            "data"=>[
                "comment_owner" => $this->comment_owner,
                "commented_at" => $this->commented_at,
                "post" => $this->post,
            ],
        ]);
    }
}
