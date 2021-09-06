<?php

namespace App\Controllers;

use App\Models\CarModel;
use App\Models\CategoryModel;
use Config\Validation;

class AdminController extends BaseController
{
	protected $carModel;
	protected $categoryModel;

	public function __construct()
	{
		$this->carModel = new CarModel();
		$this->categoryModel = new CategoryModel();
	}

	public function index()
	{

		$car = $this->carModel
			->join('category', 'car.category_id = category.category_id')
			->findAll();

		$data = [
			'cars' => $car,
		];
		return view('admin/armada', $data);
	}

	public function create()
	{
		$data = [
			'categories' => $this->categoryModel->findAll(),
			'validation' => \Config\Services::validation()
		];
		return view('admin/armada_create', $data);
	}

	public function store()
	{

		if (!$this->validate([
			'title_car' => [
				'rules'  => 'required|is_unique[car.title_car]',
				'errors' => [
					'required' => 'Nama armada tidak boleh Kosong.',
					'is_unique' => 'Nama armada sudah terdaftar.'
				]
			],
			'category_id' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Kategori Armada tidak boleh Kosong.'
				]
			],
			'body_car' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Deskripsi Armada tidak boleh Kosong.'
				]
			],
			'image' => [
				'rules'  => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/png]',
				'errors' => [
					'uploaded' => 'Gambar Armada tidak boleh Kosong.',
					'max_size' => 'Ukuran gambar terlalu besar.',
					'is_image' => 'yang anda pilih bukan gambar.',
					'mime_in' => 'yang anda pilih bukan gambar.',
				]
			]
		])) {
			return redirect()->back()->withInput();
		}


		$slug_car = url_title($this->request->getVar('title_car'), '-', true);
		$fileImage = $this->request->getFile('image');
		$nameImage = $fileImage->getRandomName();
		$fileImage->move('images', $nameImage);


		$this->carModel->save([
			'category_id' => $this->request->getVar('category_id'),
			'slug_car' => $slug_car,
			'title_car' => $this->request->getVar('title_car'),
			'body_car' => $this->request->getVar('body_car'),
			'image' => $nameImage,
		]);
		session()->setFlashdata('success', 'Data berhasil ditambahkan');
		return redirect()->to('/');
	}

	public function edit($slug_car)
	{

		$car = $this->carModel
			->join('category', 'car.category_id = category.category_id')
			->where(['slug_car' => $slug_car])->first();


		$data = [
			'categories' => $this->categoryModel->findAll(),
			'validation' => \Config\Services::validation(),
			'car' => $car
		];

		if (empty($data['car'])) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		};

		return view('admin/edit_armada', $data);
	}

	public function update($id)
	{

		$slug = $this->request->getVar('slug_car');
		$namaLama = $this->carModel->where(['slug_car' => $slug])->first();
		if ($namaLama['title_car'] == $this->request->getVar('title_car')) {
			$rule_nama = 'required';
		} else {
			$rule_nama = 'required|is_unique[car.title_car]';
		}


		if (!$this->validate([
			'title_car' => [
				'rules'  => $rule_nama,
				'errors' => [
					'required' => 'Nama armada tidak boleh Kosong.',
					'is_unique' => 'Nama armada sudah terdaftar.'
				]
			],
			'category_id' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Kategori Armada tidak boleh Kosong.'
				]
			],
			'body_car' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Deskripsi Armada tidak boleh Kosong.'
				]
			],
			'image' => [
				'rules'  => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/png]',
				'errors' => [
					'max_size' => 'Ukuran gambar terlalu besar.',
					'is_image' => 'yang anda pilih bukan gambar.',
					'mime_in' => 'yang anda pilih bukan gambar.',
				]
			]
		])) {
			return redirect()->back()->withInput();
		}

		$slug_car = url_title($this->request->getVar('title_car'), '-', true);
		$fileImage = $this->request->getFile('image');


		if ($fileImage->getError() == 4) {
			$nameImage = $this->request->getVar('gambarLama');
		} else {
			$nameImage = $fileImage->getRandomName();
			$fileImage->move('images', $nameImage);
			unlink('images/' . $this->request->getVar('gambarLama'));
		}





		$this->carModel->save([
			'car_id' => $id,
			'category_id' => $this->request->getVar('category_id'),
			'slug_car' => $slug_car,
			'title_car' => $this->request->getVar('title_car'),
			'body_car' => $this->request->getVar('body_car'),
			'image' => $nameImage,
		]);
		session()->setFlashdata('success', 'Data berhasil diubah');
		return redirect()->to('/');
	}


	public function delete($id)
	{

		$car = $this->carModel->find($id);

		unlink('images/' . $car['image']);

		$this->carModel->delete($id);
		session()->setFlashdata('success', 'Data berhasil dihapus');
		return redirect()->to('/');
	}
}
