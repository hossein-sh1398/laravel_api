<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
<form action="{{url('article')}}" method="post">
	{{csrf_field()}}
	<p>title:<input type="tetx" name="title"></p>
	<p>body:<input type="tetx" name="body"></p>
	<p><input type="hidden" value="hhhhhhhhhh" name="body1"></p>
	<p><input type="submit" value="send"></p>
</form>

<input id="g" type="button" onclick="ajax11()" value="ajax button" name="">
<input type="button" onclick="json1()" value="Json button" name="">
</body>
</html>
<script type="text/javascript">
	function ajax11(){


		$.ajax({
			url:'{{asset('ajax')}}',
			type:'POST',
			data:{name:'hossein',family:'shirinegad',_token:'{{csrf_token()}}' },
			success:function(data){
				alert(data.name);
				alert(data.family);
				alert(data._token);
			}
		});
	}

function json1(){
// 	var num=2;
// var r={name:"hossein",family:"shieinegad"};
// alert(r.name+" "+r.family);
	var dd ={
"employees":
  [
{ "firstName":"John" , "lastName":"Doe" },
{ "firstName":"Anna" , "lastName":"Smith" },
{ "firstName":"Peter" , "lastName":"Jones" }
]
	};
//$.each(dd,function(key,value){
alert( dd.employees[0].firstName );
alert( dd.employees[0].lastName );
	//alert(value.firstName);
 //});
 }
</script>
