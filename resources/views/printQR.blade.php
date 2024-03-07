<!DOCTYPE html>
<html>

<head>
    <title>Print QR</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="../qrcode.min.js"></script>
</head>

<body>
    <div id="qrCode"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var qrcode = new QRCode(document.getElementById("qrCode"), {
                text: "{{ $assets_key }}",
                width: 100,
                height: 100,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            window.print();
        });

        // เมื่อการพิมพ์เสร็จสมบูรณ์ ให้ปิดหน้าต่าง
        window.onafterprint = function() {
            window.close();
        };
    </script>
</body>

</html>
