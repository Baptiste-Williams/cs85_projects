<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Calendar</title>
    <style>
        body { font-family: sans-serif; background-color: #1a202c; color: #e2e8f0; }
        .container { max-width: 800px; margin: 2rem auto; padding: 2rem; background-color: #2d3748; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        h1 { text-align: center; color: #9f7aea; }
        .calendar-grid { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .day-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 5px; background-color: #4a5568; font-size: 1.2rem; }
        .cosmic-name { background-color: #9f7aea; color: #fff; transform: scale(1.1); box-shadow: 0 0 15px #9f7aea; }
        .cosmic-month { border: 2px solid #f6e05e; }
        .cosmic-both { background-color: #ed8936; color: #fff; border: 2px solid #f6e05e; transform: scale(1.1); box-shadow: 0 0 15px #ed8936; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cosmic Calendar</h1>
        <div class="calendar-grid">
            <?php
            // Your PHP code will go here
            $firstName = 'Baptiste';
            $nameLength = strlen($firstName);
            $jsonString = file_get_contents('https://timeapi.io/api/time/current/zone?timeZone=America%2FLos_Angeles');
            $data = json_decode($jsonString);
            $dateTimeString = $data->dateTime;
            $date =new DateTime($dateTimeString);
            $dayOfYear = (int)$date->format('z') + 1;
            $month = $data->month;

            for ($i = $nameLength; $i <= $dayOfYear; $i++) {
                $cssClass = "day-box";
                $title = "Day $i";

                if ($i % $nameLength === 0 && $i % $month === 0) {
                    $cssClass .= " cosmic-both";
                    $title .= " - Cosmic BOTH (name + month)";
                } elseif ($i % $nameLength === 0) {
                    $cssClass .= " cosmic-name";
                    $title .= " - Cosmic NAME";
                } elseif ($i % $month === 0) {
                    $cssClass .= " cosmic-month";
                    $title .= " - Cosmic MONTH";
                }           

                echo "<div class='$cssClass' title='$title'>$i</div>"; 
            }

            /*
MY DEBUGGING LOG:
At first, I had trouble understanding how to use the API. I kept getting errors when trying to get the date and month, and I didn’t know what I was doing wrong. I figured out that I needed to decode the JSON first and then use the arrow (->) to get the values. Once I got that working, I was able to calculate the day of the year and use it in my loop.

I also had to test different numbers to make sure the boxes were showing the right styles. It helped me understand how the loop and if statements work together.

Then I decided to add tooltips using the title attribute so I could actually tell what each box meant when I hovered over it. I thought it looked better and made the calendar easier to understand. I hope that’s okay — I know it wasn’t in the instructions, but it helped me see how the logic connects to the output.
*/


            ?>
        </div>
    </div>
</body>
</html>
