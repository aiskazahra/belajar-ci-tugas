<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class PembelianController extends BaseController
{
    protected $transactionModel;
    protected $transactionDetailModel;

    function __construct()
    {
        helper(['form', 'number']);
        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
    }

    public function index()
    {
        $transactions = $this->transactionModel->orderBy('created_at', 'DESC')->findAll();
        $transactionIds = array_column($transactions, 'id');
        $products = $this->transactionDetailModel->getProductsByTransactionIds($transactionIds);

        $data = [
            'transactions' => $transactions,
            'products'     => $products,
        ];

        return view('pembelian/index', $data);
    }

    public function updateStatus($id)
    {
        if (!$this->transactionModel->find($id)) {
            return redirect()->to(base_url('pembelian'))->with('failed', 'Data Pembelian Tidak Ditemukan');
        }

        $status = $this->request->getPost('status') == '1' ? 1 : 0;

        $this->transactionModel->update($id, ['status' => $status]);

        return redirect()->to(base_url('pembelian'))->with('success', 'Status Pesanan Berhasil Diubah');
    }
}
