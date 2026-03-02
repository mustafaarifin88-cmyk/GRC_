<footer class="mt-5">
    <div class="footer clearfix mb-0 text-muted px-4 py-3 bg-white shadow-sm rounded-top">
        <div class="float-start">
            <?php
            $companyModel = new \App\Models\CompanyModel();
            $company = $companyModel->first();
            $companyName = $company['nama_perusahaan'] ?? 'GRC System';
            ?>
            <p><?= date('Y') ?> &copy; <?= esc($companyName) ?></p>
        </div>
        <div class="float-end d-none d-md-block">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> by <a href="#" class="fw-bold text-decoration-none">GRC Team</a></p>
        </div>
    </div>
</footer>