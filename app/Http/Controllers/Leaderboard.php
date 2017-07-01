<?php

namespace App\Http\Controllers;

use App\Team;

class Leaderboard extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $csvData = $this->importExcel();

        if (!is_null($csvData)) {
            $this->parseTeams($csvData);
        }

        $leaderboard = $this->getLeaderboard();

        return view('leaderboard', ['leaderboard' => $leaderboard]);
    }

    /**
     * [sorts teams into leaderboard]
     * @param 
     * @return [collection] 
     */
    public function getLeaderboard()
    {

        $teams = Team::all();

        /**
         * Leaderboard fixture values
         */

        $points_allocation = [
            'win'  => 3,
            'draw' => 1,
            'lose' => 0,
        ];

        /**
         * add team total_points; 
         * add team matches_played
         */

        foreach ($teams as $team) {
            $team->total_points = ($team->matches_won * $points_allocation['win']) +
                ($team->matches_drawn * $points_allocation['draw']);
            $team->matches_played = $team->matches_won + $team->matches_drawn + $team->matches_lost;
        }

        /**
         * sort into league position descending
         */

        //$teams = $teams->sortByDesc('total_points');
        /**
         * optional sort by second parameter in the event of eaual points
         */
        $teams = $teams->sort(function($a,$b){
            if($a->total_points > $b->total_points)
                return -1;
            if($b->total_points > $a->total_points)
                return 1;
            if($a->total_points == $b->total_points){
                if($a->games_lost > $b->games_lost)
                    return -1;
                else 
                    return 1;
            }
        });

        return $teams;
    }

    /**
     * [imports an excel file if exists, renames it]
     * @param 
     * @return [array] 
     */
    private function importExcel()
    {
        $file_n = storage_path('app/soccer_table.csv');

        if (file_exists($file_n)) {
            $file   = fopen($file_n, "r");

            while (!feof($file)) {
                $rowData[] = fgetcsv($file);
            }

            rename($file_n, str_replace('.csv', "_uploaded.csv", $file_n));
        }

        return isset($rowData) ? $rowData : null;
    }

    /**
     * [process csv row data, create team if not exist, update if exists, process match data]
     * @param [array]
     * @return 
     */
    private function parseTeams($rowData)
    {

        foreach ($rowData as $key => $value) {
            $winner = '';
            $team1_name  = trim($value[0]);
            $team1_score = trim($value[1]);

            $team2_name  = trim($value[2]);
            $team2_score = trim($value[3]);

            $team1 = Team::firstOrCreate(['name' => $team1_name]);
            $team2 = Team::firstOrCreate(['name' => $team2_name]);
            //echo "<div class='row'><h2>--------Match---------</h2>";
            //echo $team1_name . ": ". $team1_score. " vs " .$team2_name . ": ". $team2_score. "<br/>";
            if ($team1_score !== $team2_score) {
                $winner = $team1_score > $team2_score ? $team1_name : $team2_name;
            }
          //  echo "<b> Winner is :" . $winner . "</b>";
            if ($winner && $winner == $team1_name) {
           //     echo "<br>:should be" . $team1_name . "<br>";
                $team1->matches_won += 1;
                $team2->matches_lost += 1;
            } elseif ($winner && $winner == $team2_name) {
          //      echo " <br>:should be" . $team2_name . "<br>";
                $team2->matches_won += 1;
                $team1->matches_lost += 1;
            } else {
            //    echo "<b> Draw </b>";
                $team1->matches_drawn += 1;
                $team2->matches_drawn += 1;
            }
           // echo "</div>";
            $team1->save();
            $team2->save();
        }
    }
}
