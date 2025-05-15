<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifikasiBeritaBaru extends Notification implements ShouldQueue
{
    use Queueable;

    public $berita;

    public function __construct($berita)
    {
        $this->berita = $berita;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'judul' => 'Berita Baru: ' . $this->berita->judul,
            'pesan' => 'Berita baru telah diterbitkan: ' . $this->berita->ringkasan,
            'tautan' => route('berita.show', $this->berita->slug),
        ];
    }
}
