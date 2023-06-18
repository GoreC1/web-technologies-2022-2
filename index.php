<html>

<head>
    <link rel="stylesheet" href="./assets/style.css" /> 
</head>

<body>
    <?php
    $host = "localhost";
    $user = "root";
    $password = "root";
    $dbname = "catalog1";
    $dsn = "mysql:host=$host;dbname=$dbname";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {
        $pdo = new PDO($dsn, $user, $password, $options);

        $query = $pdo->prepare("SHOW TABLES LIKE 'products'");
        $query->execute();
        if($query->rowCount() != 1) {
            $query = $pdo->prepare("CREATE TABLE products (
                id int(11) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                description text NOT NULL,
                price decimal(10, 2) NOT NULL,
                image varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
            );
            
            CREATE TABLE reviews (
                id int(11) NOT NULL AUTO_INCREMENT,
                product_id int(11) NOT NULL,
                author varchar(255) NOT NULL,
                text text NOT NULL,
                PRIMARY KEY (`id`)
            );
            
            INSERT INTO
                `products` (`name`, `description`, `price`, `image`)
            VALUES
                ('Стул', 'Пластиковый стул', 1199.99, 'product1.jpg'),
                ('Стол', 'Деревянный стол', 2599.99, 'product2.jpg'),
                ('Кровать', 'Одноместная кровать', 7699.99, 'product3.jpg');

            INSERT INTO
                `reviews` (`product_id`, `author`, `text`)
            VALUES
                (1, 'Алексей', 'Отличный товар!'),
                (1, 'Александр', 'Всё супер!'),
                (2, 'Виталий', 'Видел места и получше, но в среднем нормально.'),
                (3, 'Василиса', 'То что нужно, купила своему ребенку!');
            ");

            $query->execute();
        }

        
    } catch (PDOException $e) {
        echo "Ошибка соединения с базой данных: " . $e->getMessage();
    }

    if (!isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h1>Каталог товаров:</h1>";
        foreach ($products as $product) {
            echo "
                <div class='product'>
                    <img width='200' height='200' src='images/{$product['image']}' alt='{$product['name']}' />
                    <h2>{$product['name']}</h2>
                    <p>{$product['description']}</p>
                    <p>Цена: \${$product['price']}</p>
                    <a href='?id={$product['id']}'>Узнать больше...</a>
                </div>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $query = $pdo->prepare('INSERT INTO reviews (product_id, author, text) VALUES (:product_id, :author, :text)');
            $query->bindParam(':product_id', $_POST['product_id'], PDO::PARAM_INT);
            $query->bindParam(':author', $_POST['author'], PDO::PARAM_STR);
            $query->bindParam(':text', $_POST['text'], PDO::PARAM_STR);

            $query->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<h1>{$product['name']}</h1>";
        echo "<img width='300' height='300' src='images/{$product['image']}' alt='{$product['name']}' />";
        echo "<p>{$product['description']}</p>";
        echo "<p>Price: \${$product['price']}</p>";

        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE product_id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Отзывы:</h2>";
        if (count($reviews) == 0) {
            echo "<p>Никто не оставил отзыв.</p>";
        } else {
            foreach ($reviews as $review) {
                echo "<div class='review'>";
                echo "<p>{$review['text']}</p>";
                echo "<p>Автор: {$review['author']}</p>";
                echo "</div>";
            }
        }

        echo "<h2>Оставить отзыв/h2>
            <form method='POST' action='?id={$_GET['id']}'>
                <input type='hidden' name='product_id' value='{$_GET['id']}' />
                <label>Имя:</label><br />
                <input type='text' name='author' /><br />
                <label>Оставить комментарий:</label><br />
                <textarea name='text'></textarea><br />
                <input type='submit' value='Отправить' />
            </form>";
    }

    $pdo = null;
    ?>
</body>

</html>