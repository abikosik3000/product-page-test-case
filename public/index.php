<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <!--<link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
  </head>
  <body>
    <?php 
        require_once "../bootstrap.php";

        require_once "../models/products.php";
        require_once "../models/categories.php";
        
        $options = [
            'pagination' => [
                'page' => 0,
                'page_lenght' => 20, 
            ]
        ];

        if(isset($_GET['category_id'])){
            if(is_numeric($_GET['category_id']) ){

                $options['where']['category_id']['sign'] = '=';
                $options['where']['category_id']['value'] = (int)$_GET['category_id'];
            }
        }

        if(isset($_GET['order_by'])){

            $temp = explode(" ",$_GET['order_by']);
            if( array_key_exists($temp[1] ,['ASC' , 'DESC'] )){

                $options['order_by'][$temp[0]] = $temp[1];
            }
        }

        if(!isset($_GET['page']) && !isset($_GET['page_count'])){
            
            if(is_numeric($_GET['page']) && is_numeric($_GET['page_count']) ){

                $options['limit']['from'] = (int)$_GET['page']*(int)$_GET['page_count'];
                $options['limit']['count'] = (int)$_GET['page_count'];
            }
        }



        
        var_dump($options);
        /*$options = [
                'order_by' => [
                    'cost' => 'ASC',
                ],
                
            ];*/

        $products = Products::getData($options);
        $categories = Categories::getData();
        $pdo = null;
    ?>
    <div>
        <form action="index.php" method="get">
            <label for="name">Поиск по названию</label>
            <input type="text" id="filter_name" name="filter_name">

            <label for="category_id">Категория</label>
            <select id="category_id" name="category_id">
                <option value="none">Любая</option>
                <?php 
                    foreach($categories as $category){
                        echo "<option value='{$category['id']}'>
                            {$category['category_name']}
                        </option>";
                    }
                ?>
            </select>

            <label for="order_by">Сортировка по:</label>
            <select id="order_by" name="order_by">
                <option value="title asc">Название</option>
                <option value="cost asc">Цена по возрастанию</option>
                <option value="cost desc">Цена по убыванию</option>
                <option value="amount asc">Наличие по возрастанию</option>
                <option value="amount desc">Наличие по убыванию</option>
            </select>

            <button type="submit">Применить</button>
        </form>
    </div>
    <div>
        <table>
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            <?php 
                foreach($products as $product){
                    echo "<tr>
                        <td>{$product['title']}</td>
                        <td>{$product['cost']}</td>
                        <td>{$product['amount']}</td>
                    </tr>";
                }
            ?>
        </table>
    </div>
  </body>
</html>