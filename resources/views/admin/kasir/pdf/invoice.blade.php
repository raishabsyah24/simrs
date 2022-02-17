<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>{{ $title ?? '' }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('backend/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('backend/css/theme.css?ver=2.9.1') }}">

</head>

<body class="bg-white" onload="printPromot()">
<div class="nk-block">
    <div class="invoice invoice-print">
        <div class="invoice-wrap">
            <div class="invoice-brand text-center">
                <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
            </div>
            <div class="invoice-head">
                <div class="invoice-contact">
                    <span class="overline-title">Invoice To</span>
                    <div class="invoice-contact-info">
                        <h4 class="title">Gregory Anderson</h4>
                        <ul class="list-plain">
                            <li><em class="icon ni ni-map-pin-fill fs-18px"></em><span>House #65, 4328 Marion Street<br>Newbury, VT 05051</span></li>
                            <li><em class="icon ni ni-call-fill fs-14px"></em><span>+012 8764 556</span></li>
                        </ul>
                    </div>
                </div>
                <div class="invoice-desc">
                    <h3 class="title">Invoice</h3>
                    <ul class="list-plain">
                        <li class="invoice-id"><span>Invoice ID</span>:<span>66K5W3</span></li>
                        <li class="invoice-date"><span>Date</span>:<span>26 Jan, 2020</span></li>
                    </ul>
                </div>
            </div><!-- .invoice-head -->
            <div class="invoice-bills">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="w-150px">Item ID</th>
                            <th class="w-60">Description</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kode }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- .invoice-bills -->
        </div><!-- .invoice-wrap -->
    </div><!-- .invoice -->
</div><!-- .nk-block -->
<script>
    function printPromot() {
        window.print();
    }
    // window.print();
    window.onfocus=function(){ window.close();}

</script>
</body>

</html>
