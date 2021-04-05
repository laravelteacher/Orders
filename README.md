# Orders

 Video link
https://youtu.be/jgcBHbkTurc                             
							 How to make Drag and Drop Datatables Using jQuery UI Sortable in Laravel
							 
step -1: make a Table 


php artisan make:model order -m	

$table->id();
            $table->string('title');
            $table->integer('order')->default(0);
            $table->timestamps();
			
php artisan migrate


protected $fillable = [
        'title', 'order'
    ];
			
			

step -2: make a Template

Order.blade.php

put the below code in Template

<!DOCTYPE html>
<html>
<head>
    <title>Create Drag and Droppable Datatables Using jQuery UI Sortable in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> 
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <h3 class="text-center mb-4">Drag and Drop Datatables Using jQuery UI Sortable in Laravel </h3>
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th width="30px">#</th>  
                  <th>Title</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody id="tablecontents">
                @foreach($posts as $post)
    	            <tr class="row1" data-id="{{ $post->id }}">
    	              <td class="pl-3"><i class="fa fa-sort"></i></td>
    	              <td>{{ $post->title }}</td>
    	              <td>{{ date('d-m-Y h:m:s',strtotime($post->created_at)) }}</td>
    	            </tr>
                @endforeach
              </tbody>                  
            </table>
            <hr>
            <h5>Drag and Drop the table rows and <button class="btn btn-success btn-sm" onclick="window.location.reload()">REFRESH</button> </h5> 
    	</div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('Custom-sortable') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
</body>
</html>	


step -3: put the below code in web.php

Route::get('Custom','App\Http\Controllers\orderController@index');
Route::post('Custom-sortable','App\Http\Controllers\orderController@update');


step -4: make a controller
php artisan make:controller orderController

use App\Models\order;

 public function index()
    {
        $posts = order::orderBy('order','ASC')->get();

        return view('Order',compact('posts'));
    }

    public function update(Request $request)
    {
        $posts = order::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
	
	Thanks and Dont forget to Subscribe Please
					 
