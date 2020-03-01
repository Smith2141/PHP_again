<!-- <?php
    $gender = "мужчина";
    if ($gender == "мужчина") {
        print("<h2>Здарова!!!</h2>");
    } else {
        print("<h1><i>Здрасьте!</i></h1>");
    }
?> -->
<!-- <?php
    $fav_shows = ["Game of thrones", "American horror story", "Walking dead"];
    print("Мои любимые сериалы: " . $fav_shows[0]);
?> -->
<!-- <?php
    $user = ['age' => 42, 'name' => 'Иннокентий', 'fav_shows' => ["Game of thrones", "American horror story", "Walking dead"] ];
    print("Имя: " . $user['name'] . ";<br> Возраст: " .$user['age'] . ";<br> Любимый сериал: " . $user['fav_shows'][2]);
?> -->
<!-- <?php
    $last_num = 1;

    while($last_num <= 10) {
        print("<h2>" . $last_num . "</h2><br>");
        // $last_num += 1;
        ++$last_num;
    }
?> -->
<!-- <?php
    $fav_shows = ["Game of thrones", "American horror story", "Walking dead"];
    $curr_index = 0;

    while (array_key_exists($curr_index, $fav_shows)) {
        print($curr_index+1 . ". " . $fav_shows[$curr_index] . "<br>");
        $curr_index++;
    }
    echo "<u><h1>The end of list</h1></u>";

?> -->
<!-- <?php
    function is_leap_year ($year) {
        if ($year % 4 != 0) {
            return false;
        }
        elseif ($year % 100 == 0) {
            if ($year % 400 == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    $year = 1968;
    if (is_leap_year($year)) {
        print("{$year} год - високосный");
    } else {
        print ("{$year} год - простой");
    }
?> -->
<style>
    p
    {
        text-align:justify;
        font-family:Helvetica;
        color:red;
    }
</style>
<!-- <?php
    echo "<p>01Hello World. Today is <b>".date("l").".</p></b>";
?> -->
<!-- <p>How are you?<hr></p>
<p>Hello World. Today is <b><?php echo date("l"); ?>.</b><br>How are you?</p>
<script type="text/javascript">
document.write("<p>Hello World. Today is " + Date() + "</p>");
</script> -->
<?php
    phpinfo();
    ?>
<!-- <?php
    echo "<i>Здесь всё закомментировано, уажите другой файл!</i>";
?> -->