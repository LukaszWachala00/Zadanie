<?php
    session_start();

//łączenie z bazą danych
    require_once "connect.php";
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

//odczyt danych z POST
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $message = htmlentities($message,ENT_QUOTES,"UTF-8"); //konwersja znaków

//walidacja pobranych danych
    const reg_name = '/^[a-zA-ZąćęłńóśźżĄĆŁŃÓŚŻŹ\s]{2,50}$/';
    const reg_surname = '/^[a-zA-ZąćęłńóśźżĄĆŁŃÓŚŻŹ\s\-]{2,50}$/';
    const reg_email = '/^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/';
    const reg_message = '/^[\s\S]/';

    if(!(preg_match(reg_name,$name) && preg_match(reg_surname,$surname) && preg_match(reg_email,$email) && preg_match(reg_message,$message))){
        echo "Błąd";
    } else {
        //zapis danych do bazy
        $polaczenie->query("INSERT INTO message VALUES(NULL,'$name','$surname','$email','$message')");

        //wyświetlenie informacji
        echo <<<END
            <a href="back.php">Powrót</a>

            <h2>Wysłano wiadomość!</h2>
            <table border="1" cellspace="0">
                <tr>
                    <td>Imię</td>
                    <td>$name</td>
                </tr>
                <tr>
                    <td>Nazwisko</td>
                    <td>$surname</td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>$email</td>
                </tr>
                <tr>
                    <td>Wiadomość</td>
                    <td>$message</td>
                </tr>
            </table>
        END;    
    }



//zamykanie połączenia
    $polaczenie->close();
?>
