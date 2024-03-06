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
</style>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>QR Code Scanner</h1>
                    <div class="d-flex justify-content-center mt-5">
                        <button id="uploadBtn" style='display:none !important;'>สแกน QR Code</button>
                        <div class='upload-style mb-2'>
                            <p>
                                <i class='bx bx-qr-scan scan-input '></i><br><b>สแกน QR Code</b>
                            </p>
                            <input type="file" id="fileInput" accept="image/jpeg, image/png, image/jpg">
                        </div>
                    </div>

                    {{-- <video id="scanner" style="width:150px;max-width:600px;"></video> --}}
                    <div id="result">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 displayResult">
        <div class="col-12 col-md-8 col-lg-6-mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="text-start resultHere">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.min.js"></script>
<script>
    // $('.btn-scan').on('click', function() {
    //     Quagga.init({
    //         inputStream: {
    //             name: "Live",
    //             type: "LiveStream",
    //             target: document.querySelector('#scanner')
    //         },
    //         decoder: {
    //             readers: ["code_128_reader"]
    //         }
    //     }, function(err) {
    //         if (err) {
    //             console.log(err);
    //             return
    //         }
    //         console.log("Initialization finished. Ready to start");
    //         Quagga.start();
    //     });
    // })

    // Quagga.onDetected(function(result) {
    //     var code = result.codeResult.code;
    //     console.log("Decoded code:", code);

    //     // Send code to Laravel
    //     fetch('/scan', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
    //                     'content')
    //             },
    //             body: JSON.stringify({
    //                 code: code
    //             })
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             console.log(data);
    //             document.getElementById('result').innerText = data.message;
    //         })
    //         .catch(error => console.error('Error:', error));
    // });
</script>

<script>
    const uploadBtn = document.getElementById('uploadBtn');
    const fileInput = document.getElementById('fileInput');

    fileInput.addEventListener('change', function() {
        const files = fileInput.files;

        // Iterate over selected files
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            // Read file as Data URL
            reader.readAsDataURL(file);

            // When the file is loaded, add its data URL to the imagesData array
            reader.onload = function(event) {
                const imageData = event.target.result;
                console.log('Image Data:', imageData);

                // Decode QR code from image data
                const image = new Image();
                image.onload = function() {
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.width = image.width;
                    canvas.height = image.height;
                    context.drawImage(image, 0, 0, image.width, image.height);
                    const imageData = context.getImageData(0, 0, image.width, image.height);

                    // Find QR code in the image
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code) {
                        $('.displayResult').addClass('d-block')
                        $('.resultHere').html(`
                        <h5>ผลลัพธ์</h5>
                        <hr class='my-1 py-1'>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        <b>TEST TOPIC:</b> ${code.data}<br>
                        `)
                        // alert('QR Code Key ==== :' + code.data)
                    } else {
                        $('.displayResult').removeClass('d-block')
                        $('.resultHere').html('')
                        // alert('รูปแบบ QR Code ไม่ถูกต้อง กรุณาตรวจสอบ!')
                        Toast.fire({
                            icon: "error",
                            title: "รูปแบบ QR Code ไม่ถูกต้อง กรุณาตรวจสอบ!"
                        });
                    }
                };
                image.src = imageData;
            };
        }
    });
</script>
@include('componenets.footer')
