<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .receiver input[type="text"] {
            width: 200px;
            margin-right: 15px;
        }

        select.form-control {
            width: 200px;
            margin-right: 15px;

        }

        #picker {
        }
    </style>
</head>
<body>

<form action="">

    <div class="row receiver">
        <input class="form-control form-control-xs" type="text" name="name" id="name" placeholder="收件人">
        <input class="form-control form-control-xs" type="text" name="mobile" id="mobile" placeholder="收件手机号">
    </div>

    <div id="picker" class="row mt-1"><!-- container -->
        <select class="form-control" id="state" data-province="---- 选择省 ----"></select>
        <select class="form-control " id="city" data-city="---- 选择市 ----"></select>
        <select class="form-control" id="district" data-district="---- 选择区 ----"></select>
    </div>

    <div class="row mt-1">
        <input class="form-control" type="text" name="detail" id="detail" placeholder="详细地址">
    </div>

    <div class="row">
        <textarea name="description" id="description" cols="30" rows="10" class="form-control mt-1"
                  placeholder="收件人 手机号 省 市 区 详细地址">罗兴昌 15088131939 广东省 茂名市 高州市 沙田镇 乐山罗屋村</textarea>
    </div>

</form>
<script src="/static/js/jquery-3.6.0.min.js"></script>
<script src="/static/js/distpicker.min.js"></script>

<script>
    $(function () {

        $('#picker').distpicker();

        $('#description').on('blur', function () {

            // 罗兴昌 15088131939 广东省 茂名市 高州市 沙田镇 乐山罗屋村
            let value = $(this).val();

            let items = value.split(' ');

            let name = '';
            let mobile = '';
            let state = '';
            let city = '';
            let district = '';
            let address = '';

            [name, mobile, state, city, district, address] = items;

            $('#name').val(name);
            $('#mobile').val(mobile);
            $('#state').val(state).trigger('change');
            $('#city').val(city).trigger('change');
            $('#district').val(district).trigger('change');

            $('#detail').val(address);

        })

    })
</script>
</body>
</html>
