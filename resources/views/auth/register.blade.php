<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrasi - Belajar Organ Tubuh Manusia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffe6ef;
      /* Pink pastel lembut */
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .register-box {
      background-color: #ffcfe0;
      /* Pink soft untuk card */
      border-radius: 15px;
      padding: 40px 50px;
      width: 420px;
      box-shadow: 0 0 15px rgba(255, 182, 193, 0.4);
      /* bayangan lembut */
    }

    h2 {
      text-align: center;
      font-weight: 700;
      margin-bottom: 25px;
      color: #4a0d2e;
      /* pink tua elegan */
    }

    .form-control {
      border-radius: 10px;
      height: 45px;
      border: 1px solid #f2a7c1;
    }

    .form-control:focus {
      box-shadow: 0 0 5px #f2a7c1;
      border-color: #f2a7c1;
    }

    .btn-primary {
      background-color: #f27ba3;
      border: none;
      border-radius: 10px;
      height: 45px;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #e45f8f;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      top: 10px;
      cursor: pointer;
      color: #9c6179;
      font-size: 18px;
    }

    .position-relative {
      position: relative;
    }

    .text-center a {
      color: #c23c70;
      font-weight: 500;
      text-decoration: none;
    }

    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="register-box">
    <h2>REGISTRASI</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Nama -->
      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input
          type="text"
          name="name"
          class="form-control"
          id="name"
          placeholder="Masukkan nama"
          required>
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          name="email"
          class="form-control"
          id="email"
          placeholder="Masukkan email"
          required>
      </div>

      <!-- Password -->
      <div class="mb-3 position-relative">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          name="password"
          class="form-control"
          id="password"
          placeholder="Masukkan password"
          required>

      <!-- Pesan validasi -->
      <small id="passwordHelp" class="mt-1 d-block" style="font-size: 13px; color: #b82158; display:none;">
          Password harus minimal 6 karakter dan mengandung kombinasi huruf & angka.
      </small>

        <span class="toggle-password" onclick="togglePassword('password', this)"></span>
      </div>

      <!-- Konfirmasi Password -->
      <div class="mb-3 position-relative">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input
          type="password"
          name="password_confirmation"
          class="form-control"
          id="password_confirmation"
          placeholder="Ulangi password"
          required>
        <span class="toggle-password" onclick="togglePassword('password_confirmation', this)"></span>
      </div>

      <!-- Tombol -->
      <button type="submit" class="btn btn-primary w-100">Registrasi</button>

      <!-- Link ke Login -->
      <div class="text-center mt-3">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login') }}">Login</a>
      </div>
    </form>
  </div>

  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        el.textContent = "🙈";
      } else {
        input.type = "password";
        el.textContent = "";
      }
    }
  </script>


  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        el.textContent = "🙈";
      } else {
        input.type = "password";
        el.textContent = "";
      }
    }
  </script>

</body>

</html>