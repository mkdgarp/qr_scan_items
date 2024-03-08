@include('componenets.header')
<style>
    .upload-style {
        position: relative;
        /* top: 50%; */
        /* left: 50%; */
        /* margin-top: -100px; */
        /* margin-left: -250px; */
        width: 150px;
        height: 150px;
        border: 2px solid #333;
        border-radius: 10px;
        cursor: pointer;
    }

    .upload-style p {
        width: 100%;
        height: 100%;
        text-align: center;
        /* line-height: 170px; */
        color: #333;
        font-family: Arial;
        margin-top: 45px;
    }

    .upload-style input {
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        outline: none;
        opacity: 0;
        background: blue;
        top: 0;
    }

    .scan-input {
        font-size: 45px;
        margin-top: -10px;
    }

    .displayResult {
        display: none;
    }

    /* .html5-qrcode-element {
        display: none !important;
    } */

    #qr-reader,
    #qr-reader__scan_region {
        border: none !important;
    }
</style>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>ระบบตรวจสอบ QR ข้อมูลสินทรัพย์</h1>
                    {{-- <div class="d-flex justify-content-center mt-5">
                        <button style='display:none !important;'>สแกน QR Code</button>
                        <div id="startScanner" class='upload-style mb-2'>
                            <p>
                                <i class='bx bx-qr-scan scan-input '></i><br><b>ขอสิทธิ์เข้าถึงกล้อง</b>
                            </p>
                        </div>
                    </div> --}}

                    <div id="qr-reader" class="mt-5"></div>
                    <div id="qr-reader-results"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 displayResult">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="text-start resultHere">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script> --}}
<script src="html5-qrcode.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    const Toast2 = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
        
    $('.html5-qrcode-element').ready(function() {
        $('.html5-qrcode-element').addClass('btn btn-primary')
    })
    $('#html5-qrcode-anchor-scan-type-change').ready(function() {
        $('#html5-qrcode-anchor-scan-type-change').addClass('d-none')
    })
    $('#html5-qrcode-button-camera-permission').ready(function() {
        $('#html5-qrcode-button-camera-permission').text('ขอสิทธิ์การเข้าถึงกล้อง')
    })
    $('#html5-qrcode-button-camera-stop').ready(function() {
        $('#html5-qrcode-button-camera-stop').addClass('btn btn-danger')
        $('#html5-qrcode-button-camera-stop').text('หยุดสแกน')
    })
    $('#html5-qrcode-button-camera-start').ready(function() {
        $('#html5-qrcode-button-camera-start').addClass('btn btn-primary')
        $('#html5-qrcode-button-camera-start').text('สแกน QR Code')
    })
    // $('#qr-reader__header_message').ready(function(){
    //     $('#qr-reader__header_message').text('สิทธิ์การเข้าถึง: ไม่พบการอนุญาตการให้เข้าถึงกล้อง')
    // })
    $('.scan-input').on('click', function() {
        $('#html5-qrcode-button-camera-permission').click();
    })

    function docReady(fn) {

        // see if DOM is already available
        if (document.readyState === "complete" ||
            document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
            // $('#startScanner').show()
        } else {
            document.addEventListener("DOMContentLoaded", fn);
            // $('#startScanner').hide()
        }
    }

    docReady(function() {
        // var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);

                // Close camera


                // Send result to API and display result
                fetch('api/checkQR', {
                        method: 'POST',
                        body: JSON.stringify({
                            qrText: decodedText
                        }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let datas = data[0]
                        // Display result
                        // resultContainer.innerHTML = data.result;
                        html5QrcodeScanner.clear();
                        // console.log('data',data)
                        Toast2.fire({
                            icon: "success",
                            title: "สแกน QR Code สำเร็จ!"
                        });
                        $('.resultHere').html(`
                        <h5>ผลลัพธ์</h5><hr class='my-1 py-1'>
                        <b>รหัสสินทรัพย์</b> : <span>${datas.assets_key}</span><br>
                        <b>ประเภทสินทรัพย์</b> : <span>${datas.assets_type}</span><br>
                        <b>รหัสศูนย์</b> : <span>${datas.zero_code}</span><br>
                        <b>วันเริ่มคิดค่าเสื่อม</b> : <span>${datas.start_depreciation}</span><br>
                        <b>สถานที่ตั้ง</b> : <span>${datas.address}</span><br>
                        <b>จำนวน</b> : <span>${datas.qty}</span><br>
                        <b>หน่วยนับ</b> : <span>${datas.unit}</span><br>
                        <b>อายุ</b> : <span>${datas.age}</span><br>
                        <b>ราคาทุน</b> : <span>${datas.cost_price}</span><br>
                        <b>มูลค่าสุทธิ</b> : <span>${datas.total_price}</span><br>
                        <b>แผนงาน</b> : <span>${datas.layout}</span><br>
                        `)
                        $('.displayResult').addClass('d-flex')
                    })
                    .catch((error) => {
                        html5QrcodeScanner.clear();
                        Toast.fire({
                            icon: "warning",
                            title: "ไม่พบ QR Code นี้ในระบบ"
                        });
                        return; // ไม่ส่งข้อมูลถ้ามีฟิลด์ใดหนึ่งว่าง
                    });
                setTimeout(() => {
                    html5QrcodeScanner.render(onScanSuccess);
                }, 1500); // Set a delay before showing the scanner again
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250,
                facingMode: "environment" // ระบุการใช้กล้องหลังเท่านั้น
            });
        html5QrcodeScanner.render(onScanSuccess);

    });
</script>



@include('componenets.footer')
