<?php
    session_start();
    include "includes/header.php";
?>



<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 50px;
            max-height: 50px;
        }
</style>
</head>
<body>

    <header>
        <h1>My Orders</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample order data -->
                <tr>
                    <td>1</td>
                    <td><img src="product_a_image.jpg"></td>
                    <td>Product A</td>                    
                    <td>$50.00</td>
                    <td>Shipped</td>
                </tr>
                
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </main>

</body>




<?php
include "includes/footer.php";
?>