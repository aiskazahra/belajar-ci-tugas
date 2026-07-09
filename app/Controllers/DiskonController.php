<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiscountModel;

class DiskonController extends BaseController
{
    protected $discountModel;

    function __construct()
    {
        helper(['form', 'number']);
        $this->discountModel = new DiscountModel();
    }

    public function index()
    {
        $discounts = $this->discountModel->orderBy('tanggal', 'ASC')->findAll();
        $data['discounts'] = $discounts;

        return view('diskon/index', $data);
    }

    public function create()
    {
        $rules = [
            'tanggal' => 'required|valid_date|is_unique[discount.tanggal]',
            'nominal' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('failed', $this->validator->listErrors());
        }

        $this->discountModel->insert([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ]);

        return redirect()->to(base_url('diskon'))->with('success', 'Data Diskon Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $rules = [
            'nominal' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('failed', $this->validator->listErrors());
        }

        $this->discountModel->update($id, [
            'nominal' => $this->request->getPost('nominal'),
        ]);

        return redirect()->to(base_url('diskon'))->with('success', 'Data Diskon Berhasil Diubah');
    }

    public function delete($id)
    {
        $this->discountModel->delete($id);

        return redirect()->to(base_url('diskon'))->with('success', 'Data Diskon Berhasil Dihapus');
    }
}
