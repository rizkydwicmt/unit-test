<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;

class BidakCatur extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'makan:bidak';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'komen yang berfungsi untuk memakan bidak catur';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function askValid($question, $field, $rules)
    {
        $value = $this->ask($question);

        if ($message = $this->validateInput($rules, $field, $value)) {
            $this->error($message);

            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }


    protected function validateInput($rules, $fieldName, $value)
    {
        $validator = Validator::make([
            $fieldName => $value
        ], [
            $fieldName => $rules
        ]);

        return $validator->fails()
            ? $validator->errors()->first($fieldName)
            : null;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //input
        $this->info('Start');
        $bidak1 = $this->askValid('masukkan bidak 1 (x,y)', 'bidak1', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak2 = $this->askValid('masukkan bidak 2 (x,y)', 'bidak2', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak3 = $this->askValid('masukkan bidak 3 (x,y)', 'bidak3', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak4 = $this->askValid('masukkan bidak 4 (x,y)', 'bidak4', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak5 = $this->askValid('masukkan bidak 5 (x,y)', 'bidak5', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak6 = $this->askValid('masukkan bidak 6 (x,y)', 'bidak6', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak7 = $this->askValid('masukkan bidak 7 (x,y)', 'bidak7', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);
        $bidak8 = $this->askValid('masukkan bidak 8 (x,y)', 'bidak8', ['required', 'regex:/^\d+(\,|\, +)\d+$/i']);

        //output
        $this->info('Data added successfully');
    }
}
