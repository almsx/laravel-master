<!DOCTYPE html>
<html>
	<head>
		<title>Lista de Cafés</title>
		<style>
			table {
				width: 100%;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<table>
			<tr>
				<th>Tipo</th>
				<th>Nombre</th>
				<th>Tamaño</th>
				<th>Costo</th>
			</tr>
			@forelse($cafes as $cafe)
			<tr>
				<td>{{ $cafe["tipo"] }}</td>
				<td>{{ $cafe["nombre"] }}</td>
				<td>{{ $cafe["tamaño"] }}</td>
				<td>{{ $cafe["costo"] }}</td>
			</tr>
			@empty
			<tr>
				<td>--</td>
				<td>--</td>
				<td>--</td>
				<td>--</td>
			</tr>
			@endforelse
		</table>
		@if (count($cafes) <= 0)
		<p>No hay resultados</p>
		@endif	
	</body>
</html>