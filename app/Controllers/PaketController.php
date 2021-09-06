<?php

namespace App\Controllers;

use App\Models\PaketModel;

class PaketController extends BaseController
{
	protected $paketModel;

	public function __construct()
	{
		$this->paketModel = new PaketModel();
	}
	public function index()
	{
		$data = [
			'paket' => $this->paketModel->orderBy('id')->findAll()
		];

		return view('admin/paket', $data);
	}

	public function create()
	{
		return view('admin/create_paket');
	}

	public function store()
	{
		$fileImage = $this->request->getFile('image');
		$nameImage = $fileImage->getRandomName();
		$fileImage->move('images', $nameImage);

		$attr = $this->request->getVar();

		$attr['image'] = $nameImage;


		$this->paketModel->save($attr);
		session()->setFlashdata('success', 'Data berhasil ditambahkan');
		return redirect()->to('/admin-paket');
	}

	public function update()
	{
		$fileImage = $this->request->getFile('image');


		if ($fileImage->getError() == 4) {
			$nameImage = $this->request->getVar('gambarLama');
		} else {
			$nameImage = $fileImage->getRandomName();
			$fileImage->move('images', $nameImage);
			unlink('images/' . $this->request->getVar('gambarLama'));
		}

		$attr = $this->request->getVar();

		$attr['image'] = $nameImage;


		$this->paketModel->save($attr);
		session()->setFlashdata('success', 'Data berhasil ditambahkan');
		return redirect()->to('/admin-paket');
	}


	public function edit($id)
	{

		$data = [
			'paket' => $this->paketModel->find($id)
		];
		return view('admin/edit_paket', $data);
	}



	public function delete($id)
	{
		$paket = $this->paketModel->find($id);
		unlink('images/' . $paket['image']);
		$this->paketModel->delete($id);
		session()->setFlashdata('success', 'Data berhasil dihapus');
		return redirect()->to('/admin-paket');
	}
}
