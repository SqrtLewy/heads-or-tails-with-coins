<!DOCTYPE html>
<html>

<head>
    <title>heads or tails</title>
    <meta charset="utf-8">

    <?php
    include_once 'config.php';
    $pdo = connect_to_database();

    $stmt = $pdo->prepare('SELECT * FROM money');
    $stmt->execute();
    $money = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

</head>

<body>

<div id="play">
    <h2>Welcome!</h2>
    
    <table>
        <tr>
            <td>Your nickname:</td>
            <td>Your coins:</td>
        </tr>
        <br/>

        <?php foreach ($money as $moneyy): ?>
            <tr>
                <td><?= $moneyy['nickname'] ?></td>
                <td><?= $moneyy['coins'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p>Heads or tails? Don't lose all coins! ;)</p>
    <form action="index.php" method="post">
        Rate:<input type="text" name="rate"> <br/> <br/>
        <button type="submit">Play!</button>
    </form>
    <br/>

    <?php
    $ticket = rand(0, 1);
    $rate = $_POST['rate'];
    $plus = $moneyy['coins'] + $rate;
    $minus = $moneyy['coins'] - $rate;

    if ($ticket === 0) {
        echo "Heads";
        $sql = "UPDATE money SET coins = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$plus]);
    } else {
        echo "Tails";
        $sql = "UPDATE money SET coins = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$minus]);
    }
    ?>

</div>

</body>

</html>
