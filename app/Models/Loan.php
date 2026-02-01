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
        'status',
        'fine_amount_paid',
        'fine_payment_date',
        'fine_notes',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date',
        'actual_return_date' => 'date',
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
        
        // Tanggal maksimal pengembalian adalah 7 hari dari peminjaman
        $dueDate = \Carbon\Carbon::parse($this->loan_date)->addDays(7);
        $returnDate = \Carbon\Carbon::parse($this->actual_return_date);
        
        // Jika dikembalikan tepat waktu atau lebih cepat, tidak ada denda
        if ($returnDate->lte($dueDate)) {
            return 0;
        }
        
        // Hitung hari keterlambatan
        $daysDue = $returnDate->diffInDays($dueDate);
        
        return $daysDue;
    }
}
