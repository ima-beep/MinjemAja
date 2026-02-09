<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',

        // identitas guest
        'guest_name',
        'guest_nisn',
        'guest_class',
        'guest_email',
        'guest_phone',

        'loan_date',
        'return_date',
        'actual_return_date',
        'return_request_date',
        'status',
        'fine_amount_paid',
        'fine_payment_date',
        'fine_notes',
        'fine_payment_request_date',
        'fine_status',
    ];

    protected $casts = [
        'loan_date' => 'datetime',
        'return_date' => 'datetime',
        'actual_return_date' => 'datetime',
        'return_request_date' => 'datetime',
        'fine_payment_request_date' => 'datetime',
        'fine_payment_date' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDaysDue()
    {
        if ($this->status !== 'returned' || !$this->actual_return_date) {
            return 0;
        }
        
        // Waktu maksimal pengembalian adalah 5 menit dari peminjaman
        $dueDate = \Carbon\Carbon::parse($this->loan_date)->addMinutes(5);
        $returnDate = \Carbon\Carbon::parse($this->actual_return_date);
        
        // Jika dikembalikan tepat waktu atau lebih cepat, tidak ada denda
        if ($returnDate->lte($dueDate)) {
            return 0;
        }
        
        // Hitung jumlah periode 5 menit keterlambatan (gunakan abs untuk nilai positif)
        $minutesDue = abs($returnDate->diffInMinutes($dueDate));
        $periodsDue = ceil($minutesDue / 5);
        
        return $periodsDue;
    }
}
