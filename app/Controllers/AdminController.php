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
}
