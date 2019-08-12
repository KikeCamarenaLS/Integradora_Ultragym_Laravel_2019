{!! Form::open(['url' => '/productos_store', 'class' => 'app-form' ]) !!}
	<div>
		{!! Form::label('title','Titulo del producto') !!}
		{!! Form::text('title',$product[0]->Nombre_Producto,['class' => 'form-control']) !!}
	</div>

	<div>
		{!! Form::label('description','Descripción del producto') !!}
		{!! Form::textarea('description',$product[0]->Descripcion,['class' => 'form-control']) !!}
	</div>

	<div>
		{!! Form::label('price','Precio del producto') !!}
		{!! Form::number('price',$product[0]->Precio,['class' => 'form-control']) !!}
	</div>
	<br><br>
	<center>
		<div class="">
			<input type="submit" value="Guardar" class="btn btn-success">
		</div>
	</center>


{!! Form::close() !!}