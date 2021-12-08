<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('app.name') ?></title>
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">

    <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

</head>

<body>
    <?php

    if ($errors->any()) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors->all() as $messages) ?>
                <li><?= $messages ?></li>
            </ul>
        </div>
    <?php endif ?>

    <div class-"container" style="margin: 50px;">
        <form action="/orders" method="post">
            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
            <div>
                <table class="table">
                    <tbody>
                        <tr style="border-bottom-color: white; ">
                            <td>الصنف </td>
                            <td> </td>
                            <td> الكمية </td>
                            <td>السائق </td>
                            
                        </tr>
                        <tr style="border-bottom-color:black; background-color:white">
                            <td><select id="item" name="item" class="form-control">
                                    <option value="1">سولار</option>
                                    <option value="2">بنزين</option>
                                </select></td>

                            <td>

                                <label class="radio">
                                    <input type="radio" name="type" value="leters">
                                    لترات
                                </label><br>
                                <label class="radio">
                                    <input type="radio" name="type" value="amount">
                                    مبلغ
                                </label>

                            </td>
                            <td>
                                <input type="text" id="quantity" name="quantity" class="form-control">
                            </td>
                            <td>
                                <select id="driver" for="driver" name="driver" class="form-control">
                                    <option value=""> </option>
                                    <?php foreach ($drivers as $driver) : ?>
                                        <option value="<?= $driver->id ?>"> <?= $driver->name ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            
                            <td>
                                <button class="btn btn-primary">اعتماد</button>
                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </form>
        <h3>الطلبات السابقة </h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="orders" style="border-bottom-color: white;">
                        <th>رقم الطلب</th>
                        <th>التاريخ</th>
                        <th>الصنف</th>

                        <th> الكمية </th>
                        <th>السائق</th>
                        <th>الحالة </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as  $order) : ?>
                        <tr style="border-bottom-color: white;">
                            <td><?= $order->id ?></td>
                            <td><?= $order->order_date ?></td>
                            <td><?php
                                if ($order->item == '1') {
                                    echo ('سولار');
                                } elseif ($order->item == '2') {
                                    echo ('ينزين');
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($order->type == 'leters') {
                                    echo ('لتر');
                                } elseif ($order->type == 'amount') {
                                    echo ('شيكل');
                                }
                                ?>
                                <?= $order->quantity ?></td>
                            <td>
                                <?= $order->driver->name?>
                                </td>
                            <td>
                                <a href="javascript:" class="status-btn" data-id="{{ $order->id }}" data-status="{{ $order->status }}"><?= $order->status_name ?></a>
                            </td>
                        </tr>
                    <?php endforeach ?>


                </tbody>

            </table>
        </div>

        <script>
            $(document).ready(function () {
                $(".status-btn").click(function(){
                    var item = $(this);
                    var order_id = $(this).attr('data-id');
                    var status = $(this).attr('data-status');
                    // alert(status);

                    $.ajax({
                        type: "get",
                        url: "{{ URL::to('/') }}/change_status/" + order_id + "/" + status,
                        success: function (response) {
                            console.log(response);
                            if(response['status'] == true) {
                                item.text(response['order']['status_name']);
                                item.attr('data-status' , response['order']['status']);
                            }
                               
                        }
                    });

                });
                
            });
        </script>

</body>

</html>