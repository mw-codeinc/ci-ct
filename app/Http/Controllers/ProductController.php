<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller {

	public function create()
    {
        $collection = array();
        $total = 0;

        if(file_exists(storage_path().'/products/')) {
            $files = array_diff(scandir(storage_path() . '/products/', SORT_DESC), array('..', '.'));
            foreach($files as $file) {
                $obj = json_decode(file_get_contents(storage_path().'/products/'.$file));
                $collection[] = $obj;
                $total += $obj->total;
            }
        } else {
            mkdir(storage_path().'/products/');
            chmod(storage_path().'/products/', 0777);
        }

        return view('product/index', array('collection' => $collection, 'total' => $total));
    }

    public function store(ProductFormRequest $request)
    {
        $productArr = array(
            'name'      => \Input::get('productName'),
            'qty'       => (int) \Input::get('quantity'),
            'price'     => (float) \Input::get('price'),
            'datetime'  => date("Y-m-d H:i:s"),
            'total'     => (float) \Input::get('quantity') * (float) \Input::get('price'),
        );

        $file = \File::put(storage_path().'/products/' . date("Y_m_d_H_i_s") . '.json', json_encode($productArr, JSON_FORCE_OBJECT));
        if ($file === false) {
            return \Redirect::route('/')->with('error', 'Error writing to file');
        }

        return $productArr;
    }

}
