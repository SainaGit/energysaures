<?php
$counter_path_absolut = SRV_ROOT . $cmsDir;

$counter_path_http = "";

$counter_expire = 600;

$counter_filename = $counter_path_absolut . "counter.txt";

if (file_exists($counter_filename))
{
    $ignore = false;
    $current_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? addslashes(trim($_SERVER['HTTP_USER_AGENT'])) : "no agent";
    $current_time = time();
    $current_ip = $_SERVER['REMOTE_ADDR']; 

    $c_file = array();
    $handle = fopen($counter_filename, "r");

    if ($handle)
    {
        while (!feof($handle))
        {
            $line = trim(fgets($handle, 4096)); 
            if ($line != "")
                $c_file[] = $line;          
        }
        fclose ($handle);
    }
    else
        $ignore = true;

    if (substr_count($current_agent, "bot") > 0)
        $ignore = true;

    for ($i = 1; $i < sizeof($c_file); $i++)
    {
        list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
        $counter_time = trim($counter_time);

        if ($counter_ip == $current_ip && $current_time-$counter_expire < $counter_time)
        {
            $ignore = true;
            break;
        }
    }

    if ($ignore == false)
    {
        if (sizeof($c_file) == 0)
        {
            $add_line1 = date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time . "\n";
            $add_line2 = $current_ip . "||" . $current_time . "\n";

            $fp = fopen($counter_filename,"w+");
            if ($fp)
            {
                flock($fp, LOCK_EX);
                fwrite($fp, $add_line1);
                fwrite($fp, $add_line2);
                flock($fp, LOCK_UN);
                fclose($fp);
            }

            $day = $yesterday = $week = $month = $year = $all = $record = 1;
            $record_time = $current_time;
            $online = 1;
        }
        else
        {
            list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);

            $day_data = explode(":", $day_arr);
            $yesterday_data = explode(":", $yesterday_arr);

            $yesterday = $yesterday_data[1];
            if ($day_data[0] == (date("z")-1))
                $yesterday = $day_data[1]; 
            else
            {
                if ($yesterday_data[0] != (date("z")-1))
                    $yesterday = 0; 
            }

            $day = $day_data[1];
            if ($day_data[0] == date("z")) $day++; else $day = 1;

            $week_data = explode(":", $week_arr);
            $week = $week_data[1];
            if ($week_data[0] == date("W")) 
                $week++; 
            else 
                $week = 1;

            $month_data = explode(":", $month_arr);
            $month = $month_data[1];
            if ($month_data[0] == date("n"))
                $month++;
            else
                $month = 1;

            $year_data = explode(":", $year_arr);
            $year = $year_data[1];
            if ($year_data[0] == date("Y"))
                $year++; 
            else
                $year = 1;

            $all++;

            $record_time = trim($record_time);
            if ($day > $record)
            {
                $record = $day;
                $record_time = $current_time;
            }

            $online = 1;

            $fp = fopen($counter_filename,"w+");
            if ($fp)
            {
                flock($fp, LOCK_EX);
                $add_line1 = date("z") . ":" . $day . "||" . (date("z")-1) . ":" . $yesterday . "||" . date("W") . ":" . $week . "||" . date("n") . ":" . $month . "||" . date("Y") . ":" . $year . "||" . $all . "||" . $record . "||" . $record_time . "\n";         
                fwrite($fp, $add_line1);

                for ($i = 1; $i < sizeof($c_file); $i++)
                {
                    list($counter_ip, $counter_time) = explode("||", $c_file[$i]);

                    if ($current_time-$counter_expire < $counter_time)
                    {
                        $counter_time = trim($counter_time);
                        $add_line = $counter_ip . "||" . $counter_time . "\n";
                        fwrite($fp, $add_line);
                        $online++;
                    }
                }
                $add_line = $current_ip . "||" . $current_time . "\n";
                fwrite($fp, $add_line);
                flock($fp, LOCK_UN);
                fclose($fp);
            }
        }
    }
    else
    {
        if (sizeof($c_file) > 0)
            list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
        else
            list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z")-1) . ":0||" .  date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time);

        $day_data = explode(":", $day_arr);
        $day = $day_data[1];

        $yesterday_data = explode(":", $yesterday_arr);
        $yesterday = $yesterday_data[1];

        $week_data = explode(":", $week_arr);
        $week = $week_data[1];

        $month_data = explode(":", $month_arr);
        $month = $month_data[1];

        $year_data = explode(":", $year_arr);
        $year = $year_data[1];

        $record_time = trim($record_time);

        $online = sizeof($c_file) - 1;
    }
?>
<center>
<table cellspacing="0" cellpadding="0" style="width: ₮00px;">
    <thead>
        <tr> 
            <th colspan="2" style="text-align: center;">
                Админ хандсан статистик
            </th>
        </tr>
    </thead>
    <tbody>
        <tr> 
            <td>Онлайн</td>
            <td><?php echo $online;?></td>
        </tr>
        <tr class="alt"> 
            <td>Өнөөдөр</td>
            <td><?php echo $day; ?></td>
        </tr>
        <tr> 
            <td>Өчигдөр</td>
            <td><?php echo $yesterday; ?></td>
        </tr>
        <tr class="alt"> 
            <td>Энэ 7 хоногт</td>
            <td><?php echo $week; ?></td>
        </tr>
        <tr> 
            <td>Энэ сард</td>
            <td><?php echo $month; ?></td>
        </tr>
        <tr class="alt"> 
            <td>Энэ жилд</td>
            <td><?php echo $year; ?></td>
        </tr>
        <tr> 
            <td>Нийт</td>
            <td><?php echo $all; ?></td>
        </tr> 
        <tr class="alt"> 
            <td colspan="2" style="text-align: center;">
                Хамгийн олон хандсан: <?php echo date("Y-m-d", $record_time); ?> өдөр <strong><?php echo $record; ?></strong> удаа 
            </td>
        </tr>
    </tbody> 
</table>
</center>
<?php
}
?>