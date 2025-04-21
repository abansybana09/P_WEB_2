<?php include('include/header.php'); ?>
<header class="hero-header">
    <div class="overlay-content">
    </div>
    <img src="img/bakar.jpg" alt="Ayam Bakar Background" class="hero-bg">
</header>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kontak Kami</h1>
        <div class="row">
            <div class="col-md-6">
                <h4>Informasi Kontak</h4>
                <p><strong>Alamat:</strong> Jl. Contoh No. 123, Kota Contoh</p>
                <p><strong>Email:</strong> info@contoh.com</p>
                <p><strong>Telepon:</strong> +62 812 3456 7890</p>
            </div>
            <div class="col-md-6">
                <h4>Formulir Kontak</h4>
                <form action="proses_kontak.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
