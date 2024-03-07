@include('componenets.header')
@if (!session()->has('user_id'))
    @php
        // Redirect ไปยังหน้าหลัก
        header('Location: /');
        exit();
    @endphp
@endif
<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="assetTable" class="display table table-hover">
                    <thead>
                        <tr>
                            <th>รหัสสินทรัพย์</th>
                            <th>ประเภท ส/ท</th>
                            <th>รหัสศูนย์</th>
                            {{-- <th>วันเริ่มคิดค่าเสื่อม</th>
                            <th>สถานที่ตั้ง</th>
                            <th>จำนวน</th>
                            <th>หน่วยนับ</th>
                            <th>อายุ</th>
                            <th>ราคาทุน</th>
                            <th>มูลค่าสุทธิ</th> --}}
                            <th>แผนงาน</th>
                            <th>วันที่สร้าง</th>
                            <th>พิมพ์ QR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">พิมพ์ QR Code</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-auto">
                <div class="row">
                    <div class="col-3">
                        <label for="" class="d-none ">กว้าง (pixel)</label>
                        <input type="number" class="d-none form-control widthCM" placeholder="กว้าง" value="256">
                    </div>
                    <div class="col-3">
                        <label for="" class="d-none ">สูง (pixel)</label>
                        <input type="number" class="d-none form-control heightCM" placeholder="สูง" value="256">
                    </div>
                </div>
                <div id="qrCode" class="m-3"></div>

                <button class="btn btn-primary mt-5 w-100 printRQReal">พิมพ์ QR Code</button>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div> --}}
        </div>
    </div>
</div>

<script type="text/javascript" src="qrcode.min.js"></script>

<script>
    $(document).ready(function() {
        let dataAssets = '';
        // ข้อมูลที่ให้มา
        axios.get('/api/listRowQR', {})
            .then(function(response) {
                // หลังจากที่ได้รับข้อมูลจาก API สามารถใช้ข้อมูลเหล่านั้นในการกำหนดค่าให้กับ DataTable
                $('#assetTable').DataTable({
                    data: response.data,
                    columns: [{
                            data: 'assets_key'
                        },
                        {
                            data: 'assets_type'
                        },
                        {
                            data: 'zero_code'
                        },
                        {
                            data: 'layout'
                        },
                        {
                            data: 'created_date'
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return `<button class='btn btn-primary print-button' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bxs-printer'></i></button>`;
                            }
                        }
                    ]
                });
            })
            .catch(function(error) {
                console.error(error);
            });

        $('#assetTable').on('click', '.print-button', function() {
            $('#qrCode>canvas').remove()
            $('#qrCode>img').remove()
            // $('.widthCM').val(256);
            // $('.heightCM').val(256);

            dataAssets = $('#assetTable').DataTable().row($(this).parents('tr')).data();
            var assetsKey = dataAssets.assets_key;

            // เปิด Modal เมื่อคลิกปุ่มพิมพ์

            var qrcode = new QRCode(document.getElementById("qrCode"), {
                text: assetsKey,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

        });

        $('.widthCM').on('change', function() {
            $('#qrCode>canvas').remove()
            $('#qrCode>img').remove()
            var qrcode = new QRCode(document.getElementById("qrCode"), {
                text: dataAssets.assets_key,
                width: $(this).val(),
                height: $('.heightCM').val(),
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        })

        $('.heightCM').on('change', function() {
            $('#qrCode>canvas').remove()
            $('#qrCode>img').remove()
            var qrcode = new QRCode(document.getElementById("qrCode"), {
                text: dataAssets.assets_key,
                width: $('.widthCM').val(),
                height: $(this).val(),
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        })

        $('.printRQReal').on('click', function() {
            // ดึงค่า assets_key จาก dataAssets
            var assetsKey = dataAssets.assets_key;

            // เปิดหน้าใหม่เพื่อพิมพ์ QR Code โดยส่งค่า assets_key ไปด้วย
            window.open('/printQR/' + assetsKey, '_blank');
        });

    });
</script>

@include('componenets.footer')
