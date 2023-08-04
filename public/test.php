<?php
$orders = json_decode('
[
    {
        "id": 1,
        "items": [
            {
                "id": 6,
                "item_id": 1,
                "quantity_order": 2,
                "quantity_delivered": 2,
                "price": 10000,
                "name": "Item A",
                "notes": "Catatan untuk Item A",
                "created_at": "2023-07-21T09:05:37.000000Z",
                "updated_at": "2023-07-31T09:07:01.000000Z",
                "laravel_through_key": 4
            },
            {
                "id": 7,
                "item_id": 2,
                "quantity_order": 3,
                "quantity_delivered": 3,
                "price": 10000,
                "name": "Item B",
                "notes": "Catatan untuk Item B",
                "created_at": "2023-07-21T09:05:37.000000Z",
                "updated_at": "2023-07-21T09:05:37.000000Z",
                "laravel_through_key": 4
            }
        ]
    },
    {
        "id": 2,
        "items": [
            {
                "id": 6,
                "item_id": 1,
                "quantity_order": 2,
                "quantity_delivered": 2,
                "price": 10000,
                "name": "Item A",
                "notes": "Catatan untuk Item A",
                "created_at": "2023-07-21T09:05:37.000000Z",
                "updated_at": "2023-07-31T09:07:01.000000Z",
                "laravel_through_key": 4
            }
        ]
    }
]
');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
     initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container py-5">
        <?php
        foreach ($orders as $order) {
        ?>
            <h4>Order <?= $order->id; ?></h4>
            <?php
            foreach ($order->items as $item) {
            ?>
                <div class="card">
                    <div class="card-body">
                        <p><?= $item->name ?></p>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>