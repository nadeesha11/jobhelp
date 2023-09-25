<?php

namespace App\Http\Controllers\admin;

use App\Contracts\PackageInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class packageController extends Controller
{

  public $package;
  function __construct(PackageInterface $packageInterface)
  {
    $this->package = $packageInterface;
  }

  public function index()
  {
    $package = $this->package->index();
    return $package;
  }

  public function recievePackages()
  {
    $data = $this->package->recievePackages();
    return $data;
  }

  public function getEditPackages($id)
  {
    $data = $this->package->getEditPackages($id);
    return $data;
  }

  public function update(Request $request)
  {
    $request->validate([
      'name' => 'required|max:25',
    ]);
    $data = $this->package->update($request->all());
    return $data;
  }

  public function delete($id)
  {
    $data = $this->package->delete($id);
    return $data;
  }
}
