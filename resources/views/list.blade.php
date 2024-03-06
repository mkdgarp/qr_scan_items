@include('componenets.header')
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <label for="">กว้าง (pixel)</label>
                        <input type="number" class="form-control widthCM" placeholder="กว้าง" value="256">
                    </div>
                    <div class="col-3">
                        <label for="">สูง (pixel)</label>
                        <input type="number" class="form-control heightCM" placeholder="สูง" value="256">
                    </div>
                </div>
                <div id="qrCode" class="m-3"></div>

                <button class="btn btn-primary">พิมพ์ QR Code</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="qrcode.min.js"></script>

<script>
    $(document).ready(function() {
        let dataAssets = '';
        // ข้อมูลที่ให้มา
        var data = [{
            // id: "1",
            assets_key: "123123",
            assets_type: "C0001212",
            zero_code: "C0001212",
            // start_depreciation: "2024-03-08",
            // address: "C0001212",
            // qty: "1",
            // unit: "1",
            // age: "1",
            // cost_price: "1",
            // total_price: "1",
            layout: "1",
            // user_id: "test",
            created_date: "created_date",
            // updated_date: "updated_date"
        }];

        // สร้าง DataTable
        $('#assetTable').DataTable({
            data: data,
            columns: [
                // { data: 'id' },
                {
                    data: 'assets_key'
                },
                {
                    data: 'assets_type'
                },
                {
                    data: 'zero_code'
                },
                // {
                //     data: 'start_depreciation'
                // },
                // {
                //     data: 'address'
                // },
                // {
                //     data: 'qty'
                // },
                // {
                //     data: 'unit'
                // },
                // {
                //     data: 'age'
                // },
                // {
                //     data: 'cost_price'
                // },
                // {
                //     data: 'total_price'
                // },
                {
                    data: 'layout'
                },
                // { data: 'user_id' },
                {
                    data: 'created_date'
                },
                {
                    // คอลัมน์สำหรับปุ่มพิมพ์
                    data: null,
                    render: function(data, type, row, meta) {
                        return `<button class='btn btn-primary print-button' data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class='bx bxs-printer'></i></button>`;
                    }
                }
            ]
        });

        $('#assetTable').on('click', '.print-button', function() {
            $('.widthCM').val(256);
            $('.heightCM').val(256);

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

    });
</script>

@include('componenets.footer')
