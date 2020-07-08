<?php

require './koneksi.php';


function getUserInput($user_input)
{
    array_pop($user_input);

    $rule_input = [];

    foreach ($user_input as $input) {
        array_push($rule_input, $input);
    }

    return $rule_input;
}

function getAllRule()
{
    global $kon;

    $query_rule = 'SELECT * FROM tb_rule';

    $data_rule = mysqli_query($kon, $query_rule);

    foreach ($data_rule as $rule) {
        array_shift($rule);
        $all_rule[] = $rule;
    }

    $rule = getArrayRule($all_rule);
    return $rule;
}

function getArrayRule($all_rule)
{
    foreach ($all_rule as $i => $columns) {
        $filter_rule = array_filter($columns, function ($data, $k) {
            return $data == 1;
        }, ARRAY_FILTER_USE_BOTH);
        $rule[] = array_keys($filter_rule);
    }
    return $rule;
}

function getStatusId($get_all_rule, $user_input)
{
    $index_status = array_keys($get_all_rule);
    foreach ($get_all_rule as $i => $value) {
        foreach ($index_status as $key => $value) {
            if ($get_all_rule[$key] == $user_input) {
                $status_id = $key + 1;
                return $status_id;
            }
        }
        return  ["status" => "Tidak Terdeteksi", "info" => "Tidak ditemukan gejala yang menindikasikan status ODP, PDP, Positif Covid-19, OTG, Influenza dan Batuk Berdahak.", "penanganan" => "Hubungi dokter jika mengalami gejala-gejala diluar diagnosa atau pun gejala yang tidak terdektesi pada diagnosa Covid-19 ini."];
        var_dump(die);
    }
}

function checkRule($status_id)
{
    global $kon;

    if (gettype($status_id) != "integer") {
        return $status_id;
    }

    $query = 'SELECT * FROM tb_status WHERE id = ' . $status_id;

    return mysqli_fetch_assoc(mysqli_query($kon, $query));
}
