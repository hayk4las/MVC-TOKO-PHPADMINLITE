<?php
class transaksiUser {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getAllTransaksi() {
        $stmt = $this->db->prepare("SELECT * FROM transaksi");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambahTransaksi($id_pelanggan, $kd_barang, $jumlah, $harga_total) {
        try {
            // Mulai transaksi
            $this->db->beginTransaction();
    
            // Insert data transaksi
            $stmt = $this->db->prepare("INSERT INTO transaksi (id_pelanggan, kd_barang, jumlah, harga_total, tanggal) 
                VALUES (:id_pelanggan, :kd_barang, :jumlah, :harga_total, NOW())");
            $stmt->bindParam(':id_pelanggan', $id_pelanggan); // Perbaiki nama parameter menjadi ':id_pelanggan'
            $stmt->bindParam(':kd_barang', $kd_barang);
            $stmt->bindParam(':jumlah', $jumlah);
            $stmt->bindParam(':harga_total', $harga_total);
            $stmt->execute();
    
            // Kurangi stok barang
            $this->kurangiStok($kd_barang, $jumlah);
    
            // Commit transaksi
            $this->db->commit();
        } catch (Exception $e) {
            // Rollback jika ada error
            $this->db->rollBack();
            throw $e;
        }
    }
    

    public function kurangiStok($kd_barang, $jumlah) {
        $stmt = $this->db->prepare("UPDATE barang SET stok = stok - :jumlah WHERE kd_barang = :kd_barang");
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':kd_barang', $kd_barang);
        $stmt->execute();
    }
    

    public function deleteTransaksi($id_transaksi) {
        $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = :id_transaksi");
        $stmt->bindParam(':id_transaksi', $id_transaksi, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>