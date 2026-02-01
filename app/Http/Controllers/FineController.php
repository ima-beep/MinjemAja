<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all returned loans with fines
        $loans = Loan::with(['book'])
            ->where('status', 'returned')
            ->get();

        $fines = $loans->filter(function ($loan) {
            return $loan->getDaysDue() > 0;
        })->values();

        // If student, show only their fines
        if ($user->role === 'student') {
            $fines = $fines->filter(function ($loan) use ($user) {
                return $loan->guest_email === $user->email;
            })->values();
            return view('student.fines.index', compact('fines'));
        }

        // Otherwise show teacher view with all fines
        return view('teacher.fines.index', compact('fines'));
    }

    public function show($id)
    {
        $loan = Loan::with(['book'])->findOrFail($id);
        $daysDue = $loan->getDaysDue();
        $fineAmount = $daysDue * 5000;

        return view('teacher.fines.show', compact('loan', 'daysDue', 'fineAmount'));
    }

    public function edit($id)
    {
        $loan = Loan::with(['book'])->findOrFail($id);
        $daysDue = $loan->getDaysDue();
        $fineAmount = $daysDue * 5000;

        return view('teacher.fines.edit', compact('loan', 'daysDue', 'fineAmount'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        
        $validated = $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $loan->update([
            'fine_amount_paid' => $validated['amount_paid'],
            'fine_payment_date' => $validated['payment_date'],
            'fine_notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('teacher.fines.index')
            ->with('success', 'Denda telah diperbarui');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update([
            'fine_amount_paid' => 0,
            'fine_payment_date' => null,
            'fine_notes' => null,
        ]);

        return redirect()->route('teacher.fines.index')
            ->with('success', 'Pembayaran denda telah dihapus');
    }

    public function pay($id)
    {
        $loan = Loan::findOrFail($id);
        $fineAmount = $loan->getDaysDue() * 5000;

        $loan->update([
            'fine_amount_paid' => $fineAmount,
            'fine_payment_date' => now(),
        ]);

        return redirect()->route('student.fines.index')
            ->with('success', 'Denda telah dibayar. Status berubah menjadi Lunas.');
    }
}

