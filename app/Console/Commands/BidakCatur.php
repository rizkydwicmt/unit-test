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

        //masukkan ke array
        $bidak1 = preg_split('/\D+/i', $bidak1);
        $bidak2 = preg_split('/\D+/i', $bidak2);
        $bidak3 = preg_split('/\D+/i', $bidak3);
        $bidak4 = preg_split('/\D+/i', $bidak4);
        $bidak5 = preg_split('/\D+/i', $bidak5);
        $bidak6 = preg_split('/\D+/i', $bidak6);
        $bidak7 = preg_split('/\D+/i', $bidak7);
        $bidak8 = preg_split('/\D+/i', $bidak8);

        for ($y = 1; $y <= 8; $y++) {
            for ($x = 1; $x <= 8; $x++) {
                $bidak[$x][$y] = false;
            }
        }

        $bidak[$bidak1[0]][$bidak1[1]] = true;
        $bidak[$bidak2[0]][$bidak2[1]] = true;
        $bidak[$bidak3[0]][$bidak3[1]] = true;
        $bidak[$bidak4[0]][$bidak4[1]] = true;
        $bidak[$bidak5[0]][$bidak5[1]] = true;
        $bidak[$bidak6[0]][$bidak6[1]] = true;
        $bidak[$bidak7[0]][$bidak7[1]] = true;
        $bidak[$bidak8[0]][$bidak8[1]] = true;

        //kelola data
        $i = 0;
        $result = [];
        for ($y = 1; $y <= 8; $y++) {
            for ($x = 1; $x <= 8; $x++) {
                if ($bidak[$x][$y] == true) {
                    for ($yb = 1; $yb <= 8 - $y; $yb++) {
                        for ($xb = 1; $xb <= 8 - $x; $xb++) {
                            if ($bidak[$x + $xb][$y] == true) {
                                $result[$i] = '(' . $x . ',' . $y . ')';
                                $bidak[$x + $xb][$y] = false;
                                $i++;
                            }
                            if ($bidak[$x][$y + $yb] == true) {
                                $result[$i] = '(' . $x . ',' . $y . ')';
                                $bidak[$x][$y + $yb] = false;
                                $i++;
                            }
                        }
                        if ($x + $yb < 9 && $y + $yb < 9 && $bidak[$x + $yb][$y + $yb] == true) {
                            $result[$i] = '(' . $x . ',' . $y . ')';
                            $bidak[$x + $yb][$y + $yb] = false;
                            $i++;
                        }
                        if ($x - $yb > 0 && $y + $yb < 9 && $bidak[$x - $yb][$y + $yb] == true) {
                            $result[$i] = '(' . $x . ',' . $y . ')';
                            $bidak[$x + $yb][$y + $yb] = false;
                            $i++;
                        }
                    }
                }
            }
        }

        $result = implode(', ', array_unique($result));

        //output
        $this->info('Hasil');
        $this->info($result);
    }
}
