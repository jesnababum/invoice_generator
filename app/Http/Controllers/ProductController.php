<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;

class ProductController extends Controller
{

	/**

	* Display a listing of the resource.

	*

	* @return \Illuminate\Http\Response

	*/

	public function index()
	{

		$products = Product::first()->paginate(5);

		$discount = Discount::first();
		$total_amount = Product::first()->sum('total');
		if($discount['discount_type']== '1')
		{
			$discount_amount = $discount['discount_value'];
		}
		else
		{
			$discount_amount = $discount['discount_value']/100* $total_amount;
		}

		$grand_total = 0;

		if($total_amount > $discount_amount)	
		{
			$grand_total = $total_amount - $discount_amount;
		}		
		//echo "<pre>";print_r($products);die;
		return view('items.index',compact('products','total_amount','discount_amount','grand_total'))

		->with('i', (request()->input('page', 1) - 1) * 5);

	}



	/**

	* Show the form for creating a new resource.

	*

	* @return \Illuminate\Http\Response

	*/

	public function create()
	{
		return view('items.create');

	}



	/**

	* Store a newly created resource in storage.

	*

	* @param  \Illuminate\Http\Request  $request

	* @return \Illuminate\Http\Response

	*/

	public function store(Request $request)
	{

		$request->validate([

		'product_name' => 'required',
		'quantity' => 'required|numeric|min:1',
		'unit_price' => 'required|numeric',
		'tax_percentage' => 'required|numeric',

		]);

		$sub_total = $request['quantity']*$request['unit_price'];
		$tax_amount = $request['tax_percentage']/100*$sub_total;
		$total = $sub_total+$tax_amount;
		
		Product::create($request->all()+['tax_amount'=>$tax_amount,'total'=>$total]);



		return redirect()->route('items.index')

		->with('success','Item added successfully.');

	}



	/**

	* Display the specified resource.

	*

	* @param  \App\Product  $product

	* @return \Illuminate\Http\Response

	*/

	public function show1(Product $product)

	{
	return view('items.show',compact('product'));

	} 



	/**

	* Show the form for editing the specified resource.

	*

	* @param  \App\Product  $product

	* @return \Illuminate\Http\Response

	*/

	public function edit_item(Product $product)

	{

		return view('items.edit_item',compact('product'));

	}



	/**

	* Update the specified resource in storage.

	*

	* @param  \Illuminate\Http\Request  $request

	* @param  \App\Product  $product

	* @return \Illuminate\Http\Response

	*/

	public function update_item(Request $request, Product $product)

	{

		$request->validate([

		'name' => 'required',

		'detail' => 'required',

		]);



		$product->update_item($request->all());



		return redirect()->route('items.index')

		->with('success','Product updated successfully');

	}



	/**

	* Remove the specified resource from storage.

	*

	* @param  \App\Product  $product

	* @return \Illuminate\Http\Response

	*/

	public function destroy(Product $product)


	{

		$product->delete_item();

		return redirect()->route('items.index')

		->with('success','Product deleted successfully');

	}
}