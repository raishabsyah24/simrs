<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>DAFTAR ANTRIAN FIRDAUS HOSPITAL</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/css/dashlite.css?ver=2.9.1">
    <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css?ver=2.9.1">
    <style>body{
        width: 58mm;
        height: 58cm;
        margin: 30mm 45mm 30mm 45mm; 
    }</style>
</head>

<body class="bg-white" onload="printPromot()">
    <h4>ANTRIAN PENDAFTARAN</h4>
    <h1>{{$data->kategori_pasien}} </h1>
    <h1>{{$data->nomor_antrian}} </h1>
    <script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
window.setTimeout('window.print()',500);
</script>
</body>



</html>
