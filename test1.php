<style>
    p
    {
        text-align:justify;
        text-decoration: underline;
        font-size: 14;
        font-family:Helvetica;
        color:red;
    }
</style>
<?php
echo "<p>Присваивание переменных:</p>";
$username = "Smith";
echo $username;
echo "<br>";
$current_user = $username;
$user = "Smith2";
echo $user . "<br>";
echo $current_user;
echo "<hr>";
echo "<p>Обращение к элементу массива:</p>";
$team = array('Bill', 'Marry', 'Mike', 'Chris', 'Anne');
echo $team[3];
echo "<hr>";
echo "<p>Обращение к элементу двумерного массива:</p>";
$oxo = array(
    array('X', ' ', 'O'),
    array('O', 'O', 'X'),
    array('X', 'O', ' ')
);
echo $oxo[1][2];
echo "<hr>";
echo "<p>Остаток от деления с подстановкой переменных в строке:</p>";
$n1 = 20;
$n2 = 9;
echo "$n1 % $n2 = " . $n1 % $n2;
echo "<hr>";
echo "<p>Оператор присваивания <b>.=</b></p>";
$elem1 = "first ";
$elem2 = "elem";
$elem1 .= $elem2;
echo $elem1;
echo "<hr>";
echo "<p>Пре- и постинкремент:</p>";
$num = 4;
echo "++num = " . ++$num . "<br>";
echo "num++ = " . $num++ . "<br>";
echo "num = " . $num;
echo "<hr>";
echo "<p>Экранирование символов:</p>";
echo 'Me spelling\'s still atroshus';
?>