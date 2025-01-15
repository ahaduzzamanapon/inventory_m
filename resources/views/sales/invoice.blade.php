<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7f9;
            color: #333;
        }
        h1 {
            margin: 1px;
        }
        p {
            margin: 2px;
        }
        h2 {
            margin: 1px;
        }
        h3 {
            margin: 1px;
        }
        h4 {
            margin: 1px;
        }
        h5 {
            margin: 1px;
        }
        h6 {
            margin: 1px;
        }


        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header img {
            max-height: 70px;
            border-radius: 5px;
        }
        .header .company-details {
            text-align: right;
        }
        .header .company-details h2 {
            margin: 0;
            color: #007bff;
        }
        .header .company-details p {
            margin: 0;
            font-size: 0.9em;
            color: #555;
        }
        .customer-details, .payment-summary {
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e4e7ea;
        }
        .customer-details h3, .payment-summary h3 {
            margin-top: 0;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table thead th {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: #fff;
            padding: 8px;
            text-align: left;
        }
        table tbody tr:nth-child(odd) {
            background: #f9f9f9;
        }
        table tbody td, table tfoot td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        table tbody tr:hover {
            background: #f1f1f1;
        }
        table tfoot td {
            font-weight: bold;
            background: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .grand-total {
            font-size: 1.2em;
            background: linear-gradient(45deg, #28a745, #218838);
            color: #fff;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
            padding: 10px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: #fff;
            border-radius: 8px;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Invoice</h1>
                <p><strong>Date:</strong> <?= date('d-m-Y', strtotime($sales['sale_date'])) ?></p>
                <p><strong>Invoice #:</strong> <?= $sales['sales_id'] ?></p>
            </div>
            <div class="company-details">
                <h2><?= $siteSettings['name'] ?></h2>
                <p><?= $siteSettings['slogan'] ?></p>
                <img src="<?= $siteSettings['logo'] ?>" alt="Company Logo">
            </div>
        </div>

        <div class="customer-details">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> <?= $customer['customer_name'] ?></p>
            <p><strong>Email:</strong> <?= $customer['customer_email'] ?></p>
            <p><strong>Phone:</strong> <?= $customer['customer_phone'] ?></p>
            <p><strong>Address:</strong> <?= $customer['customer_address'] ?></p>
        </div>

        <h3>Items Sold</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($SalesItem as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item['item_name'] ?></td>
                        <td class="text-right"><?= number_format($item['item_per_price'], 2) ?></td>
                        <td class="text-right"><?= $item['sales_qty'] ?></td>
                        <td class="text-right"><?= number_format($item['total_price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right">Sub Total</td>
                    <td class="text-right"><?= number_format($sales['sub_total'], 2) ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Discount</td>
                    <td class="text-right"><?= number_format($sales['discount_amount'], 2) ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Tax</td>
                    <td class="text-right"><?= number_format($sales['tax_amount'], 2) ?></td>
                </tr>
                <tr class="grand-total">
                    <td colspan="4" class="text-right">Grand Total</td>
                    <td class="text-right"><?= number_format($sales['grand_total'], 2) ?></td>
                </tr>
            </tfoot>
        </table>

        <h3>Payment Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Date</th>
                    <th>Method</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($SalesPayment as $payment): ?>
                    <tr>
                        <td><?= $payment['payment_id'] ?></td>
                        <td><?= date('d-m-Y', strtotime($payment['payment_date'])) ?></td>
                        <td><?= $payment['payment_method'] == 1 ? 'Cash' : 'Other' ?></td>
                        <td class="text-right"><?= number_format($payment['payment_amount'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="payment-summary">
            <h3>Payment Summary</h3>
            <p><strong>Paid Amount:</strong> <?= number_format($sales['payment_amount'], 2) ?></p>
            <p><strong>Due Amount:</strong> <?= number_format($sales['due_amount'], 2) ?></p>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>
