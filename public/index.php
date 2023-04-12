<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  </head>
  <body>

    <?php require_once "../controllers/products_page.php"; ?>

    

    <div class="page-wrapper">
        <h1 class="main-title"> Каталог </h1>

        <div class="flex card filter-card">
            <form id="filter_form" method="get">

                <div class="input-box">
                    <label for="name">Поиск по названию</label>
                    <input type="text" id="filter_name" name="filter_name" value="<?php echo $filter_name ?>">
                </div>

                <div class="input-box">
                    <label for="category_id">Категория</label>
                    <select id="category_id" name="category_id">
                    <option value="none">Любая</option>
                    <?php 
                        foreach($categories as $category){
                            $selected = '';
                            if(isset($_GET['category_id'])){
                                $selected = $_GET['category_id'] == $category['id'] ? "selected" : '';
                            }
    
                            echo "<option value='{$category['id']}' $selected >
                                {$category['category_name']}
                            </option>";
                        }
                    ?>
                    </select>
                </div>
                        
                <div class="input-box">
                    <label for="order_by">Сортировка по:</label>
                    <select id="order_by" name="order_by">
                        <?php 
                            foreach($sort_by as $val => $title){
                                $selected = '';
                                if(isset($_GET['order_by'])){
                                    $selected = $_GET['order_by'] == $val ? "selected" : '';
                                }
        
                                echo "<option value='$val' $selected > $title </option>";
                            }
                        ?>
                    </select>
                </div>
                            
                <div class="input-box">
                    <label for="page_count">Показывать по:</label>
                    <input type="number" id="page_count" name="page_count" value="<?php echo $page_count ?>">
                </div>
                
                <div class="input-box page-card">
                    Страница: <?php 
                    if($page > 1){
                        echo'<a href="#" id="prev_page" ><-</a>';
                    }
                    
                    echo "<p>$page</p>"; 
                    echo "<input type='hidden' id='page' name='page' value='$page' >";
                    ?>
                    <a href="#" id="next_page" >-></a>
                </div>

                <div class="input-box page-card">
                    <button type="submit">Применить</button>
                </div>
            </form>
        </div>
        <div class="flex card">
            <table class="my-table">
                <tr>
                    <th class='column1'>Название</th>
                    <th class='column2'>Цена</th>
                    <th class='column3'>Количество</th>
                </tr>
                <?php 
                    foreach($products as $product){
                        echo "<tr>
                            <td class='column1'>{$product['title']}</td>
                            <td class='column2'>{$product['cost']}</td>
                            <td class='column3'>{$product['amount']}</td>
                        </tr>";
                    }
                ?>
            </table>
        </div>
    </div>
  </body>
  <script src="./js/product_page.js"></script>
</html>