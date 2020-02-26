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
echo '$team = array(\'Bill\', \'Marry\', \'Mike\', \'Chris\', \'Anne\')<br>';
echo '$team[3]= ' . $team[3];
echo "<hr>";
echo "<p>Обращение к элементу двумерного массива:</p>";
$oxo = array(
    array('X', ' ', 'O'),
    array('O', 'O', 'X'),
    array('X', 'O', ' ')
);
echo '$oxo[1][2]= ' . $oxo[1][2];
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
echo "<hr>";
echo "<p>Многострочные команды:</p>";
$author = "Steve Ballmer";
echo "Developers, Developers, developers, developers,
developers, developers, developers, developers, developers!
- $author.<br>";
$author = "Bill Gates";
$text = "Measuring programming progress by lines of code is like
mesuring aircragt building progress by weight.
- $author.<br>";
echo $text;
echo <<< _END
Здесь расположен
многострочный текст, это третий вариант вывода на экран с использованием 
<<< "heredoc"<br>$current_user.
_END;
$author = "Scott adams";
$out = <<< _END
Normal people believe that if it ain't broke, don't fix it.
Engineers believe that if it ain't broke, it doesn't have enough
features yet.
- $author.
_END;
echo $out;
echo "<hr>";
echo "<p>Преобразоваине типов переменных:</p>";
$number = 12345 * 67890;
echo $number . '<br>';
echo "Извлечение по индексу " . substr($number, 3, 2) . '<br>';
$pi = "3.1415927";
$radius = 5;
echo $pi * ($radius * $radius) . '<br>';
echo "<hr>";
echo "<p>Предопредённые константы:</p>";
echo "__LINE__ : " . __LINE__ . "<br>";
echo '__FILE__ : ' . __FILE__;
echo "<hr>";
echo "<p>Print и echo:</p>";
$b ? print "TRUE" : print "FALSE";
echo "<hr>";
echo "<p>Функции:</p>";
function longdate($timestamp)
{
    return date("l F jS Y", $timestamp);
}
echo longdate(time());

?>