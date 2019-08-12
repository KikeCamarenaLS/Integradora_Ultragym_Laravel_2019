{!! Form::open(['url' => '/productos_store', 'class' => 'app-form' ]) !!}
	<div>
		{!! Form::label('title','Titulo del producto') !!}
		{!! Form::text('title','',['class' => 'form-control']) !!}
	</div>

	<div>
		{!! Form::label('description','Descripción del producto') !!}
		{!! Form::textarea('description',$product->Descripcion,['class' => 'form-control']) !!}
	</div>

	<div>
		{!! Form::label('price','Precio del producto') !!}
		{!! Form::number('price',$product->Precio,['class' => 'form-control']) !!}
	</div>
	<br><br>
	<center>
		<div class="">
			<input type="submit" value="Guardar" class="btn btn-success">
		</div>
	</center>


{!! Form::close() !!}