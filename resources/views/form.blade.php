@include('componenets.header')
@if (!session()->has('user_id'))
    @php
        // Redirect ไปยังหน้าหลัก
        header('Location: /');
        exit();
    @endphp
@endif

<style>
    / .highlight-input.filled {
        border: 1px solid #7eff82;
    }


    .highlight-input.empty {
        border: 1px solid #fa7582;
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2>Enter Asset Information</h2>
            <div id="assetForm">
                <div class="row">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="assets_key" class="form-label">รหัสสินทรัพย์</label>
                        <input type="text" class="form-control highlight-input" id="assets_key" name="assets_key"
                            placeholder="รหัสสินทรัพย์" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="assets_type" class="form-label">ประเภทสินทรัพย์</label>
                        <input type="text" class="form-control highlight-input" id="assets_type" name="assets_type"
                            placeholder="ประเภทสินทรัพย์" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="zero_code" class="form-label">รหัสศูนย์</label>
                        <input type="text" class="form-control highlight-input" id="zero_code" name="zero_code"
                            placeholder="รหัสศูนย์" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="start_depreciation" class="form-label">วันเริ่มคิดค่าเสื่อม</label>
                        <input type="date" class="form-control highlight-input" id="start_depreciation"
                            name="start_depreciation" placeholder="วันเริ่มคิดค่าเสื่อม" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="address" class="form-label">สถานที่ตั้ง</label>
                        <input type="text" class="form-control highlight-input" id="address" name="address"
                            placeholder="สถานที่ตั้ง" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="qty" class="form-label">จำนวน</label>
                        <input type="number" class="form-control highlight-input" id="qty" name="qty"
                            placeholder="จำนวน" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="unit" class="form-label">หน่วยนับ</label>
                        <input type="text" class="form-control highlight-input" id="unit" name="unit"
                            placeholder="หน่วยนับ" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="age" class="form-label">อายุ</label>
                        <input type="number" class="form-control highlight-input" id="age" name="age"
                            placeholder="อายุ" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="cost_price" class="form-label">ราคาทุน</label>
                        <input type="number" class="form-control highlight-input" id="cost_price" name="cost_price"
                            placeholder="ราคาทุน" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="total_price" class="form-label">มูลค่าสุทธิ</label>
                        <input type="number" class="form-control highlight-input" id="total_price" name="total_price"
                            placeholder="มูลค่าสุทธิ" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="layout" class="form-label">แผนงาน</label>
                        <input type="text" class="form-control highlight-input" id="layout" name="layout"
                            placeholder="แผนงาน" required>
                    </div>
                    {{-- <div class="mb-3 col-12 col-md-6">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control highlight-input" id="user_id" name="user_id" required>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="created_date" class="form-label">Created Date</label>
                <input type="date" class="form-control highlight-input" id="created_date" name="created_date" required>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="updated_date" class="form-label">Updated Date</label>
                <input type="date" class="form-control highlight-input" id="updated_date" name="updated_date" required>
            </div> --}}
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100 mt-3" onclick="submitForm()">สร้างสินทรัพย์</button>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->



<script>
    $(document).ready(function() {
        $('.highlight-input').on('input', function() {
            if ($(this).val().trim() !== '') {
                $(this).removeClass('empty').addClass('filled');
            } else {
                $(this).removeClass('filled').addClass('empty');
            }
        });
    });

    function submitForm() {
        // เก็บค่าข้อมูลฟอร์ม
        let assets_key = document.getElementById('assets_key').value.trim();
        let assets_type = document.getElementById('assets_type').value.trim();
        let zero_code = document.getElementById('zero_code').value.trim();
        let start_depreciation = document.getElementById('start_depreciation').value.trim();
        let address = document.getElementById('address').value.trim();
        let qty = document.getElementById('qty').value.trim();
        let unit = document.getElementById('unit').value.trim();
        let age = document.getElementById('age').value.trim();
        let cost_price = document.getElementById('cost_price').value.trim();
        let total_price = document.getElementById('total_price').value.trim();
        let layout = document.getElementById('layout').value.trim();

        $('.highlight-input').removeClass('empty filled');

        // ตรวจสอบ input ที่มีค่าว่าง
        $('.highlight-input').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('empty');
            } else {
                $(this).addClass('filled');
            }
        });

        // ตรวจสอบค่าว่าง
        if (!assets_key || !assets_type || !zero_code || !start_depreciation || !address || !qty || !unit || !age || !
            cost_price || !total_price || !layout) {
            // alert('Please fill in all required fields.');
            Toast.fire({
                icon: "warning",
                title: "กรุณากรอกข้อมูลให้ครบทุกช่อง"
            });
            return; // ไม่ส่งข้อมูลถ้ามีฟิลด์ใดหนึ่งว่าง
        }

        let formData = {
            assets_key: assets_key,
            assets_type: assets_type,
            zero_code: zero_code,
            start_depreciation: start_depreciation,
            address: address,
            qty: qty,
            unit: unit,
            age: age,
            cost_price: cost_price,
            total_price: total_price,
            layout: layout,
        };

        // ส่งข้อมูลโดยใช้ Axios
        axios.post('{{ route('asset.store') }}', formData)
            .then(function(response) {
                console.log(response);
                // alert('Asset created successfully!');
                Toast.fire({
                    icon: "success",
                    title: "สร้างสำเร็จ!"
                });
                setTimeout(() => {
                    location.reload()
                }, 1500);
            })
            .catch(function(error) {
                console.log(error);
                // alert('Failed to create asset!');

                Toast.fire({
                    icon: "error",
                    title: "ไม่สามารถสร้างสินทรัพย์นี้ได้! กรุณาตรวจสอบข้อมูล"
                });
            });
    }
</script>


@include('componenets.footer')
