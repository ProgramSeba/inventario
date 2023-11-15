<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Inventario</title>
</head>
<body>
    <section class="barra">

    </section>



    <section class="intefaz">

        <div class="dentro">
            <div class="titulo">
                <h1 class="titulo-dentro">Inventario</h1>

            </div>

            <div class="inventario">
                <div class="cajitas">
                <?php
                    // Simula un array de ítems del usuario
                    $items_del_usuario = array("Item 1", "Item 2", "Item 3", "Item 4", "Item 5", "Item 6", "Item 7", "Item 8", "Item 9", "Item 10");

                    // Genera cuadrados en el HTML
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<div class="cuadrado">';
                        // Verifica si hay un elemento correspondiente al índice actual
                        if (isset($items_del_usuario[$i - 1])) {
                            echo $items_del_usuario[$i - 1];
                        }
                        echo '</div>';
                    }
                ?>

                </div>
            </div>
        </div>

    </section>


    <section class="barra">

    </section>
</body>
</html>