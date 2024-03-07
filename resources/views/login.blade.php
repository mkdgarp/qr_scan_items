@include('componenets.header')
<div class="container mt-5">
    <!-- resources/views/auth/login.blade.php -->
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            {{-- <form id="loginForm"> --}}
            {{-- @csrf --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h5>ระบบจัดการข้อมูลสินทรัพย์</h5>
                </div>
                <div class="mt-3 col-12">
                    <label for="username">ชื่อผู้ใช้</label>
                    <input class="form-control" id="username" type="text" name="username" value="{{ old('username') }}"
                        placeholder="username" required autofocus>
                </div>
                <div class="mt-3 col-12">
                    <label for="password">รหัสผ่าน</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="password"
                        required>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary w-100" onclick="login()">Login</button>
            </div>
            {{-- </form> --}}
        </div>
    </div>


</div>
<script>
    function login() {
        // var formData = new FormData(document.getElementById('loginForm'));
        axios.post('/api/loginn', {
                username: $('#username').val(),
                password: $('#password').val(),
            })
            .then(function(response) {
                // กระบวนการหลังจากที่ล็อกอินสำเร็จ
                Toast.fire({
                    icon: "success",
                    title: "เข้าสู่ระบบสำเร็จ"
                });
                console.log(response.data);
                // สามารถทำการเปลี่ยนหน้าหรือทำอะไรก็ตามที่คุณต้องการต่อได้ที่นี่
            })
            .catch(function(error) {
                // กระบวนการหลังจากที่ล็อกอินไม่สำเร็จ
                // alert(error.response.data.message)
                Toast.fire({
                    icon: "error",
                    title: "ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง!"
                });
                // คุณสามารถแสดงข้อความผิดพลาดหรือกระทำการอื่น ๆ ตามต้องการที่นี่
            });
    }
</script>

@include('componenets.footer')
