<?php

require 'app/Autoload.php';
Oliv\app\Autoload::register();
$error = "";
$title = "Livre d'or";

$guestbook = new Oliv\app\GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR . 'messages.php');

if(isset($_POST['username']) && isset($_POST['message'])) {
    $username = $_POST['username'];
    $messagePost = $_POST['message'];
    $message = new Oliv\app\Message($username, $messagePost);

    if($message->isValid()) {
        $guestbook->addMessage($message);

    } else {
        echo 'erreur remplissage';
        $error = $message->getErrors();
    }
}

$messages = $guestbook->getMessage();//contient tableau d'objets des messages.php
require 'elements/header.php';
?>

<div class="container">
    <h1 class="h1">Livre d'or</h1>


    <?php if(!empty($error)): ?>
        <div class="alert alert-danger">
            <p>Formulaire mal rempli</p>
        </div>
    <?php else: ?>
        <div class="alert alert-success">
            <p>Merci pour votre message</p>
        </div>
    <?php endif ?>

    <form action="" method="POST">
        <?php
            $form = new Oliv\app\Form($_POST);
            echo $form->input('Votre pseudo', 'username', $error);
            echo $form->textarea('Votre Message', 'message', $error);
            echo $form->button();
        ?>
    </form>


    <?php if(!empty($messages)): ?>
        <h2 class="md-4">Vos messages</h2>

        <?php foreach($messages as $message): ?>
            <p><?= $message->toHTML() ?></p>

        <?php endforeach ?>

    <?php endif ?>

</div>
<?php require 'elements/footer.php';
