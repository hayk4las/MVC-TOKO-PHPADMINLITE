<?php
require_once 'apps/models/Modtransaksi.php';

class transaksiController {
    private $userModel;

    public function __construct($dbConnection) {
        $this->userModel = new transaksiUser($dbConnection);
    }

    public function index() {
        $transaksi = $this->userModel->getAllTransaksi();
        require_once 'apps/view/transaksi.php';
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pelanggan = $_POST['id_pelanggan'];
            $kd_barang = $_POST['kd_barang'];
            $jumlah = $_POST['jumlah'];
            $harga_total = $_POST['harga_total'];

            try {
                $this->userModel->tambahTransaksi($id_pelanggan, $kd_barang, $jumlah, $harga_total);
                header('Location: index.php?page=transaksi');
                exit();
            } catch (Exception $e) {
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        }

        require_once 'apps/view/tambah_transaksi.php';
    }

    public function delete($id_transaksi) {
        $this->userModel->deleteTransaksi($id_transaksi);
        header('Location: index.php?page=transaksi');
        exit();
    }
    
    
}
?>