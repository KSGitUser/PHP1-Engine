<?php

function openConnectionBase() {
    $connect = mysqli_connect('php1.oleg', 'root', '', 'urok6');
    if (mysqli_error($connect)) {
        echo mysqli_error_list($connect);
        die();
    }
    return $connect;
}

function queryDataBase($connect, $sql) {
    $dataBase = mysqli_query($connect, $sql);
    if ($dataBase !== null) {
        if (mysqli_error($connect)) {
            /*  print_r(mysqli_error_list($connect));
              die(); */
        }
    }
    return $dataBase;
}

function arrayDataBase($dataBase) {
    return $arrayFromBase = mysqli_fetch_assoc($dataBase) ?? mysqli_fetch_assoc($dataBase);
}

function closeConnectionBase($connect) {
    mysqli_close($connect);
}

$itemToEdit[1]['buttonFormText'] = "Отправить отзыв";
$itemToEdit[0]['f_name'] = "";
$itemToEdit[1]['f_email'] = "";
$itemToEdit[0]['formTextareaText'] = "";
$itemToEdit[1]['buttonFormName'] = "action";
$itemToEdit[1]['buttonFormType'] = "add";

$dataBase = null;
$connect = openConnectionBase();
$sql = "SELECT * FROM feedbacks ORDER BY f_id DESC";
$dataBase = queryDataBase($connect, $sql);
$arrayData = null;
if ($dataBase !== null) {
    while ($item = arrayDataBase($dataBase)) {
        $arrayData[] = $item;
    }
};
closeConnectionBase($connect);

//if (isset($_REQUEST['addFeedback'])) {
//  $arrayOfFeedback = $_REQUEST;
//  foreach ($arrayOfFeedback as $key => $value) {
//
//    if (($key !== 'add') && ($key !== 'action') && ($key !== 'id')) {
//
//      $arrayForDb[$key] = '"' .
//        strip_tags(htmlspecialchars((string)$value)) . '"';
//    }
//  }
//  $tabelValues = implode(", ", $arrayForDb);
//  $tabelKeys = implode(", ", array_keys($arrayForDb));
//  $connect = openConnectionBase();
//  $sql = "INSERT INTO feedbacks ({$tabelKeys}) VALUES ({$tabelValues})";
//  $queryResult = queryDataBase($connect, $sql);
//  closeConnectionBase($connect);
//  header("Location: feedbacks.php");
//};

function doFeedbackAction() {

        if ($_REQUEST['action'] == "add") {
            $arrayOfFeedback = $_REQUEST;
            foreach ($arrayOfFeedback as $key => $value) {

                if (($key !== 'add') && ($key !== 'action') && ($key !== 'id')) {

                    $arrayForDb[$key] = '"' .
                            strip_tags(htmlspecialchars((string) $value)) . '"';
                }
            }
            $tabelValues = implode(", ", $arrayForDb);
            $tabelKeys = implode(", ", array_keys($arrayForDb));

            $connect = openConnectionBase();
            $sql = "INSERT INTO feedbacks ({$tabelKeys}) VALUES ({$tabelValues})";

            $queryResult = queryDataBase($connect, $sql);
            closeConnectionBase($connect);
            header("Location: feedbacks.php");
            return;
        };


        if ($_REQUEST['action'] == "delete") {
            $idItem = $_REQUEST['Id'];

            $connect = openConnectionBase();
            $sql = "DELETE FROM feedbacks WHERE f_id = {$idItem}";

            queryDataBase($connect, $sql);
            closeConnectionBase($connect);
            header('Location: ?status=ok');
            return;
        }


        if ($_REQUEST['action'] == "edit") {
            $idItem = $_REQUEST['Id'];
            $connect = openConnectionBase();
            $sql = "SELECT * FROM feedbacks WHERE f_id = {$idItem}";
            
            $dataBase = queryDataBase($connect, $sql);
            closeConnectionBase($connect);
            $itemToEdit = arrayDataBase($dataBase);


            
            $formInputNameVal = $itemToEdit['f_name'];
            $formInputEmailVal = $itemToEdit['f_email'];
            $formTextareaText = $itemToEdit['f_text'];
            
            $buttonFormText = "Редактировать";
            $buttonFormName = "action";
            $buttonFormType = "update";
            $buttonForForm = ["buttonFormText"=>"Редактировать", "buttonFormName" => "action", "buttonFormType" => "update"];
            $varForForm[] = $itemToEdit;
            $varForForm[] = $buttonForForm;
            return $varForForm;
        }


        if ($_REQUEST['action'] == "update") {
            $idItem = $_REQUEST['id'];
            $arrayOfFeedback = $_REQUEST;
            foreach ($arrayOfFeedback as $key => $value) {

                if (($key !== 'add') && ($key !== 'action') && ($key !== 'id')) {

                    $textForSQL[] = strip_tags(htmlspecialchars((string) $key)) . '="' .
                            strip_tags(htmlspecialchars((string) $value)) . '" ';
                }
            }

            $textForSQL = implode(", ", $textForSQL);


            $connect = openConnectionBase();
            $sql = "UPDATE feedbacks SET {$textForSQL} WHERE f_id = '{$idItem}'";


            $dataBase = queryDataBase($connect, $sql);
            closeConnectionBase($connect);
//    $itemToEdit = arrayDataBase($dataBase);

            $buttonFormText = "Отправить отзыв";
            $formInputNameVal = "";
            $formInputEmailVal = "";
            $formTextareaText = "";
            $buttonFormName = "action";
            $buttonFormType = "add";
            header('Location: ?status=ok');
            return;
        }
    }

if (isset($_REQUEST['action'])) {
    $itemToEdit = doFeedbackAction();
}

?>

<head>
    <style>
        .div_feedback-wrapper {
            display: flex;
        }
        .div_feedback-wrapper div {
            padding: 20px;
        }


    </style>
<head>
<body>
    <div class="div_feedback-wrapper">
        <div class="div_feedback-input-wrapper">
            <form method="GET">
                <Label>Имя<input type="text" name="f_name" value="<?= $itemToEdit[0]['f_name'] ?>" ></Label><br/>
                <Label>E-mail<input type="email" name="f_email" value="<?= $itemToEdit[0]['f_email'] ?>"></Label><br/>
                <textarea name="f_text"  cols="30" rows="10"  ><?= $itemToEdit[0]['f_text'] ?>
                </textarea><br/>
                <input type=hidden name="id" value="<?= $itemToEdit[0]['f_id'] ?>">
                <button name="<?= $itemToEdit[1]['buttonFormName'] ?>" value="<?= $itemToEdit[1]['buttonFormType'] ?>"><?= $itemToEdit[1]['buttonFormText'] ?></button>
            </form>

        </div>
        <div class="div_feedback-text-wrapper">
<?php foreach ($arrayData as $value) : ?>
                <div class="div_feedback-item-wrapper">
                    <p> <?= $value['f_name'] ?> </p>
                    <p> <?= $value['f_email'] ?> </p>
                    <p> <?= $value['f_text'] ?> <p>
                        <a  href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?action=delete&Id={$value['f_id']}"); ?>" >Удалить</a>
                        <a  href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?action=edit&Id={$value['f_id']}"); ?>" >Редактироват</a>

                    <hr>
                </div>
<?php endforeach ?>
        </div>
    </div>
</body>

<!--Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores perspiciatis-->
