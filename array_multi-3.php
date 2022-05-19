<?php

$languages = array();

$languages['First_Semester'] = array(
    "language" => "C",
    "type" => "programming contest",
    "designed_by" => "Aoyon",
    "Second_Semester" => array(
        "language" => "C++",
        "typing_discipline" => "Dynamic",
        "license" => "C++ Software Foundation",
        "Third_Semester" => array(
            "language" => "Java",
            "Category" => "Hard",
            "Company" => "Java Software Foundation",
            "Fourth_Semester" => array(
                "language" => "C#",
                "Category" => "Hard",
                "Authority" => "C# Software Foundation",
                "Fifth_Semester" => array(
                    "language" => "PHP",
                    "Category" => "Hard",
                    "Author" => "PHP Software Foundation"
                )
            )
        )
    )
);

foreach ($languages as $key => $value) {
    foreach ($value as $sub_key => $sub_val) {
        if (is_array($sub_val)) {
            foreach ($sub_val as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if (is_array($v2)) {
                            foreach ($v2 as $k3 => $v3) {
                                echo '<pre>';
                                print_r($k3 . ' -- ' . $v3);
                            }
                        } 
                        else {
                            echo '<pre>';
                            print_r($k2 . ' -- ' . $v2);
                        }
                    }
                } 
                else {
                    echo '<pre>';
                    print_r($k . ' -- ' . $v);
                }
            }
        } 
       else {
            echo '<pre>';
            print_r($sub_key . ' -- ' . $sub_val);
        }
    }
}
?>