<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Include this to get the authenticated user

class CalculateMfukoBalance extends Command
{
    protected $signature = 'mfuko:calculate';
    protected $description = 'Calculate and store the total balance in mfuko_balance table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            // Calculate total paid amount from contributions (michango)
            $totalPaidAmount = DB::table('contributions')->sum('paid_amount');

            // Calculate total income amount from incomes (mapato)
            $totalIncomeAmount = DB::table('incomes')->sum('amount');

            // Calculate total expenditure amount from expenditure (matumizi)
            $totalExpenditureAmount = DB::table('expenditures')->sum('amount');

            // Calculate total balance
            $totalBalance = ($totalPaidAmount + $totalIncomeAmount) - $totalExpenditureAmount;

            // Get the current date
            $today = Carbon::today()->toDateString();

            // Get the authenticated user
            $user = Auth::user();
            $username = $user ? $user->full_name : 'System';
            $userEmail = $user ? $user->email : '';

            // Check if there is an existing balance entry for today
            $existingBalance = DB::table('mfuko_balance')
                ->whereDate('date', $today)
                ->first();

            if ($existingBalance) {
                // Update the existing record
                DB::table('mfuko_balance')
                    ->where('id', $existingBalance->id)
                    ->update([
                        'contribution_balance' => $totalPaidAmount,
                        'income_balance' => $totalIncomeAmount,
                        'expenditure_balance' => $totalExpenditureAmount,
                        'total_balance' => $totalBalance,
                        'date' => $today, // A date column to track balance date
                        'updated_at' => now(),
                    ]);

                Log::info('Mfuko balance updated successfully.', [
                    'date' => $today,
                    'user' => $username,
                    'user_email' => $userEmail,
                    'updated_record' => $existingBalance
                ]);

                $this->info('Mfuko balance updated successfully.');
            } else {
                // Insert a new record
                DB::table('mfuko_balance')->insert([
                    'contribution_balance' => $totalPaidAmount,
                    'income_balance' => $totalIncomeAmount,
                    'expenditure_balance' => $totalExpenditureAmount,
                    'total_balance' => $totalBalance,
                    'date' => $today, // A date column to track balance date
                    'created_at' => now(),
                ]);

                Log::info('Mfuko balance calculated and stored successfully.', [
                    'date' => $today,
                    'user' => $username,
                    'user_email' => $userEmail,
                    'new_record' => [
                        'contribution_balance' => $totalPaidAmount,
                        'income_balance' => $totalIncomeAmount,
                        'expenditure_balance' => $totalExpenditureAmount,
                        'total_balance' => $totalBalance,
                    ]
                ]);

                $this->info('Mfuko balance calculated and stored successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Error calculating mfuko balance: ' . $e->getMessage(), [
                'user' => $username,
                'user_email' => $userEmail,
                'date' => $today,
            ]);

            $this->error('Error calculating mfuko balance. Please check the logs for more details.');
        }
    }
}
